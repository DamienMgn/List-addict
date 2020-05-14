@extends('layouts.app')

@section('navbar')
<div class="welcome-main">
    <header class="welcome-header">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="welcome-brand" href="{{ url('/') }}">
                <img class="brand-img" src="dist/img/logo.png" alt="Logo">
                <span class="brand">List Addict</span>
            </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor03" aria-controls="navbarColor03" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarColor03">
            <ul class="navbar-nav mr-auto">
                @auth
                    @else
                    <li class="nav-item active">
                        <a class="nav-li btn submit" href="{{ route('login') }}">Connexion</a>
                    </li>
                    @if (Route::has('register'))
                    <li class="nav-item active">
                        <a class="nav-li btn cancel" href="{{ route('register') }}">Inscription</a>
                    </li>
                    @endif
                @endauth
            </ul>
          </div>
        </nav>
    </header>
@endsection

@section('content')
        <div class="welcome-content">
            <div class="welcome-side left">
                <h1>List-Addict, planifier son quotidien n'a jamais était aussi simple !</h1>
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
        <div class="welcome-footer">
            <p>maquignondm@gmail.com</p>
            <span>-</span>
            <a href="https://github.com/DamienMgn/List-addict">github</a>
        </div>
@endsection
