@extends('parents')
@section('content')
{{--  @include('editor::head')  --}}
<div style="background: url('{{ asset('images/background2.jpg') }} '); margin-top:50px;width:100%;height:100%">
    <br><br>
    <div class ="container">
        <div class="row">
            {!! Form::open() !!}
            <div class="col-md-10 col-md-offset-1">
                {{--<div class="btn-group" data-toggle="buttons">--}}
                    {{--@foreach($topic as $v)--}}
                {{--<label class="btn btn-primary">--}}
                    {{--<input type="radio" name="topic_id" value="{{ $v->id }}" autocomplete="off">{{ $v->name }}--}}
                {{--</label>--}}
                    {{--@endforeach--}}

                {{--</div>--}}
            </div>
        </div>
        <div class="row">
            <div class="col-md-10 col-md-offset-1" >
                
                    
                <div class="row form-group">
    <div class="col-md-2">
    <select name="topic_id" class="form-control topic_id">
        <option value="">请选择话题</option>
        @foreach($topic as $v)
            <option value="{{ $v->id }}">{{ $v->name }}</option>
        @endforeach
    </select>
    </div>
    <div class="col-md-2">
    {!! Form::label('title', '标题：',['class' => 'form-control']) !!}

    </div>
    <div class="col-md-7">
    {!! Form::text('title', null, ['class' => 'form-control title']) !!}
    </div>
</div>

<div class="form-group">
    <div id="summernote"></div>
    {{--  <div class="editor">
      {!! Form::textarea('content', null, ['class'=>'form-control','id'=>'myEditor']) !!}
    </div>  --}}
    
</div>


<div class="col-md-5 col-md-offset-3">
    
    {!! Form::close() !!}
    {!! Form::submit('发表问题', ['class' => 'btn btn-primary pull-right form-control subcontent']) !!}
   
</div>
                
                
                
            </div>
        </div>
        <br>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#summernote').summernote({
            height: 430,
            lang: 'zh-CN',
        });
    });

    $('.subcontent').click(function(){
        var content = $('#summernote').summernote('code');
        var title = $('.title').val();
        var topic_id = $('.topic_id').val();
        $.ajax({
            url:'/question',
            data:{'topic_id':topic_id,'title':title,'content':content,'_token':'{{csrf_token()}}'},
            type:'post',
            dataType:'json',
            success:function(data){
                location.href = '/answer/' + parseInt(data) ;
            },
            statusCode:{422:function(data){
                var error = JSON.parse(data.responseText);
                console.log(error);
                $('.subcontent').val(error.content[0]);
                $('.subcontent').val(error.title[0]);
                $('.subcontent').val(error.topic_id[0]);
            }
        }
        })
    })

</script>
@stop