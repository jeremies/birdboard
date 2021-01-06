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

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="theme-light bg-page">
<div id="app">
    <nav class="bg-header">
        <div class="container mx-auto">
            <div class="flex justify-between items-center py-2">
                <h1>
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <img src="/images/logo.png" alt="Birdboard">
                    </a>
                </h1>

                <div>
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto flex items-center mr-8">
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
                            <theme-switcher></theme-switcher>

                            <li class="nav-item dropdown">
                                <dropdown align="right" width="200px">
                                    <template v-slot:trigger>
                                        <button id="navbarDropdown" class="nav-link dropdown-toggle focus:outline-none"
                                                href="#"
                                                v-pre>
                                            {{ Auth::user()->name }}
                                        </button>
                                    </template>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                        @csrf

                                        <button type="submit" class="dropdown-menu-link w-full text-left">Logout
                                        </button>
                                    </form>
                                </dropdown>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>


                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <main class="py-4 container mx-auto">
        @yield('content')
    </main>
</div>
</body>
</html>
