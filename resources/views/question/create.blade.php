@extends('parents')
@section('content')
@include('editor::head')
    <div class ="container">
        <div class="row">
            {!! Form::open(['url' => '/question']) !!}
            <div class="col-md-10 col-md-offset-1">
                <div class="btn-group" data-toggle="buttons">
                    @foreach($topic as $v)
                <label class="btn btn-primary">
                    <input type="radio" name="topic_id" value="{{ $v->id }}" autocomplete="off">{{ $v->name }}
                </label>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-10 col-md-offset-1" >
                
                    
                @include('question.form')
                <div>
                    
                    {!! Form::submit('发表问题', ['class' => 'btn btn-primary pull-right']) !!}
                    
                </div>
                    
                {!! Form::close() !!}
                
                
            </div>
        </div>
    </div>
@stop