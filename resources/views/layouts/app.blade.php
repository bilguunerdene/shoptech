<?php
$tot = 0;
if(Session::has('cart'))
foreach(Session::get('cart') as $item)
    $tot += $item['quantity'];

?>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Eanplock') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/script.js') }}" defer></script>
    <link rel="stylesheet" href="{{ asset('css/uikit.min.css') }}">
    <script src="{{ asset('js/uikit.min.js') }}"></script>
    <script src="{{ asset('js/uikit-icons.min.js') }}"></script>
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
                <div style="background-image: url(images/banner.jpg);" class="uk-offcanvas-bar sidebar">
                    <div class="sidebartop">
                        <div class="sidebar-logo uk-grid">
                            <div class="logo"></div>
                            <div class="name">Eanplock</div>
                            <div class="menutoggle">
                                <a href="#" uk-toggle="target: #offcanvas-nav"><span uk-icon="icon: arrow-left"></span></a>
                            </div>
                        </div>
                    
                    </div>
                    <hr>
                    <div class="sidebar-content">
                        <ul class="uk-nav">
                            <li><a href="{{ route('home') }}"><span class="uk-margin-top uk-margin-right" uk-icon="icon: home"></span><span class="title">{{ __('Home') }}</span></a></li>
                            <li><a href="{{ route('cart') }}"><span class="uk-margin-top uk-margin-right" uk-icon="icon: cart"></span><span class="title">{{ __('Cart') }}</span></a></li>
                            <li><a href="{{ route('settings') }}"><span class="uk-margin-top uk-margin-right" uk-icon="icon: cog"></span><span class="title">{{ __('Settings') }}</span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            </div>
            <div class="searchbox uk-margin-left">
            <form class="uk-search uk-search-default" action="{{ route('search') }}" method="GET">
                <span uk-search-icon></span>
            <input class="uk-search-input mainsearch" name="name" value="{{ request('name') }}" type="search" placeholder="{{__('Search')}}...">
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
                        @else
                        <li class="nav-item dropdown uk-margin-right">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ app()->getLocale() }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="lang/en">
                                    {{ __('English') }}
                                </a>    
                            <a class="dropdown-item" href="lang/se">
                                    {{ __('Sweden') }}
                                </a>
                            </div>
                        </li>
                        <li class="nav-item">
                            <div class="uk-margin-right"><a href="{{route('cart')}}" class="uk-icon-button" uk-icon="icon: cart; ratio: 1.5"></a>
                            <span class="uk-badge cartbadge">{{$tot}}</span>
                            </div>
                        </li>
                            <li><img class="uk-border-circle" src="{{ Auth::user()->imageurl==null?asset('images/profile.jpeg'):asset('images/'.Auth::user()->imageurl) }}" style="height:40px;width:40px" alt="Profile"></li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('order.index') }}"
                                       ><span uk-icon="icon: user"></span>
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
    <script type="text/javascript">
function minusval(id,quantity){
    $.ajax({
        "url": '{{ url("minus") }}',
        "type":"POST",
        "data": { "_token": "{{ csrf_token() }}","id":id, "quantity":quantity},
        "success":(html)=>{
            $("#inputbtn"+id).val(parseInt($("#inputbtn"+id).val())-quantity);
        }
    });
    
}
function addval(id,quantity){
    $.ajax({
        "url": '{{ url("update-cart") }}',
        "type":"POST",
        "data": { "_token": "{{ csrf_token() }}","id":id, "quantity":quantity},
        "success":(html)=>{
            $(".cartbadge").html(parseInt($(".cartbadge").html())+quantity);
            $("#inputbtn"+id).val(parseInt($("#inputbtn"+id).val())+quantity);
        }
    });
}
</script>
</body>
</html>
