<?php

use App\Http\Controllers\JobController;
use App\Http\Controllers\PostedJobsController;
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

// Employer specific routes
Route::get('/jobs/create', [JobController::class, 'create'])
    ->middleware('auth')
    ->can('employer');

Route::post('/jobs', [JobController::class, 'store'])
    ->middleware('auth')
    ->can('employer')
    ->name('job.create');

// Employer Job specific routes
Route::get('/jobs/{job}/edit', [JobController::class, 'edit'])
    ->middleware('auth')
    ->can('editJob', 'job');

Route::patch('/jobs/{job}', [JobController::class, 'update'])
    ->middleware('auth')
    ->can('editJob', 'job')
    ->name('job.update');

Route::delete('/jobs/{job}', [JobController::class, 'destroy'])
    ->middleware('auth')
    ->can('editJob', 'job')
    ->name('job.destroy');

Route::get('/jobs', [JobController::class, 'index']);
Route::get('/jobs/{job}', [JobController::class, 'show']);

Route::get('/posted-jobs', [PostedJobsController::class, 'index'])
    ->name('posted-jobs')
    ->middleware('auth')
    ->can('employer');

Route::get('/posted-jobs/{job}/edit', [PostedJobsController::class, 'edit'])
    ->middleware('auth')
    ->can('employer')
    ->can('editJob', 'job');

Route::get('/posted-jobs/{job}', [PostedJobsController::class, 'show'])
    ->middleware('auth')
    ->can('employer')
    ->can('editJob', 'job');

require __DIR__ . '/auth.php';
