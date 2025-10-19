<?php

namespace App\Http\Controllers\Backend\About;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Travel;

class TravelController extends Controller
{
    public function index()
    {
        $travels = Travel::orderBy('order_no')->get();
        return view('pages.travels.index', compact('travels'));
    }

    public function create()
    {
        return view('pages.travels.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'country_name' => 'required|string|max:255',
            'country_flag_path' => 'nullable|image|mimes:png,jpg,jpeg,svg|max:5048',
            'map_image_path' => 'nullable|image|mimes:png,jpg,jpeg|max:5096',
            'order_no' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        if($request->hasFile('country_flag_path')){
            $data['country_flag_path'] = $request->file('country_flag_path')->store('travels', 'public');
        }
        if($request->hasFile('map_image_path')){
            $data['map_image_path'] = $request->file('map_image_path')->store('travels', 'public');
        }

        $data['is_active'] = $request->has('is_active') ? 1 : 0;

        Travel::create($data);

        return redirect()->route('travels.index')->with('success', 'Travel country added successfully.');
    }

    public function show(Travel $travel)
    {
        return view('pages.travels.show', compact('travel'));
    }

    public function edit(Travel $travel)
    {
        return view('pages.travels.edit', compact('travel'));
    }

    public function update(Request $request, Travel $travel)
    {
        $data = $request->validate([
            'country_name' => 'required|string|max:255',
            'country_flag_path' => 'nullable|image|mimes:png,jpg,jpeg,svg|max:5048',
            'map_image_path' => 'nullable|image|mimes:png,jpg,jpeg|max:5096',
            'order_no' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        if($request->hasFile('country_flag_path')){
            $data['country_flag_path'] = $request->file('country_flag_path')->store('travels', 'public');
        }
        if($request->hasFile('map_image_path')){
            $data['map_image_path'] = $request->file('map_image_path')->store('travels', 'public');
        }

        $data['is_active'] = $request->has('is_active') ? 1 : 0;

        $travel->update($data);

        return redirect()->route('travels.index')->with('success', 'Travel country updated successfully.');
    }

    public function destroy(Travel $travel)
    {
        $travel->delete();
        return redirect()->route('travels.index')->with('success', 'Travel country deleted successfully.');
    }
}
