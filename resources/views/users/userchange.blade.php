@extends('usercenter_parent')
@section('title','修改信息')
@section('content')
<div class="jztop" style="	background: url(../../images/usercenter/jztop.png) no-repeat;
  width: 1034px;
  margin: auto;
  height: 32px;"></div>
  <div class="container">
    <div >
      @if (count($errors) > 0)
        <div class="alert alert-danger" style="width:500px;margin-left:200px">
          <ul style="text-align:center">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif
      @if(session('msg'))
        {{ session('msg') }}
      @endif
    </div>
    <div class="bloglist f_l"><br><br><br><br>
      <form id="art_form" action="{{ url('/user/changes') }}" method="post" style="padding-left:270px">
        {{ csrf_field() }}
        昵&nbsp&nbsp称：<input type="text" name="nickname" value="{{ old('nickname') }}" placeholder="{{ $user['nickname'] }}"><br><br><br>
        修改头像： <input id="file_upload" name="file_upload" type="file" multiple="true"><br><br>
          <input type="text" size="50" name="photo" id="photo">
          <p><img id="img1" alt="上传后显示图片"  style="max-width:350px;max-height:100px;" /></p>
        <script type="text/javascript">
            $(function () {
                $("#file_upload").change(function () {
                    uploadImage();
                })
            })
            function uploadImage() {
            //判断是否有选择上传文件
                var imgPath = $("#file_upload").val();
                if (imgPath == "") {
                    alert("请选择上传图片！");
                    return;
                }
                //判断上传文件的后缀名
                var strExtension = imgPath.substr(imgPath.lastIndexOf('.') + 1);
                if (strExtension != 'jpg' && strExtension != 'gif'
                    && strExtension != 'png' && strExtension != 'bmp') {
                    alert("请选择图片文件");
                    return;
                }
                var formData = new FormData($('#art_form')[0]);
                $.ajax({
                    type: "POST",
                    url: "/user/pic",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        $('#img1').attr('src','/'+data);
                        $('#photo').val(data);
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                        alert("上传失败，请检查网络后重试");
                    }
                });
            }
        </script>
        <br><br><br>
        密&nbsp&nbsp码：<input type="password"  name="password_confirmation"><br><br><br>
        确认密码：<input type="password" name="password"><br><br><br>
        性&nbsp&nbsp别：&nbsp&nbsp<label><input type="radio" name="sex" {{ $user['sex'] ? 'checked' : '' }} value="1">男</label>&nbsp&nbsp&nbsp&nbsp&nbsp
          <label><input type="radio" name="sex" {{ $user['sex'] ? '' : 'checked'}} value="0">女</label><br><br><br>
        手&nbsp&nbsp机：<input type="text" name="phone" value="{{ old('phone') }}" placeholder="{{ $user['phone'] }}"><br><br><br>
        邮&nbsp&nbsp箱：<input type="email" value="{{ old('email') }}" name="email" placeholder="{{ $user['email'] }}"><br><br><br>
        职&nbsp&nbsp业：<input type="text" value="{{ old('job') }}" name="job" placeholder="{{ $user['job'] }}"><br><br><br>
        验证码&nbsp：<input type="text" name="code"><br><br>
        <img style="margin-left:100px" src="{{ url('/user/code') }}" onclick="this.src='{{ url('/user/code') }}?'+Math.random()" alt=""><br><br>
        <input type="submit" value="提交">
      </form>
  </div>

@endsection