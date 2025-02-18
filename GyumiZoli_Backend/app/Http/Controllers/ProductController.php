<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    
    public function getProduct()
    {
        $products = Product::with('category')->get(); 
        return response()->json($products);
    }

  
    public function addProduct(ProductRequest $request)
    {
        $product = Product::create($request->validated());
        return response()->json($product, 201);
    }
   
    public function showProduct(Request $request)
    {
       $product = Product::find($request["id"]);
       if( !$product ){

        return $this->sendError( "Adathiba", "Nincs ilyen termék" );
    }
       return response()->json($product);
    }

    public function updateProduct(Request $request)
    {
    $product = Product::find($request["id"]);
    $product->name = $request["name"];
    $product->update();
    return $this->sendResponse($product,"Sikeres frissítés");  
    }

    public function destroyProduct(ProductRequest $request)
    {
        $product = Product::find($request["id"]);
        if (!$product) {
            return $this->sendError("Termék nem található.", 404);
        }
        $product->delete();
        return $this->sendResponse($product,"Sikeres törlés");
    }
}
