<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatroomController;
use App\Http\Controllers\MessageController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/chatrooms', [ChatroomController::class, 'create']);
Route::get('/chatrooms', [ChatroomController::class, 'index']);
Route::post('/chatrooms/{chatroom}/enter', [ChatroomController::class, 'enter']);
Route::post('/chatrooms/{chatroom}/leave', [ChatroomController::class, 'leave']);
Route::post('/chatrooms/{chatroom}/messages', [MessageController::class, 'store']);
Route::get('/chatrooms/{chatroom}/messages', [MessageController::class, 'index']);