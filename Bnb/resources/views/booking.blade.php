<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Boeking</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- jQuery UI voor datepicker -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <style>
        body {
            background-image: url('/images/achtergrond.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 40px;
        }

        .form-container {
            max-width: 700px;
            margin: 0 auto;
            background-color: rgba(255, 255, 255, 0.9);
            padding: 30px;
            border-radius: 10px;
            text-align: center;
        }

        h1 {
            background-color: #0e5aa7;
            color: white;
            display: inline-block;
            padding: 10px 30px;
            border-radius: 4px;
        }

        form {
            margin-top: 30px;
        }

        input, select, textarea {
            padding: 10px;
            margin: 10px 5px;
            border: 2px solid #0e5aa7;
            border-radius: 4px;
        }

        .date-group, .person-group {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
        }

        textarea {
            width: calc(90% - 20px);
            height: 100px;
            border-radius: 10px;
        }

        button {
            margin-top: 20px;
            padding: 10px 30px;
            background-color: #0e5aa7;
            color: white;
            font-weight: bold;
            border: none;
            cursor: pointer;
            font-size: 16px;
            border-radius: 6px;
        }

        button:hover {
            background-color: #084d8a;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h1>Boeking</h1>
    <form action="submit_booking.php" method="POST">

        <div class="date-group">
            <div>
                <label for="checkin">Incheckdatum:</label><br>
                <input type="text" id="checkin" name="checkin" placeholder="Selecteer datum" required>
            </div>
            <div>
                <label for="checkout">Uitcheckdatum:</label><br>
                <input type="text" id="checkout" name="checkout" placeholder="Selecteer datum" required>
            </div>
        </div>

        <div class="person-group">
            <div>
                <label for="volwassenen">Volwassenen:</label><br>
                <select name="volwassenen" id="volwassenen" required></select>
            </div>
            <div>
                <label for="kinderen">Kinderen:</label><br>
                <select name="kinderen" id="kinderen"></select>
            </div>
        </div>

        <div>
            <input type="text" name="voornaam" placeholder="Voornaam" required>
            <input type="text" name="achternaam" placeholder="Achternaam" required><br><br>
            <input type="email" name="email" placeholder="E-mailadres" required>
            <input type="tel" name="telefoon" placeholder="Telefoonnummer" required>
        </div>

        <div>
            <textarea name="vragen" placeholder="Vragen of opmerkingen..."></textarea>
        </div>
        
<form action="{{ route('boeking.store') }}" method="POST">
    @csrf
    <!-- je inputvelden hier -->
    <button type="submit">Boeken</button>
</form>



        


       
    </form>
</div>

<script>
    $(function () {
        const checkin = $("#checkin");
        const checkout = $("#checkout");

        checkin.datepicker({
            dateFormat: "dd-mm-yy",
            minDate: 0,
            onSelect: function (selectedDate) {
                const parts = selectedDate.split("-");
                const date = new Date(parts[2], parts[1] - 1, parts[0]);
                date.setDate(date.getDate() + 1);
                checkout.datepicker("option", "minDate", date);
            }
        });

        checkout.datepicker({
            dateFormat: "dd-mm-yy",
            minDate: 1
        });
    });

    function updatePersonOptions() {
        const volSelect = document.getElementById("volwassenen");
        const kindSelect = document.getElementById("kinderen");

        const huidigeVol = parseInt(volSelect.value) || 1;
        const huidigeKind = parseInt(kindSelect.value) || 0;

        kindSelect.innerHTML = "";
        for (let i = 0; i <= 4 - huidigeVol; i++) {
            const opt = document.createElement("option");
            opt.value = i;
            opt.text = i + (i === 1 ? " kind" : " kinderen");
            kindSelect.appendChild(opt);
        }
        if (huidigeKind <= 4 - huidigeVol) {
            kindSelect.value = huidigeKind;
        }

        volSelect.innerHTML = "";
        for (let i = 1; i <= 4 - huidigeKind; i++) {
            const opt = document.createElement("option");
            opt.value = i;
            opt.text = i + (i === 1 ? " volwassene" : " volwassenen");
            volSelect.appendChild(opt);
        }
        if (huidigeVol <= 4 - huidigeKind) {
            volSelect.value = huidigeVol;
        }
    }

    document.addEventListener("DOMContentLoaded", () => {
        const vol = document.getElementById("volwassenen");
        const kind = document.getElementById("kinderen");

        for (let i = 1; i <= 4; i++) {
            const opt = document.createElement("option");
            opt.value = i;
            opt.textContent = i + (i === 1 ? " volwassene" : " volwassenen");
            vol.appendChild(opt);
        }
        vol.value = 2;

        for (let i = 0; i <= 2; i++) {
            const opt = document.createElement("option");
            opt.value = i;
            opt.textContent = i + (i === 1 ? " kind" : " kinderen");
            kind.appendChild(opt);
        }
        kind.value = 0;

        vol.addEventListener("change", updatePersonOptions);
        kind.addEventListener("change", updatePersonOptions);
    });
</script>

</body>
</html>
