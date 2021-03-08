<?php

namespace App\Http\Controllers\API;

use App\Model\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         try {
                    $categories = Category::all();
                    return response()->success($categories);
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
        $request->validate([
            'name' => 'required'
        ]);
        try {
            $category = new Category();
            $category->fill($request->all());
            $category->save();
            return response()->success($category);
        } catch (\Throwable $ex) {
            return response()->error($ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
        try {
            return response()->json($category);
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
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //
        $request->validate([
            'name' => 'required'
        ]);
        try {
            $category->fill($request->all());
            $category->save();
            return response()->success($category);
        } catch (\Throwable $ex) {
            return response()->error($ex->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
        try {
            $category->delete();
            return response()->success();
        }
        catch (\Throwable $ex)
        {
            return response()->error($ex->getMessage());
        }
    }
}
