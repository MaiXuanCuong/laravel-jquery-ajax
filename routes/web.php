<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BannerController;
use Illuminate\Support\Facades\Route;

Route::post('/checklogin',[AuthController::class, 'checklogin'])->name('checklogin');
Route::get('/login',[AuthController::class, 'index'])->name('login');
Route::prefix('/')->middleware(['auth', 'revalidate'])->group(function () {
    Route::get('/',[HomeController::class, 'index'])->name('/');
    Route::post('/logout',[AuthController::class, 'logout'])->name('logout');
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
        Route::get('/export-users', [UserController::class, 'export'])->name('export-users');
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
        Route::get('/export-categories', [CategoryController::class, 'export'])->name('export-categories');
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
        Route::get('/export-suppliers', [SupplierController::class, 'export'])->name('export-suppliers');
            Route::post('/storeSupplier',[SupplierController::class, 'store'])->name('supplier.store');
            Route::post('/updateSupplier/{id}',[SupplierController::class, 'update'])->name('supplier.update');
            Route::post('/restoreSupplier/{id}', [SupplierController::class, 'restore'])->name('supplier.restore');
                Route::delete('/deleteSupplier/{id}',[SupplierController::class, 'destroy'])->name('supplier.destroy');
                Route::delete('/destroySupplier/{id}', [SupplierController::class, 'force_destroy'])->name('supplier.force_destroy');
    });
    Route::prefix('product')->group(function () {
        Route::get('/',[ProductController::class, 'index'])->name('product.index');
        Route::get('/getProduct',[ProductController::class, 'getProduct'])->name('product.getProduct');
        Route::get('/editProduct/{id}',[ProductController::class, 'edit'])->name('product.edit');
        Route::get('/searchProduct',[ProductController::class, 'search'])->name('product.search');
        Route::get('/inforProduct/{id}',[ProductController::class, 'show'])->name('product.info');
        Route::get('/getProvinces', [ProductController::class, 'getProvinces'])->name('product.getProvinces');
        Route::get('/getDistricts', [ProductController::class, 'getDistricts'])->name('product.getDistricts');
        Route::get('/getWards', [ProductController::class, 'getWards'])->name('product.getWards');
        Route::get('/getTrashCanProduct', [ProductController::class, 'getTrashCan'])->name('product.getTrashCan');
        Route::get('/export-products', [ProductController::class, 'export'])->name('export-products');
            Route::post('/storeProduct',[ProductController::class, 'store'])->name('product.store');
            Route::post('/updateProduct/{id}',[ProductController::class, 'update'])->name('product.update');
            Route::post('/updateStatus/{id}/{status}',[ProductController::class, 'updateStatus'])->name('product.updateStatus');
            Route::post('/restoreProduct/{id}', [ProductController::class, 'restore'])->name('product.restore');
                Route::delete('/deleteProduct/{id}',[ProductController::class, 'destroy'])->name('product.destroy');
                Route::delete('/destroyProduct/{id}', [ProductController::class, 'force_destroy'])->name('product.force_destroy');
    });
    Route::prefix('banner')->group(function () {
        Route::get('/',[BannerController::class, 'index'])->name('banner.index');
        Route::get('/getBanner',[BannerController::class, 'getBanner'])->name('banner.getBanner');
            Route::post('/storeBanner',[BannerController::class, 'store'])->name('banner.store');
            Route::post('/updateBanner/{id}',[BannerController::class, 'update'])->name('banner.update');
            Route::post('/updateStatus/{id}/{status}',[BannerController::class, 'updateStatus'])->name('banner.updateStatus');
                Route::delete('/deleteBanner/{id}',[BannerController::class, 'destroy'])->name('banner.destroy');
    });
});
Route::prefix('shops')->group(function (){
    Route::get('/',function(){
        return view('shop.master');
    });
    Route::post('/checklogin',[ShopController::class, 'checkLogin'])->name('checklogin');
});
