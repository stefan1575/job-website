<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class AppliedJobsController extends Controller
{
    /**s
     * Display a listing of the resource.
     */
    public function index()
    {
        $jobApplications = Auth::user()->jobSeeker->jobApplications()->with('job.employer')->latest()->paginate(10);

        return view('applied-jobs.index', ['jobApplications' => $jobApplications]);
    }
}
