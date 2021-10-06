<?php

use App\Http\Controllers\Api\LoginController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('user/login',[LoginController::class, 'userLogin'])->name('userLogin');
//Route::group( ['prefix' => 'user','middleware' => ['auth:user-api','scopes:user'] ],function(){
//    // authenticated staff routes here
//    Route::get('dashboard',[LoginController::class, 'userDashboard']);
//});

Route::resource('clientes', \App\Http\Controllers\Api\ClienteController::class);
    //->middleware(['auth:user-api','scopes:user']);
Route::resource('produtos', \App\Http\Controllers\Api\ProdutoController::class);
    //->middleware(['auth:user-api','scopes:user']);
Route::resource('pedidos', \App\Http\Controllers\Api\PedidoController::class);
    //->middleware(['auth:user-api','scopes:user']);

