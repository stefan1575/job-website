<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Support\Facades\Auth;

class SavedJobsController extends Controller
{
    public function index()
    {
        $savedJobs = Auth::user()->jobSeeker->savedJobs()->with('job.employer')->latest()->paginate(10);
        $jobs = Job::latest();

        return view('saved-jobs.index', ['savedJobs' => $savedJobs, 'jobs' => $jobs]);
    }

    public function toggle(Job $job)
    {
        $savedJob = Auth::user()->jobSeeker->savedJobs()->where('job_id', $job->id)->first();
        if ($savedJob) {
            $savedJob->delete();
        } else {
            Auth::user()->jobSeeker->savedJobs()->create([
                'job_id' => $job->id
            ]);
        }

        return back();
    }
}
