@extends('layout')

@section('content')
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <style>
        /* Zelfde stijlen als booking.blade.php */
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

        .date-group, .person-group {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
        }

        input, select, textarea {
            padding: 10px;
            margin: 10px 5px;
            border: 2px solid #0e5aa7;
            border-radius: 4px;
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

        .error {
            color: red;
        }
    </style>

    <div class="form-container">
        <h1>Bewerk Boeking</h1>

        @if ($errors->any())
            <div class="error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.users.boekingen.update', [$user->id, $boeking->id]) }}">
            @csrf
            @method('PUT')

            <div class="date-group">
                <div>
                    <label for="checkin">Check-in:</label><br>
                    <input type="text" id="checkin" name="incheck_datum" value="{{ \Carbon\Carbon::parse($boeking->checkin)->format('d-m-Y') }}" required>
                </div>
                <div>
                    <label for="checkout">Check-out:</label><br>
                    <input type="text" id="checkout" name="uitcheck_datum" value="{{ \Carbon\Carbon::parse($boeking->checkout)->format('d-m-Y') }}" required>
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
                <label for="telefoon">Telefoonnummer:</label><br>
                <input type="tel" name="telefoon" id="telefoon" pattern="^06\d{8}$" title="Het nummer moet beginnen met 06 en precies 10 cijfers bevatten." value="{{ $boeking->telefoon }}" required>
            </div>

            <div>
                <label for="bedrag">Totaalbedrag (€):</label><br>
                <input type="text" name="totale_prijs" value="{{ $boeking->bedrag }}" required>
            </div>

            <button type="submit">Boeking bijwerken</button>
            <a href="{{ url('/admin') }}" class="btn btn-secondary" style="margin-left: 10px;">Annuleren</a>
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
                $("#checkin").datepicker({
                    dateFormat: "dd-mm-yy",
                    minDate: 0,
                    beforeShowDay: isDatumBeschikbaar,
                    onSelect: function (selectedDate) {
                        const parts = selectedDate.split("-");
                        const date = new Date(parts[2], parts[1] - 1, parts[0]);
                        date.setDate(date.getDate() + 1);
                        $("#checkout").datepicker("option", "minDate", date);
                    }
                });

                $("#checkout").datepicker({
                    dateFormat: "dd-mm-yy",
                    minDate: 1,
                    beforeShowDay: isDatumBeschikbaar
                });
            }

            $.ajax({
                url: "/api/geboekte-datums",
                method: "GET",
                dataType: "json",
                success: function (data) {
                    geboekteDatums = data;
                    initDatepickers();
                },
                error: function () {
                    alert("Kon geboekte datums niet ophalen.");
                    initDatepickers(); // fallback
                }
            });

            const vol = document.getElementById("volwassenen");
            const kind = document.getElementById("kinderen");

            for (let i = 1; i <= 4; i++) {
                const opt = document.createElement("option");
                opt.value = i;
                opt.textContent = i + (i === 1 ? " volwassene" : " volwassenen");
                vol.appendChild(opt);
            }

            vol.value = "{{ $boeking->volwassenen }}";

            function updatePersonOptions() {
                const volwassenenAantal = parseInt(vol.value);
                const maxKinderen = 4 - volwassenenAantal;

                const huidigeKinderWaarde = parseInt(kind.value) || 0;
                kind.innerHTML = '';

                for (let i = 0; i <= maxKinderen; i++) {
                    const opt = document.createElement("option");
                    opt.value = i;
                    opt.textContent = i + (i === 1 ? " kind" : " kinderen");
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

            // ✅ Stel huidige waarden in
            kind.value = "{{ $boeking->kinderen }}";
            updatePersonOptions();

            // ✅ Telefoonvalidatie
            document.querySelector("form").addEventListener("submit", function (e) {
                const telefoonInput = document.getElementById("telefoon");
                const telefoon = telefoonInput.value.trim();
                const isGeldig = /^06\d{8}$/.test(telefoon);

                if (!isGeldig) {
                    e.preventDefault();
                    alert("Voer een geldig Nederlands mobiel nummer in dat begint met 06 en precies 10 cijfers bevat.");
                    telefoonInput.focus();
                }
            });
        });
    </script>
    
@endsection
