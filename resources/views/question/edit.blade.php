@extends('parents')
@section('content')
@include('editor::head')
    <div class ="container">
        <div class="row">
            <div class="col-md-9" role="main">
                
                {!! Form::model($question,['method'=>'patch', 'url' => '/question/'. $question->id]) !!}
                    
                @include('question.form')
                <div>
                    
                    {!! Form::submit('更新问题', ['class' => 'btn btn-primary pull-right']) !!}
                    
                </div>
                    
                {!! Form::close() !!}
                
                
            </div>
        </div>
    </div>
@stop