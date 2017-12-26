@extends('admin.parent')
@section('content')
    <div class="block-area col-md-10 col-sm-offset-4" id="text-input" >
        <h3 class="block-title">添加话题</h3>
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
        <form action="{{ url('/admin/topic') }}" method="post" class=" navbar-left">
            {{ csrf_field() }}
            话题名：<input class="form-control input-lg m-b-10" type="text" placeholder="请输入话题名" name="name" value="{{ old('name')}}">&nbsp;
            <button class="btn btn-lg btn-primary btn-block">添加</button>
        </form>
    </div>
@endsection