<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'prefix' => 'auth',
    'namespace' => 'API'
], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
    Route::post('register', 'AuthController@register');
});

Route::middleware('jwt')->namespace('API')->group(function () {
    Route::apiResources([
        'employees' => 'EmployeeController',
        'suppliers' => 'SupplierController',
        'categories' => 'CategoryController',
        'products' => 'ProductController',
        'expenses' => 'ExpenseController',
        'customers' => 'CustomerController',
    ]);
    Route::apiResource('salaries', 'SalaryController')->only(['show', 'index']);
    Route::post('salaries/pay/{id}', 'SalaryController@paySalary');
    Route::get('salaries/by-month/{month}', 'SalaryController@viewSalaryByMonth');
    Route::get('salaries/edit-salary/{salary}', 'SalaryController@getSalaryById');
    Route::post('salaries/update/{salary}', 'SalaryController@updateSalaryById');
    Route::get('pos', 'POSController@getAllProduct');
    Route::get('pos/get-all-category', 'POSController@getAllCategory');
    Route::get('pos/product-of-category/{category}', 'POSController@getProductByCategoryId');
    Route::get('pos/add-to-cart/{product}', 'POSController@addToCart');
    Route::get('pos/get-cart-products', 'POSController@getCart');
    Route::get('pos/remove-cart-product/{cartProduct}', 'POSController@removeProductFromCart');
    Route::put('pos/update-cart/{cartProduct}', 'POSController@updateCart');
    Route::post('pos/order', 'POSController@order');
    Route::get('orders/orders-by-today', 'OrderController@getOrderByToday');
    Route::get('orders/order-detail/{order}', 'OrderController@getOrderDetailByOrderId');
});
