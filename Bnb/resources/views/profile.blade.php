@extends('layout')

@section('title', 'Mijn Gegevens')

@section('content')
    <h1>Mijn gegevens</h1>
    <p>Hier komt je profielinformatie.</p>

    <ul>
        <li>Naam: {{ Auth::user()->name }}</li>
        <li>Email: {{ Auth::user()->email }}</li>
        <h2>Mijn boekingen</h2>
@if($boekingen->isEmpty())
    <p>Je hebt nog geen boekingen.</p>
@else
    <table class="table">
        <thead>
            <tr>
                <th>Boeking ID</th>
                <th>Incheck datum</th>
                <th>Uitcheck datum</th>
                <th>Aantal volwassenen</th>
                <th>Aantal kinderen</th>
                <th>Totaal bedrag</th>
            </tr>
        </thead>
        <tbody>
            @foreach($boekingen as $boeking)
                <tr>
                    <td>{{ $boeking->id }}</td>
                    <td>{{ $boeking->checkin}}</td>
                    <td>{{ $boeking->checkout}}</td>
                    <td>{{ $boeking->volwassenen}}</td>
                    <td>{{ $boeking->kinderen}}</td>
                    <td>€{{ number_format($boeking->bedrag, 2, ',', '.') }}</td>

                </tr>
            @endforeach
        </tbody>
    </table>
@endif
    
    </ul>
@endsection
