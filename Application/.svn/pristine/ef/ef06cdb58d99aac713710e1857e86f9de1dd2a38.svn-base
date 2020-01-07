<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit">
<link rel="stylesheet" type="text/css" href="<?php echo UOOT;?>Public/app/css/login.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo UOOT;?>Public/app/css/base.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo UOOT;?>Public/app/css/page.animate.css"/>
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
<script src="<?php echo UOOT;?>Public/common/js/jquery.validate.min.js"></script>
<script src="<?php echo UOOT;?>Public/common/js/messages_zh.min.js"></script>
<title>登陆页面</title>
</head>
<body>
    <!--头部-->
    <div class="l-info">
        <div class="in-head-top">
            <div class="mainbox clr">
                <div class="in-htop-left">
                    <ul class="in-htop-ul clr">
                        <li><i class="iconfont">&#xe088;</i><label>0592-7582568</label></li>
                        <li>|</li>	    					
                        <li><i class="iconfont">&#xe026;</i><label>厦门市思明区观音山16号楼806</label></li>
                        <li>|</li>
                        <li><i class="iconfont">&#xe089;</i><label>联系客服</label></li>	    							
                        <div class="clear"></div>
                    </ul>	    						
                </div>
                <div class="in-htop-right">
                    <span class="htop-login">
                        <a href="<?php echo M_URL('Register'); ?>">开通网校</a>
                        <i></i>
                        <a href="/">首页</a>
                    </span>	    						
                </div>
                <div class="clear"></div>
            </div>	    		
        </div>
    </div>
    <!--主体-->
    <div class="login-content">
        <div class="mainbox clr">
            <div class="login-content-l fl">
                <p class="p1 page-animate" data-delay="0.1">您还不是科汛网校会员？</p>
                <p class="p2 page-animate" data-delay="0.2">只要10秒，免费注册成为我们的会员！</p>
                <div class="btn-wrap page-animate" data-delay="0.3">
                    <a href="<?php echo M_URL('Register'); ?>" class="for-reg">立即注册</a>
                </div>
            </div>
                <!--pc端页面输入登陆-->
            <div class="login-wrap fr page-animate" data-delay="0.1" data-type="bounceInRight">
                <div class="login-content-r">
                    <p class="info-title">账号登录</p>
                    <div class="login-info clr" align="center">
                        <form target="hidframe" action="<?php echo M_URL('Login','sigin'); ?>" method="post" class="form-horizontal">
                        	<input type="text" style="display:none" name="username">
                            <input type="text" name="username" id="telText" class="user" placeholder="请输入用户名\手机号" autocomplete="new-password"/>
                            <input type="password" name="password" id="password" class="password" placeholder="请输入密码" />
                            <div class="cook clr">
                                <div class="fl">
                                    <input type="checkbox" name="" id="forRemember" value="" class="remember" checked="checked"/>
                                    <label for="forRemember" class="remember-mark" style="display: none;">记住我的登陆信息</label>
                                    <label for="forRemember"  class="safe">请勿在公用电脑上勾选此选项</label>
                                </div>
                                <div class="fr">
                                    <a href="javascript:;"class="forget">忘记密码？</a>
                                </div>
                            </div>
                            <button type="submit" class="login">立即登录</button>
                            <p class="und"></p>
                            <div class="apilogin clr">
                            <div class="name">使用合作网站账号登录</div>
                            <?php $loginconf = $this->cache->GetACache('loginconf');foreach($loginconf as $k=>$v){if($v['status']==1){ ?>
                    <a href="<?php echo M_URL('Login','apilogin',$v['id']);?>"><img onerror="this.src='<?php echo nopic();?>'" src="<?php echo UOOT;?>Public/app/images/login/icon_qq.png" align="absmiddle" title="微信登录"/></a>
                            <?php }} ?>   
                            </div>
                        </form>
                    </div>
                <div class="log-wx" onclick="showWx()"></div>
                </div>
                <!--微信扫码登陆-->
                <div class="login-code">
                    <div class="log-pc" onclick="showPc()"></div>
                    <div class="code-box">
                        <h3>微信扫码，安全登录</h3>
                        <img src="<?php echo UOOT;?>Public/app/images/login/wx-code.png"/>
                        <div class="wx-login"><i></i> <span>打开手机扫一扫登录</span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--底部-->
    <div class="m-foot">
          <div class="m-foot-top">
              <div class="m-foot-box clr">
                  <div class="m-foot-info">
                     <div class="m-foot-text">关注我们</div>
                     <div class="m-foot-code">
                       <img src="<?php echo UOOT;?>Public/app/images/login/code.png">
                     </div>
                  </div>
                  <div class="m-foot-list clr">
                    <ul class="m-fooot-ult clr">
                        <li><a href="/a/1255.aspx">公司介绍</a>|</li>
                        <li><a href="/a/1256.aspx">联系我们</a>|</li>
                        <li><a href="/a/1257.aspx">法律条款</a>|</li>
                        <li><a href="/a/1258.aspx">招募英才</a>|</li>
                        <li><a href="/a/1259.aspx">免责声明</a></li>
                      
                    </ul>
                    <div class="m-foot-com">Powered By KesionEDU V4.5 正式版 www.kesion.com inc .<br />厦门科汛软件有限公司版权所有 ? 2006-2017 </div>
                  </div>
                
              </div>
          </div>
          <div class="m-foot-bottom">
            <div class="m-foot-box">
              <ul class="m-fooot-uld clr">
                  <span class="fl">友情链接:</span>
                  <li><a href="http://demo.kesion.com" linkref="18" title="KesionCMS演示" target="_blank">KesionCMS演示</a>|</li>
                  <li><a href="http://www.kesioncom" linkref="24" title="科兴官方" target="_blank">科兴官方</a>|</li>
                  <li><a href="http://eshop.kesion.com/" linkref="27" title="KESION电商平台" target="_blank">KESION电商平台</a>|</li>
              </ul> 
            </div>
          </div>
        </div>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script>
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
</script>
</body>
</html>