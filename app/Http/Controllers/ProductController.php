<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Shop;
use Auth;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return response()->json($products);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'required|string|max:255',
            'keywords' => 'nullable|json',
            'language' => 'nullable|string|max:50',
            'price' => 'required|numeric|min:0',
            'image_base_url' => 'required|string',
            'average_rating' => 'nullable|numeric|min:0|max:5',
            'view_count' => 'nullable|integer|min:0',
        ]);

        if (!Auth::check()) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }


        $shop_id = $request->shop_id;
        $shop = Shop::find($shop_id);

        if( $shop->user_owner_id!=Auth::id()){
            return response()->json(["permission" => "You are not the owner of this shop"], 403);
        }


        $validated["shop_id"] = $shop_id;
        $validated["user_owner_id"] = Auth::id();

        $product = Product::create($validated);
        return response()->json($product, 201);
    }

    
    public function show(string $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        return response()->json($product);
    }

   
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $shop_id, string $id)
    {
        $shop = Shop::find($shop_id);

        if( $shop->user_owner_id != Auth::id()){
            return response()->json(["permission" => "You are not the owner of this shop"], 403);
        }

        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'required|string|max:255',
            'keywords' => 'nullable|json',
            'language' => 'nullable|string|max:50',
            'price' => 'required|numeric|min:0',
            'image_base_url' => 'required|string',
            'average_rating' => 'nullable|numeric|min:0|max:5',
            'view_count' => 'nullable|integer|min:0',
        ]);

       
        $product->update($validated);

        return response()->json($product);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $shop_id, string $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }
      
        $shop = Shop::find($shop_id);

        if( $shop->user_owner_id != Auth::id()){
            return response()->json(["permission" => "You are not the owner of this shop"], 403);
        }

        $product->delete();
        return response()->json(['message' => 'Product deleted successfully']);
    }
}