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
    Route::post('category-edit', [Administrator::class, 'Show'])->name('edit.category');
    Route::put('category-update/{id}', [Administrator::class, 'Update'])->name('update.category');
    Route::delete('category-delete/{id}', [Administrator::class, 'Destroy'])->name('delete.category');
});



Route::prefix('Administrator')->name('Administrator.')->group(function () {
    Route::get('Products', [Administrator::class, 'Product'])->name('products');
    Route::get('Products-data', [Administrator::class, 'Get_data_product'])->name('products.get');
    Route::get('Add-product', [Administrator::class, 'Create_product'])->name('add.product');
    Route::post('save-product', [Administrator::class, 'Store_product'])->name('save.product');
    Route::post('product-edit', [Administrator::class, 'Show_product'])->name('edit.product');
    Route::put('product-update/{id}', [Administrator::class, 'Update_product'])->name('update.product');
    Route::delete('product-delete/{id}', [Administrator::class, 'Destroy_product'])->name('delete.product');
});


Route::prefix('Administrator')->name('Administrator.')->group(function () {
    Route::get('Products-price', [Administrator::class, 'Price_product'])->name('price.products');
    Route::get('Products-price-data', [Administrator::class, 'Get_data_product_price'])->name('price.get');
    Route::get('Add-product-price', [Administrator::class, 'Create_product_price'])->name('add.product.price');
    Route::post('Save-product-price', [Administrator::class, 'Store_price_product'])->name('store.product.price');
    Route::get('product-price-edit/{id}', [Administrator::class, 'Show_product_price'])->name('edit.product.price');
    Route::put('product-price-update/{id}', [Administrator::class, 'Update_product_price'])->name('update.price.product');
    Route::delete('product-price-delete/{id}', [Administrator::class, 'Destroy_product_price'])->name('delete.product.price');

    // report data add
    Route::get('Report-Products-price-excel', [Administrator::class, 'Price_product_report_excel_all_data'])->name('price.products.report.excel');
    Route::get('Report-Products-price-pdf', [Administrator::class, 'Price_product_report_pdf_all_data'])->name('price.products.report.pdf');
    Route::get('Report-Products-price-csv', [Administrator::class, 'Price_product_report_csv_all_data'])->name('price.products.report.csv');

});