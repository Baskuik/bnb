<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    public function showLinkRequestForm()
    {
        return view('passwords.email');
    }

    public function sendResetLinkEmail(Request $request)
    {
        //email validatie
        $request->validate(['email' => 'required|email']);

        //verstuurd reset link
        $status = Password::sendResetLink(
            $request->only('email')
        );
        return $status === Password::RESET_LINK_SENT
            //wnr de mail succesvol is verstuurd ga je tuerg met sucessbericht
            ? back()->with(['status' => __($status)])
            //als het niet lukt krijg je fout melding
            : back()->withErrors(['email' => __($status)]);
    }
}
