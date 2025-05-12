<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;

Route::get('/', [TestController::class, 'create']) -> name('create');
Route::post('/', [TestController::class, 'store']);

Route::get('/show/{id}', [TestController::class, 'show']);