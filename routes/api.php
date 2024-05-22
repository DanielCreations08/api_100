<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiController;



//Register
Route::post("register",[ApiController::class,"register"]);

//Login
Route::post("login",[ApiController::class,"login"]);


// ... Create Token Method  

Route::post('/api/tokens/create', function (Request $request) {
    $token = $request->user()->createToken($request->token_name);
    return response()->json(['token' => $token->plainTextToken], 200);
});





/*Route::get ('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');*/
