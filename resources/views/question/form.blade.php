
<div class="row form-group">
    <div class="col-md-2">
    <select name="topic_id" class="form-control" id="">
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
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group">
    
    <div class="editor">
      {!! Form::textarea('content', null, ['class'=>'form-control','id'=>'myEditor']) !!}
    </div>
    
</div>