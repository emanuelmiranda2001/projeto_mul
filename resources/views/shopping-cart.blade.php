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

	<link href="{{ asset('css/nosso.css') }}" rel="stylesheet">

    <link href="{{ asset('css/all.css') }}" rel="stylesheet">
</head>
<body id="bloco_escuro">

@if(Session::has('cart'))
	<div class="row justify-content-center">
		<div class="col-md-5 col-sm-6 rounded" id="bloco_branco">
		<div class="table-responsive">
			<table class="table">
				<tr><th colspan="6">
						<h3 class="font-weight-bold">Shopping Cart &emsp; <span class="badge badge-pill badge-dark">{{ Session::has('cart') ? Session::get('cart') ->totalQty : '' }} items</span></h3>
				</th></tr>
				<tr class="" id="grad">
					<th width="30%">Product</th>
					<th width="10%" >
						<div class="d-flex justify-content-center">
							ID
						</div> 
					</th>
					<th width="10%" >
						<div class="d-flex justify-content-center">
							Quantity
						</div> 
					</th>
					<th width="10%" >
						<div class="d-flex justify-content-center">
							Price
						</div> 
					</th>
					<th width="15%" >
						<div class="d-flex justify-content-center">
							Total
						</div> 
					</th>
					<th width="5%" >
						<div class="d-flex justify-content-center">
							Delete
						</div> 
					</th>
				</tr>
				@foreach($products as $product)
				<tr>
					<td><strong>{{ $product['item']['title'] }}</strong></td>
					<td>
						<div class="d-flex justify-content-center">
							<strong>{{ $product['item']['id'] }}</strong>
						</div> 
					</td>
					<td>
						<div class="d-flex justify-content-center">
							<span class="badge badge-secondary">{{ $product['qty'] }}</span>
						</div> 
					</td>
					<td>
						<div class="d-flex justify-content-center">
							<span class="badge badge-secondary">{{ $product['item']['price'] }}€</span>
						</div> 
					</td>
					<td>
						<div class="d-flex justify-content-center">
							<span class="badge badge-success">{{ $product['price'] }}€</span>
						</div> 
					</td>
					<td>
						<div class="d-flex justify-content-center">
							<a href="{{ route('product.remove', ['id'=>$product['item']['id']]) }}"><i class="fas fa-trash-alt text-danger"></i></a>
						</div> 				
					</td>
				</tr>
				@endforeach
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td>
						<div class="d-flex justify-content-center">
							<strong>{{ $totalPrice }}€</strong>
						</div> 
					</td>
					<td><a href="{{ route('checkout') }}" type="button" id="grad" class="btn btn-success font-weight-bold text-dark">Checkout</a></td>
				</tr>
			</table>
		</div>
		</div>
	</div>
		@else
			<div class="d-flex justify-content-center">
				<div class="d-flex justify-content-center w-25 p-3 rounded bg-light text-dark">
					<h2 >No Items in Cart!</h2>
				</div>
			</div>
	@endif

</body>
</html>
	
@endsection