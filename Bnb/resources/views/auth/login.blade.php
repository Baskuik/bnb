<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/loginstyle.css') }}">
</head>

<body>
    <div class="login-container">
        <h2>Inloggen</h2>
        <!-- geeft error wnr login mislukt -->
        @if ($errors->any())
            <div class="error">{{ $errors->first() }}</div>
        @endif
        <form method="POST" action="{{ url('/login') }}">
            @csrf
            <input type="email" name="email" placeholder="E-mail" required>
            <input type="password" name="password" placeholder="Wachtwoord" required>
            <button type="submit">Login</button>
        </form>
        <p>Nog geen account? <a href="{{ route('register') }}">Registreer hier</a></p>
        @if (Route::has('password.request'))
    <a href="{{ route('password.request') }}">
        Wachtwoord vergeten?
    </a>
@endif
    </div>
</body>

</html>
