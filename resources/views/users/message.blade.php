@extends('parents')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">站内信</h3>
            </div>
            <div class="panel-body">
                
                <table class="table table-hover table-inverse table-responsive">
                <thead class="thead-inverse">
                    <tr>
                        <th>发件人</th>
                        <th>标题</th>
                        <th style="display:none">内容</th>
                        <th>状态</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($messages as $k=>$v)
                        <tr>
                            <td scope="row">{{ $v->user->nickname }}</td>
                            <td>{{ $v->message_title }}</td>
                            <td style="display:none">{{ $v->message_body }}</td>
                            <td>
                                @if($v->message_status)
                                已读
                                @else
                                未读
                                @endif
                            </td>
                            <td>
                              <button data-toggle="modal" data-target="#sendmessage" class="sendmsg">回复</button>
                              <button data-toggle="modal" data-target="#showmessage" class="show">查看</button>
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
        <button type="button" class="btn btn-primary">发送</button>

      </div>
      
      {!! Form::close() !!}
      
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



@include('users/sendmsg')

@endsection