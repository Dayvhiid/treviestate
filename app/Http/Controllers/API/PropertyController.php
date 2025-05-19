<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Property;

class PropertyController extends Controller
{
    public function index() {
    return Property::latest()->paginate(10);
}

public function store(Request $request) {
    $validated = $request->validate([
        'image' => 'required|image|max:2048',
        'price' => 'required|numeric',
        'location' => 'required|string',
        'description' => 'required|string',
    ]);

    if ($request->hasFile('image')) {
        $path = $request->file('image')->store('properties', 'public');
        $validated['image'] = $path;
    }

    $validated['user_id'] = $request->user()->id;

    $property = Property::create($validated);

    return response()->json($property, 201);
}


public function myProperties(Request $request)
{
    $user = $request->user();
    $properties = $user->properties()->latest()->get();
    return response()->json($properties);
}


}
