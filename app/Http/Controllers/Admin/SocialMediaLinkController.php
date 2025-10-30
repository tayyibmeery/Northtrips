<?php
// app/Http/Controllers/Admin/SocialMediaLinkController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SocialMediaLink;
use Illuminate\Http\Request;

class SocialMediaLinkController extends Controller
{
    public function index()
    {
        $socialMediaLinks = SocialMediaLink::all();
        return view('admin.social-media-links.index', compact('socialMediaLinks'));
    }

    public function create()
    {
        return view('admin.social-media-links.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'platform_name' => 'required|string|max:255',
            'icon_class' => 'required|string|max:255',
            'url' => 'required|url',
            'status' => 'boolean',
        ]);

        SocialMediaLink::create([
            'platform_name' => $request->platform_name,
            'icon_class' => $request->icon_class,
            'url' => $request->url,
            'status' => $request->status ?? true,
        ]);

        return redirect()->route('admin.social-media-links.index')
            ->with('success', 'Social media link created successfully.');
    }

    public function edit(SocialMediaLink $socialMediaLink)
    {
        return view('admin.social-media-links.edit', compact('socialMediaLink'));
    }

    public function update(Request $request, SocialMediaLink $socialMediaLink)
    {
        $request->validate([
            'platform_name' => 'required|string|max:255',
            'icon_class' => 'required|string|max:255',
            'url' => 'required|url',
            'status' => 'boolean',
        ]);

        $socialMediaLink->update([
            'platform_name' => $request->platform_name,
            'icon_class' => $request->icon_class,
            'url' => $request->url,
            'status' => $request->status ?? true,
        ]);

        return redirect()->route('admin.social-media-links.index')
            ->with('success', 'Social media link updated successfully.');
    }

    public function destroy(SocialMediaLink $socialMediaLink)
    {
        $socialMediaLink->delete();

        return redirect()->route('admin.social-media-links.index')
            ->with('success', 'Social media link deleted successfully.');
    }
}