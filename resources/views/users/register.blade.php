@extends('parents')
@section('title')
    @if(!empty(Config::get('webconfig.title')))
    <title>{{ Config::get('webconfig.title') }}--用户注册</title>
	@else
	<title>问答系统</title>
	@endif
@endsection
@section('content')


<div style="background: url('{{ asset('images/background2.jpg') }} '); margin-top:50px;width:100%;height:100%">
    <div class="container heade" >
        <br><br><br>
        <div class="row" >
        <div class="col-md-6 col-md-offset-3" role="main">
            <h2 style="text-align: center">问问答--用户注册</h2>
            {!! Form::open(['url'=>'/user/register']) !!}

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
             <div class="form-group">
                
                {!! Form::label('password_confirmation', '确认密码:') !!}
                @if($errors->has('password_confirmation'))
                {{ $errors->get('password_confirmation')['0'] }}
                @endif
                
                {{--  {!! Form::text('password_confirmation', null, ['class' => 'form-control']) !!}  --}}
                <input type="password" class="form-control" name="password_confirmation">
                
                
            </div>
            <span class="Register-declaration"><!-- react-text: 166 -->注册即代表你同意<!-- /react-text --><a href="#">《问问答协议》</a></span><br><br>

            {!! Form::submit('提交注册', ['class' => 'btn btn-primary form-control']) !!}
            
            {!! Form::close() !!}


        </div>
        </div>
        <br><br><br><br><br><br><br><br><br>
    </div>
</div>

@stop