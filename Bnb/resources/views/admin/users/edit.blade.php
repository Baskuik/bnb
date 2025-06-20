@extends('layout')

@section('title', 'Gebruiker bewerken')

@section('content')
<div class="container">
    <h1>Gebruiker bewerken</h1>

    <form action="{{ route('admin.users.update', $user) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Naam</label>
            <input type="text" name="name" value="{{ $user->name }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" value="{{ $user->email }}" class="form-control" required>
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" name="is_admin" value="1" {{ $user->is_admin ? 'checked' : '' }}>
            <label class="form-check-label">Is admin</label>
        </div>
        <button class="btn btn-primary">Opslaan</button>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Annuleren</a>
    </form>
</div>
@endsection
