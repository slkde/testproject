@extends('admin.parent')
@section('content')
	
	<style>
		#neirong{
			 width:750px; 
			overflow:hidden;
			text-overflow:ellipsis;
			white-space:normal;
		
		}
	</style>
	<div class="result_title">
        @if(session('msg'))
            <h3 style="color:red;margin-left: 500px">{{session('msg')}}</h3>
        @endif
    </div>
<div class="row">
        <div class="col-lg-12">
            <section class="panel">
			<header class="panel-heading">
                    <h3>回复列表</h3>					
					<!--搜索结果页面 列表 开始--> 					
                <form class=" navbar-form navbar-left" role="search" action="{{ url('/admin/answer/')}}">
                    <div class="form-group">&nbsp;&nbsp;&nbsp;&nbsp;
                       <!-- 标题：<input type="text" class="form-control" placeholder="请输入要搜索的回复内容" name="title" style="height: 35px">&nbsp;&nbsp;&nbsp;&nbsp;-->
                        内容：<input type="text" class="form-control" placeholder="请输入要搜索的内容" name="answer_content" style="height: 35px">&nbsp;&nbsp;&nbsp;&nbsp;
                       <!-- 作者：<input type="text" class="form-control" placeholder="作者" name="" style="height: 35px">&nbsp;&nbsp;&nbsp;&nbsp;-->    
                        
                    </div>&nbsp;&nbsp;&nbsp;&nbsp;
                    <button type="submit" class="btn btn-default">搜索</button>
                </form>
                <br><br>
        <div class="result_wrap">
            <div class="result_content">
                <table class="table table-bordered table-hover">
                    <tr>
                        <th class="tc">ID</th>                        
                        <th>内容</th>						
                        <th>发布时间</th>
                        <th>操作</th>
                    </tr>				
                @foreach($data as $k=>$v)
                        <tr>
                            <td class="tc">{{$v->id}}</td>                           
                            <td id="neirong" >{!!$v->answer_content!!}</td>		
							<td>{{$v->created_at}}</td>
                            <td>
                                <a class="btn btn-primary" href="{{url('admin/answer/'.$v->id)}}">详情</a>
                                <a class="btn btn-primary" href="javascript:;" onclick="delAnswer({{ $v->id }})">删除</a>
                            </td>
                        </tr>						
                @endforeach
                </table>
				<form name = 'myform' method='post' style='display:none'>
                        {{ csrf_field() }}
                   
                    </form>
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
        function delAnswer(id){
            if(confirm('您确定删除吗？')){
                var form = document.myform;
                form.action = '/admin/answer/del/'+id;
                form.submit();
            }
        }
    </script>
@endsection