@extends('admin.parent')
@section('content')
 <div class="block-area col-md-10" id="text-input" >
 <div class="result_title">
        @if(session('msg'))
            <h3 style="color:red;margin-left: 500px">{{session('msg')}}</h3>
        @endif
</div>
	<h3 class="block-title">权限列表</h3>
		<form class=" navbar-form navbar-left" role="search" action="{{ url('/admin/permission/')}}" style="font-size:20px">
                    <div class="form-group">&nbsp;&nbsp;&nbsp;&nbsp;
                        权限名称：<input type="text" class="form-control" placeholder="请输入要搜索的权限名称" name="name" style="height: 35px">&nbsp;&nbsp;&nbsp;&nbsp;
                        权限路径：<input type="text" class="form-control" placeholder="请输入要搜索的权限路径" name="path" style="height: 35px">&nbsp;&nbsp;&nbsp;&nbsp;
                      <!--  作者：<input type="text" class="form-control" placeholder="作者" name="user_id" style="height: 35px">&nbsp;&nbsp;&nbsp;&nbsp;-->
                        
                    </div>&nbsp;&nbsp;&nbsp;&nbsp;
                    <button type="submit" class="btn btn-default">搜索</button>
                </form>
                <br><br>
	<section class="panel">
	<div class="result_wrap">
            <div class="result_content">
                <table class="list_tab table table-bordered table-hover">
                    <tr>
                        <th class="tc">ID</th>
                        <th>权限名称</th>
                        <th>权限路径</th>
                        <th>操作</th>
                    </tr>
                @foreach($permissions as $k=>$v)
                        <tr>
                            <td class="tc">{{$v->id}}</td>
                            <td>{{$v->name}}</td>
                            <td>{{$v->path}}</td>
                            <td>
                                <a href="{{url('admin/permission/'.$v->id.'/edit')}}">修改</a>
                                <a href="javascript:doDel({{$v->id}})">删除</a>                              
                            </td>
                        </tr>

                    @endforeach
                </table>
					<!-- 带搜索的分页  -->
                    <div id="pull_right">
                        <ul class="pagination pull-right" style="margin-right: 200px">
                            {!! $permissions->appends($where)->render() !!}
                        </ul>
                    </div>
					<form name="myform" method='post' style="display:none">
					{{ csrf_field() }}
						{{method_field('delete')}}
					</form>
					
            </div>
        </div>
	</section>	
</div>
<script>
	function doDel(id){
		if(confirm('您确定删除吗？')){
			var form = document.myform;
			form.action = '/admin/permission/'+id;
			form.submit();
		}
	}
</script>		
@endsection


































