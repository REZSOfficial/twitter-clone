<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>TwitterClone</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link
        href="https://fonts.googleapis.com/css2?family=Jacquard+24&family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap"
        rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="{{asset('scripts/script.js')}}"></script>
    <style>
        body {
            background-color: white !important;
        }

        * {
            font-family: "Nunito", sans-serif;
        }
    </style>
</head>

<body>
    @if (Route::has('login'))
    <nav class="navbar navbar-dark bg-dark navbar-expand-md shadow fixed-top">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/home') }}">
                <i class="fa-brands fa-twitter text-info fs-1 bg-dark p-2 rounded shadow"></i>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="{{ __('Toggle navigation') }}">
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
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{'@'}}{{ Auth::user()->username }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end bg-dark" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item text-light bg-dark" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <a class="dropdown-item text-light bg-dark"
                                href="{{route('viewUser', ['id' => Auth::user()->id])}}">
                                {{ __('Profile') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>

                    @endguest
                </ul>
            </div>
            @if (Auth::user())
            <div>
                <a href="{{route('createPost')}}" class="btn"><i class="fa-solid fa-square-plus fs-1 text-info"></i></a>
            </div>
            @endif
        </div>
    </nav>
    @endif

    <div class="d-flex border-dark bg-info" style="height: 100vh">
        <div class="w-50 d-flex flex-column justify-content-center align-items-center bg-dark">
            <img class="img-fluid" src="{{asset('images/logo.png')}}" alt="">

        </div>
        <div class="w-50 d-flex flex-column justify-content-center align-items-center">
            <h1 style="font-size: 5rem !important" class="text-dark w-100 d-flex justify-content-center">
                Twitter Clone</h1>
        </div>
    </div>

</body>

</html>