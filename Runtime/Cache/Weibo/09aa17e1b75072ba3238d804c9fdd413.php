<?php if (!defined('THINK_PATH')) exit();?><!-- Modal -->
<div id="frm-post-popup" class="white-popup" style="max-width: 745px">
    <div class="weibo_post_box">
    <h2>转发</h2>

    <div class="aline" style="margin-bottom: 10px"></div>
    <div class="row">


        <div class="col-xs-12">

            <div>  <a ucard="<?php echo ($soueseWeibo["user"]["uid"]); ?>"        href="<?php echo ($soueseWeibo["user"]["space_url"]); ?>"><?php echo (htmlspecialchars($soueseWeibo["user"]["username"])); ?></a></div>

            <div><?php echo (parse_weibo_content($soueseWeibo["content"])); ?></div>


            <br/>
            <p><textarea class="form-control" id="repost_content" style="height: 6em;"
                         placeholder="写点什么吧～～"><?php echo ($weiboContent); ?></textarea></p>
            <a href="javascript:" onclick="insertFace($(this))"><img src="/Public/static/image/bq.png"/></a>
            <p class="pull-right"><input type="submit" value="发表 Ctrl+Enter" id="send_repost_button"
                                         class="btn btn-primary" data-url="<?php echo U('weibo/Index/doSendRepost');?>"/></p>
          <p><input id="becomment" checked type="checkbox" value="1" name="becomment" >同时作为评论发布</p>
        </div>
    </div>
    <div id="emot_content" class="emot_content"></div>
    <button title="Close (Esc)" type="button" class="mfp-close" style="color: #333;">×</button>
    </div>
</div>
<!-- /.modal -->

        <script>
            $(function () {
                $('#repost_content').keypress(function (e) {
                if (e.ctrlKey && e.which == 13 || e.which == 10) {
                    $("#send_repost_button").click();

                }

            });
            //点击发表微博按钮之后
            $('#send_repost_button').click(function () {
                //获取参数
                var url = $(this).attr('data-url');
                var content = $('#repost_content').val();
                var button = $(this);
                var originalButtonText = button.val();
                var feedType = 'repost';
                var sourseId = '<?php echo ($sourseId); ?>';
                var weiboId = '<?php echo ($weiboId); ?>';
                var becomment=   document.getElementsByName("becomment")
                //发送到服务器
                $.post(url, {content: content,type:feedType,sourseId:sourseId,weiboId:weiboId,becomment:becomment[0].checked}, function (a) {
                   handleAjax(a);
                    if (a.status) {
                        $('.mfp-close').click();
                        button.attr('class', 'btn btn-primary');
                        button.val(originalButtonText);
                        setTimeout(function(){
                            $('#weibo_list').prepend(a.html)
                            bindRepost();
                            bind_weibo_popup();
                        },1000)
                        $('.XT_face').remove();
                        insert_image.close();

                    }
                });
            });
            });
        </script>