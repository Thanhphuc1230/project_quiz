<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Login\LoginController;

use App\Http\Controllers\Admin\CategoryController;

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

Route::get('/register', [LoginController::class, 'getRegister'])->name('getRegister');
Route::post('/postRegister', [LoginController::class, 'postRegister'])->name('postRegister');
Route::get('verify/{uuid}', [LoginController::class, 'verify'])->name('verify');


// Admin
Route::prefix('admin')->name('admin.')->group(function () {
    
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
 
});