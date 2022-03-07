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

    <link href="{{ asset('css/myCSS1.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>

<body id="bloco_escuro">

      <div class="d-flex justify-content-center">
				<div class="d-flex justify-content-center w-25 p-3 rounded bg-light text-dark">
					<h2 >Coming soon!</h2>
				</div>
			</div>

</body>

</html>

@endsection