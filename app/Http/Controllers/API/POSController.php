<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\PosCategoryResource;
use App\Http\Resources\PosProductResource;
use App\Http\Resources\ProductResource;
use App\Model\Category;
use App\Model\Product;
use App\Model\TempCart;
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

    public function addTocart(Product $product){
        try {
            $userId = \Auth::guard()->id();
            $cartProducts = $product->cartProducts()->whereUserId($userId);
            $count = $cartProducts->count();
            if($count){
                $cartProduct = $cartProducts->first();
                $cartProduct->product_quantity += 1;
                $cartProduct->sub_total = $cartProduct->product_quantity * $cartProduct->product_price;
                $cartProduct->save();
            }else{
                $data['user_id'] = $userId;
                $data['product_name'] = $product->product_name;
                $data['product_quantity'] = 1;
                $data['product_price'] = $product->selling_price;
                $data['sub_total'] = $data['product_price'];
                $cart = $product->cartProducts()->create($data);
            }
            return response()->success();
        }
        catch (\Throwable $ex){
            return response()->error($ex->getMessage());
        }
    }

    public function getCart(){
        try {
            $cartProducts = TempCart::all();
            return response()->success($cartProducts);
        }catch (\Throwable $ex){
            return  response()->error($ex->getMessage());
        }
    }

    public function removeProductFromCart(TempCart $cartProduct){
        try {
            $cartProduct->delete();
            return response()->success();
        }catch (\Throwable $ex){
            return  response()->error($ex->getMessage());
        }

    }

    public function updateCart(TempCart $cartProduct, Request $request){
        try {
            $cartProduct->product_quantity = $request->product_quantity;
            $cartProduct->sub_total = $request->product_quantity * $cartProduct->product_price;
            $cartProduct->save();
            return response()->success();
        }catch (\Throwable $ex){
            return response()->error($ex->getMessage());
        }
    }
}
