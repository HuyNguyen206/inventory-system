<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Model\Expense;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $expenses = Expense::all();
            return response()->success($expenses);
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
    public function store(Request $request)
    {
        //
        $request->validate([
            'details' => 'required',
            'amount' => 'required'
        ]);
        try {
            $expense = new Expense();
            $expense->fill($request->all());
            $expense->expense_date = date('Y-m-d');
            $expense->save();
            return response()->success($expense);
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
    public function show(Expense $expense)
    {
        //
        try {
            return response()->json($expense);
        }
        catch (\Throwable $ex)
        {
            response()->error($ex->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Expense $expense)
    {
        $request->validate([
            'details' => 'required',
            'amount' => 'required'
        ]);
        try {
            $expense->fill($request->all());
            $expense->save();
            return response()->success($expense);
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
    public function destroy(Expense $expense)
    {
        try {
            $expense->delete();
            return response()->success();
        }
        catch (\Throwable $ex)
        {
            return response()->error($ex->getMessage());
        }
    }
}
