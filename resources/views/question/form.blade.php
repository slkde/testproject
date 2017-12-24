
<div class="form-group">
    {!! Form::label('title', '主题：') !!}
    
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    
    <div class="editor">
      {!! Form::textarea('content', null, ['class'=>'form-control','id'=>'myEditor']) !!}
    </div>
    
</div>