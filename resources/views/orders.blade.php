@extends('layouts.app')
@section('content')

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Home') }}</title>

    <link href="{{ asset('css/all.css') }}" rel="stylesheet">
</head>
<body id="bloco_escuro">

<div class="row justify-content-center">
	<div class="col-md-5 col-auto rounded " id="bloco_branco">
		<div class="row rounded-top mb-4" id="grad">
            <div class="col">
				<h2 class="mt-2 font-weight-bold">Orders</h2>
            </div>
        </div>
			@foreach($orders as $order)
			<div class="panel panel-default">
			@role('admin')<h5>User: {{ $order->name }}</h5>@endrole
			<h5>Order ID: {{ $order->id }} </h5>
			  <div class="panel-body">
				<ul class="list-group">
					@foreach($order->cart->items as $item)
					<li class="list-group-item w-100" id="grad">
						<span class="badge">{{ $item['price'] }}€</span>
							{{ $item['item']['title'] }} | {{ $item['qty'] }} Units
						<br>
						<span class="badge">Nif: </span>
							{{ $order->nif }} | 
						<span class="badge">Address: </span>
							{{ $order->address }}
					</li>
					@endforeach
				</ul>
			  </div>
			  <br>
			  <div class="panel-footer">
				<h4 class="font-weight-bold">Total <span class="badge badge-pill" id="grad">{{ $order->cart->totalPrice }} €</span></h4>
			  </div>
			</div>
			<hr style="height:2px; border-width:0; color:black; background-color:black">
			<br>
			@endforeach
	</div>
</div>

</body>
</html>

@endsection