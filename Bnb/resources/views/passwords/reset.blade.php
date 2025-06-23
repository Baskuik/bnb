@extends('layout')

@section('content')
    <div class="container mx-auto max-w-md mt-10">
        <h2 class="text-2xl mb-6">Nieuw wachtwoord instellen</h2>

        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $token }}">
            <input type="hidden" name="email" value="{{ $email }}">

            <div class="mb-4">
                <input id="password" placeholder="Wachtwoord" type="password" name="password" required
                    class="w-full border px-3 py-2 rounded @error('password') border-red-500 @enderror">

                @error('password')
                    <p class="text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">

                <input id="password_confirmation" placeholder="Bevestig nieuw wachtwoord" type="password"
                    name="password_confirmation" required class="w-full border px-3 py-2 rounded">
            </div>

            <button type="submit" class="bg-blue-600 text-black px-4 py-2 rounded hover:bg-blue-700">
                Wachtwoord resetten
            </button>
        </form>
    </div>
@endsection
