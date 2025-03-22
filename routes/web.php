<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SubcategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', [FrontendController::class, 'welcome']);
Route::get('/dashboard', [HomeController::class, 'dashboard'])->middleware('auth', 'verified')->name('dashboard');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


// User
Route::get('/user/profile', [UserController::class, 'user_profile'])->name('user.profile');
Route::post('/user/profile/update', [UserController::class, 'user_profile_update'])->name('user.profile.update');
Route::post('/user/password/update', [UserController::class, 'user_password_update'])->name('user.password.update');
Route::post('/user/photo/update', [UserController::class, 'user_photo_update'])->name('user.photo.update');

// User List
Route::get('/user/list', [HomeController::class, 'user_list'])->name('user.list');
Route::get('/user/create', [HomeController::class, 'user_create'])->name('user.create');
Route::post('/user/store', [HomeController::class, 'user_store'])->name('user.store');
Route::get('/user/delete/{id}', [HomeController::class, 'user_delete'])->name('user.delete');


// Category
Route::get('/category/list', [CategoryController::class,'category_list'])->name('category.list');
Route::get('/category/create', [CategoryController::class,'category_create'])->name('category.create');
Route::post('/category/store', [CategoryController::class,'category_store'])->name('category.store');
Route::get('/category/edit/{id}', [CategoryController::class,'category_edit'])->name('category.edit');
Route::post('/category/update/{id}', [CategoryController::class,'category_update'])->name('category.update');
Route::get('/category/soft/delete/{id}', [CategoryController::class,'category_soft_delete'])->name('category.soft.delete');
Route::get('/category/trash', [CategoryController::class,'category_trash_list'])->name('category.trash');
Route::get('/category/restore/{id}', [CategoryController::class,'category_restore'])->name('category.restore');
Route::get('/category/permanent/delete/{id}', [CategoryController::class,'category_permanent_delete'])->name('category.permanent.delete');
Route::post('/checked/category/trash', [CategoryController::class,'checked_category_trash'])->name('checked.category.trash');
Route::post('/checked/category/restore', [CategoryController::class,'checked_category_restore'])->name('checked.category.restore');


// Subcategory
Route::get('/subcategory/list', [SubcategoryController::class, 'subcategory_list'])->name('subcategory.list');
Route::get('/subcategory/create', [SubcategoryController::class, 'subcategory_create'])->name('subcategory.create');
Route::post('/subcategory/store', [SubcategoryController::class, 'subcategory_store'])->name('subcategory.store');
Route::get('/subcategory/edit/{id}', [SubcategoryController::class, 'subcategory_edit'])->name('subcategory.edit');
Route::post('/subcategory/update/{id}', [SubcategoryController::class, 'subcategory_update'])->name('subcategory.update');
Route::get('/subcategory/delete/{id}', [SubcategoryController::class, 'subcategory_delete'])->name('subcategory.delete');


// Brand
Route::get('/brand/list', [BrandController::class, 'brand_list'])->name('brand.list');
Route::get('/brand/create', [BrandController::class, 'brand_create'])->name('brand.create');
Route::post('/brand/store', [BrandController::class, 'brand_store'])->name('brand.store');
Route::get('/brand/edit/{id}', [BrandController::class, 'brand_edit'])->name('brand.edit');
Route::post('/brand/update/{id}', [BrandController::class, 'brand_update'])->name('brand.update');
Route::get('/brand/delete/{id}', [BrandController::class, 'brand_delete'])->name('brand.delete');


// Products
Route::get('/porduct/list', [ProductController::class,'product_list'])->name('product.list');
Route::get('/porduct/create', [ProductController::class,'product_create'])->name('product.create');
Route::post('/porduct/store', [ProductController::class,'product_store'])->name('product.store');
Route::get('/porduct/view/{id}', [ProductController::class,'product_view'])->name('product.view');
Route::get('/porduct/edit/{id}', [ProductController::class,'product_edit'])->name('product.edit');
Route::post('/porduct/update/{id}', [ProductController::class,'product_update'])->name('product.update');
// product category ajax route start
Route::post('/getSubcategory', [ProductController::class, 'getSubcategory']);
Route::post('/getStatus', [ProductController::class, 'getStatus']);
// product category ajax route end
Route::get('/product/delete/{id}', [ProductController::class, 'product_delete'])->name('product.delete');
