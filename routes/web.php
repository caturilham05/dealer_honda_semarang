<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Admin\ProductsTypeController;
use App\Http\Controllers\Admin\PromoController;
use App\Http\Controllers\Admin\CreditTermsController;
use App\Http\Controllers\Admin\ContactsController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\ImagesController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/admin', [AuthController::class, 'index'])->middleware('guest');
Route::post('/admin', [AuthController::class, 'login'])->name('login');
Route::post('/admin/logout', [AuthController::class, 'logout']);

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    /*PRODUCTS*/
    Route::get('/admin/products', [ProductsController::class, 'index'])->name('admin.products');
    Route::get('/admin/products/products-list', [ProductsController::class, 'index'])->name('admin.products_list');
    Route::get('/admin/products/products-list/detail/{id}', [ProductsController::class, 'show_product'])->name('admin.products.products_detail');
    Route::get('/admin/products/products-list/create', [ProductsController::class, 'product_create'])->name('admin.products.create');
    Route::post('/admin/products/products-list/create', [ProductsController::class, 'product_store'])->name('admin.products.store');
    Route::get('/admin/products/products-list/edit/{id}', [ProductsController::class, 'edit_product'])->name('admin.products.edit_product');
    Route::put('/admin/products/products-list/edit/{id}', [ProductsController::class, 'update_product'])->name('admin.products.update_product');
    Route::put('/admin/products/products-list/edit/{id}/set-active', [ProductsController::class, 'update_product_active'])->name('admin.products.update_product_active');
    Route::delete('/admin/products/products-list/{id}', [ProductsController::class, 'destroy_product'])->name('admin.products.product_destroy');

    Route::get('/admin/products/products-type', [ProductsController::class, 'product_type'])->name('admin.products_type');
    Route::get('/admin/products/products-type/create', [ProductsController::class, 'product_type_create'])->name('admin.products.product_type_create');
    Route::post('/admin/products/products-type/create', [ProductsController::class, 'product_type_store'])->name('admin.products.product_type_store');
    Route::get('/admin/products/products-type/edit/{id}', [ProductsController::class, 'edit_product_type'])->name('admin.products.product_type_edit');
    Route::put('/admin/products/products-type/edit/{id}', [ProductsController::class, 'update_product_type'])->name('admin.products.product_type_update');
    Route::put('/admin/products/products-type/edit/{id}/set-active', [ProductsController::class, 'update_product_type_active'])->name('admin.products.update_product_type_active');
    Route::delete('/admin/products/products-type/{id}', [ProductsController::class, 'destroy_product_type'])->name('admin.products.product_type_destroy');

    Route::get('/admin/products/promo', [ProductsController::class, 'product_promo'])->name('admin.products.promo');
    Route::get('/admin/products/promo/create', [ProductsController::class, 'product_promo_create'])->name('admin.products.promo_create');
    Route::post('/admin/products/promo/create', [ProductsController::class, 'product_promo_store'])->name('admin.products.promo_store');
    Route::get('/admin/products/promo/edit/{id}', [ProductsController::class, 'edit_promo'])->name('admin.products.promo_edit');
    Route::put('/admin/products/promo/edit/{id}', [ProductsController::class, 'update_promo'])->name('admin.products.promo_update');
    Route::put('/admin/products/promo/edit/{id}/set-active', [ProductsController::class, 'update_promo_active'])->name('admin.products.promo_update_active');
    Route::delete('/admin/products/promo/{id}', [ProductsController::class, 'destroy_promo'])->name('admin.products.promo_destroy');
    /*PRODUCTS*/

    Route::get('/admin/credit', [CreditTermsController::class, 'index'])->name('admin.credit');

    Route::get('/admin/contact', [ContactsController::class, 'index'])->name('admin.contact');

    Route::get('/admin/user', [UserController::class, 'index'])->name('admin.user');
    
    Route::get('/admin/images', [ImagesController::class, 'index'])->name('admin.images');
    Route::get('/admin/images', [ImagesController::class, 'index'])->name('admin.images');
    Route::get('/admin/images/imageslider', [ImagesController::class, 'imageslider'])->name('admin.imageslider');

    /*Settings*/
    Route::get('/admin/navbars', [SettingsController::class, 'index'])->name('admin.navbars');
    Route::get('/admin/navbars/create', [SettingsController::class, 'create'])->name('admin.navbars.create');
    Route::post('/admin/navbars/create', [SettingsController::class, 'store'])->name('admin.navbars.store');
    Route::put('/admin/navbars/create/{id}', [SettingsController::class, 'update_menu_active'])->name('admin.navbars.update_active');
    /*Settings*/
});



Route::get('/', function () {
    return 'Public';
});
