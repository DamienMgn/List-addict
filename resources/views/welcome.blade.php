@extends('layouts.app')

<div class="wrapper welcome-main">
@section('navbar')
    <header class="welcome-header">
        <div class="welcome-header-cont">
            <a class="welcome-brand nav-li" href="{{ url('/') }}">Home</a>
            <nav class="welcome-nav">
                @auth
                @else
                    <a class="nav-li" href="{{ route('login') }}">Connexion</a>

                    @if (Route::has('register'))
                        <a class="nav-li" href="{{ route('register') }}">Inscription</a>
                    @endif
                @endauth
            </nav>
        </div>
        <div class="welcome-title">
            <h3>Bienvenue sur List-Addict ! Vous venez d arriver ? <a href="{{ route('register') }}">Créez un compte</a> !</h3>
        </div>
    </header>
@endsection

@section('content')
    <div class="welcome-content">
        <div class="welcome-side left">
            <h1>List-Addict facilite et vous aide dans votre quotidien.</h1>
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
