@extends('layouts.nav')

@section('content')
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Home') }}</title>

    <script type="module" src="https://unpkg.com/@google/model-viewer/dist/model-viewer.min.js"></script>

    <link rel="stylesheet" type="text/css" href="{{ asset('css/all.css') }}">

    <script>
      function mudarModelo(elem) {

      const toggleModel = () => {
      return document.querySelector('#toggle-model');
      }

      var id = elem.id;
      switch (id) {
        case '1':
            toggleModel().setAttribute('src', `css/Modelos_Slide/1.glb`)
            Window.alert("1");
            break;
        case '2':
            toggleModel().setAttribute('src', `css/Modelos_Slide/2.glb`)
            Window.alert("2");
            break;
        case '3':
            toggleModel().setAttribute('src', `css/Modelos_Slide/3.glb`)
            Window.alert("3");
            break;
        default:
            return false;
        }
      }
    </script>
    

</head>

<body>
<div style="height: 30px; background-color: #1B1B1B" id="store"></div>
<div class="container-fluid p-5 justify-content-center" id="bloco_escuro">
  <h1 class="header_branco">
    THREE STORAGE OPTIONS
</h1>

@foreach ($products->chunk(3) as $productChunk)
<div class="album p-5 m-0">
    <div class="container">
      <div class="row">
      @foreach($productChunk as $product)
          <div class="col-md">
                <div class="card p-3 gradient">
                  <img src="{{ url('storage/'.$product->image) }}" alt="Bad" class="img-fluid bd-placeholder-img card-img-top p-4"/>
                    <div class="caption">
                        <p class="texto_preto_medio">{{ $product->title }}</>
                        <p class="description texto_branco_pequeno text-left">{{ $product->description }}</p>
                        <div class="row justify-content-start">
                            <div class="price texto_branco_medio col-md text-center">{{ $product->price }}€</div>
                            <div class="col-md float-right">
                              <a href="{{ route('product.addToCart', ['id' => $product->id]) }}#store" class="btn botao_preto btn-dark" role="button">Add to Cart</a>
                            </div>
                        </div>
                    </div>
                </div>
          </div>
        @endforeach
       </div>
      </div>
	</div>
  @endforeach
  
</div>

  <div class="row justify-content-center p-0 m-0">
  <h1 class="header_preto p-5">
    Steam Deck Details
  </h1>
  </div>
  <div class="row justify-content-center p-0 m-0">
  <div class="col-md-7">
  <button type="button" onclick="mudarModelo(this)" id="1" class="header_cinza ml-5 botao_specs">
    Powerful
</button>
  <p class="ml-5 text-left texto_cinza_medio">Steam Deck runs the latest AAA games—and runs them really well.</p>
  <button type="button" onclick="mudarModelo(this)" id="2" class="header_cinza ml-5 botao_specs">
    Comfortable
</button>
  <p class="ml-5 text-left texto_cinza_medio">Full-fidelity controls. Long play sessions. No compromises.</p>
  <button type="button" onclick="mudarModelo(this)" id="3" class="header_cinza ml-5 botao_specs">
    Versatile
</button>
  <p class="ml-5 text-left texto_cinza_medio">You can connect to peripherals, throw the picture onto a big screen, and do all the other PC things you’d expect.</p>
  </div>
  <div class="col-md-5 text-center m-0">
  <model-viewer style="height: 80%; width:90%;" id="toggle-model" src="css/Modelos_Slide/1.glb" shadow-intensity="1" camera-orbit="40deg 70deg" autoplay></model-viewer>
  </div>
  </div>
  <div class="row flex justify-content-end p-0 m-0">
  <a href="{{ route('specs') }}" class="btn botao_gradiente col-md-3 m-5 p-2">More Details</a>
  </div>

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
