<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>List Addict</title>

    <!-- Scripts -->
    <script src="js/app.js" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="css/app.css" rel="stylesheet">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.css">
    <link href="css/app.css" rel="stylesheet">
    <link href="css/heroku.css" rel="stylesheet">

    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="wrapper">
    <div id="app">
        @section('navbar')
                <header class="welcome-header">
                    <nav class="welcome-nav">
                        @auth
                            <a href="{{ url('/home') }}">Home</a>
                        @else
                            <a class="nav-li" href="{{ route('login') }}">Connexion</a>

                            @if (Route::has('register'))
                                <a class="nav-li" href="{{ route('register') }}">Inscription</a>
                            @endif
                        @endauth
                    </nav>
                    <div class="welcome-title">
                        <h1>Bienvenue sur List-Addict ! Vous venez d arriver ? <a href="{{ route('register') }}">Créez un compte</a> !</h1>
                    </div>
                </header>
        @show
        <main class="app-container">
            @yield('content')
        </main>
    </div>

    <!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>
