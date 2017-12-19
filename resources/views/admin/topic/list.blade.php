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
                    <h3>话题列表</h3>
                </header>&nbsp;
                <!--结果页快捷搜索框 开始-->
                <div class="search_wrap">
                    <form action="{{url('admin/topic')}}" method="get">
                        <table class="search_tab">
                            <tr>
                                <th style="width:100px;"></th>
                                <th>
                                    <b>每页条数：</b>
                                    <select name="num" style="height:30px">
                                        {{--  <option value="2"
                                                @if($request['num'] == 2)  selected  @endif
                                        >2
                                        </option>  --}}
                                        <option value="5"
                                                @if($request['num'] == 5)  selected  @endif
                                        >5
                                        </option>
                                        <option value="10"
                                                @if($request['num'] == 10)  selected  @endif
                                        >10
                                        </option>
                                    </select>
                                </th>
                                <th width="50"></th>
                                <td><input type="text" name="keywords1" value="{{$request->keywords1}}" placeholder="话题名" style="height:30px"></td>
                                <td><input type="submit"  value="查询" style="height:30px"></td>
                            </tr>
                        </table>
                    </form>
                </div>&nbsp;
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" >
                        <thead>
                        <tr class="danger text-center ">
                            <td><h4>话题ID</h4></td>
                            <td><h4>话题名</h4></td>
                            <td><h4>操作</h4></td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($topic as $v)
                            <tr class="success text-center">
                                <td>{{ $v->id }}</td>
                                <td>{{ $v->name }}</td>
                                <td><a class="btn btn-success" href="{{ url('admin/topic/'.$v->id.'/edit') }}">修改</a>&nbsp;<a class="btn btn-danger" href="javascript:doDel({{ $v->id }})">删除</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <div class="page_list pull-right" style="margin-right: 200px">
                    {!! $topic->appends($request->all())->render() !!}
                     </div>

                    <form name = 'myform' method='post' style='display:none'>
                        {{ csrf_field() }}
                        {{ method_field('delete') }}
                    </form>
                </div>

            </section>
        </div>
    </div>
    <script>
        function doDel(id){
            if(confirm('您确定删除吗？')){
                var form = document.myform;
                form.action = '/admin/topic/'+id;
                form.submit();
            }
        }
    </script>
@endsection