<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Details</title>
    <link rel="stylesheet" href="{{ asset('css/detailsstyle.css') }}" />
</head>

<body>
    @include('layout')

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

    <div class="accommodatie-omgeving-header">
    <i class="fa-solid fa-person-walking"></i>
    <h1>Wat is er in de buurt?</h1>
</div>

    

</body>

</html>
