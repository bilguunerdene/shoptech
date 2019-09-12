@extends('layouts.app')

@section('content')

<div class="container">
<nav class="uk-navbar-container uk-box-shadow-small uk-box-shadow-hover-xlarge" uk-navbar>
    <div class="uk-navbar-left">

        <ul class="uk-navbar-nav">
        <li>
                <a href="{{ route('order.user') }}">{{ __('Account Detail') }}</a>
               
            </li>
            <li>
                <a href="{{ route('order.list') }}">{{ __('Order History') }}</a>
                
            </li>
           
        </ul>

    </div>
</nav>
<div class="section uk-margin">
@yield('section')
</div>
</div>

@endsection
