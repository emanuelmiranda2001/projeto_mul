@extends('layouts.app')

@section('title', 'All Posts')

@section('content')

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Steam Deck') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/all.css') }}" rel="stylesheet">
    
</head>
<body id="bloco_escuro">
    <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7 col-auto rounded" id="bloco_branco">
                <div class="row rounded-top" id="grad">
                    <div class="col">
                        <h2 class="mt-2 font-weight-bold">Forum Posts</h2>
                    </div>
                </div>              

                <div class="table-responsive">
                    @if ($fposts->isEmpty())
                        <p>There are currently no Posts.</p>
                    @else
                        <table class="table">
                                <tr>
                                    <th width="1%">
                                        <div class="d-flex justify-content-center">
                                            Status
                                        </div> 
                                    </th>
                                    <th width="5%">
                                        <div class="d-flex justify-content-center">
                                            Title
                                        </div> 
                                    </th> 
                                    <th width="10%">
                                        <div class="d-flex justify-content-center">
                                            Created on
                                        </div>
                                    </th>                           
                                    <th width="10%">
                                        <div class="d-flex justify-content-center">
                                            Last Updated
                                        </div> 
                                    </th>
                                    <th width="10%">
                                        <div class="d-flex justify-content-center">
                                            Actions
                                        </div> 
                                    </th>
                                </tr>
                            @foreach ($fposts as $fpost)
                                <tr>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            @if ($fpost->status === 'Open')
                                                <i class="fas fa-lock-open text-success"></i>
                                            @elseif ($fpost->status === 'Pending')
                                                <i class="fas fa-hourglass-half text-warning"></i>
                                            @else
                                                <i class="fas fa-lock text-danger"></i>
                                            @endif
                                        </div> 
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <a href="{{ url('fposts/'. $fpost->id) }}">
                                                #{{ $fpost->id }} - {{ $fpost->title }}
                                            </a>
                                        </div>                                        
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center">  
                                            {{ $fpost->created_at->diffForHumans() }}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            {{ $fpost->updated_at }}
                                        </div> 
                                    </td>    
                                    <td>
                                        <div class="d-flex justify-content-center row">
                                            <form action="{{ url('admin/status_fpost/' . $fpost->id)}}" method="POST">
                                                {!! csrf_field() !!}
                                                <button name="open" type="submit" class="btn btn-success" id="grad" value='Open'>Open</button>
                                                <button name="closed" type="submit" class="btn btn-light text-success" value='Closed'>Close</button>
                                                <a href="{{ url('fposts/' . $fpost->id) }}" class="btn btn-warning mt-1">Comment</a>
                                            </form>
                                        </div>                                        
                                    </td>
                                </tr>
                            @endforeach
                        </table>

                        {{ $fposts->render() }}
                    @endif
            </div>
        </div>
        </div>
    </div>

</body>
</html>

@endsection