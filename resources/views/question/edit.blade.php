@extends('parents')
@section('title')
    @if(!empty(Config::get('webconfig.title')))
    <title>{{ Config::get('webconfig.title')}}--编辑我的问题</title>
	@else
	<title>问答系统</title>
	@endif
@endsection
@section('content')

    <div class ="container">
        <br><br><br>
        <div class="row">
            <div class="col-md-9" role="main">
                
                {!! Form::open() !!}

            </div>
        <div class="row">
            <div class="col-md-10 col-md-offset-1" >
                
                    
            <div class="row form-group">

                    <div class="col-md-2">
                    <select name="topic_id" class="form-control topic_id">
                        <option value="">请选择话题</option>
                        @foreach($topic as $v)
                        @if($v->id == $question->topic_id)
                            <option value="{{ $v->id }}" selected >{{ $v->name }}</option>
                        @else
                            <option value="{{ $v->id }}">{{ $v->name }}</option>
                        @endif
                        @endforeach
                    </select>
                    </div>
                <div class="col-md-2">
                {!! Form::label('title', '标题：',['class' => 'form-control']) !!}

                </div>
                <div class="col-md-5">
                {!! Form::text('title', $question->title, ['class' => 'form-control title']) !!}
                </div>
                <div class="col-md-3">
    
                    {!! Form::text('error',null,['class'=>'form-control err err1 err2']) !!}
                    
                </div>
            </div>

            <div class="form-group">
                <div id="summernote"></div>
                
            </div>

                
                <div class="col-md-5 col-md-offset-3">
                    {!! Form::close() !!}
                    {!! Form::submit('更新问题', ['class' => 'btn btn-primary pull-right form-control subcontent']) !!}
                    
                </div>
                    
                
                
            </div>
        </div>
    </div>
    <div class="oldcontent" style="display:none">{!! $question->content !!}</div>
<script>
    var qc = $('.oldcontent').html();
    $(document).ready(function() {
        $('#summernote').summernote({
            height: 430,
            lang: 'zh-CN',
            callbacks: {
                onImageUpload: function (files) {
                    var sumfile = $('#summernote')
                    sendFile(sumfile, files[0]);
                }
            }
        });


        function sendFile(sumfile, file) {
            var formData = new FormData();
            formData.append("file", file);
            formData.append("_token", '{{csrf_token()}}');

            $.ajax({
                url: "/question/upload",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                type: 'POST',
                success: function (data) {
                    sumfile.summernote('insertImage', "{{ asset('/') }}" + data);
                }
            });
        }


        $('#summernote').summernote('code',qc);
    

    $('.subcontent').click(function(){
        var content = $('#summernote').summernote('code');
        var title = $('.title').val();
        var topic_id = $('.topic_id').val();
        $.ajax({
            url:'/question/'+{{$question->id}},
            data:{'topic_id':topic_id,'title':title,'content':content,'_token':'{{csrf_token()}}'},
            type:'patch',
            dataType:'json',
            success:function(data){
                location.href = '/answer/' + parseInt(data) ;
            },
            statusCode:{422:function(data){
                var error = JSON.parse(data.responseText);
                console.log(error);
               $('.err').val(error.title[0]);
                $('.err1').val(error.topic_id[0]);
                $('.err2').val(error.content[0]);
            }
        }
        });
    });
});
</script>
@stop