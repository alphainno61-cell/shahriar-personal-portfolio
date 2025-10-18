<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LandingPageController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Landing page
    Route::get('/home/landing-page', [LandingPageController::class, 'index'])->name('home.landing');
    Route::post('/home/landing-page', [LandingPageController::class, 'uploadImage'])->name('home.landing');


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

use App\Http\Controllers\Backend\About\BannerController;
use App\Http\Controllers\Backend\About\AwardController;
use App\Http\Controllers\Backend\About\StoryController;
use App\Http\Controllers\Backend\About\ImpactController;
use App\Http\Controllers\Backend\About\TravelController;
use App\Http\Controllers\Backend\About\CorporateController;
use App\Http\Controllers\Backend\About\AssociateController;


Route::middleware(['auth'])->group(function () {
    Route::resource('banners', BannerController::class);
    Route::resource('awards', AwardController::class);
    Route::resource('stories',StoryController::class);
    Route::resource('impacts',ImpactController::class);
    Route::resource('travels',TravelController::class);
    Route::resource('corporates',CorporateController::class);
    Route::resource('associates',AssociateController::class);
});



use App\Http\Controllers\Backend\Donate\DonationController;
use App\Http\Controllers\Backend\Donate\DonationBannerController;
Route::middleware(['auth'])->group(function () {
    Route::resource('donations', DonationController::class);
    Route::resource('donation-banners', DonationBannerController::class);
 
});
use App\Http\Controllers\Backend\Technology\CertificateController;
use App\Http\Controllers\Backend\Technology\CyberController;

Route::middleware(['auth'])->group(function () {
    Route::resource('certificates', CertificateController::class);
    Route::resource('cybers',CyberController::class);
    
 
});

use App\Http\Controllers\Backend\Technology\TechnologyController;

Route::middleware(['auth'])->group(function () {
   // Fields
    Route::get('technology', [TechnologyController::class,'index'])->name('technology.index');
    Route::get('technology/create', [TechnologyController::class,'createField'])->name('technology.createField');
    Route::post('technology', [TechnologyController::class,'storeField'])->name('technology.storeField');
    Route::get('technology/{field}/edit', [TechnologyController::class,'editField'])->name('technology.editField');
    Route::put('technology/{field}', [TechnologyController::class,'updateField'])->name('technology.updateField');
    Route::delete('technology/{field}', [TechnologyController::class,'destroyField'])->name('technology.destroyField');

    // Skills
    Route::get('technology/{field}/skills/create', [TechnologyController::class,'createSkill'])->name('technology.createSkill');
    Route::post('technology/{field}/skills', [TechnologyController::class,'storeSkill'])->name('technology.storeSkill');
    Route::delete('technology/{field}/skills/{skill}', [TechnologyController::class,'destroySkill'])->name('technology.destroySkill');

    
 
});

