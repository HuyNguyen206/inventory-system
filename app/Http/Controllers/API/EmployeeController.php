<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEmployeeRequest;
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
    public function index()
    {
        //
        try {
            $employees = Employee::all();
            return response()->success(EmployeeResource::collection($employees));
        }
        catch (\Throwable $ex)
        {
          return response()->error($ex->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEmployeeRequest $request)
    {
        //
        try {
            $employee = new Employee();
            $employee->fill($request->all());
            if($request->image){
                $imageEncodeBase64 = $request->image;
                $postion = strpos($imageEncodeBase64, ';');
                $ext = explode('/', substr($imageEncodeBase64, 0, $postion))[1];
                $fileName = Str::uuid().'.'.$ext;
                $filePath = public_path('storage/employee').'/'.$fileName;
                Image::make($imageEncodeBase64)->resize(200, 240)->save($filePath);
                $employee->image = "employee/$fileName";
            }
            $employee->save();
            return response()->success(new EmployeeResource($employee));
        }
        catch (\Throwable $ex){
            return response()->error($ex->getMessage());
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
