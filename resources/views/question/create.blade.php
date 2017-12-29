@extends('parents')
@section('content')
@include('editor::head')
<div style="background: url('{{ asset('images/background2.jpg') }} '); margin-top:50px;width:100%;height:100%">
    <br><br>
    <div class ="container">
        <div class="row">
            {!! Form::open(['url' => '/question']) !!}
            <div class="col-md-10 col-md-offset-1">
                {{--<div class="btn-group" data-toggle="buttons">--}}
                    {{--@foreach($topic as $v)--}}
                {{--<label class="btn btn-primary">--}}
                    {{--<input type="radio" name="topic_id" value="{{ $v->id }}" autocomplete="off">{{ $v->name }}--}}
                {{--</label>--}}
                    {{--@endforeach--}}

                {{--</div>--}}
            </div>
        </div>
        <div class="row">
            <div class="col-md-10 col-md-offset-1" >
                
                    
                @include('question.form')

                <div class="col-md-5 col-md-offset-3">
                    
                    {!! Form::submit('发表问题', ['class' => 'btn btn-primary pull-right form-control']) !!}
                    
                </div>
                    
                {!! Form::close() !!}
                
                
            </div>
        </div>
        <br>
    </div>
</div>
@stop