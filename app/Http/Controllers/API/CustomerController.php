<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\CustomerResource;
use App\Model\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Image;

class CustomerController extends Controller
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
            $customers = Customer::all();
            return response()->success(CustomerResource::collection($customers));
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
    public function store(Request $request)
    {
        //
        try {
            $customer = new Customer();
            $customer->fill($request->all());
            if ($request->image) {
                $imageEncodeBase64 = $request->image;
                $postion = strpos($imageEncodeBase64, ';');
                $ext = explode('/', substr($imageEncodeBase64, 0, $postion))[1];
                $fileName = Str::uuid() . '.' . $ext;
                $filePath = public_path('storage/customer') . '/' . $fileName;
                Image::make($imageEncodeBase64)->resize(200, 240)->save($filePath);
                $customer->image = "customer/$fileName";
            }
            $customer->save();
            return response()->success(new CustomerResource($customer));
        } catch (\Throwable $ex) {
            return response()->error($ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
        try {
            return response()->json(new CustomerResource($customer));
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
     * @param  \App\Model\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        //
        try {
            $customer->name = $request->name;
            $customer->email = $request->email;
            $customer->address = $request->address;
            $customer->phone = $request->phone;
            if ($request->image) {
                $oldImage = $customer->image;
                $imageEncodeBase64 = $request->image;
                $postion = strpos($imageEncodeBase64, ';');
                $ext = explode('/', substr($imageEncodeBase64, 0, $postion))[1];
                $fileName = Str::uuid() . '.' . $ext;
                $rootPublicPath = public_path('storage/customer');
                if (!file_exists($rootPublicPath)) {
                    mkdir($rootPublicPath, 0777, true);
                }
                $filePath = $rootPublicPath . '/' . $fileName;
                Image::make($imageEncodeBase64)->resize(200, 240)->save($filePath);
                $customer->image = "customer/$fileName";
                $filePath = public_path('storage/'.$oldImage);
                if(file_exists($filePath)){
                    unlink($filePath);
                }
            }
            $customer->save();
            return response()->success(new CustomerResource($customer));
        } catch (\Throwable $ex) {
            return response()->error($ex->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        //
        try {
            if ($customer->image) {
                $filePath = public_path('storage') . '/' . $customer->image;
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }
            $customer->delete();
            return response()->success();
        }
        catch (\Throwable $ex)
        {
            return response()->error($ex->getMessage());
        }
    }
}
