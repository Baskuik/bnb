<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        /*controleert of er gelidge email en ww zijn ingevuld */
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        /*de auth::attempt vergelijkt de ingevulde gegevens met wat er in de db staat*/
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/  ');
        }
        /*word terug gestuurd met foutmelding*/
        return back()->withErrors([
            'email' => 'Ongeldige inloggegevens.',
        ]);
    }

    public function logout(Request $request)
    {
        /*auth::logout verwijderd de loginstatus daarna word je terug gestuurd naar login page*/
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

    // ✅ Deze methodes horen binnen de class
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        /*ww moet minimaal 6 tekens lang zijn en moet bevestigd worden password_confirmation*/
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        /*nieuwe gebruiker word aangemaakt en in db gezet. ww word gehasht door hash::make */
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);
        /* wnr de registratie succesvol is word je naar home page gestuurd*/
        Auth::login($user);
        return redirect('/');
    }
}
