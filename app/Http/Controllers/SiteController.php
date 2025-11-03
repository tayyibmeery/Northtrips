<?php

namespace App\Http\Controllers;

use App\Models\AboutSection;
use App\Models\Blog;
use App\Models\Carousel;
use App\Models\CompanySetting;
use App\Models\Destination;
use App\Models\DestinationCategory;
use App\Models\ExploreTour;
use App\Models\GalleryCategory;
use App\Models\Package;
use App\Models\Service;
use App\Models\SocialMediaLink;
use App\Models\Testimonial;
use App\Models\TravelGuide;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    // public function home(Request $request)
    // {
    //     $data = [
    //         'aboutSections' => AboutSection::where('is_active', true)->get(),
    //         'setting' => CompanySetting::first(),
    //         'social' => SocialMediaLink::all(),
    //         'carousels' => Carousel::active()->ordered()->get(),
    //         'services' => Service::active()->ordered()->get(),
    //         'blogs' => Blog::with('category')
    //             ->active()
    //             ->where('status', 'published')
    //             ->ordered()
    //             ->take(3)
    //             ->get(),
    //         'guides' => TravelGuide::active()->ordered()->get(),
    //         'galleryCategories' => GalleryCategory::with([
    //             'galleries' => function ($query) {
    //                 $query->active()->ordered();
    //             }
    //         ])->active()->ordered()->get(),
    //         'packages' => Package::active()->ordered()->get(),
    //         'nationalTours' => ExploreTour::with('category')
    //             ->whereHas('category', function ($query) {
    //                 $query->where('type', 'national');
    //             })
    //             ->active()
    //             ->ordered()
    //             ->get(),
    //         'internationalTours' => ExploreTour::with('category')
    //             ->whereHas('category', function ($query) {
    //                 $query->where('type', 'international');
    //             })
    //             ->active()
    //             ->ordered()
    //             ->get(),
    //         'destinationCategories' => DestinationCategory::active()->ordered()->get(),
    //         'destinations' => Destination::with('category')->active()->ordered()->get(),
    //     ];

    //     if ($request->ajax()) {
    //         return response()->json([
    //             'title' => 'Home - ' . ($data['setting']->company_name ?? 'North Trips & Travel'),
    //             'page_title' => 'Home',
    //             'content' => view('site.pages.home-content', $data)->render()
    //         ]);
    //     }

    //     return view('site.home', $data);
    // }
 public function home(Request $request)
    {
        $data = [
            'aboutSections' => AboutSection::where('is_active', true)->get(),
            'setting' => CompanySetting::first(),
            'social' => SocialMediaLink::all(),
            'carousels' => Carousel::active()->ordered()->get(),
            'services' => Service::active()->ordered()->get(),
            'blogs' => Blog::with('category')
                ->active()
                ->where('status', 'published')
                ->ordered()
                ->take(3)
                ->get(),
            'guides' => TravelGuide::active()->ordered()->get(),
            'galleryCategories' => GalleryCategory::with([
                'galleries' => function ($query) {
                    $query->active()->ordered();
                }
            ])->active()->ordered()->get(),
            'packages' => Package::active()->ordered()->get(),
            'nationalTours' => ExploreTour::with('category')
                ->whereHas('category', function ($query) {
                    $query->where('type', 'national');
                })
                ->active()
                ->ordered()
                ->get(),
            'internationalTours' => ExploreTour::with('category')
                ->whereHas('category', function ($query) {
                    $query->where('type', 'international');
                })
                ->active()
                ->ordered()
                ->get(),
            'destinationCategories' => DestinationCategory::active()->ordered()->get(),
            'destinations' => Destination::with('category')->active()->ordered()->get(),
            'testimonials' => Testimonial::active()->ordered()->get(), // Add this line
        ];

        if ($request->ajax()) {
            return response()->json([
                'title' => 'Home - ' . ($data['setting']->company_name ?? 'North Trips & Travel'),
                'page_title' => 'Home',
                'content' => view('site.pages.home-content', $data)->render(),
                'carousels' => $data['carousels']
            ]);
        }

        return view('site.home', $data);
    }

    public function testimonial(Request $request)
    {
        $data = [
            'setting' => CompanySetting::first(),
            'social' => SocialMediaLink::all(),
            'testimonials' => Testimonial::active()->ordered()->get(),
        ];

        if ($request->ajax()) {
            return response()->json([
                'title' => 'Testimonials - ' . ($data['setting']->company_name ?? 'North Trips & Travel'),
                'page_title' => 'Testimonials',
                'content' => view('site.pages.testimonial-content', $data)->render()
            ]);
        }

        return view('site.pages.testimonial', $data);
    }
    public function about(Request $request)
    {
        $data = [
            'setting' => CompanySetting::first(),
            'social' => SocialMediaLink::all(),
            'aboutSections' => AboutSection::where('is_active', true)->get(),
            'guides' => TravelGuide::active()->ordered()->get(),
        ];

        if ($request->ajax()) {
            return response()->json([
                'title' => 'About Us - ' . ($data['setting']->company_name ?? 'North Trips & Travel'),
                'page_title' => 'About Us',
                'content' => view('site.pages.about-content', $data)->render()
            ]);
        }

        return view('site.pages.about', $data);
    }

    public function services(Request $request)
    {
        $data = [
            'setting' => CompanySetting::first(),
            'social' => SocialMediaLink::all(),
            'services' => Service::active()->ordered()->get(),
        ];

        if ($request->ajax()) {
            return response()->json([
                'title' => 'Our Services - ' . ($data['setting']->company_name ?? 'North Trips & Travel'),
                'page_title' => 'Our Services',
                'content' => view('site.pages.services-content', $data)->render()
            ]);
        }

        return view('site.pages.services', $data);
    }

    public function packages(Request $request)
    {
        $data = [
            'setting' => CompanySetting::first(),
            'social' => SocialMediaLink::all(),
            'packages' => Package::active()->ordered()->get(),
        ];

        if ($request->ajax()) {
            return response()->json([
                'title' => 'Packages - ' . ($data['setting']->company_name ?? 'North Trips & Travel'),
                'page_title' => 'Packages',
                'content' => view('site.pages.packages-content', $data)->render()
            ]);
        }

        return view('site.pages.packages', $data);
    }

    public function blog(Request $request)
    {
        $data = [
            'setting' => CompanySetting::first(),
            'social' => SocialMediaLink::all(),
            'blogs' => Blog::with('category')
                ->active()
                ->where('status', 'published')
                ->ordered()
                ->paginate(6),
        ];

        if ($request->ajax()) {
            return response()->json([
                'title' => 'Blog - ' . ($data['setting']->company_name ?? 'North Trips & Travel'),
                'page_title' => 'Blog',
                'content' => view('site.pages.blog-content', $data)->render()
            ]);
        }

        return view('site.pages.blog', $data);
    }

    public function destination(Request $request)
    {
        $data = [
            'setting' => CompanySetting::first(),
            'social' => SocialMediaLink::all(),
            'destinationCategories' => DestinationCategory::active()->ordered()->get(),
            'destinations' => Destination::with('category')->active()->ordered()->get(),
        ];

        if ($request->ajax()) {
            return response()->json([
                'title' => 'Destinations - ' . ($data['setting']->company_name ?? 'North Trips & Travel'),
                'page_title' => 'Destinations',
                'content' => view('site.pages.destination-content', $data)->render()
            ]);
        }

        return view('site.pages.destination', $data);
    }

    public function gallery(Request $request)
    {
        $data = [
            'setting' => CompanySetting::first(),
            'social' => SocialMediaLink::all(),
            'galleryCategories' => GalleryCategory::with([
                'galleries' => function ($query) {
                    $query->active()->ordered();
                }
            ])->active()->ordered()->get(),
        ];

        if ($request->ajax()) {
            return response()->json([
                'title' => 'Gallery - ' . ($data['setting']->company_name ?? 'North Trips & Travel'),
                'page_title' => 'Gallery',
                'content' => view('site.pages.gallery-content', $data)->render()
            ]);
        }

        return view('site.pages.gallery', $data);
    }

    public function guides(Request $request)
    {
        $data = [
            'setting' => CompanySetting::first(),
            'social' => SocialMediaLink::all(),
            'guides' => TravelGuide::active()->ordered()->get(),
        ];

        if ($request->ajax()) {
            return response()->json([
                'title' => 'Travel Guides - ' . ($data['setting']->company_name ?? 'North Trips & Travel'),
                'page_title' => 'Travel Guides',
                'content' => view('site.pages.guides-content', $data)->render()
            ]);
        }

        return view('site.pages.guides', $data);
    }

    public function tour(Request $request)
    {
        $data = [
            'setting' => CompanySetting::first(),
            'social' => SocialMediaLink::all(),
            'nationalTours' => ExploreTour::with('category')
                ->whereHas('category', function ($query) {
                    $query->where('type', 'national');
                })
                ->active()
                ->ordered()
                ->get(),
            'internationalTours' => ExploreTour::with('category')
                ->whereHas('category', function ($query) {
                    $query->where('type', 'international');
                })
                ->active()
                ->ordered()
                ->get(),
        ];

        if ($request->ajax()) {
            return response()->json([
                'title' => 'Explore Tours - ' . ($data['setting']->company_name ?? 'North Trips & Travel'),
                'page_title' => 'Explore Tours',
                'content' => view('site.pages.tour-content', $data)->render()
            ]);
        }

        return view('site.pages.tour', $data);
    }

    public function booking(Request $request)
    {
        $data = [
            'setting' => CompanySetting::first(),
            'social' => SocialMediaLink::all(),
        ];

        if ($request->ajax()) {
            return response()->json([
                'title' => 'Tour Booking - ' . ($data['setting']->company_name ?? 'North Trips & Travel'),
                'page_title' => 'Tour Booking',
                'content' => view('site.pages.booking-content', $data)->render()
            ]);
        }

        return view('site.pages.booking', $data);
    }

 

    public function contact(Request $request)
    {
        $data = [
            'setting' => CompanySetting::first(),
            'social' => SocialMediaLink::all(),
        ];

        if ($request->ajax()) {
            return response()->json([
                'title' => 'Contact Us - ' . ($data['setting']->company_name ?? 'North Trips & Travel'),
                'page_title' => 'Contact Us',
                'content' => view('site.pages.contact-content', $data)->render()
            ]);
        }

        return view('site.pages.contact', $data);
    }
}