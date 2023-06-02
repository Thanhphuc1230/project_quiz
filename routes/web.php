<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Login\LoginController;

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
Route::get('/login', [LoginController::class, 'getLogin'])->name('getLogin');

Route::get('/register', [LoginController::class, 'getRegister'])->name('getRegister');
Route::post('/postRegister', [LoginController::class, 'postRegister'])->name('postRegister');
Route::get('verify/{uuid}', [LoginController::class, 'verify'])->name('verify');
Route::get('/verify_email/{token}', [ProfileController::class, 'verifyEmail'])->name('verifyEmail');