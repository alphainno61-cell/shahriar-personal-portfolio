<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\About\BannerController;
use App\Http\Controllers\Api\About\AwardController;
use App\Http\Controllers\Api\About\StoryController;
use App\Http\Controllers\Api\About\ImpactController;
use App\Http\Controllers\Api\About\TravelController;
use App\Http\Controllers\Api\About\CorporateController;
use App\Http\Controllers\Api\About\AssociateController;
use App\Http\Controllers\Api\Donate\DonationController;
use App\Http\Controllers\Backend\Donate\DonationBannerController;
use App\Http\Controllers\Api\Technology\TechnologyController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


// Route::apiResources([
//     'banners' => BannerController::class,
//     'awards'=>AwardController::class,
//     'stories'=>StoryController::class,
//     'impacts'=>ImpactController::class,  
//     'travels'=>TravelController::class, 
//     'corporates'=>CorporateController::class, 
//     'associates'=>AssociateController::class, 
//     'donations'=>DonationController::class, 
//     'donation-banners'=>DonationBannerController::class,
//     'technology'=>TechnologyController::class,

    
// ]);
