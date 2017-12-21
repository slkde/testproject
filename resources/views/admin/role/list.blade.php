@extends('admin.parent')
@section('content')
 <div class="block-area col-md-10" id="text-input" >
 <div class="result_title">
        @if(session('msg'))
            <h3 style="color:red;margin-left: 500px">{{session('msg')}}</h3>
        @endif
</div>
	<h3 class="block-title">角色列表</h3>
		<form class=" navbar-form navbar-left" role="search" action="{{ url('/admin/role/')}}" style="font-size:20px">
                    <div class="form-group">&nbsp;&nbsp;&nbsp;&nbsp;
                        角色名称：<input type="text" class="form-control" placeholder="请输入要搜索的角色名称" name="name" style="height: 35px">&nbsp;&nbsp;&nbsp;&nbsp;
                        角色描述：<input type="text" class="form-control" placeholder="请输入要搜索的描述" name="description" style="height: 35px">&nbsp;&nbsp;&nbsp;&nbsp;
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
                        <th>角色名称</th>
                        <th>角色描述</th>

                        <th>操作</th>
                    </tr>

                @foreach($roles as $k=>$v)
                        <tr>
                            <td class="tc">{{$v->id}}</td>
                            <td>{{$v->name}}</td>
                            <td>{{$v->description}}</td>

                            <td>
                                <a href="{{url('admin/role/'.$v->id.'/edit')}}">修改</a>
                                <a href="javascript:doDel({{$v->id}})">删除</a>
                                <a href="{{url('admin/role/auth/'.$v->id)}}">授权</a>
                            </td>
                        </tr>

                    @endforeach
                </table>
					<!-- 带搜索的分页  -->
                    <div id="pull_right">
                        <ul class="pagination pull-right" style="margin-right: 200px">
                            {!! $roles->appends($where)->render() !!}
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
			form.action = '/admin/role/'+id;
			form.submit();
		}
	}
</script>		
@endsection


































