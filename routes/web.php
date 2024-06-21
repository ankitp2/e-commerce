<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SuscriberController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\AboutController;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\EmailController;

Route::get('/', function () {
    return view('index');
})->name('index');
Route::get('/signup', function () {
    return view('signup');
})->name('signup');
Route::post('registration', [UserController::class, 'store'])->name('register');
Route::post('login', [UserController::class, 'check'])->name('login');
Route::GET('logout', [UserController::class, 'logout'])->name('logout');
Route::GET('user/camera', [ProductController::class, 'showCamera'])->name('camera');
Route::GET('user/laptop', [ProductController::class, 'showLaptop'])->name('laptop');
Route::GET('user/mobile', [ProductController::class, 'showMobile'])->name('mobile');
Route::GET('userdata', [UserController::class, 'showAdmin'])->name('admin.user');
Route::GET('/admin/home', [OrderController::class, 'home'])->name('admin.home');
Route::GET('admin/product/add', [ProductController::class, 'create'])->name('admin.create');
Route::POST('admin/product', [ProductController::class, 'store'])->name('admin.save');
Route::GET('admin/product', [ProductController::class, 'index'])->name('admin.index');
Route::GET('admin/product/delete{id}', [ProductController::class, 'destroy'])->name('admin.delete');
Route::GET('admin/product/edit{id}', [ProductController::class, 'show'])->name('admin.show');
Route::POST('admin/product/update/{id}', [ProductController::class, 'update'])->name('admin.update');
Route::GET('admin/user/delete{id}', [UserController::class, 'destroy'])->name('user.delete');
Route::POST('user/suscribe', [SuscriberController::class, 'create'])->name('user.suscribe');
Route::GET('admin/suscriber', [SuscriberController::class, 'index'])->name('admin.suscriber');
Route::GET('admin/suscriber/{id}', [SuscriberController::class, 'destroy'])->name('delete.suscriber');
//cart
Route::POST('user/product/addtocart', [CartController::class, 'store'])->name('addtocart');
Route::GET('user/cart', [CartController::class, 'index'])->name('cart');
Route::GET('user/cart/delete{id}', [CartController::class, 'destroy'])->name('cart.delete');
Route::POST('user/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
Route::POST('user/cart/quantity', [CartController::class, 'update'])->name('cart.quantity');
Route::POST('user/cart/address', [AddressController::class, 'store'])->name('new.address');
Route::POST('user/cart/place_order', [OrderController::class, 'store'])->name('user.placeorder');
Route::GET('user/order', [OrderController::class, 'index'])->name('user.order');
Route::GET('admin/order', [OrderController::class, 'show'])->name('admin.order');
Route::GET('admin/order/edit{id}', [OrderController::class, 'edit'])->name('admin.edit');
Route::POST('admin/order/update{id}', [OrderController::class, 'update'])->name('admin.order.update');
Route::GET('admin/order/update{id}', [OrderController::class, 'cancel'])->name('user.order.cancel');
Route::GET('user/profile',[UserController::class,'profile'])->name('user.profile');
Route::POST('user/profile/address{id}',[AddressController::class,'update'])->name('address.update');
Route::GET('user/profile/address/delete{id}',[AddressController::class,'destroy'])->name('address.delete');
Route::POST('user/profile/password/update{id}',[UserController::class,'pass_update'])->name('password.update');
Route::GET('admin/home',[OrderController::class,'home'])->name('admin.home');
Route::POST('user/details/update{id}',[UserController::class,'userupdate'])->name('user.update');
Route::GET('admin/home/view/cm',[OrderController::class,'current_month'])->name('admin.order.cm');
Route::GET('admin/home/view/placed',[OrderController::class,'placed'])->name('admin.order.placed');
Route::GET('admin/home/view/confirmed',[OrderController::class,'confirmed'])->name('admin.order.confirmed');
Route::GET('admin/home/view/shipped',[OrderController::class,'shipped'])->name('admin.order.shipped');
Route::GET('admin/home/view/ofd',[OrderController::class,'ofd'])->name('admin.order.ofd');
Route::GET('admin/home/view/del_today',[OrderController::class,'del_today'])->name('admin.order.dt');
Route::GET('admin/home/view/cnc_today',[OrderController::class,'cnc_today'])->name('admin.order.ct');
Route::GET('admin/home/view/enquiry',[OrderController::class,'enquiry'])->name('admin.enquiry');
Route::POST('admin/home/result',[OrderController::class,'enquiry_result'])->name('admin.enquiryresult');
Route::GET('admin/coupons',[CouponController::class,'show'])->name('admin.addcoupons');
Route::GET('admin/coupons/show',[CouponController::class,'index'])->name('admin.showcoupons');
Route::POST('admin/coupons/add',[CouponController::class,'store'])->name('admin.coupon');
Route::GET('coupons/delete/{id}',[CouponController::class,'destroy'])->name('admin.coupon.delete');
Route::GET('coupons/edit/{id}',[CouponController::class,'edit'])->name('admin.coupon.edit');
Route::POST('coupons/update/{id}',[CouponController::class,'update'])->name('admin.coupon.update');
Route::POST('cart/coupons',[CouponController::class,'cart'])->name('admin.coupon.cart');
Route::POST('user/profile/pic',[UserController::class,'profile_pic'])->name('user.profilepic');
Route::GET('user/about',[AboutController::class,'show'])->name('user.about');
Route::GET('admin/about',[AboutController::class,'index'])->name('admin.about');
Route::POST('admin/about/update',[AboutController::class,'store'])->name('admin.about.store');
Route::GET('admin/addmultipleproduct',[ProductController::class,'multiple'])->name('admin.addmultipleproduct');
Route::POST('admin/addmultipleproduct/store',[ProductController::class,'multiple_store'])->name('admin.addmultipleproduct.store');
Route::GET('admin/product/form', [ProductController::class, 'productForms'])->name('admin.form.product');
Route::POST('admin/form/update', [ProductController::class, 'formUpdate'])->name('admin.form.update');
Route::get('admin/suscribers/export-csv', [SuscriberController::class, 'exportCSV'])->name('export.suscriber');
Route::post('admin/suscribers/import-csv', [SuscriberController::class, 'importCSV'])->name('import.suscriber');
Route::resource('suscriber', SuscriberController::class);
Route::GET('admin/users/export-csv', [UserController::class, 'exportCSV'])->name('export.user');
Route::POST('user/coupon/desc', [CouponController::class, 'description'])->name('coupon.desc');
Route::GET('send-mail',[EmailController::class,'sendWelcomeEmail']);