<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="renderer" content="webkit"> 
	<link href="/Public/common/login/login.css" rel="stylesheet">
	<link href="/Public/common/drag/css/reset.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="<?php echo UOOT;?>Public/app/css/wechat-reg.css"/> 
	<title>注册学员</title>
</head>
<style>
.login-border i.wxname-icon {
    background: url(/Public/app/images/login/wxname.png)no-repeat 6px center;
}
.login-content-r {
    width: 100%;
    margin-left: 20px;
    display: block;
}
.login-border-auto {
	width: 50%;
}
</style>
<body>
<div class="l-g" style="height: 100%;">
	<div> 
	<div class="login-wrap fl animated bounceInRight" data-delay="0.1" data-type="bounceInRight" style="animation-delay: 0.1s;">
	    <div class="login-content-r">
	        <p class="info-title"><!--注册账号--></p>
	        <div class="login-info clr">
	            <ul class="clearfix reg-ul">
	                <li>
	                	<div class="login-border">
	                		<i class="wxname-icon"></i>
	                		<input type="text" style="display:none" name="username">
	                   		<input type="text" name="username" class="phonenumber" id="username" placeholder="请输入学员名">
	                	</div>
	                </li>
	                <li>
	                	<div class="login-border">
	                		<i class="phone-icon"></i>
	                		<input type="text" style="display:none" name="regPhone">
	                   		<input type="text" name="regPhone" class="phonenumber" id="regPhone" placeholder="请输入手机号">
	                	</div>
	                </li>
	                <?php if($this->Sms->smsState('Register')){ ?>
	                <li>
	                	<input type="text" style="display:none" name="code">
	                    <input type="text" name="code" class="fl yzm" placeholder="请输入验证码"/>
	                    <a id="getyanma" onClick="getcode()" class="submityzm fr">提交验证码</a>
	                </li>
	                <script>
					function getcode(){//获得验证码
						var curCount=<?php $base = $this->cache->GetACache('setting');echo $base['smsTime'];?>;
						var regusername=$("#regPhone").val();
						var reg  =/^1[345678]\d{9}$/;
						isok =reg.test(regusername)
						if(!isok){alert('手机号格式不正确');return false;}
						SetRemainTime(curCount,regusername); 
					}	
					function SetRemainTime(curCount,phone){//获得验证码的时候获得短信
						if($("#getyanma").attr('date')==1){return false;}
						$.post("/Plus/Kesion.ajax.php?act=SendEx&type=memberReg",{"phone":phone,"modelname":"Register"},function(data){
							if(data==2){alert('您的手机号已注册');return false;}
							else if(data==-1){alert('验证码发送失败');return false;}
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
							}
						});
					}
					</script>
					<?php } ?>
	                <li class="clr">
	                	<div class="login-border">
	                		<i class="pass-icon"></i>
	                		<input type="password" name="password" id="regpassword" class="password" placeholder="请输入密码">
	                		<input type="hidden" name="openid" value="<?php echo $openId; ?>" />
	                		<input type="hidden" name="wxcode" value="2" />
	                		<input type="hidden" name="wxopenid" value="<?php echo $wxopenId; ?>" />
	                	</div>
	                </li>
	                <li><button type="button" onclick="submitForm()" class="now-reg">立即注册</button></li>
	            </ul>
	        </div>
	    </div>
	</div>
	</div>
</div>
<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
<script type="text/javascript">
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
	//验证手机号格式是否正确
	function verifyPhoneNumber(phoneId){
		var phoneValue = $.trim(document.getElementById(phoneId).value);  
		if(phoneValue==''){
			alert($('#'+phoneId).attr('placeholder'));
	    	document.getElementById(phoneId).focus();
	        return false;
		};
		var reg  =/^1[345678]\d{9}$/;        
	    var isok = reg.test(phoneValue);
	    if(!isok){
	    	alert('手机号格式不正确');
	    	document.getElementById(phoneId).focus();
	        return false;
	    };
	    return true;
	};
	//提交表单
	function submitForm(){
		if($('input[name="password"]').val().length<6||$('input[name="password"]').val().length>20){alert('密码6-20字');return false;}
		var code = '';
		<?php if($this->Sms->smsState('Register')){ ?>
		code = $('input[name="code"]')[1].value;
		if(code==''){Alert('验证码不能为空');return false;}
		<?php }?>
		//第四步，确认提交
		$.ajax({ 
		type:"post",
		url:"<?php echo M_URL('h5market','doregister'); ?>",
		data:{
			username:$('#username').val(),
			mobile  :$('#regPhone').val(),
			password:$('[name=password]').val(),
			openid:$('[name=openid]').val(),
			wxopenid:$('[name=wxopenid]').val(),
			wxcode:$('[name=wxcode]').val(),
			domain:$('[name=domain]').val(),
			code:code,
			usertype:$('[name=usertype]').val()
		},
		success : function(data) {
			if(data=='codeerr'){
				alert('验证码错误');
			}else if(data=='exists'){
				alert('学员账号云平台已存在');
			}else if(data=='succeed'){
				alert('注册成功');
				window.location.href='/h5market/index';
			} 
    	},
	});
	};
</script>
</body>
</html>
