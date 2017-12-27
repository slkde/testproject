@extends('parents')
@section('content')

<div class="row">
    <div class="col-md-1 col-md-offset-4">
        用户名：
    </div>
    <div class="col-md-3 col-md-offset-1">
        
        {!! Form::text('username') !!}
        
    </div>
</div>

<div class="row">
    <div class="col-md-1 col-md-offset-4">
        昵称:
    </div>
    <div class="col-md-3 col-md-offset-1">
        
        {!! Form::text('nickname') !!}
        
    </div>
</div>
<div class="row">
    <div class="col-md-1 col-md-offset-4">
        邮箱:
    </div>
    <div class="col-md-2 col-md-offset-1">
        
        {!! Form::email('email') !!}
        
    </div>
    <div class="col-md-3">
        
       发送激活邮件
        
    </div>
</div>
<div class="row">
    <div class="col-md-1 col-md-offset-4">
        性别:
    </div>
    <div class="col-md-3 col-md-offset-1">
        
        {!! Form::text('nickname') !!}
        
    </div>
</div>


@endsection