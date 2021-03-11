<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Http\Resources\EmployeeResource;
use App\Model\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Image;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        try {
            $employees = Employee::all();
            return response()->success(EmployeeResource::collection($employees));
        } catch (\Throwable $ex) {
            return response()->error($ex->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEmployeeRequest $request)
    {
        //
        try {
            $employee = new Employee();
            $employee->fill($request->all());
            if ($request->image) {
                $imageEncodeBase64 = $request->image;
                $postion = strpos($imageEncodeBase64, ';');
                $ext = explode('/', substr($imageEncodeBase64, 0, $postion))[1];
                $fileName = Str::uuid() . '.' . $ext;
                $rootPublicPath = public_path('storage/employee');
                if (!file_exists($rootPublicPath)) {
                    mkdir($rootPublicPath, 0777, true);
                }
                $filePath = $rootPublicPath . '/' . $fileName;
                Image::make($imageEncodeBase64)->resize(200, 240)->save($filePath);
                $employee->image = "employee/$fileName";
            }
            $employee->save();
            return response()->success(new EmployeeResource($employee));
        } catch (\Throwable $ex) {
            return response()->error($ex->getMessage());
        }

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        try {
            $employee = Employee::findOrFail($id);
            return response()->json(new EmployeeResource($employee));
        }
        catch (\Throwable $ex)
        {
            return response()->error($ex->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEmployeeRequest $request, $id)
    {
        //
        try {
            $employee = Employee::findOrFail($id);
            $originImage= $employee->image;
            $employee->image = $originImage;
            if ($request->image) {
                $oldImage = $employee->image;
                $imageEncodeBase64 = $request->image;
                $postion = strpos($imageEncodeBase64, ';');
                $ext = explode('/', substr($imageEncodeBase64, 0, $postion))[1];
                $fileName = Str::uuid() . '.' . $ext;
                $filePath = public_path('storage/employee') . '/' . $fileName;
                Image::make($imageEncodeBase64)->resize(200, 240)->save($filePath);
                $employee->image = "employee/$fileName";
                $filePath = public_path('storage/'.$oldImage);
                if(file_exists($filePath)){
                    unlink($filePath);
                }
            }
            $employee->save();
            return response()->success(new EmployeeResource($employee));
        } catch (\Throwable $ex) {
            return response()->error($ex->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        try {
            $employee = Employee::findOrFail($id);
            if ($employee->image) {
                $filePath = public_path('storage') . '/' . $employee->image;
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }
            $employee->delete();
           return response()->success();
        }
        catch (\Throwable $ex)
        {
            return response()->error($ex->getMessage());
        }
    }
}
