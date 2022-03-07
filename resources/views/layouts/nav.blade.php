<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Steam Deck') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://kit.fontawesome.com/3427d95cbc.js" crossorigin="anonymous"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/all.css') }}" rel="stylesheet">

    
</head>
<body>

<div class="row justify-content-center">
  </div>
    <div class="text-center my-2" style = " position: absolute; width:100%;">
        <img src="storage/steam.png" width="500px"> 
    </div>
    <div class="row justify-content-center mt-4" style = "position: relative;">

    @if(session('success'))
      <div class="alert alert-success w-25 p-3 justify-content-center" role="alert">
    {{ session('success') }}
    </div>
    @endif

      <model-viewer style = "width:100%; height:100vh" class ="justify-content-center" id="reveal" src="css/Steamdeck_3.glb" setting environment-image="neutral"
        alt="" camera-orbit="0deg 90deg 7m" auto-rotate camera-controls disable-zoom>
      </model-viewer>

     </div>
  
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-primary sticky-top shadow shadow-sm" id="grad">
            
            <div class="container ">
                
                <a class="navbar-brand font-weight-bold" href="{{ route('home') }}">
                    <img src="{{ url('storage/Logo.svg') }}" style="width: 150px">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link text-white font-weight-bold" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link text-white font-weight-bold" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item">
                                    <a class="nav-link text-white font-weight-bold" href="{{ route('specs') }}">{{ __('Specs') }}</a>
                            </li>

                            <li class="nav-item">
                                    <a class="nav-link text-white font-weight-bold" href="{{ route('news') }}">{{ __('News') }}</a>
                            </li>
                            
                            
                            <li class="nav-item dropdown">
                                
                                <a id="navbarDropdown" class="nav-link dropdown-toggle text-white font-weight-bold" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <i class="fas fa-user"></i> {{ Auth::user()->name }} <span class="badge badge-pill badge-light">{{ Session::has('cart') ? Session::get('cart') ->totalQty : ''}}</span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>

                                    <a class="dropdown-item" href="{{ route('users.edit-profile') }}">
                                        {{ __('Profile') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('user.orders') }}">
                                        {{ __('My Orders') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('index_fposts') }}">
                                        {{ __('Forum') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('product.shoppingCart') }}">
                                        {{ __('Shopping Cart') }} <span class="badge badge-pill badge-dark">{{ Session::has('cart') ? Session::get('cart') ->totalQty : '' }}</span>
                                    </a>
                                    @role('admin')
									<div class="dropdown-divider"></div>
									<a 
										class="dropdown-item" href="{{ route('users.index') }}">{{ __('List Users') }}
									</a>
                                    <a 
										class="dropdown-item" href="{{ route('fpostsall') }}">{{ __('Forum Admin') }}
									</a>
                                    <a 
                                        class="dropdown-item" href="{{ route('admin.orders') }}">{{ __('All Orders') }}
                                    </a>
                                    <a 
										class="dropdown-item" href="{{ route('products.index') }}">{{ __('Manage Products') }}
									</a>
									@endrole
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main>
            @yield('content')
        </main>
    </div>
</body>
</html>