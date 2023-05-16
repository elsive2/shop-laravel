<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $data = Product::all();

        return ProductResource::collection($data);
    }

    public function view(Product $product)
    {
        return new ProductResource($product);
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|integer'
        ]);

        $user = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
        ]);
    }

    public function delete(Product $product)
    {
        $product->delete();

        return ['success' => 200];
    }
}
