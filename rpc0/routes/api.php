<?php

use App\Http\Controllers\ProxyController;
use Illuminate\Support\Facades\Route;

Route::post('/process', [ProxyController::class, 'process']);
