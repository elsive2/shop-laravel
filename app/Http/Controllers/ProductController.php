<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $data = Product::with('category')->all();

        return ProductResource::collection($data);
    }

    public function view(Product $product)
    {
        return new ProductResource($product);
    }

    public function create(ProductRequest $request)
    {
        $product = Product::create($request->validated());

        return new ProductResource($product);
    }

    public function delete(Product $product)
    {
        $product->delete();

        return ['success' => 200];
    }
}
