@extends('parents')
@section('title')
    @if(!empty(Config::get('webconfig.title')))
    <title>{{ Config::get('webconfig.title') }}--找回密码</title>
	@else
	<title>问答系统</title>
	@endif
@endsection
@section('content')

<div style="background: url('{{ asset('images/background2.jpg') }} '); margin-top:50px;width:100%;height:100%">
    <div class="container heade">
        <div class="row">
        <div class="col-md-4 col-md-offset-4" role="main">
            <br>
            <h2 style="text-align: center">问问答--密码找回</h2>
            
            <br><br>
            {!! Form::open(['url'=>'/user/forget']) !!}

            <div class="form-group">
                
                {!! Form::label('email', '邮箱: ') !!}
                @if($errors->has('msg'))
                <button type="button" class="btn btn-danger btn-xs">{{ $errors->get('msg') }}</button>
                @endif
                @if($errors->has('email'))
                <button type="button" class="btn btn-danger btn-xs">{{ $errors->get('email')['0'] }}</button>
                @endif
                
                {!! Form::email('email', null, ['class' => 'form-control']) !!}
            </div>
            
            {!! Form::submit('验证邮箱', ['class'=>"btn btn-primary form-control"]) !!}
            
            {!! Form::close() !!}
        </div>
        </div>
        <br><br><br><br><br><br><br><br><br>
    </div>
</div>
@stop