<?php

use App\Http\Controllers\FavoriteController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SellerController;
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
    Route::get('/favorite', [FavoriteController::class, "favorite"])->name('favorite');
    Route::get('/postfavorite/{id}', [FavoriteController::class, "postfavorite"])->name('postfavorite');
    Route::get('/destroyfavorite/{id}', [FavoriteController::class, "destroyfavorite"])->name('destroyfavorite');
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
});

Route::group([
    'middleware'=> 'auth',
    'prefix'=> 'pages',
], function(){
    Route::post('/profile', [UserController::class, "create"])->name('profile');
    Route::get('/profile', [UserController::class, "showProfile"])->name('showProfile');
    Route::get('/seller' , [UserController::class, "showSeller"])->name('seller');
});
