<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
    <meta name="author" content="GeeksLabs">
    <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
    <link rel="shortcut icon" href="{{ asset('res/admin/img/favicon.png') }}">

    <title>你问我答后台管理系统</title>

    <!-- Bootstrap CSS -->
    <link href="{{ asset('res/admin/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- bootstrap theme -->
    <link href="{{ asset('res/admin/css/bootstrap-theme.css') }}" rel="stylesheet">
    <!--external css-->
    <!-- font icon -->
    <link href="{{ asset('res/admin/css/elegant-icons-style.css') }}" rel="stylesheet" />
    <link href="{{ asset('res/admin/css/font-awesome.min.css') }}" rel="stylesheet" />
    <!-- full calendar css-->
    <link href="{{ asset('res/admin/assets/fullcalendar/fullcalendar/bootstrap-fullcalendar.css') }}" rel="stylesheet" />
    <link href="{{ asset('res/admin/assets/fullcalendar/fullcalendar/fullcalendar.css') }}" rel="stylesheet" />
    <!-- easy pie chart-->
    <link href="{{ asset('res/admin/assets/jquery-easy-pie-chart/jquery.easy-pie-chart.css') }}" rel="stylesheet" type="text/css" media="screen"/>
    <!-- owl carousel -->
    <link rel="stylesheet" href="{{ asset('res/admin/css/owl.carousel.css') }}" type="text/css">
    <link href="{{ asset('res/admin/css/jquery-jvectormap-1.2.2.css') }}" rel="stylesheet">
    <!-- Custom styles -->
    <link rel="stylesheet" href="{{ asset('res/admin/css/fullcalendar.css') }}">
    <link href="{{ asset('res/admin/css/widgets.css') }}" rel="stylesheet">
    <link href="{{ asset('res/admin/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('res/admin/css/style-responsive.css') }}" rel="stylesheet" />
    <link href="{{ asset('res/admin/css/xcharts.min.css') }}" rel=" stylesheet">
    <link href="{{ asset('res/admin/css/jquery-ui-1.10.4.min.css') }}" rel="stylesheet">
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 -->
    <!--[if lt IE 9]>
    <script src="{{ asset('res/admin/js/html5shiv.js') }}"></script>
    <script src="{{ asset('res/admin/js/respond.min.js') }}"></script>
    <script src="{{ asset('res/admin/js/lte-ie7.js') }}"></script>
    <![endif]-->

</head>

<body>
<!-- container section start -->
<section id="container" class="">


    <header class="header dark-bg">
        <div class="toggle-nav">
            <div class="icon-reorder tooltips" data-original-title="Toggle Navigation" data-placement="bottom"></div>
        </div>

        <!--logo start-->
        <a href="index.html" class="logo">SWYGW <span class="lite">后台</span></a>
        <!--logo end-->

        <div class="nav search-row" id="top_menu">
            <!--  search form start -->
            <ul class="nav top-menu">
                <li>
                    <form class="navbar-form">
                        <input class="form-control" placeholder="搜索" type="text">
                    </form>
                </li>
            </ul>
            <!--  search form end -->
        </div>

        <div class="top-nav notification-row">
            <!-- notificatoin dropdown start-->
            <ul class="nav pull-right top-menu">

                <!-- task notificatoin start -->
                
                <!-- alert notification end-->
                <!-- user login dropdown start-->
                <li class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="profile-ava">
                                <img alt="" src="{{ asset('res/admin/img/a35.jpg') }}" height="30px" width="30px">
                            </span>
                        <span class="username" style="font-size:20px">{{session('user')['username']}}</span>
                        <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu extended logout">
                        <div class="log-arrow-up"></div>
                        <li class="eborder-top">
                            <a href="#"><i class="icon_profile"></i>{{(session('user')['identty'] == 1)?'管理员':'普通用户'}}</a>
                        </li>
                        <li>
                            <a href="#"><i class="icon_mail_alt"></i>{{session('user')['email']}}</a>
                        </li>
                        <li>
                            <a href="#"><i class="icon_clock_alt"></i>{{ date('Y-m-d H:i:s',time())}}</a>
                        </li>            
                        <li>
                            <a href="{{ url('/admin/logout') }}"><i class="icon_key_alt"></i>退出登录</a>
                        </li>
                        
                    </ul>
                </li>				
                <!-- user login dropdown end -->
            </ul>
            <!-- notificatoin dropdown end-->
        </div>
    </header>
    <!--header end-->

    <!--sidebar start-->
    <aside>
        <div id="sidebar"  class="nav-collapse ">
            <!-- sidebar menu start-->
            <ul class="sidebar-menu">
                <li class="active">
                    <a class="" href="{{ url('/admin/index') }}">
                        <i class="icon_house_alt"></i>
                        <span>后台首页</span>
                    </a>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;" class="">
                        <i class="icon_document_alt"></i>
                        <span>用户管理</span>
                        <span class="menu-arrow arrow_carrot-right"></span>
                    </a>
                    <ul class="sub">
                        <li><a class="" href="{{ url('/admin/user') }}">用户列表</a></li>
                        <li><a class="" href="{{ url('/admin/user/create') }}">添加用户</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;" class="">
                        <i class="icon_document_alt"></i>
                        <span>话题管理</span>
                        <span class="menu-arrow arrow_carrot-right"></span>
                    </a>
                    <ul class="sub">
                        <li><a class="" href="{{ url('/admin/topic') }}">话题列表</a></li>
                        <li><a class="" href="{{ url('/admin/topic/create') }}">添加话题</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;" class="">
                        <i class="icon_document_alt"></i>
                        <span>提问管理</span>
                        <span class="menu-arrow arrow_carrot-right"></span>
                    </a>
                    <ul class="sub">
                        <li><a class="" href="{{ url('/admin/question') }}">提问列表</a></li>
                        <li><a class="" href="{{ url('/admin/question/create') }}">添加提问</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;" class="">
                        <i class="icon_document_alt"></i>
                        <span>回复管理</span>
                        <span class="menu-arrow arrow_carrot-right"></span>
                    </a>
                    <ul class="sub">
                        <li><a class="" href="{{ url('/admin/answer') }}">回复列表</a></li>
                       
                    </ul>
                </li>
				<li class="sub-menu">
                    <a href="javascript:;" class="">
                        <i class="icon_document_alt"></i>
                        <span>角色管理</span>
                        <span class="menu-arrow arrow_carrot-right"></span>
                    </a>
                    <ul class="sub">
                        <li><a class="" href="{{ url('/admin/role') }}">角色列表</a></li>
                        <li><a class="" href="{{ url('/admin/role/create') }}">添加角色</a></li>
                    </ul>
                </li>
				<li class="sub-menu">
                    <a href="javascript:;" class="">
                        <i class="icon_document_alt"></i>
                        <span>权限管理</span>
                        <span class="menu-arrow arrow_carrot-right"></span>
                    </a>
                    <ul class="sub">
                        <li><a class="" href="{{ url('/admin/permission') }}">权限列表</a></li>
                        <li><a class="" href="{{ url('/admin/permission/create') }}">添加权限</a></li>
                    </ul>
                </li>
				


                <li class="sub-menu">
                    <a href="javascript:;" class="">
                        <i class="icon_documents_alt"></i>
                        <span>备用页</span>
                        <span class="menu-arrow arrow_carrot-right"></span>
                    </a>
                    <ul class="sub">
                        <li><a class="" href="profile.html">Profile</a></li>
                        <li><a class="" href="login.html"><span>Login Page</span></a></li>
                        <li><a class="" href="blank.html">Blank Page</a></li>
                        <li><a class="" href="404.html">404 Error</a></li>
                    </ul>
                </li>

            </ul>
            <!-- sidebar menu end-->
        </div>
    </aside>
    <!--sidebar end-->

   
    <!-- container section start -->

    <!-- javascripts -->
    <script src="{{ asset('res/admin/js/jquery.js') }}"></script>
    <script src="{{ asset('res/admin/js/jquery-ui-1.10.4.min.js') }}"></script>
    <script src="{{ asset('res/admin/js/jquery-1.8.3.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('res/admin/js/jquery-ui-1.9.2.custom.min.js') }}"></script>
    <!-- bootstrap -->
    <script src="{{ asset('res/admin/js/bootstrap.min.js') }}"></script>
    <!-- nice scroll -->
    <script src="{{ asset('res/admin/js/jquery.scrollTo.min.js') }}"></script>
    <script src="{{ asset('res/admin/js/jquery.nicescroll.js') }}" type="text/javascript"></script>
    <!-- charts scripts -->
    <script src="{{ asset('res/admin/assets/jquery-knob/js/jquery.knob.js') }}"></script>
    <script src="{{ asset('res/admin/js/jquery.sparkline.js') }}" type="text/javascript"></script>
    <script src="{{ asset('res/admin/assets/jquery-easy-pie-chart/jquery.easy-pie-chart.js') }}"></script>
    <script src="{{ asset('res/admin/js/owl.carousel.js') }}" ></script>
    <!-- jQuery full calendar -->
    <<script src="{{ asset('res/admin/js/fullcalendar.min.js') }}"></script> <!-- Full Google Calendar - Calendar -->
    <script src="{{ asset('res/admin/assets/fullcalendar/fullcalendar/fullcalendar.js') }}"></script>
    <!--script for this page only-->
    <script src="{{ asset('res/admin/js/calendar-custom.js') }}"></script>
    <script src="{{ asset('res/admin/js/jquery.rateit.min.js') }}"></script>
    <!-- custom select -->
    <script src="{{ asset('res/admin/js/jquery.customSelect.min.js') }}" ></script>
    <script src="{{ asset('res/admin/assets/chart-master/Chart.js') }}"></script>

    <!--custome script for all page-->
    <script src="{{ asset('res/admin/js/scripts.js') }}"></script>
    <!-- custom script for this page-->
    <script src="{{ asset('res/admin/js/sparkline-chart.js') }}"></script>
    <script src="{{ asset('res/admin/js/easy-pie-chart.js') }}"></script>
    <script src="{{ asset('res/admin/js/jquery-jvectormap-1.2.2.min.js') }}"></script>
    <script src="{{ asset('res/admin/js/jquery-jvectormap-world-mill-en.js') }}"></script>
    <script src="{{ asset('res/admin/js/xcharts.min.js') }}"></script>
    <script src="{{ asset('res/admin/js/jquery.autosize.min.js') }}"></script>
    <script src="{{ asset('res/admin/js/jquery.placeholder.min.js') }}"></script>
    <script src="{{ asset('res/admin/js/gdp-data.js') }}"></script>
    <script src="{{ asset('res/admin/js/morris.min.js') }}"></script>
    <script src="{{ asset('res/admin/js/sparklines.js') }}"></script>
    <script src="{{ asset('res/admin/js/charts.js') }}"></script>
    <script src="{{ asset('res/admin/js/jquery.slimscroll.min.js') }}"></script>
    {{--  这个是弹窗删除的js文件  --}}
    <script type="text/javascript" src="{{asset('res/layer/layer.js')}}"></script>
    <script type="text/javascript" src="{{asset('res/layui/lay/modules/laydate.js')}}"></script>
    <script>

        //knob
        $(function() {
            $(".knob").knob({
                'draw' : function () {
                    $(this.i).val(this.cv + '%')
                }
            })
        });

        //carousel
        $(document).ready(function() {
            $("#owl-slider").owlCarousel({
                navigation : true,
                slideSpeed : 300,
                paginationSpeed : 400,
                singleItem : true

            });
        });

        //custom select box

        $(function(){
            $('select.styled').customSelect();
        });

        /* ---------- Map ---------- */
        $(function(){
            $('#map').vectorMap({
                map: 'world_mill_en',
                series: {
                    regions: [{
                        values: gdpData,
                        scale: ['#000', '#000'],
                        normalizeFunction: 'polynomial'
                    }]
                },
                backgroundColor: '#eef3f7',
                onLabelShow: function(e, el, code){
                    el.html(el.html()+' (GDP - '+gdpData[code]+')');
                }
            });
        });



    </script>
	 <!--main content start-->
    <section id="main-content">
        <section class="wrapper">
            @yield('content')
        </section>
        <!--main content end-->
    </section>

</body>
</html>
