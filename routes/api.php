<?php
use App\Http\Controllers\FileUploadController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

Route::post('/login', [AuthController::class, 'login']);

// Apply 'auth:api' middleware to secure these routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/users',[UserController::class, 'getAllUsers']);
    Route::post('/users', [UserController::class, 'apiStore']);

    Route::post('/upload', [FileUploadController::class, 'upload'])->name('upload');
    Route::delete('/files/{file}', [FileUploadController::class, 'deleteFile'])->name('file.delete');
});
