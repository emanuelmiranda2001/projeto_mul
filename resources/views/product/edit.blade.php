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
			<div class="card-header " id="grad"><h3 class="font-weight-bold">{{ __('Edit Product')}}</h3></div>
				<div class="card-body">
				<form method="POST" action="{{ route('products.update', $product->id )}}" enctype="multipart/form-data">
				@csrf
				@method('patch')
                    <div class="form-group">
					<label for="title" class="font-weight-bold">{{ __('Title') }}</label>
						<input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title"
						value="{{ old('title', $product->title) }}" required autocomplete="title" autofocus>
						@error('title')
							<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>

                    <div class="form-group">
					<label for="description" class="font-weight-bold">{{ __('Description') }}</label>
						<input id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description"
						value="{{ old('description', $product->description) }}" required autocomplete="description" autofocus>
						@error('description')
							<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
                    
					<div class="form-group">
					<label for="price" class="font-weight-bold">{{ __('Price') }}</label>
						<input id="price" type="text" class="form-control @error('price') is-invalid @enderror" name="price"
						value="{{ old('price', $product->price) }}" required autocomplete="price" autofocus>
						@error('price')
							<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
					<div class="form-group">
					<label for="image" class="font-weight-bold">{{ __('Image') }}</label>
						<input id="image" type="file" class="form-control @error('image') is-invalid @enderror" name="image">
						@error('image')
						<span class="invalid-feedback" role="alert">
						<strong>{{ $message }}</strong>
						</span>
						@enderror
						<div class="mt-2">
						<img src="{{asset('storage/'. $product->image)}}" style="height:120px;">
						</div>
					</div>
					<button type="submit" class="btn btn-success" id="grad">
						{{ __('Update Changes') }}
					</button>
					<a class="btn btn-light text-success" href="{{ url('products') }}">{{ __('Back to list') }}</a>
				</form>
				</div>
			</div>
		</div>
	</div>
</div>

</body>
</html>
@endsection