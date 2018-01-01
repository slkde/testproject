@extends('usercenter_parent')
@section('title','个人信息')
@section('content')
<div class="jztop" style="	background: url(../../images/usercenter/jztop.png) no-repeat;
  width: 1034px;
  margin: auto;
  height: 32px;"></div>
  <div class="container">
    <div class="bloglist f_l">
    {{--个人信息展示--}}
      <table style="margin-left:270px;margin-top: 100px;">
        <tr>
          <td>
            <p class="dateview">
              <span>手机号：{{ $user['phone'] }}</span>
            </p>
          </td>
        </tr>
        <tr>
          <td>
            <p class="dateview">
              <span>昵称：{{ $user['nickname'] }}</span>
            </p>
          </td>
        </tr>
        <tr>
          <td>
            <p class="dateview">
              <span>邮箱：{{ $user['email'] }}</span>
            </p>
          </td>
        </tr>
        <tr>
          <td>
            <p class="dateview">
              <span>性别：{{ $user['sex'] ? '男' : '女' }}</span>
            </p>
          </td>
        </tr>
        <tr>
          <td>
            <p class="dateview">
              <span>积分：{{ $user['score'] }}</span>
            </p>
          </td>
        </tr>
        <tr>
          <td>
            <p class="dateview">
              <span>座右铭：{{ $user['autograph'] }}</span>
            </p>
          </td>
        </tr>
        <tr>
          <td>
            <p class="dateview">
              <span>职业：{{ $user['job'] }}</span>
            </p>
          </td>
        </tr>
      </table>
  </div>
@endsection