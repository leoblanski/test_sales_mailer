<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\OrderController;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Employees (Vendedores)
Route::get('/employees/get/{employee}', [EmployeeController::class, 'get']);
Route::get('/employees/get-all', [EmployeeController::class, 'getAll']);
Route::post('/employees/create', [EmployeeController::class, 'create']);
Route::post('/employees/update/{employee}', [EmployeeController::class, 'update']);

// Orders (Vendas)
Route::resource('orders', OrderController::class);