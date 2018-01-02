@extends('admin.parent')
@section('content')

     <!-- 右侧内容区域 -->
        <div class="col-md-10">

            <!-- 自定义内容区域 -->
            <div class="panel panel-default">
                <div class="panel-heading">用户详情</div>

                <table class="table table-bordered table-striped table-hover ">
                    <tbody>
                    <tr>
                        <td width="20%">ID</td>
                        <td>{{ $user->id }}</td>
                    </tr>
                    <tr>
                        <td>姓名</td>
                        <td>{{ $user->username }}</td>
                    </tr>
                    <tr>
                        <td>昵称</td>
                        <td>{{ $user->nickname }}</td>
                    </tr>
                    <tr>
                        <td>性别</td>
                        <td>{{ ($user->sex == 1) ?"男":(($user->sex == 2) ?"女":"未知") }}</td>
                    </tr>
                    <tr>
                        <td>密码</td>
                        <td>{{ $user->password }}</td>
                    </tr>
                     <tr>
                        <td>电话</td>
                        <td>{{ $user->phone }}</td>
                    </tr>
                     <tr>
                        <td>邮箱</td>
                        <td>{{ $user->email }}</td>
                    </tr>
                     <tr>
                        <td>头像</td>
                        <td>{{ $user->photo }}</td>
                    </tr>
                     <tr>
                        <td>积分</td>
                        <td>{{ $user->score }}</td>
                    </tr>
                     <tr>
                        <td>权限</td>
                        <td>{{ ($user->identty == 9)?'管理员':'普通用户' }}</td>
                    </tr>
                    <tr>
                        <td>签名</td>
                        <td>{{ $user->autograph }}</td>
                    </tr>
                    <tr>
                        <td>工作</td>
                        <td>{{ $user->job }}</td>
                    </tr>
                    
                    </tbody>
                </table>
            </div>
        </div>

    </div>



@endsection