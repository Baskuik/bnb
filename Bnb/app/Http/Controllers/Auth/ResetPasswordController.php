<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ResetPasswordController extends Controller
{
    public function showResetForm(Request $request, $token = null)
    {
        //de token is een beveiligings token gemaakt door laravel toen de user de ww-reset link ontving in de mail
        //dit is nodig omdat laravel dit token gebruikt om te controleren of de user een geldige link heeft
        //het email token is gwn zodat laravel weet welk account het ww van gereset word
        return view('passwords.reset')->with([
            'token' => $token,
            'email' => $request->email,
        ]);
    }

    //validatie kijkt of reset token aanwezig is of email er is en of het ww er is met min 6 tekens en moet overeen komen met de password_confirmation
    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
        ]);

        //checkt het reset token, of het emailadres klopt en kijkt of het ww voldoet aan validatie
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),

            function ($user, $password) {
                //nieuwe ww word gehasht en opgeslagen
                $user->password = Hash::make($password);
                //maakt bestaande remember me sessies ontgeldig 
                $user->setRememberToken(Str::random(60));
                //slaat change op in db
                $user->save();
            }
        );

        return $status == Password::PASSWORD_RESET
            //controleerd of het ww succesvol is gereset en dan word je doorgestuurd naar login page
            ? redirect()->route('login')->with('status', __($status))
            //geeft fout melding
            : back()->withErrors(['email' => [__($status)]]);
    }
}
