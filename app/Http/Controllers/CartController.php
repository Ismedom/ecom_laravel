<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Cart;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cartItems = Cart::all();
        return response()->json($cartItems);
    }

    public function store( Request $request,string $id)
    {
        $product = Product::find($id);

        $cartItem = Cart::create([
            'product_id'=> $product -> id,
            'name'=> $product -> title,
            'price'=> $product -> price,
            'product_type'=> $product -> category,
            'paid_status'=> $request-> paid_status,
        ]);

        return response()->json($cartItem, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
       
        $cartItem = Cart::findOrFail($id);
        return response()->json($cartItem);
    }

    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       
        $cartItem = Cart::findOrFail($id);
        $cartItem->delete();

        return response()->json(['message' => 'Cart item deleted successfully.']);
    }
}