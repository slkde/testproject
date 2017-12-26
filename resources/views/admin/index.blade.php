@extends('admin.parent')
@section('content')

    <!--main content start-->
    <section id="main-content">
        <section class="wrapper">
		<div class="weather" style="margin-left:600px; background-color:#fff;text-align:center;border-radius:50px;padding-left:70px">
      <iframe width="250" scrolling="no" height="60" frameborder="0" allowtransparency="true" src="http://i.tianqi.com/index.php?c=code&id=12&icon=1&num=1"></iframe>
    </div>
            <div class="result_wrap">
                <div class="result_title">
                    <h3>系统基本信息</h3>
                </div>
                <div class="result_content" style="font-size:20px">
                    <ul>
                        <li>
                            <label>操作系统</label>&nbsp;&nbsp;<span>WINNT</span>
                        </li>
                        <li>
                            <label>运行环境</label>&nbsp;&nbsp;<span>{{$_SERVER['SERVER_SOFTWARE']}}</span>
                        </li>

                        <li>
                            <label>上传附件限制</label>&nbsp;&nbsp;<span><?php echo get_cfg_var ("upload_max_filesize")?get_cfg_var ("upload_max_filesize"):"不允许上传附件"; ?></span>
                        </li>
                        <li>
                            <label>北京时间</label>&nbsp;&nbsp;<span>{{date('Y-m-d H:i:s',time())}}</span>
                        </li>
                        <li>
                            <label>服务器域名/IP</label>&nbsp;&nbsp;<span>{{$_SERVER['SERVER_NAME']}} &nbsp;[ {{$_SERVER['SERVER_ADDR']}} ]</span>
                        </li>
                        <li>
                            <label>Host</label>&nbsp;&nbsp;<span> {{$_SERVER['SERVER_ADDR']}}</span>
                        </li>
                    </ul>
                </div>
            </div>
			
            <div class="result_wrap">
                <div class="result_title">
                    <h3>使用帮助</h3>
                </div>
                <div class="result_content" style="font-size:20px">
                    <ul>
                        <li>
                            <label>官方交流网站：</label><span><a href="#">http://bbs.itxdl.cn</a></span>
                        </li>
                        <li>
                            <label>官方交流QQ群：</label><span><a href="#"><img border="0" src="{{ asset('res/admin/img/group.png') }}">1558573029</a></span>
                        </li>
                    </ul>
                </div>
            </div>
            <!--结果集列表组件 结束-->
        </section>
        <!--main content end-->
    </section>
    <!-- container section start -->

    @endsection
