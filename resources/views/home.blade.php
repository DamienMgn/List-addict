@extends('layouts.app')

@section('content')
<div class="main-container">
    <section class="app-section" id="categories" data-base="{{ route('home', [], false) }}">
            <categories-component></categories-component>
            <router-view></router-view>
    </section>
</div>
@endsection
