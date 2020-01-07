<!DOCTYPE HTML>
<html>
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="renderer" content="webkit" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <link rel="stylesheet" type="text/css" href="<?php echo UOOT;?>Public/mobile/css/login.css?<?php echoHash(); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo UOOT;?>Public/mobile/css/base.css?<?php echoHash(); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo UOOT;?>Public/mobile/css/page.animate.css?<?php echoHash(); ?>" />
    <link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
    <script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
    <style type="text/css">
	.login-center{
		overflow:hidden;
	}
	.foot .link-wrap .link-item:after{
		background:#ccc;
	}
	.foot .copyright,
	.foot .link-wrap .link-item{
		color:#999;
	}
	.cook .fl{
		margin-left:45px;
	}
	@media (max-width: 1366px){
		.foot {
			position: absolute;
		}
	}
	@media (max-width: 480px){
		.foot {
			position: relative;
			text-align:left;
		}
		.mainbox{
			padding:0px;
		}
		.foot .link-wrap{
			padding-left:0px;
		}
		.foot .copyright,
		.foot .link-wrap .link-item{
			font-size:12px;
		}
		.login-logo img{
			height:38px;
		}
		.login-content-r .login-info{
			padding:20px;
		}
		.login-content-r .info-title{
			height:44px;
			line-height:44px;
		}
		.login-wrap{
			border-radius:16px;
		}
		.cook .fl{
			margin-left:0px;
		}
		
		
	}
</style>
    <title>1分钟免费开通您的线上教育平台 - 科汛新教育微门户</title>
</head>
<body>
    <!--头部-->

    <!--主体-->
    <div class="login-content ">
        <div class="mainbox clr">
            <!--主体右边-->
            <div class="l-g">
                <div class="col-12 col-md-12">
                    <div class="login-center">
                        <div class="login-logo">
                            <a href="<?php echo UOOT; ?>">
                                <img src="<?php echo UOOT;?>Public/app/images/login/logo.png" />
                            </a>
                        </div>
                        <div class="login-wrap  page-animate" data-delay="0.1" data-type="bounceInRight">
                            <div class="login-content-r">
                                <p class="info-title">1分钟开通线上教育平台</p>
                                <div class="login-info clr">
                                    <form target="hidframe" id="myform" method="post" action="" class="form-horizontal">
										<input type="hidden" name="salesman"  value="<?php echo ChkClng(KS_G('get.salesman'))?>"/>
                                        <ul class="clr reg-ul">
                                            <li class="clr button-wrp" style="display: none;">
                                                <div class="in-btn">
                                                    <label class="teacher active">
                                                        <input name="usertype" type="radio" value="2" <?php if(isset($users))echo "value='$users[usertype]'";?> checked />机构
                                                    </label>
                                                    <label>
                                                        <input name="usertype" type="radio" value="1" <?php if(isset($users))echo "value='$users[usertype]'";?> />教师
                                                    </label>
                                                </div>
                                            </li>
                                            <?php $base=$this->cache->GetACache('setting');
                                                  if($base['regsitename']==1){?>
                                            <li>
                                                <div class="login-border">
                                                    <i class="wxname-icon"></i>
                                                    <input type="text" name="sitename" id="telText1" class="phonenumber" placeholder="请输入学校名称/教师姓名/大V名称等" />
                                                </div>
                                            </li>
                                            <?php }?>
                                            <li>
                                                <div class="login-border-auto">
                                                    <i class="usericon"></i>
                                                    <input type="text" name="domain" class="realm" placeholder="4-15字，数字/字母(a-z)组合" />
                                                </div>
                                                <label for="" class="realm-name">
                                                    .<?php echo PLATDOMAIN;?>
                                                </label>
                                            </li>
                                            <li>
                                                <div class="login-border">
                                                    <i class="phone-icon"></i>
                                                    <input type="text" style="display:none" name="username" />
                                                    <input type="text" name="username" id="telText" class="phonenumber" placeholder="请输入手机号" />
                                                </div>
                                            </li>
                                            <?php if($this->Sms->smsState('Register')){ ?>
                                            <li id="getsendsms" style="display:none">
                                                <img src="/home.html/default/Register/Verify" class="submityzm fl" style="margin-left: 0%;" onclick="this.src='/home.html/default/Register/Verify'" />
                                                <input type="text" name="getsendsms" class="fr yzm" placeholder="请输入图片验证码" />
                                            </li>
                                            <li id="sendsms" style="display:none">
                                                <input type="text" style="display:none" name="code" />
                                                <input type="text" name="code" class="fl yzm" placeholder="请输入短信验证码" />
                                                <a id="getyanma" onclick="getcode()" class="submityzm fr">发送短信验证码</a>
                                            </li>
                                            <script>
						function getcode(){//获得验证码
							var curCount=<?php $base = $this->cache->GetACache('setting');echo $base['smsTime'];?>;
							var regusername=$("#telText").val();
							var reg  =/^1[3456789]\d{9}$/;
							isok =reg.test(regusername)
							if(!isok){Alert('手机号格式不正确');return false;}
							SetRemainTime(curCount,regusername);
						}
						function SetRemainTime(curCount,phone){//获得验证码的时候获得短信
							var SmsKing = $('input[name="SmsKing"]').val();
							if($("#getyanma").attr('date')==1){return false;}
							$.post("/Plus/Kesion.ajax.php?act=SendEx1&type=userReg",{"phone":phone,"modelname":"Register","SmsKing":SmsKing},function(data){
								if(data==2){Alert('您的手机号已注册');return false;}
								else if(data==-1){Alert('短信验证码发送失败');return false;}
								else if(data==0){
									var InterValObj = window.setInterval(function(){
									if (curCount == 0 ){
										window.clearInterval(InterValObj);//停止计时器
										//$("#check").removeAttr("disabled");//启用按钮
										$("#getyanma").html("重新发送短信验证码");
										$("#getyanma").attr('date',0);
									}else {
										$("#getyanma").attr('date',1);
										curCount--;
										$("#getyanma").html(curCount + "秒后重新发送");
									}
										},1000)
								}
							});
						}
						$("#getsendsms").keyup(function () {
						    var reg = $('input[name="getsendsms"]').val().length;
						    var getsendsms = $('input[name="getsendsms"]').val();
						    var isdisabled = $('input[name="getsendsms"]').attr("disabled");
						    if(isdisabled=='disabled'){
						    	console.log(isdisabled);
						    }else if (reg==4) {
								$.post("/home.html/default/Register/Verify2",{"getsendsms":getsendsms},function(data){
									if(data.result=='ok'){
										$('input[name="getsendsms"]').attr("disabled","disabled");
										$('input[name="SmsKing"]').val(data.SmsKing);
										$('#sendsms').show();
									}else if(data.result=='err'){
										Alert('图片验证码不正确');
									}
								});
						    }else if(reg>4){
						    	$('input[name="getsendsms"]').val('');
						    }
						}).change(function () {
						    $(this).keyup();
						});
						$("#telText").keyup(function () {
						    var reglen = $("#telText").val().length;
						    var regusername=$("#telText").val();
						    if (reglen==11) {
								var reg  =/^1[3456789]\d{9}$/;
								isok =reg.test(regusername)
								if(!isok){Alert('手机号格式不正确');return false;}
						    	$('#getsendsms').show();
						    }else if(reglen>11){
						    	Alert('手机号格式不正确');return false;
						    }
						}).change(function () {
						    $(this).keyup();
						});
                                            </script>
                                            <?php } ?>
                                            <li class="clr">
                                                <div class="login-border">
                                                    <i class="pass-icon"></i>
                                                    <input type="password" name="password" id="password" class="password" placeholder="请输入密码" />
                                                </div>
                                            </li>
                                            <li>
												<input type="checkbox" name="" id="forRemember" value="" class="remember" checked="checked" />
												<label for="forRemember" class="safe">我已阅读并同意</label>
												<a href="<?php echo M_URL('Register','agreement');?>" class="forget">《科汛V名师服务协议》</a>
											
                                            </li>
                                            <li>
                                                <button type="button" onclick="do_reg();" class="now-reg">立即注册</button>
                                                <a class="now-reg login-reg" style="margin-top: 25px;" href="/login">返回登录</a>
                                            </li>
                                        </ul>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--主体左边-->
        </div>
        <input type="hidden" name="SmsKing" value="" />
        <!--底部S-->
        <div class="foot">
            <div class="link-wrap">
                <a class="link-item" href="http://www.kesion.cn/" target="_blank">公司介绍</a>
                <a class="link-item" href="http://www.kesion.cn/culture/" target="_blank">企业文化</a>
                <a class="link-item" href="http://www.kesion.cn/en_news/" target="_blank">公司动态</a>
                <a class="link-item" href="http://www.kesion.cn/joinus/" target="_blank">诚聘英才</a>
                <a class="link-item" href="/<?php echo(KS_C("DEFAULT_MODULE"));?>/apiword" target="_blank">开发文档</a>
                <a class="link-item" href="/<?php echo(KS_C("DEFAULT_MODULE"));?>/apiinfo" target="_blank">接口调试</a>
                <a class="link-item" href="/<?php echo(KS_C("DEFAULT_MODULE"));?>/help" target="_blank">帮助中心</a>
            </div>
            <div class="copyright">
                <script>
                    var copyRight = new Date();
                    update = copyRight.getFullYear();
                    document.write("厦门科汛软件有限公司版权所有©2006-" + update + "")
                </script>
            </div>
        </div>
        <!--底部e-->
    </div>
    <script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
    <script src="<?php echo UOOT;?>Public/common/js/myking.js"></script>
    <script type="text/javascript">
function getcode(){//获得验证码
	var curCount=<?php $base = $this->cache->GetACache('setting');echo $base['smsTime'];?>;
	var regusername=$("#telText").val();
	var reg  =/^1[3456789]\d{9}$/;
	isok =reg.test(regusername)
	if(!isok){Alert('手机号格式不正确');return false;}
	SetRemainTime(curCount,regusername);
}
function SetRemainTime(curCount,phone){//获得验证码的时候获得短信
	var SmsKing = $('input[name="SmsKing"]').val();
	if($("#getyanma").attr('date')==1){return false;}
	$.post("/Plus/Kesion.ajax.php?act=SendEx1&type=userReg",{"phone":phone,"modelname":"Register","SmsKing":SmsKing},function(data){
		if(data==2){Alert('您的手机号已注册');return false;}
		else if(data==-1){Alert('短信验证码发送失败');return false;}
		else if(data==0){
			var InterValObj = window.setInterval(function(){
			if (curCount == 0 ){
				window.clearInterval(InterValObj);//停止计时器
				//$("#check").removeAttr("disabled");//启用按钮
				$("#getyanma").html("重新发送短信验证码");
				$("#getyanma").attr('date',0);
			}else {
				$("#getyanma").attr('date',1);
				curCount--;
				$("#getyanma").html(curCount + "秒后重新发送");
			}
				},1000)
		}
	});
}
pageAnimate('.page-animate');
$('.in-btn').find('label').click(function(){
    $(this).addClass('active').siblings().removeClass('active');
    <?php if($base['regsitename']==1){?>
    var usertype=parseInt($("input[name='usertype']:checked").val());
    if(usertype==1){
    	$('input[name="sitename"]').prop('placeholder','请输入教师名称');
    }else if(usertype==2){
    	$('input[name="sitename"]').prop('placeholder','请输入机构名称');
    }
    <?php }?>
})
function do_reg(){
	var sitename = '';
	<?php if($base['regsitename']==1){?>
	sitename = $('input[name="sitename"]').val();
	var usertype=parseInt($("input[name='usertype']:checked").val());
	if(usertype==1){
    	if(sitename==''){Alert('请输入教师名称');return false;}
    }else if(usertype==2){
    	if(sitename==''){Alert('请输入机构名称');return false;}
    }
	<?php }?>
	var domain = $('input[name="domain"]')[0].value;
	if(domain==''){Alert('请输入二级域名');return false;}
	var reg1   = /^\w+$/;//手机验证
	if(!reg1.test(domain)){Alert('二级域名不能有特殊字符');return false;}
	if(domain.length<4||domain.length>15){Alert('二级域名4-15字');return false;}
	var username = $('input[name="username"]')[1].value;
	if(username==''){Alert('请输入用户名\手机号');return false;}
	var reg   = /^1[3456789]\d{9}$/;//手机验证
	if(!reg.test(username)){Alert('请输入正确手机号');return false;}
	var code = '';
	<?php if($this->Sms->smsState('Register')){ ?>
	code = $('input[name="code"]')[1].value;
	if(code==''){Alert('短信验证码不能为空');return false;}
	<?php }?>
	var password = $('input[name="password"]')[0].value;
	var salesman = $('input[name="salesman"]')[0].value;
	
	if(password==''){Alert('密码不能为空');return false;}
	if(password.length<6||password.length>20){Alert('密码6-20字');return false;}
	var usertype = $("input[name='usertype']:checked").val();
	if(usertype==''){Alert('请选择注册老师还是机构');return false;}
	$.ajax({
		type:"post",
		url:'<?php echo M_URL('Register','doRegister'); ?>',
		data:{
			 'sitename':sitename,
			 'domain':domain,
		     'username':username,
		     'code':code,
		     'password':password,
		     'usertype':usertype,
			 'salesman':salesman
		},
		success:function(data){
            if(data.status=='ok'){

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

    		   	//location.href=data.url;
			}else{
				$('body').append(data);
			};
		},
	    error:function(){
		   Alert('信号不好');
		}
	});
}
    </script>
</body>
</html>