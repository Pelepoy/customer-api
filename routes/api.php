<?php

use App\Http\Controllers\Api\CustomerController;
use Illuminate\Support\Facades\Route;


Route::get('/customers', [CustomerController::class, 'index']);
Route::get('/customers/{customerId}', [CustomerController::class,'show']);