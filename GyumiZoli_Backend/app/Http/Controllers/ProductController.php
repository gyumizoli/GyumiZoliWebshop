<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    
    public function getProduct()
    {
        $products = Product::all(); 
        return response()->json($products);
    }

  
    public function addProduct(Request $request)
    {
        $product = new Product();
        $product->name = $request["name"];
        $product->price = $request["price"];
        $product->category = $request["category"];
        $product->description = $request["description"];
        $product->unit = $request["unit"];
        $product->promotion = $request["promotion"];
        $product->discount_price = $request["discount_price"];
        if($request->hasFile('image_url')) {
            $product->image_url = $request->file('image_url')->store('product_images', 'public');
        }
        $product -> save();
        return response()->json($product);
       
    }
   
    public function showProduct(Request $request)
    {
       $product = Product::with('category')->findOrFail("id");
       return $this->sendResponse($product,"Sikeres lekérés");
    }

    public function updateProduct(Request $request)
    {
        $product = Product::findOrFail($request->request->get('id'));
        $oldImage = $product->image_url;

        if($request->has('delete_image') && $request->input('delete_image') == true) {
            if($oldImage) {
                $imagePath = str_replace(url('/storage/'), '', $oldImage);
                if(Storage::disk('public')->exists($imagePath)) {
                    Storage::disk('public')->delete($imagePath);
                    return response()->json("Kép törölve!");
                }
            }
            $product->image_url = null;
        }

        if($request->hasFile('image_url')) {
            if($oldImage) {
                $imagePath = str_replace(url('/storage/'), '', $oldImage);
                if(Storage::disk('public')->exists($imagePath)) {
                    Storage::disk('public')->delete($imagePath);
                }
            }
            $product->image_url = $request->file('image_url')->store('product_images', 'public');
        }

        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->description = $request->input('description');
        $product->category = $request->input('category');
        $product->unit = $request->input('unit');
        $product->promotion = $request->input('promotion');
        $product->discount_price = $request->input('discount_price');
       
        $product->save();
        return response()->json("Sikeres frissítés!");  
    }

    public function destroyProduct(Request $request)
    {
        $product = Product::find($request["id"]);
        if (!$product) {
            return response()->json("Nem található a termék!");
        }
        if($product->image_url) {
            $imagePath = str_replace(url('/storage/'), '', $product->image_url);
            if(Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }
        }
        $product->delete();
        return response()->json("Sikeres törlés!");
    }
}
