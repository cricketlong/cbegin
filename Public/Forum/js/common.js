$(function () {
    bindLzlEvent();
    
    /*点赞*/
	$('.do-zan').click(function (){
		
		var is_zan = $(this).attr('data-zan');
		if(is_zan == 0){
			var obj = $(this);
			var id = $(this).attr('data-id');
			var zanCount = obj.find('em').text();
			$.post('/Forum/index/doZan',{id:id},function(data){
				
				if(data.status){
					toast.success(data.info, '');
					zanCount++;
					obj.find('em').text(zanCount);
					obj.attr({'data-zan':'1'});
					
				}
				else{
					toast.error(data.info, '');
				}
			},'json');
		}
		else{
			toast.error('不要重复点赞');
		}
		
	});
	
	/* 收藏 */
	$('.do-follow').click(function (){
		
		var obj = $(this);
		var id = $(this).attr('data-id');
		var colCount = obj.find('em').text();
		
		$.post('/Forum/index/doFollow',{id:id},function(data){
			
			if(data.status){
				toast.success(data.info, '');
				colCount++;
				obj.find('em').text(colCount);
				
			}
			else{
				toast.error(data.info, '');
			}
		},'json');
		
	});
	
});


var getArgs = function (uri) {
    if (!uri) return {};
    var obj = {},
        args = uri.split("&"),
        l, arg;
    l = args.length;
    while (l-- > 0) {
        arg = args[l];
        if (!arg) {
            continue;
        }
        arg = arg.split("=");
        obj[arg[0]] = arg[1];
    }
    return obj;
};

function bindLzlEvent() {
    var reply_btn = $('.reply_lzl_btn');
    reply_btn.unbind('click');
    reply_btn.click(function () {
        var args = getArgs($(this).attr('args'));

        var to_f_reply_id = args['to_f_reply_id'];
        $('#show_textarea_' + to_f_reply_id).show();

        $('#reply_' + to_f_reply_id).val('回复@' + args['to_nickname'] + ' ：');
        $('#submit_' + to_f_reply_id).attr('args', $(this).attr('args'));

    });
    $('.input_tips').unbind('keypress');
    $('.input_tips').keypress(function (e) {
        if (e.ctrlKey && e.which == 13 || e.which == 10) {
            var re = $(this).attr('args');
            var args = getArgs($('#submit_' + re).attr('args'));

            var to_f_reply_id = args['to_f_reply_id'];
            var post_id = $('#submit_' + re).attr('post_id');
            var content = $('#reply_' + to_f_reply_id).val();
            var to_reply_id = args['to_reply_id'];
            var to_uid = args['to_uid'];
            submitLZLReply(post_id, to_f_reply_id, to_reply_id, to_uid, content);
        }
        // this.preventDefault();
    });

    var submitLZLReply = function (post_id, to_f_reply_id, to_reply_id, to_uid, content, p) {
        var url = U('Forum/LZL/doSendLZLReply');

        $.post(url, {post_id: post_id, to_f_reply_id: to_f_reply_id, to_reply_id: to_reply_id, to_uid: to_uid, content: content, p: p}, function (msg) {
            if (msg.status) {
                toast.success(msg.info, '温馨提示');
                $('#lzl_reply_list_' + to_f_reply_id).load(U('Forum/LZL/lzlList', ['to_f_reply_id', to_f_reply_id, 'page', msg.url], true), function () {
                    ucard()
                })
                $('#reply_' + to_f_reply_id).val('');
            } else {
                toast.error(msg.info, '温馨提示');
            }
        }, 'json');
    };

    $(".submitReply").unbind('.submitReply');
    $(".submitReply").click(function () {
        var args = getArgs($(this).attr('args'));
        var to_f_reply_id = args['to_f_reply_id'];
        var post_id = $(this).attr('post_id');
        var content = $('#reply_' + to_f_reply_id).val();
        var to_reply_id = args['to_reply_id'];
        var to_uid = args['to_uid'];
        var p = args['p'];

        submitLZLReply(post_id, to_f_reply_id, to_reply_id, to_uid, content, p);

        this.preventDefault();
    });

    $('.reply_btn').unbind('click');
    $('.reply_btn').click(function (event) {
        var args = $(this).attr('args');
        $('#lzl_reply_div_' + args).toggle();
        event.preventDefault();
        //this.preventDefault();
    });
    $('.show_textarea').unbind('click');
    $('.show_textarea').click(function () {
        var args = $(this).attr('args');
        $('#show_textarea_' + args).toggle();
        this.preventDefault();
    })

    $('.del_lzl_reply').unbind('click');
    $('.del_lzl_reply').click(function () {
        if (confirm('确定要删除该回复么？')) {
            var args = getArgs($(this).attr('args'));
            var to_f_reply_id = args['to_f_reply_id'];
            var url = U('Forum/LZL/delLZLReply');
            $.post(url, {id: args['lzl_reply_id']}, function (msg) {
                if (msg.status) {
                    toast.success('删除成功', '温馨提示');
                    $('#forum_lzl_reply_' + args['lzl_reply_id']).hide();
                    $('#reply_' + to_f_reply_id).val('');
                    $('#reply_btn_' + msg.post_reply_id).html('回复(' + msg.lzl_reply_count + ')');
                } else {
                    toast.error('删除失败', '温馨提示');
                }
            });
        }
        this.preventDefault();
    });
    $('.del_reply_btn').unbind('click');
    $('.del_reply_btn').click(function () {
        if (confirm('确定要删除该回复么？')) {
            var args = getArgs($(this).attr('args'));
            var url = U('Forum/Index/delPostReply');
            $.post(url, {id: args['reply_id']}, function (msg) {
                if (msg.status) {
                    toast.success('删除成功', '温馨提示');
                    location.reload();
                } else {
                    toast.error('删除失败', '温馨提示');
                }
            });

        }
        this.preventDefault();
    });
}
function changePage(id, p) {
    $('#lzl_reply_list_' + id).load(U('Forum/LZL/lzllist',['to_f_reply_id',id,'page',p], true), function () {
        ucard();
    })
}