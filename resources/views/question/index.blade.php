@extends('parents')
@section('content')
@include('editor::decode')

<!-- Start of Page Container -->
<div class="page-container">
    <div class="container">
        
        <div class="row">

            <!-- start of page content -->
            <div class="col-md-8 main-listing">
                @foreach($questions as $k=>$v)
                <article class="format-standard type-post hentry clearfix">

                    <header class="clearfix">

                        <h3 class="post-title">第{{ $v->id }}问
                            <a href="{{ url('answer/'.$v->id) }}">{{ $v->title }}</a>
                        </h3>

                        <div class="post-meta clearfix">
                            <span class="date">{{ $v->created_at }}</span>
                            <span class="category"><a href="#" title="View all posts in Server &amp; Database">所属话题:{{ $v->topic->name }}</a></span>
                            <span class="comments"><a href="#" title="Comment on Integrating WordPress with Your Website">评论数:{!! $v->question_answer->count() !!}</a></span>
                            <span class="like-count">{{ $v->support }}</span>
                        </div><!-- end of post meta -->

                    </header>
                    {!! EndaEditor::MarkDecode($v->content) !!}
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
                    <div class="support-widget">
                        <h3 class="title">客服</h3>
                        <p class="intro">需要更多的支持?如果你没有找到一个答案,联系我们进一步的帮助。</p>
                    </div>
                </section>


                <section class="widget">
                    <h3 class="title">文章</h3>
                    <ul class="articles">
                        <li class="article-entry standard">
                            <h4><a href="single.html">Integrating WordPress with Your Website</a></h4>
                            <span class="article-meta">25 Feb, 2013 in <a href="#" title="View all posts in Server &amp; Database">Server &amp; Database</a></span>
                            <span class="like-count">66</span>
                        </li>

                    </ul>
                </section>



                <section class="widget"><h3 class="title">话题</h3>
                    <ul>
                        <li><a href="#" title="Lorem ipsum dolor sit amet,">Advanced Techniques</a> </li>

                    </ul>
                </section>

                <section class="widget">
                    <h3 class="title">最新评论</h3>
                    <ul id="recentcomments">
                        <li class="recentcomments"><a href="#" rel="external nofollow" class="url">John Doe</a> on <a href="#">Integrating WordPress with Your Website</a></li>

                    </ul>
                </section>

            </aside>
            <!-- end of sidebar -->
        </div>
    </div>
</div>
<!-- End of Page Container -->
@endsection