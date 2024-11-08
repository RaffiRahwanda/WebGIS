<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'WebGIS') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
      @yield('style-css')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/home') }}">
                    {{ config('app.name', 'WebGIS') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                         
                        @guest
                            @if (Route::has('login'))
                              <li class="nav-item">
                                    <a class="nav-link" href="/home">{{ __('Grafik') }}</a>
                                </li>   
                            <li class="nav-item">
                               <a class="nav-link" href="/about">{{ __('Tentang WebGis') }}</a>
                            </li>
                            <li class="nav-item">
                                    <a class="nav-link" href="{{ route('map.index') }}">{{ __('Map') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>

                            @endif

                           
                            
                        @else
                         <li class="nav-item">
                                    <a class="nav-link" href="/home">{{ __('Home') }}</a>
                                </li>
                          <li class="nav-item">
                            @if(auth()->user()->role == "Admin")
                                    <a class="nav-link" href="{{ route('sungai.index') }}">{{ __('Sungai') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('space.index') }}">{{ __('Tempat') }}</a>
                                </li>
                                @endif
                                <!-- <li class="nav-item">
                                    <a class="nav-link" href="{{ route('centre-point.index') }}">{{ __('Centre Point') }}</a>
                                </li> -->
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('map.index') }}">{{ __('Map') }}</a>
                                </li>
                                 <li class="nav-item">
                                    <a class="nav-link" href="/hasil_laboratorium">{{ __('Hasil Lab') }}</a>
                                </li>
                                  <li class="nav-item">
                                    <a class="nav-link" href="/about">{{ __('Tentang WebGis') }}</a>
                                </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    	<a class="dropdown-item" disabled>ID AKUN: {{auth()->user()->id}}</a>
                                    <a href="/hasil_lab/{{auth()->user()->id}}" class="dropdown-item">Data Kontribusi</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                            
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
        
            @stack('javascript')
            
       
    </div>
</body>
</html>
