<?php

namespace App\Providers;

use App\Models\Job;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::unguard();

        Gate::define('employer', function (User $user) {
            return $user->employer;
        });

        Gate::define('jobSeeker', function (User $user) {
            return $user->jobSeeker;
        });

        Gate::define('editJob', function (User $user, Job $job) {
            return $job->employer->user->is($user);
        });
    }
}
