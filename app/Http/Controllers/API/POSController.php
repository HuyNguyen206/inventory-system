<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\PosCategoryResource;
use App\Http\Resources\PosProductResource;
use App\Http\Resources\ProductResource;
use App\Model\Category;
use App\Model\Product;
use Illuminate\Http\Request;

class POSController extends Controller
{
    //
    public function getAllProduct()
    {
        try {
            $products = Product::all();
            return response()->success(PosProductResource::collection($products));
        } catch (\Throwable $ex) {
            return response()->error($ex->getMessage());
        }

    }

    public function getAllCategory()
    {
        try {
            $category = Category::all();
            return response()->success(PosCategoryResource::collection($category));

        } catch (\Throwable $ex) {
            return response()->error($ex->getMessage());
        }

    }

    public function getProductByCategoryId($category)
    {
        try {
            $products = $category->products;
            return response()->success(ProductResource::collection($products));
        } catch (\Throwable $ex) {
            return response()->error($ex->getMessage());
        }

    }
}
