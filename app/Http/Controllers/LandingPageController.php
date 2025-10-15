<?php

namespace App\Http\Controllers;
use App\Services\MainPage\ImageUploader;
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
        $request->validate([
            'url' => 'required|string|max:255',
        ]);
        
        DB::beginTransaction();
        try {
            $product = LandingPageImage::firstOrCreate([
                'url' => $request->url
            ]);

            if ($request->hasFile('main_image')) {
                // remove previous main image
                $product->clearMediaCollection('main_image');

                $product->addMedia($request->file('main_image'))
                        ->usingName('Main Image')
                        ->withCustomProperties(['slot' => 'main_image'])
                        ->toMediaCollection('main_image');
            }

            for ($i = 1; $i <= 10; $i++) {
                $inputName = "image{$i}";

                if ($request->hasFile($inputName)) {
                    // Find existing image for that slot
                    $oldMedia = $product->getMedia('side_images')
                                        ->where('custom_properties.slot', $inputName)
                                        ->first();

                    // Delete old slot image if found
                    if ($oldMedia) {
                        $oldMedia->delete();
                    }

                    // Add new image for this slot
                    $product->addMedia($request->file($inputName))
                            ->usingName("Image {$i}")
                            ->withCustomProperties(['slot' => $inputName])
                            ->toMediaCollection('side_images');
                }
            }

            DB::commit();
            return redirect()->back()->with('success', 'Images updated successfully.');

        } catch (\Throwable $e) {
            DB::rollBack();
            report($e);
            return back()->withErrors('Upload failed: ' . $e->getMessage());
        }
    }
}