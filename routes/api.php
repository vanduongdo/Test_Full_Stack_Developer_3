<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TodoController;

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

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::get('/list-todo', [TodoController::class, 'list']);
    Route::post('/create-todo', [TodoController::class, 'create']);
    Route::post('/update-todo', [TodoController::class, 'update']);
    Route::post('/delete-todo', [TodoController::class, 'delete']);

    Route::get('/subscription', function (Request $request) {
        return $request->user()->subscription;
    });
    Route::post('/update-subscription', [TodoController::class, 'update_subscription']);
});


Route::post('/signup', [AuthController::class, 'signup']);
Route::post('/login', [AuthController::class, 'login']);