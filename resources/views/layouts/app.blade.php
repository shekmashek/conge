<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


    {{-- bootstrap cdn --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link rel="stylesheet" href="{{ asset('css/manager_interface.css') }}">
    <link rel="stylesheet" href="{{ asset('css/calendar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/general.css') }}">

    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>

    {{-- sidebar --}}
    <link rel="stylesheet" href="{{ asset('components/css/sidebars.css') }}">

    {{-- FONT AWSOME --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg=="
        crossorigin="anonymous" referrerpolicy="no-referrer">

    <!-- Scripts -->
    {{-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>


    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>

    <!-- extra links -->
    @stack('extra-links')

</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm fixed-top">
            <div class="container-fluid mx-5">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{-- {{ config('app.name', 'Laravel') }} --}}
                    <img class="img-fluid" src="{{ asset('img/logos_all/iconConge.webp') }}" alt="logo"
                        style="max-width: 40px">
                    <span>Conge.mg</span>
                    <header class="header">
                        <nav class="navbar navbar-expand-lg navbar-light fixed-top pb-0">
                            <div class="container-fluid d-none">
                                <div class="left_menu ms-2">
                                    <a href="{{route('accueil_perso')}}">
                                        <p class="titre_text m-0 p-0">

                                        </p>
                                    </a>
                                </div>
                            </div>
                        </nav>
                    </header>

                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                        @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @endif

                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        @endif
                        @else
                        <li class="nav-item dropdown">
                            <a id="dropdownMenuProfil" class="nav-link " href="#" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" data-bs-auto-close="outside"
                                aria-expanded="false" v-pre>
                                <i class='bx bx-plus-medical icon_creer_admin fs-4'></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end pb-0" id="dropdownMenuProfilContent"
                                aria-labelledby="navbarDropdown">
                                <ul class="px-0 pb-2">
                                    <li class="dropdown-item">
                                        <i class="fas fa-user icon_plus"></i>
                                        Nouveau Employés
                                    </li>
                                    <li class="dropdown-item">
                                        <i class="bx bx-library icon_plus"></i>
                                        Projet Interne
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a id="dropdownMenuProfil" class="nav-link " href="#" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" data-bs-auto-close="outside"
                                aria-expanded="false" v-pre>
                                <i class="bx bx-cog bx-spin-hover icon_creer_admin fs-4"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end pb-0" id="dropdownMenuProfilContent"
                                aria-labelledby="navbarDropdown">
                                <h5>PARAMETRE</h5>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a id="dropdownMenuProfil" class="nav-link " href="#" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" data-bs-auto-close="outside"
                                aria-expanded="false" v-pre>
                                <i class='bx bx-user-circle icon_creer_admin fs-4'></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end pb-0" id="dropdownMenuProfilContent"
                                aria-labelledby="navbarDropdown">
                                @include('layouts.profile')
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>


        @if (session('info'))
        <div class="alert fade show text-center align-items-center">
            <span
                class="d-flex align-items-center justify-content-center text-info bg-info bg-opacity-10 p-2 rounded-3 text-info">
                <span>{{ session('info') }}</span>
                <button type="button" class="btn-close ms-2" data-bs-dismiss="alert" aria-label="Close"></button>
            </span>
        </div>
        @endif
        @if (session('success'))
        <div class="alert fade show text-center align-items-center">
            <span
                class="d-flex align-items-center justify-content-center text-success bg-success bg-opacity-10 p-2 rounded-3 text-success">
                <span>{{ session('success') }}</span>
                <button type="button" class="btn-close ms-2" data-bs-dismiss="alert" aria-label="Close"></button>
            </span>
        </div>
        @endif
        @if (session('error'))
        <div class="alert fade show text-center align-items-center">
            <span
                class="align-items-center bg-danger bg-opacity-10 d-flex justify-content-center p-2 rounded-3 text-danger">
                <span>{{ session('error') }}</span>
                <button type="button" class="btn-close ms-2" data-bs-dismiss="alert" aria-label="Close"></button>
            </span>
        </div>
        @endif
        <main class="main-margin">
            @include('layouts.sidebar')
            @yield('content')
        </main>
    </div>
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>

<script src="https://unpkg.com/boxicons@2.1.2/dist/boxicons.js"></script>

<script src="{{ asset('components/js/sidebars.js') }}"></script>

@stack('extra-scripts')
@stack('extra-js')

</html>