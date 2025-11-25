<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ItineraryTemplate;
use App\Models\IncludedService;
use App\Models\ExcludedService;
use App\Models\ExperienceHighlight;
use App\Models\ImportantInformation;
use App\Models\QuickFact;
use App\Models\ItineraryDay;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class ItineraryTemplateController extends Controller
{
    public function index()
    {
        $templates = ItineraryTemplate::with('days')->latest()->get();
        return view('admin.itinerary-templates.index', compact('templates'));
    }

    public function create()
    {
        $seasons = [
            'summer' => 'Summer Special',
            'winter' => 'Winter Special',
            'spring' => 'Spring Special',
            'autumn' => 'Autumn Special',
            'year_round' => 'Year Round',
            'eid_special' => 'Eid Special'
        ];

        $includedServices = IncludedService::active()->ordered()->get();
        $excludedServices = ExcludedService::active()->ordered()->get();
        $experienceHighlights = ExperienceHighlight::active()->ordered()->get();
        $importantInformation = ImportantInformation::active()->ordered()->get();
        $quickFacts = QuickFact::active()->ordered()->get();

        return view('admin.itinerary-templates.create', compact(
            'seasons',
            'includedServices',
            'excludedServices',
            'experienceHighlights',
            'importantInformation',
            'quickFacts'
        ));
    }

  public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'title' => 'required|string|max:255',
        'subtitle' => 'nullable|string|max:255',
        'season' => 'required|in:summer,winter,spring,autumn,year_round,eid_special',
        'duration_days' => 'required|integer|min:1',
        'duration_nights' => 'required|integer|min:0',
        'description' => 'required|string',
        'selected_included_services' => 'nullable|array',
        'selected_excluded_services' => 'nullable|array',
        'selected_experience_highlights' => 'nullable|array',
        'selected_important_information' => 'nullable|array',
        'selected_quick_facts' => 'nullable|array',
        'pricing_options' => 'required|array',
        'payment_terms' => 'nullable|string',
        'cancellation_policy' => 'nullable|string',
        'terms_conditions' => 'nullable|string',
        'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'days' => 'required|array|min:0',
        'days.*.title' => 'required|string|max:255',
        'days.*.description' => 'required|string',
        'days.*.activities' => 'nullable|string',
        'days.*.meals' => 'nullable|string',
        'days.*.accommodation' => 'nullable|string',
    ]);

    // Start transaction for data consistency
    DB::beginTransaction();

    try {
        // Create itinerary template
        $template = new ItineraryTemplate();
        $template->name = $request->name;
        $template->title = $request->title;
        $template->subtitle = $request->subtitle;
        $template->season = $request->season;
        $template->trip_code = $template->generateTripCode();
        $template->duration_days = $request->duration_days;
        $template->duration_nights = $request->duration_nights;
        $template->description = $request->description;
        $template->selected_included_services = $request->selected_included_services;
        $template->selected_excluded_services = $request->selected_excluded_services;
        $template->selected_experience_highlights = $request->selected_experience_highlights;
        $template->selected_important_information = $request->selected_important_information;
        $template->selected_quick_facts = $request->selected_quick_facts;
        $template->pricing_options = $request->pricing_options;
        $template->payment_terms = $request->payment_terms;
        $template->cancellation_policy = $request->cancellation_policy;
        $template->terms_conditions = $request->terms_conditions;

        // Handle cover image
        if ($request->hasFile('cover_image')) {
            $imagePath = $request->file('cover_image')->store('itineraries', 'public');
            $template->cover_image = $imagePath;
        }

        $template->save();

        // Save itinerary days
        foreach ($request->days as $dayData) {
            $template->days()->create([
                'day_number' => $dayData['day_number'],
                'title' => $dayData['title'],
                'description' => $dayData['description'],
                'activities' => $dayData['activities'],
                'meals' => $dayData['meals'],
                'accommodation' => $dayData['accommodation'],
                'order' => $dayData['day_number'] // Use day_number as order
            ]);
        }

        // Commit transaction
        DB::commit();

        return redirect()->route('admin.itinerary-templates.index')
            ->with('success', 'Itinerary template created successfully!');

    } catch (\Exception $e) {
        // Rollback transaction on error
        DB::rollBack();

        return redirect()->back()
            ->withInput()
            ->with('error', 'Error creating itinerary template: ' . $e->getMessage());
    }
}

    public function edit(ItineraryTemplate $itineraryTemplate)
    {
        $seasons = [
            'summer' => 'Summer Special',
            'winter' => 'Winter Special',
            'spring' => 'Spring Special',
            'autumn' => 'Autumn Special',
            'year_round' => 'Year Round',
            'eid_special' => 'Eid Special'
        ];

        $includedServices = IncludedService::active()->ordered()->get();
        $excludedServices = ExcludedService::active()->ordered()->get();
        $experienceHighlights = ExperienceHighlight::active()->ordered()->get();
        $importantInformation = ImportantInformation::active()->ordered()->get();
        $quickFacts = QuickFact::active()->ordered()->get();

        return view('admin.itinerary-templates.edit', compact(
            'itineraryTemplate',
            'seasons',
            'includedServices',
            'excludedServices',
            'experienceHighlights',
            'importantInformation',
            'quickFacts'
        ));
    }

  public function update(Request $request, ItineraryTemplate $itineraryTemplate)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'title' => 'required|string|max:255',
        'subtitle' => 'nullable|string|max:255',
        'season' => 'required|in:summer,winter,spring,autumn,year_round,eid_special',
        'duration_days' => 'required|integer|min:1',
        'duration_nights' => 'required|integer|min:0',
        'description' => 'required|string',
        'selected_included_services' => 'nullable|array',
        'selected_excluded_services' => 'nullable|array',
        'selected_experience_highlights' => 'nullable|array',
        'selected_important_information' => 'nullable|array',
        'selected_quick_facts' => 'nullable|array',
        'pricing_options' => 'required|array',
        'payment_terms' => 'nullable|string',
        'cancellation_policy' => 'nullable|string',
        'terms_conditions' => 'nullable|string',
        'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'days' => 'required|array|min:0',
        'days.*.title' => 'required|string|max:255',
        'days.*.description' => 'required|string',
        'days.*.activities' => 'nullable|string',
        'days.*.meals' => 'nullable|string',
        'days.*.accommodation' => 'nullable|string',
    ]);

    // Start transaction
    DB::beginTransaction();

    try {
        $itineraryTemplate->update([
            'name' => $request->name,
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'season' => $request->season,
            'duration_days' => $request->duration_days,
            'duration_nights' => $request->duration_nights,
            'description' => $request->description,
            'selected_included_services' => $request->selected_included_services,
            'selected_excluded_services' => $request->selected_excluded_services,
            'selected_experience_highlights' => $request->selected_experience_highlights,
            'selected_important_information' => $request->selected_important_information,
            'selected_quick_facts' => $request->selected_quick_facts,
            'pricing_options' => $request->pricing_options,
            'payment_terms' => $request->payment_terms,
            'cancellation_policy' => $request->cancellation_policy,
            'terms_conditions' => $request->terms_conditions,
        ]);

        // Handle cover image
        if ($request->hasFile('cover_image')) {
            $imagePath = $request->file('cover_image')->store('itineraries', 'public');
            $itineraryTemplate->cover_image = $imagePath;
            $itineraryTemplate->save();
        }

        // Update itinerary days - delete existing and create new
        $itineraryTemplate->days()->delete();
        foreach ($request->days as $dayData) {
            $itineraryTemplate->days()->create([
                'day_number' => $dayData['day_number'],
                'title' => $dayData['title'],
                'description' => $dayData['description'],
                'activities' => $dayData['activities'],
                'meals' => $dayData['meals'],
                'accommodation' => $dayData['accommodation'],
                'order' => $dayData['day_number']
            ]);
        }

        // Commit transaction
        DB::commit();

        return redirect()->route('admin.itinerary-templates.index')
            ->with('success', 'Itinerary template updated successfully!');

    } catch (\Exception $e) {
        // Rollback transaction on error
        DB::rollBack();

        return redirect()->back()
            ->withInput()
            ->with('error', 'Error updating itinerary template: ' . $e->getMessage());
    }
}

    public function destroy(ItineraryTemplate $itineraryTemplate)
    {
        $itineraryTemplate->delete();
        return redirect()->route('admin.itinerary-templates.index')
            ->with('success', 'Itinerary template deleted successfully!');
    }
public function downloadPdf(ItineraryTemplate $itineraryTemplate)
{
    $companySetting = \App\Models\CompanySetting::first();

    if (!$companySetting) {
        $companySetting = new \App\Models\CompanySetting([
            'company_name' => 'NORTH TRIPS & TRAVEL',
            'address' => 'Office No 1, 3rd Floor Pearl Plaza, 174 Ferozpur Road, Lahore',
            'email' => 'ntrips20@gmail.com',
            'phone' => '0343-1428730, 0355-5897584',
            'whatsapp' => '0343-1428730'
        ]);
    }

    $viewData = [
        'itineraryTemplate' => $itineraryTemplate,
        'companySetting' => $companySetting,
    ];

    $pdf = PDF::loadView('admin.itinerary-templates.pdf', $viewData)
        ->setPaper('a4', 'portrait')
        ->setOptions([
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true,
            'isFontSubsettingEnabled' => true,
            'defaultFont' => 'DejaVu Sans',
            'dpi' => 96,
            'enable_php' => false,
            'enable_javascript' => false,
            'debugKeepTemp' => false,
            'debugCss' => false,
            'debugLayout' => false,
            'debugLayoutLines' => false,
            'debugLayoutBlocks' => false,
            'debugLayoutInline' => false,
            'debugLayoutPaddingBox' => false,
        ]);

    return $pdf->download("{$itineraryTemplate->trip_code}-itinerary.pdf");
}
public function viewPdf(ItineraryTemplate $itineraryTemplate)
{
    $companySetting = \App\Models\CompanySetting::first();

    if (!$companySetting) {
        $companySetting = new \App\Models\CompanySetting([
            'company_name' => 'NORTH TRIPS & TRAVEL',
            'address' => 'Office No 1, 3rd Floor Pearl Plaza, 174 Ferozpur Road, Lahore',
            'email' => 'ntrips20@gmail.com',
            'phone' => '0343-1428730, 0355-5897584',
            'whatsapp' => '0343-1428730'
        ]);
    }

    return view('admin.itinerary-templates.pdf-preview', [
        'itineraryTemplate' => $itineraryTemplate,
        'companySetting' => $companySetting,
        'isPdf' => false, // This is for view, not actual PDF
    ]);
}
    public function toggleStatus(ItineraryTemplate $itineraryTemplate)
    {
        $itineraryTemplate->update(['is_active' => !$itineraryTemplate->is_active]);

        $status = $itineraryTemplate->is_active ? 'activated' : 'deactivated';
        return redirect()->back()->with('success', "Itinerary template {$status} successfully!");
    }
}
