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

<div class="d-flex justify-content-center">
	<div class="w-25 p-3 rounded" id="bloco_branco">
			@if(session('error'))
				<div class="alert alert-danger d-flex justify-content-center" role="alert">
			{{ session('error') }}
			</div>
			@endif
			<h3 class="font-weight-bold">Checkout</h3>
			<form action="{{ route('paypal') }}" method="post">
			@csrf
			<div class="form-group">
				<label for="name" class="font-weight-bold">{{ __('Name') }}</label>
					<input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ Auth::user()->name }}" required autocomplete="name" autofocus>
					@error('name')
						<span class="invalid-feedback" role="alert">
						<strong>{{ $message }}</strong>
						</span>
					@enderror
			</div>
			
			<div class="form-group">
				<label for="email" class="font-weight-bold">{{ __('E-mail') }}</label>
					<input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ Auth::user()->email }}" required autocomplete="email" autofocus>
					@error('email')
						<span class="invalid-feedback" role="alert">
						<strong>{{ $message }}</strong>
						</span>
					@enderror
			</div>
			
			<div class="form-group">
				<label for="nif" class="font-weight-bold">{{ __('Nif') }}</label>
					<input id="nif" type="text" class="form-control @error('nif') is-invalid @enderror" placeholder="Nif" name="nif" required autocomplete="nif" autofocus>
					@error('nif')
						<span class="invalid-feedback" role="alert">
						<strong>{{ $message }}</strong>
						</span>
					@enderror
			</div>
			
			<div class="form-group">
				<label for="address" class="font-weight-bold">{{ __('Address') }}</label>
					<input id="address" type="text" class="form-control @error('address') is-invalid @enderror" placeholder="Address" name="address" required autocomplete="address" autofocus>
					@error('address')
						<span class="invalid-feedback" role="alert">
						<strong>{{ $message }}</strong>
						</span>
					@enderror
			</div>
			<h4 class="font-weight-bold">Total <span class="badge badge-pill" id="grad">{{ $total }} €</span></h4>
			<input type="hidden" name="amount" value="{{ $total }}">
			<button type="submit" name="paynow" class="btn btn-warning w-100">
				<img src="{{ url('storage/PayPal.png') }}" style="width: 80px;">
			</button>
			</form>
	</div>
	</div>
	
</body>
</html>

@endsection