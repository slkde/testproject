@extends('parents')
@section('content')
    <div class="container heade">
        <div class="row">
        <div class="col-md-6 col-md-offset-3" role="main">

            {!! Form::open(['url'=>'/user/login']) !!}

            {{--  <div class="form-group">
                
                {!! Form::label('name', 'Name:') !!}
                
                {!! Form::text('name', null, ['class' => 'form-control']) !!}
                
                
            </div>  --}}

            <div class="form-group">
                
                {!! Form::label('email', '邮箱: ') !!}
                @if($errors->has('email'))
                {{ $errors->get('email')['0'] }}
                @endif
                
                {!! Form::email('email', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                
                {!! Form::label('password', '密码:') !!}
                @if($errors->has('password'))
                {{ $errors->get('password')['0'] }}
                @endif
                
                {{--  {!! Form::password('password', null, ['class' => 'form-control']) !!}  --}}
                <input type="password" class="form-control" name="password">
            </div>


            
            {!! Form::submit('提交登陆', ['class' => 'btn btn-primary form-control']) !!}
            
            {!! Form::close() !!}
            
        </div>
        </div>
    </div>
@stop