<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>找回密码</title>
</head>
<body>

<table cellpadding="0" cellspacing="0" align="center" width="640">
        <td style="background-color: #fff;border-radius:6px;padding:40px 40px 0;">
            <table>
              <tbody><tr height="40">
                <td style="padding-left:25px;padding-right:25px;font-size:18px;font-family:'微软雅黑','黑体',arial;">
                  尊敬的{{$user->username}}：
                </td>
              </tr>
              <tr height="15">
                <td></td>
              </tr>
              <tr height="30">
                <td style="padding-left:55px;padding-right:55px;font-family:'微软雅黑','黑体',arial;font-size:14px;line-height:20px;">
                  您于 <span style="border-bottom:1px dashed #ccc;" t="5" times=" 14:39">{{date('Y-m-d', time())}}</span> {{date('H:i:s', time())}} 申请修改密码，请点击以下链接：<br>            

                  <a href="{{url('reset')}}?email={{$user->email}}&uid={{$user->id}}&identty={{$user->identty}}" target="_blank" style="display: inline-block;color:#fff;line-height: 40px;background-color: #1989fa;border-radius: 5px;text-align: center;text-decoration: none;font-size: 14px;padding: 1px 30px;">链接</a><p>进行修改密码</p>
                </td>
              </tr>
             
              <tr height="20">
                <td></td>
              </tr>
              <tr>
                <td style="padding-left:55px;padding-right:55px;font-family:'微软雅黑','黑体',arial;font-size:14px;">
                  此致<br>
                  五牛云团队
                </td>
              </tr>
              <tr height="50">
                <td></td>
              </tr>
            </tbody></table>
          </td>
		</table>
   
</body>
</html>