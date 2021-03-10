<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Model\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        try {
            $products = Product::with(['category', 'supplier'])->get();
            return response()->success(ProductResource::collection($products));
        }
        catch (\Throwable $ex){
            return response()->error($ex->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        //
        try {
            $product = new Product();
            $product->fill($request->all());
            if ($request->image) {
                $imageEncodeBase64 = $request->image;
                $postion = strpos($imageEncodeBase64, ';');
                $ext = explode('/', substr($imageEncodeBase64, 0, $postion))[1];
                $fileName = Str::uuid() . '.' . $ext;
                $rootPublicPath = public_path('storage/product');
                if (!file_exists($rootPublicPath)) {
                    mkdir($rootPublicPath, 0777, true);
                }
                $filePath = $rootPublicPath . '/' . $fileName;
                Image::make($imageEncodeBase64)->resize(200, 240)->save($filePath);
                $product->image = "product/$fileName";
            }
            $product->save();
            return response()->success(new ProductResource($product));
        } catch (\Throwable $ex) {
            return response()->error($ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
        try {
            return response()->success(new ProductResource($product));
        }
        catch (\Throwable $ex){
            return response()->error($ex->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        //
        try {
            $originImage= $product->image;
            $product->fill($request->except(['category', 'supplier']));
            $product->image = $originImage;
            if ($request->image) {
                $oldImage = $product->image;
                $imageEncodeBase64 = $request->image;
                $postion = strpos($imageEncodeBase64, ';');
                $ext = explode('/', substr($imageEncodeBase64, 0, $postion))[1];
                $fileName = Str::uuid() . '.' . $ext;
                $filePath = public_path('storage/product') . '/' . $fileName;
                Image::make($imageEncodeBase64)->resize(200, 240)->save($filePath);
                $product->image = "product/$fileName";
                $filePath = public_path('storage/'.$oldImage);
                if(file_exists($filePath)){
                    unlink($filePath);
                }
            }
            $product->save();
            return response()->success(new ProductResource($product));
        } catch (\Throwable $ex) {
            return response()->error($ex->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
        try {
            if ($product->image) {
                $filePath = public_path('storage') . '/' . $product->image;
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }
            $product->delete();
            return response()->success();
        }
        catch (\Throwable $ex)
        {
            return response()->error($ex->getMessage());
        }
    }
}
