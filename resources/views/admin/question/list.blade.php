@extends('admin.parent')
@section('content')
	
	 <div class="crumb_warp">

        @if(session('msg'))
            <h3>{{session('msg')}}</h3>
        @endif
    </div>

<div class="row">

        <div class="col-lg-12">

            <section class="panel">
			<header class="panel-heading">
                    <h3>提问列表</h3>
                </header>
                <form class=" navbar-form navbar-left" role="search" action="{{ url('/admin/question/list')}}">
                    <div class="form-group">&nbsp;&nbsp;&nbsp;&nbsp;
                        标题：<input type="text" class="form-control" placeholder="标题" name="title" style="height: 35px">&nbsp;&nbsp;&nbsp;&nbsp;
                        内容：<input type="text" class="form-control" placeholder="内容" name="content" style="height: 35px">&nbsp;&nbsp;&nbsp;&nbsp;
                        作者：<input type="text" class="form-control" placeholder="作者" name="user_id" style="height: 35px">&nbsp;&nbsp;&nbsp;&nbsp;
                        
                    </div>&nbsp;&nbsp;&nbsp;&nbsp;
                    <button type="submit" class="btn btn-default">搜索</button>
                </form>
                <br><br>
	<!--搜索结果页面 列表 开始-->
    <form action="#" method="post">
        <div class="result_wrap">
            <div class="result_content">
                <table class="table table-bordered table-hover"">
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
                            <td>
                                <a href="#">{{$v->title}}</a>
                            </td>
                            <td>{{$v->content}}</td>
                            <td>{{$v->support}}</td>                         
                            <td>{{$v->user_id}}</td>
                            <td>{{date('Y-m-d',$v->created_at)}}</td>
                            <td>
                                <a href="{{url('admin/question/'.$v->id.'/edit')}}">修改</a>
                                <a href="javascript:;" onclick="delArt({{$v->art_id}})">删除</a>
                            </td>
                        </tr>

                    @endforeach
                </table>



            </div>
        </div>
    </form>

</section>
        </div>
    </div>













@endsection