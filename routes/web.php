<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\maestrosController;
use App\Http\Controllers\registerController;
use App\Http\Controllers\sessionsController;

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

Route::get('/', function () {
    return view('auth/login');
});

Route::get('admin', function () {
    return view('admin');
});
Route::get('maestros', function () {
    return view('maestros');
});
Route::get('coordinacion', function () {
    return view('coordinacion');
});

Route::get('master', function () {
    return view('layouts/master');
});

Route::get('/register',[registerController::class, 'create'])
->name('register.index');

Route::post('/register',[registerController::class, 'store'])
->name('register.store');

Route::get('/login',[sessionsController::class, 'create'])
->name('login.index');

Route::post('/login',[sessionsController::class, 'store'])
->name('login.store');

Route::get('/login/destroy',[sessionsController::class, 'destroy'])
->name('login.destroy');


Route::resource('apiMaestros', maestrosController::class);

