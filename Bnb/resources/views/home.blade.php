<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<style>
    .body {
        font-family: 'Calibri';
    }
</style>

<body>
    <script>
    const images = document.querySelectorAll('.slider-img');
    const leftArrow = document.querySelector('.left-arrow');
    const rightArrow = document.querySelector('.right-arrow');
    let currentIndex = 0;

    function showImage(index) {
        images.forEach((img, i) => {
            img.classList.toggle('active', i === index);
        });
    }

    leftArrow.addEventListener('click', () => {
        currentIndex = (currentIndex - 1 + images.length) % images.length;
        showImage(currentIndex);
    });

    rightArrow.addEventListener('click', () => {
        currentIndex = (currentIndex + 1) % images.length;
        showImage(currentIndex);
    });

    // Start met de eerste foto zichtbaar
    showImage(currentIndex);

    // Modal functionaliteit
    const modal = document.getElementById('modal');
    const modalImg = document.getElementById('modal-img');
    const modalClose = document.getElementById('modal-close');

    images.forEach(img => {
        img.addEventListener('click', () => {
            modal.style.display = "block";
            modalImg.src = img.src;
        });
    });

    modalClose.addEventListener('click', () => {
        modal.style.display = "none";
    });

    // Klikken buiten de afbeelding sluit de modal ook
    modal.addEventListener('click', (e) => {
        if (e.target === modal) {
            modal.style.display = "none";
        }
    });
</script>

    @include('layout')
  <div class="slider-container">
        <button class="arrow left-arrow">&#8592;</button>

        <div class="slider">
            <ul class="bnbfotos-lijst">
    <li><img src="{{ asset('images/bnbfoto1.png') }}" alt="bnbfoto1" style="height: 200px; width: 200px;"></li>
    <li><img src="{{ asset('images/bnbfoto2.png') }}" alt="bnbfoto2" style="height: 200px; width: 200px;"></li>
    <!-- enzovoort -->
</ul>

        </div>

        <button class="arrow right-arrow">&#8594;</button>
    </div>


        <div class="voorzieningen-container">
            <ul class="voorzieningen-lijst">
                <li>
                    <i class="fa-solid fa-euro-sign"></i> 120,- Per nacht
                </li>
                <li>
                    <i class="fa-solid fa-wifi"></i> Gratis wifi
                </li>
                <li>
                    <i class="fa-solid fa-eye"></i> Uitzicht
                </li>
                <li>
                    <i class="fa-solid fa-house"></i> Je hebt de accommodatie voor jezelf
                </li>
                <li>
                    <i class="fa-solid fa-ruler-combined"></i> 50m² grootte
                </li>
                <li>
                    <i class="fa-solid fa-square-parking"></i> Gratis parkeren
                </li>
                <li>
                    <i class="fa-solid fa-toilet-paper"></i> Badkamer
                </li>
                <li>
                    <i class="fa-solid fa-ban-smoking"></i> Rookvrij
                </li>
                <li>
                    <i class="fa-solid fa-kitchen-set"></i> Keuken
                </li>
                <li>
                    <i class="fa-solid fa-shower"></i> Douche
                </li>
                <li>
                    <i class="fa-solid fa-umbrella-beach"></i> Terras
                </li>
            </ul>
        </div>
</body>

</html>
