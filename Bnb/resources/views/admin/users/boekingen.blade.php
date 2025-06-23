@extends('layout')

@section('title', 'Boekingen van ' . $user->name)

@section('content')
    <div class="container">
        <!--laat boekingen van [user] zien-->
        <h1>Boekingen van {{ $user->name }}</h1>

        <!--knop om terug naar adminpanel te gaan-->
        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary mb-3">← Terug naar adminpanel</a>
        
        <!--wnr user nog geen boekingen heeft laat die dit bericht zien-->
        @if ($boekingen->isEmpty())
            <p>Deze gebruiker heeft nog geen boekingen.</p>
            <!--wnr user wel boekingen heeft zie je de id, volwassenen, kinderen, telefoon, checkin, checkout, boeking bedrag en wnr de boeking is aangemaakt-->
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Aantal volwassenen</th>
                        <th>Aantal kinderen</th>
                        <th>Telefoonnummer</th>
                        <th>Incheckdatum</th>
                        <th>Uitcheckdatum</th>
                        <th>Totale prijs</th>
                        <th>Aangemaakt op</th>
                        <th>Acties</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($boekingen as $boeking)
                        <tr>
                            <td>{{ $boeking->id }}</td>
                            <td>{{ $boeking->volwassenen}}</td>
                            <td>{{ $boeking->kinderen}}</td>
                            <td>{{ $boeking->telefoon }}</td>
                            <td>{{ $boeking->checkin }}</td>
                            <td>{{ $boeking->checkout }}</td>
                            <td>€{{ number_format($boeking->bedrag, 2, ',', '.') }}</td>
                            <td>{{ $boeking->created_at->format('d-m-Y') }}</td>
                            <td class="d-flex gap-2 align-items-center">
                                <!--link naar pagina om boekingen te bewerken-->
                                <a href="{{ route('admin.users.boekingen.edit', [$user, $boeking]) }}"
                                    class="btn btn-sm btn-primary">Bewerk</a>

                                <!--link om boeking te verwijderen-->
                                <form action="{{ route('admin.users.boekingen.destroy', [$user, $boeking]) }}" method="POST"
                                    onsubmit="return confirm('Weet je zeker dat je deze boeking wilt verwijderen?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Verwijder</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
