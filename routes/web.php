<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\MainPageController;
use Illuminate\Support\Facades\Route;


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


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
