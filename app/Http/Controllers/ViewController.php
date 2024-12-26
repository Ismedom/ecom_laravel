<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\View;
use Illuminate\Support\Facades\Auth;

class ViewController extends Controller
{

    public function index()
    {
        $views = View::all();
        return response()->json($views);
    }

    public function store(string $product_id)
    {
        $product = Product::find($product_id);
        $view = View::create([
            'viewer_id' => Auth::id(),
            'product_id' => $product->id,
        ]);
        return response()->json(['message' => 'View count added successfully', 'data' =>  $view], 201);
    }

    public function show(string $id)
    {
        $view = View::find($id);
        if (!$view) {
            return response()->json(['message' => 'View count not found'], 404);
        }
        return response()->json($view);
    }

    public function destroy(string $id)
    {
        $view = View::find($id);

        if (!$view) {
            return response()->json(['message' => 'View count not found'], 404);
        }
        $view->delete();
        return response()->json(['message' => 'View count deleted successfully']);
    }
}