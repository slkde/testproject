@extends('users.person.usercenter_parent')
@section('title','他的提问')
@section('content')

<div class="jztop" style="	background: url(../../images/usercenter/jztop.png) no-repeat;
  width: 1034px;
  margin: auto;
  height: 32px;"></div>
  <div class="container">
    <div class="bloglist f_l">

    {{--遍历显示我的提问--}}
    @foreach($question as $v)

    {{--问题的所属话题--}}
    <h3><b>探讨---->{{ $v->topic->name }}---->{{ $v->title }}</b></h3>

    {{--问题的配图部分--}}
    {{--  <figure><img src="{{ asset($v->photo)}}"></figure>  --}}

    {{--问题的内容--}}
    <ul>
      <p>{{ strip_tags($v->content) }}</p>
      <a title="{{ $v->title }}" href="{{ url('/person/questioninfo').'/'.$v->id }}" target="_blank" class="readmore">阅读全文&gt;&gt;</a>
    </ul>

    {{--底栏信息--}}
    <p class="dateview">
      <span>{{ $v->created_at }}</span>
      <span>作者：{{ $v->user->nickname }}</span>
      <span>回复数：{{ $v->question_answer->count() }}</span>
    </p>
    @endforeach

        {!! $question->render() !!}

  </div>
@endsection