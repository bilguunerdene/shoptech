<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link rel="stylesheet" href="css/uikit.min.css">
    <script src="js/uikit.min.js"></script>
    <script src="js/uikit-icons.min.js"></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm uk-width-1-1">
            <div>
            
            <div class="uk-navbar-left">
        <a uk-toggle="target: #offcanvas-nav" class="uk-navbar-toggle" uk-navbar-toggle-icon href="#"></a>
    </div>
            <div id="offcanvas-nav" uk-offcanvas="overlay: true">
                <div class="uk-offcanvas-bar sidebar">
                    <div class="sidebartop">
                        <div class="sidebar-logo uk-grid">
                            <div class="logo"></div>
                            <div class="name">Shoptech</div>
                            <div class="menutoggle">
                                <a href="#" uk-toggle="target: #offcanvas-nav"><span uk-icon="icon: arrow-left"></span></a>
                            </div>
                        </div>
                    
                    </div>
                    <hr>
                    <div class="sidebar-content">
                        <ul class="uk-nav">
                            <li><a href="{{ route('home') }}"><span class="uk-margin-top uk-margin-right" uk-icon="icon: home"></span><span class="title">{{ __('home') }}</span></a></li>
                            <li><a href="{{ route('cart') }}"><span class="uk-margin-top uk-margin-right" uk-icon="icon: cart"></span><span class="title">{{ __('cart') }}</span></a></li>
                            <li><a href="{{ route('settings') }}"><span class="uk-margin-top uk-margin-right" uk-icon="icon: cog"></span><span class="title">{{ __('Settings') }}</span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            </div>
            <div class="searchbox uk-margin-left">
            <form class="uk-search uk-search-default">
                <span uk-search-icon></span>
                <input class="uk-search-input mainsearch" type="search" placeholder="Search...">
            </form>
            </div>
           
                
                

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    

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
                            <li><img class="uk-border-circle" src="{{ Auth::user()->imageurl==null?'images/profile.jpeg':Auth::user()->imageurl }}" style="height:40px;width:40px" alt="Profile"></li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><span uk-icon="icon: user"></span>
                                        {{ __('Profile') }}
                                    </a>    
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                     <span uk-icon="icon:sign-out"></span>
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
            
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
