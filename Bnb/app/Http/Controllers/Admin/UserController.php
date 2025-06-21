<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Boeking;


class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('adminpanel', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $validated['password'] = bcrypt($validated['password']);
        User::create($validated);

        return redirect()->route('admin.dashboard')->with('success', 'Gebruiker aangemaakt.');
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'is_admin' => 'nullable|boolean'
        ]);

        $user->update($validated);
        return redirect()->route('admin.dashboard')->with('success', 'Gebruiker bijgewerkt.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.dashboard')->with('success', 'Gebruiker verwijderd.');
    }
    public function boekingen(User $user)
{
    $boekingen = $user->boekingen()->latest()->get();

    return view('admin.users.boekingen', compact('user', 'boekingen'));
}
// Edit formulier tonen
public function editBoeking(User $user, Boeking $boeking)
{
    return view('admin.users.editboekingen', compact('user', 'boeking'));
}

// Update verwerken
// Update verwerken
public function updateBoeking(Request $request, User $user, Boeking $boeking)
{
    $validated = $request->validate([
        'telefoon' => ['required', 'regex:/^06\d{8}$/'],
        'incheck_datum' => 'required|date_format:d-m-Y',
        'uitcheck_datum' => 'required|date_format:d-m-Y|after_or_equal:incheck_datum',
        'totale_prijs' => 'required|numeric|min:0',
        'volwassenen' => 'required|integer|min:1|max:4',
        'kinderen' => 'nullable|integer|min:0|max:4',
    ]);

    // Datum omzetten van d-m-Y naar Y-m-d
    $checkin = \DateTime::createFromFormat('d-m-Y', $request->incheck_datum)->format('Y-m-d');
    $checkout = \DateTime::createFromFormat('d-m-Y', $request->uitcheck_datum)->format('Y-m-d');

    // Opslaan
    $boeking->update([
        'telefoon' => $request->telefoon,
        'checkin' => $checkin,
        'checkout' => $checkout,
        'bedrag' => $request->totale_prijs,
        'volwassenen' => $request->volwassenen,
        'kinderen' => $request->kinderen,
    ]);

    return redirect()->route('admin.users.boekingen', $user)->with('success', 'Boeking bijgewerkt.');
}


}
