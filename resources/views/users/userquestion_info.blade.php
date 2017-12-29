@extends('usercenter_parent')
@section('title','我的提问')
@section('content')
<div class="jztop" style="	background: url(../images/usercenter/jztop.png) no-repeat;
width: 1034px;
margin: auto;
height: 32px;"></div>
<div class="container">
<div class="bloglist f_l"><br>

    {{--查看回答的问题--}}
    <ul>
        <p style="margin-left:100px;font-size:20px"><b></b></p>
    </ul><br><br><br>

    {{--问题的基本信息--}}
    <p class="dateview">
        <span style="margin-left:50px">
              所属话题：{{ $question->topic->name }}
        </span>
        <span style="margin-left:50px">
              提问者：{{ $question->user->nickname }}
        </span>
        <span style="margin-left:50px">
              回答数：{{ $question->question_answer->count() }}
        </span>
    </p>
    <br><br>
    <p style="margin-left:50px">{{$question->content}}</p>

    {{--朴素的分割线--}}
    <p class="dateview" style="width:600px">
        ========================================================================================
    </p>

    {{--遍历回复的基本信息--}}
    @foreach($user as $v)
    <ul>
        <li>
            回答者:{{ $v->user->nickname }}
        <li>
        <li>
            积分:{{ $v->user->score }}
        <li>
        <li>
            内容:{{ $v->answer_content }}
        <li>
    </ul>
    {{--又是朴素的分割线--}}
    <p class="dateview" style="width:600px">
        ========================================================================================
    </p>
    @endforeach
</div>
@endsection
