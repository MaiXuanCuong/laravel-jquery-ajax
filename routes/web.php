<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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
    Route::get('/inforCategory/{id}',[CategoryController::class, 'show'])->name('category.info');
        Route::post('/storeCategory',[CategoryController::class, 'store'])->name('category.store');
        Route::post('/updateCategory/{id}',[CategoryController::class, 'update'])->name('category.update');
        Route::post('/restoreCategory/{id}', [CategoryController::class, 'restore'])->name('category.restore');
            Route::delete('/deleteCategory/{id}',[CategoryController::class, 'destroy'])->name('category.destroy');
            Route::delete('/destroyCategory/{id}', [CategoryController::class, 'force_destroy'])->name('category.force_destroy');
 });
 Route::prefix('supplier')->group(function () {
    Route::get('/',[SupplierController::class, 'index'])->name('supplier.index');
    Route::get('/getSupplier',[SupplierController::class, 'getSupplier'])->name('supplier.getSupplier');
    Route::get('/editSupplier/{id}',[SupplierController::class, 'edit'])->name('supplier.edit');
    Route::get('/searchSupplier',[SupplierController::class, 'search'])->name('supplier.search');
    Route::get('/getProvinces', [SupplierController::class, 'getProvinces'])->name('supplier.getProvinces');
    Route::get('/getDistricts', [SupplierController::class, 'getDistricts'])->name('supplier.getDistricts');
    Route::get('/getWards', [SupplierController::class, 'getWards'])->name('supplier.getWards');
    Route::get('/getTrashCanSupplier', [SupplierController::class, 'getTrashCan'])->name('supplier.getTrashCan');
        Route::post('/storeSupplier',[SupplierController::class, 'store'])->name('supplier.store');
        Route::post('/updateSupplier/{id}',[SupplierController::class, 'update'])->name('supplier.update');
        Route::post('/restoreSupplier/{id}', [SupplierController::class, 'restore'])->name('supplier.restore');
            Route::delete('/deleteSupplier/{id}',[SupplierController::class, 'destroy'])->name('supplier.destroy');
            Route::delete('/destroySupplier/{id}', [SupplierController::class, 'force_destroy'])->name('supplier.force_destroy');
});