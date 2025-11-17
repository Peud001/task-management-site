<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('task.index');
});

Route::resource('tasks', TaskController::class)->except(['show']);
Route::post('tasks/reorder', [TaskController::class, 'reorder'])->name('tasks.reorder');

Route::resource('project', ProjectController::class)->only(['index', 'store']);