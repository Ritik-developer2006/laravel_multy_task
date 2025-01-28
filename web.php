<?php

use App\Http\Controllers\MyController;
use Illuminate\Support\Facades\Route;

Route::get('/', [MyController::class, 'picture']);
Route::post('/', [MyController::class, 'send_picture']);
