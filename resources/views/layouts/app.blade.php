<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/jgrowl.min.css') }}" rel="stylesheet">
    <link href="{{ asset('open-iconic/font/css/open-iconic-bootstrap.css') }}" rel="stylesheet">

    <style>
        /* Sticky footer styles
        -------------------------------------------------- */
        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            background-color: #ccc;
        }

    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ route('admin.home') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else

                            <li class="nav-item @if(url()->current() == route('bank.index')) active @endif"><a class="nav-link" href="{{ route('bank.index')  }}">Banks</a></li>
                            <li class="nav-item @if(url()->current() == route('account.index')) active @endif"><a class="nav-link" href="{{ route('account.index')  }}">Accounts</a></li>
                            <li class="nav-item @if(url()->current() == route('transaction.index')) active @endif"><a class="nav-link" href="{{ route('transaction.index')  }}">Transactions</a></li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
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

        <footer class="footer fixed-bottom">
            <div class="container">
                <div class="float-left">
            <span class="text-muted">
                <a class="badge badge-light" href="fakebank.co" target="_blank">Documentation</a>
            </span>
                </div>
                <div class="float-right">
            <span class="text-muted">
                <a class="badge badge-light" href="https://github.com/ryangurn/fakebank" target="_blank">Repo</a>
            </span>
                </div>
            </div>
        </footer>
    </div>

    <script type="text/javascript" src="{{ asset('js/jquery.js')  }}"></script>
    <script type="text/javascript" src="{{ asset('js/popper.js')  }}"></script>
    <script type="text/javascript" src="{{ asset('js/app.js')  }}"></script>
    <script type="text/javascript" src="{{ asset('js/jgrowl.min.js')  }}"></script>

    @include('layouts.partials.jgrowl')
</body>
</html>
