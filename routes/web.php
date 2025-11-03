<?php

use App\Http\Controllers\Admin\AboutSectionController;
use App\Http\Controllers\Admin\BlogCategoryController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\CarouselController;
use App\Http\Controllers\Admin\CompanySettingController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DestinationCategoryController;
use App\Http\Controllers\Admin\DestinationController;
use App\Http\Controllers\Admin\ExploreTourController;
use App\Http\Controllers\Admin\GalleryCategoryController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SocialMediaLinkController;
use App\Http\Controllers\Admin\SubscriberController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\TourCategoryController;
use App\Http\Controllers\Admin\TravelGuideController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;

// Public Routes
// Public Routes
Route::get('/', [SiteController::class, 'home'])->name('home');
Route::get('/about', [SiteController::class, 'about'])->name('about');
Route::get('/services', [SiteController::class, 'services'])->name('services');
Route::get('/packages', [SiteController::class, 'packages'])->name('packages');
Route::get('/blog', [SiteController::class, 'blog'])->name('blog');
Route::get('/destination', [SiteController::class, 'destination'])->name('destination');
Route::get('/tour', [SiteController::class, 'tour'])->name('tour');
Route::get('/booking', [SiteController::class, 'booking'])->name('booking');
Route::get('/gallery', [SiteController::class, 'gallery'])->name('gallery');
Route::get('/guides', [SiteController::class, 'guides'])->name('guides');
Route::get('/testimonial', [SiteController::class, 'testimonial'])->name('testimonial');
Route::get('/contact', [SiteController::class, 'contact'])->name('contact');

// Auth Routes
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Authentication Routes
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);

// Admin Routes
Route::prefix('admins')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    // Dashboard
    Route::get('/', [DashboardController::class, 'admin'])->name('index');

    // Settings
    Route::get('/company-settings/edit', [CompanySettingController::class, 'edit'])->name('company-settings.edit');
    Route::put('/company-settings/update', [CompanySettingController::class, 'update'])->name('company-settings.update');

    // Carousel
    Route::resource('/carousels', CarouselController::class)->names('carousels');
    Route::post('/carousels/update-order', [CarouselController::class, 'updateOrder'])->name('carousels.update-order');

    // About Sections
    Route::resource('/about-sections', AboutSectionController::class)->names('about-sections');

    // Services
    Route::resource('/services', ServiceController::class)->names('services');
    Route::post('/services/update-order', [ServiceController::class, 'updateOrder'])->name('services.update-order');

    // Destinations
    Route::resource('/destination-categories', DestinationCategoryController::class)->names('destination-categories');
    Route::resource('/destinations', DestinationController::class)->names('destinations');

    // Tours
    Route::resource('/tour-categories', TourCategoryController::class)->names('tour-categories');
    Route::resource('/explore-tours', ExploreTourController::class)->names('explore-tours');

    // Packages
    Route::resource('/packages', PackageController::class)->names('packages');

    // Gallery
    Route::resource('/gallery-categories', GalleryCategoryController::class)->names('gallery-categories');
    Route::resource('/galleries', GalleryController::class)->names('galleries');

    // Content
    Route::resource('/travel-guides', TravelGuideController::class)->names('travel-guides');
    Route::resource('/blogs', BlogController::class)->names('blogs');

    Route::resource('/blog-categories', BlogCategoryController::class)->names('blog-categories');
    Route::resource('/testimonials', TestimonialController::class)->names('testimonials');

    // Social Media
    Route::resource('/social-media-links', SocialMediaLinkController::class)->names('social-media-links');

    // Subscribers
    Route::resource('/subscribers', SubscriberController::class)->names('subscribers');
    Route::get('/subscribers/export/{format}', [SubscriberController::class, 'export'])->name('subscribers.export');
    Route::patch('/subscribers/{subscriber}/activate', [SubscriberController::class, 'activate'])->name('subscribers.activate');
    Route::patch('/subscribers/{subscriber}/deactivate', [SubscriberController::class, 'deactivate'])->name('subscribers.deactivate');
});

require __DIR__ . '/auth.php';