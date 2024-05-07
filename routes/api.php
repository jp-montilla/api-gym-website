<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\CoachController;
use App\Http\Controllers\StudioController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('/studios',StudioController::class);
Route::apiResource('/coaches',CoachController::class);
Route::apiResource('/blogs',BlogController::class);
