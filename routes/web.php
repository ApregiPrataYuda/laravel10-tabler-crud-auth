<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Administrator;
use App\Http\Controllers\Auth;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/',[Auth::class,'login_page'])->name('Auth.login');


Route::get('Administrator/Dashboard',[Administrator::class,'index'])->name('Administrator.dashboard');

// Route::get('Administrator/Master-category',[Administrator::class,'Category'])->name('Administrator.category');
// Route::get('Administrator/Add-master-category',[Administrator::class,'Create'])->name('Administrator.add.category');
// Route::post('Administrator/save-master-category',[Administrator::class,'Store'])->name('Administrator.save.category');
// Route::post('/category/edit', [Administrator::class, 'Show'])->name('Administrator.edit.category');


Route::prefix('Administrator')->name('Administrator.')->group(function () {
    Route::get('Master-category', [Administrator::class, 'Category'])->name('category');
    Route::get('Add-master-category', [Administrator::class, 'Create'])->name('add.category');
    Route::post('save-master-category', [Administrator::class, 'Store'])->name('save.category');
    Route::post('category/edit', [Administrator::class, 'Show'])->name('edit.category');
    Route::put('category/update/{id}', [Administrator::class, 'Update'])->name('update.category');
    Route::delete('category/delete/{id}', [Administrator::class, 'Destroy'])->name('delete.category');
});



Route::prefix('Administrator')->name('Administrator.')->group(function () {
    Route::get('Products', [Administrator::class, 'Product'])->name('products');
    Route::get('Products-data', [Administrator::class, 'Get_data_product'])->name('products.get');
    Route::get('Add-product', [Administrator::class, 'Create_product'])->name('add.product');
    Route::post('save-product', [Administrator::class, 'Store_product'])->name('save.product');
    Route::post('product/edit', [Administrator::class, 'Show_product'])->name('edit.product');
    Route::put('product/update/{id}', [Administrator::class, 'Update_product'])->name('update.product');
    Route::delete('product/delete/{id}', [Administrator::class, 'Destroy_product'])->name('delete.product');
});