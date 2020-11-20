<?php

namespace App\Http\Controllers\Api;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;




Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();



});

    Route::post('/register', [AuthController::class,'register'])->name('register');
    Route::post('/login',[AuthController::class,'login'])->name('login');


	Route::apiResource('/ceo', 'Api\CEOController')->middleware('auth:api');

	Route::apiResource('/company','Api\CompanyController')->middleware('auth:api');

	Route::post('/logout',[AuthController::class,'logout'])->middleware('auth:api');
