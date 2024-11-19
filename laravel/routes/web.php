<?php

use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/reports', function () {
    return view('reports');
})->name('reports');

Route::get('/users', [UsersController::class, 'index']);

Route::get('/users/{id}', [UsersController::class, 'show1']);

Route::post('/users', [UsersController::class, 'create']);

Route::get('/users/{id}', [UsersController::class, 'show']);

Route::put('/users/{id}', [UsersController::class, 'update']);

Route::delete('/users/{id}', [UsersController::class, 'destroy']);

Route::get('/search-users', [UsersController::class, 'searchUsers']);

Route::get('/get/groups', [UsersController::class, 'getGroups']);

Route::get('/get/pagination', [UsersController::class, 'pagination']);


Route::post('/background/update', [UsersController::class, 'updateBackground']);

Route::post('/background/delete', [UsersController::class, 'Image_delete'])->name('background.delete');

Route::get('/css/app.css', function () {
    return asset('app.css');
});
