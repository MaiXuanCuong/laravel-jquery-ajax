<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('//', function () {
    // return view('admin.user.edit');
    // return view('admin.user.index');
    // return view('admin.layout.master');
});
Route::get('/',[UserController::class, 'index'])->name('user.index');
Route::get('/get_user',[UserController::class, 'getUser'])->name('user.getUser');
Route::get('/edit_user/{id}',[UserController::class, 'edit'])->name('user.edit');
Route::post('/store_user',[UserController::class, 'store'])->name('user.store');
Route::put('/update_user/{id}',[UserController::class, 'update'])->name('user.update');
Route::delete('/delete_user/{id}',[UserController::class, 'destroy'])->name('user.destroy');
Route::get('user/getProvinces', [UserController::class, 'getProvinces'])->name('user.getProvinces');
Route::get('user/getDistricts', [UserController::class, 'getDistricts'])->name('user.getDistricts');
Route::get('user/getWards', [UserController::class, 'getWards'])->name('user.getWards');