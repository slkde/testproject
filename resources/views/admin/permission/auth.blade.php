@extends('admin.parent')
@section('content')

 <div class="block-area col-md-10" id="text-input" >
	<h3 class="block-title">角色授权</h3>
	<!-- 显示错误信息列表 -->
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
		<div class="crumb_warp">

        @if(session('msg'))
            <h3>{{session('msg')}}</h3>
        @endif
		</div>
		<div class="">
        <form id="art_form" action="{{url('admin/role/doauth')}}" method="post" >
            <table class="table table-hover table-condensed">
                <tbody>
                {{csrf_field()}}

                <tr>
                    <th style="font-size:20px"><i class="require">*</i> 角色名称：</th>
                    <td style="font-size:20px">
                       <input type="hidden" name="role_id" value="{{$role->id}}">
                        <label for="">{{$role->name}}</label>
                    </td>
                </tr>

                <tr>
                    <th style="font-size:20px"><i class="require">*</i> 所有权限：</th>
                    <td style="font-size:20px">
                        @foreach($permissions as $k=>$v)
                            {{--如果当前遍历的权限的id在已经授权的权限列表中，应该给一个选中状态--}}
                            @if(in_array($v->id,$own))
                                <label for=""><input type="checkbox" class="lg" name="permission_id[]" checked value="{{$v->id}}">{{$v->name}}</label>
                            @else
                                <label for="" class="checkbox-custom checkbox-default lg"><input type="checkbox" name="permission_id[]" class="lg"  value="{{$v->id}}">{{$v->name}}</label>

                            @endif
                        @endforeach
                    </td>
                </tr>
                <tr>
                    <th></th>
                    <td style="font-size:20px">
                        <input type="submit" value="提交" class="btn btn-md btn-primary md">
                        <input type="button" onclick="history.go(-1)" value="返回" class="btn btn-md btn-primary ">
                    </td>
                </tr>
                </tbody>
            </table>


        </form>
    </div>
</div>		
		
		
		
		
		
@endsection