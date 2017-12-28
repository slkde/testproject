@extends('parents')
@section('content')


{!! Form::open( ['url'=>'/user/set', 'class'=>'set']) !!}
@if(empty(Auth::user()->username))
<div class="row">
    <div class="col-md-1 col-md-offset-4">
        用户名：
    </div>
    <div class="col-md-3 col-md-offset-1">
        
        {!! Form::text('username') !!}
        
    </div>
</div>
@endif
<div class="row">
    <div class="col-md-1 col-md-offset-4">
        昵称:
    </div>
    <div class="col-md-3 col-md-offset-1">
        
        {!! Form::text('nickname',null,['placeholder' => $userinfo->nickname ]) !!}
        
    </div>
</div>
<div class="row">
    <div class="col-md-1 col-md-offset-4">
        邮箱:
    </div>
    <div class="col-md-2 col-md-offset-1">
        
        {!! Form::email('email',null,['placeholder' => $userinfo->email ]) !!}
        
    </div>
    <div class="col-md-3">
        
       注意，修改邮箱需要验证邮箱
        
    </div>
</div>
<div class="row">
    <div class="col-md-1 col-md-offset-4">
        性别:
    </div>
    <div class="col-md-1 col-md-offset-1">
        {!! Form::radio('sex', 1, ($userinfo->sex == 1)? 'checked':'' ) !!}男
    </div>
    <div class="col-md-1">
        {!! Form::radio('sex', 2, ($userinfo->sex == 2)? 'checked':'' ) !!}女
    </div>
</div>
<div class="row">
    <div class="col-md-1 col-md-offset-4">
        手机号:
    </div>
    <div class="col-md-3 col-md-offset-1">
        
        {!! Form::text('phone',null,['placeholder' => $userinfo->phone ]) !!}
        
    </div>
</div>
<div class="row">
    <div class="col-md-1 col-md-offset-4">
        密码:
    </div>
    <div class="col-md-3 col-md-offset-1">
        
        {!! Form::text('password',null,['placeholder' => '请输入密码' ]) !!}
        
    </div>
</div>
<div class="row">
    <div class="col-md-1 col-md-offset-4">
        确认密码:
    </div>
    <div class="col-md-3 col-md-offset-1">
        
        {!! Form::text('password_confirmation',null,['placeholder' => '请再次输入密码' ]) !!}
        
    </div>
</div>
{!! Form::close() !!}
<div class="row">
    <div class="col-md-2 col-md-offset-4 backmsg" style="color:green;line-height:32px">
    </div>

    <div class="col-md-3">
        
        
        {!! Form::submit('提交修改', ['class'=>'btn btn-primary','id'=> 'userset']) !!}
        
    </div>
</div>




<script>    

      $('#userset').click( function(){
    var options = {
      success: showResponse,
      error: showError,
      dataType: 'json'
    };
    
    $('.set').ajaxForm(options).submit();
    return;
  });
  
  function showResponse(response){
    $('.backmsg').html(response.password);
    return;
  }

  function showError(response){
    $('.backmsg').html(JSON.parse(response.responseText).password[0]);
    return;
  }
</script>
@endsection