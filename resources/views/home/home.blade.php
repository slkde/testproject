@extends('parents')
@section('title')
	<title>{{ Config::get('webconfig.title') }}</title>
@endsection
@section('content')

    {{--轮播图开始--}}
    <div class="search-area " id="search_top" style="margin-top: 50px">
        <div class="search-area container input-group-lg">
            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                <!-- 轮播（Carousel）指标 -->
                <ol class="carousel-indicators">
                    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                </ol>
                <!-- 轮播（Carousel）项目 -->
                <div class="carousel-inner">
                    <div class="carousel-caption">
                        <form id="search-form" class="search-form clearfix" method="get" action="{{ url('/') }}" autocomplete="off">
                            <div class="col-md-8 col-md-offset-2 ">
                                <div class="input-group">
                                    <input type="text" class="form-control input-lg" name="keyword" placeholder="搜索你感兴趣的内容">
                                    <span class="input-group-btn ">
                <button class="btn btn-default input-lg" type="submit">搜索问题</button>
              </span>
                                </div><!-- /input-group -->
                            </div>
                        </form></div>
                    <div class="item active">
                        <img style="width:1140px;height:286px;" src="{{asset('images/seven.jpg')}}" alt="First slide">

                    </div>
                    <div class="item">
                        <img style="width:1140px;height:286px;" src="{{asset('images/four.jpg')}}" alt="Second slide">

                    </div>
                    <div class="item">
                        <img style="width:1140px;height:286px;" src="{{asset('images/three.jpg')}}" alt="Third slide">

                    </div>
                </div>
                <!-- 轮播（Carousel）导航 -->
                <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right" {{--aria-hidden="true"--}}></span>
                    {{--<span class="sr-only">Next</span>--}}
                </a>
            </div>
        </div>
    </div>
    {{--轮播图结束--}}
<!-- Start of Page Container -->
<div class="page-container">
    <div class="container">
        <div class="row">

            <!-- start of page content -->
            <div class="col-md-8 page-content">

                <!-- Basic Home Page Template -->
                <div class="row separator">
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
                            {!! EndaEditor::MarkDecode($v->content) !!}
                        </article>
                    @endforeach

                </div>
            </div>
            <!-- end of page content -->


            <!-- start of sidebar -->
            <aside class="col-md-4 page-sidebar">

                {{--<section class="widget">--}}
                    {{--<div class="support-widget">--}}
                        {{--<h3 class="title">Support</h3>--}}
                        {{--<p class="intro">Need more support? If you did not found an answer, contact us for further help.</p>--}}
                    {{--</div>--}}
                {{--</section>--}}


                <section class="widget">
                    <div class="quick-links-widget">
                        <h3 class="title">快速链接</h3>
                        <ul id="menu-quick-links" class="menu clearfix">
                            <li><a href="https://www.zhihu.com/">知乎</a></li>
                            <li><a href="http://wenda.tianya.cn/">天涯 </a></li>
                            <li><a href="http://wenda.so.com/">360问答</a></li>
                            <li><a href="https://zhidao.baidu.com/">百度知道</a></li>
                        </ul>
                    </div>
                </section>
                <br>
                <section class="widget">
                    <div class="quick-links-widget">
                        <h3 class="title">话题广场</h3>
                        <div class="tagcloud">
                            @foreach($topics as $v)
                            <a href="{{ url('question/'.$v->id) }}" class="btn btn-mini">{{ $v->name }}</a>
                            @endforeach
                        </div>
                    </div>
                </section>
                <br>
                <iframe name="weather_inc" src="http://i.tianqi.com/index.php?c=code&id=55" style="border:solid 1px #7ec8ea" width="350" height="294" frameborder="0" marginwidth="0" marginheight="0" scrolling="no"></iframe>

            </aside>
            <!-- end of sidebar -->
        </div>
    </div>
</div>
<!-- End of Page Container -->
@endsection
