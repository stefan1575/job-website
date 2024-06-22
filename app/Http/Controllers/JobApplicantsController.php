<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class JobApplicantsController extends Controller
{
    public function index()
    {
        $jobApplications = Auth::user()->employer->jobApplications()->with(['jobSeeker.user', 'job'])->latest()->paginate(10);

        return view('job-applicants.index', ['jobApplications' => $jobApplications]);
    }
}
