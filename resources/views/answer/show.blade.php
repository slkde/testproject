@extends('parents')
@section('content')
@include('editor::decode')

    <!-- Start of Page Container -->
<hr>
<div class="page-container">
    <div class="container">
        
        <div class="row">

            <!-- start of page content -->
            <div class="col-md-8 page-content">
                {{--{!! dd($question) !!} }--}}

                <div class="row">
                <button type="button" class="btn btn-primary">{{ $info->topic->name }}</button>
                </div>

                <article class=" type-post format-standard hentry clearfix">

                    <h1 class="post-title">
                        <img src="{{ asset($info->user->photo) }}" class="img-circle user_photo" width="70" height="70"></li>
                        <a href="#">{!! $info->title !!}</a>
                    </h1>

                    <div class="post-meta clearfix">
                        <span class="date">{{ $info->created_at }}</span>
                        <span class="category"><a href="#" title="View all posts in Server &amp; Database">悬赏：{{ $info->bonus }}</a></span>
                        <span class="comments"><a href="#" title="Comment on Integrating WordPress with Your Website">评论数:{{ $info->question_answer->count('id') }}</a></span>
                        @if(Auth::check() && Auth::user()->id == $info->user_id)
                        <span class="comments"><a href="{{ $info->id }}/edit" title="编辑问题">编辑问题</a></span>
                        @endif
                        <span class="comments"><a href="javascript:;" data-toggle="modal" data-target="#sendmessage" class="sendmsg" title="发送站内信">发送站内信</a></span>
                        <span class="like-count like-this">{{ $info->support }}点赞</span>
                    </div><!-- end of post meta -->
                   
                        {!! EndaEditor::MarkDecode($info->content) !!}

                <div class="like-btn">

                    <form id="like-it-form" action="#" method="post">
                        <button type="button" class="btn btn-info likeclick">点赞</button>
                        {{--  <span class="like-it">点赞</span>  --}}
                        {{--  <input type="hidden" name="post_id" value="99">
                        <input type="hidden" name="action" value="like_it">  --}}
                    </form>

                    {{--  <span class="tags">
                    <strong>Tags:&nbsp;&nbsp;</strong>
                        <a href="#" rel="tag">basic</a>, <a href="#" rel="tag">setting</a>, <a href="http://knowledgebase.inspirythemes.com/tag/website/" rel="tag">website</a>
                    </span>  --}}

                </div>

                <section id="comments">

                    <h3 id="comments-title">评论区：</h3>

                    <ol class="commentlist">

                        @foreach($info->question_answer as $v)
                        <li class="comment even thread-even depth-1" id="li-comment-2">
                            <article id="comment-2">

                                <a href="#">
                                    <img alt="" src="{{ asset($v->user->photo) }}" class="avatar avatar-60 photo" height="60" width="60">
                                </a>

                                <div class="comment-meta">

                                    <h5 class="author">
                                        <cite class="fn">
                                            <a href="#" rel="external nofollow" class="url">{{ $v->user->nickname }}</a>
                                        </cite>
                                        - <a class="comment-reply-link" href="#">Reply</a>
                                    </h5>

                                    <p class="date">
                                        {{--  <a href="#">  --}}
                                            <time datetime="{{ $v->created_at }}">回复时间:{{ $v->created_at }}</time>
                                        {{--  </a>  --}}
                                    </p>

                                </div><!-- end .comment-meta -->
                                <div class="comment-body">
                                    {!! EndaEditor::MarkDecode($v->answer_content) !!}
                                </div><!-- end of comment-body -->

                            </article><!-- end of comment -->
                        </li>
                        @endforeach
                    </ol>
                {{--回复提交--}}
                    {{--  <div id="respond">
                        <h3>回复问题</h3>  --}}
                        {{--  <form action="" method="post" id="formid">
                            {{ csrf_field() }}
                            <textarea id = "content" class="form-control" rows="10"></textarea>
                            <input type="button" onclick="sub()" class="btn btn-default" value="回答问题">
                        </form>  --}}
                    @if(Auth::check())
                    <div class="row">
                    {{--  <div class="col-md-9" role="main">  --}}
                    
                    {!! Form::open([ 'url' => '/answer', 'id'=>'answer']) !!}
                        
                        {!! Form::hidden('question_id',  $info->id) !!}
                        
                        <div class="form-group">
                            <div class="editor">
                            {!! Form::textarea('answer_content', null, ['class'=>'form-control','id'=>'myEditor']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                        
                        {!! Form::submit('发表评论', ['class' => 'btn btn-primary pull-right']) !!}
                        
                        </div>
                                
                            {!! Form::close() !!}
                                </div>
                                @endif
                </section><!-- end of comments -->

            </div>
            <!-- end of page content -->


            <!-- start of sidebar -->
            <aside class="col-md-4 page-sidebar">

                {{--  <section class="widget">
                    <div class="support-widget">
                        <h3 class="title">客服</h3>
                        <p class="intro">需要更多的支持?如果你没有找到一个答案,联系我们进一步的帮助。</p>
                    </div>
                </section>  --}}


                <section class="widget">
                    <h3 class="title">问题排行</h3></h3>
                    <ul class="articles">
                        <li class="article-entry standard">
                            <h4><a href="single.html">Integrating WordPress with Your Website</a></h4>
                            <span class="article-meta">25 Feb, 2013 in <a href="#" title="View all posts in Server &amp; Database">Server &amp; Database</a></span>
                            <span class="like-count">66</span>
                        </li>

                    </ul>
                </section>



                <section class="widget"><h3 class="title">相似话题</h3>
                    <ul>
                        <li><a href="{{ url('question/'.$info->topic->id) }}" title="Lorem ipsum dolor sit amet,">{{ $info->topic->name }}</a> </li>

                    </ul>
                </section>

                <section class="widget">
                    <h3 class="title">最新评论</h3>
                    <ul id="recentcomments">
                        @foreach($data as $a)
                        <li class="recentcomments" >
                            <div style="overflow:hidden;text-overflow:ellipsis;white-space: nowrap;">
                                <a href="#">{{ $a->answer_content }}</a>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </section>

            </aside>
            <!-- end of sidebar -->
        </div>
    </div>
</div>
<!-- End of Page Container -->





<div class="modal fade" id="sendmessage" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="gridSystemModalLabel">发送站内信
          <span id="returnmsg"></span>
        </h4>
      </div>
      <div class="modal-body">
          
          {!! Form::open(['url' => '/user/message','id'=>'send']) !!}
          
        <div class="row">
          <div class="col-md-2 col-md-offset-2">收件人：</div>
          <div class="col-md-8" id="returnmsgname"></div>
        </div>
        <div class="row">
          <div class="col-md-10 col-md-offset-2">
            {!! Form::text('user_name',null,['id'=>'username']) !!}
          </div>
        </div>
        <div class="row">
          <div class="col-md-2 col-md-offset-2">主题：</div>
          <div class="col-md-8" id="returnmsgtitle"></div>
        </div>
        <div>
          <div class="col-md-10  col-md-offset-2">
            {!! Form::text('message_title') !!}
          </div>
        </div>

        <div class="row">
          <div class="col-md-2 col-md-offset-2">内容：</div>
          <div class="col-md-8" id="returnmsgbody"></div>
        </div>

        <div  class="row">
          <div class="col-md-10 col-md-offset-2">
            {!! Form::textarea('message_body') !!}
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" onclick="clearmsg()">关闭</button>
        <button type="button" class="btn btn-primary" id="sendout">发送</button>
      </div>
      
      {!! Form::close() !!}
      
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->








<script>
    $('.sendmsg').click(function(){
        $('#username').val('{!! $info->user->nickname !!}');
    })
    @include('users.sendmsg')

    $('.likeclick').click( function(){

        $.ajax({
        url:'/question/like/'+{{ $info->id }},
        async:true,
        type:'get',
        datatype:'json',
        success:function(data){
        $('.like-this').html(parseInt($('.like-this').html())+1+'点赞');
        }
        });
        
    });


</script>
@endsection
