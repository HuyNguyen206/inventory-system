<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Model\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

    public function getOrderByToday(){
        try {
//            $today = date('Y-m-d');
//            $orders = Order::with('customer')->whereOrderDate($today)->get();
            $orders = Order::with('customer')->get();
            return response()->success($orders);
        }catch (\Throwable $ex){
            return  response()->error($ex->getMessage());
        }
    }

    public function getOrderDetailByOrderId(Order $order){
        try {
            $orderDetail = $order->orderDetails->load('product')->sortByDesc('created_at');
            $order->load('customer');
            $data = compact('order', 'orderDetail');
            return response()->success($data);
        }catch (\Throwable $ex){
         return response()->error($ex->getMessage());
        }
    }

    public function getOrderByDate(Request $request){
        try {
            $orders = Order::with('customer')->whereOrderDate($request->date)->get();
            return response()->success($orders);
        }catch (\Throwable $ex){
            return response()->error($ex->getMessage());
        }

    }
}
