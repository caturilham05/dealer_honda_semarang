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
    Route::get('/admin/products', [ProductsController::class, 'index'])->name('admin.products');
    Route::get('/admin/products-type', [ProductsTypeController::class, 'index'])->name('admin.products_type');
    Route::get('/admin/promo', [PromoController::class, 'index'])->name('admin.promo');
    Route::get('/admin/credit', [CreditTermsController::class, 'index'])->name('admin.credit');
    Route::get('/admin/contact', [ContactsController::class, 'index'])->name('admin.contact');
    Route::get('/admin/user', [UserController::class, 'index'])->name('admin.user');

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
