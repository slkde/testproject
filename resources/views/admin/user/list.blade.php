@extends('admin.parent')
@section('content')
    <div class="result_title">
        @if(session('msg'))
            <h3 style="color:red;margin-left: 500px">{{session('msg')}}</h3>
        @endif
    </div>

    <div class="row">

        <div class="col-lg-12">

            <section class="panel">

                <header class="panel-heading">
                    <h3>用户列表</h3>
                </header>
                <form class=" navbar-form navbar-left" role="search" action="{{ url('/admin/user/')}}">
                    <div class="form-group">&nbsp;&nbsp;&nbsp;&nbsp;
                        姓名：<input type="text" class="form-control" placeholder="名字" name="username" style="height: 35px">&nbsp;&nbsp;&nbsp;&nbsp;
                        性别：<select class="form-control" name="sex" style="height: 35px">
                            <option value="">--请选择--</option>
                            <option value="1">男</option>
                            <option value="2">女</option>
                        </select>
                    </div>&nbsp;&nbsp;&nbsp;&nbsp;
                    <button type="submit" class="btn btn-default">搜索</button>
                </form>
                <br><br>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" >
                        <thead>
                        <tr class="danger text-center ">
                            <td><h4>用户ID</h4></td>
                            <td><h4>用户名</h4></td>
                            <td><h4>性别</h4></td>
                            <td><h4>权限</h4></td>
                            {{--<td><h4>状态</h4></td>--}}
                            <td><h4>操作</h4></td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($user as $v)
                            <tr class="success text-center">
                                <td>{{ $v->id }}</td>
                                <td>{{ $v->username }}</td>
                                <td>{{ ($v->sex == 1)?'男':(($v->sex == 2)?'女':'未知' )}}</td>
                                <td>{{ ($v->identty == 9)?'管理员':'普通用户' }}</td>
                                {{--//数据库没有这个字段--}}
                                {{--<td>{{ ($v->status == 0)?'启用':'禁用' }}</td>--}}
                                <td><a class="btn btn-default" href="{{ url('admin/user/'.$v->id) }}">详情</a>&nbsp;<a class="btn btn-success" href="{{ url('admin/user/'.$v->id.'/edit') }}">编辑</a>&nbsp;<a class="btn btn-danger" href="javascript:;" onclick="delUser({{ $v->id }})">删除</a>&nbsp;
                                    {{--  <a class="btn btn-success" href="{{ url('admin/user/auth/'.$v->id) }}">授权</a>  --}}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <!-- 分页  -->
                    <div id="pull_right">
                        <ul class="pagination pull-right" style="margin-right: 200px">
                            {!! $user->appends($where)->render() !!}
                        </ul>
                    </div>
                </div>

            </section>
        </div>
    </div>
    <script>
        function delUser(id){
            layer.confirm('您要删除用户的所有提问和回复吗，确认删除该用户吗？', {
                btn:['确认', '取消']
            },function(){
                $.post('{{url('admin/user/')}}/'+id, {'_token':'{{csrf_token()}}', '_method':'delete'}, function(data){
                    console.log(data);
                    if(data.status == 0){
                        layer.msg(data.msg, {icon:6});
                        setTimeout(function(){
                            location.href = location.href;
                        }, 2000);
                    }else{
                        layer.msg(data.msg, {icon:5});
                        setTimeout(function(){
                            location.href = location.href;
                        }, 2000);
                    }
                });
            },function(){});
        }
    </script>

@endsection