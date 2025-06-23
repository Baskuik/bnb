@extends('layout')

@section('title', 'Gebruiker aanmaken')

@section('content')
<div class="container">
    <h1>Nieuwe gebruiker</h1>

    <!--stuurt een POST-verzoek naar de route admin.users.store (dit is de actie die een nieuwe gebruiker opslaat).-->
    <form action="{{ route('admin.users.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <input type="text" placeholder="Naam" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <input type="email" placeholder="Email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <input type="password" placeholder="Wachtwoord" name="password" class="form-control" required>
        </div>
        <!--aanmaak knop om het formulier te verzenden-->
        <button class="btn btn-success">Aanmaken</button>
        <!--link terug naar admin panel-->
        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Annuleren</a>
    </form>
</div>
@endsection
