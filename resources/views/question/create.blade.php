@extends('parents')
@section('content')
@include('editor::head')
    <div class ="container">
        <div class="row">
            <div class="col-md-9" role="main">
                
                {!! Form::open(['url' => '/question']) !!}
                    
                @include('question.form')
                <div>
                    
                    {!! Form::submit('发表问题', ['class' => 'btn btn-primary pull-right']) !!}
                    
                </div>
                    
                {!! Form::close() !!}
                
                
            </div>
        </div>
    </div>
@stop