<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>List Addict</title>

        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>

        </style>
    </head>
    <body>
        <main class="welcome-main">
            @if (Route::has('login'))
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
                <div class="welcome-content">
                    <div class="welcome-side left">
                        <h3>List-Addict facilite et vous aide dans votre quotidien.</h3>
                        <ul class="welcome-ul">
                            <li class="welcome-li">Gérer facilement vos projets !</li>
                            <li class="welcome-li">Consulter votre agenda !</li>
                            <li class="welcome-li">Organiser vos activités quotidiennes !</li>
                        </ul>
                    </div>
                    <div class="welcome-side right">
                         <img class="welcome-demo" src="images/app-mask.png" alt="demonstration">
                    </div>
                </div>
            @endif
        </main>
    </body>
</html>
