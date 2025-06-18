<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Boeking; // Zorg dat je dit model hebt aangemaakt

class BoekingController extends Controller
{
    public function store(Request $request)
    {
        // Valideer het formulier
        $validated = $request->validate([
            'checkin' => 'required',
            'checkout' => 'required',
            'volwassenen' => 'required|integer',
            'kinderen' => 'nullable|integer',
            'voornaam' => 'required|string',
            'achternaam' => 'required|string',
            'email' => 'required|email',
            'telefoon' => 'required',
            'vragen' => 'nullable|string',
        ]);

        // Opslaan in de database
        Boeking::create($validated);

        return redirect('/booking')->with('success', 'Boeking succesvol opgeslagen!');
    }
}

