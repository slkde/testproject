@extends('usercenter_parent')
@section('title','修改信息')
@section('content')
<div class="jztop" style="	background: url(../../images/usercenter/jztop.png) no-repeat;
  width: 1034px;
  margin: auto;
  height: 32px;"></div>
  <div class="container">
    <div style="padding-left:250px;padding-top:100px">
      @if (count($errors) > 0)
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif
      @if(session('msg'))
        {{ session('msg') }}
      @endif
    </div>
    <div class="bloglist f_l"><br><br><br><br>
      <form action="{{ url('/user/changes') }}" method="post" style="padding-left:200px">
        {{ csrf_field() }}
        昵&nbsp&nbsp称：<input type="text" name="nickname" value="{{ old('nickname') }}" placeholder="{{ $user['nickname'] }}"><br><br><br>
        密&nbsp&nbsp码：<input type="password"  name="password_confirmation"><br><br><br>
        确认密码：<input type="password" name="password"><br><br><br>
        性&nbsp&nbsp别：&nbsp&nbsp<label><input type="radio" name="sex" {{ $user['sex'] ? 'checked' : '' }} value="1">男</label>&nbsp&nbsp&nbsp&nbsp&nbsp
          <label><input type="radio" name="sex" {{ $user['sex'] ? '' : 'checked'}} value="0">女</label><br><br><br>
        手&nbsp&nbsp机：<input type="text" name="phone" value="{{ old('phone') }}" placeholder="{{ $user['phone'] }}"><br><br><br>
        邮&nbsp&nbsp箱：<input type="email" value="{{ old('email') }}" name="email" placeholder="{{ $user['email'] }}"><br><br><br>
        职&nbsp&nbsp业：<input type="text" value="{{ old('job') }}" name="job" placeholder="{{ $user['job'] }}"><br><br><br>
        验证码&nbsp：<input type="text" name="code"><br><br>
        <img style="margin-left:100px" src="{{ url('/user/code') }}" onclick="this.src='{{ url('/user/code') }}?'+Math.random()" alt=""><br><br>
        <input type="submit" value="提交">
      </form>
  </div>

@endsection