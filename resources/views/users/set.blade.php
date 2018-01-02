@extends('parents')
@section('title')
	@if(!empty(Config::get('webconfig.title')))
	<title>{{ Config::get('webconfig.title') }}--个人设置</title>
	@else
	<title>问答系统</title>
	@endif
@endsection
@section('content')

<div style="background: url('{{ asset('images/background2.jpg') }} '); margin-top:50px;width:100%;height:100%">
	<br>
	<h2 style="text-align: center">问问答--信息修改</h2>
	<h3 class="msg" style="text-align: center">
		@if($errors->has('error'))
		{{ $errors->get('error')[0] }}
	@endif
	</h3>
	
	<br> {!! Form::open( ['url'=>'/user/set', 'class'=>'set']) !!} 
	@if(empty(Auth::user()->username))
	<div class="row">
		<div class="col-md-1 col-md-offset-4">
			用户名
		</div>
		<div class="col-md-3">

			{!! Form::text('username',null,['class'=>'form-control']) !!}

		</div>
		<div class="col-md-3">
			<p style="color: red;line-height: 30px">(注意，设置用户名后不能修改)</p>
		</div>
	</div>
	@endif
	<br>
	<div class="row">
		<div class="col-md-1 col-md-offset-4">
			昵称:
		</div>
		<div class="col-md-3">

			{!! Form::text('nickname',null,['placeholder' => $userinfo->nickname ,'class'=>'form-control']) !!}

		</div>
		<div class="col-md-3">
			@if(empty(\Auth::user()->nickname))
			<p style="color: red;line-height: 30px">(注意，必须设置昵称才能发表问题、回复)</p>
			@endif
		</div>
	</div>
	<br>
	<div class="row">
		<div class="col-md-1 col-md-offset-4">
			邮箱:
		</div>
		<div class="col-md-3">

			{!! Form::email('email',null,['placeholder' => $userinfo->email ,'class'=>'form-control']) !!}

		</div>
		<div class="col-md-3">

			<p style="color: red;line-height: 30px">(注意，修改邮箱需要验证邮箱)</p>

		</div>
	</div>
	<br>
	<div class="row">
		<div class="col-md-1 col-md-offset-4">
			性别:
		</div>
		<div class="col-md-1 ">
			{!! Form::radio('sex', 1, ($userinfo->sex == 1)? 'checked':'' ) !!}男
		</div>
		<div class="col-md-1">
			{!! Form::radio('sex', 2, ($userinfo->sex == 2)? 'checked':'' ) !!}女
		</div>
	</div>
	<br>
	<div class="row">
		<div class="col-md-1 col-md-offset-4">
			手机号:
		</div>
		<div class="col-md-3">

			{!! Form::text('phone',null,['placeholder' => $userinfo->phone,'class'=>'form-control' ]) !!}

		</div>
	</div>
	<br>
	<div class="row">
		<div class="col-md-1 col-md-offset-4">
			密码:
		</div>
		<div class="col-md-3">

			{!! Form::text('password',null,['placeholder' => '请输入密码' ,'class'=>'form-control']) !!}

		</div>
	</div>
	<br>
	<div class="row">
		<div class="col-md-1 col-md-offset-4">
			确认密码
		</div>
		<div class="col-md-3">

			{!! Form::text('password_confirmation',null,['placeholder' => '请再次输入密码' ,'class'=>'form-control']) !!}

		</div>
	</div>
	<br>
	<br> {!! Form::close() !!}
	<div class="row">


		<div class="col-md-4 col-md-offset-4">


			{!! Form::submit('提交修改', ['class'=>'btn btn-primary','id'=> 'userset','class'=>'form-control btn-primary']) !!}
		</div>
		<br>
		<br>
		<br>
		<br>
		<br>
	</div>
</div>




<script>
	$('#userset').click( function(){
        $('.msg').html;
        var options = {
        success: showResponse,
        error: showError,
        dataType: 'json'
        };
    
    $('.set').ajaxForm(options).submit();
    return;
  });
  
  function showResponse(response){
    $('.msg').html(response.msg);
    return;
  }

  function showError(response){
    var error = JSON.parse(response.responseText);
        for(var k in  error){
            $('.msg').html(error[k]);
        }
    return;
  }

</script>
@endsection