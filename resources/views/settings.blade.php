@extends('layouts.app')

@section('content')
<div class="container">
<nav class="uk-navbar-container" uk-navbar>
    <div class="uk-navbar-left">

        <ul class="uk-navbar-nav">
        <li>
                <a href="#">Type</a>
                <div class="uk-navbar-dropdown">
                    <ul class="uk-nav uk-navbar-dropdown-nav">
                        <li class="uk-active"><a href="#">Add</a></li>
                        <li><a href="#">Edit</a></li>
                    </ul>
                </div>
            </li>
            <li>
                <a href="#">Product</a>
                <div class="uk-navbar-dropdown">
                    <ul class="uk-nav uk-navbar-dropdown-nav">
                        <li class="uk-active"><a href="#">Add</a></li>
                        <li><a href="#">Edit</a></li>
                    </ul>
                </div>
            </li>
            <li>
                <a href="#">Branch</a>
                <div class="uk-navbar-dropdown">
                    <ul class="uk-nav uk-navbar-dropdown-nav">
                        <li class="uk-active"><a href="#">Add</a></li>
                        <li><a href="#">Edit</a></li>
                    </ul>
                </div>
            </li>
        </ul>

    </div>
</nav>
</div>
@endsection
