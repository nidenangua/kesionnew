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
<title>注册页面</title>
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
                <a href="<?php echo M_URL('Login');?>">登录</a>
                <i></i>
                <a href="/">首页</a>
            </span>	    						
        </div>
        <div class="clear"></div>
    </div>	    		
</div>
</div>
    <!--头部结束-->
    <!--主体-->
    <div class="login-content">
        <div class="mainbox clr">
            <!--主体左边-->
            <div class="login-content-l fl">
                <p class="p1 page-animate" data-delay="0.1">我已经是科汛网校会员？</p>
                <p class="p2 page-animate" data-delay="0.2">成为我们的会员可以参加各种互动！</p>
                <div class="page-animate btn-wrap" data-delay="0.3">
                    <a href="<?php echo M_URL('Login');?>" class="for-reg" >立即登录</a>
                </div>
            </div>
            <!--主体右边-->
            <div class="login-wrap fr page-animate" data-delay="0.1" data-type="bounceInRight" style="height: 500px;">
                <div class="login-content-r">
                    <p class="info-title">注册账号</p>
                    <div class="login-info clr">
                        <form target="hidframe"  method="post" action="<?php echo M_URL('Register','doRegister');  ?>" class="form-horizontal">
                        <ul class="clr">
                            <li class="mt10">
                                <input type="text" name="domain" class="realm" placeholder="4-20字，数字/字母(a-z)组合" />
                                <label for="" class="realm-name">.zuojy.com</label>
                            </li>
                            <li>
                                <p style="color: #999;margin-top: 5px;">二级域名</p>
                            </li>
                            <li class="">
                                <input type="text" name="username" id="telText" class="phonenumber" placeholder="请输入手机号" />
                            </li>
                            <?php if($this->Sms->smsState('Register')){ ?>
                            <li class="mb10">
                                <input type="text" name="code" class="fl yzm" placeholder="请输入验证码"/>
                                <a id="getyanma" onClick="getcode()" class="submityzm fl">提交验证码</a>
                            </li>
                            <script>
							function getcode()//获得验证码
							{
								var curCount=<?php $base = $this->cache->GetACache('setting');echo $base['smsTime'];?>;
								var regusername=$("#telText").val();
								var reg  =/^1[345678]\d{9}$/;
								isok =reg.test(regusername)
								if(!isok)
								{
									alert('手机号格式不正确');
									return false;
								 }
								SetRemainTime(curCount,regusername); 
							}	
							function SetRemainTime(curCount,phone) //获得验证码的时候获得短信
							{
								if($("#getyanma").attr('date')==1){return false;}
								$.post("/Plus/Kesion.ajax.php?act=SendEx&type=userReg",{"phone":phone,"modelname":"Register"},function(data){});
								var InterValObj = window.setInterval(function(){
								if (curCount == 0 ){              
									window.clearInterval(InterValObj);//停止计时器
									//$("#check").removeAttr("disabled");//启用按钮
									$("#getyanma").html("重新发送验证码");
									$("#getyanma").attr('date',0);
								}
								else {
									$("#getyanma").attr('date',1);
									curCount--;
									$("#getyanma").html(curCount + "秒后重新发送");
								}
									},1000)	
							}
							</script>
							<?php } ?>
                            <li class="clr">
                                <input type="text" name="password" id="password" class="password" placeholder="请输入密码" />
                            </li>
                            <li class="clr">
                                <div class="in-btn">
                                <label class="teacher active"><input name="usertype" type="radio" value="1" <?php if(isset($users))echo "value='$users[usertype]'";?> checked>教师</label>
                                <label><input name="usertype" type="radio" value="2" <?php if(isset($users))echo "value='$users[usertype]'";  ?>>机构</label>
                                </div>
                            </li>
                            <li><button  type="submit" class="now-reg">立即注册</button></li>
                        </ul>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--底部开始-->
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
<!--底部结束-->
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script type="text/javascript">
    pageAnimate('.page-animate');
    $('.in-btn').find('label').click(function(){
        $(this).addClass('active').siblings().removeClass('active');
    })
    
</script>
</body>
</html>