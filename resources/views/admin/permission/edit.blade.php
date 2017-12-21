@extends('admin.parent')
@section('content')

 <div class="block-area col-md-10 col-sm-offset-3" id="text-input" >
	<h3 class="block-title">修改权限</h3>
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
		<div class="result_wrap">
        <form id="art_form" action="{{url('admin/permission/'.$permission->id)}}" method="post" >
            <table class="result_content" style="line-height:20px">
                <tbody>
                {{csrf_field()}}
					{{ method_field('put')}}
                <tr>
                    <th><i class="require">*</i> 权限名称：</th>
                    <td>
                        <input type="text"  name="name" value="{{$permission->name}}">
                    </td>
                </tr>

                <tr>
                    <th><i class="require">*</i> 权限路径：</th>
                    <td>
                        <input type="text" size="50" class="lg" name="path" value="{{$permission->path}}">
                    </td>
                </tr>

                <tr>
                    <th></th>
                    <td>
                        <input type="submit" class="btn btn-md btn-primary " value="修改">
                        
                    </td>
                </tr>
                </tbody>
            </table>


        </form>
    </div>
</div>		
@endsection