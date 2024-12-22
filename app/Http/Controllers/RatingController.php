<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{
  
    public function index()
    {
        $ratings = Rating::all();
        return response()->json($ratings);
    }


    public function store(Request $request, $shop_id, $product_id)
    {
        $request->validate([
            'user_rating_id' => 'required|string',
            'rating' => 'required|min:1|max:5', 
        ]);

        $rating = Rating::create([
            'product_id' => $product_id,
            'user_rating_id' => $request->user_rating_id,
            'rating' => $request->rating,
        ]);

        return response()->json($rating, 201);
    }

    public function show(string $id)
    {
        $rating = Rating::findOrFail($id);
        return response()->json($rating);
    }

   

    public function update(Request $request, string $id)
    {
        $request->validate([
            'user_rating_id' => 'required|string',
            'rating' => 'required|min:1|max:5',
        ]);

        $rating = Rating::findOrFail($id);
        $rating->update([
            'user_rating_id' => $request->user_rating_id,
            'rating' => $request->rating,
        ]);

        return response()->json($rating);
    }


    public function destroy(string $id)
    {
        $rating = Rating::findOrFail($id);
        $rating->delete();
        return response()->json(['message' => 'Rating deleted successfully']);
    }
}