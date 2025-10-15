<?php

namespace App\Services\LandingPage;

use App\Models\LandingPageImage;
use Illuminate\Support\Facades\DB;

class ImageUploader
{
    public function upload($request) {
        
        // DB::beginTransaction();
        // try {
        //     $product = LandingPageImage::create([
        //         'url' => $request->url
        //     ]);

        //     // add main image (single file collection)
        //     if ($request->hasFile('main_image')) {
        //         $product->addMedia($request->file('main_image'))
        //                 ->usingName('Main Image')
        //                 ->withCustomProperties(['slot' => 'main_image'])
        //                 ->toMediaCollection('main_image');
        //     }

        //     // add side images to single collection, with slot custom property
        //     for ($i = 1; $i <= 10; $i++) {
        //         $inputName = "image{$i}";
        //         if ($request->hasFile($inputName)) {
        //             $product->addMedia($request->file($inputName))
        //                     ->usingName("Image {$i}")
        //                     ->withCustomProperties(['slot' => $inputName])
        //                     ->toMediaCollection('side_images');
        //         }
        //     }

        //     DB::commit();
        //     return redirect()->back()->with('success', 'Product created and images uploaded.');
        // } catch (\Throwable $e) {
        //     DB::rollBack();
        //     report($e);
        //     return back()->withErrors('Upload failed: ' . $e->getMessage());
        // }

        DB::beginTransaction();
        try {
            // Create or reuse record (adjust based on your logic)
            $product = LandingPageImage::firstOrCreate([
                'url' => $request->url
            ]);

            // 🟢 Handle main image (replace if new one is uploaded)
            if ($request->hasFile('main_image')) {
                // remove previous main image
                $product->clearMediaCollection('main_image');

                $product->addMedia($request->file('main_image'))
                        ->usingName('Main Image')
                        ->withCustomProperties(['slot' => 'main_image'])
                        ->toMediaCollection('main_image');
            }

            // 🟢 Handle side images (replace only specific slots)
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
