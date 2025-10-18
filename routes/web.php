<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\BlogController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MainPageController;
use App\Http\Controllers\BookBannerController;
use App\Http\Controllers\EntrepreneurshipBannerController;
use App\Http\Controllers\SocialLinkController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\EventActivityController;
use App\Http\Controllers\PublicationSummeryController;
use App\Http\Controllers\RecommendedBookController;

Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Landing page
    Route::get('/home/landing-page', [LandingPageController::class, 'index'])->name('home.landing');
    Route::post('/home/landing-page', [LandingPageController::class, 'uploadImage'])->name('home.landing');


    // main page
    Route::get('/home/main-page', [MainPageController::class, 'index'])->name('main.page.index');
    Route::post('/home/main-page', [MainPageController::class, 'store'])->name('main.page.index');

    // blogs
    Route::resource('/blogs', BlogController::class);

    // book banners
    Route::resource('/book-banners', BookBannerController::class);

    // recommended books
    Route::resource('/recommended-books', RecommendedBookController::class);
    Route::delete('recommended-books/image/{media}', [RecommendedBookController::class, 'destroyImage'])->name('recommended-books.image.destroy');

    // publication summery
    Route::resource('/publication-summery', PublicationSummeryController::class);

    // event
    Route::resource('/events', EventController::class);

    // event activities
    Route::resource('/event-activities', EventActivityController::class);
    Route::delete('/event-activities/remove-image/{media}', [EventActivityController::class, 'removeImage'])
    ->name('event-activities.remove-image');

    // enterpreneurship banner
    Route::resource('/enterpreneurship-banners', EntrepreneurshipBannerController::class);

    // social links
    Route::get('/social-links', [SocialLinkController::class, 'index'])->name('social-links');
    Route::post('/social-links', [SocialLinkController::class, 'store'])->name('social-links');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
