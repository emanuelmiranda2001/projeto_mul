@extends('layouts.app')

@section('content')
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Specs') }}</title>

    <script type="module" src="https://unpkg.com/@google/model-viewer/dist/model-viewer.min.js"></script>

    <link rel="stylesheet" type="text/css" href="{{ asset('css/all.css') }}">

</head>

<body id="bloco_escuro">
<div style="height: 30px; background-color: #1B1B1B" id="store">a</div>
<div class="container-fluid p-5 justify-content-center" id="bloco_escuro">
  <div class="row justify-content-center p-0 m-0">
    <div class="col-md-8">
  <h1 class="header_branco text-left">Steam Deck is the most
powerful, full-featured
gaming handheld in the
world.</h1>
<p class="texto_branco_medio pt-5">We partnered with AMD to create Steam Deck's custom APU, optimized for handheld gaming. It is a Zen 2 + RDNA 2 powerhouse, delivering more than enough performance to run the latest AAA games in a very efficient power envelope.</p>
</div>
<div class="col-md-4 text-center m-0">
  <model-viewer style="height: 80%; width:90%;" id="toggle-model" src="css/Modelos_Slide/1.glb" shadow-intensity="1" camera-orbit="40deg 70deg" auto-rotate></model-viewer>
  </div>
</div>
</div>
<div class="container-fluid justify-content-center" id="bloco_branco">
<h1 class="header_preto">Real gamepad controls</h1>
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
<div class="text-center p-2">
<button type="button" class="btn botao_cinza m-4 active" data-target="#carouselExampleIndicators" data-slide-to="0">Comfort</button>
<button type="button" class="btn botao_cinza m-4" data-target="#carouselExampleIndicators" data-slide-to="1">Thumbstick</button>
<button type="button" class="btn botao_cinza m-4" data-target="#carouselExampleIndicators" data-slide-to="2">Triggers</button>
<button type="button" class="btn botao_cinza m-4" data-target="#carouselExampleIndicators" data-slide-to="3">Grip Buttons</button>
</div>
  <div class="carousel-inner justify-content-center">
    <div class="carousel-item active text-center">
      <img class="w-75 text-center" src="{{ url('storage/comfort.png') }}">
    </div>
    <div class="carousel-item text-center">
      <img class="w-75 text-center" src="{{ url('storage/thumbstick.png') }}">
    </div>
    <div class="carousel-item text-center">
      <img class="w-75 text-center" src="{{ url('storage/triggers.png') }}">
    </div>
    <div class="carousel-item text-center">
      <img class="w-75 text-center" src="{{ url('storage/grip.png') }}">
    </div>
  </div>
</div>
<div class="row justify-content-center p-0 mt-5">
<div class="col-sm text-center">
<img src="css/Imagens/1.jpg" class="imagem"> 
<h1 class="text-left pt-4 header_preto_pequeno">7" touchscreen</h1>
<p class="texto_preto_pequeno text-left">Type and swipe through the Steam UI with Deck's capacitive multi-touch display.</p>
</div>
<div class="col-sm text-center">
<img src="css/Imagens/2.jpg" class="imagem"> 
<h1 class="text-left pt-4 header_preto_pequeno">Trackpads</h1>
<p class="texto_preto_pequeno text-left">Play PC games that were never designed to be handheld. With increased precision and customizability, trackpads also give you a competitive edge when playing fast paced FPS games.</p>
</div>
<div class="col-sm text-center">
<img src="css/Imagens/3.JPG" class="imagem"> 
<h1 class="text-left pt-4 header_preto_pequeno">Gyro</h1>
<p class="texto_preto_pequeno text-left">With an IMU and capacitive touch thumbsticks on-board, Deck helps you aim better. By physically positioning the device you can achieve more precision than using a thumbstick or trackpad alone.</p>
</div>
</div>
</div>
<div class="container-fluid p-5 justify-content-center" id="bloco_escuro">
<div class="row justify-content-center p-0 m-0">
<div class="col-sm mx-3 mb-5">
<h1 class="header_branco_pequeno text-left"><i class="far fa-hdd"></i> Fast storage</h1>
<p class="texto_branco_pequeno text-left">Get the built-in storage you need: 64GB eMMC, 256GB NVMe SSD (faster), or 512GB NVMe SSD (fastest). If you're looking for more space, augment your built-in storage with a microSD card and fill it up with even more games.</p>
</div>
<div class="col-sm mx-3 mb-5">
<h1 class="header_branco_pequeno text-left"><i class="fas fa-volume-up"></i> Hi-Fi audio</h1>
<p class="texto_branco_pequeno text-left">Steam Deck's stereo speakers pack a punch. An embedded DSP provides clarity and a wide soundstage for an immersive listening experience. Connect your favorite headset, or use the onboard dual microphones to chat with your friends.</p>
</div>
<div class="col-sm mx-3 mb-5">
<h1 class="header_branco_pequeno text-left"><i class="fas fa-battery-full"></i> 40Wh battery</h1>
<p class="texto_branco_pequeno text-left">Steam Deck's onboard 40 watt-hour battery provides several hours of play time for most games. For lighter use cases like game streaming, smaller 2D games, or web browsing, you can expect to get the maximum battery life of approximately 7-8 hours.</p>
</div>
<div class="row justify-content-center p-0 m-0">
<div class="col-sm mx-3 mb-5">
<h1 class="header_branco_pequeno text-left"><i class="fab fa-usb"></i> Expandable I/O</h1>
<p class="texto_branco_pequeno text-left">The single USB-C jack is multi-purpose: used for charging, peripherals, or even throwing the game onto a big screen at the same time. Any USB-C hub can be used to expand your options, or get our official dock when it is released. More info on the dock below.</p>
</div>
<div class="col-sm mx-3 mb-5">
<h1 class="header_branco_pequeno text-left"><i class="fas fa-wifi"></i> Wireless</h1>
<p class="texto_branco_pequeno text-left">WiFi keeps you connected to the world, and Bluetooth allows for a wide variety of wireless peripherals - from controllers to headsets, keyboards, and mice.</p>
</div>
<div class="col-sm mx-3 mb-5">
<h1 class="header_branco_pequeno text-left"><i class="fas fa-pause"></i> Fast Suspend / Resume</h1>
<p class="texto_branco_pequeno text-left">We've built a quick suspend / resume feature into SteamOS. Press the power button, and Steam Deck will suspend your game and go into sleep mode. Push the power button again and it will wake up right where you left off.</p>
</div>
</div>
</div>
</div>

<hr style="background-color: white">

<footer class="footer w-100 m-0" id="bloco_escuro">
  <div class="container text-center p-3">
  <div class="row justify-content-center p-4">
  <div class="col-md-4 justify-content-center">
  <img src="css/steamdeck.png" class="logo_footer">
  </div>
  <div class="col-md-8 text-right">
  <p class="texto_branco_medio">Emanuel Miranda</p>
  <p class="texto_branco_medio">Hugo Sousa</p>
  <p class="texto_branco_medio">Nuno Lobo</p>
  </div>
  </div>
  </div>
</footer>
</body>

</html>

@endsection
