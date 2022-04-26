<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        $products = Product::all();

        return response()->json($products);
    }

    public function store(Request $request){
        // Validation
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'category' => 'required',
            'imageUrl' => 'required',
        ]);

        $product = Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'category' => $request->category,
            'imageUrl' => $request->imageUrl,
            'description' => $request->description,
        ]);

        return response()->json($product);

    }

    public function update(Request $request, Product $product){
         // Validation
         $request->validate([
            'name' => 'required',
            'price' => 'required',
            'category' => 'required',
            'imageUrl' => 'required',
        ]);

        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'category' => $request->category,
            'imageUrl' => $request->imageUrl,
            'description' => $request->description,
        ]);

        return response()->json($product);
    }

    public function destroy(Product $product){
        $product->delete();
        return response()->json($product);    
    }
}
