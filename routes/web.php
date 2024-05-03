<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Admin\ProductsTypeController;
use App\Http\Controllers\Admin\PromoController;
use App\Http\Controllers\Admin\CreditTermsController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\ImagesController;
use App\Http\Controllers\Admin\ContentTypeController;

use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Public\ProductController;

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
    Route::get('/admin/dashboard/content/create', [DashboardController::class, 'create'])->name('admin.dashboard.create');
    Route::post('/admin/dashboard/content/create', [DashboardController::class, 'store'])->name('admin.dashboard.store');
    Route::get('/admin/dashboard/content/edit/{id}', [DashboardController::class, 'edit'])->name('admin.dashboard.edit');
    Route::put('/admin/dashboard/content/edit/{id}', [DashboardController::class, 'update'])->name('admin.dashboard.update');
    Route::put('/admin/dashboard/content/edit/{id}/set-active', [DashboardController::class, 'update_content_active'])->name('admin.dashboard.update_content_active');
    Route::delete('/admin/dashboard/{id}', [DashboardController::class, 'destroy'])->name('admin.dashboard.destroy');

    Route::get('/admin/content-type', [ContentTypeController::class, 'index'])->name('admin.content_type');
    Route::get('/admin/content-type/create', [ContentTypeController::class, 'create'])->name('admin.content_type.create');
    Route::post('/admin/content-type/create', [ContentTypeController::class, 'store'])->name('admin.content_type.store');
    Route::get('/admin/content-type/edit/{id}', [ContentTypeController::class, 'edit'])->name('admin.content_type.edit');
    Route::put('/admin/content-type/edit/{id}', [ContentTypeController::class, 'update'])->name('admin.content_type.update');
    Route::put('/admin/content-type/edit/{id}/set-active', [ContentTypeController::class, 'update_content_type_active'])->name('admin.content_type.update_content_type_active');
    Route::delete('/admin/content-type/{id}', [ContentTypeController::class, 'destroy'])->name('admin.content_type.destroy');

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

    Route::get('/admin/user', [UserController::class, 'index'])->name('admin.user');

    /*images*/
    Route::get('/admin/images', [ImagesController::class, 'index'])->name('admin.images');
    Route::get('/admin/images/imageslider', [ImagesController::class, 'imageslider'])->name('admin.images.imageslider');
    Route::get('/admin/images/imageslider/create', [ImagesController::class, 'imageslider_create'])->name('admin.images.imageslider_create');
    Route::post('/admin/images/imageslider/create', [ImagesController::class, 'imageslider_store'])->name('admin.images.imageslider_store');
    Route::get('/admin/images/imageslider/edit/{id}', [ImagesController::class, 'imageslider_edit'])->name('admin.images.imageslider_edit');
    Route::put('/admin/images/imageslider/edit/{id}', [ImagesController::class, 'imageslider_update'])->name('admin.images.imageslider_update');
    Route::put('/admin/images/imageslider/edit/{id}/set-active', [ImagesController::class, 'imageslider_update_active'])->name('admin.images.imageslider_update_active');
    Route::delete('/admin/images/imageslider/{id}', [ImagesController::class, 'imageslider_destroy'])->name('admin.images.imageslider_destroy');

    Route::get('/admin/images-category', [ImagesController::class, 'imageslider_category'])->name('admin.images.imageslider_category');
    Route::get('/admin/images-category/create', [ImagesController::class, 'imageslider_category_create'])->name('admin.images.imageslider_category_create');
    Route::post('/admin/images-category/create', [ImagesController::class, 'imageslider_category_store'])->name('admin.images.imageslider_category_store');
    Route::get('/admin/images-category/edit/{id}', [ImagesController::class, 'imageslider_category_edit'])->name('admin.images.imageslider_category_edit');
    Route::put('/admin/images-category/edit/{id}', [ImagesController::class, 'imageslider_category_update'])->name('admin.images.imageslider_category_update');
    Route::put('/admin/images-category/edit/{id}/set-active', [ImagesController::class, 'imageslider_category_update_active'])->name('admin.images.imageslider_category_update_active');
    Route::delete('/admin/images-category/{id}', [ImagesController::class, 'imageslider_category_destroy'])->name('admin.images.imageslider_category_delete');
    /*images*/

    /*Kontak*/
    Route::get('/admin/contact', [ContactController::class, 'index'])->name('admin.contact');
    Route::get('/admin/contact/create', [ContactController::class, 'create'])->name('admin.contact.create');
    Route::post('/admin/contact/create', [ContactController::class, 'store'])->name('admin.contact.store');
    Route::get('/admin/contact/edit/{id}', [ContactController::class, 'edit'])->name('admin.contact.edit');
    Route::put('/admin/contact/edit/{id}', [ContactController::class, 'update'])->name('admin.contact.update');
    Route::put('/admin/contact/edit/{id}/set-active', [ContactController::class, 'update_active'])->name('admin.contact.update_active');
    Route::delete('/admin/contact/{id}', [ContactController::class, 'destroy'])->name('admin.contact.destroy');
    /*Kontak*/

    /*Settings*/
    Route::get('/admin/navbars', [SettingsController::class, 'index'])->name('admin.navbars');
    Route::get('/admin/navbars/create', [SettingsController::class, 'create'])->name('admin.navbars.create');
    Route::post('/admin/navbars/create', [SettingsController::class, 'store'])->name('admin.navbars.store');
    Route::put('/admin/navbars/create/{id}', [SettingsController::class, 'update_menu_active'])->name('admin.navbars.update_active');
    /*Settings*/
});


Route::get('/', [HomeController::class, 'index'])->name('public.home');
Route::get('/home', [HomeController::class, 'index'])->name('public.home');

Route::get('/product', [DashboardController::class, 'home'])->name('public.product');
Route::get('/product-list', [ProductController::class, 'product_list'])->name('public.product_list');
Route::get('/product-list/items/{id}', [ProductController::class, 'product_list_items'])->name('public.product_list_items');
Route::get('/pricelist', [ProductController::class, 'price_list'])->name('public.product.pricelist');
Route::get('/pricelist/items/{id}', [ProductController::class, 'price_list_items'])->name('public.price_list_items');

Route::get('/credit', [DashboardController::class, 'home'])->name('public.product');
Route::get('/credit-terms', [DashboardController::class, 'home'])->name('public.credit_terms');
Route::get('/credit-simulation', [DashboardController::class, 'home'])->name('public.credit_simulation');
