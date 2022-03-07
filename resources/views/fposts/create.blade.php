@extends('layouts.app')

@section('title', 'Open Ticket')

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
    <div class="row justify-content-center">
        <div class="col-md-5 col-auto rounded" id="bloco_branco">
            @if(session()->has('error'))
                    <div class="alert alert-danger">
                    {{ session()->get('error') }}
                    </div>
            @endif
            <div class="panel panel-default">
            <div class="row rounded-top" id="grad">
                    <div class="col">
                        @if(isset($fpost))
                        <h2 class="mt-2 font-weight-bold">Edit Post</h2>
                        @else
                        <h2 class="mt-2 font-weight-bold">Create Post</h2>
                        @endif
                        
                    </div>
                </div>     

                <div class="panel-body">
                    @include('includes.flash')

                    <form class="form-horizontal" role="form" method="POST" action="@if(isset($fpost)) {{ url('/fposts/'.$fpost->id.'/edit')}} @else {{ url('/new_fpost') }} @endif">
                        {!! csrf_field() !!}

                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title" class="col-md-4 control-label font-weight-bold mt-3">Title</label>

                            <div class="col-md-12">
                                <input id="title" type="text" class="form-control" name="title" value="@if(isset($fpost)){{ $fpost->title }} @else {{'' }} @endif">

                                @if ($errors->has('title'))
                                {{$errors}}
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                                
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('message') ? ' has-error' : '' }}">
                            <label for="message" class="col-md-4 control-label font-weight-bold">Message</label>

                            <div class="col-md-12">
                                <textarea rows="10" id="message" class="form-control" name="message" >@if(isset($fpost)){{$fpost->message }} @else {{''}} @endif</textarea>

                                @if ($errors->has('message'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('message') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                @if(isset($fpost))
                                <button type="submit" class="btn btn-success" id="grad">
                                    <i class="fa fa-btn fa-ticket"></i> Edit Post
                                </button>
                                @else
                                <button type="submit" class="btn btn-success" id="grad">
                                    <i class="fa fa-btn fa-ticket"></i> Make Post
                                </button>
                                @endif
                                <a href="{{ route('index_fposts') }}">
                                    <button type="button" class="btn btn-light text-success">Cancel</button>
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>

</html>
@endsection