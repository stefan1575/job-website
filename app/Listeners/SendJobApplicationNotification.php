<?php

namespace App\Listeners;

use App\Events\JobApplicationSubmitted;
use App\Models\Employer;
use App\Notifications\NewJobApplication;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendJobApplicationNotification implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //

    }

    /**
     * Handle the event.
     */
    public function handle(JobApplicationSubmitted $event): void
    {
        Employer::find($event->jobApplication->job->employer->id)
            ->notify(new NewJobApplication($event->jobApplication));
    }
}
