@extends('layouts.app')

@section('content')

<div class="container">
<nav class="uk-navbar-container uk-box-shadow-small uk-box-shadow-hover-xlarge" uk-navbar>
    <div class="uk-navbar-left">

        <ul class="uk-navbar-nav">
        <li>
                <a href="{{ route('type.index') }}">{{ __('Type') }}</a>
                <div class="uk-navbar-dropdown">
                    <ul class="uk-nav uk-navbar-dropdown-nav">
                        <li class="uk-active"><a href="{{ route('type.create') }}">{{ __('Add') }}</a></li>
                        <li><a href="{{ route('type.index') }}">{{ __('Edit') }}</a></li>
                    </ul>
                </div>
            </li>
            <li>
                <a href="{{ route('product.index') }}">{{ __('Product') }}</a>
                <div class="uk-navbar-dropdown">
                    <ul class="uk-nav uk-navbar-dropdown-nav">
                        <li class="uk-active"><a href="{{ route('product.create') }}">{{ __('Add') }}</a></li>
                        <li><a href="{{ route('product.index') }}">{{ __('List') }}</a></li>
                    </ul>
                </div>
            </li>
            <li>
                <a href="{{ route('branch.index') }}">{{ __('Branch') }}</a>
                <div class="uk-navbar-dropdown">
                    <ul class="uk-nav uk-navbar-dropdown-nav">
                        <li class="uk-active"><a href="{{ route('branch.create') }}">{{ __('Add') }}</a></li>
                        <li><a href="{{ route('branch.index') }}">{{ __('Edit') }}</a></li>
                    </ul>
                </div>
            </li>
            <li>
                <a href="{{ route('country.index') }}">{{ __('Country') }}</a>
                <div class="uk-navbar-dropdown">
                    <ul class="uk-nav uk-navbar-dropdown-nav">
                        <li class="uk-active"><a href="{{ route('country.create') }}">{{ __('Add') }}</a></li>
                        <li><a href="{{ route('country.index') }}">{{ __('Edit') }}</a></li>
                    </ul>
                </div>
            </li>
            @if(Auth::user())
            @if(Auth::user()->permissionId==1)
            <li>
                <a href="{{ route('user.index') }}">{{ __('User') }}</a>
                <div class="uk-navbar-dropdown">
                    <ul class="uk-nav uk-navbar-dropdown-nav">
                        <li class="uk-active"><a href="{{ route('user.create') }}">{{ __('Add') }}</a></li>
                        <li><a href="{{ route('user.index') }}">{{ __('Edit') }}</a></li>
                    </ul>
                </div>
            </li>
            @endif
            @endif
        </ul>

    </div>
</nav>
<div class="section uk-margin">
@yield('section')
</div>
</div>

@endsection
