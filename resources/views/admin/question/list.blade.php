@extends('admin.parent')
@section('content')
	<div class="result_title" style="color:red;margin-left: 380px">
        @if(session('msg'))
            <h3 style="color:red;margin-left: 500px">{{session('msg')}}</h3>
        @endif
    </div>
<div class="row">
        <div class="col-lg-12">
            <section class="panel">
			<header class="panel-heading">
                    <h3>提问列表</h3>
                </header>
                <form class=" navbar-form navbar-left" role="search" action="{{ url('/admin/question/')}}">
                    <div class="form-group">&nbsp;&nbsp;&nbsp;&nbsp;
                        标题：<input type="text" class="form-control" placeholder="请输入要搜索的问题标题" name="title" style="height: 35px">&nbsp;&nbsp;&nbsp;&nbsp;
                        内容：<input type="text" class="form-control" placeholder="请输入要搜索的内容" name="content" style="height: 35px">&nbsp;&nbsp;&nbsp;&nbsp;
                       <!-- 作者：<input type="text" class="form-control" placeholder="作者" name="" style="height: 35px">&nbsp;&nbsp;&nbsp;&nbsp;-->    
                        
                    </div>&nbsp;&nbsp;&nbsp;&nbsp;
                    <button type="submit" class="btn btn-default">搜索</button>
                </form>
                <br><br>
		<!--搜索结果页面 列表 开始-->    
        <div class="result_wrap">
            <div class="result_content">
                <table class="table table-bordered table-hover">
                    <tr>
                        <th class="tc">ID</th>
                        <th>标题</th>
                        <th>内容</th>						
                        <th>作者</th>
                        <th>点赞数</th>						
                        <th>发布时间</th>
                        <th>操作</th>
                    </tr>
				
                @foreach($data as $k=>$v)
                        <tr>
                            <td class="tc">{{$v->id}}</td>
                            <td width="100px">{{$v->title}}</td>
                            <td width="550px">{!!$v->content !!}}</td>
							
							<td>{{ $v->user->username }}</td>
                            <td>{{$v->support}}</td>                         
                            
                            <td>{{$v->created_at}}</td>
                            <td>
                                <a class="btn btn-primary" href="{{url('admin/question/'.$v->id)}}">详情</a>
                                <a class="btn btn-info" href="{{url('admin/question/'.$v->id.'/edit')}}">修改</a>
                                <a class="btn btn-danger" href="javascript:;" onclick="delQuestion({{ $v->id }})">删除</a>
                            </td>
                        </tr>
						
                    @endforeach
                </table>
				<!-- 带搜索的分页  -->
                    <div id="pull_right">
                        <ul class="pagination pull-right" style="margin-right: 200px">
                            {!! $data->appends($where)->render() !!}
                        </ul>
                    </div>
					</div>
				</div>
		</section>
    </div>
</div>
<script>
	function delQuestion(id){
            layer.confirm('确认删除吗？', {
                btn:['确认', '取消']
            },function(){
                $.post('{{url('admin/question/')}}/'+id, {'_token':'{{csrf_token()}}', '_method':'delete'}, function(data){
                    console.log(data);
                    if(data.status == 0){
                        layer.msg(data.msg, {icon:6});
                        setTimeout(function(){
                            location.href = location.href;
                        }, 2000);
                    }else{
                        layer.msg(data.msg, {icon:5});
                        $('.result_title').html(data);
                    }
                });
            },function(){});
        }
</script>	
@endsection


















