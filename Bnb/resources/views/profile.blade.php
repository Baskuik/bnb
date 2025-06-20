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
                <th>Datum</th>
                <th>Status</th>
                <!-- Voeg meer kolommen toe indien gewenst -->
            </tr>
        </thead>
        <tbody>
            @foreach($boekingen as $boeking)
                <tr>
                    <td>{{ $boeking->id }}</td>
                    <td>{{ $boeking->datum ?? 'N.v.t.' }}</td>
                    <td>{{ $boeking->status ?? 'Onbekend' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif
    
    </ul>
@endsection
