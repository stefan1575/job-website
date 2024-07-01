<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class NotificationsController extends Controller
{
    public function markAsRead(): RedirectResponse
    {
        $notificationId = request('notification_id');

        if (Auth::user()?->employer) {
            Auth::user()->employer->notifications->find($notificationId)->markAsRead();

            $jobApplicationId = request('jobApplication_id');

            $jobApplications = Auth::user()->employer->jobApplications()->with(['jobSeeker.user', 'job'])->latest();

            // In the JobApplicants controller, there are 10 results per page
            // If a matching jobApplicationId is found, it means that $i is the current page
            for ($i = 1; $jobApplications->forPage($i, 10)->get()->isNotEmpty(); $i++) {
                foreach ($jobApplications->forPage($i, 10)->get() as $jobApplication) {
                    if ($jobApplication['id'] === (int) $jobApplicationId) {
                        return redirect('/job-applicants?page=' . $i)->with('status', $jobApplicationId);
                    }
                }
            }
        }
    }

    public function markAllAsRead(): RedirectResponse
    {
        if (Auth::user()?->employer) {
            Auth::user()->employer->unreadNotifications->markAsRead();
        }

        return back();
    }
}
