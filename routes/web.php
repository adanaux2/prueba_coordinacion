<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\licenciaturaController;
use App\Http\Controllers\maestrosController;
use App\Http\Controllers\materiasControler;
use App\Http\Controllers\profesController;
use App\Http\Controllers\profesorController;
use App\Http\Controllers\registerController;
use App\Http\Controllers\rolesController;
use App\Http\Controllers\sessionsController;
use App\Http\Controllers\userController;

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





Route::view('coordinacion_maestros', '/views_coordinacion/maestros');
Route::view('mate','/views_coordinacion/materias');



Route::get('/register',[registerController::class, 'create'])
->name('register.index');

Route::post('/register',[registerController::class, 'store'])
->name('register.store');

Route::post('/register2',[registerController::class, 'store2'])
->name('register.store2');

Route::get('/login',[sessionsController::class, 'create'])
->name('login.index');

Route::post('/login',[sessionsController::class, 'store'])
->name('login.store');

Route::get('/login/destroy',[sessionsController::class, 'destroy'])
->name('login.destroy');


Route::post('/registerProfes',[profesorController::class, 'store'])
->name('registerProfes.store');



Route::apiResource('apiRoles', rolesController::class);
Route::apiResource('apiUser',userController::class);
Route::apiResource('apiProfe',profesorController::class);
Route::apiResource('apiMaterias',materiasControler::class);
Route::apiResource('apiLicenciaturas',licenciaturaController::class);