<!DOCTYPE HTML>
<html>
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="renderer" content="webkit" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <link rel="stylesheet" type="text/css" href="<?php echo UOOT;?>Public/mobile/css/login.css?<?php echoHash(); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo UOOT;?>Public/mobile/css/base.css?<?php echoHash(); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo UOOT;?>Public/mobile/css/page.animate.css?<?php echoHash(); ?>" />
    <link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
    <script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
    <script src="<?php echo UOOT;?>Public/common/js/jquery.validate.min.js"></script>
    <script src="<?php echo UOOT;?>Public/common/js/messages_zh.min.js"></script>
    <title>科汛V名师管理登录中心</title>
</head>
<body>
    
    <div class="login-content">
        <div class="mainbox clr">
            <div class="l-g clr">

                <!--pc端页面输入登陆-->
                <div class="col-12">
                    <div class="login-center">
                        <div class="login-logo">
                            <a href="<?php echo UOOT;?>">
                                <img src="<?php echo UOOT;?>Public/app/images/login/logo.png" />
                            </a>
                        </div>

                        <div class="login-wrap page-animate" data-delay="0.1" data-type="bounceInRight">
                            <div class="login-content-r">
                                <p class="info-title">账号登录</p>
                                <div class="login-info clr" align="center">
                                    <form target="hidframe" id="myform" action="" method="post" class="form-horizontal">
                                        <input type="hidden" name="openid" value="<?php echo(KS_S('get.openid'));?>" />
                                        <input type="hidden" name="unionid" value="<?php echo(KS_S('get.unionid'));?>" />
                                        <div class="login-border">
                                            <i class="user-icon"></i>
                                            <input type="text" name="username" id="telText" class="user" placeholder="请输入手机号" autocomplete="new-password" />
                                        </div>
                                        <div class="login-border">
                                            <i class="pass-icon"></i>
                                            <input type="password" name="password" id="password" class="password" placeholder="请输入密码" />
                                        </div>
                                        <div class="cook clr">
                                            <div class="fl">
                                                <input type="checkbox" name="" id="forRemember" value="" class="remember" checked="checked" />
                                                <label for="forRemember" class="remember-mark" style="display: none;">记住我的登陆信息</label>
                                                <label for="forRemember" class="safe">公用场所请勿勾选</label>
                                            </div>
                                            <div class="fr">
                                                <a href="/getpassword" class=" forget">忘记密码？</a>
                                            </div>
                                        </div>
                                        <button type="button" onclick="do_login();" class="login">立即登录</button>
                                        <a class="login login-reg" href="/register">立即注册</a>
                                        <p class="und"></p>
                                        <div class="apilogin clr" style="display: none;">
                                            <div class="name">使用合作网站账号登录</div>
                                            <?php $loginconf = $this->cache->GetACache('loginconf');foreach($loginconf as $k=>$v){
                                                      if($v['status']==1){ ?>
                                            <a href="<?php echo M_URL('Login','apilogin',$v['id']);?>">
                                                <img onerror="this.src='<?php echo nopic();?>'" src="<?php echo UOOT;?>Public/app/images/login/icon_qq.png" align="absmiddle" title="微信登录" />
                                            </a>
                                            <?php }
                                                  } ?>
                                        </div>
                                    </form>
                                </div>
                                <div class="log-wx" onclick="showWx()" style="display: none;"></div>
                            </div>
                            <!--微信扫码登陆-->
                            <div class="login-code">
                                <div class="log-pc" onclick="showPc()"></div>
                                <div class="code-box">
                                    <h3>微信扫码，安全登录</h3>
                                    <img src="<?php echo UOOT;?>Public/app/images/login/wx-code.png" />
                                    <div class="wx-login">
                                        <i></i>
                                        <span>打开手机扫一扫登录</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



        </div>

        <div class="foot" style="display: block;">
            <?php if (isMobile()==false){ ?>
            <div class="link-wrap">
                <a class="link-item" href="http://www.kesion.cn/" target="_blank">公司介绍</a>
                <a class="link-item" href="http://www.kesion.cn/culture/" target="_blank">企业文化</a>
                <a class="link-item" href="http://www.kesion.cn/en_news/" target="_blank">公司动态</a>
                <a class="link-item" href="http://www.kesion.cn/joinus/" target="_blank">诚聘英才</a>
                <a class="link-item" href="/<?php echo(KS_C("DEFAULT_MODULE"));?>/apiword">开发文档</a>
                <a class="link-item" href="/<?php echo(KS_C("DEFAULT_MODULE"));?>/apiinfo">接口调试</a>
                <a class="link-item" href="/<?php echo(KS_C("DEFAULT_MODULE"));?>/help">帮助中心</a>
            </div>
            <?php }?>
            <div class="copyright">
                <script>
      				var copyRight = new Date();
      				update = copyRight.getFullYear();
      				document.write("厦门科汛软件有限公司版权所有©2006-"+update+"")
                </script>
            </div>
        </div>
    </div>

    <script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
    <script>
pageAnimate('.page-animate');
function showWx(){
$('.login-code').fadeIn(500);
$('.login-content-r').fadeOut(500);
};
function showPc(){
$('.login-code').fadeOut(500);
$('.login-content-r').fadeIn(500);
};
$('.cook').find('#forRemember').click(function(){
	if($("#forRemember").is(":checked")){
		$('.cook').find('.safe').show();
		$('.cook').find('.remember-mark').hide();
	}
	else{
		$('.cook').find('.safe').hide();
		$('.cook').find('.remember-mark').show();
	}
})
function do_login(){
	var username = $('input[name="username"]').val();
	if(username==''){Alert('请输入用户名\\手机号');return false;}
	var password = $('input[name="password"]')[0].value;
	if(password==''){Alert('密码不能为空');return false;}
	if(password.length<6||password.length>20){Alert('密码6-20字');return false;}
	$.ajax({
		type:"post",
		url:'<?php echo M_URL('Login','presigin'); ?>',
		data:{
		     'username':username,
		     'password':password
		},
		success:function(data){
		   if(data.result=='succeed'){
        		location.href=data.url;
		   }else{
				$('body').append(data);
		   }
		},
	    error:function(){

		}
	});
}
$(document).keypress(function(e) {// 回车键事件
    if(e.which == 13) {do_reg()}
});
var minHeight =  $(window).height()-$('.header2').height()-2;
$('.login-content').css({"minHeight":minHeight});
window.onresize=function(){
	var minHeight =  $(window).height()-$('.header2').height()-2;
	$('.login-content').css({"minHeight":minHeight});
	changeMargin()
}
//动态判断高度
function changeMargin(){
	var winHeight = window.innerHeight;//视窗高度
	var headerHeight = $('.header2').height();//头部高度
	var bottomHeight = $('.foot').height();
	var lgContentHeight = $('.l-g').height();//主体的高度
	var marginNumber = 0
	if(window.innerWidth<=992){
		marginNumber = (winHeight-headerHeight-bottomHeight-lgContentHeight)/2;
		if(marginNumber<=0){
			marginNumber = 50
		}
	}else{
		marginNumber = (winHeight-headerHeight-bottomHeight-30-lgContentHeight)/2;
		console.log(marginNumber)
		if(marginNumber<=100){
			marginNumber = 180
		}
	}
	// $('.l-g').css({"marginTop":marginNumber})
	 var lgOffsetTop = $('.l-g').offset().top;//主题内容偏移量
	 var footOffsetTop = $('.foot').offset().top;//底部内容偏移量
	 if(footOffsetTop-(lgOffsetTop+lgContentHeight)<=50){
	 	//如果两者距离小于50的话则底部默认取消掉绝对定位
	 	$('.foot').css({"position":'static',"marginTop":'50px'})

	 }
}
changeMargin()
    </script>
</body>
</html>