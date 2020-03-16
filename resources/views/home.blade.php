@extends('layouts.app')

@section('content')
<div class="main-container">
    <section class="app-section" id="categories" data-base="{{ route('home', [], false) }}">
        <app-component></app-component>
    </section>
</div>
@endsection
