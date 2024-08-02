<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('tasks', TaskController::class);

Route::post('tasks/{task}/archive', [TaskController::class, 'archive'])->name('tasks.archive');
Route::post('tasks/{task}/restore', [TaskController::class, 'restore'])->name('tasks.restore');
Route::post('tasks/{task}/assign', [TaskController::class, 'assign'])->name('tasks.assign');
Route::get('/tasks/assigned', [TaskController::class, 'assignedTasks'])->name('tasks.assigned');
Route::get('tasks/assigned-by-user', [TaskController::class, 'tasksAssignedByUser'])->name('tasks.assigned_by_user');
Route::get('tasks/filter', [TaskController::class, 'filterByStatus'])->name('tasks.filter');
Route::post('tasks/{task}/comments', [TaskController::class, 'storeComment'])->name('tasks.comments.store');

require __DIR__.'/auth.php';

Auth::routes();
