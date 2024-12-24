<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Auth;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function index()
    {
        $ratings = Rating::all();
        return response()->json($ratings);
    }


    public function store(Request $request, string $shop_id, string $product_id)
    {
        $request->validate([
            'rating' => 'required|min:1|max:5',
        ]);
        
        $rating = Rating::create([
            'product_id' => $product_id,
            'user_rating_id' => Auth::id(),
            'rating' => $request->rating,
        ]);

        return response()->json($rating, 201);
    }

    public function show( string $shop_id, string $product_id, string $id)
    {
        $rating = Rating::findOrFail($id);
        return response()->json($rating);
    }


    public function update(Request $request, string $shop_id, string $product_id, string $id)
    {
        $validated= $request->validate([
            'rating' => 'required|min:1|max:5',
        ]);

        $rating = Rating::findOrFail($id);
        $rating->update($validated);
        return response()->json($rating);
    }


    public function destroy(string $shop_id, string $product_id, string $id)
    {
        $rating = Rating::findOrFail($id);
        $rating->delete();
        return response()->json(['message' => 'Rating deleted successfully']);
    }
}