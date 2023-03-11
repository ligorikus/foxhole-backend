<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\SteamAuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

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

Route::get('/auth/steam', [AuthController::class, 'steamAuth']);
Route::get('/auth/steam/callback', [AuthController::class, 'steamCallback']);

Route::group(['middleware' => ['auth:api']], function() {
    Route::get('/users', function () {
        return response()->json([123]);
    });
});
