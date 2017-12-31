
  
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
    $('#returnmsg').html('');
        }