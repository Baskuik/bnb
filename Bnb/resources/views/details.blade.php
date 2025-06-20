<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Details</title>
    <link rel="stylesheet" href="{{ asset('css/detailsstyle.css') }}" />
</head>
@extends('layout')
<body>
    @section('content')

    <div class="titel">
        <h1 style="color: blue">Informatie van host</h1>
    </div>

    <div class="informatie">
        <img src="{{ asset('images/pfp.png') }}" alt="Foto host" class="informatie-foto">
        <p class="informatie-tekst">
            Het appartement bevindt zich in een voormalige kapschuur op het erf naast de woning en beschikt over een
            eigen ingang en eigen voorzieningen (douche, toilet en wastafel, koelkast, magnetron, koffiezetapparaat,
            waterkoker, TV). De slaapkamer en badkamer bevinden zich op de 1e verdieping (bereikbaar met trap).
            Het appartement is gelegen aan de 7 km lange Dokter Larijweg beroemd van de 1200 perenbomen. We bevinden ons
            hier op het snijpunt van Nederland in de mooie omgeving van Zuidwest Drenthe in het buitengebied van
            Ruinerwold, het buurtschap Oosteinde. De accommodatie is centraal gelegen t.o.v. diverse natuurgebieden,
            brinkdorpen en toeristische attracties. Prachtig om te wandelen en fietsen zijn de natuurgebieden
            Dwingelderveld, Holtingerveld, landgoed Rheebruggen, Reestdal, Weerribben-Wieden (Giethoorn o.a.). Ook een
            bezoekje waard zijn de brinkdorpen Ruinen, Dwingeloo, Diever, Havelte en Vledder. Toeristische attracties
            zijn bijv. de Hunebedden in Havelte en de Kolonien van Weldadigheid in Frederiksoord. Veel highlights komen
            voorbij langs de Heerlijkheid Ruinenroute die langs de accommodatie loopt en de vele andere
            fietsknooppuntroutes. Gezellige steden in de buurt zijn Meppel (10 km), Steenwijk (14 km ), Assen (40 km) en
            Zwolle (35 km).
            Gesproken talen:
            <br><br>
            Duits,Engels,Frans,Nederlands
        </p>
    </div>

    <div class="accomodatie-titel">
        <h1 style="color: blue">Accomodatie-omgeving</h1>
    </div>

    <div class="omgeving-container">
        <div class="omgeving-col">
            <h2 class="icons"><i class="fa-solid fa-person-walking"></i> Wat is er in de buurt?</h2>
            <ul>
                <li>Nationaal Park Dwingelderveld - 8 km</li>
                <li>Boswachterijen - 9 km</li>
                <li>Wijngaard Echternesebroek - 10 km</li>
                <li>Bungalowpark Lanka - 10 km</li>
                <li>Sportpark de Groene Long - 13 km</li>
                <li>Bezoekerscentrum de Wheem - 16 km</li>
                <li>Boas BV - 17 km</li>
                <li>Nationaal Park Drents-Friese Woud - 17 km</li>
            </ul>

            <div class="luchthaven">
                <h2 class="icons"><i class="fa-solid fa-plane"></i> Dichtstbijzijnde luchthavens</h2>
                <ul>
                    <li>Luchthaven Groningen Eelde - 59 km</li>
                </ul>
            </div>
        </div>

        <div class="omgeving-col">
            <h2 class="icons"><i class="fa-solid fa-utensils"></i> Restaurants & cafés</h2>
            <ul>
                <li>Restaurant De Parel - 650 m</li>
                <li>Café/bar Reinders - 600 m</li>
                <li>Restaurant Forellen Visvijvers de Woldstek - 2,4 km</li>
            </ul>

            <div class="natuur">
                <h2 class="icons"><i class="fa-solid fa-mountain"></i> Natuurschoon</h2>
                <ul>
                    <li>Bos - Ruinerwold - 4,5 km</li>
                </ul>
            </div>

            <div class=" ov">
                <h2 class="icons"><i class="fa-solid fa-train"></i> Openbaar vervoer</h2>
                <ul>
                    <li>Trein - station Meppel - 8 km</li>
                    <li>Trein - station Steenwijk - 16 km</li>
                </ul>
            </div>
        </div>
    </div>
    </div>

    <div class="faciliteiten-titel">
        <h1 style="color: blue">Faciliteiten in Appartement Oosteinde</h1>
    </div>
    <div class="faciliteiten-container">
    <div class="faciliteiten-col">
        <div class="ideaal">
        <h2 class="icons"><i class="fa-solid fa-user"></i> Ideaal voor je verblijf</h2>
        <ul>
            <li><i class="fa-solid fa-check check"></i> Gratis parkeergelegenheid</li>
            <li><i class="fa-solid fa-check check"></i> Parkeren</li>
            <li><i class="fa-solid fa-check check"></i> Gratis WiFi</li>
            <li><i class="fa-solid fa-check check"></i> Rookvrije kamers</li>
            <li><i class="fa-solid fa-check check"></i> Flatscreen-Tv</li>
            <li><i class="fa-solid fa-check check"></i> Keuken</li>
        </ul>
        <ul>
            <li><h2 class="icons"><i class="fa-solid fa-square-parking parkeer"></i>Parkeerplaats</h2></li>
            <li><p class="parkeer-tekst">Privé parkeren is gratis. Je kunt parkeren bij de accommodatie. Reserveren is niet noodzakelijk.</p></li>
        </ul>
        <ul>
            <li><h2 class="icons"><i class="fa-solid fa-wifi wifi"></i> Internet</h2></li>
            <li><p class="wifi-tekst">WiFi is beschikbaar in de gehele accommodatie. Deze service is gratis.</p></li>
        </ul>
        <ul>
            <li><h2 class="icons"><i class="fa-solid fa-kitchen-set"></i> Keuken</h2></li>
            <li><i class="fa-solid fa-check check"></i> Eettafel</li>
            <li><i class="fa-solid fa-check check"></i> koffiezetapparaat</li>
            <li><i class="fa-solid fa-check check"></i> Schoonmaakmiddelen</li>
            <li><i class="fa-solid fa-check check"></i> Keukengerei</li>
            <li><i class="fa-solid fa-check check"></i> Elektrische waterkoker</li>
            <li><i class="fa-solid fa-check check"></i> magnetron</li>
            <li><i class="fa-solid fa-check check"></i> Koelkast</li>
            <li><i class="fa-solid fa-check check"></i> Kitchenette</li>
        </ul>
        <ul>
            <li><h2 class="icons"><i class="fa-solid fa-bed"></i> Slaapkamer</h2></li>
            <li><i class="fa-solid fa-check check"></i> Beddengoed</li>
            <li><i class="fa-solid fa-check check"></i> (Kleding)kast</li>
        </ul>
        </div>
    </div>

    <!-- Kolom 2: Badkamer -->
    <div class="faciliteiten-col">
        <div class="badkamer">
        <h2 class="icons"><i class="fa-solid fa-shower"></i> Badkamer</h2>
        <ul>
            <li><i class="fa-solid fa-check check"></i> Toiletpapier</li>
            <li><i class="fa-solid fa-check check"></i> Handdoeken</li>
            <li><i class="fa-solid fa-check check"></i> Handdoeken/lakens (toeslag)</li>
            <li><i class="fa-solid fa-check check"></i> Bad of douche</li>
            <li><i class="fa-solid fa-check check"></i> Eigen badkamer</li>
            <li><i class="fa-solid fa-check check"></i> Wc</li>
            <li><i class="fa-solid fa-check check"></i> Gratis toiletartikelen</li>
            <li><i class="fa-solid fa-check check"></i> Douche</li>
        </ul>
        <ul>
            <li><h2 class="icons"><i class="fa-solid fa-couch"></i> Badkamer</h2></li>
            <li><i class="fa-solid fa-check check"></i> Eethoek</li>
            <li><i class="fa-solid fa-check check"></i> Bank</li>
            <li><i class="fa-solid fa-check check"></i> Zithoek</li>
        </ul>
        <ul>
            <li><h2 class="icons"><i class="fa-solid fa-tv"></i> Media & Technologie</h2></li>
            <li><i class="fa-solid fa-check check"></i> Flatscreen-Tv</li>
            <li><i class="fa-solid fa-check check"></i> Tv</li>
        </ul>
        <ul>
            <li><h2 class="icons"><i class="fa-solid fa-bed"></i> Kamerfaciliteiten</h2></li>
            <li><i class="fa-solid fa-check check"></i> Stopcontact bij het bed</li>
            <li><i class="fa-solid fa-check check"></i> Kledingrek</li>
            <li><i class="fa-solid fa-check check"></i> Eigen ingang</li>
            <li><i class="fa-solid fa-check check"></i> Ventilator</li>
        </ul>
        <ul>
            <li><h2 class="icons"><i class="fa-solid fa-wheelchair"></i> Toegangelijkheid</h2></li>
            <li><i class="fa-solid fa-check check"></i> Bovenverdieping alleen bereikbaar per trap</li>
        </ul>
        <ul>
            <li><h2 class="icons"> <i class="fa-solid fa-sun"></i> Buiten</h2></li>
            <li><i class="fa-solid fa-check check"></i> Buitenmeubels</li>
            <li><i class="fa-solid fa-check check"></i> Terras</li>
            <li><i class="fa-solid fa-check check"></i> Tuin</li>
        </ul>
        </div>
    </div>

    <!-- Kolom 3: Eten & Drinken, Activiteiten, Buiten & Uitzicht -->
    <div class="faciliteiten-col">
        <h2 class="icons"><i class="fa-solid fa-utensils"></i> Eten & Drinken</h2>
        <ul>
            <li><i class="fa-solid fa-check check"></i> Mini bar</li>
            <li><i class="fa-solid fa-check check"></i> Thee- en koffiefaciliteiten</li>
        </ul>

        <h2 class="icons"><i class="fa-solid fa-person-running"></i> Activiteiten</h2>
        <ul>
            <li><i class="fa-solid fa-check check"></i> Fietsen</li>
            <li><i class="fa-solid fa-check check"></i> Hengelsport</li>
        </ul>

        <h2 class="icons"><i class="fa-solid fa-bug"></i> Buiten & Uitzicht</h2>
        <ul>
            <li><i class="fa-solid fa-check check"></i> Uitzicht</li>
            <li><i class="fa-solid fa-check check"></i> Uitzicht op de tuin</li>
            <li><i class="fa-solid fa-check check"></i> Uitzicht op het weiland</li>
        </ul>
        <ul>
            <li><h2 class="icons"><i class="fa-solid fa-door-open"></i> Kenmerken gebouw</h2></li>
             <li><i class="fa-solid fa-check check"></i> Vrijstaand</li>
        </ul>
        <ul>
            <li><h2 class="icons"><i class="fa-solid fa-sink"></i> Diensten receptie</h2></li>
            <li><i class="fa-solid fa-check check"></i> Factuur wordt versterkt</li>
        </ul>
        <ul>
            <li><h2 class="icons"></h2><i class="fa-solid fa-people-roof"></i> Entertainment en familiediensten</li>
            <li><i class="fa-solid fa-check check"></i> Bordspellen en puzzels</li>
        </ul>
        <ul>
            <li><h2> Overige</h2></li>
            <li><i class="fa-solid fa-check check"></i> Niet-roken in gehele accommodatie</li>
            <li><i class="fa-solid fa-check check"></i> Verwarming</li>
            <li><i class="fa-solid fa-check check"></i> Rookvrije kamers</li>
        </ul>
        <ul>
            <li><h2 class="icons"><i class="fa-solid fa-lock"></i></h2></li>
            <li><i class="fa-solid fa-check check"></i> Rookmelder</li>
        </ul>
        <ul>
            <li><h2 class="icons"><i class="fa-solid fa-comments"></i> Gesproken talen</h2></li>
            <li><i class="fa-solid fa-check check"></i> Duits</li>
            <li><i class="fa-solid fa-check check"></i> Engels</li>
            <li><i class="fa-solid fa-check check"></i> Frans</li>
            <li><i class="fa-solid fa-check check"></i> Nederlands</li>
        </ul>
</div>
</div>
<div class="huisregels-titel">
    <h2>Huisregels</h2>
</div>
<div class="huisregels"> 
  <h2><i class="fa-solid fa-arrow-right-to-bracket"></i> Inchecken</h2>
  <p class="incheck-tijd">
    Van 15:00 tot 18:00<br>
    Laat de accommodatie van tevoren  weten hoe laat je arriveert.
  </p>
  <h2><i class="fa-solid fa-arrow-right-from-bracket"></i> Uitchecken</h2>
  <p class="uitcheck-tijd">
    Van 08:00 tot 11:00
  </p>
  <h2><i class="fa-solid fa-person"></i> Kinderen</h2>
  <p class="kinderen">
    Kinderen worden toegelaten.
  </p>
</div>  
@endsection
</body>

</html>
