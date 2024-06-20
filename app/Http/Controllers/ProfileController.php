<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserProfileUpdateRequest;
use App\Http\Requests\EmployerProfileUpdateRequest;
use App\Http\Requests\JobSeekerUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's email.
     */
    public function updateEmail(UserProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'user-profile-updated');
    }

    /**
     * Update the job seeker's profile information.
     */
    public function updateJobSeeker(JobSeekerUpdateRequest $request): RedirectResponse
    {

        $request->user()->jobSeeker->fill($request->validated());

        $request->user()->jobSeeker->save();

        return Redirect::route('profile.edit')->with('status', 'job-seeker-profile-updated');
    }


    /**
     * Update the employer's profile information.
     */
    public function updateEmployer(EmployerProfileUpdateRequest $request): RedirectResponse
    {
        $employer = $request->user()->employer;

        $name = $request->employer_name;
        $logo = $request->employer_logo;

        if ($name) {
            $employer->update([
                'name' => $name
            ]);
        }

        if ($logo) {
            $employer->update([
                'logo' => $logo->store('logos')
            ]);
        }

        $employer->save();

        return Redirect::route('profile.edit')->with('status', 'employer-profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
