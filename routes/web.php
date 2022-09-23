<?php

use Illuminate\Support\Facades\Route;

//CONTROLLERS
use App\Http\Controllers\EverTechController as EvCtrl;
use App\Http\Controllers\ProductController as ProdCtrl;
use App\Http\Controllers\OrderController as OrderCtrl;
use App\Http\Controllers\PaymentController as PayCtrl;

Use App\Models\Product;

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

Route::get('/', function () {
    if(Product::count()){
        return redirect()->route('product.show', Product::first());
    }
    
    return view('welcome');
});

Route::get('products/{product}', [ProdCtrl::class, 'show'])->name('product.show');

Route::prefix('orders')->group(function () {

    Route::get('/preview/{product}', [OrderCtrl::class, 'orderPreview'])
    ->name('order.preview');

    Route::get('/', [OrderCtrl::class, 'index'])
    ->name('order.index');

    Route::get('/{order}', [OrderCtrl::class, 'show'])
    ->name('order.show');

    Route::post('/{product}', [OrderCtrl::class, 'store'])
    ->name('order.store');
});

Route::get('payment/return-url', [PayCtrl::class, 'payResponse'])
->name('payment.response');