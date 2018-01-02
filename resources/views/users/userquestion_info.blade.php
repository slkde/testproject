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
    <h1>问题详情：</h1>
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
    <p style="margin-left:50px">{!! $question->content !!}</p>
    <div class="clearfix"></div>
    {{--以下是回复区--}}
    <h1>回复区：</h1>
    {{--遍历回复的基本信息--}}
    @foreach($user as $v)
    <p class="dateview">
        <span style="margin-left:50px">
               回答者:{{ $v->user->nickname }}
        </span>
        <span style="margin-left:50px">
             赞同数:{{ $v->user->score }}
        </span>
        <span style="margin-left:50px">
              回答时间:{{ $v->created_at }}
        </span>
    </p>
    回答内容：<h3>{!! $v->answer_content !!}</h3>
    <div class="clearfix"></div>
    @endforeach
    {!! $user->render() !!}
</div>
@endsection
