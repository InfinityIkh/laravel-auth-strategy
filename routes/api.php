<?php

use App\Http\Resources\UserResources;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::post('auth/{type}/login', [AuthController::class, 'login'])
         ->whereIn('type', ['spa', 'token']);
});

Route::middleware('auth:sanctum')->group(function(){
    Route::post('auth/{type}/logout' ,[AuthController::class ,'logout']);
    Route::get('profile' ,[AuthController::class ,'user']);
});