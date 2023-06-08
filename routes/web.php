<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Login\LoginController;

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\QuizController;
use App\Http\Controllers\Admin\UserController;


use App\Http\Controllers\Website\HomeController;

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

//Login
Route::get('/login', [LoginController::class, 'getLogin'])->name('getLogin');
Route::post('/postLogin', [LoginController::class, 'postLogin'])->name('postLogin');

Route::get('/register', [LoginController::class, 'getRegister'])->name('getRegister');
Route::post('/postRegister', [LoginController::class, 'postRegister'])->name('postRegister');
Route::get('verify/{uuid}', [LoginController::class, 'verify'])->name('verify');

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
// Admin
Route::prefix('admin')->name('admin.')->middleware('check_login')->group(function () {
    Route::controller(CategoryController::class)->prefix('categories')->name('categories.')->group(
        function () {
            Route::get('/', 'index')->name('index');
            Route::get('/status_categories/{uuid}/{status}', 'status_categories')->name('status_categories');
            Route::post('/store', 'store')->name('store');
            Route::get('/edit/{uuid}', 'edit')->name('edit');
            Route::post('/update/{uuid}', 'update')->name('update');
            Route::get('/destroy/{uuid}', 'destroy')->name('destroy');
        }
    );
    Route::controller(QuizController::class)->prefix('quiz')->name('quiz.')->group(
        function () {
            Route::get('/', 'index')->name('index');
            Route::get('/status_quiz{uuid}/{status}', 'status_quiz')->name('status_quiz');
            Route::post('/store', 'store')->name('store');
            Route::get('/edit/{uuid}', 'edit')->name('edit');
            Route::post('/update/{uuid}', 'update')->name('update');
            Route::get('/destroy/{uuid}', 'destroy')->name('destroy');
        }
    );
    Route::controller(UserController::class)->prefix('users')->name('users.')->group(
        function () {
            Route::get('/', 'index')->name('index');
            Route::get('/status_user{uuid}/{status}', 'status_user')->name('status_user');
            Route::post('/store', 'store')->name('store');
            Route::get('/edit/{uuid}', 'edit')->name('edit');
            Route::post('/update/{uuid}', 'update')->name('update');
            Route::get('/destroy/{uuid}', 'destroy')->name('destroy');
        }
    );
});

//Website
Route::name('website.')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('index');
   
});
