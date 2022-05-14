<?php

namespace App\Http\Controllers;

use App\Models\Product;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Http\Request;
use Illuminate\Contracts\Support\Arrayable;

class ProductController extends Controller
{
    public function index(){
        $products = Product::all();

        return response()->json($products);
    }

    public function store(Request $request, $user_id){
        // Validation
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'category' => 'required',
            // 'imageUrl' => 'required',
        ]);

        $product = Product::create([
            'user_id' => $user_id,
            'name' => $request->name,
            'price' => $request->price,
            'category' => $request->category,
            // 'imageUrl' => $request->imageUrl,
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
            // 'imageUrl' => 'required',
        ]);

        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'category' => $request->category,
            // 'imageUrl' => $request->imageUrl,
            'description' => $request->description,
        ]);

        return response()->json($product);
    }

    public function destroy(Product $product){
        $product->delete();
        return response()->json($product);    
    }

    public function updateHouseImage(Request $request, $id){
        // $idVal = (int)$id;
        if ($request->hasFile('image')){
            $file = $request->file('image');
            $filename = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $picture = date('His').'-'.$filename;
            $file->move(public_path('storage/houseImage'), $picture);
            Product::find($id)->update(array('imageUrl'=> $picture));

            return response()->json(["message" => "Image Uploaded Succesfully"]);
        } 
        else{
            return response()->json(["message" => "Select image first."]);
        }
    }

    public function getProductWithId(Request $request, $id){
        if (is_array($id) || $id instanceof Arrayable) {
            return  Product::findMany($id);
        }
        return  Product::find($id)->get();
    }

    public function getProductWithUserId(Request $request, $id){
 
        return Product::select('*')->where('user_id','=',$id)->get();
    }
}
