<?php

use App\Http\Controllers\MathController;
use App\Http\Procedures\MathProcedure;
use Illuminate\Support\Facades\Route;

Route::rpc('/v1/endpoint', [MathProcedure::class]);
Route::post('/v2/endpoint', [MathController::class, 'process']);
