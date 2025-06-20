@extends('layout')

@section('title', 'Gebruiker aanmaken')

@section('content')
<div class="container">
    <h1>Nieuwe gebruiker</h1>

    <form action="{{ route('admin.users.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Naam</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Wachtwoord</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button class="btn btn-success">Aanmaken</button>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Annuleren</a>
    </form>
</div>
@endsection
