<?php

use App\Http\Controllers\ConfigController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\JobsController;
use App\Http\Controllers\OrderController;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
*/

// Employees (Vendedores)
Route::get('/employee/get/{employee}', [EmployeeController::class, 'get']);
Route::get('/employee/get-all', [EmployeeController::class, 'getAll']);
Route::post('/employee/create', [EmployeeController::class, 'create']);
Route::post('/employee/update/{employee}', [EmployeeController::class, 'update']);
Route::delete('/employee/delete/{employee}', [EmployeeController::class, 'delete']);

// Orders (Vendas)
Route::post('/order/create', [OrderController::class, 'create']);
Route::get('/order/get-all', [OrderController::class, 'getAll']);
Route::get('/order/get-sum-by-employee', [OrderController::class, 'getSumByEmployee']);

// Config (Configuração do envio de email)
Route::post('/config/update', [ConfigController::class, 'update']);
Route::get('/config/get', [ConfigController::class, 'get']);

// Email (Utilizado para envio de teste)
Route::post('/mail/sendMail', [EmailController::class, 'sendMail']);

// Jobs
Route::get("/jobs/get", [JobsController::class, 'getJobs']);
