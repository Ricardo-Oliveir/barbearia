<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bruno Cezarine</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700;900&family=Roboto:wght@400;500&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body class="bg-dark text-light">

    <header class="sticky-top">
        <nav class="navbar navbar-expand-lg navbar-dark bg-black bg-opacity-75 backdrop-blur">
            <div class="container">
                <a class="navbar-brand logo" href="#">BRUNO <span class="text-warning">CEZARINE</span></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item"><a class="nav-link" href="#services">Serviços</a></li>
                        <li class="nav-item"><a class="nav-link" href="#products">Produtos</a></li>
                        <li class="nav-item"><a class="nav-link" href="#team">O Barbeiro</a></li>
                        <li class="nav-item"><a class="nav-link" href="#contact">Contato</a></li>
                        <li class="nav-item ms-lg-3"><a class="btn btn-warning" href="#booking">Agendar</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

    <footer class="bg-black py-4 text-center">
        <p class="text-secondary mb-0">&copy; {{ date('Y') }} BarberX. Todos os direitos reservados.</p>
        @guest
        <a href="{{ route('login') }}" class="admin-link">Admin</a>
        @endguest
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
