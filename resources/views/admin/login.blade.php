<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
    <meta name="author" content="GeeksLabs">
    <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
    {{--<link rel="shortcut icon" href="{{ asset('res/admin/img/favicon.png') }}">--}}

    <title>管理员后台登录页面</title>

    <!-- Bootstrap CSS -->
    <link href="{{ asset('res/admin/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- bootstrap theme -->
    <link href="{{ asset('res/admin/css/bootstrap-theme.css') }}" rel="stylesheet">
    <!--external css-->
    <!-- font icon -->
    <link href="{{ asset('res/admin/css/elegant-icons-style.css') }}" rel="stylesheet" />
    <link href="{{ asset('res/admin/css/font-awesome.css') }}" rel="stylesheet" />
    <!-- Custom styles -->
    <link href="{{ asset('res/admin/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('res/admin/css/style-responsive.css') }}" rel="stylesheet" />

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 -->
    <!--[if lt IE 9]>
    <script src="{{ asset('res/admin/js/html5shiv.js') }}"></script>
    <script src="{{ asset('res/admin/js/respond.min.js') }}"></script>
    <![endif]-->
</head>

<body class="login-img3-body">

<div class="container">


    <form class="login-form" action="{{ url('admin/dologin') }}" method="post">
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @if(is_object($errors))
                        @foreach ($errors->all() as $error)
                            <li style="color:red;">{{ $error }}</li>
                        @endforeach
                    @else
                        <li style="color:red;">{{ $errors }}</li>
                    @endif
                </ul>
            </div>
        @endif
        {{ csrf_field() }}
        <div class="login-wrap">
            <p class="login-img"><i class="icon_lock_alt"></i></p>
            <div class="input-group">
                <span class="input-group-addon"><i class="icon_profile"></i></span>
                <input type="text" class="form-control" name="username" placeholder="请输入您的用户名" value="{{ old('username') }}" autofocus>
            </div>
            <div class="input-group">
                <span class="input-group-addon"><i class="icon_key_alt"></i></span>
                <input type="password" class="form-control" placeholder="请输入您的密码" value="{{ old('password') }}" name="password">
            </div>
            <div class="input-group">
                <input type="text"  class="code" name="code" value="{{old('code')}}" style="height:40px" placeholder="请输入验证码"/>
                {{--生成验证码的方法二  composer现在相应的组件--}}
                <a onclick="javascript:re_captcha();">
                    <img src="{{ URL('/code/captcha/1') }}" id="127ddf0de5a04167a9e427d883690ff6">
                </a>
            </div>
            <label class="checkbox">
                {{--<input type="checkbox" value="remember-me"> Remember me--}}
                <span class="pull-right"> <a href="{{url('forget')}}"> 忘记密码?</a></span>
            </label>
            <button class="btn btn-primary btn-lg btn-block" type="submit">登录</button>
            {{--<button class="btn btn-info btn-lg btn-block" type="submit">Signup</button>--}}
        </div>
    </form>

</div>


</body>
<script type="text/javascript">
    function re_captcha() {
        $url = "{{ URL('/code/captcha') }}";
        $url = $url + "/" + Math.random();
        document.getElementById('127ddf0de5a04167a9e427d883690ff6').src = $url;
    }
</script>
</html>
