@extends('admin.parent')
@section('content')
    <!-- Text Input -->
    <div class="block-area col-md-10 col-sm-offset-4" id="text-input" >
        <h3 class="block-title">添加用户</h3>

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


        <form action="{{ url('/admin/user') }}" method="post" class=" navbar-left">

            {{ csrf_field() }}
            用户名：<input class="form-control input-lg m-b-10" type="text" placeholder="请输入用户名" name="username">
            {{--<input type="text" class="form-control m-b-10" placeholder="年龄" name="age">--}}
            密码：<input type="password" name="password" id="1" class="form-control input-lg m-b-10" placeholder="请输入密码">
            确认密码：<input type="password" name="password" id="2"
class="form-control input-lg m-b-10" placeholder="请再次输入密码">
            性别：<select class="form-control m-b-10" name="sex" style="height:50px">
                <option value="">--请选择--</option>
                <option value="1">男</option>
                <option value="2">女</option>
            </select>
            权限：<select class="form-control m-b-10" name="identty" style="height:50px">
                <option value="">--请选择--</option>
                <option value="0">普通用户</option>
                <option value="1">管理员</option>
            </select><br>
            <button class="btn btn-lg btn-primary btn-block">添加</button>
        </form>
    </div>

@endsection