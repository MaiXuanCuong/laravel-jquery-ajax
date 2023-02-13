<?php

use App\Http\Controllers\HomeController;
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

// Route::get('/', function () {
//     // return view('admin.user.edit');
//     // return view('admin.user.index');
//     // return view('admin.layout.master');
//     return view('admin.layout.dashboard');
// });

Route::get('/',[HomeController::class, 'index'])->name('dashboard');

Route::prefix('user')->group(function () {
Route::get('/',[UserController::class, 'index'])->name('user.index');
Route::get('/get_user',[UserController::class, 'getUser'])->name('user.getUser');
Route::get('/edit_user/{id}',[UserController::class, 'edit'])->name('user.edit');
Route::post('/store_user',[UserController::class, 'store'])->name('user.store');
Route::post('/update_user/{id}',[UserController::class, 'update'])->name('user.update');
Route::delete('/delete_user/{id}',[UserController::class, 'destroy'])->name('user.destroy');
Route::get('/getProvinces', [UserController::class, 'getProvinces'])->name('user.getProvinces');
Route::get('/getDistricts', [UserController::class, 'getDistricts'])->name('user.getDistricts');
Route::get('/getWards', [UserController::class, 'getWards'])->name('user.getWards');
Route::get('/getTrashCanUser', [UserController::class, 'getTrashCan'])->name('user.getTrashCan');
Route::post('/restore_user/{id}', [UserController::class, 'restore'])->name('user.restore');
Route::delete('/destroy_user/{id}', [UserController::class, 'force_destroy'])->name('user.force_destroy');
Route::get('/search_user',[UserController::class, 'search'])->name('user.search');



});