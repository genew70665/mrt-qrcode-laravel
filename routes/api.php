<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\QRCodeController;
use App\Http\Controllers\Api\UserController;

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

//New customer
Route::post('/register', [AuthController::class, 'register']);
//Existing customer
Route::post('/login', [AuthController::class, 'login']);
//Password Reset
Route::post('/password-reset', [UserController::class, 'passwordReset']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('qr-code/{code}', [QRCodeController::class, 'index']);
    Route::get('kit-qr-code/{code}', [QRCodeController::class, 'kit']);
    Route::put('update/{id}', [UserController::class, 'editUser']);
    Route::post('kit/track', [QRCodeController::class, 'store']);
    Route::post('/logout', [AuthController::class, 'logout']);
}); 
