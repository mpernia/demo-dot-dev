@extends('layouts.app')

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

    </header>

    <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">

                </div>

                <div class="col-md-6">

                </div>
            </div>
        </div>
    </main>

    @yield('front_content')
@endsection

@section('scripts')
    @parent
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    @yield('front_scripts')
@endsection
