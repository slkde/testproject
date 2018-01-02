@extends('usercenter_parent')
@section('title','我的提问')
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
          {{ strip_tags($v->content) }}
          <a title="{{ $v->title }}" href="{{ url('/user/question').'/'.$v->id }}" target="_blank" class="readmore">阅读全文&gt;&gt;</a>
        </ul>

    {{--底栏信息--}}
    <p class="dateview">
      <span>{{ $v->created_at }}</span>
      <span>作者：{{ $v->user->nickname }}</span>
      <span>回复数：{{ $v->question_answer->count() }}</span>
      <span>[<a href="javascript:;" onclick="del({{$v->id}})">删除</a>]</span>
    </p>
    @endforeach

        {!! $question->render() !!}

  </div>
<script>
  {{--AJAX实现删除操作--}}
  function del(id)
  {
      //询问框
      layer.confirm('您确定删除吗？', {
          btn: ['确定','取消'] //按钮
      }, function(){
          $.post('{{ url('/user/question') }}/'+id,{'_token':'{{ csrf_token() }}','_method':'delete'},function(data){
              if(data.status == 1)
              {
                  layer.msg(data.msg, {icon: 6});
                  setTimeout(function(){
                      location.href = location.href;
                  },1000)
              }else{
                  setTimeout(function(){
                      location.href = location.href;
                  },1000)
              }
          });
      }, function(){

      });



  }
</script>
@endsection