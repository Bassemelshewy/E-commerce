<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});



Route::middleware( ['auth', 'authadmin'] )->group( function () {
    ///////////////////////////category///////////////////////////
    Route::resource('/admin', CategoryController::class);

    ////////////////////////////Product///////////////////////////

    Route::get('/product/create',[ProductController::class, 'create']
    )->name('product.create');
    Route::post('/product/store',[ProductController::class, 'store']
    )->name('product.store');
    Route::get('/product/edit/{id}',[ProductController::class, 'edit']
    )->name('product.edit');
    Route::put('/product/update/{id}',[ProductController::class, 'update']
    )->name('product.update');
    Route::delete('/product/destroy/{id}',[ProductController::class, 'destroy']
    )->name('product.destroy');

    Route::get('/users',[ProfileController::class, 'index']
    )->name('admin.users');
    Route::delete('/users/delete/{id}',[ProfileController::class, 'destroyUser']
    )->name('admin.destroy');

} );

////////////////////////////////////////////////////////////////

Route:: middleware(['auth', 'verified', 'notauthadmin'])->group(function () {
    Route::get('/home',[CategoryController::class, 'index'])->name('category.index');
    Route::get('/home/show/{id}',[CategoryController::class, 'show'])->name('category.show');


    Route::get('/order/create/{id}',[OrderController::class, 'create'])->name('order.create');
    Route::post('/order/store',[OrderController::class, 'store'])->name('order.store');
    Route::get('/order/destroy/{id}',[OrderController::class, 'destroy'])->name('order.delete');


    Route::post('/order/add-to-order/{id}',[OrderController::class, 'addToOrder'])->name('order.addToOrder');
    Route::get('/order/show-order',[OrderController::class, 'showOrderSummary'])->name('order.showOrderSummary');
    Route::get('/order/remove-from-order/{id}',[OrderController::class, 'removeFromOrder'])->name('order.removeFromOrder');
    Route::get('/orders',[OrderController::class, 'show'])->name('order.show');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
