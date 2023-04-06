<?php

use App\Http\Controllers\FavoriteController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BuyController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\PDFController;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;

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

Route::group([
    // 'middleware'=>'guest',
    'prefix' => 'auth',
], function(){
    Route::post('/login', [UserController::class, "login"])->name('login');
    Route::get('/login', [UserController::class, "index"])->name('auth.login');

    Route::post('/register', [UserController::class, "register"])->name('register');
    Route::get('/register', [UserController::class, "show"])->name('auth.register');

    Route::post('/logout', [UserController::class, "logout"])->name('logout');
});

Route::group([
    'middleware' => 'auth',
    'prefix' => 'post',
], function(){
    Route::get('/home', [HomeController::class, "index"])->name('home');
    Route::get('/detail/{id}', [DetailController::class, "detail"])->name('detail');
    
    Route::get('/favorite', [FavoriteController::class, "favorite"])->name('favorite');
    Route::get('/postfavorite/{id}', [FavoriteController::class, "postfavorite"])->name('postfavorite');
    Route::get('/destroyfavorite/{id}', [FavoriteController::class, "destroyfavorite"])->name('destroyfavorite');
    
    Route::get('/seller', [SellerController::class, "becomeseller"])->name('becomeseller');
    Route::post('/signupseller/{id}', [SellerController::class, "signupseller"])->name('signupseller');
    Route::post('/home/search', [HomeController::class, "search"])->name('search');
    
    Route::get('/carts', [CartController::class, "carts"])->name('carts');
    Route::get('/cart/{id}', [CartController::class, "cart"])->name('cart');
    Route::get('/postcart/{id}', [CartController::class, "postcart"])->name('postcart');
    Route::get('/destroycart/{id}', [CartController::class, "destroycart"])->name('destroycart');
});

Route::group([
    'middleware' => 'seller',
    'prefix' => 'seller'
], function(){
    Route::get('/home', [SellerController::class, "index"])->name('seller.home');
    Route::post('/postproduct', [SellerController::class, "postproduct"])->name('seller.postproduct');
    Route::get('/editproduct/{id}', [SellerController::class, "editproduct"])->name('editproduct');
    Route::post('/updateproduct/{id}', [SellerController::class, "updateproduct"])->name('updateproduct');
    Route::get('/destroyproduct/{id}', [SellerController::class, "destroyproduct"])->name('destroyproduct');
    
    Route::get('/orders', [SellerController::class, "orders"])->name('seller.orders');
    Route::get('/orders/{id}', [SellerController::class, "editorders"])->name('seller.editorders');
    Route::post('/updateorders/{id}', [SellerController::class, "updateorders"])->name('seller.updateorders');
});

Route::group([
    'middleware'=> 'auth',
    'prefix'=> 'pages',
], function(){
    Route::post('/profile', [UserController::class, "create"])->name('profile');
    Route::get('/profile/{id}', [UserController::class, "showProfile"])->name('showProfile');
    Route::get('/editProfile/{id}', [UserController::class, "editProfile"])->name('editProfile');
    Route::get('/seller/{id}' , [UserController::class, "showSeller"])->name('seller');
});

    Route::group([
    'middleware' => 'admin',
    'prefix' => 'admin'
], function(){
    Route::get('/home', [AdminController::class, "index"])->name('admin.home');
    Route::get('/approve/{id}', [AdminController::class, "approve"])->name('admin.approve');
    Route::get('/reject/{id}', [AdminController::class, "reject"])->name('admin.reject');
});

Route::group([
    'middleware' => 'auth',
    'prefix' => 'buy'
], function(){
    Route::get('/postbuy/{id}', [BuyController::class, "postbuy"])->name('postbuy');
});

Route::group([
    'middleware' => 'auth',
    'prefix' => 'pdf'
], function(){
    Route::get('/home/{id}', [PDFController::class, "home"])->name('pdf.home');
    Route::get('/exportpdf', [PDFController::class, "exportpdf"])->name('pdf.exportpdf');
});
