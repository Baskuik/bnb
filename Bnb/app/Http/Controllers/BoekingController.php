<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Boeking;
use Illuminate\Support\Facades\Mail;
use App\Mail\BoekingBevestiging;
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
            'telefoon' => 'required|regex:/^[0-9]{8,}$/',
            'vragen' => 'nullable|string|max:1000',
        ]);

        // ✅ Bereken aantal dagen en prijs
        $checkinDate = Carbon::createFromFormat('d-m-Y', $validated['checkin']);
        $checkoutDate = Carbon::createFromFormat('d-m-Y', $validated['checkout']);
        $dagen = $checkinDate->diffInDays($checkoutDate);
        $prijs = $dagen * 110;

        // ✅ Opslaan in database
        $boeking = Boeking::create([
            'checkin' => $checkinDate->format('Y-m-d'),
            'checkout' => $checkoutDate->format('Y-m-d'),
            'volwassenen' => $validated['volwassenen'],
            'kinderen' => $validated['kinderen'],
            'voornaam' => $validated['voornaam'],
            'achternaam' => $validated['achternaam'],
            'email' => $validated['email'],
            'telefoon' => $validated['telefoon'],
            'vragen' => $validated['vragen'],
        ]);

        // ✅ Verstuur bevestiging per e-mail
        Mail::to($validated['email'])->send(new BoekingBevestiging([
            'voornaam' => $validated['voornaam'],
            'achternaam' => $validated['achternaam'],
            'email' => $validated['email'],
            'checkin' => $validated['checkin'],
            'checkout' => $validated['checkout'],
            'dagen' => $dagen,
            'volwassenen' => $validated['volwassenen'],
            'kinderen' => $validated['kinderen'],
            'prijs' => $prijs
        ]));

        // ✅ Doorverwijzen naar de bedankpagina met info voor betaling
        return view('bedankt', [
            'voornaam' => $validated['voornaam'],
            'achternaam' => $validated['achternaam'],
            'dagen' => $dagen,
            'prijs' => $prijs
        ]);
    }

    public function betaal()
    {
        // Wordt geladen via route en view 'betaal.blade.php'
        return view('betaal');
    }
}
