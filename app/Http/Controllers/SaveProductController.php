<?php

namespace App\Http\Controllers;

use App\Models\Product;
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
    public function store(Request $request, string $product_id)
    {
        // $request->validate([
        //     'product_type' => 'required|string|max:255',
        // ]);
        $product = Product::find($product_id);

        // $saveProduct = SaveProduct::create([
        //     'product_id' => $product->id,
        //     'shop_id' => $product->shop_id,
        // ]);

        return response()->json($product, 201);
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
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $saveProduct = SaveProduct::findOrFail($id);
        $saveProduct->delete();

        return response()->json(['message' => 'SaveProduct deleted successfully']);
    }
}