@extends('parents')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3" >
                <div class="text-center">
                    
                    <img class="img-circle user_photo" width="150" height="150" src="{{ asset(Auth::user()->photo) }}">
                    </img>
                    
                    {!! Form::open(['url'=>'user/photo', 'files'=>true, 'id'=>'up_photo']) !!}
                    
                    <div>
                        {{--  {!! Form::submit('上传头像', ['class' => 'btn btn-primary pull-right']) !!}  --}}
                        <div class="text-center">
                            <button type="button" class="btn btn-primary" id="upload_photo">上传头像</button>
                        {!! Form::file('photo',['class'=>'photo','id'=>'image']) !!}
                    </div>
                    </div>


                    {!! Form::close() !!}
                    
                    <div id="errors"></div>
                    
                    
                </div>
                
            </div>
        </div>
    </div>
    <script>
    $(document).ready(function() {
        var options = {
            beforeSubmit:  showRequest,
            success:       showResponse,
            dataType: 'json'
        };
        $('#image').on('change', function(){
            $('#upload_photo').html('正在上传...');
            $('#up_photo').ajaxForm(options).submit();
        });
    });
    function showRequest() {
        $("#errors").hide().empty();
        {{--  $("#output").css('display','none');  --}}
        return true;
    }

    function showResponse(response)  {
        if(response.success == false)
        {
            var responseErrors = response.errors;
            $.each(responseErrors, function(index, value)
            {
                if (value.length != 0)
                {
                    $("#errors").append('<div class="alert alert-error"><strong>'+ value +'</strong><div>');
                }
            });
            $("#errors").show();
        } else {
            $('.user_photo').attr('src',response.photo);
            $('#upload_photo').html('上传头像');
        }
    }
</script>
@endsection
