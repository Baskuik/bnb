<!DOCTYPE html>
<html lang="nl">
<head>

   @include('layout')

    <meta charset="UTF-8">
    <title>Bevestiging boeking</title>
    <style>
        body {
        font-family: 'Arial', sans-serif;
        background-color: #f6f6f6;
        color: #333;
        padding: 100px 20px 60px; /* Extra ruimte bovenin voor navbar */
        max-width: 700px;
         margin: auto;
    }


        h2 {
            color: #0e5aa7;
        }

        .box {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 12px rgba(0, 0, 0, 0.05);
        }

        .details p {
            font-size: 16px;
            line-height: 1.6;
        }

        .details strong {
            color: #0e5aa7;
        }

        .footer {
            margin-top: 30px;
            font-size: 14px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="box">
        <h2>Beste {{ $data['voornaam'] }} {{ $data['achternaam'] }},</h2>

        <p>Bedankt voor je boeking bij ons!</p>

        <div class="details">
            <p>
                <strong>Incheck:</strong> {{ $data['checkin'] }}<br>
                <strong>Uitcheck:</strong> {{ $data['checkout'] }}<br>
                <strong>Dagen:</strong> {{ $data['dagen'] }}<br>
                <strong>Volwassenen:</strong> {{ $data['volwassenen'] }}<br>
                <strong>Kinderen:</strong> {{ $data['kinderen'] ?? 0 }}
            </p>

            <p><strong>Totaalprijs:</strong> €{{ number_format($data['prijs'], 2, ',', '.') }}</p>
        </div>

        <p class="footer">We kijken ernaar uit je te verwelkomen!<br>
        Met vriendelijke groet,<br>
        Het Boekingsteam</p>
    </div>
</body>
</html>

