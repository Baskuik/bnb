<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Bevestiging boeking</title>
</head>
<body>
    <h2>Beste {{ $data['voornaam'] }} {{ $data['achternaam'] }},</h2>

    <p>Bedankt voor je boeking bij ons!</p>

    <p><strong>Incheck:</strong> {{ $data['checkin'] }}<br>
       <strong>Uitcheck:</strong> {{ $data['checkout'] }}<br>
       <strong>Dagen:</strong> {{ $data['dagen'] }}<br>
       <strong>Volwassenen:</strong> {{ $data['volwassenen'] }}<br>
       <strong>Kinderen:</strong> {{ $data['kinderen'] }}</p>

    <p><strong>Totaalprijs:</strong> €{{ number_format($data['prijs'], 2, ',', '.') }}</p>

    <p>We kijken ernaar uit je te verwelkomen!</p>

    <p>Met vriendelijke groet,<br>
    Het Boekingsteam</p>
</body>
</html>
