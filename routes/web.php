<?php

use App\Http\Controllers\Admin\CompanySettingController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SocialMediaLinkController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});






Route::get('/', [SiteController::class, 'home'])->name('home');
Route::get('/aboutus', [SiteController::class, 'aboutus'])->name('aboutus');
Route::get('/blog', [SiteController::class, 'blog'])->name('blog');




Route::prefix('admins')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'admin'])->name('index');
    Route::get('/company-settings/edit', [CompanySettingController::class, 'edit'])->name('company-settings.edit');
    Route::put('/company-settings/update', [CompanySettingController::class, 'update'])->name('company-settings.update');
    Route::resource('/social-media-links', SocialMediaLinkController::class)->names('social-media-links');

});
require __DIR__.'/auth.php';
