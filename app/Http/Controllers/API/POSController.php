<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateOrderRequest;
use App\Http\Resources\PosCategoryResource;
use App\Http\Resources\PosProductResource;
use App\Http\Resources\ProductResource;
use App\Model\Category;
use App\Model\Expense;
use App\Model\Order;
use App\Model\Product;
use App\Model\TempCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class POSController extends Controller
{
    //
    public function index(){
        try {
            $orders = Order::all();
            $totalSell = number_format($orders->sum('total'),3);
            $totalIncome = number_format($orders->sum('pay'),3);
            $totalDue = number_format($orders->sum('due'),3);
            $totalExpense = number_format(Expense::all()->sum('amount'),3);
            $products = ProductResource::collection(Product::with(['category', 'supplier'])->whereProductQuantity(0)->get());
            return response()->success(compact('totalSell', 'totalIncome', 'totalDue', 'totalExpense', 'products'));
        }catch (\Throwable $ex)
        {
            return response()->error($ex->getMessage());
        }

    }

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

    public function order(CreateOrderRequest $request){
        try {
            DB::beginTransaction();
            $order = new Order();
            $order->customer_id = $request->form['customer_id'];
            $order->qty = $request->payment['totalQuantity'];
            $order->sub_total = $request->payment['total'];
            $order->vat = $request->payment['vat'];
            $order->total = $request->payment['total'];
            $order->pay = $request->form['pay'];
            $order->due = $request->form['due'];
            $order->pay_by = $request->form['pay_by'];
            $order->order_date = date('Y-m-d');
            $order->order_month = date('m');
            $order->order_year = date('Y');
            $order->save();
            foreach ($request->cartProducts as $cartProduct){
                $order->orderDetails()->create([
                    'product_id' => $cartProduct['product_id'],
                    'product_quantity' => $cartProduct['product_quantity'],
                    'product_price' => $cartProduct['product_price'],
                    'sub_total' => $cartProduct['sub_total'],
                ]);
                Product::find($cartProduct['product_id'])->decrement('product_quantity',$cartProduct['product_quantity']);
            }
            TempCart::whereUserId(\Auth::id())->delete();
            DB::commit();
            return response()->success();
        }catch (\Throwable $ex){
            DB::rollBack();
            return response()->error($ex->getMessage());
        }
    }
}
