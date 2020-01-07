<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit"> 
<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
<link rel="stylesheet" type="text/css" href="<?php echo UOOT;?>Public/app/css/login.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo UOOT;?>Public/app/css/base.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo UOOT;?>Public/app/css/page.animate.css"/>
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
<style type="text/css">
	.login-border{
		margin-bottom: 0;
	}
</style>
<title>重置密码</title>
</head>
<body style="background-color: #eef0f9;">
 <!--头部-->
 <div class="newtop">
		<div class="ks-container">
            <a href="<?php echo UOOT;?>">
                <img style="position: absolute;top: 0;left: -108px;" src="<?php echo UOOT;?>Public/app/images/login/logo.png" width="250" />
            </a>
			<span style="position: relative;top: 0;right: -70px;">
				<img style="position: absolute;top: 12px;right: 171px;" src="Public/app/images/phone_icon.png">
			咨询电话：400-008-0263</span>
		</div>
	</div>
    <!--主体-->
<div class="login-content" style="margin-top: 3%;">
<div class="mainbox clr">
<!--主体右边-->
<div class="l-g login-wrap">
<div class="col-6 col-md-6">
	<img class="login-leftimg page-animate" data-delay="0.1" src="<?php echo UOOT;?>Public/app/images/loginleftnew.png">
</div>
<div class="col-6 col-md-6">
	<div class="login-center">
		<div class="page-animate" data-delay="0.1" data-type="bounceInRight"> 
		    <div class="login-content-r">
		        <p class="info-title">重置密码</p>
		        <div class="login-info clr">
		            <form target="hidframe" id="myform" method="post" action="" class="form-horizontal">
		            <ul class="clr reg-ul">
		                <li class="">
		                	<div class="login-border">
		                		<input type="text" style="display:none" name="username">
		                		<i class="phone-icon"></i>
		                    	<input type="text" name="username" id="telText" class="phonenumber" placeholder="请输入手机号" />
		                	</div>
		                </li>
		                <?php if($this->Sms->smsState('PassWord')){ ?>
                        <li id="getsendsms" style="display:none">
                            <img src="/home.html/default/Register/Verify" class="submityzm fl" style="margin-left: 0%;" onclick="this.src='/home.html/default/Register/Verify'" />
                            <input type="text" name="getsendsms" class="fr yzm" placeholder="请输入图片验证码" />
                        </li>
		                <li class="mb10">
                            <input type="hidden" name="SmsKing" value="" />
		                	<input type="text" style="display:none" name="code">
		                    <input type="text" name="code" class="fl yzm" placeholder="请输入验证码"/>
		                    <a id="getyanma" onClick="getcode()" class="submityzm fr">提交验证码</a>
		                </li>
		                <script>
						function getcode(){//获得验证码
							var curCount=<?php $base = $this->cache->GetACache('setting');echo $base['smsTime'];?>;
							var regusername=$("#telText").val();
							var reg  =/^1[345678]\d{9}$/;
							isok =reg.test(regusername)
							if(!isok){
								Alert('手机号格式不正确');
								return false;
							}
							SetRemainTime(curCount,regusername); 
						}	
						function SetRemainTime(curCount,phone){//获得验证码的时候获得短信
                            var SmsKing = $('input[name="SmsKing"]').val();
							if($("#getyanma").attr('date')==1){return false;}
							$.post("/Plus/Kesion.ajax.php?act=SendEx1&type=userReg",{"phone":phone,"modelname":"PassWord","SmsKing":SmsKing},function(data){
								if(data==2){Alert('您的手机号还未注册过');return false;}
								else if(data==-1){Alert('验证码发送失败');return false;}
								else if(data==0){
									var InterValObj = window.setInterval(function(){
									if (curCount == 0 ){              
										window.clearInterval(InterValObj);//停止计时器
										//$("#check").removeAttr("disabled");//启用按钮
										$("#getyanma").html("重新发送验证码");
										$("#getyanma").attr('date',0);
									}else {
										$("#getyanma").attr('date',1);
										curCount--;
										$("#getyanma").html(curCount + "秒后重新发送");
									}
										},1000)	
								}else{
                                  Alert(data);
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
								var reg  =/^1[345678]\d{9}$/;
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
		                		 <input type="password" name="password" id="password" class="password" placeholder="新密码，6-20个字符" />
		                	</div>
		                   
		                </li>
		                <li class="clr">
		                	<div class="login-border">
		                		 <i class="pass-icon"></i>
		                		  <input type="password" name="pwd_check" id="pwd_check" class="password" placeholder="确认密码" />
		                	</div>
		                   
		                </li>
		                <li><button type="button" onclick="do_reg();" class="now-reg">找回&登陆</button></li>
		            </ul>
		            </form>
		        </div>
		    </div>
		</div>
	</div>
</div>
<!--底部S-->

<!--底部e-->

</div>
<!--主体左边-->


</div>
<div class="kexunbest">
<p class="kexun-des">
    <span class="kexun-line-left"></span>
    科汛
    <span class="dot"></span>专注新教育的技术服务商
    <span class="kexun-line-right"></span>
</p>
<p class="kexun-records">
    Copyright © 2015-2019 厦门科汛软件有限公司 All Rights Reserved. 闽ICP备06009871号
    <a target="_blank"
        href="https://www.beian.gov.cn/portal/registerSystemInfo?recordcode=35020302001540"
        style="display:inline-block;text-decoration:none;height:20px;line-height:20px;color:#999;vertical-align: middle;">
        <img src="https://www.kesion.com/kesion-ui/footer/ghs.png" style="float:left;" />
        闽公网安备 35020302001540号
</a>
</p>
</div>
</div>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script type="text/javascript">
pageAnimate('.page-animate');
$('.in-btn').find('label').click(function(){
    $(this).addClass('active').siblings().removeClass('active');
})
function do_reg(){
	var username = $('input[name="username"]')[1].value;
	if(username==''){Alert('请输入用户名\手机号');return false;}
	var reg   = /^1[34578]\d{9}$/;//手机验证
	if(!reg.test(username)){Alert('请输入正确手机号');return false;}
	var code = $('input[name="code"]')[1].value;
	if(code==''){Alert('验证码不能为空');return false;}
	var password = $('input[name="password"]')[0].value;
	if(password==''){Alert('请输入密码');return false;}
	if(password.length<6||password.length>20){Alert('密码6-20字');return false;}
	
	var pwd_check = $('input[name="pwd_check"]')[0].value;
	if(pwd_check==''){Alert('请再次输入密码');return false;}
	if(password!=pwd_check){Alert('两次密码不一致');return false;}
	$.ajax({
		type:"post",
		url:'<?php echo M_URL('Register','doPassword'); ?>',
		data:{
		     'username':username,
		     'code':code,
		     'password':password,
		     'pwd_check':pwd_check
		},
		success:function(data){
			if(data.result=='succeed'){
			    Alert('恭喜，密码修改成功，请重新登录！',2);
    	        setTimeout(function(){  location.href=data.url+'/login'; }, 3000);			
   
		   }else{
				$('body').append(data); 
		   }
		},
	    error:function(){
		   Alert('信号不好');
		}
	});
}
$(document).keypress(function(e) {  
    if(e.which == 13) {do_reg()}// 回车键事件   
});   
var minHeight =  $(window).height()-$('.header2').outerHeight()-2;
	$('.login-content').css({"minHeight":minHeight});
window.onresize=function(){
		var minHeight =  $(window).height()-$('.header2').outerHeight()-2;
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
	 //$('.l-g').css({"marginTop":marginNumber});
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