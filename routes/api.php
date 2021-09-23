<?php

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

Route::middleware('auth:api')->group(function () {
  Route::resource('url',App\Http\Controllers\UrlController::class)->only(['index','store','show','update','destroy']);
  Route::resource('response',App\Http\Controllers\ResponseController::class)->only(['show']);
});
Route::post('login', [App\Http\Controllers\AuthController::class, 'login'])->name('login');
