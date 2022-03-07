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

<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-6">
			<div class="card">
			<div class="card-header " id="grad"><h3 class="font-weight-bold">{{ __('Edit User')}}</h3></div>
				<div class="card-body">
				<form action="{{ route('users.update-user', $user->id) }} "method="POST"  enctype="multipart/form-data">
				@csrf
				@if(session('success'))
				<div class="alert alert-success" role="alert">
				{{ session('success') }}
				</div>
				@endif
				@method('POST')
					<div class="form-group">
					<label for="name" class="font-weight-bold">{{ __('Name') }}</label>
						<input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
						value="{{ old('name', $user->name) }}" required autocomplete="name" autofocus>
						@error('name')
							<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
					<div class="form-group">
					<label for="email" class="font-weight-bold">{{ __('E-mail') }}</label>
						<input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email"
						value="{{ old('email', $user->email) }}" required autocomplete="email" autofocus>
						@error('email')
							<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
					<button type="submit" class="btn btn-success" id="grad">
						{{ __('Update Changes') }}
					</button>
					@role('admin')
					<a class="btn btn-light text-success" href="{{ route('home') }}">{{ __('Back to List') }}</a>
					@endrole
				</form>
				</div>
			</div>
		</div>
	</div>
</div>
<footer class="footer fixed-bottom  mt-auto py-3 bg-dark">
  <div class="container text-center p-3">
    <span class="text-light ">Contactos</span>
  </div>
</footer>
</body>
</html>
@endsection