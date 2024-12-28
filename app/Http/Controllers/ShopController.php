<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use Auth;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\Request;

class ShopController extends Controller
{

    public function index()
    {
        $shops = Shop::all();
        return response()->json($shops, 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'shop_name' => 'required|string|max:255',
            'shop_profile_image' => 'nullable|image|max:2048',
            'categories' => 'required|string',
            'keywords' => 'required|json',
        ]);

        if ($request->hasFile('shop_profile_image')) {
            $result = Cloudinary::upload($request->file('shop_profile_image')->getRealPath());
            $validated["shop_profile_image"] = $result->getSecurePath();
        }

        $validated["user_owner_id"] = Auth::id();
        $shop = Shop::create($validated);

        return response()->json([
            'message' => 'Shop created successfully!',
            'shop' => $shop
        ], 201);
    }
    /**
     * Display the specified resource.
     */
    public function show(string $shop_id)
    {
        $shop = Shop::find($shop_id);

        if (!$shop) {
            return response()->json([
                'message' => 'Shop not found.',
            ], 404);
        }

        return response()->json($shop, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $shop_id)
    {
        $shop = Shop::find($shop_id);

        if (!$shop) {
            return response()->json([
                'message' => 'Shop not found.',
            ], 404);
        }

        $validated = $request->validate([
            'shop_name' => 'sometimes|string|max:255',
            'shop_profile_image' => 'nullable|image|max:2048',
            'categories' => 'sometimes|string',
            'keywords' => 'sometimes|json',
        ]);

        $shop->update($validated);

        return response()->json([
            'message' => 'Shop updated successfully!',
            'shop' => $shop,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $shop_id)
    {
        $shop = Shop::find($shop_id);
        if (!$shop) {
            return response()->json([
                'message' => 'Shop not found.',
            ], 404);
        }
        if($shop->user_owner_id != Auth::id()) {
            return response()->json([
                'message' => 'Your not this shop owner',
            ], 403);
        }
        $shop->delete();
        return response()->json([
            'message' => 'Shop deleted successfully!',
        ], 200);
    }
}