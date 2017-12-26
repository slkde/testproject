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

<script>

  $('.sendmsg').click(function(){
    $('#username').val($(this).parents('tr').children().html());
  })
  
  $('#sendout').click( function(){
    clearmsg();
    var options = {
      success: showResponse,
      error: showError,
      dataType: 'json'
    };
    
    $('#send').ajaxForm(options).submit();
    
  });
  
  function showResponse(response){
    $('#returnmsg').html(response.msg);
    
  }
  
  function showError(data){
    var error = JSON.parse(data.responseText);
    $('#returnmsgname').html(error.user_name);
    $('#returnmsgtitle').html(error.message_title);
    $('#returnmsgbody').html(error.message_body);
  }
  
  function clearmsg(){
    $('#returnmsgname').html('');
    $('#returnmsgtitle').html('');
    $('#returnmsgbody').html('');
        }
        

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



        
      $('.show').click(function(){
        $('#user_name').html($(this).parents('tr').children().html());
        $('#message_title').html($(this).parents('tr').children().next().html());
        $('#message_body').html($(this).parents('tr').children().next().next().html());
      });
      
      $('.sendmessage').click(function(){
        $('#username').html($(this).parents('tr').children().html());
    });
</script>