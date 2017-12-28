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
                    <h3>网站配置列表</h3>
                </header>
                <form class="navbar-form navbar-left" role="search">
                    {{csrf_field()}}
                    <div class="form-group">&nbsp;&nbsp;&nbsp;&nbsp;
                        关键词：<input type="text" class="form-control" placeholder="名字" name="username" style="height: 35px">&nbsp;&nbsp;&nbsp;&nbsp;
                        状态：<select class="form-control" name="sex" style="height: 35px">
                            <option value="">--请选择--</option>
                            <option value="1">开启</option>
                            <option value="2">关闭</option>
                        </select>
                    </div>&nbsp;&nbsp;&nbsp;&nbsp;
                    <button type="submit" class="btn btn-default">搜索</button>
                </form>
                <br><br>
                <form action="{{url('admin/config/changecontent')}}" method="post">
                {{csrf_field()}}
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" >
                        <thead>
                        <tr class="danger text-center ">
                            <td><h4>ID</h4></td>
                            <td><h4>标题</h4></td>
                            <td><h4>名称</h4></td>
                            <td><h4>内容</h4></td>
                            <td><h4>操作</h4></td>
                        </tr>
                        </thead>
                        
                            <!-- <tbody> -->
                            @foreach($confs as $k=>$v)
                                <tr class="success text-center">
                                    <td>{{ $v->id }}</td>
                                    <td>{{ $v->title }}</td>
                                    <td>{{ $v->name }}</td>
                                    <td>
                                        <input type="hidden" name="id[]" value="{{$v->id}}">
                                        {!! $v->content !!}
                                    </td>
                                    <td>
                                        <a class="btn btn-success" href="{{ url('admin/config/'.$v->id.'/edit') }}">修改</a>&nbsp;
                                        <a class="btn btn-danger" href="javascript:;" onclick="delConfig({{$v->id}})">删除</a>
                                        <!-- <a class="btn btn-danger" href="{{ url('admin/config/'.$v->id.'/destroy') }}">删除</a> -->
                                    </td>
                                </tr>
                            @endforeach
                            <tr>

                                <td colspan="5">
                                <input class="btn btn-warning" style="margin-left: 500px;" type="submit" value="批量提交">

                                </td>
                            </tr>
                            <!-- </tbody> -->
                        
                    </table>
                    
                </div>
                </form>
            </section>
        </div>
    </div>
    <script>
        function delConfig(id){
        layer.confirm('确认删除吗？', {
            btn: ['确认','取消'] //按钮
        }, function(){


//            $.post('请求的url','请求的参数',请求后的返回结果)
            $.post('{{url('admin/config/')}}/'+id,{'_token':'{{csrf_token()}}','_method':'delete'},function(data){
                console.log(data);
                if(data.status == 0){
                    setTimeout(function(){
                        location.href = location.href;
                    },1000);

                }else{
                    setTimeout(function(){
                        location.href = location.href;
                    },1000);
                }


            });
           layer.msg('删除成功', {icon: 1});




        }, function(){

        });
    }



        function changeOrder(obj,id){

        //获取文本框的值
        var v = $(obj).val();
//        向服务器发送请求，执行排序的修改操作
        $.post('{{url('admin/cate/changeorder')}}',{'id':id,'v':v,'_token':"{{csrf_token()}}"},function (data) {
            console.log(data);

                if(data.status == 0){
                    layer.msg(data.msg, {icon: 6});
                    setTimeout(function(){
                        location.href = location.href;
                    },1000);

                }else{
                    layer.msg(data.msg, {icon: 5});
                    setTimeout(function(){
                        location.href = location.href;
                    },1000);
                }
            })
        }
    </script>

@endsection