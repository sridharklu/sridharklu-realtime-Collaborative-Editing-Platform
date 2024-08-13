<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FileUploadController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Route::get('/home', [HomeController::class, 'index'])->name('chat');
// Route::get('/messages', [HomeController::class, 'messages'])->name('messages');
// Route::post('/message', [HomeController::class, 'message'])->name('message');


// Route::get('/load-chatbox', function () {
//     return view('chatbox');
// });


// Route::get('/fileUpload', [FileUploadController::class, 'index'])->name('fileUpload');
// Route::post('/upload', [FileUploadController::class, 'upload'])->name('upload');
// Route::delete('/files/{file}', [FileUploadController::class, 'deleteFile'])->name('file.delete');
// Route::get('/download/{file}', [FileUploadController::class, 'downloadFile'])->name('file.download');

// Route::middleware('auth')->group(function () {

    
//     Route::resource('roles', RoleController::class);
//     Route::resource('users', UserController::class);

// });



Route::middleware(['auth'])->group(function () {
    
    Route::get('/home', [HomeController::class, 'index'])->name('chat');
    Route::get('/messages', [HomeController::class, 'messages'])->name('messages');
    Route::post('/message', [HomeController::class, 'message'])->name('message');

    Route::get('/load-chatbox', function () {
        return view('chatbox');
    });

    Route::get('/fileUpload', [FileUploadController::class, 'index'])->name('fileUpload');
    Route::post('/upload', [FileUploadController::class, 'upload'])->name('upload');
    Route::delete('/files/{file}', [FileUploadController::class, 'deleteFile'])->name('file.delete');
    Route::get('/download/{file}', [FileUploadController::class, 'downloadFile'])->name('file.download');

    
    // Route::resource('users', UserController::class);
    //user management
    Route::get('/user/create',[UserController::class, 'create'])->name('users.create');
    Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::post('user/create', [UserController::class, 'store'])->name('users.store'); // Handles the form submission
    Route::get('user/{id}', [UserController::class, 'show'])->name('users.show');
    Route::get('user/edit/{id}', [UserController::class, 'edit'])->name('users.edit');
    Route::patch('user/edit/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('user/delete/{id}', [UserController::class, 'destroy'])->name('users.destroy');

    //role management
    Route::get('/roles', [RoleController::class, 'index'])->name('roles');
    Route::get('/roles/create',[RoleController::class, 'create'])->name('roles.create');
    Route::post('/roles/create',[RoleController::class, 'store'])->name('roles.store');
    Route::get('roles/{id}', [RoleController::class, 'show'])->name('roles.show');
    Route::get('roles/edit/{id}', [RoleController::class, 'edit'])->name('roles.edit');
    Route::patch('roles/edit/{id}', [RoleController::class, 'update'])->name('roles.update');
    Route::delete('roles/{id}', [RoleController::class, 'destroy'])->name('roles.destroy');
    

});









