@extends('parents')
@section('content')

<div style="background: url('{{ asset('images/background2.jpg') }} '); margin-top:50px;width:100%;height:100%">
    <div class="container heade">
        <br><br><br><br><br><br>
        <div class="row">
        <div class="col-md-4 col-md-offset-4" role="main">
            <h2 style="text-align: center">问问答--用户登录</h2>

            <br><br>
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


            <br>
            {!! Form::submit('提交登陆', ['class' => 'btn btn-primary form-control']) !!}
            
            {!! Form::close() !!}
            
        </div>
        </div>
        <br><br><br><br><br><br><br><br><br>
    </div>
</div>
@stop