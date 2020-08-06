<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Technopec description">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Technopec</title>
        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/welcome.css') }}" rel="stylesheet">
    </head>
    <body>
        <header>
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand" href="{{ route('welcome') }}">Technopec</a>
                @if (Route::has('login'))
                    <ul class="navbar-nav ml-auto">
                        @auth
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/home') }}">Home</a>
                            </li>
                        @else
                            <li class="nav-item">
                                @if(Route::current()->getName() == 'welcome')
                                    <a class="nav-link" href="{{ url('/cart') }}">Cart</a>
                                @else
                                    <a class="nav-link" href="{{ url('/') }}">Home</a>
                                @endif
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">Login</a>
                            </li>
    
                            @if (Route::has('register'))
                                <a class="nav-link" href="{{ route('register') }}">Register</a>
                            @endif
                        @endauth
                    </ul>
                @endif
            </nav>
        </header>
        <div class="flex-center position-ref full-height">
            @if(Route::current()->getName() == 'welcome')
                <div class="content">
                    <div class="overlay">
                        <div class="container-fluid">
                            <div class="d-flex">
                                <div class="welcomeCont mx-auto">
                                    <h2>Welcome to Technopec</h2>
                                    <div>
                                        <form method="get" action="{{ route('login') }}">
                                            <button type="submit"> LOG IN </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @elseif(Route::current()->getName() == 'cart')
                @yield('cart')
            @endif
        </div>
    </body>
</html>
