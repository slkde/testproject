<!doctype html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en-US"> <![endif]-->
<!--[if IE 7]>    <html class="lt-ie9 lt-ie8" lang="en-US"> <![endif]-->
<!--[if IE 8]>    <html class="lt-ie9" lang="en-US"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en-US"> <!--<![endif]-->
<head>
    <!-- META TAGS -->
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>问问答</title>

    <link rel="shortcut icon" href="images/favicon.png" />

    <!-- Style Sheet-->
    <link rel="stylesheet" href="{{asset("css/bootstrap.min.css")}}"/>
    <link rel="stylesheet" href="{{asset("css/style.css")}}"/>
    {{--<link rel='stylesheet' id='bootstrap-css-css'  href='{{asset("css/bootstrap5152.css?ver=1.0")}}' type='text/css' media='all' />--}}
    {{--<link rel='stylesheet' id='responsive-css-css'  href='{{asset("css/responsive5152.css?ver=1.0")}}' type='text/css' media='all' />--}}
    <link rel='stylesheet' id='pretty-photo-css-css'  href='{{asset("js/prettyphoto/prettyPhotoaeb9.css?ver=3.1.4")}}' type='text/css' media='all' />
    <link rel='stylesheet' id='main-css-css'  href='{{asset("css/main5152.css?ver=1.0")}}' type='text/css' media='all' />
    <link rel='stylesheet' id='custom-css-css'  href='{{asset("css/custom5152.html?ver=1.0")}}' type='text/css' media='all' />

    <script type='text/javascript' src="{{ asset('js/jquery.min.js') }}"></script>

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="js/html5.js"></script>
    <![endif]-->

</head>

<body>
<!-- Start of Header -->
{{--  <div class="header-wrapper">  --}}
    <header>
        <div class="container">

{{--  
            <div class="logo-container">
                <!-- Website Logo -->
                <a href="{{ url('/') }}"  title="首页">
                    <img src="images/logo.png" alt="兄弟连PHP194问答系统">
                </a>
                <span class="tag-line">兄弟连PHP194问答系统</span>
            </div>  --}}


            <!-- Start of Main Navigation -->
            {{--  <nav class="main-nav">
                <div class="menu-top-menu-container">
                    <ul id="menu-top-menu" class="clearfix">
                        <li class="current-menu-item"><a href="{{ url('/') }}">主页</a></li>
                        <li><a href="{{ url('list') }}">问题列表</a></li>
                        <li><a href="{{ url('detail') }}">问题详情页</a></li>
                        <li><a href="#">Skins</a>
                            <ul class="sub-menu">
                                <li><a href="blue-skin.html">Blue Skin</a></li>
                                <li><a href="green-skin.html">Green Skin</a></li>
                                <li><a href="red-skin.html">Red Skin</a></li>
                                <li><a href="index-2.html">Default Skin</a></li>
                            </ul>
                        </li>
                        <li><a href="#">More</a>
                            <ul class="sub-menu">
                                <li><a href="full-width.html">Full Width</a></li>
                                <li><a href="elements.html">Elements</a></li>
                                <li><a href="page.html">Sample Page</a></li>
                            </ul>
                        </li>
                        <li><a href="contact.html">Contact</a></li>
                    </ul>
                </div>
            </nav>  --}}
            <!-- End of Main Navigation -->

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" {{--href="{{ url('/') }}"--}}>问问答</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li><a href="{{ url('/') }}">Home</a></li>
            <li><a href="{{ url('question') }}">问题列表</a></li>
            <li><a href="{{ url('question/create') }}">发表问题</a></li>
          </ul>
          
          <ul class="nav navbar-nav navbar-right">
              {{--  <li class="active"><a href="./">Default <span class="sr-only">(current)</span></a></li>  --}}
              @if(Auth::check())
              <li><img src="{{ asset(Auth::user()->photo) }}" class="img-circle user_photo" width="50" height="50"></li>
            <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                @if(empty(Auth::user()->nickname))
                {{Auth::user()->email}}
                @else
                {{Auth::user()->nickname}}
                @endif
                <span class="caret"></span></a>
            <ul class="dropdown-menu">
                <li><a href="{{ url('user/person') }}">个人首页</a></li>
                <li><a href="{{ url('user/photo') }}">头像设置</a></li>
                <li><a href="{{ url('user/set') }}">个人设置</a></li>
                <li><a href="{{ url('user/message') }}">站内信</a></li>
                {{--  <li role="separator" class="divider"></li>
                <li class="dropdown-header">Nav header</li>
                <li><a href="#">Separated link</a></li>
                <li><a href="#">One more separated link</a></li>  --}}
            </ul>
            </li>
              <li><a href="{{ url('/logout') }}">退出登录</a></li>
              @else
              <li><a href="{{ url('/user/register') }}">注 册</a></li>
              <li><a href="{{ url('/user/login') }}">登 陆</a></li>
              @endif
            </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

        </div>
    </header>
{{--  </div>  --}}
<!-- End of Header -->

<!-- Start of Search Wrapper -->
{{--<div class="search-area-wrapper search_top">--}}
    {{--<div class="search-area container input-group-lg">--}}
        {{--<h3 class="search-header">Have a Question?</h3>--}}
        {{--<p class="search-tag-line">If you have any question you can ask below or enter what you are looking for!</p>--}}

        {{--<form id="search-form" class="search-form clearfix" method="get" action="#" autocomplete="off">--}}
            {{--<div class="col-md-8 col-md-offset-2 ">--}}
                {{--<div class="input-group">--}}
                    {{--<input type="text" class="form-control input-lg" placeholder="Search for...">--}}
                    {{--<span class="input-group-btn ">--}}
        {{--<button class="btn btn-default input-lg" type="button">搜 索</button>--}}
      {{--</span>--}}
                {{--</div><!-- /input-group -->--}}
            {{--</div>--}}
        {{--</form>--}}
    {{--</div>--}}
{{--</div>--}}
<!-- End of Search Wrapper -->
@yield('content')

<!-- Start of Footer -->
<footer id="footer-wrapper">
    <div id="footer" class="container">
        <div class="row">

            <div class="col-md-3">
                <section class="widget">
                    <h3 class="title">网站介绍</h3>
                    <div class="textwidget">
                        <p>本互动问答平台是集成了自动切分词、智能搜索、自动分类等一整套的自然语言处理和信息检索技术，为用户提供的一个交流平台，大家可以在这里接受专家和其他网民的帮助，同时也尽力给别的网民提供有效的帮助。</p>

                    </div>
                </section>
            </div>

            <div class="col-md-3">
                <section class="widget">
                    <h3 class="title">平台分类</h3>
                    <ul>
                        <li><a href="#" title="Lorem ipsum dolor sitamet,">分享平台</a> </li>
                        <li><a href="#" title="Lorem ipsum dolor sit amet,">知识问答</a></li>
                        <li><a href="#" title="Lorem ipsum dolor sit amet,">排疑解难</a></li>
                    </ul>
                </section>
            </div>

            <div class="col-md-3">
                <section class="widget">
                    <h3 class="title">友情链接</h3>

                        <ul>
                            <li><a href="">好知网</a></li>
                            <li><a href="">知识网</a></li>
                            <li><a href="">中国知网</a></li>

                        </ul>
                </section>
            </div>

            <div class="col-md-3">
                <section class="widget">
                    <h3 class="title">网站图片</h3>
                    {{--<div class="flickr-photos" id="basicuse">--}}
                    {{--</div>--}}
                    <img src="http://farm4.staticflickr.com/3940/15647274066_2ee48c3fe9_s.jpg" alt="Halloween 2014 at Envato in Melbourne">
                    <img src="http://farm4.staticflickr.com/3945/15485436268_846ccca178_s.jpg" alt="Halloween 2014 at Envato in Melbourne">
                    <img src="http://farm6.staticflickr.com/5599/15668909741_eaf3db4054_s.jpg" alt="Halloween 2014 at Envato in Melbourne">

                </section>
            </div>

        </div>
        {{--<div class="col-md-12">--}}
            {{--<!-- Social Navigation -->--}}
            {{--<ul class="social-nav clearfix">--}}

                {{--<li class="linkedin"><a target="_blank" href="#"></a></li>--}}
                {{--<li class="stumble"><a target="_blank" href="#"></a></li>--}}
                {{--<li class="google"><a target="_blank" href="#"></a></li>--}}
                {{--<li class="deviantart"><a target="_blank" href="#"></a></li>--}}
                {{--<li class="flickr"><a target="_blank" href="#"></a></li>--}}
                {{--<li class="skype"><a target="_blank" href="skype:#?call"></a></li>--}}
                {{--<li class="rss"><a target="_blank" href="#"></a></li>--}}
                {{--<li class="twitter"><a target="_blank" href="#"></a></li>--}}
                {{--<li class="facebook"><a target="_blank" href="#"></a></li>--}}
            {{--</ul>--}}
        </div>
    </div>
    <!-- end of #footer -->

    <!-- Footer Bottom -->
    <div id="footer-bottom-wrapper">
        <div id="footer-bottom" class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <p class="copyright">
                        Copyright © 2017. All Rights Reserved by KnowledgeBase.Collect from <a href="http://www.cssmoban.com/" title="网页模板" target="_blank">网页模板</a>
                    </p>
                </div>
                <style>
                    .copyright{
                        color:#0d90d1;
                    }
                </style>
            </div>
        </div>
    </div>
    <!-- End of Footer Bottom -->

</footer>
<!-- End of Footer -->

<a href="#top" id="scroll-top"></a>

<!-- script -->
{{--  <script type='text/javascript' src="{{ asset('js/jquery-1.8.3.min.js') }}"></script>  --}}
{{--  <script type='text/javascript' src="{{ asset('js/jquery.min.js') }}"></script>  --}}
<script type='text/javascript' src="{{ asset('js/bootstrap.min.js') }}"></script>
<script type='text/javascript' src="{{ asset('js/jquery.easing.1.34e44.js?ver=1.3') }}"></script>
<script type='text/javascript' src="{{ asset('js/prettyphoto/jquery.prettyPhotoaeb9.js?ver=3.1.4') }}"></script>
<script type='text/javascript' src="{{ asset('js/jquery.liveSearchd5f7.js?ver=2.0') }}"></script>
<script type='text/javascript' src="{{ asset('js/jflickrfeed.js') }}"></script>
<script type='text/javascript' src="{{ asset('js/jquery.formd471.js?ver=3.18') }}"></script>
<script type='text/javascript' src="{{ asset('js/jquery.validate.minfc6b.js?ver=1.10.0') }}"></script>
<script type='text/javascript' src="{{ asset('js/custom5152.js?ver=1.0') }}"></script>

</body>
</html>
<script type='text/javascript'>
    (function(m, ei, q, i, a, j, s) {
        m[i] = m[i] || function() {
            (m[i].a = m[i].a || []).push(arguments)
        };
        j = ei.createElement(q),
            s = ei.getElementsByTagName(q)[0];
        j.async = true;
        j.charset = 'UTF-8';
        j.src = 'https://static.meiqia.com/dist/meiqia.js?_=t';
        s.parentNode.insertBefore(j, s);
    })(window, document, 'script', '_MEIQIA');
    _MEIQIA('entId', 92850);
</script>