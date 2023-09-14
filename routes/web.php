<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});

// Route::get('/', function () {
//     return view('includes.header');
// });

// Route::get('/products', function () {
//     return view('includes.header');
// });

// Route::get('/orders', function () {
//     return view('includes.header');
// });

// Route::get('/account', function () {
//     return view('accounts.index');
// });

Route::post('/account/login',[AccountController::class,'login'])->name('account.login');

// Logout route
Route::post('/logout', [AccountController::class,'logout'])->name('account.logout');

Route::post('/account/register',[AccountController::class,'store'])->name('account.store');

// Route::get('/',[AccountController::class,'home'])->name('home');
// Route::post('/',[AccountController::class,'home'])->name('account.home');

Route::get('/account',[AccountController::class,'index'])->name('account.index');

// // Get data of account to Update
// Route::get('/account/edit/{id}',[AccountController::class,'edit'])->name('account.edit');

// Update Account
Route::put('/account/update/{id}',[AccountController::class,'update'])->name('account.update');

///////////////
// Products //

Route::post('/products/cart/{id}',[ProductController::class,'cart'])->name('products.cart');

Route::get('/',[ProductController::class,'index'])->name('products.index');

Route::get('/admin',[AdminController::class,'index'])->name('admin.index');

Route::get('/admin/orders',[AdminController::class,'orders'])->name('admin.orders');

// Show view to add new product
Route::view('/products/create','products.create')->name('product.create');

// Add new Product
Route::post('/products/store',[ProductController::class,'store'])->name('product.store');


// Get data of product to Update
Route::get('/products/edit/{id}',[ProductController::class,'edit'])->name('product.edit');

// Update Product
Route::put('/products/update/{id}',[ProductController::class,'update'])->name('product.update');

Route::put('/products/deact/{id}',[ProductController::class,'deactivate'])->name('product.deactivate');

Route::put('/products/act/{id}',[ProductController::class,'activate'])->name('product.activate');


Route::put('/products/rcart/{id}',[ProductController::class,'rcart'])->name('products.rcart');

Route::get('/products/search',[ProductController::class,'search'])->name('products.search');


/////////////
// Orders //

Route::get('/cart',[CartController::class,'index'])->name('cart.index');

Route::get('/orders',[OrderController::class,'index'])->name('orders.index');

Route::put('/orders/rcart/{id}',[CartController::class,'rcart'])->name('cart.rcart');
// Route::put('/orders/rcart',[CartController::class,'rcart'])->name('cart.rcart');
// Route::delete('/orders/rcart/{id}',[CartController::class,'rcart'])->name('cart.rcart');

Route::post('/orders/add',[OrderController::class,'store'])->name('orders.add');


Route::get('/login', function () {
    return view('accounts/login');
})->name('login');

/////////////////
// Categories //

// Show view to add new product
Route::view('/categories/create','Categories.create')->name('category.create');

// Show All Categories
Route::get('/categories',[CategoryController::class,'index'])->name('category.index');

// Show 1 Category
Route::get('/categorys/{id}',[CategoryController::class,'show'])->name('category.show');

// Get data of category to Update
Route::get('/categories/update/{id}',[CategoryController::class,'update'])->name('category.update');

// Edit category
Route::put('/categories/edit/{id}',[CategoryController::class,'edit'])->name('category.edit');

// Delete Category
Route::delete('/categories/delete/{id}',[CategoryController::class,'destroy'])->name('category.destroy');

// Add new Product
Route::post('/categories/store',[CategoryController::class,'store'])->name('category.store');
