@extends('parents')
@section('title')
    @if(!empty(Config::get('webconfig.title')))
    <title>{{ Config::get('webconfig.title') }}--修改密码</title>
	@else
	<title>问答系统</title>
	@endif
@endsection
@section('content')
    <div class="container heade" style="margin-top:50px;">
        <div class="row">
        <div class="col-md-6 col-md-offset-3" role="main">
            {!! Form::open(['method'=>'patch','url'=>'/user/forget/'.$token]) !!}
            
            {{--  <div class="form-group">
                
                {!! Form::label('name', 'Name:') !!}
                
                {!! Form::text('name', null, ['class' => 'form-control']) !!}
                
                
            </div>  --}}

            <div class="form-group">
                
                {!! Form::label('email', '邮箱: ') !!}
                @if($errors->has('email'))
            {{ $errors->get('email')['0'] }}
            @endif
            @if($errors->has('msg'))
                <button type="button" class="btn btn-danger btn-xs">{{ $errors->get('msg') }}</button>
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
                
                {!! Form::label('password_confirmation', '修改密码:') !!}
                @if($errors->has('password_confirmation'))
                {{ $errors->get('password_confirmation')['0'] }}
                @endif
                
                {{--  {!! Form::text('password_confirmation', null, ['class' => 'form-control']) !!}  --}}
                <input type="password" class="form-control" name="password_confirmation">
                
                
            </div>

            
            {!! Form::submit('提交修改', ['class' => 'btn btn-primary form-control']) !!}
            
            {!! Form::close() !!}
            
        </div>
        </div>
    </div>
@stop