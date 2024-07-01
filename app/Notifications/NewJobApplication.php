<?php

namespace App\Notifications;

use App\Models\JobApplication;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewJobApplication extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public JobApplication $jobApplication)
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database', 'mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $jobSeeker = $this->jobApplication->jobSeeker;
        $jobTitle =  $this->jobApplication->job->title;

        return (new MailMessage)
            ->subject("You have recieved a new Job Application")
            ->greeting("New job application from $jobSeeker->first_name")
            ->line("You have recieved a new job application for the $jobTitle position by $jobSeeker->first_name $jobSeeker->last_name")
            ->action("View Job Applicants", url('/job-applicants'))
            ->line("Thank you for using our application!");
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        $jobSeeker = $this->jobApplication->jobSeeker;
        $jobTitle =  $this->jobApplication->job->title;

        return [
            'message' =>  "A new job application has been submitted for the $jobTitle position by $jobSeeker->first_name $jobSeeker->last_name",
            'jobApplication_id' => $this->jobApplication->id
        ];
    }
}
