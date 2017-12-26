<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
    <meta name="author" content="GeeksLabs">
    <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
    {{--<link rel="shortcut icon" href="{{ asset('res/admin/img/favicon.png') }}">--}}

    <title>找回密码</title>

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

		<form action="{{url('doreset')}}" method="post" class="login-form">
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
		<div class="login-wrap">
            <p class="login-img"><i class="icon_lock_alt"></i></p>
				{{csrf_field()}}
				{{--//要重置密码的用户的id--}}
				<input type="hidden" name="uid" value="{{$uid}}">
				
					<div class="input-group">
                <span class="input-group-addon"><i class="icon_key_alt"></i></span>
                <input type="password" class="form-control" placeholder="请输入您的密码" value="" name="password">
            </div>
			<div class="input-group">
                <span class="input-group-addon"><i class="icon_key_alt"></i></span>
                <input type="password" class="form-control" placeholder="请再次输入您的密码" value="" name="password_confirmation">
            </div>
				<button class="btn btn-primary btn-lg btn-block" type="submit">登录</button>
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
