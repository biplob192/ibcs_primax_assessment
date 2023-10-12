<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProjectController;



// Public routes for any user
Route::post('register', [AuthController::class, 'register'])->name('register');
Route::post('login', [AuthController::class, 'login'])->name('login');


// Protected super_admin routes only
Route::group(['middleware' => ['auth:api', 'role:Super_Admin']], function () {
    // Route::apiResource('users', UserController::class, ['names' => 'users']);

    Route::post('users', [UserController::class, 'store'])->name('users.store');
    Route::put('users/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    // Route::delete('users/{id}', [UserController::class, 'destroy'])->name('users.destroy')->middleware(['deletableUser']);
});


// Protected routes for all the users except user
Route::group(['middleware' => ['auth:api', 'role:Super_Admin|Admin|Employee']], function () {
    Route::get('users', [UserController::class, 'index'])->name('users.index');
    Route::get('users/{id}', [UserController::class, 'show'])->name('users.show');
    Route::get('export/users', [UserController::class, 'export'])->name('users.export');
    Route::get('users/get/data', [UserController::class, 'getData'])->name('users.getData');
    Route::get('users/current/info', [UserController::class, 'info'])->name('users.info');

    Route::get('projects', [ProjectController::class, 'index'])->name('projects.index');
    Route::post('projects', [ProjectController::class, 'store'])->name('projects.store');
    Route::get('projects/{id}', [ProjectController::class, 'show'])->name('projects.show');
    Route::put('projects/{id}', [ProjectController::class, 'update'])->name('projects.update');
    Route::delete('projects/{id}', [ProjectController::class, 'destroy'])->name('projects.destroy');
    Route::get('projects/get/data', [ProjectController::class, 'getData'])->name('projects.getData');

    Route::post('project_tasks', [ProjectController::class, 'storeProjectTasks'])->name('projects.storeProjectTasks');
    Route::get('project_tasks/{id}', [ProjectController::class, 'getProjectTasks'])->name('projects.getProjectTasks');
});


// Protected routes for any user has any role
Route::group(['middleware' => ['auth:api', 'role:Super_Admin|Admin|Employee|User']], function () {
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('refresh', [AuthController::class, 'refresh'])->name('refresh')->middleware(['scopes:refresh']);
});
