<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\View;
use Illuminate\Support\Facades\Auth;

class ViewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $views = View::all();
        return response()->json($views);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(string $product_id)
    {
        $product = Product::find($product_id);
        $view = View::create([
            'viewer_id' => Auth::id(),
            'product_id' => $product->id,
        ]);
        return response()->json(['message' => 'View count added successfully', 'data' =>  $view], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $view = View::find($id);
        if (!$view) {
            return response()->json(['message' => 'View count not found'], 404);
        }
        return response()->json($view);
    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, string $id)
    // {
    //     $validatedData = $request->validate([
    //         'viewer_id' => 'string',
    //         'product_id' => 'string',
    //     ]);

    //     $view = View::find($id);

    //     if (!$view) {
    //         return response()->json(['message' => 'View count not found'], 404);
    //     }

    //     $view->update($validatedData);
    //     return response()->json(['message' => 'View count updated successfully', 'data' => $view]);
    // }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $view = View::find($id);

        if (!$view) {
            return response()->json(['message' => 'View count not found'], 404);
        }
        $view->delete();
        return response()->json(['message' => 'View count deleted successfully']);
    }
}