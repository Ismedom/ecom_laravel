<?php

namespace App\Http\Controllers;

use App\Models\SaveShop;
use Illuminate\Http\Request;

class SaveShopController extends Controller
{
    /**
     * Display a listing of the save_shops.
     */
    public function index()
    {
        $shops = SaveShop::all();
        return response()->json($shops);
    }

    /**
     * Store a newly created save_shop in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'shop_name' => 'required|string|max:255',
            'user_owner_id' => 'required|string|unique:save_shop,user_owner_id',
            'shop_profile_image' => 'required|string|max:255',
        ]);

        $saveShop = SaveShop::create([
            'shop_name' => $request->shop_name,
            'user_owner_id' => $request->user_owner_id,
            'shop_profile_image' => $request->shop_profile_image,
        ]);

        return response()->json($saveShop, 201);
    }

    /**
     * Display the specified save_shop.
     */
    public function show($id)
    {
        $saveShop = SaveShop::findOrFail($id);
        return response()->json($saveShop);
    }

    /**
     * Update the specified save_shop in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'shop_name' => 'sometimes|string|max:255',
            'user_owner_id' => 'sometimes|string|unique:save_shop,user_owner_id,' . $id,
            'shop_profile_image' => 'sometimes|string|max:255',
        ]);

        $saveShop = SaveShop::findOrFail($id);
        $saveShop->update($request->all());

        return response()->json($saveShop);
    }

    /**
     * Remove the specified save_shop from storage.
     */
    public function destroy($id)
    {
        $saveShop = SaveShop::findOrFail($id);
        $saveShop->delete();

        return response()->json(['message' => 'SaveShop deleted successfully']);
    }
}