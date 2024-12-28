<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\SaveProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SaveProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = SaveProduct::where('user_saved_id', 2)->get();
        return response()->json($products);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, string $product_id)
    {
        $product = Product::find($product_id);
        $saveProduct = SaveProduct::create([
            'title'=> $product -> title,
            'product_id' => $product -> id,
            'user_saved_id'=> Auth::id(), 
            'shop_id' => $product -> shop_id,
            'description' => $product -> description,
            'category' => $product -> category,
            'price' => $product -> price,
            'currency' => $product -> currency,
            'product_type' => $product -> category,
            'image_base_url'=> $product -> image_base_url,
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
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $saveProduct = SaveProduct::findOrFail($id);
        $saveProduct->delete();

        return response()->json(['message' => 'SaveProduct deleted successfully']);
    }
}