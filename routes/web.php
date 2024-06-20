<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ToggleUserTypeController;
use Illuminate\Support\Facades\Route;

Route::post('/toggle-user-type-view', ToggleUserTypeController::class)->name('toggleUserTypeView');
Route::view('/', 'index');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile/update-employer', [ProfileController::class, 'updateEmployer'])
        ->can('employer')
        ->name('profile.update.employer');

    Route::patch('/profile/update-job-seeker', [ProfileController::class, 'updateJobSeeker'])
        ->can('jobSeeker')
        ->name('profile.update.job-seeker');

    Route::patch('/profile/update-email', [ProfileController::class, 'updateEmail'])
        ->name('profile.update.email');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

require __DIR__ . '/auth.php';
