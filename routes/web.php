<?php

use Illuminate\Support\Facades\Route;

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
Auth::routes();
Route::get('/signin', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
/// home page
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/Home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/About Us', [App\Http\Controllers\HomeController::class, 'aboutus'])->name('aboutus');
Route::get('/Contact Us', [App\Http\Controllers\HomeController::class, 'contactus'])->name('contactus');
Route::get('/Privcy', [App\Http\Controllers\HomeController::class, 'privcy'])->name('privcy');
Route::get('Product/{id}', [App\Http\Controllers\HomeController::class, 'show_product'])->name('product.show');
Route::get('Category/{id}', [App\Http\Controllers\HomeController::class, 'category_product'])->name('category.product');
///user operation
Route::middleware('auth')->group(static function () {
    //...
    Route::delete('/User/Favorite/Delete/{id}', [App\Http\Controllers\UserController::class, 'destroy_favorite'])->name('user.favorite.destroy');
    Route::post('/User/Favorite/Add/{id}', [App\Http\Controllers\UserController::class, 'add_favorite'])->name('user.favorite.add');
    Route::get('/User/Card', [App\Http\Controllers\UserController::class, 'show_card'])->name('user.card');
    Route::post('/User/Card/Add/{id}', [App\Http\Controllers\UserController::class, 'add_card'])->name('user.card.add');
    Route::delete('/User/Card/Delete/{id}', [App\Http\Controllers\UserController::class, 'destroy_card'])->name('user.card.destroy');
    Route::post('/User/Card/Order/{id}', [App\Http\Controllers\UserController::class, 'order_card'])->name('user.card.order');
    Route::get('/User/Profile', [App\Http\Controllers\UserController::class, 'show'])->name('user.profile');
    Route::post('/User/Profile/Update', [App\Http\Controllers\UserController::class, 'update'])->name('user.profile.update');
    Route::get('/User/Orders', [App\Http\Controllers\UserController::class, 'show_order'])->name('user.order');
    Route::delete('/User/Orders/Delete/{id}', [App\Http\Controllers\UserController::class, 'destroy_order'])->name('user.order.destroy');    
    Route::post('/User/Comment/Add/{id}', [App\Http\Controllers\UserController::class, 'add_comment'])->name('user.comment.add');


});


////////////////// Admin pages//////////////////////
Route::get('/Admin/Show', [App\Http\Controllers\AdminController::class, 'show'])->name('admin.show')->middleware('is_admin');
Route::get('/Admin', [App\Http\Controllers\AdminController::class, 'index'])->name('dashoard')->middleware('is_admin');
Route::post('/Admin/Update', [App\Http\Controllers\AdminController::class, 'update'])->name('admin.update')->middleware('is_admin');

// admin [[product]] ->middleware('is_admin');
 Route::get('/Admin/Products/Show', [App\Http\Controllers\ProductController::class, 'index'])->name('admin.product.show')->middleware('is_admin');
 Route::get('/Admin/Products/Create', [App\Http\Controllers\ProductController::class, 'create'])->name('admin.product.create')->middleware('is_admin');
 Route::post('/Admin/Products/Store', [App\Http\Controllers\ProductController::class, 'store'])->name('admin.product.store')->middleware('is_admin');
 Route::get('/Admin/Products/Edit/{id}', [App\Http\Controllers\ProductController::class, 'edit'])->name('admin.product.edit')->middleware('is_admin');
 Route::post('/Admin/Products/Update/{id}', [App\Http\Controllers\ProductController::class, 'update'])->name('admin.product.update')->middleware('is_admin');
 Route::delete('/Admin/Products/Delete/{id}', [App\Http\Controllers\ProductController::class, 'destroy'])->name('admin.product.destroy')->middleware('is_admin');

// admin [[category]] 
 Route::get('/Admin/Category/Show', [App\Http\Controllers\CategoryController::class, 'index'])->name('admin.category.show')->middleware('is_admin');
 Route::get('/Admin/Category/Create', [App\Http\Controllers\CategoryController::class, 'create'])->name('admin.category.create')->middleware('is_admin');
 Route::post('/Admin/Category/Store', [App\Http\Controllers\CategoryController::class, 'store'])->name('admin.category.store')->middleware('is_admin');
 Route::get('/Admin/Category/Edit/{id}', [App\Http\Controllers\CategoryController::class, 'edit'])->name('admin.category.edit')->middleware('is_admin');
 Route::put('/Admin/Category/Update/{id}', [App\Http\Controllers\CategoryController::class, 'update'])->name('admin.category.update')->middleware('is_admin');
 Route::delete('/Admin/Category/Delete/{id}', [App\Http\Controllers\CategoryController::class, 'destroy'])->name('admin.category.destroy')->middleware('is_admin');
// admin [[comment]] 
 Route::get('/Admin/Comment/Show', [App\Http\Controllers\CommentController::class, 'index'])->name('admin.comment.show')->middleware('is_admin');
 Route::get('/Admin/Comment/Display/{id}', [App\Http\Controllers\CommentController::class, 'show'])->name('admin.comment.display')->middleware('is_admin');
 Route::post('/Admin/Comment/Replay/{id}', [App\Http\Controllers\CommentController::class, 'replay'])->name('admin.comment.replay')->middleware('is_admin');
 Route::delete('/Admin/Comment/Delete/{id}', [App\Http\Controllers\CommentController::class, 'destroy'])->name('admin.comment.destroy')->middleware('is_admin');
 Route::get('/Admin/Comment/Create', [App\Http\Controllers\CommentController::class, 'create'])->name('admin.comment.create')->middleware('is_admin');
 Route::post('/Admin/Comment/Store', [App\Http\Controllers\CommentController::class, 'store'])->name('admin.comment.store')->middleware('is_admin');
// admin [[order]] 
    Route::get('/Admin/Order/Show', [App\Http\Controllers\OrderController::class, 'index'])->name('admin.order.show')->middleware('is_admin');
    Route::delete('/Admin/Order/Delete/{id}', [App\Http\Controllers\OrderController::class, 'destroy'])->name('admin.order.destroy')->middleware('is_admin');
    Route::get('/Admin/Order/Display/{id}', [App\Http\Controllers\OrderController::class, 'show'])->name('admin.order.display')->middleware('is_admin');
// admin [[customars]] 
    Route::get('/Admin/Customer/Show', [App\Http\Controllers\OrderController::class, 'customer_index'])->name('admin.customer.customer_index')->middleware('is_admin');
    Route::get('/Admin/Customer/Display/{id}', [App\Http\Controllers\OrderController::class, 'customer_info'])->name('admin.customer.customer_info')->middleware('is_admin');
