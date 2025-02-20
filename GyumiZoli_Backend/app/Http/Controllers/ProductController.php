<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends ResponseController
{
    
    public function getProduct()
    {
        $products = Product::with('category')->get(); 
        return response()->json($products);
    }

  
    public function addProduct(Request $request)
    {
        $product = new Product();
        $product->name = $request["name"];
        $product->price = $request["price"];
        $product->category_id = $request["category_id"];
        $product->description = $request["description"];
        if($request->hasFile('image_url')) {
            $product->image_url = $request->file('image_url')->store('product_images', 'public');
        }
        $product -> save();
        // return $this->sendResponse($product,"Sikeres hozzáadás");
        return response()->json($product);
       
    }
   
    public function showProduct(Request $request)
    {
       $product = Product::with('category')->findOrFail("id");
       return $this->sendResponse($product,"Sikeres lekérés");
    }

    public function updateProduct(Request $request)
    {
    $product = Product::find($request->input('id'));
    $product->name = $request["name"];
    $product->price = $request["price"];
    $product->description = $request["description"];
    $product->category_id = $request->input("category_id");
    if ($request->hasFile('image_url')) {
        $product->image_url = $request->file('image_url')->store('images', 'public');
    }
    $product->update();
    return $this->sendResponse($product,"Sikeres frissítés");  
    }

    public function destroyProduct(Request $request)
    {
        $product = Product::find($request["id"]);
        if (!$product) {
            return $this->sendError("Termék nem található.");
        }
        $product->delete();
        return $this->sendResponse($product,"Sikeres törlés");
    }
}
