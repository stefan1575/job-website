<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\JobApplication;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\File;

class ApplyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $job = Job::find(request('job_id'));

        return view('apply.index', ['job' => $job]);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'resume' => ['required', File::types('pdf')],
            'cover_letter' => [File::types('pdf')]
        ]);

        $resumePath = $request->resume->store('resumes');

        if ($request->cover_letter) {
            $coverLetterPath = $request->cover_letter->store('cover_letters');
        }

        JobApplication::create([
            'job_seeker_id' => Auth::user()->jobSeeker->id,
            'job_id' => $request->job_id,
            'resume' => $resumePath,
            'cover_letter' => $coverLetterPath ?? null,
        ]);

        return redirect('/jobs');
    }
}
