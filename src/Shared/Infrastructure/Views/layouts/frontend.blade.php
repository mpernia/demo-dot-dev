@extends('layouts.app')

@php
    $guard = Session::get('guard')
@endphp

@section('styles')
    @parent
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/css/custom.css') }}">

    @yield('front_styles')
@endsection

@section('content')
    <header>
        <div class="container-fluid banner">
            <div class="logo col-md-6 mx-auto" >
                <img src="https://www.puntodev.es/images/logo-white.svg">

                <h1 class=" h2 text-center py-3">
                    <span id="typed" class="text-white">Desarrollo de <b>páginas web</b></span>
                </h1>
            </div>
        </div>
        <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">DotDev</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <ul class="navbar-nav mb-2 mb-md-0">
                    @if (auth($guard)->user())
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ auth($guard)->user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="#"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                            </div>
                        </li>
                    @endif
                </ul>
            </div>
        </nav>
    </header>

    <main>
        @yield('front_content')
    </main>

    <footer class="footer mt-auto mt-5 bg-body-tertiary fixed-bottom">
        <div class="container py-3 text-center">
            <span class="text-body-secondary text-center">2023</span>
        </div>
    </footer>
    <form id="logout-form" action="{{ route('auth.logout') }}" method="POST" class="d-none">
        @csrf
    </form>
@endsection

@section('scripts')
    @parent
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
            crossorigin="anonymous"></script>
    @yield('front_scripts')
@endsection
