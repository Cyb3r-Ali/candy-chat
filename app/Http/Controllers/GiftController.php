<?php

namespace App\Http\Controllers;

use App\Models\Gift;
use Illuminate\Http\Request;

class GiftController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $gifts = Gift::all();
        return view('gifts.index', compact('gifts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('gifts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'gift_name' => 'required|string|max:255', // Validate gift name
            'gift_price' => 'required|numeric|min:0', // Validate gift price
            'gift_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate gift image
        ]);

        // Handle file upload
        if ($request->hasFile('gift_image')) {
            // Get the file name with extension
            $imageName = time() . '.' . $request->gift_image->extension();

            // Move the file to the storage path
            $request->gift_image->move(public_path('images'), $imageName);

            // Set the image path
            $imagePath = 'images/' . $imageName;
        }

        // Create a new Gift instance
        $gift = new Gift();

        // Assign values to the Gift instance
        $gift->gift_name = $validatedData['gift_name'];
        $gift->gift_price = $validatedData['gift_price'];
        $gift->gift_image = $imagePath ?? null; // Set the image path if uploaded, otherwise null

        // Save the Gift instance to the database
        $gift->save();

        // Redirect back to the index page with a success message
        return redirect()->route('gifts.index')->with('success', 'Gift added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Gift $gift)
    {
        return view('gifts.show', compact('gift'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gift $gift)
    {
        return view('gifts.edit', compact('gift'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Gift $gift)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'gift_name' => 'required|string|max:255', // Validate gift name
            'gift_price' => 'required|numeric|min:0', // Validate gift price
            'gift_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate gift image (optional)
        ]);

        // Handle file upload if new image is provided
        if ($request->hasFile('gift_image')) {
            // Delete old image if exists
            if ($gift->gift_image && file_exists(public_path($gift->gift_image))) {
                unlink(public_path($gift->gift_image));
            }

            // Get the file name with extension
            $imageName = time() . '.' . $request->gift_image->extension();

            // Move the file to the storage path
            $request->gift_image->move(public_path('images'), $imageName);

            // Set the image path
            $imagePath = 'images/' . $imageName;
        }

        // Update gift details
        $gift->gift_name = $validatedData['gift_name'];
        $gift->gift_price = $validatedData['gift_price'];
        $gift->gift_image = $imagePath ?? $gift->gift_image; // Set the new image path if uploaded, otherwise keep the existing image

        // Save the updated gift details
        $gift->save();

        // Redirect back to the index page with a success message
        return redirect()->route('gifts.index')->with('success', 'Gift updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gift $gift)
    {
        // Delete gift image if exists
        if ($gift->image_path && file_exists(public_path($gift->image_path))) {
            unlink(public_path($gift->image_path));
        }

        // Delete the gift from the database
        $gift->delete();

        // Redirect back to the index page with a success message
        return redirect()->route('gifts.index')->with('success', 'Gift deleted successfully.');
    }
}
