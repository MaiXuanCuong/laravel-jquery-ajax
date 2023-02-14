<?php

use App\Http\Controllers\CategoryController;
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
    Route::get('/getUser',[UserController::class, 'getUser'])->name('user.getUser');
    Route::get('/editUser/{id}',[UserController::class, 'edit'])->name('user.edit');
    Route::get('/searchUser',[UserController::class, 'search'])->name('user.search');
    Route::get('/inforUser/{id}',[UserController::class, 'show'])->name('user.info');
    Route::get('/getProvinces', [UserController::class, 'getProvinces'])->name('user.getProvinces');
    Route::get('/getDistricts', [UserController::class, 'getDistricts'])->name('user.getDistricts');
    Route::get('/getWards', [UserController::class, 'getWards'])->name('user.getWards');
    Route::get('/getTrashCanUser', [UserController::class, 'getTrashCan'])->name('user.getTrashCan');
        Route::post('/storeUser',[UserController::class, 'store'])->name('user.store');
        Route::post('/updateUser/{id}',[UserController::class, 'update'])->name('user.update');
        Route::post('/restoreUser/{id}', [UserController::class, 'restore'])->name('user.restore');
            Route::delete('/deleteUser/{id}',[UserController::class, 'destroy'])->name('user.destroy');
            Route::delete('/destroyUser/{id}', [UserController::class, 'force_destroy'])->name('user.force_destroy');
});
 Route::prefix('category')->group(function(){
    Route::get('/',[CategoryController::class,'index'])->name('category.index');
    Route::get('/getCategory',[CategoryController::class, 'getCategory'])->name('category.getCategory');
    Route::get('/editCategory/{id}',[CategoryController::class, 'edit'])->name('category.edit');
    Route::get('/searchCategory',[CategoryController::class, 'search'])->name('category.search');
    Route::get('/getTrashCanCategory', [CategoryController::class, 'getTrashCan'])->name('category.getTrashCan');
        Route::post('/storeCategory',[CategoryController::class, 'store'])->name('category.store');
        Route::post('/updateCategory/{id}',[CategoryController::class, 'update'])->name('category.update');
        Route::post('/restoreCategory/{id}', [CategoryController::class, 'restore'])->name('category.restore');
            Route::delete('/deleteCategory/{id}',[CategoryController::class, 'destroy'])->name('category.destroy');
            Route::delete('/destroyCategory/{id}', [CategoryController::class, 'force_destroy'])->name('category.force_destroy');
 });