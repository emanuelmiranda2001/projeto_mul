@extends('layouts.app')

@section('title', 'Forum Posts')

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
        <div class="col-md-5 col-auto rounded" id="bloco_branco">
                    <div class="row rounded-top" id="grad">
                        <div class="col">
                            <h3 class="mt-2 font-weight-bold">Forum Posts</h3>
                        </div>
                        <div class="col">
                            <a class="d-flex justify-content-end my-2" href="{{ route('new_fpost') }}">
                                <button type="button" class="btn btn-dark" >Create</button>
                            </a>
                        </div>
                            
                            
                    </div>

                <div class="table-responsive">
                    @if ($fposts->isEmpty())
                        <p>There are no Forum Posts available</p>
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
                                </tr>
                            @foreach ($fposts as $fpost)
                                <tr>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            @if ($fpost->status === 'Open')
                                                <i class="fas fa-lock-open text-success"></i>
                                            @elseif ($fpost->status === 'Pending')
                                                <span class= "badge badge-warning">{{ $fpost->status}}</span>
                                            @else
                                                <span class="badge badge-danger">{{ $fpost->status }}</span>
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
                                </tr>
                            @endforeach
                        </table>

                        {{ $fposts->render() }}
                    @endif
            </div>
        </div>
    </div>

    </body>
</html>
@endsection