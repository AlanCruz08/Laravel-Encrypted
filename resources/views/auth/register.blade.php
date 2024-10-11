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
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css"  rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/flowbite@1.4.1/dist/flowbite.min.js"></script>    

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
{{--}}
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
{{--}}
<body>
    <section class="bg-gray-50 dark:bg-gray-900">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
          <a href="#" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
            <img class="w-8 h-8 mr-2" src="/img/messages_chat_icon.png" alt="logo">
            Chat App  
          </a>
          <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
              <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                Regístrate
              </h1>
      
              <form method="POST" action="{{ route('register') }}" class="space-y-4 md:space-y-6">
                @csrf
      
                <div>
                  <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre</label>
                  <input id="name" type="text" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 @error('name') is-invalid @enderror">
                  @error('name')
                  <span class="text-red-500 text-sm" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
      
                <div>
                  <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Correo electrónico</label>
                  <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 @error('email') is-invalid @enderror">
                  @error('email')
                  <span class="text-red-500 text-sm" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
      
                <div>
                  <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Contraseña</label>
                  <input id="password" type="password" name="password" required autocomplete="new-password" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 @error('password') is-invalid @enderror">
                  @error('password')
                  <span class="text-red-500 text-sm" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
      
                <div>
                  <label for="password-confirm" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirmar contraseña</label>
                  <input id="password-confirm" type="password" name="password_confirmation" required autocomplete="new-password" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
      
                <button type="submit" class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                  Registrarse
                </button>
      
                <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                  ¿Ya tienes cuenta? <a href="{{ route('login2') }}" class="font-medium text-primary-600 hover:underline dark:text-primary-500">Inicia Sesión</a>
                </p>
              </form>
            </div>
          </div>
        </div>
      </section>
      
</body>

</html>