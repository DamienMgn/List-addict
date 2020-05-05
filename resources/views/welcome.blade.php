@extends('layouts.app')

<div class="wrapper welcome-main">
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
@endsection

@section('content')
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
@endsection
