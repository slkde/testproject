@extends('admin.parent')
@section('content')
    <!-- Text Input -->
    <div class="block-area col-md-10 col-sm-offset-4" id="text-input" >
        <h3 class="block-title">编辑话题</h3>

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


        <form action="{{ url('/admin/topic/'.$topic->id) }}" method="post" class=" navbar-left">
            {{ method_field('put') }}
            {{ csrf_field() }}
            话题名：<input class="form-control input-lg m-b-10" type="text" name="name" value="{{ $topic->name }}">&nbsp;
            <button class="btn btn-lg btn-primary btn-block">修改</button>
        </form>
    </div>

@endsection