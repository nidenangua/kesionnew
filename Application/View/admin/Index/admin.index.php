<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit">
<title>科汛V名师-运营总后台</title>
<meta name="Keywords" content=""/>
<meta name="Description" content=""/> 
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit">
<link href="<?php echo UOOT; ?>Public/common/css0/kesion-common.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT; ?>Public/common/css0/cont.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT; ?>Public/common/css0/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT; ?>Public/common/css0/font-awesome.min.css?<?php echoHash(); ?>" rel="stylesheet" />
<style type="text/css">
	.countbox{
		color: red;
    padding: 3px 5px 3px 5px;
    background: #fff;
    border-radius: 50%;
    margin-left: 10px;
	}
</style>
</head>
<body  style="min-width: 1280px;">
<div class="header bg-255">
    <a href="<?php echo M_URL('Index','mainfirst'); ?>" target="main">
    <div class="logo f-l bg-main" id="logo">
    	<div href="javascript:;" style="margin:10px 0px 0px 0px;line-height: 60px;">
    		<img src="/Images/admin/logo.png" alt="">
		</div>
    </div>
	</a>
	<div class="f-l" style="background:#30373F;">
		<div class="btn" onClick="pullBack()">
	    	<i class="fa fa-indent" style="font-size: 20px;"></i>
	    </div>
	    <a style="color: #FFFFFF;" href="<?php echo M_URL('Index', 'delcache'); ?>" >清空缓存</a>
	</div>
    <!-- 搜索框  -->
    <!--<form target="hidframe" class="navbar-form navbar-left input-s-lg m-t m-l-n-xs hidden-xs" role="search">
        <div class="form-group">
        <div class="input-group">
        <span class="input-group-btn">
          <button type="submit" class="btn btn-sm bg-white btn-icon rounded" style="color:#788188"><i class="fa fa-search"></i></button>
        </span>
          <input type="text" class="form-control input-sm no-border rounded" placeholder="Search songs, albums...">
        </div>
        </div>
    </form>-->
    <!-- end   -->
    
    <div class="user-info f-r p-relative" id="user-info">
        <span class="avatar f-r">
<img src="https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1493793770198&di=7d05a88498f21c6ebf9fb5cec111c5ec&imgtype=0&src=http%3A%2F%2Fww2.sinaimg.cn%2Fthumb300%2F0065HoG6gw1f78qx1m52uj30ku0kunew.jpg"/></span>
        <span class="name fz-14 c-255">
        	<?php echo $this->admininfo['username']; ?>
        	<!--<i class="fa fa-caret-down"></i>-->
        </span>
        <div class="user-menu p-absolute bg-255 d-none">
            <ul>
                <li><a href="#">用户管理</a></li>
                <li><a href="#">营销记录</a></li>
                <li><a href="<?php echo M_URL('Login', 'changePassword'); ?>" target="main">修改密码</a></li>
                <li class="logout"><a href="<?php echo M_URL('Login', 'logout'); ?>">退出</a></li>
            </ul>
        </div>
    </div>
</div><!--header-->

<div class="wrapper p-relative o-hidden">
    <div class="nav p-fixed" id="nav">
        <!--	<div class="title">导航菜单</div>-->
        <ul>
            <li>
                <div class="column-name ">
                	<a href="<?php echo M_URL('Index', 'mainfirst'); ?>" target="main" style="color: #FFF; display: block;">
                		<i class="iconfont icon-fangzi"></i></i>
                		<span class="text">主页</span>
                	</a>
                </div>
            </li>
          <?php //if (checkAdminPower('sys_money','root')){?>
            <li class="on">
               <div class="column-name active" data-flag="1"><i class="fa fa-angle-down"></i><i class="iconfont icon-qianbao"></i><span class="text">财务管理</span></div>
                <div class="sub-box d-none" style="display: block;">
                    <?php if (checkAdminPower('Domain','clientList')){?>
                        <a href="<?php echo M_URL('Domain','clientList','',GP('')); ?>" target="main">客户管理</a>
                    <?php } ?>
                    <?php if (checkAdminPower('Paylog','wxpaylog')){?>
				    	<a href="<?php echo M_URL('Paylog','wxpaylog'); ?>" target="main">网校流水</a>
                    <?php
                      }?>
                    <?php if (checkAdminPower('Paylog')){?>
                    <a href="<?php echo M_URL('Paylog'); ?>" target="main">平台流水</a>
                    <?php
                      }
                      ?>
                    <?php if (checkAdminPower('Paylog','livecurrency')){?>
					<a href="<?php echo M_URL('Paylog','livecurrency'); ?>" target="main">直播币流水</a>
                    <?php
                          }
                     ?>
                     <?php if (checkAdminPower('Capital')){?>
                    <a href="<?php echo M_URL('Capital'); ?>" target="main">提现管理</a>
                    <?php } ?>
                <!--<a href="<?php echo M_URL('Capital\spreadindex'); ?>" target="main">分销提现管理</a>
                    <a href="<?php echo M_URL('Service','orderList'); ?>" target="main">订单管理（消费明细）</a>
                    <a href="<?php echo M_URL('Order','Orderdata','',GP('')); ?>" target="main">数据统计</a> 
                    <a href="<?php echo M_URL('sms/Index','index','',GP('appid-17')); ?>" target="main">短信明细</a>
                    <a href="<?php echo M_URL('email/Index','index','',GP('appid-18')); ?>" target="main">邮件明细</a>
                    <a href="<?php echo M_URL('order/Index','index','',GP('appid-4')); ?>" target="main">订单明细</a>
                    <a href="<?php echo M_URL('classroom/Index','index','',GP('appid-29')); ?>" target="main">校区管理</a>
                    <a href="<?php echo M_URL('notification/Index','index','',GP('appid-28')); ?>" target="main">消息中心</a>
                    <a href="<?php echo M_URL('Flow'); ?>" target="main">流量管理</a>
                    <a href="<?php echo M_URL('News'); ?>" target="main">消息管理</a>
                    <a href="<?php echo M_URL('Coupon'); ?>" target="main">优惠券管理</a>-->
                </div>
            </li>
            <?php// } ?>
            <?php //if (checkAdminPower('sys_user','root')){?>
            <li>
                <div class="column-name" data-flag="0"><i class="fa fa-angle-left"></i>
                	<i class="iconfont icon-kehu"></i><span class="text">用户管理</span>
                </div>
                <div class="sub-box d-none">
                    <?php if (checkAdminPower('Domain','wxlist')){?>
				    <a href="<?php echo M_URL('Domain','wxlist','',GP('')); ?>" target="main">网校管理</a>
                     <?php 
                      }
                    ?>
                    <?php if (checkAdminPower('Users','index')){?>
                    <a href="<?php echo M_URL('Users','index','',GP('usertype-3')); ?>" target="main">其他用户</a>
                    <?php 
                          }
                    ?>
                     <?php if (checkAdminPower('Users','realName')){?>
                    <a href="<?php echo M_URL('Users','realName','',GP('')); ?>" target="main">实名审核<?php if($COUNT){?><span class="countbox"><?php echo $COUNT;?></span><?php }?></a>
                     <?php 
                          }
                    ?>
                     <?php if (checkAdminPower('Domain','index')){?>
                   	<a href="<?php echo M_URL('Domain');?>" target="main">域名管理</a>
                     <?php 
                          }
                    ?>
                     <?php if (checkAdminPower('Domain','smslist')){?>
                    <a href="<?php echo M_URL('Domain','smslist','',GP(''));?>" target="main">短信审核</a>
                     <?php 
                           }
                     ?>
                    <?php if (checkAdminPower('Users','cardGroup')){?>
                        <a href="<?php echo M_URL('Users','cardGroup','',GP(''));?>" target="main">名片组管理</a>
                        <?php
                    }
                    ?>
                    <?php if (checkAdminPower('Users','cardUser')){?>
                        <a href="<?php echo M_URL('Users','cardUser','',GP(''));?>" target="main">名片用户管理</a>
                        <?php
                    }
                    ?>
                </div>
            </li>
            <?php //}?>
             <?php if (checkAdminPower('sys_market','root')){?>
            <li>
                <div class="column-name" data-flag="0"><i class="fa fa-angle-left"></i>
                <i class="iconfont icon-gouwudai"></i><span class="text">应用市场</span></div>
                <div class="sub-box d-none">
                     <?php if (checkAdminPower('App','index')){?>
                    <a href="<?php echo M_URL('App'); ?>" target="main">云应用市场</a>
                    <?php } ?>
                     <?php if (checkAdminPower('temp','index')){?>
                    <a href="<?php echo M_URL('Temp'); ?>" target="main">风格模板</a>
                    <?php } ?>
                     <?php if (checkAdminPower('H5market','schemelist')){?>
                	<a href="<?php echo M_URL('H5market\schemelist'); ?>" target="main">营销管理</a>     
                    <?php } ?>
                </div>
            </li>
             <?php }?>
             <?php if (checkAdminPower('sys_zygl','root')){?>
            <li>
                <div class="column-name" data-flag="0"><i class="fa fa-angle-left"></i>
                	<i class="iconfont icon-dingdan"></i><span class="text">资源管理</span>
                </div>
                <div class="sub-box d-none">
                     <?php if (checkAdminPower('vdo','index')){?>
                    <a href="<?php echo M_URL('Vdo'); ?>" target="main">视频管理</a>
                    <?php } ?>
                     <?php if (checkAdminPower('vdo','oss')){?>
					<a href="<?php echo M_URL('Vdo','Oss'); ?>" target="main">对象存储</a>
                    <?php } ?>
                     <?php if (checkAdminPower('ico','index')){?>
                    <a href="<?php echo M_URL('Ico');?>" target="main">图标管理</a>
                    <?php } ?>
                    <!--<a href="<?php echo M_URL('Domain','imageslist');?>" target="main">图库管理</a>-->
                </div>
            </li>
            <?php }?>
             <?php if (checkAdminPower('sys_content','root')){?>
		    <li>
                <div class="column-name" data-flag="0"><i class="fa fa-angle-left"></i>
                	<i class="iconfont icon-dingdan"></i><span class="text">内容发布</span>
                </div>
                <div class="sub-box d-none">

                        <!-- 
                            <a href="<?php echo M_URL('Offweb','Dailyinfo');?>" target="main">每日资讯</a>
                         -->
                       <?php if (checkAdminPower('Offweb','Case')){?>
			           <a href="<?php echo M_URL('Offweb','Case');?>" target="main">客户案例</a>
                    <?php } ?>
                     <?php if (checkAdminPower('Offweb','Question')){?>
                    <!--
			           <a href="<?php echo M_URL('Offweb','Question');?>" target="main">问题解答</a>
                        -->
                    <?php } ?>
                     <?php if (checkAdminPower('Offweb','Helpcenter')){?>
			           <a href="<?php echo M_URL('Offweb','Helpcenter');?>" target="main">帮助中心</a>
                     <?php } ?>

                     <?php if (checkAdminPower('Content','feedBackList')){?>
                   	<a href="<?php echo M_URL('Content','feedBackList','',GP(''));?>" target="main">意见反馈管理</a>
                    <?php } ?>
                    <!--
                     <?php if (checkAdminPower('Content','developList')){?>
                   	<a href="<?php echo M_URL('Content','developList','',GP(''));?>" target="main">最新开发动态</a>
                     <?php } ?>
                    -->
                     <?php if (checkAdminPower('Interface','index')){?>
                    <a href="<?php echo M_URL('Interface'); ?>" target="main">API接口管理</a>
                    <?php } ?>
                    <?php if (checkAdminPower('Apiwiki','index')){?>
                    <a href="<?php echo M_URL('Apiwiki'); ?>" target="main">API文档管理</a>
                    <?php } ?>
                    <?php if (checkAdminPower('Task','index')){?>
                    <a href="<?php echo M_URL('Task'); ?>" target="main">任务管理</a>
                    <?php } ?>
                </div>
            </li>
             <?php }?>
             <?php if (checkAdminPower('sys_setting','root')){?>
            <li>
                <div class="column-name" data-flag="0"><i class="fa fa-angle-left"></i><i
                        class="iconfont icon-shezhi"></i><span class="text">配置管理</span></div>
                <div class="sub-box d-none">
                    <?php if (checkAdminPower('Setting','index')){?>
                    <a href="<?php echo M_URL('Setting'); ?>" target="main">平台配置</a>
                    <?php } ?>
                    <?php if (checkAdminPower('Admin','index')){?>
                    <a href="<?php echo M_URL('Admin'); ?>" target="main">管理员管理</a>  
                    <?php } ?>
                    <?php if (checkAdminPower('Domain','package')){?>
                    <a href="<?php echo M_URL('Domain','package');?>" target="main">套餐配置</a>
                    <?php } ?>
                    <?php if (checkAdminPower('UsersCategory','index')){?>
                    <a href="<?php echo M_URL('UsersCategory'); ?>" target="main">专业管理</a>
                    <?php } ?>
                    <?php if (checkAdminPower('Setting','poster')){?>
                    <a href="<?php echo M_URL('Setting','poster'); ?>" target="main">海报管理</a>
                    <?php } ?>
                </div>
            </li>
            <?php
               }
          ?>
             <!--<li>
                <div class="column-name" data-flag="0"><i class="fa fa-angle-left"></i><i class="fa fa-stack-overflow"></i><span
                        class="text">微信管理</span></div>
                <div class="sub-box d-none">
                    <a href="<?php echo M_URL('Wxmp'); ?>" target="main">微信公众号配置</a>
                    <a href="<?php echo M_URL('Wxmp', 'fans_list'); ?>" target="main">粉丝列表</a>
                    <a href="<?php echo M_URL('Wxmp', 'msg_reply'); ?>" target="main">微信关注回复</a>
                    <a href="<?php echo M_URL('Wxmp', 'add_material'); ?>" target="main">微信素材管理</a>
                </div>
            </li>-->
        </ul>
    </div>

    <div class="row J_mainContent" id="content-main">
        <iframe id="J_iframe" class="J_iframe" name="main" width="100%" height="100%" src="<?php echo M_URL('Index', 'mainfirst');?>" frameborder="0" ></iframe>
    </div>
</div>
<script src="<?php echo UOOT; ?>Public/common/js/module.js?<?php echo echoHash();?>"></script>

<script>
	module.require(['$','Zpopup','nicescroll'],function(){
		$("#nav").niceScroll({
	        cursorcolor: "rgba(0,0,0,0.3)",
	        cursoropacitymax: 1,
	        touchbehavior: false,
	        cursorwidth: "6px",
	        cursorborder: "0",
	        cursorborderradius: "30px"
	    });
	    $(function () {
	        hAuto();
	        var speed = 200;
	        $('#nav').on('click', '.column-name', function () {
	            $('#logo').removeClass('logo-small');
	            $('#nav').removeClass('nav-small');
	            var flag = $(this).attr('data-flag');
	            if (flag == 0) {
	                $(this).find('.fa').removeClass('fa-angle-left').addClass('fa-angle-down');
	                $(this).parent().siblings().find('.column-name .fa').removeClass('fa-angle-down').addClass('fa-angle-left');
	                $(this).siblings('.sub-box').stop().slideDown(speed);
	                $(this).attr('data-flag', '1');
	                $(this).parent().addClass('on').siblings().removeClass('on');
	            } else {
	                $(this).find('.fa').removeClass('fa-angle-down').addClass('fa-angle-left')
	                $(this).siblings('.sub-box').stop().slideUp(speed);
	                $(this).attr('data-flag', '0');
	                $(this).parent().removeClass('on');
	            }
	            ;
	            $(this).addClass('active').parent().siblings().find('.column-name').removeClass('active');
	            $(this).parent().siblings().find('.column-name').attr('data-flag', '0');
	            $(this).parent().siblings().find('.sub-box').stop().slideUp(speed);
	        }).on('click', '.sub-box a', function () {
	            $(this).addClass('active').siblings().removeClass('active').parents('li').siblings().find('.sub-box a').removeClass('active');
	
	        });
	        var userInfoFlag = true;
	        $('#user-info').click(function (e) {
	            var $t = $(this);
	            if (userInfoFlag == true) {
	                $t.addClass('active');
	                $t.find('.user-menu').fadeIn(speed);
	                userInfoFlag = false;
	            } else {
	                $t.removeClass('active');
	                $t.find('.user-menu').stop().fadeOut(speed);
	                userInfoFlag = true;
	            }
	            ;
	            e.stopPropagation();
	            $(document).click(function () {
	                $t.removeClass('active');
	                $t.find('.user-menu').stop().fadeOut(speed);
	                userInfoFlag = true;
	            });
	
	        });
	    });
	    $(window).resize(function () {
	        hAuto();
	    });
	})
    
    function hAuto() {
        var h = $(window).height() - $('.header').height();
        $('.wrapper,#J_iframe,#nav').height(h);
    }
    ;
    //左菜单收缩
    function pullBack() {
        $('#logo').toggleClass('logo-small');
        $('#nav').toggleClass('nav-small');
    }
    ;
</script>

</body>
</html>
