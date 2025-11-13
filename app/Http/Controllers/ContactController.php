<?php

namespace App\Http\Controllers;

use App\Models\ContactQuery;
use App\Models\CompanySetting;
use App\Models\SocialMediaLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class ContactController extends Controller
{
    /**
     * Show contact form
     */
    public function index()
    {
        $setting = CompanySetting::first();
        $social = SocialMediaLink::where('status', true)->get();

        return view('site.pages.contact', compact('setting', 'social'));
    }

    /**
     * Handle contact form submission
     */
    public function submit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|min:10|max:2000',
            'type' => 'nullable|in:general,booking,complaint,suggestion,partnership',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Please fix the errors below.',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Create contact query
            $contactQuery = ContactQuery::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'subject' => $request->subject,
                'message' => $request->message,
                'type' => $request->type ?? 'general',
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'status' => ContactQuery::STATUS_NEW,
            ]);

            // Send email notification to admin
            $this->sendAdminNotification($contactQuery);

            // Send auto-response to user
            $this->sendAutoResponse($contactQuery);

            Log::info('New contact query submitted', ['id' => $contactQuery->id, 'email' => $contactQuery->email]);

            return response()->json([
                'success' => true,
                'message' => 'Thank you for your message! We have received your inquiry and will get back to you within 24 hours.',
                'query_id' => $contactQuery->id
            ], 200);

        } catch (\Exception $e) {
            Log::error('Contact form submission failed', [
                'error' => $e->getMessage(),
                'email' => $request->email
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Sorry, there was an error submitting your message. Please try again or contact us directly.'
            ], 500);
        }
    }

    /**
     * ADMIN METHODS
     */

    /**
     * Display a listing of contact queries
     */
    public function adminIndex(Request $request)
    {
        $status = $request->get('status', 'all');
        $type = $request->get('type', 'all');
        $search = $request->get('search');

        $queries = ContactQuery::latest()
            ->when($status && $status !== 'all', function ($query) use ($status) {
                return $query->where('status', $status);
            })
            ->when($type && $type !== 'all', function ($query) use ($type) {
                return $query->where('type', $type);
            })
            ->when($search, function ($query) use ($search) {
                return $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%')
                      ->orWhere('email', 'like', '%' . $search . '%')
                      ->orWhere('subject', 'like', '%' . $search . '%')
                      ->orWhere('message', 'like', '%' . $search . '%');
                });
            })
            ->paginate(20);

        $stats = [
            'total' => ContactQuery::count(),
            'new' => ContactQuery::where('status', ContactQuery::STATUS_NEW)->count(),
            'in_progress' => ContactQuery::where('status', ContactQuery::STATUS_IN_PROGRESS)->count(),
            'resolved' => ContactQuery::where('status', ContactQuery::STATUS_RESOLVED)->count(),
        ];

        return view('admin.contact-queries.index', compact('queries', 'stats', 'status', 'type', 'search'));
    }

    /**
     * Display the specified contact query
     */
    public function show(ContactQuery $contactQuery)
    {
        return view('admin.contact-queries.show', compact('contactQuery'));
    }

    /**
     * Update the specified contact query
     */
    public function update(Request $request, ContactQuery $contactQuery)
    {
        $request->validate([
            'status' => 'required|in:new,in_progress,resolved,closed',
            'admin_notes' => 'nullable|string|max:1000',
        ]);

        $data = $request->only(['status', 'admin_notes']);

        // If status is being changed to resolved, set responded_at
        if ($request->status === ContactQuery::STATUS_RESOLVED && $contactQuery->status !== ContactQuery::STATUS_RESOLVED) {
            $data['responded_at'] = now();
        }

        $contactQuery->update($data);

        return redirect()->route('admin.contact-queries.show', $contactQuery)
            ->with('success', 'Contact query updated successfully.');
    }

    /**
     * Mark query as responded
     */
    public function markAsResponded(ContactQuery $contactQuery)
    {
        $contactQuery->update([
            'status' => ContactQuery::STATUS_RESOLVED,
            'responded_at' => now(),
        ]);

        return redirect()->route('admin.contact-queries.show', $contactQuery)
            ->with('success', 'Query marked as responded.');
    }

    /**
     * Remove the specified contact query
     */
    public function destroy(ContactQuery $contactQuery)
    {
        $contactQuery->delete();

        return redirect()->route('admin.contact-queries.index')
            ->with('success', 'Contact query deleted successfully.');
    }

    /**
     * Export contact queries
     */
    public function export($format)
    {
        $queries = ContactQuery::latest()->get();

        if ($format === 'csv') {
            return $this->exportToCsv($queries);
        }

        return redirect()->back()->with('error', 'Invalid export format.');
    }

    /**
     * Export to CSV
     */
    private function exportToCsv($queries)
    {
        $fileName = 'contact-queries-' . date('Y-m-d') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
        ];

        $callback = function() use ($queries) {
            $file = fopen('php://output', 'w');

            // Add CSV headers
            fputcsv($file, [
                'ID', 'Name', 'Email', 'Phone', 'Subject', 'Type', 'Status',
                'Message', 'Submitted At', 'Responded At', 'IP Address'
            ]);

            // Add data rows
            foreach ($queries as $query) {
                fputcsv($file, [
                    $query->id,
                    $query->name,
                    $query->email,
                    $query->phone ?? 'N/A',
                    $query->subject,
                    $query->type,
                    $query->status,
                    strip_tags($query->message),
                    $query->created_at->format('Y-m-d H:i:s'),
                    $query->responded_at ? $query->responded_at->format('Y-m-d H:i:s') : 'N/A',
                    $query->ip_address ?? 'N/A'
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Send notification email to admin
     */
    private function sendAdminNotification(ContactQuery $contactQuery)
    {
        try {
            $setting = CompanySetting::first();
            $adminEmail = $setting->email ?? config('mail.from.address');

            // Check if email configuration is set
            if (config('mail.from.address')) {
                Mail::send('emails.contact-notification', ['query' => $contactQuery], function ($message) use ($adminEmail, $contactQuery) {
                    $message->to($adminEmail)
                            ->subject('New Contact Query: ' . $contactQuery->subject)
                            ->from(config('mail.from.address'), config('mail.from.name'));
                });
            }
        } catch (\Exception $e) {
            Log::error('Failed to send admin notification email', ['error' => $e->getMessage()]);
        }
    }

    /**
     * Send auto-response email to user
     */
    private function sendAutoResponse(ContactQuery $contactQuery)
    {
        try {
            $setting = CompanySetting::first();

            // Check if email configuration is set
            if (config('mail.from.address')) {
                Mail::send('emails.contact-auto-response', ['query' => $contactQuery, 'setting' => $setting], function ($message) use ($contactQuery) {
                    $message->to($contactQuery->email)
                            ->subject('We have received your message - ' . config('app.name'))
                            ->from(config('mail.from.address'), config('mail.from.name'));
                });
            }
        } catch (\Exception $e) {
            Log::error('Failed to send auto-response email', ['error' => $e->getMessage()]);
        }
    }
}
