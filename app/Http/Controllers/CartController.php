<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $cartItems = Cart::where('user_carting_id', Auth::id())->get();
        return response()->json($cartItems);
    }

    public function store(string $id)
    {
        $product = Product::find($id);

        $cartItem = Cart::create([
            'product_id' => $product->id,
            'user_carting_id' => Auth::id(),
            'title' => $product->title,
            'price' => $product->price,
            'author' => $product->author,
            'rating' => $product->rating,
            'description' => $product->description,
            'coverImageUrl' => $product->coverImageUrl,

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