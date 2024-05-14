<?php

namespace App\Http\Controllers;

use App\Models\Point;
use App\Models\User;
use Illuminate\Http\Request;

use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;


class PointController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $points = Point::Latest()->get();
        return view('points.index', compact('points'));
    }

    /** 
     * Search user by email
     */
    public function search(Request $request)
    {
        $search = $request->input('email');
        $user = User::where('email', $search)->first();
        return view('points.create', compact('user'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('points.search');
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        // Validate the form data
        $validator = Validator::make($request->all(), [
            'email' => 'required|email', // Validate email format
            'points' => 'required|integer|min:1', // Validate points field as positive integer
            'payment_type' => 'required|string', // Validate payment type
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Retrieve the user by email
        $user = User::where('email', $request->input('email'))->first();

        // Check if user exists
        if (!$user) {
            return redirect()->back()->withErrors(['email' => 'User with provided email not found.'])->withInput();
        }

        // Create a new Point instance
        $point = new Point();

        // Generate the current date
        $date = Carbon::now()->format('Y-m-d'); // Format date as YYYY-MM-DD

        // Assign values to the Point instance
        $point->user_id = $user->id;
        $point->points = $request->input('points');
        $point->payment_type = $request->input('payment_type');
        $point->date = $date; // Assuming there's a date field in the Point model
        $point->user_email = $user->email; // Assuming there's a date field in the Point model
        $point->user_name = $user->nickname; // Assuming there's a date field in the Point model

        // Save the Point instance to the database
        $point->save();

        // Redirect back to the page with a success message or any other desired page
        return redirect()->route('points.index')->with('success', 'Points given successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Retrieve the point record from the database
        $point = Point::findOrFail($id);

        // Return the view with the retrieved point record
        return view('points.show', compact('point'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Retrieve the point record from the database
        $point = Point::findOrFail($id);

        // Return the view with the retrieved point record for editing
        return view('points.edit', compact('point'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate the form data
        $validator = Validator::make($request->all(), [
            'points' => 'required|integer|min:1', // Validate points field as positive integer
            'payment_type' => 'required|string', // Validate payment type
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Retrieve the point record from the database
        $point = Point::findOrFail($id);

        // Update the point record with the new values
        $point->points = $request->input('points');
        $point->payment_type = $request->input('payment_type');

        // Save the updated point record
        $point->save();

        // Redirect back to the page with a success message or any other desired page
        return redirect()->route('points.index')->with('success', 'Points updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Retrieve the point record from the database
        $point = Point::findOrFail($id);

        // Delete the point record
        $point->delete();

        // Redirect back to the page with a success message or any other desired page
        return redirect()->route('points.index')->with('success', 'Point deleted successfully.');
    }
}
