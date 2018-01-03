@extends('admin.parent')
@section('content')
    <!-- Text Input -->
    <div class="block-area col-md-10 col-sm-offset-4" id="text-input" >
        <h3 class="block-title" style="margin-left: 50px;">网站配置添加</h3>

       
        <!--结果集标题与导航组件 开始-->
        <div class="result_title">
            @if(session('msg'))
             <h3>{{session('msg')}}</h3>
            @endif
        </div>


        <form action="{{ url('/admin/config') }}" method="post" enctype="multipart/form-data" class=" navbar-left">
            
            <table>
                {{ csrf_field() }}
                <tr>
                    <th></th>
                    <td>
                        <input class="form-control input-lg m-bot15" type="text" name="title" placeholder="配置项的描述,不用数字">
                    </td>
                </tr>

                <tr>
                    <th></th>
                    <td>
                        <input class="form-control input-lg m-bot15" type="text" name="name" placeholder="配置项名,轮播用photo,不用数字">
                    </td>
                </tr>
                
                <tr>
                    <th></th>
                    <td>
                        <input class="form-control input-lg m-bot15" type="text" name="content" placeholder="配置项的内容">
                    </td>
                </tr>

                <tr>
                    <th></th>
                    <td>
                        <input class="form-control input-lg m-bot15" type="text" name="order" placeholder="配置项的排序">
                    </td>
                </tr>

                <tr>
                    <th></th>
                    <td>
                        <label for=""><input type="radio" name="type" checked value="input" onclick="showTr(this)">普通文本框</label>
                        <label for=""><input type="radio" name="type" value="textarea" onclick="showTr(this)">文本域</label>
                        <label for=""><input type="radio" name="type" value="radio" onclick="showTr(this)">单选按钮</label>
                        <label for=""><input type="radio" name="type" value="img" onclick="showTr(this)">图片</label>
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