<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Boeking;
use Illuminate\Support\Facades\Mail;
use App\Mail\BoekingBevestigingMail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use App\Models\User;

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

        $bestaat = Boeking::where(function ($query) use ($checkinDate, $checkoutDate) {
            $query->whereBetween('checkin', [$checkinDate, $checkoutDate->copy()->subDay()])
                ->orWhereBetween('checkout', [$checkinDate->copy()->addDay(), $checkoutDate]);
        })->exists();

        if ($bestaat) {
            return back()->withErrors(['checkin' => 'De geselecteerde periode is al geboekt. Kies een andere datum.'])->withInput();
        }

        $dagen = $checkinDate->diffInDays($checkoutDate);
        $prijs = $dagen * 120;

        $data = [
            'checkin' => $validated['checkin'],
            'checkout' => $validated['checkout'],
            'volwassenen' => $validated['volwassenen'],
            'kinderen' => $validated['kinderen'],
            'voornaam' => $validated['voornaam'],
            'achternaam' => $validated['achternaam'],
            'email' => $validated['email'],
            'telefoon' => $validated['telefoon'],
            'vragen' => $validated['vragen'],
            'dagen' => $dagen,
            'prijs' => $prijs,
        ];

        $token = Str::uuid()->toString();
        Session::put('bevestig_token', $token);
        Session::put('bevestig_data', $data);

        $bevestigUrl = route('boeking.confirm', ['token' => $token]);

        Mail::to($validated['email'])->send(new BoekingBevestigingMail($data, $bevestigUrl));

        return view('bevestiging_verzonden');
    }

    public function confirm(Request $request)
    {
        $token = $request->query('token');
        $sessionToken = Session::get('bevestig_token');
        $data = Session::get('bevestig_data');

        if (!$token || $token !== $sessionToken || !$data) {
            return redirect('/')->with('error', 'Ongeldige of verlopen bevestigingslink.');
        }

        $checkinDate = Carbon::createFromFormat('d-m-Y', $data['checkin']);
        $checkoutDate = Carbon::createFromFormat('d-m-Y', $data['checkout']);

        Boeking::create([
            'user_id' => auth()->id(),
            'checkin' => $checkinDate->format('Y-m-d'),
            'checkout' => $checkoutDate->format('Y-m-d'),
            'volwassenen' => $data['volwassenen'],
            'kinderen' => $data['kinderen'],
            'bedrag' => $data['prijs'],
            'voornaam' => $data['voornaam'],
            'achternaam' => $data['achternaam'],
            'email' => $data['email'],
            'telefoon' => $data['telefoon'],
            'vragen' => $data['vragen'],
        ]);

        Session::forget('bevestig_token');
        Session::put('laatste_boeking', $data);
        Session::forget('bevestig_data');

        return redirect()->route('boeking.bedankt');
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

        return response()->json(array_values(array_unique($geboekteDatums)));
    }

    public function betaal()
    {
        $data = session('laatste_boeking');

        if (!$data) {
            return redirect('/')->with('error', 'Geen boekingsgegevens gevonden.');
        }

        return view('betaal', [
            'dagen' => $data['dagen'],
            'prijs' => $data['prijs'],
            'email' => $data['email']
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

    public function update(Request $request, User $user, Boeking $boeking)
    {
        $validated = $request->validate([
            'telefoon' => ['required', 'regex:/^06\d{8}$/'],
            'incheck_datum' => 'required|date',
            'uitcheck_datum' => 'required|date|after_or_equal:incheck_datum',
            'totale_prijs' => 'required|numeric|min:0',
        ]);

        $boeking->update($validated);

        return redirect()->route('admin.users.boekingen', $user)->with('success', 'Boeking bijgewerkt.');
    }
}
