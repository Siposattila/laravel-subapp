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

Route::get('/posts/{id}', [App\Http\Controllers\PostsController::class, 'search']);
Route::post('/posts', [App\Http\Controllers\PostsController::class, 'store']);
Route::put('/posts/{id}', [App\Http\Controllers\PostsController::class, 'update']);
Route::delete('/posts/{id}', [App\Http\Controllers\PostsController::class, 'destroy']);

Route::get('/users/{id}', [App\Http\Controllers\UsersController::class, 'search']);
Route::post('/users', [App\Http\Controllers\UsersController::class, 'store']);
Route::put('/users/{id}', [App\Http\Controllers\UsersController::class, 'update']);
Route::delete('/users/{id}', [App\Http\Controllers\UsersController::class, 'destroy']);
