<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Registreren</title>
    <link rel="stylesheet" href="{{ asset('css/loginstyle.css') }}">
</head>
<body>
    <div class="login-container">
        <h2>Registreren</h2>
        @if ($errors->any())
            <div class="error">{{ $errors->first() }}</div>
        @endif
        <form method="POST" action="{{ url('/register') }}">
            @csrf
            <input type="text" name="name" placeholder="Naam" required>
            <input type="email" name="email" placeholder="E-mail" required>
            <input type="password" name="password" placeholder="Wachtwoord" required>
            <input type="password" name="password_confirmation" placeholder="Herhaal wachtwoord" required>
            <button type="submit">Registreren</button>
        </form>
        <p>Al een account? <a href="{{ route('login') }}">Login</a></p>
    </div>
</body>
</html>
