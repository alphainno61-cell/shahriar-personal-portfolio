<?php

namespace App\Http\Controllers;
use App\Services\LandingPage\ImageUploader;
use Illuminate\Http\Request;
use App\Models\LandingPageImage;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\LandingPageImageRequest;

class LandingPageController extends Controller
{
    private $imageUploader;

    public function __construct(ImageUploader $imageUploader)
    {
        $this->imageUploader = $imageUploader;
    }


    // index page
    public function index()
    {
        return view('pages.home.landing');
    }

    public function uploadImage(Request $request)
    {
        return $this->imageUploader->upload($request);
    }
}