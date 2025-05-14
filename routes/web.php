<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Middleware\EncryptUserData;


Route::get('/', [TestController::class, 'create']) -> name('create');
Route::post('/', [TestController::class, 'store']);
// Route::post('/', [TestController::class, 'store']) -> middleware(EncryptUserData::class);


Route::get('/show/{id}', [TestController::class, 'show']);

Route::get('/all', [TestController::class, 'all']);