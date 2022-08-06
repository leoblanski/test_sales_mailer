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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Employees (Vendedores)
Route::get('/employee/get/{employee}', [EmployeeController::class, 'get']);
Route::get('/employee/get-all', [EmployeeController::class, 'getAll']);
Route::post('/employee/create', [EmployeeController::class, 'create']);
Route::post('/employee/update/{employee}', [EmployeeController::class, 'update']);
Route::delete('/employee/delete/{employee}', [EmployeeController::class, 'delete']);

// Orders (Vendas)
Route::post('/order/create', [OrderController::class, 'create']);
Route::get('/order/get-all', [OrderController::class, 'getAll']);
