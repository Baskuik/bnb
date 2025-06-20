<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::latest()->get();
        return view('reviews', compact('reviews'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'naam' => 'required|string|max:255',
            'review' => 'required|string|max:1000',
        ]);

        Review::create($validated);

        return redirect()->route('reviews.index')->with('success', 'Bedankt voor je review!');
    }
}
