<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ActivityController;

// List Notes View
Route::get('/', function () {
    return view('activities.index', ['activities' => \App\Models\Activity::latest()->get()] );
})->name('activities.index');


// Create note route
Route::get('/create', [ActivityController::class, 'create'])->name('activities.create');

Route::post('/store', action: [ActivityController::class, 'store'])->name('activities.store');

Route::get('/activities/{activity}', action: [ActivityController::class, 'show'])->name('activities.show');

Route::get('/activities/{activity}/edit', [ActivityController::class, 'edit'])->name('activities.edit');

Route::put('/activities/{activity}', [ActivityController::class, 'update'])->name('activities.update');

Route::delete('/activities/{activity}', [ActivityController::class, 'destroy'])->name('activities.destroy');