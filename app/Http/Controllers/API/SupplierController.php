<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\StoreSupplierRequest;
use App\Http\Requests\UpdateSupplierRequest;
use App\Http\Resources\SupplierResource;
use App\Model\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Image;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
           try {
                    $suppliers = Supplier::all();
                    return response()->success(SupplierResource::collection($suppliers));
                } catch (\Throwable $ex) {
                    return response()->error($ex->getMessage());
                }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSupplierRequest $request)
    {
        //
        try {
            $suppliers = new Supplier();
            $suppliers->fill($request->all());
            if ($request->image) {
                $imageEncodeBase64 = $request->image;
                $postion = strpos($imageEncodeBase64, ';');
                $ext = explode('/', substr($imageEncodeBase64, 0, $postion))[1];
                $fileName = Str::uuid() . '.' . $ext;
                $filePath = public_path('storage/supplier') . '/' . $fileName;
                Image::make($imageEncodeBase64)->resize(200, 240)->save($filePath);
                $suppliers->image = "supplier/$fileName";
            }
            $suppliers->save();
            return response()->success(new SupplierResource($suppliers));
        } catch (\Throwable $ex) {
            return response()->error($ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {
        //
        try {
            return response()->json(new SupplierResource($supplier));
        }
        catch (\Throwable $ex)
        {
            response()->error($ex->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSupplierRequest $request, Supplier $supplier)
    {
        //
        try {
            $supplier->name = $request->name;
            $supplier->email = $request->email;
            $supplier->address = $request->address;
            $supplier->shop_name = $request->shop_name;
            $supplier->phone = $request->phone;
            if ($request->image) {
                $oldImage = $supplier->image;
                $imageEncodeBase64 = $request->image;
                $postion = strpos($imageEncodeBase64, ';');
                $ext = explode('/', substr($imageEncodeBase64, 0, $postion))[1];
                $fileName = Str::uuid() . '.' . $ext;
                $rootPublicPath = public_path('storage/supplier');
                if (!file_exists($rootPublicPath)) {
                    mkdir($rootPublicPath, 0777, true);
                }
                $filePath = $rootPublicPath . '/' . $fileName;
                Image::make($imageEncodeBase64)->resize(200, 240)->save($filePath);
                $supplier->image = "supplier/$fileName";
                $filePath = public_path('storage/'.$oldImage);
                if(file_exists($filePath)){
                    unlink($filePath);
                }
            }
            $supplier->save();
            return response()->success(new SupplierResource($supplier));
        } catch (\Throwable $ex) {
            return response()->error($ex->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier)
    {
        //
        try {
            if ($supplier->image) {
                $filePath = public_path('storage') . '/' . $supplier->image;
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }
            $supplier->delete();
            return response()->success();
        }
        catch (\Throwable $ex)
        {
            return response()->error($ex->getMessage());
        }
    }
}
