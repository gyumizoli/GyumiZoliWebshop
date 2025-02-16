<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function store(Request $request)
    {
        // Validate inputs
        $request->validate([
            'file' => 'required|image|mimes:jpg,png|max:2048',
            'product_name' => 'required|string|max:255',
            'product_description' => 'nullable|string',
            'product_price' => 'required|numeric|min:0',
        ]);

        // Create or retrieve product
        $product = Product::create([
            'name' => $request->input('product_name'),
            'description' => $request->input('product_description'),
            'price' => $request->input('product_price'),
        ]);

        if ($request->hasFile('file')) {
            // Handle file upload
            $file = $request->file('file');
            $name = $file->getClientOriginalName();
            $path = $file->store('images', 'public');

            // Save image record in database
            Image::create([
                'name' => $name,
                'path' => $path,
                'product_id' => $product->id,
            ]);

            return response()->json([
                "success" => true,
                "message" => "Product and file successfully uploaded",
                "product" => $product,
                "image" => [
                    "name" => $name,
                    "path" => $path,
                ],
            ]);
        }

        return response()->json(["success" => false, "message" => "File upload failed"]);
    }

    public function index()
    {
        $products = Product::with('images')->get(); // Termékek és kapcsolódó képek lekérése
        return response()->json($products);
    }
}
