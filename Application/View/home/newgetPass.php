<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="renderer" content="webkit"> 
	<link href="/Public/common/login/login.css" rel="stylesheet">
	<link href="/Public/common/drag/css/reset.css" rel="stylesheet">
	
	<link rel="stylesheet" type="text/css" href="<?php echo UOOT;?>Public/app/css/wechat-reg.css"/> 
	<title>忘记密码</title>
</head>
<style>
.login-content-r {
    width: 100%;
    /* height: 100%; */
    margin-left: 20px;
    display: block;
}
.logo {
	height: 6rem;
	display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
}
.logo img {
	height: 2rem;
}

</style>
<body>
	<div class="logo">
		<img src="/Images/school/1/201805/5afbfcd6d6b27.png"/>
	</div>
<div class="l-g" style="height: 100%;">
	<div class="col-6 col-md-12">
	<div class="login-wrap fl animated bounceInRight" data-delay="0.1" data-type="bounceInRight" style="animation-delay: 0.1s;"> 
	    <div class="login-content-r">
	        <p class="info-title" style="display: none;"><!--重置密码--></p>
	        <div class="login-info clr">
	            <form target="hidframe" id="myform" method="post" action="" class="form-horizontal">
	            <ul class="clr reg-ul">
	                <li class="">
	                	<div class="login-border">
	                		<input type="text" style="display:none" name="username">
	                		<i class="phone-icon"></i>
	                    	<input type="text" name="username" id="telText" class="phonenumber" placeholder="请输入手机号">
	                	</div>
	                </li>
                    <li class="mb10">
	                	
	                    <input type="text" name="code" class="fl yzm" placeholder="请输入验证码">
	                    <a id="getyanma" onclick="getcode()" class="submityzm fr">提交验证码</a>
	                    <input type="hidden" name="openid" value="<?php echo $openId; ?>" />
	                    <input type="hidden" name="wxopenid" value="<?php echo $wxopenId; ?>" />
                		<input type="hidden" name="wxcode" value="2" />
	                </li>
	                <script>
					function getcode(){//获得验证码
						var curCount=60;
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
						if($("#getyanma").attr('date')==1){return false;}
						$.post("/Plus/Kesion.ajax.php?act=SendEx&type=userReg",{"phone":phone,"modelname":"PassWord"},function(data){
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
							}
						});
					}
					</script>
					                <li class="clr">
	                	<div class="login-border">
	                		 <i class="pass-icon"></i> 
	                		 <input type="password" name="password" id="password" class="password" placeholder="新密码，6-20个字符">
	                	</div>
	                   
	                </li>
	                <li class="clr">
	                	<div class="login-border">
	                		 <i class="pass-icon"></i>
	                		  <input type="password" name="pwd_check" id="pwd_check" class="password" placeholder="确认密码">
	                	</div>
	                   
	                </li>
	                <li><button type="button" onclick="submitForm({formId:'myform',phoneId:'telText',regpassword:'password',passWord:'pwd_check'})" class="now-reg">找回&amp;登陆</button></li>
	            </ul>
	            </form>
	        </div>
	    </div>
	</div>
	</div>
			<!--底部S-->
			
			<!--底部e-->
			
			</div>
	<script src="/Tp/PC/Skin05/AM/Public/js/jquery-3.3.1.min.js" type="text/javascript" charset="utf-8"></script>
	<script src="/Public/Zpopup/js/Zpopup.js" type="text/javascript" charset="utf-8"></script>
	<script type="text/javascript">
		$('.in-btn').find('label').click(function(){ 
		    $(this).addClass('active').siblings().removeClass('active');
		})
		
		function Alert(text){
			popup.tips({
					'text':text,
					'style':2
				})
		}
		//验证手机号格式是否正确
		function verifyPhoneNumber(phoneId){
			var phoneValue = $.trim(document.getElementById(phoneId).value);  
			if(phoneValue==''){
				Alert($('#'+phoneId).attr('placeholder'));
		    	document.getElementById(phoneId).focus();
		        return false;
			};
			var reg  =/^1[345678]\d{9}$/;        
		    var isok = reg.test(phoneValue);
		    if(!isok){
		    	Alert('手机号格式不正确');
		    	document.getElementById(phoneId).focus();
		        return false;
		    };
		    return true;
		};
		//提交表单
		function submitForm(data){
			/* formId 准备提交的表单id
			 * phoneId 需要判断手机格式的id 
			 * passWord 检测两次输入是否一致*/
			var $form = $('#'+data.formId);
			//第一步，判断表单内是否有为空项
			for(var i=0;i<$form.find('[placeholder]').length;i++){
				var $target = $form.find('[placeholder]').eq(i);
				var emptyTips = $target.attr('placeholder');
				if($.trim($target.val())==''){
					alert(emptyTips);
					$target.focus();
					return false;
				};
			};
			
			//第二步，判断手机号格式是否正确
			if(data.phoneId){
				if(!verifyPhoneNumber(data.phoneId)){return false;};
			};
			//alert(data.regpassword);
			if(data.regpassword){
			     if($form.find('input[name="password"]').val().length<6||$form.find('input[name="password"]').val().length>20){Alert('密码6-20字');return false;}
			}
			//第三步，验证输入密码是否一致
			if(data.passWord){
				if($form.find('input[name="password"]').val().length<6||$form.find('input[name="password"]').val().length>20){Alert('密码6-20字');return false;}
				var pwd_check = $form.find('input[name="pwd_check"]').val();
				if(pwd_check==''){Alert('请再次输入密码');return false;}
				if($form.find('input[name="password"]').val()!=pwd_check){Alert('两次密码不一致');return false;}
			}
			
			//第四步，确认提交
			$.ajax({ 
			type:"post",
			url:"<?php echo M_URL('Register','doPassword'); ?>",
			data:{
				username:$('#telText').val(),
				password:$('[name=password]').val(),
				pwd_check:$('[name=pwd_check]').val(),
				openid:$('[name=openid]').val(),
				wxopenid:$('[name=wxopenid]').val(),
				wxcode:$('[name=wxcode]').val(),
				code:$('[name=code]').val()
			},
			success : function(data) {
				    var jsonData =JSON.parse(data)
				    console.log(jsonData)
		            if(jsonData.succeed=="10001"){
		         		Alert('重置成功');
		         		var oldwxid = "<?php echo $GLOBALS['_DoM']['wxid'] ?>";
		         		if(oldwxid != jsonData.wxid){
		         			window.location = 'https://'+jsonData.domain+'/home.html/default/WeChat/<?php echo $actindex; ?>?token='+jsonData.token;
		         		}else{
		         			window.location = 'https://'+jsonData.domain+'/home.html/default/WeChat/<?php echo $actindex; ?>';
		         		}
		            }else{
		            	Alert(jsonData.msg);
		            }
		         },
		});
		};
	</script>
	</body>
</html>
