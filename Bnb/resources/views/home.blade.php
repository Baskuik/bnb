<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Home</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
</head>

<body>
    @include('layout')

    <div class="slider-container">
        <button class="arrow arrow-left" aria-label="Vorige foto">&lt;</button>

        <div class="slider">
            <img src="{{ asset('images/bnbfoto1.png') }}" class="slider-img active" alt="bnbfoto1">
            <img src="{{ asset('images/bnbfoto2.png') }}" class="slider-img" alt="bnbfoto2">
            <img src="{{ asset('images/bnbfoto3.png') }}" class="slider-img" alt="bnbfoto3">
            <img src="{{ asset('images/bnbfoto4.png') }}" class="slider-img" alt="bnbfoto4">
            <img src="{{ asset('images/bnbfoto5.png') }}" class="slider-img" alt="bnbfoto5">
            <img src="{{ asset('images/bnbfoto6.png') }}" class="slider-img" alt="bnbfoto6">
            <img src="{{ asset('images/bnbfoto7.png') }}" class="slider-img" alt="bnbfoto7">
            <img src="{{ asset('images/bnbfoto8.png') }}" class="slider-img" alt="bnbfoto8">
            <img src="{{ asset('images/bnbfoto9.png') }}" class="slider-img" alt="bnbfoto9">
            <img src="{{ asset('images/bnbfoto10.png') }}" class="slider-img" alt="bnbfoto10">
            <img src="{{ asset('images/bnbfoto11.png') }}" class="slider-img" alt="bnbfoto11">
            <img src="{{ asset('images/bnbfoto12.png') }}" class="slider-img" alt="bnbfoto12">
            <img src="{{ asset('images/bnbfoto13.png') }}" class="slider-img" alt="bnbfoto13">
            <img src="{{ asset('images/bnbfoto14.png') }}" class="slider-img" alt="bnbfoto14">
            <img src="{{ asset('images/bnbfoto15.png') }}" class="slider-img" alt="bnbfoto15">
            <img src="{{ asset('images/bnbfoto16.png') }}" class="slider-img" alt="bnbfoto16">
        </div>

        <button class="arrow arrow-right" aria-label="Volgende foto">&gt;</button>
    </div>

    <!-- Modal container -->
    <div id="modal" class="modal" role="dialog" aria-modal="true" aria-labelledby="modal-img">
        <div class="modal-content">
            <button id="close-modal" class="close-btn" aria-label="Sluit vergrote afbeelding">&times;</button>
            <img id="modal-img" src="" alt="Grote foto">
        </div>
    </div>

    <div class="voorzieningen-container">
        <ul class="voorzieningen-lijst">
            <li><i class="fa-solid fa-euro-sign"></i> 120,- Per nacht</li>
            <li><i class="fa-solid fa-wifi"></i> Gratis wifi</li>
            <li><i class="fa-solid fa-eye"></i> Uitzicht</li>
            <li><i class="fa-solid fa-house"></i> Je hebt de accommodatie voor jezelf</li>
            <li><i class="fa-solid fa-ruler-combined"></i> 50m² grootte</li>
            <li><i class="fa-solid fa-square-parking"></i> Gratis parkeren</li>
            <li><i class="fa-solid fa-toilet-paper"></i> Badkamer</li>
            <li><i class="fa-solid fa-ban-smoking"></i> Rookvrij</li>
            <li><i class="fa-solid fa-kitchen-set"></i> Keuken</li>
            <li><i class="fa-solid fa-shower"></i> Douche</li>
            <li><i class="fa-solid fa-umbrella-beach"></i> Terras</li>
        </ul>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const images = document.querySelectorAll('.slider-img');
            const left = document.querySelector('.arrow-left');
            const right = document.querySelector('.arrow-right');
            let index = 0;

            const modal = document.getElementById('modal');
            const modalImg = document.getElementById('modal-img');
            const closeBtn = document.getElementById('close-modal');

            function showImage(i) {
                images.forEach(img => img.classList.remove('active'));
                images[i].classList.add('active');
            }

            left.addEventListener('click', () => {
                index = (index - 1 + images.length) % images.length;
                showImage(index);
            });

            right.addEventListener('click', () => {
                index = (index + 1) % images.length;
                showImage(index);
            });

            // Modal openen bij klikken op foto
            images.forEach(img => {
                img.addEventListener('click', () => {
                    console.log('Clicked image src:', img.src);
                    modal.style.display = 'flex';
                    modalImg.src = img.src;
                });
            });


            // Modal sluiten met kruisje
            closeBtn.addEventListener('click', () => {
                modal.style.display = 'none';
                modalImg.src = '';
            });

            // Klik buiten modal-content sluit ook modal
            modal.addEventListener('click', e => {
                if (e.target === modal) {
                    modal.style.display = 'none';
                    modalImg.src = '';
                }
            });
        });
    </script>

</body>

</html>
