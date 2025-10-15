<?php

use App\Http\Controllers\Api\LandingPageController;
use App\Http\Controllers\Api\MainPageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


// getting landing page images
Route::get('/landing-page-images', [LandingPageController::class, 'getImages']);

// main page
Route::get('/main-page', [MainPageController::class, 'index']);