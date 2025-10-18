<?php

namespace App\Http\Controllers\Api\About;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Travel;

class TravelController extends Controller
{
    // List all active travels
    public function index()
    {
        $travels = Travel::where('is_active', 1)
            ->orderBy('order_no')
            ->get()
            ->map(function($travel) {
                return [
                    'id' => $travel->id,
                    'country_name' => $travel->country_name,
                    'country_flag' => $travel->country_flag_path ? asset('storage/'.$travel->country_flag_path) : null,
                    'map_image' => $travel->map_image_path ? asset('storage/'.$travel->map_image_path) : null,
                    'order_no' => $travel->order_no,
                ];
            });

        return response()->json([
            'status' => 'success',
            'data' => $travels,
        ]);
    }

    // Show single travel country
    public function show(Travel $travel)
    {
        if(!$travel->is_active) {
            return response()->json(['status'=>'error','message'=>'Travel not found'], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => [
                'id' => $travel->id,
                'country_name' => $travel->country_name,
                'country_flag' => $travel->country_flag_path ? asset('storage/'.$travel->country_flag_path) : null,
                'map_image' => $travel->map_image_path ? asset('storage/'.$travel->map_image_path) : null,
                'order_no' => $travel->order_no,
            ]
        ]);
    }
}
