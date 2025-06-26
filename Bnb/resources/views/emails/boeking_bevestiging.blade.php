<!DOCTYPE html>
<html>
<head>
    <title>Bevestig je boeking</title>
</head>
<body>
    <h1>Hallo {{ $data['voornaam'] }},</h1>

    <p>Bedankt voor je boeking! Klik op de onderstaande link om je boeking te bevestigen:</p>

    <p><a href="{{ $bevestigUrl }}">Bevestig je boeking</a></p>

    <h3>Boekingsgegevens:</h3>
    <ul>
        <li>Check-in: {{ $data['checkin'] }}</li>
        <li>Check-out: {{ $data['checkout'] }}</li>
        <li>Aantal dagen: {{ $data['dagen'] }}</li>
        <li>Volwassenen: {{ $data['volwassenen'] }}</li>
        <li>Kinderen: {{ $data['kinderen'] ?? 0 }}</li>
        <li>Prijs: €{{ number_format($data['prijs'], 2) }}</li>
    </ul>

    <p>Als je deze boeking niet hebt aangevraagd, kun je deze e-mail negeren.</p>
</body>
</html>
