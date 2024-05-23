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
    return response()->json(['message' => 'Token created successfully'], 200);
  });


Route::group([
    "middleware" => ["auth::sanctum"]
],function(){
    //Profile
Route::post("profile",[ApiController::class,"profile"]);
});

/*Route::get ('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');*/
