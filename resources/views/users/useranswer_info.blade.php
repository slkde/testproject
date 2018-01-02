@extends('usercenter_parent')
@section('title','我的回答')
@section('content')
<div class="jztop" style="	background: url(../../images/usercenter/jztop.png) no-repeat;
width: 1034px;
margin: auto;
height: 32px;"></div>
<div class="container">
<div class="bloglist f_l"><br>


    <ul>
        <p style="margin-left:100px;font-size:20px"><b></b></p>
    </ul><br><br><br>

    @foreach($info as $v)
    <p class="dateview">
        <span >
              问题：{!! $v->answer_question->content !!}
        </span>
    </p>
    <div class="clearfix"></div>
    <p class="dateview">
        <span >
              我的回答：{!! $v->answer_content !!}
        </span>
    </p>
    <div class="clearfix"></div>
    <p class="dateview">
        <span>
              回答时间：{{ $v->created_at }}
        </span>
    </p>

    {{--朴素的分割线--}}
    <p class="dateview" style="width:600px">
        ========================================================================================
    </p>
    @endforeach

    {!! $info->render() !!}
</div>
@endsection
