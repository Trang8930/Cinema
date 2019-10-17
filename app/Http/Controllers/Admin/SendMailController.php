<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\ConfirmRegisterMail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class SendMailController extends Controller
{
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    public function confirmRegistation($accessToken, Request $request)
    {   
        $user = User::where('access_token', $accessToken)->firstOrFail();
        $user->update(['is_active' => User::IS_ACTIVE]);
        Auth::guard()->login($user);

        return redirect('/');
    }
}
