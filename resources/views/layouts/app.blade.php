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
    <script src="{{ asset('js/jquery.min.js') }}" defer></script>
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
                                <li><a href="{{ route('order.index') }}"><span class="uk-margin-top uk-margin-right" uk-icon="icon: user"></span><span class="title">{{ __('Profile') }}</span></a></li>
                            <li><a href="{{ route('home') }}"><span class="uk-margin-top uk-margin-right" uk-icon="icon: home"></span><span class="title">{{ __('Home') }}</span></a></li>
                            <li><a href="{{ route('favourite') }}"><span class="uk-margin-top uk-margin-right" uk-icon="icon: heart"></span><span class="title">{{ __('My Favourite') }}</span></a></li>
                            <li><a href="{{ route('cart') }}"><span class="uk-margin-top uk-margin-right" uk-icon="icon: cart"></span><span class="title">{{ __('Cart') }}</span></a></li>
                            <li><a href="{{ route('settings') }}"><span class="uk-margin-top uk-margin-right" uk-icon="icon: cog"></span><span class="title">{{ __('Settings') }}</span></a></li>
                            <li><a href="lang/{{ app()->getLocale()=="en"?"se":"en" }}"><span class="uk-margin-top uk-margin-right" uk-icon="icon: world"></span><span class="title">{{ app()->getLocale()=="en"?"Sweden":"English" }}</span></a></li>
                            <li><a href="{{ route('logout') }}"><span class="uk-margin-top uk-margin-right" uk-icon="icon: sign-out"></span><span class="title">{{ __('Logout') }}</span></a></li>
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
                        <li class="nav-item dropdown uk-margin-right lang">
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
                        <li class="nav-item cart">
                            <div class="uk-margin-right"><a href="{{route('cart')}}" class="uk-icon-button" uk-icon="icon: cart; ratio: 1.5"></a>
                            <span class="uk-badge cartbadge">{{$tot}}</span>
                            </div>
                        </li>
                            <li class="profile"><img class="uk-border-circle" src="{{ Auth::user()->imageurl==null?asset('images/profile.jpeg'):asset('images/'.Auth::user()->imageurl) }}" style="height:40px;width:40px" alt="Profile"></li>
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
    <script>
    function minusval(id,quantity,price){
    $.ajax({
        "url": '{{ url("minus") }}',
        "type":"POST",
        "data": { "_token": "{{ csrf_token() }}","id":id, "quantity":quantity},
        "success":(html)=>{
            $(".cartbadge").html(parseInt($(".cartbadge").html())-quantity);
            $("#inputbtn"+id).val(parseInt($("#inputbtn"+id).val())-quantity);
            var subtotal = $(".subtotal").attr('data-value');
            
            if(subtotal>0){
                var subtot = parseFloat(subtotal)-parseFloat(quantity*price);
                var vat = subtot*12/100;
                $(".subtotal").html(toformat(subtot));
                $(".subtotal").attr('data-value',subtot);
                $(".vat").html(toformat(vat));
                $(".vat").attr('data-value',vat);
                $(".grandtotal").html(toformat(vat+subtot));
                $(".grandtotal").attr('data-value',vat+subtot);

                var itemtotal = $(".row_"+id+" .itemtotal").attr('data-value');
                var newtotal = toformat(parseFloat(itemtotal)-parseFloat(quantity*price));
                $(".row_"+id+" .itemtotal").html(newtotal);
                $(".row_"+id+" .itemtotal").attr('data-value',newtotal)
                var itemq = $(".row_"+id+" .quantity").attr('data-value');
                var newq = toformat(parseInt(itemq)-parseInt(quantity));
                $(".row_"+id+" .quantity").html(newq);
                $(".row_"+id+" .quantity").attr('data-value',newq)
            }
        }
    });
    
}
function addval(id,quantity,price){
    quantity = parseInt(quantity);
    $.ajax({
        "url": '{{ url("update-cart") }}',
        "type":"POST",
        "data": { "_token": "{{ csrf_token() }}","id":id, "quantity":quantity},
        "success":(html)=>{
            
            $(".cartbadge").html(parseInt($(".cartbadge").html())+quantity);
            $("#inputbtn"+id).val(parseInt($("#inputbtn"+id).val())+quantity);
            
            var subtotal = $(".subtotal").attr('data-value');
            var subtot = parseFloat(subtotal)+parseFloat(quantity*price);
            var vat = subtot*12/100;
            $(".subtotal").html(toformat(subtot));
            $(".subtotal").attr('data-value',subtot);
            $(".vat").html(toformat(vat));
            $(".vat").attr('data-value',vat);
            $(".grandtotal").html(toformat(vat+subtot));
            $(".grandtotal").attr('data-value',vat+subtot);

            var itemtotal = $(".row_"+id+" .itemtotal").attr('data-value');
            var newtotal = toformat(parseFloat(itemtotal)+parseFloat(quantity*price));
            $(".row_"+id+" .itemtotal").html(newtotal);
            $(".row_"+id+" .itemtotal").attr('data-value',newtotal)
            var itemq = $(".row_"+id+" .quantity").attr('data-value');
            var newq = toformat(parseInt(itemq)+parseInt(quantity));
            $(".row_"+id+" .quantity").html(newq);
            $(".row_"+id+" .quantity").attr('data-value',newq)
        }
    });
}

function additemval(id,quantity,price){
    quantity = parseInt(quantity);
    $.ajax({
        "url": '{{ url("update-cartval") }}',
        "type":"POST",
        "data": { "_token": "{{ csrf_token() }}","id":id, "quantity":quantity},
        "success":(html)=>{
            
            $(".cartbadge").html(html.total);
            // $("#inputbtn"+id).val(parseInt($("#inputbtn"+id).val())+quantity);
            
            var subtotal = $(".subtotal").attr('data-value');
            var subtot = parseFloat(subtotal)+parseFloat(quantity*price);
            var vat = subtot*12/100;
            $(".subtotal").html(toformat(subtot));
            $(".subtotal").attr('data-value',subtot);
            $(".vat").html(toformat(vat));
            $(".vat").attr('data-value',vat);
            $(".grandtotal").html(toformat(vat+subtot));
            $(".grandtotal").attr('data-value',vat+subtot);

            
            var newtotal = parseFloat(quantity*price);
            $(".row_"+id+" .itemtotal").html(newtotal);
            $(".row_"+id+" .itemtotal").attr('data-value',newtotal)
            var newq = toformat(parseInt(quantity));
            $(".row_"+id+" .quantity").html(newq);
            $(".row_"+id+" .quantity").attr('data-value',newq)
        }
    });
}
function toformat(number){
    return new Intl.NumberFormat('en-US',{ maximumFractionDigits: 2 }).format(number);
}
function addtofav(productid){
    $.ajax({
        "url": '{{ url("addtofav") }}',
        "type":"POST",
        "data": { "_token": "{{ csrf_token() }}","id":productid},
        "success":(html)=>{
            $("#heart_"+productid).toggleClass("liked");
            
        }
    });
}

    </script>
</body>
</html>
