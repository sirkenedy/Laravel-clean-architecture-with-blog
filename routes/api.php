<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\controllers\API\v1\Auth\LoginController;
use App\Http\controllers\API\v1\Auth\RegistrationController;
use App\Http\controllers\API\v1\PostController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/*
|--------------------------------------------------------------------------
| Authentication Routes 
|--------------------------------------------------------------------------
| 
*/
Route::post('/login', LoginController::class);
Route::post('/register', RegistrationController::class);

Route::apiResource('posts', PostController::class);

