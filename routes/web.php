<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'verified'])->group(function () {
    // Tasks
    Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
    Route::get('/tasks/create', [TaskController::class, 'create'])->name('tasks.create');
    Route::get('/tasks/{task}', [TaskController::class, 'show'])
        ->name('tasks.show')
        ->can('view', 'task');
    Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
    Route::get('/tasks/{task}/edit', [TaskController::class, 'edit'])
        ->name('tasks.edit')
        ->can('view', 'task');
    Route::patch('/tasks/{task}', [TaskController::class, 'update'])
        ->name('tasks.update')
        ->can('view', 'task');
    Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])
        ->name('tasks.destroy')
        ->can('view', 'task');
    Route::put('/tasks/{task}', [TaskController::class, 'update'])
        ->name('tasks.update')
        ->can('view', 'task');
    // Task Tokens
    Route::get('/tasks/{task}/generate-token', [TaskController::class, 'generateToken'])
        ->name('tasks.generateToken')
        ->can('view', 'task');

});

Route::get('/tasks/public/{token}', [TaskController::class, 'showPublic'])->name('tasks.public');

require __DIR__.'/auth.php';
