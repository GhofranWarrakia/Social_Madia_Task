<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentingController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::apiResource('categories', CategoryController::class);
Route::apiResource('posts', PostController::class)->middleware('auth:api');

Route::post('posts/{post}/comments', [CommentingController::class, 'store'])->middleware('auth:api');
Route::put('comments/{comment}', [CommentingController::class, 'update'])->middleware('auth:api');
Route::delete('comments/{comment}', [CommentingController::class, 'destroy'])->middleware('auth:api');


