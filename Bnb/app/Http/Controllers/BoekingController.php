<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Boeking;
use Illuminate\Support\Facades\Mail;
use App\Mail\BoekingBevestiging;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class BoekingController extends Controller
{
    public function store(Request $request)
    {
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

        $checkinDate = Carbon::createFromFormat('d-m-Y', $validated['checkin']);
        $checkoutDate = Carbon::createFromFormat('d-m-Y', $validated['checkout']);

        // Controle of data al geboekt is
        $bestaat = Boeking::where(function ($query) use ($checkinDate, $checkoutDate) {
            $query->whereBetween('checkin', [$checkinDate, $checkoutDate->copy()->subDay()])
                ->orWhereBetween('checkout', [$checkinDate->copy()->addDay(), $checkoutDate]);
        })->exists();

        if ($bestaat) {
            return back()->withErrors(['checkin' => 'De geselecteerde periode is al geboekt. Kies een andere datum.'])->withInput();
        }

        $dagen = $checkinDate->diffInDays($checkoutDate);
        $prijs = $dagen * 110;

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

        Session::put('laatste_boeking', [
            'voornaam' => $validated['voornaam'],
            'achternaam' => $validated['achternaam'],
            'checkin' => $validated['checkin'],
            'checkout' => $validated['checkout'],
            'dagen' => $dagen,
            'volwassenen' => $validated['volwassenen'],
            'kinderen' => $validated['kinderen'],
            'prijs' => $prijs
        ]);

        return view('bedankt', [
            'voornaam' => $validated['voornaam'],
            'achternaam' => $validated['achternaam'],
            'dagen' => $dagen,
            'prijs' => $prijs
        ]);
    }

    public function geboekteDatums()
    {
        $boekingen = Boeking::all();
        $geboekteDatums = [];

        foreach ($boekingen as $boeking) {
            $start = Carbon::parse($boeking->checkin);
            $end = Carbon::parse($boeking->checkout)->subDay();

            for ($date = $start->copy(); $date->lte($end); $date->addDay()) {
                $geboekteDatums[] = $date->format('d-m-Y');
            }
        }

        return response()->json(array_unique($geboekteDatums));
    }

    public function betaal()
    {
        $data = session('laatste_boeking');

        if (!$data) {
            return redirect('/')->with('error', 'Geen boekingsgegevens gevonden.');
        }

        return view('betaal', [
            'dagen' => $data['dagen'],
            'prijs' => $data['prijs']
        ]);
    }

    public function bevestiging()
    {
        $data = session('laatste_boeking');

        if (!$data) {
            return redirect('/')->with('error', 'Geen boekingsgegevens gevonden.');
        }

        return view('boeking_bevestiging', ['data' => $data]);
    }

    public function bedankt()
    {
        $data = session('laatste_boeking');

        if (!$data) {
            return redirect('/')->with('error', 'Geen boekingsgegevens gevonden.');
        }

        return view('bedankt', [
            'voornaam' => $data['voornaam'],
            'achternaam' => $data['achternaam'],
            'dagen' => $data['dagen'],
            'prijs' => $data['prijs']
        ]);
    }
}
