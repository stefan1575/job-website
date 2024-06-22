<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Support\Facades\Auth;

class SavedJobsController extends Controller
{
    public function index()
    {
        $savedJobs = Auth::user()->jobSeeker->savedJobs()->with('job')->latest()->paginate(10);

        return view('saved-jobs.index', ['savedJobs' => $savedJobs]);
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
