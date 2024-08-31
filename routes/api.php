<?php

use Illuminate\Support\Facades\Route;
use Radenparhanudin\WsAuth\Http\Controllers\AuthenticationController;

Route::middleware('api')
    ->prefix('api/ws-auth')
    ->controller(AuthenticationController::class)
    ->group(function () {
        Route::post("login", "login")->name("login");
        Route::post("logout", "logout")->name("logout")->middleware('auth:sanctum');
    });
