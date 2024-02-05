<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md shadow-sm" style="background-color:#FF416C">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}" style="font-weight: bold; color: white">
                    <img src="{{ asset('assets/images/logo-fintech-blanco-05.png') }}" alt="" width="100px">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
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
                        <li class="nav-item dropdown" style="color: white">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre style="font-weight: bold; color: white">
                                {{ Auth::user()->name }} ({{ Auth::user()->role->name }})
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                                         document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>

</html>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>CodePen - Sidebar Menu</title>
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel='stylesheet' href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css'>
    <link rel='stylesheet' href='https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&amp;display=swap'>
    <link rel="stylesheet" href="{{asset('css/side.css')}}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>{{ config('app.name', 'Laravel') }}</title>

</head>

<body>
    <div id="app">
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
        <div class="container">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>
            <li class="nav-item dropdown" style="color: white">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre style="font-weight: bold; color: white">
                    {{ Auth::user()->name }} ({{ Auth::user()->role->name }})
                </a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                                         document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </li>

            <!-- partial:index.partial.html -->
            <nav class="sidebar close">
                <header>
                    <div class="image-text">

                        <img src="{{ asset('assets/images/logo-fintech-blanco-05.png') }}" alt="" width="80px">


                        <div class="text logo-text">
                            <span class="name">{{ Auth::user()->name }} </span>
                            <span class="profession">{{ Auth::user()->role->name }}</span>
                        </div>
                    </div>
                    @endguest
                    <i class='bx bx-chevron-right toggle'></i>
                </header>

                <div class="menu-bar">
                    <div class="menu">

                        <li class="search-box">
                            <i class='bx bx-search icon'></i>
                            <input type="text" placeholder="Search...">
                        </li>
                        @auth
                        @if (Auth::user()->role_id === 3)

                        <ul class="menu-links">
                            <li class="nav-link {{ $page == 'Home' ? 'active' : '' }}" aria-current="page">
                                <a href="{{ route('home') }}">
                                    <i class=''></i>
                                    <span class="text nav-text">Home</span>
                                </a>
                            </li>


                            <ul class="menu-links">
                                <li class="nav-link {{ $page == 'Home' ? 'active' : '' }}" aria-current="page">
                                    <a href="{{ route('data_kantin') }}">
                                        <i class=''></i>
                                        <span class="text nav-text">RiwayatKantin</span>
                                    </a>
                                </li>

                                <ul class="menu-links">
                                    <li class="nav-link {{ $page == 'Home' ? 'active' : '' }}" aria-current="page">
                                        <a href="{{ route('data_bank') }}">
                                            <i class=''></i>
                                            <span class="text nav-text">RiwayatBank</span>
                                        </a>
                                    </li>
                                    @endif
                                    @if (Auth::user()->role_id === 2)

                                    <ul class="menu-links">
                                        <li class="nav-link {{ $page == 'Home' ? 'active' : '' }}" aria-current="page">
                                            <a href="{{ route('home') }}">
                                                <i class=''></i>
                                                <span class="text nav-text">Home</span>
                                            </a>
                                        </li>

                                        <ul class="">
                                            <li class="nav-link {{ $page == 'Menu' ? 'active' : '' }}" aria-current="page">
                                                <a href="{{ route('menu') }}">
                                                    <i class=''></i>
                                                    <span class="text nav-text">Menu</span>
                                                </a>
                                            </li>

                                            <ul class="menu-links">
                                                <li class="nav-link {{ $page == 'Menu' ? 'active' : '' }}" aria-current="page">
                                                    <a href="{{ route('data_transaksi') }}">
                                                        <i class=''></i>
                                                        <span class="text nav-text">Transaksi</span>
                                                    </a>
                                                </li>
                                                @endif
                                                @if (Auth::user()->role_id === 1)
                                                <ul class="menu-links">
                                                    <li class="nav-link {{ $page == 'Home' ? 'active' : '' }}" aria-current="page">
                                                        <a href="{{ route('home') }}" <i class=''></i>
                                                            <span class="text nav-text">Home</span>
                                                        </a>
                                                    </li>
                                                    @endif
                                                    @endauth

                    </div>

                    <div class="bottom-content">
                        <li class="">

                            <a href="{{ route('logout') }}" id="logout-form" action="{{ route('logout') }}" method="POST" onclick="event.preventDefault();
                                                                         document.getElementById('logout-form').submit();">
                                <i class='bx bx-log-out icon'></i>
                                <span class="text nav-text">Logout</span>
                            </a>

                        </li>


                        <li class="mode">
                            <div class="sun-moon">
                                <i class='bx bx-moon icon moon'></i>
                                <i class='bx bx-sun icon sun'></i>
                            </div>
                            <span class="mode-text text">Dark mode</span>

                            <div class="toggle-switch">
                                <span class="switch"></span>
                            </div>
                        </li>

                    </div>
                </div>

        </div>
        </nav>
    </div>

    <main class="py-4">
        @yield('content')
    </main>
    <!-- partial -->
    <script src="{{asset('js/side.js')}}"></script>

</body>

</html>