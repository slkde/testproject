@extends('parents')
@section('title')
    @if(!empty(Config::get('webconfig.title')))
    <title>{{ Config::get('webconfig.title') }}--登陆</title>
	@else
	<title>问答系统</title>
	@endif
@endsection
@section('content')

<div style="background: url('{{ asset('images/background2.jpg') }} '); margin-top:50px;width:100%;height:100%">
    <div class="container heade">
        <br><br><br><br><br>
        <div class="row">
        <div class="col-md-4 col-md-offset-4" role="main">
            <h2 style="text-align: center">问问答--用户登录</h2>

            <br><br><br>
            {!! Form::open(['url'=>'/user/login']) !!}

            {{--  <div class="form-group">
                
                {!! Form::label('name', 'Name:') !!}
                
                {!! Form::text('name', null, ['class' => 'form-control']) !!}
                
                
            </div>  --}}

            <div class="form-group">
                
                {!! Form::label('email', '邮箱: ') !!}
                @if($errors->has('email'))
                <button type="button" class="btn btn-danger btn-xs">{{ $errors->get('email')['0'] }}</button>
                @endif
                
                {!! Form::email('email', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                
                {!! Form::label('password', '密码:') !!}
                @if($errors->has('password'))
                 <button type="button" class="btn btn-danger btn-xs">{{ $errors->get('password')['0'] }}</button>
                @endif
                
                {{--  {!! Form::password('password', null, ['class' => 'form-control']) !!}  --}}
                <input type="password" class="form-control" name="password">
            </div>
            <div class="form-group">
                <div >
                    
                    {!! Form::label('vcode', '验证码:') !!}
                    
                </div>
                <div class="col-md-6">
                    
                    {!! Form::text('vcode', null,['class'=>'form-control']) !!}
                    
                </div>
                <div class="col-md-6">
                    
                    <img class="revcode" src="{{ url('vcode') }}/1">
                    
                </div>
                
            </div>

            {!! Form::submit('提交登陆', ['class' => 'btn btn-primary form-control']) !!}
            
            {!! Form::close() !!}
            <br>
            <a href="{{ url('user/forget') }}">忘记密码</a>
        </div>
        </div>
        <br><br><br><br><br><br><br><br><br>
    </div>
</div>
<script>    

    $('.revcode').click(function(){
        var url = "{{ url('vcode') }}" + '/' + Math.random();
        $(this).attr('src',url);
    })
</script>
@stop