<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\RouteController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// API

// Create
Route::post('createData',[RouteController::class,'createData']);

// Read
Route::get('getData',[RouteController::class,'getData']);

// Update
Route::post('updateData',[RouteController::class,'updateData']);

// Delete
Route::get('deleteData/{id}',[RouteController::class,'deleteData']);
