<?php

namespace App\Providers;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;

class ResponseMacroServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Response::macro('success', function ($data=[], $message = 'success') {
            $response = [
                'data' => $data,
                'success' => true,
                'message' => $message
            ];
            return response()->json($response, 200);
        });

        Response::macro('error', function ($message) {
            $response = [
                'success' => false,
                'message' => $message
            ];
            return response()->json($response, 400);
        });
    }
}
