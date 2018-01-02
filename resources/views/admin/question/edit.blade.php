@extends('admin.parent')
@section('content')
        <!-- 显示错误信息列表 -->
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif       
    <div class="row" style="height:2000px">
        <div class="col-lg-12" >
            <section class="panel" style="height:800px">
			<h3>修改提问</h3>		
				<form id="art_form" action="{{url('admin/question/'.$question->id)}}" method="post" enctype="multipart/form-data">
					<div class="result_content">
					<table class="" style="padding:0 50px">
						<tbody>
						{{csrf_field()}}
						{{ method_field('put') }}
						<tr>
							<th width="120">话题分类：</th>
							<td>
								<select name="topic_id">
									@foreach($topic as $k=>$v)
									<option value="{{$v->id}}" {{($question->topic_id == $v->id)?'selected':''}} >{{$v->name}}</option>
									@endforeach
								</select>
							</td>
						</tr>
						<tr>
							<th><i class="require">*</i> 提问标题：</th>
							<td>
								<input type="text" size="50" value="{{ $question->title }}" class="lg" name="title"><br>
							</td>
						</tr>
						
						<tr>
							<th></th>
							<td>
								<img src="" alt="" id="art_thumb_img" style="max-width: 350px; max-height:100px;">
							</td>
						</tr>
						<tr>
							<th>文章内容：</th>
							<td>
								<script type="text/javascript" charset="utf-8" src="/res/ueditor/ueditor.config.js"></script>
								<script type="text/javascript" charset="utf-8" src="/res/ueditor/ueditor.all.min.js"> </script>
								<!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败-->
								<!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->
								<script type="text/javascript" charset="utf-8" src="/res/ueditor/lang/zh-cn/zh-cn.js"></script>
								<script id="editor" type="text/plain" name="content" style="width:1000px;height:400px;">
									 {!! $question->content !!}
								</script>						
								<script type="text/javascript">

									//实例化编辑器
									//建议使用工厂方法getEditor创建和引用编辑器实例，如果在某个闭包下引用该编辑器，直接调用UE.getEditor('editor')就能拿到相关的实例
									var ue = UE.getEditor('editor');


								</script>
								<style>
									.edui-default{line-height: 28px}
									div.edui-combox-body,div.edui-button-body,div.edui-splitbutton-body
									{overflow: hidden; height:20px;}
									div.edui-box{overflow: hidden; height:22px;}
								</style>
									</td>
						</tr>

						<tr>
							<th></th>
							<td>
								<input type="submit" value="修改">
								<input type="button" class="back" onclick="history.go(-1)" value="返回">
							</td>
						</tr>
						</tbody>
					</table>
					</div>
				</form>   
			</section>
        </div>        
  </div>
@endsection