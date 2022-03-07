@extends('layouts.app')

@section('title', $fpost->title)

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
        <div class="col-md-7 col-auto rounded" id="bloco_branco">
            <div class="row rounded-top" id="grad">
                <div class="col">
                    <h3 class="mt-2 font-weight-bold">#{{ $fpost->id }} - {{ $fpost->title }}</h3> 
                </div>
            </div>
                    @include('includes.flash')

                    <div class="mt-3">
                        <p class="font-weight-bold">
                            @if ($fpost->status === 'Open')
                                Status: <i class="fas fa-lock-open text-success mr-2"></i><span class="badge badge-success">{{ $fpost->status }}</span>
                            @elseif ($fpost->status === 'Pending')
                                Status: <i class="fas fa-hourglass-half text-warning mr-2"></i><span class= "badge badge-warning">{{ $fpost->status}}</span>
                            @else
                                Status: <i class="fas fa-lock text-danger mr-2"></i><span class="badge badge-danger">{{ $fpost->status }}</span>
                            @endif
                        </p>
                        <p class="font-weight-bold">Posted on: {{ $fpost->created_at->diffForHumans() }} by {{ $fpost->user->name }}</p>
                        <p>{{ $fpost->message }}</p>        
                    </div>

                    <hr style="height:2px; border-width:0; color:black; background-color:black">

                    <div class="comments">
                        <p class="font-weight-bold">Comments:</>
                        @foreach ($comments as $comment)
                            <div class="panel panel-@if($fpost->user->id === $comment->user_id) {{"default"}}@else{{"success"}}@endif">
                                <div class="font-weight-bold">
                                    {{ $comment->user->name }}
                                    <span class="pull-right font-weight-light">{{ $comment->created_at->format('d-m-Y') }}</span>
                                </div>
                                <div class="panel panel-body">
                                    {{ $comment->comment }}        
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <hr style="height:2px; border-width:0; color:black; background-color:black">

                    <div class="mt-2">
                        <p class="font-weight-bold">Comment:</p>
                        <form action="{{ url('comment') }}" method="POST" class="form">
                            {!! csrf_field() !!}

                            <input type="hidden" name="id" value="{{ $fpost->id }}">

                            <div class="form-group{{ $errors->has('comment') ? ' has-error' : '' }}">
                                <textarea rows="3" id="comment" class="form-control" name="comment"></textarea>

                                @if ($errors->has('comment'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('comment') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group mb">
                                <button type="submit" class="btn btn-success" id="grad">Submit</button>
                                @if (Auth::user()->id == $fpost->user_id)
                                <a href="{{url('fposts/'.$fpost->id.'/edit') }}">
                                <button type="button" class="btn btn-warning">Edit</button>
                                </a>
                                @endif
                                <a href="{{ route('index_fposts') }}">
                                    <button type="button" class="btn btn-light text-success" >Return</button>
                                </a>
                        </div>
                        </form>
        </div>
    </div>
    </div>

    </body>
</html>
@endsection