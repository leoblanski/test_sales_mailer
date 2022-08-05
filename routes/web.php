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

Route::get('/', function () {
    return view('index');
});

//Tratativa para qualquer endereço direcionar para a view com vue.
Route::get('/{any}', [App\Http\Controllers\SPAController::class, 'index'])->where('any', '.*');


// Auth::routes();
