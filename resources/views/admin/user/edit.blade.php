@extends('admin.parent')
@section('content')
    <!-- Text Input -->
    <div class="block-area col-md-10 col-sm-offset-4" id="text-input" >
        <h3 class="block-title">编辑用户</h3>

        <!-- 显示错误信息列表 -->
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        <form action="{{ url('/admin/user/'.$user->id) }}" method="post" class=" navbar-left">
            {{ method_field('put') }}
            {{ csrf_field() }}
            用户名：<input class="form-control input-lg m-b-10" type="text" placeholder="请输入用户名" name="username" value="{{ $user->username }}" disabled>           
            密码：<input type="password" name="password" class="form-control input-lg m-b-10" placeholder="请输入密码">
            
            确认密码：<input type="password" name="password_confirmation"
                        class="form-control input-lg m-b-10" placeholder="请再次输入密码">
			邮箱：<input type="email" name="email" class="form-control input-lg m-b-10" placeholder="请输入邮箱" value="{{ $user->email }}">           
            权限：<select class="form-control m-b-10" name="identty" style="height:50px">
                <option value="" >--请选择--</option>
                <option value="0" {{ ($user->identty == 0) ? 'selected':'' }}>普通用户</option>
                <option value="1" {{ ($user->identty == 1) ? 'selected':'' }}>普通用户（已验证）</option>
                <option value="9" {{ ($user->identty == 9) ? 'selected':'' }}>管理员</option>
            </select><br>
            <button class="btn btn-lg btn-primary btn-block">编辑</button>
        </form>
    </div>

@endsection