<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ToggleUserTypeController extends Controller
{
    public function __invoke(Request $request)
    {
        $userType = $request->user_type;

        Session::put('user_type', $userType);

        return redirect('/');
    }
}
