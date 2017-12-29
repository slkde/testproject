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