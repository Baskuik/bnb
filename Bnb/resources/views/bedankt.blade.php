<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Bedankt voor je boeking</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 100px;
            background-color: #f6f6f6;
        }

        h1 {
            color: #0e5aa7;
        }

        .prijs {
            font-size: 24px;
            margin-top: 30px;
            color: #333;
        }

        .knop {
            margin-top: 40px;
            display: inline-block;
            padding: 12px 24px;
            background-color: #0e5aa7;
            color: white;
            text-decoration: none;
            font-weight: bold;
            border-radius: 5px;
        }

        .knop:hover {
            background-color: #084d8a;
        }
    </style>
</head>
<body>
    <h1>Bedankt voor je boeking, {{ $voornaam }} {{ $achternaam }}!</h1>
    <p>Je hebt geboekt voor <strong>{{ $dagen }}</strong> {{ $dagen == 1 ? 'dag' : 'dagen' }}.</p>
    <div class="prijs">Totaal te betalen: <strong>€{{ number_format($prijs, 2, ',', '.') }}</strong></div>

    <a class="knop" href="/">
        Ga terug naar home
    </a>
</body>
</html>
