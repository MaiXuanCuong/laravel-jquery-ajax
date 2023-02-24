<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ShopController;
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

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {
    Route::post('/checklogin', [AuthController::class, 'login']);
    Route::post('/registerCustomer', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refreshCustomer', [AuthController::class, 'refresh']);
    Route::get('/profileCustomer', [AuthController::class, 'userProfile']);
    Route::post('/changePassCustomer', [AuthController::class, 'changePassWord']);    

    //shop
    Route::get('/',[ShopController::class, 'index'])->name('shop.index');
    Route::post('/history/{id}',[ShopController::class, 'view'])->name('shop.view');
    Route::get('/page',[ShopController::class, 'page'])->name('shop.page');
    Route::get('/home',[ShopController::class, 'home'])->name('shop.home');
    // Route::post('/changePassMailCustomer', [UserController::class, 'changePassByEmailCustomer']);       
});
