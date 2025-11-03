<?php

use App\Http\Controllers\Admin\AboutSectionController;
use App\Http\Controllers\Admin\BlogCategoryController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;
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
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;

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

// Booking routes
Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');
Route::get('/booking/destinations', [BookingController::class, 'getDestinations'])->name('booking.destinations');

// Subscribe route
Route::post('/subscribe', [SubscriberController::class, 'subscribe'])->name('subscribe');

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

// Admin Routes - FIXED PREFIX
Route::prefix('admins')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    // Dashboard
    Route::get('/', [DashboardController::class, 'admin'])->name('index');

    // Settings
    Route::get('/company-settings/edit', [CompanySettingController::class, 'edit'])->name('company-settings.edit');
    Route::put('/company-settings/update', [CompanySettingController::class, 'update'])->name('company-settings.update');

    // Carousel
    Route::resource('/carousels', CarouselController::class);
    Route::post('/carousels/update-order', [CarouselController::class, 'updateOrder'])->name('carousels.update-order');

    // About Sections
    Route::resource('/about-sections', AboutSectionController::class);

    // Services
    Route::resource('/services', ServiceController::class);
    Route::post('/services/update-order', [ServiceController::class, 'updateOrder'])->name('services.update-order');

    // Destinations
    Route::resource('/destination-categories', DestinationCategoryController::class);
    Route::resource('/destinations', DestinationController::class);

    // Tours
    Route::resource('/tour-categories', TourCategoryController::class);
    Route::resource('/explore-tours', ExploreTourController::class);

    // Packages
    Route::resource('/packages', PackageController::class);

    // Gallery
    Route::resource('/gallery-categories', GalleryCategoryController::class);
    Route::resource('/galleries', GalleryController::class);

    // Content
    Route::resource('/travel-guides', TravelGuideController::class);
    Route::resource('/blogs', BlogController::class);
    Route::resource('/blog-categories', BlogCategoryController::class);
    Route::resource('/testimonials', TestimonialController::class);

    // Social Media
    Route::resource('/social-media-links', SocialMediaLinkController::class);

    // Subscribers
    Route::resource('/subscribers', SubscriberController::class);
    Route::get('/subscribers/export/{format}', [SubscriberController::class, 'export'])->name('subscribers.export');
    Route::patch('/subscribers/{subscriber}/activate', [SubscriberController::class, 'activate'])->name('subscribers.activate');
    Route::patch('/subscribers/{subscriber}/deactivate', [SubscriberController::class, 'deactivate'])->name('subscribers.deactivate');

    // Bookings - FIXED ROUTES
    Route::resource('/bookings', AdminBookingController::class);
    Route::get('/bookings/statistics', [AdminBookingController::class, 'statistics'])->name('bookings.statistics');
});

require __DIR__ . '/auth.php';