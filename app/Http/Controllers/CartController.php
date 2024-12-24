<?php

namespace App\Http\Controllers;

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

   
    public function store(Request $request)
    {
      
        $validated = $request->validate([
            'product_id' => 'required|uuid',
            'name' => 'required|string',
            'price' => 'required|string',
            'product_type' => 'required|string',
            'paid_status' => 'required|boolean',
        ]);

        $cartItem = Cart::create($validated);

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
     * Show the form for editing the specified resource.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'product_id' => 'sometimes|uuid',
            'name' => 'sometimes|string',
            'price' => 'sometimes|string',
            'product_type' => 'sometimes|string',
            'paid_status' => 'sometimes|boolean',
        ]);

       
        $cartItem = Cart::findOrFail($id);
        $cartItem->update($validated);

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