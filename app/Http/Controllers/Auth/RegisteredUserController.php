<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rules\File;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        if (Session::get('user_type') === 'Employer') {
            return view('auth.employer-register');
        } else {
            return view('auth.job-seeker-register');
        }
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if (Session::get('user_type') === 'Employer') {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'logo' => ['required', File::types(['svg', 'png', 'jpg', 'jpeg'])],
            ]);

            $logoPath = $request->logo->store('logos');

            $user->employer()->create([
                'name' => $request->name,
                'logo' => $logoPath,
            ]);
        } else {
            $request->validate([
                'first_name' => ['required', 'string', 'max:255'],
                'last_name' => ['required', 'string', 'max:255'],
            ]);

            $user->jobSeeker()->create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
            ]);
        }

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
