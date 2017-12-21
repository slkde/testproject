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
                    <h3>回复列表</h3>					
					<!--搜索结果页面 列表 开始-->    
        <div class="result_wrap">
            <div class="result_content">
                <table class="table table-bordered table-hover"">
                    <tr>
                        <th class="tc">ID</th>                        
                        <th>内容</th>						
                        <th>发布时间</th>
                        <th>操作</th>
                    </tr>				
                @foreach($data as $k=>$v)
                        <tr>
                            <td class="tc">{{$v->id}}</td>                           
                            <td>{{$v->answer_content}}</td>		
							<td>{{date('Y-m-d',$v->created_at)}}</td>
                            <td>
                                <a href="{{url('admin/answer/'.$v->id.'/edit')}}">修改</a>
                                <a href="javascript:;" onclick="delAnswer({{ $v->id }})">删除</a>
                            </td>
                        </tr>						
                @endforeach
                </table>
				<!-- 带搜索的分页  -->
                    <div id="pull_right">
                        <ul class="pagination pull-right" style="margin-right: 200px">
                           
                        </ul>
                    </div>
					</div>
				</div>			
			</section>
    </div>
</div>
@endsection