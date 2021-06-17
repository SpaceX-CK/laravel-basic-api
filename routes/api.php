<?php

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;




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

//PUBLIC ROUTE

//resource combine basic CURD api 
// Route::resource('products', ProductController::class);
Route::post('register', [AuthController::class,'register']);
Route::post('login', [AuthController::class,'login']);
Route::get('products', [ProductController::class,'index']);
Route::get('products/{id}', [ProductController::class,'show']);
Route::get('products/search/{name}', [ProductController::class,'search']);


//methode('api/link',[controller, 'functionnName in contoller.php])

//PROTECTED ROUTE
Route::group(['middleware'=>['auth:sanctum']], function(){
    Route::post('products', [ProductController::class,'store']);
    Route::put('products/{id}', [ProductController::class,'update']);
    Route::delete('products/{id}', [ProductController::class,'delete']);
    Route::post('logout', [AuthController::class,'logout']);


});


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();

});
