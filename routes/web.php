<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmpleadoController;
use App\Models\Empleado;

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
    return view('auth.login');
});

/* Route::get('/empleado', function () {
    return view('empleado.index');
});

Route::get('/empleado/create', [EmpleadoController::class, 'create']);  */

Route::resource('empleado', EmpleadoController::class)->middleware('auth'); /* el middleware es para que te obligue a accder a sesion  */

Auth::routes(['register'=>false, 'reset'=>false]);

Route::get('/home', [EmpleadoController::class, 'index'])->name('home');




Route::group(['middleware'=>'auth'], function(){
    Route::get('/home', [EmpleadoController::class, 'index'])->name('home');
});