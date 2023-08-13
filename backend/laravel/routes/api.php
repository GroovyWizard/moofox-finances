<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MonthlyTableController;
use App\Http\Controllers\FinanceController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

#Tables
Route::get('/table/list/{year}/{month}', [MonthlyTableController::class, 'list']);

#Finances
Route::delete('/finance/delete/{itemId}', [FinanceController::class, 'delete']);
Route::get('/greeting', function () {
    return 'Hello World';
});