<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php echo ($meta_title); ?>|OpenSNS管理后台</title>
    <link href="/Public/favicon.ico" type="image/x-icon" rel="shortcut icon">
    <link rel="stylesheet" type="text/css" href="/Public/Admin/css/base.css" media="all">
    <link rel="stylesheet" type="text/css" href="/Public/Admin/css/common.css" media="all">
    <link rel="stylesheet" type="text/css" href="/Public/Admin/css/module.css">
    <link rel="stylesheet" type="text/css" href="/Public/Admin/css/style.css" media="all">
    <link rel="stylesheet" type="text/css" href="/Public/Admin/css/<?php echo (C("COLOR_STYLE")); ?>.css" media="all">
    <!--[if lt IE 9]>
    <script type="text/javascript" src="/Public/static/jquery-1.10.2.min.js"></script>
    <![endif]--><!--[if gte IE 9]><!-->
    <script type="text/javascript" src="/Public/static/jquery-2.0.3.min.js"></script>
    <script type="text/javascript" src="/Public/Admin/js/jquery.mousewheel.js"></script>
    <!--<![endif]-->
    
    <script type="text/javascript">
        var ThinkPHP = window.Think = {
            "ROOT": "", //当前网站地址
            "APP": "/index.php?s=", //当前项目地址
            "PUBLIC": "/Public", //项目公共目录地址
            "DEEP": "<?php echo C('URL_PATHINFO_DEPR');?>", //PATHINFO分割符
            "MODEL": ["<?php echo C('URL_MODEL');?>", "<?php echo C('URL_CASE_INSENSITIVE');?>", "<?php echo C('URL_HTML_SUFFIX');?>"],
            "VAR": ["<?php echo C('VAR_MODULE');?>", "<?php echo C('VAR_CONTROLLER');?>", "<?php echo C('VAR_ACTION');?>"],
            'URL_MODEL': "<?php echo C('URL_MODEL');?>",
            'WEIBO_ID': "<?php echo C('SHARE_WEIBO_ID');?>"
        }
    </script>
</head>
<body>
<!-- 头部 -->
<div class="header">
    <!-- Logo -->
    <a href="<?php echo U('Home/Index/index');?>" title="回到前台" target="_blank"><span class="logo"></span></a>
    <!-- /Logo -->

    <!-- 主导航 -->
    <ul class="main-nav">

        <?php if(is_array($__MENU__["main"])): $i = 0; $__LIST__ = $__MENU__["main"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menu): $mod = ($i % 2 );++$i;?><li class="<?php echo ((isset($menu["class"]) && ($menu["class"] !== ""))?($menu["class"]):''); ?>"><a href="<?php echo (u($menu["url"])); ?>"><?php echo ($menu["title"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
    </ul>
    <!-- /主导航 -->

    <!-- 用户栏 -->
    <div class="user-bar">
        <a href="javascript:;" class="user-entrance"><i class="icon-user"></i></a>
        <ul class="nav-list user-menu hidden">
            <li class="manager">你好，<em title="<?php echo session('user_auth.username');?>"><?php echo session('user_auth.username');?></em>
            </li>
            <li><a href="<?php echo U('User/updatePassword');?>">修改密码</a></li>
            <li><a href="<?php echo U('User/updateNickname');?>">修改昵称</a></li>
            <li><a href="<?php echo U('Public/logout');?>">退出</a></li>
        </ul>
    </div>
</div>
<!-- /头部 -->

<!-- 边栏 -->
<div class="sidebar">
    <!-- 子导航 -->
    
        <div id="subnav" class="subnav">
            <?php if(!empty($_extra_menu)): ?>
                <?php echo extra_menu($_extra_menu,$__MENU__); endif; ?>
            <?php if(is_array($__MENU__["child"])): $i = 0; $__LIST__ = $__MENU__["child"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sub_menu): $mod = ($i % 2 );++$i;?><!-- 子导航 -->
                <?php if(!empty($sub_menu)): if(!empty($key)): ?><h3><i class="icon icon-unfold"></i><?php echo ($key); ?></h3><?php endif; ?>
                    <ul class="side-sub-menu">
                        <?php if(is_array($sub_menu)): $i = 0; $__LIST__ = $sub_menu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menu): $mod = ($i % 2 );++$i;?><li>
                                <a class="item" href="<?php echo (u($menu["url"])); ?>"><?php echo ($menu["title"]); ?></a>
                            </li><?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul><?php endif; ?>
                <!-- /子导航 --><?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
    
    <!-- /子导航 -->
</div>
<!-- /边栏 -->

<!-- 内容区 -->
<div id="main-content">
    <div id="top-alert" class="fixed alert alert-error" style="display: none;">
        <button class="close fixed" style="margin-top: 4px;">&times;</button>
        <div class="alert-content">这是内容</div>
    </div>
    <div id="main" class="main">
        
            <!-- nav -->
            <?php if(!empty($_show_nav)): ?><div class="breadcrumb">
                    <span>您的位置:</span>
                    <?php $i = '1'; ?>
                    <?php if(is_array($_nav)): foreach($_nav as $k=>$v): if($i == count($_nav)): ?><span><?php echo ($v); ?></span>
                            <?php else: ?>
                            <span><a href="<?php echo ($k); ?>"><?php echo ($v); ?></a>&gt;</span><?php endif; ?>
                        <?php $i = $i+1; endforeach; endif; ?>
                </div><?php endif; ?>
            <!-- nav -->
        

        
    <link type="text/css" rel="stylesheet" href="/Public/Core/js/ext/magnific/magnific-popup.css"/>
    <!-- 标题 -->
    <div class="main-title">
        <h2>
            <?php echo (htmlspecialchars($title)); ?>
        </h2>
    </div>
    <?php foreach($searches as $search){ if($_REQUEST[$search['name']]) { $show=1; } } ?>

    <div style="margin-bottom: 10px;" <?php if(($show) == ""): ?>class="hidden"<?php endif; ?>id="search_form">

        <style>
            .tb_search td{
                padding: 5px 10px;
            }
        </style>
<form id="searchForm" method="get" action="<?php echo ($searchPostUrl); ?>" class="form-dont-clear-url-param">
    <div class="search-form  cf " style="margin-bottom: 10px">
        <table class="tb_search">

    <?php if(is_array($searches)): $i = 0; $__LIST__ = $searches;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$search): $mod = ($i % 2 );++$i;?><tr style="line-height: 28px">
                  <td>
                      <?php echo ($search["title"]); ?>
                  </td>
                  <td>
                      <input style="float: none" type="text" name="<?php echo ($search["name"]); ?>" class="search-input"
                             value="<?php echo I($search['name']);?>">
                  </td>
                  <td>
                      <?php echo ($search["des"]); ?>
                  </td>
              </tr><?php endforeach; endif; else: echo "" ;endif; ?>
            <tr><td></td>
                <td><input type="submit" class="btn" value="确定"/> <button class="btn ajax-post btn" onclick="toggle_search()">关闭</button></td>
                <td></td>
            </tr>
    </table>
        </div>
        </form>
        <div style="border-top:1px solid #ccc;border-bottom: 1px solid white"></div>
    </div>
    <!-- 按钮工具栏 -->
    <div class="cf">
        <div class="fl">
<?php if(count($searches) > 0): ?><button class="btn submit-btn" url="?status=-1" target-form="ids" style="padding: 6px 16px;" onclick="toggle_search()">搜索</button><?php endif; ?>

            <?php if(is_array($buttonList)): $i = 0; $__LIST__ = $buttonList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$button): $mod = ($i % 2 );++$i;?><<?php echo ($button["tag"]); ?> <?php echo ($button["attr"]); ?>><?php echo (htmlspecialchars($button["title"])); ?></<?php echo ($button["tag"]); ?>><?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
    </div>

    <!-- 数据表格 -->
    <div class="data-table">
        <table>
            <!-- 表头 -->
            <thead>
            <tr>
                <th class="row-selected row-selected">
                    <input class="check-all" type="checkbox"/>
                </th>
                <?php if(is_array($keyList)): $i = 0; $__LIST__ = $keyList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$field): $mod = ($i % 2 );++$i;?><th><?php echo (htmlspecialchars($field["title"])); ?></th><?php endforeach; endif; else: echo "" ;endif; ?>
            </tr>
            </thead>

            <!-- 列表 -->
            <tbody>
            <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$e): $mod = ($i % 2 );++$i;?><tr>
                    <td><input class="ids" type="checkbox" value="<?php echo ($e['id']); ?>" name="ids[]"></td>
                    <?php if(is_array($keyList)): $i = 0; $__LIST__ = $keyList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$field): $mod = ($i % 2 );++$i;?><td><?php echo ($e[$field['name']]); ?></td><?php endforeach; endif; else: echo "" ;endif; ?>
                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
            </tbody>
        </table>
    </div>
    <!-- 分页 -->
    <div class="page">
        <?php echo ($pagination); ?>
    </div>
    </div>

    <script type="text/javascript" src="/Public/static/thinkbox/jquery.thinkbox.js"></script>
    <script type="text/javascript">
//        //搜索功能
//        $("#search").click(function () {
//            var url = $(this).attr('url');
//            var query = $('.search-form').find('input').serialize();
//            query = query.replace(/(&|^)(\w*?\d*?\-*?_*?)*?=?((?=&)|(?=$))/g, '');
//            query = query.replace(/^&/g, '');
//            if (url.indexOf('?') > 0) {
//                url += '&' + query;
//            } else {
//                url += '?' + query;
//            }
//            window.location.href = url;
//        });
        //回车搜索
//        $(".search-input").keyup(function (e) {
//            if (e.keyCode === 13) {
//                $("#search").click();
//                return false;
//            }
//        });
        function toggle_search(){
            $('#search_form').toggle('slide');
        }


        $(document).on('submit', '.form-dont-clear-url-param', function(e){
            e.preventDefault();

            var seperator = "&";
            var form = $(this).serialize();
            var action = $(this).attr('action');
            if(action == ''){
                action = location.href;
            }
            var new_location = action + seperator + form;

            location.href = new_location;

            return false;
        });


    </script>


    <script>
        $(function(){
            $('.tox-confirm').click(function(e){
                var text = $(this).attr('data-confirm');
                var result = confirm(text);
                if(result) {
                    return true;
                } else {
                    e.stopImmediatePropagation();
                    e.stopPropagation();
                    e.preventDefault();
                    return false;
                }
            })
        });


        $(document).ready(function () {

            $('.popup-gallery').each(function () { // the containers for all your galleries
                $(this).magnificPopup({
                    delegate: 'a',
                    type: 'image',
                    tLoading: '正在载入 #%curr%...',
                    mainClass: 'mfp-img-mobile',
                    gallery: {
                        enabled: true,
                        navigateByImgClick: true,
                        preload: [0, 1] // Will preload 0 - before current, and 1 after the current image

                    },
                    image: {
                        tError: '<a href="%url%">图片 #%curr%</a> 无法被载入.',
                        titleSrc: function (item) {
                            /*           return item.el.attr('title') + '<small>by Marsel Van Oosten</small>';*/
                            return '';
                        },
                        verticalFit: false
                    }
                });
            });
        });
    </script>
    <script type="text/javascript" src="/Public/Core/js/ext/magnific/jquery.magnific-popup.min.js"></script>

    </div>
    <div class="cont-ft">
        <div class="copyright">
            <div class="fl">感谢使用<a href="http://tox.ourstu.com/" target="_blank">OpenSNS</a>社交框架 <a target="_blank" href="http://www.ourstu.com">嘉兴想天信息科技有限公司</a>&nbsp;&nbsp;&nbsp;|</div>
            <div class="fr">OpenSNS V1</div>
            <div class="fl">&nbsp;&nbsp;&nbsp;本程序基于<a href="http://www.onethink.cn/" target="_blank">OneThink</a>开发<a href="http://www.topthink.net/" target="_blank">上海顶想信息科技公司</a></div>
            <div class="fr"></div>
        </div>
    </div>
</div>
<!-- /内容区 -->
<script type="text/javascript">
    (function () {
        var ThinkPHP = window.Think = {
            "ROOT": "", //当前网站地址
            "APP": "/index.php?s=", //当前项目地址
            "PUBLIC": "/Public", //项目公共目录地址
            "DEEP": "<?php echo C('URL_PATHINFO_DEPR');?>", //PATHINFO分割符
            "MODEL": ["<?php echo C('URL_MODEL');?>", "<?php echo C('URL_CASE_INSENSITIVE');?>", "<?php echo C('URL_HTML_SUFFIX');?>"],
            "VAR": ["<?php echo C('VAR_MODULE');?>", "<?php echo C('VAR_CONTROLLER');?>", "<?php echo C('VAR_ACTION');?>"]
        }
    })();
</script>
<script type="text/javascript" src="/Public/static/think.js"></script>
<script type="text/javascript" src="/Public/Admin/js/common.js"></script>
<script type="text/javascript">
    +function () {
        var $window = $(window), $subnav = $("#subnav"), url;
        $window.resize(function () {
            $("#main").css("min-height", $window.height() - 130);
        }).resize();

        /* 左边菜单高亮 */
        url = window.location.pathname + window.location.search;
        url = url.replace(/(\/(p)\/\d+)|(&p=\d+)|(\/(id)\/\d+)|(&id=\d+)|(\/(group)\/\d+)|(&group=\d+)/, "");
        $subnav.find("a[href='" + url + "']").parent().addClass("current");

        /* 左边菜单显示收起 */
        $("#subnav").on("click", "h3", function () {
            var $this = $(this);
            $this.find(".icon").toggleClass("icon-fold");
            $this.next().slideToggle("fast").siblings(".side-sub-menu:visible").
                    prev("h3").find("i").addClass("icon-fold").end().end().hide();
        });

        $("#subnav h3 a").click(function (e) {
            e.stopPropagation()
        });

        /* 头部管理员菜单 */
        $(".user-bar").mouseenter(function () {
            var userMenu = $(this).children(".user-menu ");
            userMenu.removeClass("hidden");
            clearTimeout(userMenu.data("timeout"));
        }).mouseleave(function () {
                    var userMenu = $(this).children(".user-menu");
                    userMenu.data("timeout") && clearTimeout(userMenu.data("timeout"));
                    userMenu.data("timeout", setTimeout(function () {
                        userMenu.addClass("hidden")
                    }, 100));
                });

        /* 表单获取焦点变色 */
        $("form").on("focus", "input",function () {
            $(this).addClass('focus');
        }).on("blur", "input", function () {
                    $(this).removeClass('focus');
                });
        $("form").on("focus", "textarea",function () {
            $(this).closest('label').addClass('focus');
        }).on("blur", "textarea", function () {
                    $(this).closest('label').removeClass('focus');
                });

        // 导航栏超出窗口高度后的模拟滚动条
        var sHeight = $(".sidebar").height();
        var subHeight = $(".subnav").height();
        var diff = subHeight - sHeight; //250
        var sub = $(".subnav");
        if (diff > 0) {
            $(window).mousewheel(function (event, delta) {
                if (delta > 0) {
                    if (parseInt(sub.css('marginTop')) > -10) {
                        sub.css('marginTop', '0px');
                    } else {
                        sub.css('marginTop', '+=' + 10);
                    }
                } else {
                    if (parseInt(sub.css('marginTop')) < '-' + (diff - 10)) {
                        sub.css('marginTop', '-' + (diff - 10));
                    } else {
                        sub.css('marginTop', '-=' + 10);
                    }
                }
            });
        }
    }();
</script>

</body>
</html>