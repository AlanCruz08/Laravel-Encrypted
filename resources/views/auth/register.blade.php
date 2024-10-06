<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<style>
    .one-section {
        position: relative;
        width: 100%;
        overflow: hidden;
        left: 0;
        right: 0;
        height: 100vh;
        background: #0D152C;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .row {
        height: 100%;
        padding: 0 !important;
    }

    .div-form {
        position: relative;
        background-image: url("{{ asset('img/fondo.jpg') }}");
        background-size: cover;
        background-repeat: no-repeat;
        width: 60%;
        display: flex;
        align-items: center;
        justify-content: space-around;
        flex-direction: column;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.5);
        border-radius: 10px;
        overflow: hidden;
    }

    .div-form::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 1;
    }

    .div-form>* {
        position: relative;
        z-index: 2;
    }

    .div-form-img {
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .div-form2 {
        width: 100%;
        border-bottom: 2px solid #EAEAEA;
    }

    .login-p {
        font-size: 2rem;
        font-weight: 700;
        text-align: center;
        color: #fff;
        font-family: "Oswald", sans-serif;
    }

    .form-login {
        width: 50%;
        margin: 20px 0;
    }

    .center-btn {
        display: flex;
        justify-content: center;
    }

    .btn-custom {
        width: 60%;
    }

    .label-login {
        color: #fff;
    }

    .form-custom {
        width: 100%;
        padding: 10px;
        background-color: #ffffff70 !important;
        border: none !important;
        border-radius: 5px !important;
    }

    .div-form3 {
        width: 100%;
        border-top: 2px solid #fff;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 10px;
    }

    .login-p2 {
        color: #fff;
    }

    .login-a {
        color: #fff;
        text-decoration: none;
    }
</style>

<body>
    <section class="one-section">

        <div class="div-form">

            <div class="div-form2">
                <p class="login-p">REGISTRARTE</p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="form-login">
                @csrf

                <div class="mb-3">
                    <label for="name" class="label-login">{{ __('Name') }}</label>

                    <input id="name" type="text" class="form-custom @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                </div>

                <div class="mb-3">
                    <label for="email" class="label-login">{{ __('Email Address') }}</label>

                    <input id="email" type="email" class="form-custom @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                </div>

                <div class="mb-3">
                    <label for="password" class="label-login">{{ __('Password') }}</label>


                    <input id="password" type="password" class="form-custom @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                </div>

                <div class="mb-3">
                    <label for="password-confirm" class="label-login">{{ __('Confirm Password') }}</label>

                    <input id="password-confirm" type="password" class="form-custom" name="password_confirmation" required autocomplete="new-password">

                </div>

                <div class="center-btn">
                    <button type="submit" class="btn btn-outline-light btn-custom">
                        {{ __('Register') }}
                    </button>
                </div>
            </form>

            <div class="div-form3">
                <p class="login-p2">Si ya tienes cuenta <a href="{{ route('login') }}" class="login-a">Inicia Sesion</a>
            </div>

        </div>
    </section>
</body>

</html>