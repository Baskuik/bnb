<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Boeking;


class UserController extends Controller
{
    //haalt alle gebruikers op uit db. stuurt ze door naar de view adminpanel
    public function index()
    {
        $users = User::all();
        return view('adminpanel', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }
    //ontvant alle data vanuit formulier en valideert het.
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

    //$user is de user die je wilt aanpassen.
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    //$user is de user die bewerkt word
    //valideert de gegevens
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'is_admin' => 'nullable|boolean'
        ]);

        //update de user en data word opgeslagen en je word terug gestuurd naar admin dashboard met succes bericht
        $user->update($validated);
        return redirect()->route('admin.dashboard')->with('success', 'Gebruiker bijgewerkt.');
    }

    //verwijderd user uit database daarna krijg je succes berichtje
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.dashboard')->with('success', 'Gebruiker verwijderd.');
    }
    public function boekingen(User $user)
    {
        //haalt boekingen op. latest sorteert de boekingen zodat de nieuwste bovenaan  staat.
        $boekingen = $user->boekingen()->latest()->get();

        return view('admin.users.boekingen', compact('user', 'boekingen'));
    }
    //laat editformulier zien. Zorgt dat de view weet over welke user en welke boeking het gaat ($user).
    public function editBoeking(User $user, Boeking $boeking)
    {
        return view('admin.users.editboekingen', compact('user', 'boeking'));
    }

    //krijgt gegevens van formulier door $request
//$user is de user waar boeking bij hoort
//$boeking is de boeking die bewerkt word
    public function updateBoeking(Request $request, User $user, Boeking $boeking)
    {
        //valideert de gegevens
        $validated = $request->validate([
            'telefoon' => ['required', 'regex:/^06\d{8}$/'],
            'incheck_datum' => 'required|date_format:d-m-Y',
            'uitcheck_datum' => 'required|date_format:d-m-Y|after_or_equal:incheck_datum',
            'totale_prijs' => 'required|numeric|min:0',
            'volwassenen' => 'required|integer|min:1|max:4',
            'kinderen' => 'nullable|integer|min:0|max:4',
        ]);

        //datum omzetten van d-m-Y naar Y-m-d
        $checkin = \DateTime::createFromFormat('d-m-Y', $request->incheck_datum)->format('Y-m-d');
        $checkout = \DateTime::createFromFormat('d-m-Y', $request->uitcheck_datum)->format('Y-m-d');

        //bewerkt de gegevens in de database
        $boeking->update([
            'telefoon' => $request->telefoon,
            'checkin' => $checkin,
            'checkout' => $checkout,
            'bedrag' => $request->totale_prijs,
            'volwassenen' => $request->volwassenen,
            'kinderen' => $request->kinderen,
        ]);
        //je word terug gestuurd naar de boekingen
        return redirect()->route('admin.users.boekingen', $user);
    }


}
