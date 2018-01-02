@extends('admin.parent')
@section('content')
<div class="result_title">
        @if(session('msg'))
            <h3 style="color:red;margin-left: 400px">{{session('msg')}}</h3>
        @endif
    </div>
     <!-- 右侧内容区域 -->
        <div class="col-md-10">

            <!-- 自定义内容区域 -->
            <div class="panel panel-default">
                <div class="panel-heading"><h3>提问详情</h3></div>

                <table class="table table-bordered table-striped table-hover ">
                    <tbody>
                    <tr>
                        <td width="20%">提问ID</td>
                        <td>问题标题</td>
                        <td>问题内容</td>
                        <td>作者</td>
                        <td>图片</td>                 
                        <td>提问时间</td>                 
                                    
                    </tr>
                   <tr>
					    <td>{{$question->id}}</td>
						<td>{{$question->title}}</td>
						<td>{!!$question->content!!}</td>
						<td>{{$question->user->username}}</td>
						<td>{{$question->photo}}</td>
						<td>{{$question->created_at}}</td>
						
				   </tr>
				    </tbody>
				   </table>
				   <br>
				   
				 
				   <table class="table table-bordered table-striped table-hover ">
				    <tbody>
				   <tr><div class="panel-heading"><h3>问题下的回答详情</h3></div></tr>
				   <tr>
                        <td width="20%">回答ID</td>
                      
                        <td>回答内容</td>
                        <td>点赞数</td>
                        <td>回答时间</td>
                        <td>回答状态</td>
                        <td>回复人</td>
                                      
                        <td>操作</td>                 
                    </tr>
				   @foreach($question->question_answer as $k=>$v)
					<tr>
						<td>||----{{$v->id}}</td>
						
						<td>{!!$v->answer_content!!}</td>
						<td>{{$v->support}}</td>
						<td>{{$v->created_at}}</td>
						<td>{{$v->answer_status}}</td>
						<td>{{$v->user->username}}</td>
						
						<td><a class="btn btn-danger" href="javascript:doDel({{ $v->id }})">删除</a></td>
				   </tr>		   
				   
				   @endforeach			 
                    
                    </tbody>
                </table>			
				<form name = 'myform' method='post' style='display:none'>
                        {{ csrf_field() }}
                        
                    </form>
            </div>
			<a class="btn btn-primary btn-lg btn-block" href="{{ url('admin/question/') }}">返回</a>
        </div>
		
    </div>
	
<script>
        function doDel(id){
            if(confirm('您确定删除吗？')){
                var form = document.myform;
                form.action = '/admin/answer/destroy/'+id;
                form.submit();
            }
        }
    </script>


@endsection