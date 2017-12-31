<!doctype html>
<html>
<head>
    <meta charset="gb2312">
    <title>@yield('title')</title>
    <meta name="keywords" content="个人中心" />
    <meta name="description" content="个人中心" />
    <link href="{{ asset('css/usercenter/base.css')}}" rel="stylesheet">
    <link href="{{ asset('css/usercenter/index.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset("css/bootstrap.min.css")}}"/>
    <script type='text/javascript' src="{{ asset('js/jquery.min.js') }}"></script>
    <!--[if lt IE 9]>
    <script src="{{ asset('js/usercenter/modernizr.js')}}"></script>
    <![endif]-->
    <script type="text/javascript" src="{{ asset('js/usercenter/jquery.js')}}"></script>
    <script type='text/javascript' src="{{ asset('js/jquery-1.8.3.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/res/layer/layer.js')}}"></script>
</head>
<body style=    'font: 12px "宋体", Arial, Helvetica, sans-serif;
color: #666666;
background: url(../../images/usercenter/bg.png) right top no-repeat'>
<div id="wrapper" style="background: url(../../images/usercenter/ftbg.png) bottom center no-repeat;
	overflow: hidden;">
    <header>
        <div class="headtop" style="background: url(../../images/usercenter/topbg.png) repeat-x;
	height: 28px;"></div>
        <div class="contenttop" style="	width: 1000px;
	margin: auto;">
            <div class="logo f_l" style="margin-left:300px">个人中心</div>
            <div class="search f_r">
                {{--<form action="" method="post" name="searchform" id="searchform">--}}
                    {{--<input name="keyboard" id="keyboard" class="input_text" value="请输入关键字" style="color: rgb(153, 153, 153);" onfocus="if(value=='请输入关键字'){this.style.color='#000';value=''}" onblur="if(value==''){this.style.color='#999';value='请输入关键字'}" type="text">--}}
                    {{--<input name="show" value="title" type="hidden">--}}
                    {{--<input name="tempid" value="1" type="hidden">--}}
                    {{--<input name="tbname" value="news" type="hidden">--}}
                    {{--<input name="Submit" class="input_submit" value="搜索" type="submit">--}}
                {{--</form>--}}
            </div>
            <div class="blank"></div>
            <nav>
                <div  class="navigation" style='	height: 64px;
	background: url(../../images/usercenter/navbg.png) no-repeat;
	font-family: "微软雅黑";'>
                    <ul class="menu">
                        <li><a href="{{ url('/') }}">网站首页</a></li>
                            <li><a href="{{ asset('/person/question').'/'.$id  }}">他的提问</a></li>
                            <li><a href="{{ asset('/person/answer').'/'.$id }}">他的回答</a></li>

                    </ul>
                </div>
            </nav>
            <SCRIPT type=text/javascript>
                // Navigation Menu
                $(function() {
                    $(".menu ul").css({display: "none"}); // Opera Fix
                    $(".menu li").hover(function(){
                        $(this).find('ul:first').css({visibility: "visible",display: "none"}).slideDown("normal");
                    },function(){
                        $(this).find('ul:first').css({visibility: "hidden"});
                    });
                });
            </SCRIPT>
        </div>
    </header>

@section('content')
    @show

    <div class="r_box f_r">
        <div class="tit01">
            <h3 class="tit" style="	line-height: 44px;
	color: #fff;
	font-size: 18px;
	height: 44px;
	background: url(../../images/usercenter/rtitbg.png) no-repeat;
	padding-left: 40px;
	margin: 0 0 10px 0">联系客服</h3>
            <div class="gzwm">
                <ul>
                    <li><a class="prize" href="javascript:;" onclick="talk()" style="background: url(../../images/usercenter/gz04.png) no-repeat;">在线聊天</a></li>
                    <li><a class="email" href="javascript:;" target="_blank" style="background: url(../../images/usercenter/gz01.png) no-repeat;">客服电话</a></li>
                    <li><a class="qq" href="javascript:;" target="_blank" style="background: url(../../images/usercenter/gz02.png) no-repeat;">客服邮箱</a></li>
                    <li><a class="tel" href="javascript:;" target="_blank" style="background: url(../../images/usercenter/gz03.png) no-repeat;">客服QQ</a></li>
                </ul>
            </div>
        </div>
        <!--tit01 end-->

        {{--<div class="tuwen">--}}
            {{--<h3 class="tit" style="	line-height: 44px;--}}
	{{--color: #fff;--}}
	{{--font-size: 18px;--}}
	{{--height: 44px;--}}
	{{--background: url(../images/usercenter/rtitbg.png) no-repeat;--}}
	{{--padding-left: 40px;--}}
	{{--margin: 0 0 10px 0">图文推荐</h3>--}}
            {{--<ul>--}}
                {{--<li><a href="/"><img src="{{ asset('images/usercenter/01.jpg')}}"><b>住在手机里的朋友</b></a>--}}
                    {{--<p><span class="tulanmu"><a href="/">手机配件</a></span><span class="tutime">2015-02-15</span></p>--}}
                {{--</li>--}}
                {{--<li><a href="/"><img src="{{ asset('images/usercenter/02.jpg')}}"><b>教你怎样用欠费手机拨打电话</b></a>--}}
                    {{--<p><span class="tulanmu"><a href="/">手机配件</a></span><span class="tutime">2015-02-15</span></p>--}}
                {{--</li>--}}
                {{--<li><a href="/" title="手机的16个惊人小秘密，据说99.999%的人都不知"><img src="{{ asset('images/usercenter/03.jpg')}}"><b>手机的16个惊人小秘密，据说...</b></a>--}}
                    {{--<p><span class="tulanmu"><a href="/">手机配件</a></span><span class="tutime">2015-02-15</span></p>--}}
                {{--</li>--}}
                {{--<li><a href="/"><img src="{{ asset('images/usercenter/06.jpg')}}"><b>住在手机里的朋友</b></a>--}}
                    {{--<p><span class="tulanmu"><a href="/">手机配件</a></span><span class="tutime">2015-02-15</span></p>--}}
                {{--</li>--}}
                {{--<li><a href="/"><img src="{{ asset('images/usercenter/04.jpg')}}"><b>教你怎样用欠费手机拨打电话</b></a>--}}
                    {{--<p><span class="tulanmu"><a href="/">手机配件</a></span><span class="tutime">2015-02-15</span></p>--}}
                {{--</li>--}}
                {{--<li><a href="/"><img src="{{ asset('images/usercenter/02.jpg')}}"><b>教你怎样用欠费手机拨打电话</b></a>--}}
                    {{--<p><span class="tulanmu"><a href="/">手机配件</a></span><span class="tutime">2015-02-15</span></p>--}}
                {{--</li>--}}
                {{--<li><a href="/" title="手机的16个惊人小秘密，据说99.999%的人都不知"><img src="{{ asset('images/usercenter/03.jpg')}}"><b>手机的16个惊人小秘密，据说...</b></a>--}}
                    {{--<p><span class="tulanmu"><a href="/">手机配件</a></span><span class="tutime">2015-02-15</span></p>--}}
                {{--</li>--}}
            {{--</ul>--}}
        {{--</div>--}}
        {{--<div class="ph">--}}
            {{--<h3 class="tit" style="	line-height: 44px;--}}
	{{--color: #fff;--}}
	{{--font-size: 18px;--}}
	{{--height: 44px;--}}
	{{--background: url(../images/usercenter/rtitbg.png) no-repeat;--}}
	{{--padding-left: 40px;--}}
	{{--margin: 0 0 10px 0">点击排行</h3>--}}
            {{--<ul class="rank">--}}
                {{--<li><a href="/jstt/bj/2017-07-13/784.html" title="【心路历程】请不要在设计这条路上徘徊啦" target="_blank">【心路历程】请不要在设计这条路上徘徊啦</a></li>--}}
                {{--<li><a href="/news/s/2016-05-20/751.html" title="IP要突破2000+了" target="_blank">IP要突破2000+了</a></li>--}}
                {{--<li><a href="/jstt/web/2015-07-03/749.html" title="帝国cms首页、自定义页面如何实现分页" target="_blank">帝国cms首页、自定义页面如何实现分页</a></li>--}}
                {{--<li><a href="/jstt/web/2015-02-25/745.html" title="【已评选】给我模板PSD源文件，我给你设计HTML！" target="_blank">【已评选】给我模板PSD源文件，我给你设计HTML！</a></li>--}}
                {{--<li><a href="/jstt/bj/2015-02-14/744.html" title="【郑重申明】本站只提供静态模板下载！" target="_blank">【郑重申明】本站只提供静态模板下载！</a></li>--}}
                {{--<li><a href="/news/s/2015-01-23/741.html" title="【孕期日记】生活本该如此" target="_blank">【孕期日记】生活本该如此</a></li>--}}
                {{--<li><a href="/jstt/bj/2015-01-09/740.html" title="【匆匆那些年】总结个人博客经历的这四年…" target="_blank">【匆匆那些年】总结个人博客经历的这四年…</a></li>--}}
                {{--<li><a href="/jstt/web/2015-01-01/739.html" title=" 2014年度优秀个人博客排名公布" target="_blank"> 2014年度优秀个人博客排名公布</a></li>--}}
                {{--<li><a href="/jstt/web/2014-12-18/736.html" title="2014年度优秀个人博客评选活动" target="_blank">2014年度优秀个人博客评选活动</a></li>--}}
                {{--<li><a href="/jstt/css3/2014-12-09/734.html" title="使用CSS3制作文字、图片倒影" target="_blank">使用CSS3制作文字、图片倒影</a></li>--}}
                {{--<li><a href="/jstt/css3/2014-11-18/733.html" title="【分享】css3侧边栏导航不同方向划出效果" target="_blank">【分享】css3侧边栏导航不同方向划出效果</a></li>--}}
                {{--<li><a href="/jstt/bj/2014-11-06/732.html" title="分享我的个人博客访问量如何做到IP从10到600的(图文)" target="_blank">分享我的个人博客访问量如何做到IP从10到600的(图文)</a></li>--}}
            {{--</ul>--}}
        {{--</div>--}}
        <div class="ad">  <iframe name="weather_inc" src="http://i.tianqi.com/index.php?c=code&id=55" style="border:solid 1px #7ec8ea" width="350" height="294" frameborder="0" marginwidth="0" marginheight="0" scrolling="no"></iframe> </div>
        <script type='text/javascript'>
            function talk()
            {
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
            }

        </script>
    </div>
    </div>
    <footer>
        <div class="footer" style="	background: url(../../images/usercenter/footerbg.png) repeat-x;
	padding: 20px 0;
	color: #ccc;
	margin: 20px 0 0 0;
	width: 1000px;
	margin: auto;
	overflow: hidden"
        >
            <div style="text-align:center">
                <p style="line-height: 24px"> 版权所有：个人中心 备案号：秦ICP备00000000号</p>
            </div>
        </div>
    </footer>
</div>
</body>
</html>
