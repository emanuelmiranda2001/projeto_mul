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
		<div class="col-md-8 col-auto">
			<div class="card">
				<div class="card-header " id="grad"><h3 class="font-weight-bold">{{ __('Users List') }}</h3></div>
					@if(session()->has('success'))
						<div class="alert alert-success">
						{{ session()->get('success') }}
						</div>
					@endif
					@if(session()->has('error'))
						<div class="alert alert-danger">
						{{ session()->get('error') }}
						</div>
					@endif
				<div class="card-body">
					<table id="list" class="table">
						<thead>
							<tr>
								<th width="1%">
									<div class="d-flex justify-content-center">
										Id
                                    </div> 
								</th>
								<th width="10%">
									<div class="d-flex justify-content-center">
										Name
                                    </div> 
								</th>
								<th width="20%">
									<div class="d-flex justify-content-center">
										E-mail
                                    </div> 
								</th>
								<th width="5%">
									<div class="d-flex justify-content-center">
										Action
                                    </div> 
								</th>
							</tr>
						</thead>
					<tbody>
					@foreach($users as $user)
						<tr>
							<td>
								<div class="d-flex justify-content-center">
									{{ $user->id }}
                                </div> 
							</td>
							<td>
								<div class="d-flex justify-content-center">
									{{ $user->name }}
                                </div>
							</td>
							<td>
								<div class="d-flex justify-content-center">
									{{ $user->email }}
                                </div>
							</td>
							<td>
							<div class="d-flex justify-content-center">
								<a class="btn btn-success" id="grad" href="{{ route('users.edit',$user->id) }}">Edit</a>
								<form action="{{ route('users.destroy', $user->id)}}" method="post">
								{{ csrf_field() }}
								@method('DELETE')
								<button class="btn btn-light text-success ml-1" type="submit">Delete</button>
								</form>
							</div>
							</td>
							
						</tr>
					@endforeach
					</tbody>
					</table>
					
					
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>
@endsection