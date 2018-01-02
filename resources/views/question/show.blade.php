@extends('parents')
@section('title')
    @if(!empty(Config::get('webconfig.title')))
    <title>{{ Config::get('webconfig.title') }}--问题列表</title>
	@else
	<title>问答系统</title>
	@endif
@endsection
@section('content')


<!-- Start of Page Container -->
<div class="page-container">
    <br>
    <br>


    <div class="container">
        
        <div class="row">

            <!-- start of page content -->
            <div class="col-md-8 main-listing">
                @foreach($questions as $k=>$v)
                <article class="format-standard type-post hentry clearfix">

                    <header class="clearfix">

                        <h3 class="post-title">
                            <a href="{{ url('answer/'.$v->id) }}">{{ $v->title }}</a>
                        </h3>

                        <div class="post-meta clearfix">
                            <span class="date">{{ $v->created_at }}</span>
                            <span class="category"><a href="{{ url('question').'/'. $v->topic->id }}" title="View all posts in Server &amp; Database">所属话题:{{ $v->topic->name }}</a></span>
                            <span class="comments"><a href="#" title="Comment on Integrating WordPress with Your Website">评论数:{!! $v->question_answer->count() !!}</a></span>
                            <span class="like-count">{{ $v->support }}</span>
                        </div><!-- end of post meta -->

                    </header>
                    {!! $v->content !!}
                </article>
                @endforeach
                <div id="paging">
                    {!! $questions->render() !!}
                </div>

            </div>
            <!-- end of page content -->


            <!-- start of sidebar -->
            <aside class="col-md-4 page-sidebar">

                <section class="widget">
                    <h3 class="title">热门问题</h3>
                    <ul id="recentcomments">
                        @foreach($support as $q)
                        <li class="recentcomments"><a href="#">{{ strip_tags($q->title) }}</a></li>
                        @endforeach
                    </ul>
                </section>


						<section class="widget">
							<h3 class="title">问题排行</h3>
							</h3>
							<ul class="articles">
								@foreach($hot as $v)
								<li class="article-entry standard">
									<h4>
										<a href="{{ url('/answer').'/'.$v->id }}">{{ $v->title }}</a>
									</h4>
									<span class="article-meta">{{ $v->created_at }} in
										<a href="#" title="View all posts in Server &amp; Database">{{ $v->topic->name }}</a>
									</span>
									<span class="like-count">{{ $v->support }}</span>
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

@endsection