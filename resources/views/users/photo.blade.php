@extends('parents')
@section('title')
    @if(!empty(Config::get('webconfig.title')))
    <title>{{ Config::get('webconfig.title') }}--头像设置</title>
	@else
	<title>问答系统</title>
	@endif
@endsection
@section('content')

<div style="background: url('{{ asset('images/background2.jpg') }} '); margin-top:50px;width:100%;height:100%">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3" >
                <h2 style="text-align: center">问问答--头像修改</h2>
                <br><br>
                <div class="text-center">
                    
                    <img class="img-circle user_photo" width="150" height="150" src="{{ asset(Auth::user()->photo) }}">
                    </img>
                    
                    {!! Form::open(['method'=>'patch','url'=>'user/photo/{{ Auth::user()->id }}', 'files'=>true, 'id'=>'up_photo']) !!}
                    
                    <div>
                        {{--  {!! Form::submit('上传头像', ['class' => 'btn btn-primary pull-right']) !!}  --}}
                        <br><br>
                        <div class="text-center">
                            <button type="button" class="btn btn-primary" id="upload_photo">上传头像</button>

                        {!! Form::file('photo',['class'=>'photo','id'=>'image', 'style'=>"display:none"]) !!}
                    </div>
                    </div>


                    {!! Form::close() !!}
                    
                    <div id="errors"></div>
                    
                    
                </div>
                
            </div>
        </div>
        <br><br><br><br>
    </div>
</div>
    <script>
    $(document).ready(function() {
        var options = {
            beforeSubmit:  showRequest,
            success:       showResponse,
            dataType: 'json'
        };
        $('#upload_photo').click(function(){
            $('#image').click();
        });
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
