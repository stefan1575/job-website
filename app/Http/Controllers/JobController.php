<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jobs = Job::with('employer')->latest()->paginate(10);

        return view('jobs.index', ['jobs' => $jobs]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('jobs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $attributes = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'salary' => ['required', 'numeric'],
            'location' => ['required', 'string', 'max:255'],
            'schedule' => ['required', Rule::in(['Full Time', 'Part Time'])],
        ]);

        Auth::user()->employer->jobs()->create($attributes);

        return redirect('/jobs');
    }

    /**
     * Display the specified resource.
     */
    public function show(Job $job)
    {
        $jobs = Job::with('employer')->latest()->paginate(10);

        return view('jobs.show', ['jobs' => $jobs, 'job' => $job]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Job $job)
    {
        return view('jobs.edit', ['job' => $job]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Job $job)
    {
        request()->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'salary' => ['required', 'numeric'],
            'location' => ['required', 'string', 'max:255'],
            'schedule' => ['required', Rule::in(['Full Time', 'Part Time'])],
        ]);

        $job->update([
            'title' => request('title'),
            'description' => request('description'),
            'salary' => request('salary'),
            'location' => request('location'),
            'schedule' => request('schedule'),
        ]);

        return redirect('/jobs/' . $job->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Job $job)
    {
        $job->delete();
        return redirect('/jobs');
    }
}
