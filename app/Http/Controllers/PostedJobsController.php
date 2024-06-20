<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Support\Facades\Auth;

class PostedJobsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employerId = Auth::user()->employer->id;

        $jobs = Job::where('employer_id', $employerId)->with('employer')->latest()->paginate(10);

        return view('posted-jobs.index', ['jobs' => $jobs]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Job $job)
    {
        $employerId = Auth::user()->employer->id;

        $jobs = Job::where('employer_id', $employerId)->with('employer')->latest()->paginate(10);

        return view('posted-jobs.show', ['jobs' => $jobs, 'job' => $job]);
    }

    public function edit(Job $job)
    {
        return view('jobs.edit', ['job' => $job]);
    }
}
