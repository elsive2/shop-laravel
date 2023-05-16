<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $products = $user->products()->with('category')->get();

        return [
            'total_count' => $user->products->count(),
            'total_sum' => $user->products->sum('price'),
            'data' => ProductResource::collection($products)
        ];
    }

    public function create(Product $product)
    {
        Auth::user()->products()->save($product);

        return new ProductResource($product);
    }

    public function delete(Product $product)
    {
        Auth::user()->products()->detach($product->id);
    }
}
