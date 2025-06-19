<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Boeking;
use Carbon\Carbon;

class BoekingController extends Controller
{
    public function store(Request $request)
    {
        // ✅ Validatie
        $validated = $request->validate([
            'checkin' => 'required|date_format:d-m-Y',
            'checkout' => 'required|date_format:d-m-Y|after:checkin',
            'volwassenen' => 'required|integer|min:1|max:4',
            'kinderen' => 'nullable|integer|min:0|max:4',
            'voornaam' => 'required|string|max:255',
            'achternaam' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telefoon' => 'required|string|max:20',
            'vragen' => 'nullable|string|max:1000',
        ]);

        // ✅ Opslaan in de database
        Boeking::create([
            'checkin' => Carbon::createFromFormat('d-m-Y', $validated['checkin'])->format('Y-m-d'),
            'checkout' => Carbon::createFromFormat('d-m-Y', $validated['checkout'])->format('Y-m-d'),
            'volwassenen' => $validated['volwassenen'],
            'kinderen' => $validated['kinderen'],
            'voornaam' => $validated['voornaam'],
            'achternaam' => $validated['achternaam'],
            'email' => $validated['email'],
            'telefoon' => $validated['telefoon'],
            'vragen' => $validated['vragen'],
        ]);

        // ✅ Redirect met succesbericht
        return redirect()->back()->with('success', 'Je boeking is succesvol ontvangen!');
    }
}


