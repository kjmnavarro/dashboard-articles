<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::resource('users', App\Http\Controllers\UserController::class)->middleware('can:edit');
    Route::resource('companies', App\Http\Controllers\CompanyController::class)->middleware('can:edit');

    Route::resource('writers', App\Http\Controllers\WriterController::class);
    Route::get('all-media/writers', [App\Http\Controllers\WriterController::class, 'allMedia'])->name('writers.allMedia');

    Route::get('editors', [App\Http\Controllers\EditorController::class, 'index'])->name('editors.index');
    Route::get('editors/{id}/edit', [App\Http\Controllers\EditorController::class, 'edit'])->name('editors.edit');
    Route::get('editors/{id}', [App\Http\Controllers\EditorController::class, 'update'])->name('editors.update');
    Route::get('all-media/editors', [App\Http\Controllers\EditorController::class, 'allMedia'])->name('editors.allMedia');

    
});