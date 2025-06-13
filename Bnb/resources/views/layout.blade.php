<!DOCTYPE html>
<html lang="nl">

<head>
   <script src="https://kit.fontawesome.com/fa79014ad0.js" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Bnb')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<style>
    .navbar {
        font-family: 'Calibri';
        outline: auto;
    }
</style>
<body>

    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">
                <img src="images/Bnb.png" alt="Logo" style="height 100px" width="100px"> 
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a style="color: blue; font-size: 20px !important;" class="nav-link" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a style="color: blue; font-size: 20px !important;" class="nav-link" href="/booking">Booking</a>
                    </li>
                    <li class="nav-item">
                        <a style="color: blue; font-size: 20px !important;" class="nav-link" href="/reviews">Reviews</a>
                    </li>
                    <li class="nav-item">
                        <a style="color: blue; font-size: 20px !important;" class="nav-link" href="/details">Details</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    {{-- Content van elke pagina --}}
    <div class="container mt-4">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
