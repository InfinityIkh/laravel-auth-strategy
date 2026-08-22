<?php

use App\Http\Resources\UserResources;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::post('/{type}/login', [AuthController::class, 'login'])
         ->whereIn('type', ['spa', 'token']);
});

Route::middleware('auth:sanctum')->group(function(){
    Route::post('/logout' ,[AuthController::class ,'logout']);
    Route::get('profile' ,[AuthController::class ,'user']);
});