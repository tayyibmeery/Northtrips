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
    private function getCommonData()
    {
        return [
            'setting' => CompanySetting::first(),
            'social' => SocialMediaLink::all(),
        ];
    }

    public function home(Request $request)
    {
        $data = array_merge($this->getCommonData(), [
            'aboutSections' => AboutSection::where('is_active', true)->get(),
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
            'testimonials' => Testimonial::active()->ordered()->get(),
        ]);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'title' => 'Home - ' . ($data['setting']->company_name ?? 'North Trips & Travel'),
                'page_title' => 'Home',
                'show_carousel' => true,
                'content' => view('site.pages.home-content', $data)->render(),
            ]);
        }

        return view('site.home', $data);
    }

    public function about(Request $request)
    {
        $data = array_merge($this->getCommonData(), [
            'aboutSections' => AboutSection::where('is_active', true)->get(),
            'guides' => TravelGuide::active()->ordered()->get(),
        ]);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'title' => 'About Us - ' . ($data['setting']->company_name ?? 'North Trips & Travel'),
                'page_title' => 'About Us',
                'show_carousel' => false,
                'content' => view('site.pages.about-content', $data)->render()
            ]);
        }

        return view('site.pages.about', $data);
    }

    public function services(Request $request)
    {
        $data = array_merge($this->getCommonData(), [
            'services' => Service::active()->ordered()->get(),
        ]);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'title' => 'Our Services - ' . ($data['setting']->company_name ?? 'North Trips & Travel'),
                'page_title' => 'Our Services',
                'show_carousel' => false,
                'content' => view('site.pages.services-content', $data)->render()
            ]);
        }

        return view('site.pages.services', $data);
    }

    public function packages(Request $request)
    {
        $data = array_merge($this->getCommonData(), [
            'packages' => Package::active()->ordered()->get(),
        ]);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'title' => 'Packages - ' . ($data['setting']->company_name ?? 'North Trips & Travel'),
                'page_title' => 'Packages',
                'show_carousel' => false,
                'content' => view('site.pages.packages-content', $data)->render()
            ]);
        }

        return view('site.pages.packages', $data);
    }

    public function blog(Request $request)
    {
        $data = array_merge($this->getCommonData(), [
            'blogs' => Blog::with('category')
                ->active()
                ->where('status', 'published')
                ->ordered()
                ->paginate(6),
        ]);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'title' => 'Blog - ' . ($data['setting']->company_name ?? 'North Trips & Travel'),
                'page_title' => 'Blog',
                'show_carousel' => false,
                'content' => view('site.pages.blog-content', $data)->render()
            ]);
        }

        return view('site.pages.blog', $data);
    }

    public function destination(Request $request)
    {
        $data = array_merge($this->getCommonData(), [
            'destinationCategories' => DestinationCategory::active()->ordered()->get(),
            'destinations' => Destination::with('category')->active()->ordered()->get(),
        ]);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'title' => 'Destinations - ' . ($data['setting']->company_name ?? 'North Trips & Travel'),
                'page_title' => 'Destinations',
                'show_carousel' => false,
                'content' => view('site.pages.destination-content', $data)->render()
            ]);
        }

        return view('site.pages.destination', $data);
    }

    public function gallery(Request $request)
    {
        $data = array_merge($this->getCommonData(), [
            'galleryCategories' => GalleryCategory::with([
                'galleries' => function ($query) {
                    $query->active()->ordered();
                }
            ])->active()->ordered()->get(),
        ]);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'title' => 'Gallery - ' . ($data['setting']->company_name ?? 'North Trips & Travel'),
                'page_title' => 'Gallery',
                'show_carousel' => false,
                'content' => view('site.pages.gallery-content', $data)->render()
            ]);
        }

        return view('site.pages.gallery', $data);
    }

    public function guides(Request $request)
    {
        $data = array_merge($this->getCommonData(), [
            'guides' => TravelGuide::active()->ordered()->get(),
        ]);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'title' => 'Travel Guides - ' . ($data['setting']->company_name ?? 'North Trips & Travel'),
                'page_title' => 'Travel Guides',
                'show_carousel' => false,
                'content' => view('site.pages.guides-content', $data)->render()
            ]);
        }

        return view('site.pages.guides', $data);
    }

    public function tour(Request $request)
    {
        $data = array_merge($this->getCommonData(), [
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
        ]);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'title' => 'Explore Tours - ' . ($data['setting']->company_name ?? 'North Trips & Travel'),
                'page_title' => 'Explore Tours',
                'show_carousel' => false,
                'content' => view('site.pages.tour-content', $data)->render()
            ]);
        }

        return view('site.pages.tour', $data);
    }

    public function booking(Request $request)
    {
        $data = $this->getCommonData();

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'title' => 'Tour Booking - ' . ($data['setting']->company_name ?? 'North Trips & Travel'),
                'page_title' => 'Tour Booking',
                'show_carousel' => false,
                'content' => view('site.pages.booking-content', $data)->render()
            ]);
        }

        return view('site.pages.booking', $data);
    }

    public function testimonial(Request $request)
    {
        $data = array_merge($this->getCommonData(), [
            'testimonials' => Testimonial::active()->ordered()->get(),
        ]);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'title' => 'Testimonials - ' . ($data['setting']->company_name ?? 'North Trips & Travel'),
                'page_title' => 'Testimonials',
                'show_carousel' => false,
                'content' => view('site.pages.testimonial-content', $data)->render()
            ]);
        }

        return view('site.pages.testimonial', $data);
    }

    public function contact(Request $request)
    {
        $data = $this->getCommonData();

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'title' => 'Contact Us - ' . ($data['setting']->company_name ?? 'North Trips & Travel'),
                'page_title' => 'Contact Us',
                'show_carousel' => false,
                'content' => view('site.pages.contact-content', $data)->render()
            ]);
        }

        return view('site.pages.contact', $data);
    }
}
