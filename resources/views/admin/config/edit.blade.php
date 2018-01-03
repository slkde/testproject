@extends('admin.parent')
@section('content')
    <!-- Text Input -->
    <div class="block-area col-md-10 col-sm-offset-4" id="text-input" >
        <h3 class="block-title" style="margin-left: 50px;">网站配置修改</h3>

       
        <!--结果集标题与导航组件 开始-->
        <div class="result_title">
            @if(session('msg'))
             <h3>{{session('msg')}}</h3>
            @endif
        </div>


        <form class=" navbar-left" action="{{ url('/admin/config/'.$conf->id) }}" method="post" enctype="multipart/form-data">
             {{ csrf_field() }}

              {{ method_field('PUT') }}
            <table>
                               <tr>
                    <th></th>
                    <td>
                        <input class="form-control input-lg m-bot15" type="text" name="title" placeholder="配置项的描述" value="{{$conf->title}}">
                    </td>
                </tr>

                <tr>
                    <th></th>
                    <td>
                        <input class="form-control input-lg m-bot15" type="text" name="name" placeholder="配置项名,轮播图用photo" value="{{$conf->name}}">
                    </td>
                </tr>
                
                <tr>
                    <th></th>
                    <td>
                        <input class="form-control input-lg m-bot15" type="text" name="content" placeholder="配置项的内容" value="{{$conf->content}}">
                    </td>
                </tr>

                <tr>
                    <th></th>
                    <td>
                        <input class="form-control input-lg m-bot15" type="text" name="order" placeholder="配置项的排序" value="{{$conf->order}}">
                    </td>
                </tr>

                <tr>
                    <th></th>
                    <td>
                        <label for=""><input type="radio" name="type" @if($conf->type == 'input') checked   @endif value="input" onclick="showTr(this)">普通文本框</label>
                        <label for=""><input type="radio" name="type" @if($conf->type == 'textarea') checked   @endif value="textarea" onclick="showTr(this)">文本域</label>
                        <label for=""><input type="radio" name="type" @if($conf->type == 'radio') checked   @endif value="radio" onclick="showTr(this)">单选按钮</label>
                        <label for=""><input type="radio" name="type" @if($conf->type == 'img') checked   @endif value="img" onclick="showTr(this)">图片</label>
                    </td>
                </tr>
                <br />



                <tr id="showradio" class="hiddenall" style="display: none">
                    <th></th>
                    <td>
                        <input class="form-control input-lg m-bot15" type="text" placeholder="1|开启,2|关闭" name="value">
                    </td>
                </tr>

                <tr id="showarea" class="hiddenall"  style="display: none">
                    <th></th>
                    <td>
                        <textarea class="form-control input-lg m-bot15"  name="value"></textarea>
                    </td>
                </tr>
                <tr id="showinput" class="hiddenall"  style="display: none">
                    <th></th>
                    <td>
                        <input class="form-control input-lg m-bot15" type="text"  name="value">
                    </td>
                </tr>

                <tr id="showimg" class="hiddenall"  style="display: none">
                    <th></th>
                    <td>
                        
                        {!! Form::file('photo') !!}
                        <img style="width:100px"  src="{{ url($conf->content) }}" alt="" >
                        
                    </td>
                </tr>
               

                <tr>
                    <th></th>
                    <td>
                        <input class="form-control input-lg m-bot15" style="background: #007AFF;" type="submit" value="提交">
                        <input class="form-control input-lg m-bot15" style="background: #007AFF;" type="button" onclick="history.go(-1)" value="返回">
                    </td>
                </tr>
                
            </table>
        </form>
    </div>
    
    <script>
        //如果页面加载结束后，单选按钮被选中，配置项的值这部分内容要显示出来
        $(function(){
            //获取value值是radio的单选按钮
           var obj =  $("input[value='radio']:checked");
           if(obj.length > 0){
               $('#showradio').show();
           }

           var obj =  $("input[value='textarea']:checked");
           if(obj.length > 0){
               $('#showarea').show();
           }

           var obj =  $("input[value='input']:checked");
           if(obj.length > 0){
               $('#showinput').show();
           }

            //页面中的单选按钮中图片这一项被选中，让id="field_img"的tr显示出来
            var obj =  $("input[value='img']:checked");
            if(obj.length > 0){
                $('#showimg').show();
            }
        });


        function showTr(obj){
            //获取当前选中的元素的value值
           var v =  $(obj).val();
           switch(v){
               case 'input':
                 $('.hiddenall').hide();
                  $('#showinput').show();
                  break;
               case 'textarea':
                $('.hiddenall').hide();
                   $('#showarea').show();
                   break;
               case 'radio':
                $('.hiddenall').hide();
                   $('#showradio').show();
                   break;
               case 'img':
                $('.hiddenall').hide();
                   $('#showimg').show();
                   break;
           }
        }
    </script>

@endsection