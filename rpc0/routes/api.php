<?php

use App\Http\Procedures\MathProcedure;
use Illuminate\Support\Facades\Route;

Route::rpc('/v1/endpoint', [MathProcedure::class]);
