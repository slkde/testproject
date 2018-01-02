@extends('parents')
@section('title')
  @if(!empty(Config::get('webconfig.title')))
  <title>{{ Config::get('webconfig.title') }}--站内信</title>
	@else
	<title>问答系统</title>
	@endif
@endsection
@section('content')
<div style="background: url('{{ asset('images/background2.jpg') }} '); margin-top:50px;width:100%;height:100%">
    <br><br>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2" style="height:580px;">
                <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">站内信</h3>
                </div>
                <div class="panel-body">

                    <table class="table table-hover table-inverse table-responsive">
                    <thead class="thead-inverse">
                        <tr>
                            <th class="col-md-2">发件人</th>
                            <th class="col-md-6">标题</th>
                            <th style="display:none">内容</th>
                            <th class="col-md-2">状态</th>
                            <th class="col-md-2">操作</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($messages as $k=>$v)
                            <tr>
                                <td scope="row">{{ $v->user->nickname }}</td>
                                <td>{{ $v->message_title }}</td>
                                <td style="display:none">{{ $v->message_body }}</td>
                                <td class="status">
                                    @if($v->message_status)
                                    已读
                                    @else
                                    未读
                                    @endif
                                </td>
                                <td>
                                  <button data-toggle="modal" data-target="#sendmessage" class="sendmsg">回复</button>
                                  <button data-toggle="modal" data-target="#showmessage" class="show" msgid="{{ $v->id }}" >查看</button>
                                  <button class="del" msgid="{{ $v->id }}">删除</button>
                                </td>
                            </tr>
                            @endforeach
                          </tbody>
                        </table>

                      </div>
                      {!! $messages->render() !!}
                    </div>

                  </div>

                </div>
              </div>


    <div class="modal fade" id="showmessage" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="gridSystemModalLabel">查看站内信</h4>
          </div>
          <div class="modal-body">

              {!! Form::open() !!}

            <div class="row">
              <div class="col-md-2 col-md-offset-1">发件人：</div>
              <div class="col-md-2 col-md-offset-2" id="user_name"></div>
            </div>
            <div class="row">
              <div class="col-md-4 col-md-offset-1">主题：</div>
              <div class="col-md-4 " id="message_title"></div>
            </div>
            <div class="row">
              <div class="col-md-4 col-md-offset-1">内容：</div>
                <div class="col-md-4 " id="message_body"></div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
            {{--  <button type="button" class="btn btn-primary">发送</button>  --}}

          </div>

          {!! Form::close() !!}

        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->



    <div class="modal fade" id="sendmessage" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="gridSystemModalLabel">发送站内信
              <span id="returnmsg"></span>
            </h4>
          </div>
          <div class="modal-body">

              {!! Form::open(['url' => '/user/message','id'=>'send']) !!}

            <div class="row">
              <div class="col-md-2 col-md-offset-2">收件人：</div>
              <div class="col-md-8" id="returnmsgname"></div>
            </div>
            <div class="row">
              <div class="col-md-10 col-md-offset-2">
                {!! Form::text('user_name',null,['id'=>'username']) !!}
              </div>
            </div>
            <div class="row">
              <div class="col-md-2 col-md-offset-2">主题：</div>
              <div class="col-md-8" id="returnmsgtitle"></div>
            </div>
            <div>
              <div class="col-md-10  col-md-offset-2">
                {!! Form::text('message_title') !!}
              </div>
            </div>

            <div class="row">
              <div class="col-md-2 col-md-offset-2">内容：</div>
              <div class="col-md-8" id="returnmsgbody"></div>
            </div>

            <div  class="row">
              <div class="col-md-10 col-md-offset-2">
                {!! Form::textarea('message_body') !!}
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal" onclick="clearmsg()">关闭</button>
            <button type="button" class="btn btn-primary" id="sendout">发送</button>
          </div>

          {!! Form::close() !!}

        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</div>
<script>

  $('.sendmsg').click(function(){
    $('#username').val($(this).parents('tr').children().html());
    
  })


@include('users.sendmsg')
        

        $('.del').click( function(){

          var id = $(this).attr('msgid');
          var msg = $(this).parents('tr');

         $.ajax({
           url:'message/'+id,
           async:true,
           type:'DELETE',
           datatype:'json',
           data:{'_token':'{{csrf_token()}}'},
           success:function(data){
            msg.remove();
           }
         });
          
        });


        $('.show').click( function(){

          var id = $(this).attr('msgid');
          var msg = $(this).parents('tr');

         $.ajax({
           url:'message/'+id,
           async:true,
           type:'get',
           datatype:'json',
           data:{'_token':'{{csrf_token()}}'},
           success:function(data){
            msg.children('.status').html('已读');
           }
         });
          
        });



        
      $('.show').click(function(){
        $('#user_name').html($(this).parents('tr').children().html());
        $('#message_title').html($(this).parents('tr').children().next().html());
        $('#message_body').html($(this).parents('tr').children().next().next().html());
      });
      
      $('.sendmessage').click(function(){
        $('#username').html($(this).parents('tr').children().html());
    });
</script>

@endsection