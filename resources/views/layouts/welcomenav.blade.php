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

    <!-- Styles -->
    <link href="{{ asset('css/all.css') }}" rel="stylesheet">

    
</head>
<body>

    <div class="text-right pr-2" style = " position: absolute; width:100%; z-index: 1;">
        <a href="{{ route('login') }}" type="button" class="btn btn-success" id="grad">{{ __('Login') }}</a>
        <a href="{{ route('register') }}" type="button" class="btn btn-light text-success">{{ __('Register') }}</a>
    </div>

    <div class="text-center img-fluid" style = " position: absolute; width:100%;">
        <img src="storage/steam.png" width="500px"> 
    </div>
    
    <div class="row justify-content-center mt-2 pt-5" style = "position: relative;">
    @if(session('success'))
    <div class="alert alert-success w-25 p-3 justify-content-center" role="alert">
    {{ session('success') }}
    </div>
    @endif
      <model-viewer style = "width:100%; height:75vh" class ="justify-content-center" id="reveal" src="css/Steamdeck_3.glb" setting environment-image="neutral"
        alt="" camera-orbit="0deg 90deg 7m" auto-rotate camera-controls disable-zoom>
    </model-viewer>
    
    <a href="{{ route('login') }}" type="button" class="btn btn-success rounded" id="grad"><h3>Authenticate to see the content</h3></a>

    </div>
    
    <main>
        @yield('content')
    </main>

</body>
</html>