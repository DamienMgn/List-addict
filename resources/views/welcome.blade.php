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
        <div class="flex-center flex-column position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Connexion</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Inscription</a>
                        @endif
                    @endauth
                </div>
            @endif
            <div class="content">
                <div class="title m-b-md">
                    List Addict
                </div>
                <div>
                    <p class="content-p">Application de gestion de projet</p>
                </div>
            </div>
            <div class="welcome-img-container">
                <img class="welcome-img" src="{{asset('/images/welcome-img.png')}}" alt="welcome-img">
            </div>
            <footer class="welcome-footer">
                <p>maquignondm@gmail.com</p>
                <a href="https://github.com/DamienMgn/Laravel-vue">github</a>
            </footer>
        </div>
    </body>
</html>
