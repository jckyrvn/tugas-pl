<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
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
});

Route::group([
    'middleware'=> 'auth',
    'prefix'=> 'pages',
], function(){
    Route::post('/profile', [UserController::class, "create"])->name('profile');
    Route::get('/profile', [UserController::class, "showProfile"])->name('showProfile');
});