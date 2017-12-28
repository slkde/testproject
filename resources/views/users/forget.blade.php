@extends('parents')
@section('content')
    <div class="container heade">
        <div class="row">
        <div class="col-md-6 col-md-offset-3" role="main">

            {!! Form::open(['url'=>'/user/forget']) !!}

            <div class="form-group">
                
                {!! Form::label('email', '邮箱: ') !!}
                @if($errors->has('email'))
                <button type="button" class="btn btn-danger btn-xs">{{ $errors->get('email')['0'] }}</button>
                @endif
                
                {!! Form::email('email', null, ['class' => 'form-control']) !!}
            </div>
            
            {!! Form::submit('验证邮箱', ['class'=>"btn btn-primary form-control"]) !!}
            
            {!! Form::close() !!}
        </div>
        </div>
    </div>
@stop