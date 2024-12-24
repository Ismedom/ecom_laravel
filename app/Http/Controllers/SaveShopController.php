<?php

namespace App\Http\Controllers;

use App\Models\SaveShop;
use App\Models\Shop;

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
    public function store(string $shop_id)
    {
        $shop =  Shop::find($shop_id);
        if (!$shop) {
            return response()->json([
                'message' => 'Shop not found.',
            ], 404);
        }
        $saveShop = SaveShop::create(
            [
                'shop_name' =>$shop->shop_name,
                'shop_id' => $shop-> id,
                'shop_profile_image' =>$shop->shop_profile_image,
            ]
            );

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
     * Remove the specified save_shop from storage.
     */
    public function destroy($id)
    {
        $saveShop = SaveShop::findOrFail($id);
        $saveShop->delete();

        return response()->json(['message' => 'SaveShop deleted successfully']);
    }
}