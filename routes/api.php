<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BlogController;
use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\QuoteController;
use App\Http\Controllers\Api\MainPageController;
use App\Http\Controllers\Api\InnovationController;
use App\Http\Controllers\Api\BooksBannerController;
use App\Http\Controllers\Api\LandingPageController;
use App\Http\Controllers\Api\RecommendedBooksController;
use App\Http\Controllers\Api\PublicationSummeryController;
use App\Http\Controllers\Api\EntrepreneurshipBannerController;
use App\Http\Controllers\Api\SocialLinkController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


// getting landing page images
Route::get('/landing-page-images', [LandingPageController::class, 'getImages']);

// main page
Route::get('/main-page', [MainPageController::class, 'index']);

// blogs
Route::get('/blogs', [BlogController::class, 'index']);
Route::get('blog/{id}', [BlogController::class, 'show']);
Route::get('/blogs/search', [BlogController::class, 'search']);

// books banner
Route::get('/books-banner', [BooksBannerController::class, 'index']);

// recommended books
Route::get('/recommended-books', [RecommendedBooksController::class, 'index']);

// publication summery
Route::get('/publication-summery', [PublicationSummeryController::class, 'index']);

// event
Route::get('/events', [EventController::class, 'index']);
Route::get('/events/last-activity', [EventController::class, 'lastActivity']);

// entrepreneurship banner
Route::get('/entrepreneurship-banner', [EntrepreneurshipBannerController::class, 'index']);

// innovation
Route::get('/innovations', [InnovationController::class, 'index']);

// qoute
Route::get('/quotes', [QuoteController::class, 'index']);

// social media links
Route::get('/social-links', [SocialLinkController::class, 'index']);