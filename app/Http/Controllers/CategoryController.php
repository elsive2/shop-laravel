<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Utils\ArrayUtils;

class CategoryController extends Controller
{
    public function index()
    {
        $data = CategoryResource::collection(Category::all());

         return ArrayUtils::buildTree(json_decode($data->toJson(), true));
    }

    public function view(Category $category)
    {
        return new CategoryResource($category);
    }

    public function create(CategoryRequest $request)
    {
        $category = Category::create($request->validated());

        return new CategoryResource($category);
    }

    public function delete(Category $category)
    {
        $category->delete();

        return ['success' => 200];
    }
}
