<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Bnb')</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/fa79014ad0.js" crossorigin="anonymous"></script>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">

    <style>
        html,
        body {
            height: 100%;
            margin: 0;
            font-family: 'Poppins', sans-serif;
        }

        body {
            display: flex;
            flex-direction: column;
            background: linear-gradient(to bottom right, #f2f7ff, #ffffff);
            color: #333;
        }

        .navbar {
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
        }

        .navbar-brand img {
            height: 60px;
        }

        .nav-link {
            color: #0d6efd !important;
            font-size: 18px;
            font-weight: 500;
            margin-right: 15px;
        }

        .nav-link:hover {
            color: #084298 !important;
        }

        main {
            flex: 0;
            padding: 30px 15px;
            align-items: bottom;
        }

        footer {
            background-color: #f8f9fa;
            padding: 20px 0;
            font-size: 14px;
            color: #6c757d;
            text-align: center;
        }

        footer a {
            color: #6c757d;
            text-decoration: none;
            margin: 0 5px;
        }

        footer a:hover {
            color: #0d6efd;
            text-decoration: underline;
        }
    </style>
</head>

<body>

    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">
                <img src="/images/Bnb.png" alt="Bnb Logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="/">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="/booking">Boeking</a></li>
                    <li class="nav-item"><a class="nav-link" href="/reviews">Reviews</a></li>
                    <li class="nav-item"><a class="nav-link" href="/details">Details</a></li>

                    @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user-circle fa-lg me-1"></i> {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{ route('profile') }}">Mijn gegevens</a></li>
                                @if (Auth::user()->is_admin)
                                    <li><a class="dropdown-item" href="/admin">Adminpanel</a></li>
                                @endif
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button class="dropdown-item" type="submit">Uitloggen</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    {{-- Pagina-inhoud --}}
    <main>
        <div class="page-container">

            {{-- ✅ Foutmelding tonen als user geen toegang heeft (bijv. geen admin) --}}
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            @yield('content')
        </div>
    </main>

    {{-- Footer --}}
    <footer>
        <div class="container">
            <p class="mb-1">© {{ date('Y') }} Bnb. Alle rechten voorbehouden.</p>
            <small>
                <a href="/privacy">Privacybeleid</a> ·
                <a href="/voorwaarden">Voorwaarden</a>
            </small>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
