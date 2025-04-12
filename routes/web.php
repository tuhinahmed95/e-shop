<?php

use App\Http\Controllers\BannerController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\CustomerAuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\VariationController;
use Illuminate\Support\Facades\Route;

Route::get('/', [FrontendController::class, 'welcome'])->name('index');
Route::get('/product/details/{slug}', [FrontendController::class, 'product_details'])->name('product.details');
Route::post('/getSize', [FrontendController::class, 'getSize']);
Route::post('/getQuantity', [FrontendController::class, 'getQuantity']);
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


// Color
Route::get('/color/list', [VariationController::class, 'color_list'])->name('color.list');
Route::get('/color/create', [VariationController::class, 'color_create'])->name('color.create');
Route::post('/color/store', [VariationController::class, 'color_store'])->name('color.store');
Route::get('/color/edit/{id}', [VariationController::class, 'color_edit'])->name('color.edit');
Route::post('/color/update/{id}', [VariationController::class, 'color_update'])->name('color.update');
Route::get('/color/delete/{id}', [VariationController::class, 'color_delete'])->name('color.delete');

// Size
Route::get('/size/list', [VariationController::class,'size_list'])->name('size.list');
Route::get('/size/create', [VariationController::class,'size_create'])->name('size.create');
Route::post('/size/store', [VariationController::class,'size_store'])->name('size.store');
Route::get('/size/edit/{id}', [VariationController::class,'size_edit'])->name('size.edit');
Route::post('/size/update/{id}', [VariationController::class,'size_update'])->name('size.update');
Route::get('/size/delete/{id}', [VariationController::class,'size_delete'])->name('size.delete');

// Inventory
Route::get('/inventory/create/{id}', [InventoryController::class,'add_inventory'])->name('add.inventory');
Route::post('/inventory/store/{id}', [InventoryController::class,'inventory_store'])->name('inventory.store');
Route::get('/inventory/delete/{id}', [InventoryController::class, 'inventory_delete'])->name('inventory.delete');

// Banner
Route::get('/banner/list', [BannerController::class,'banner_list'])->name('banner.list');
Route::get('/banner/create', [BannerController::class,'banner_create'])->name('banner.create');
Route::post('/banner/store', [BannerController::class,'banner_store'])->name('banner.store');
Route::get('/banner/edit/{id}', [BannerController::class,'banner_edit'])->name('banner.edit');
Route::post('/banner/update/{id}', [BannerController::class,'banner_update'])->name('banner.update');
Route::get('/banner/delete/{id}', [BannerController::class,'banner_delete'])->name('banner.delete');

// Offer
Route::get('/offer/list', [OfferController::class,'offer_list'])->name('offer.list');
Route::get('/offer/edit/{id}', [OfferController::class,'offer1_edit'])->name('offer1.edit');
Route::post('/offer/update/{id}', [OfferController::class,'offer1_update'])->name('offer1.update');
// Offer2
Route::get('/offer2/edit{id}', [OfferController::class, 'offer2_edit'])->name('offer2.edit');
Route::post('/offer2/update{id}', [OfferController::class, 'offer2_update'])->name('offer2.update');


// Subscriber
Route::post('/subscriber/store', [FrontendController::class,'subscriber_store'])->name('subscriber.store');
Route::get('/subscriber/list', [HomeController::class,'subscriber_list'])->name('subscriber.list');

// Customer
Route::get('/customer/login', [CustomerAuthController::class,'customer_login'])->name('customer.login');
Route::get('/customer/register', [CustomerAuthController::class,'customer_register'])->name('customer.register');
Route::post('/customer/register/store', [CustomerAuthController::class,'customer_register_store'])->name('customer.register.store');
Route::post('/customer/logged', [CustomerAuthController::class,'customer_logged'])->name('customer.logged');
Route::get('/profile', [CustomerController::class,'profile'])->name('profile');
Route::get('/customer/logout', [CustomerController::class,'customer_logout'])->name('customer.logout');
Route::post('/customer/update', [CustomerController::class,'customer_update'])->name('customer.update');


// Cart
Route::post('/add/cart', [CartController::class, 'add_cart'])->name('add.cart');
Route::get('/cart/remove/{id}', [CartController::class,'cart_remove'])->name('cart.remove');
Route::get('/cart', [CartController::class,'cart'])->name('cart');
Route::post('/cart/update', [CartController::class,'cart_update'])->name('cart.update');

// Coupon
Route::get('/coupon/list',[CouponController::class,'coupon_list'])->name('coupon.list');
Route::get('/coupon/create',[CouponController::class,'coupon_create'])->name('coupon.crete');
Route::post('/coupon/store',[CouponController::class,'coupon_store'])->name('coupon.store');
Route::get('/coupon/status/{id}',[CouponController::class,'coupon_status'])->name('coupon.status');
Route::get('/coupon/edit/{id}',[CouponController::class,'coupon_edit'])->name('coupon.edit');
Route::post('/coupon/update/{id}',[CouponController::class,'coupon_update'])->name('coupon.update');
Route::get('/coupon/delete/{id}',[CouponController::class,'coupon_delete'])->name('coupon.delete');

// Checkout
Route::get('/chekout', [CheckoutController::class,'checkout'])->name('checkout');
Route::post('/getCity', [CheckoutController::class,'getCity']);
Route::post('/order/store', [CheckoutController::class,'order_store'])->name('order.store');
Route::get('/order/success', [CheckoutController::class,'order_success'])->name('order.success');
