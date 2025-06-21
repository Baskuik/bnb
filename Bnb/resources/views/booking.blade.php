<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Boeking</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- jQuery UI voor datepicker -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    @extends('layout')
@section('content')
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

        .error {
            color: red;
            margin-top: 10px;
        }

        .error ul {
            list-style: none;
            padding: 0;
        }
    </style>
</head>
<body>



<div class="form-container">
    <h1>Boeking</h1>

    <!-- ✅ Foutmeldingen tonen -->
    @if ($errors->any())
        <div class="error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Laravel formulier -->
    <form action="{{ route('boeking.store') }}" method="POST">
        @csrf

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

            <!-- ✅ Telefoon met pattern voor validatie -->
            <input
    type="tel"
    name="telefoon"
    id="telefoon"
    placeholder="Telefoonnummer"
    required
    pattern="^06\d{8}$"
    title="Het nummer moet beginnen met 06 en precies 10 cijfers bevatten.">

        </div>

        <div>
            <textarea name="vragen" placeholder="Vragen of opmerkingen..."></textarea>
        </div>

        <button type="submit">Boeken</button>
    </form>
</div>

<script>
$(function () {
    let geboekteDatums = [];

    function formatDate(d) {
        let day = ("0" + d.getDate()).slice(-2);
        let month = ("0" + (d.getMonth() + 1)).slice(-2);
        let year = d.getFullYear();
        return `${day}-${month}-${year}`;
    }

    function isDatumBeschikbaar(date) {
        const formatted = formatDate(date);
        return [!geboekteDatums.includes(formatted)];
    }

    function initDatepickers() {
        const checkin = $("#checkin");
        const checkout = $("#checkout");

        checkin.datepicker("destroy").datepicker({
            dateFormat: "dd-mm-yy",
            minDate: 0,
            beforeShowDay: isDatumBeschikbaar,
            onSelect: function (selectedDate) {
                const parts = selectedDate.split("-");
                const date = new Date(parts[2], parts[1] - 1, parts[0]);
                date.setDate(date.getDate() + 1);
                checkout.datepicker("option", "minDate", date);
            }
        });

        checkout.datepicker("destroy").datepicker({
            dateFormat: "dd-mm-yy",
            minDate: 1,
            beforeShowDay: isDatumBeschikbaar
        });
    }

    // Haal geboekte datums op via AJAX
    $.ajax({
        url: "/api/geboekte-datums",
        method: "GET",
        dataType: "json",
        success: function(data) {
            geboekteDatums = data;
            console.log('Geboekte datums:', geboekteDatums);
            initDatepickers();
        },
        error: function() {
            alert("Kon geboekte datums niet ophalen.");
            initDatepickers();  // fallback
        }
    });

    // Personen dropdowns
    const vol = document.getElementById("volwassenen");
    const kind = document.getElementById("kinderen");

    for (let i = 1; i <= 4; i++) {
        const opt = document.createElement("option");
        opt.value = i;
        opt.textContent = i + (i === 1 ? " volwassene" : " volwassenen");
        vol.appendChild(opt);
    }
    vol.value = 2; // standaard

    function updatePersonOptions() {
        const volwassenenAantal = parseInt(vol.value);
        const maxKinderen = 4 - volwassenenAantal;

        const huidigeKinderWaarde = parseInt(kind.value) || 0;

        kind.innerHTML = '';
        for (let i = 0; i <= maxKinderen; i++) {
            const opt = document.createElement('option');
            opt.value = i;
            opt.textContent = i + (i === 1 ? ' kind' : ' kinderen');
            kind.appendChild(opt);
        }

        if (huidigeKinderWaarde <= maxKinderen) {
            kind.value = huidigeKinderWaarde;
        } else {
            kind.value = maxKinderen;
        }
    }

    vol.addEventListener("change", updatePersonOptions);
    kind.addEventListener("change", updatePersonOptions);
    updatePersonOptions();

    // ✅ Telefoonvalidatie: moet beginnen met 06 en precies 10 cijfers bevatten
    document.querySelector("form").addEventListener("submit", function (e) {
        const telefoonInput = document.getElementById("telefoon");
        const telefoon = telefoonInput.value.trim();
        const isGeldig = /^06\d{8}$/.test(telefoon); // 06 gevolgd door 8 cijfers

        if (!isGeldig) {
            e.preventDefault();
            alert("Voer een geldig Nederlands mobiel nummer in dat begint met 06 en precies 10 cijfers bevat.");
            telefoonInput.focus();
        }
    });
});
</script>




</body>
@endsection
</html>
