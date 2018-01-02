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
                <div class="panel-heading"><h3>回复详情</h3></div>

                <table class="table table-bordered table-striped table-hover ">
                    <tbody>
                    <tr>
                        <td width="20%">回复ID</td>
						<td>{{$answer->id}}</td>
					</tr>
					<tr>
                        <td>回答人</td>
						<td>{{$answer->user->username}}</td>
					</tr>
					<tr>
                        <td>回复内容</td>
						<td>{{$answer->answer_content}}</td>
					</tr>
					<tr>
                        <td>回复的提问标题</td> 
						<td>{{$answer->answer_question->title}}</td>
					</tr>
					<tr>
                        <td>回复时间</td>                 
                         <td>{{$answer->created_at}}</td>           
                    </tr>
				    </tbody>
				   </table>
				   <br>				
            </div>
			<a class="btn btn-primary btn-lg btn-block" href="{{ url('admin/answer/') }}">返回</a>
        </div>		
    </div>
@endsection