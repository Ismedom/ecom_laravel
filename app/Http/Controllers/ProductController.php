<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Shop;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Auth;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        echo auth()->id();
        $products = Product::all();
        return response()->json($products);
    }
    public function filter(Request $request)
    {
        // dd("searching");
        $request->validate([
            'query' => 'required|string',
        ]);

        $query = Product::query();
        if ($request->filled('title')) {
            $query->where('title', 'LIKE', '%' . $request->title . '%');
        }

        if ($request->filled('description')) {
            $query->where('description', 'LIKE', '%' . $request->description . '%');
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $products = $query->get();

        return response()->json($products);
    }


    public function store(Request $request, string $shop_id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'required|string|max:255',
            'keywords' => 'nullable|json',
            'language' => 'nullable|string|max:50',
            'price' => 'required|numeric|min:0',
            'currency' => 'required|string',
            'image_base_url' => 'required|image|max:2048',
            'average_rating' => 'nullable|numeric|min:0|max:5',
            'view_count' => 'nullable|integer|min:0',
        ]);

        if ($request->hasFile('image_base_url')) {
            $result = cloudinary::upload($request->file('image_base_url')->getRealPath());
            $validated["image_base_url"] = $result->getSecurePath();
        }
        if (!Auth::check()) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $shop = Shop::find($shop_id);

        if ($shop->user_owner_id != Auth::id()) {
            return response()->json(["permission" => "You are not the owner of this shop"], 403);
        }

        $validated["shop_id"] = $shop_id;
        $validated["user_owner_id"] = Auth::id();

        $product = Product::create($validated);
        return response()->json($product, 201);
    }


    public function show(string $shop_id, string $product_id)
    {
        $product = Product::find($product_id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        return response()->json($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $shop_id, string $product_id)
    {
        $shop = Shop::find($shop_id);

        if ($shop->user_owner_id != Auth::id()) {
            return response()->json(["permission" => "You are not the owner of this shop"], 403);
        }

        $product = Product::find($product_id);

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

        if ($shop->user_owner_id != Auth::id()) {
            return response()->json(["permission" => "You are not the owner of this shop"], 403);
        }

        $product->delete();
        return response()->json(['message' => 'Product deleted successfully']);
    }
}