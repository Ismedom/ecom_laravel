<?php

namespace App\Http\Controllers;

use App\Models\SaveProduct;
use Illuminate\Http\Request;

class SaveProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = SaveProduct::all();
        return response()->json($products);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|string|max:255',
            'product_type' => 'required|string|max:255',
        ]);

        $saveProduct = SaveProduct::create([
            'product_id' => $request->product_id,
            'product_type' => $request->product_type,
        ]);

        return response()->json($saveProduct, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $saveProduct = SaveProduct::findOrFail($id);
        return response()->json($saveProduct);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'product_id' => 'sometimes|string|max:255',
            'product_type' => 'sometimes|string|max:255',
        ]);

        $saveProduct = SaveProduct::findOrFail($id);
        $saveProduct->update($request->all());

        return response()->json($saveProduct);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $saveProduct = SaveProduct::findOrFail($id);
        $saveProduct->delete();

        return response()->json(['message' => 'SaveProduct deleted successfully']);
    }
}