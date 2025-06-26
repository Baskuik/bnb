@extends('layout')

@section('title', 'Gebruiker bewerken')

@section('content')
<div class="container">
    <h1>Gebruiker bewerken</h1>

    <form action="{{ route('admin.users.update', $user) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <!--naam en email zijn vooraf ingevuld met de huidige value van de user-->
            <input type="text" placeholder="Naam" name="name" value="{{ $user->name }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <input type="email" placeholder="Email" name="email" value="{{ $user->email }}" class="form-control" required>
        </div>
        <div class="mb-3 form-check">
            <input type="hidden" name="is_admin" value="0">
<input type="checkbox" name="is_admin" value="1" {{ $user->is_admin ? 'checked' : '' }}>
            <label class="form-check-label">Is admin</label>
        </div>
        <!--opslaan knop-->
        <button class="btn btn-primary">Opslaan</button>
        <!--link terug naar adminpanel-->
        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Annuleren</a>
    </form>
</div>
@endsection
