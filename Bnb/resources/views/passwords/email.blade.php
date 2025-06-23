@extends('layout')

@section('content')
    <div class="container mx-auto max-w-md mt-10">
        <h2 class="text-2xl mb-6">Wachtwoord vergeten</h2>

        @if (session('status'))
            <div class="bg-green-100 text-green-700 p-4 mb-4 rounded">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="mb-4">
                <input id="email" type="email" name="email" placeholder="E-mail adres" value="{{ old('email') }}"
                    required autofocus class="w-full border px-3 py-2 rounded @error('email') border-red-500 @enderror">

                @error('email')
                    <p class="text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="bg-blue-600 text-black px-4 py-2 rounded hover:bg-blue-700">
                Stuur wachtwoord reset link
            </button>
        </form>
    </div>
@endsection
