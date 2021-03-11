<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\EditEmployeeSalaryResource;
use App\Http\Resources\EmployeeResource;
use App\Http\Resources\EmployeeSalaryResource;
use App\Http\Resources\SalaryByMonthResource;
use App\Model\Employee;
use App\Model\Salary;
use Illuminate\Http\Request;

class SalaryController extends Controller
{
    //
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
            return response()->json(new EmployeeSalaryResource($employee));
        } catch (\Throwable $ex) {
            return response()->error($ex->getMessage());
        }
    }

    public function paySalary(Request $request, $id)
    {
        $request->validate([
            'salary_month' => 'required'
        ]);
        try {
            $month = $request->salary_month;
            $employee = Employee::findOrFail($id);
            $check = $employee->salaries()->where('salary_month', $month)->where('employee_id', $id)->first();
            if ($check) {
                return response()->error("This employee was paid at $month month already");
            }
            $salary = new Salary();
            $salary->salary_month = $month;
            $salary->employee_id = $id;
            $salary->amount = $request->salary;
            $salary->salary_date = date('Y-m-d');
            $salary->salary_year = date('Y');
            $salary->save();
            return response()->success($salary);
        } catch (\Throwable $ex) {
            return response()->error($ex->getMessage());
        }

    }

    public function index()
    {
        try {
            $salaries = Salary::select('salary_month')->groupBy('salary_month')->get();
            return response()->success($salaries);
        } catch (\Throwable $ex) {
            response()->error($ex->getMessage());
        }

    }

    function viewSalaryByMonth($month)
    {
        try {
            $salaries = Salary::with('employee')->whereSalaryMonth($month)->get();
            return response()->success(SalaryByMonthResource::collection($salaries));
        } catch (\Throwable $ex) {
            return response()->error($ex->getMessage());
        }

    }

    function getSalaryById(Salary $salary)
    {
        try {
            $salary->load('employee');
            return response()->success(new EditEmployeeSalaryResource($salary));
        } catch (\Throwable $ex) {
            return response()->error($ex->getMessage());
        }
    }

    function updateSalaryById(Request $request, Salary $salary)
    {
        $request->validate([
            'salary_month' => 'required',
            'salary' => 'required'
        ]);
        try {
            $month = $request->salary_month;
            $check = Salary::whereEmployeeId($salary->employee_id)->whereSalaryMonth($month)->first();
            if($check){
                return response()->error("This employee was paid at $month month already");
            }
            $salary->salary_month = $month;
            $salary->amount = $request->salary;
            $salary->save();
            return response()->success($salary);
        }
        catch (\Throwable $ex){
            return response()->error($ex->getMessage());
        }


    }
}
