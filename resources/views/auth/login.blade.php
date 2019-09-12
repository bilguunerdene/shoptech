<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Eanplock</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="css/uikit.min.css">
        <script src="js/uikit.min.js"></script>
        <!-- Styles -->
        <style>
            html, body {
                background: url(images/banner.jpg);
                background-color: #f9fafb;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">

            <div class="content">
            <img class="first-slide" src="images/logo.png" alt="First slide">
                <div class="title m-b-md">
                    <!-- Eanplock -->
                </div>
                @error('email')
                    <div class="uk-alert-danger" uk-alert>
                        <a class="uk-alert-close" uk-close></a>
                        <p>{{ $message }}</p>
                    </div>
                @enderror

                @error('password')
                <div class="uk-alert-danger" uk-alert>
                        <a class="uk-alert-close" uk-close></a>
                        <p>{{ $message }}</p>
                    </div>
                @enderror
                <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="loginform uk-width-1-1">
                    <div class="uk-margin">
                    
                        <div class="row">
                        
                        <input id="email" class="uk-input @error('email') is-invalid @enderror" name="email" type="email" required autofocus autocomplete="email" placeholder="Email" value="{{ old('email') }}">
                        
                                </div>
                        <div class="row">
                        <input id="password" class="uk-input @error('password') is-invalid @enderror" name="password" type="password" required autocomplete="password" placeholder="Password">
                       
                        </div>
                        
                    
                    </div>
                </div>
                <button type="submit" style="background-color:#f66531" class="uk-button uk-button-primary">Login</button>
                @if (Route::has('password.request'))
                                    <div class="uk-width-1-1 uk-margin">
                                    <a class="btn btn-link" style="color:#f66531" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                    </div>
                                @endif
                </form>
               
                
            </div>
        </div>
    </body>
</html>
