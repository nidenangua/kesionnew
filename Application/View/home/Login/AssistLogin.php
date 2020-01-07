<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit"> 
<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
<meta name="format-detection" content="telephone=no" />
<title>科汛V名师登录中心</title>
<meta name="Keywords" content="科汛V名师是一款能为中小教育培训机构快速增加营业收入，规范教学标准化、资源共享化、线上线下教育相结合等服务体系的云SaaS教育综合平台。">
<meta name="Description" content="科汛V名师是一款能为中小教育培训机构快速增加营业收入，规范教学标准化、资源共享化、线上线下教育相结合等服务体系的云SaaS教育综合平台。">

<!--Drag reset css-->
<link href="https://ks.zuojy.com/Public/common/drag/css/reset.css" rel="stylesheet">
<!--//Drag reset css end-->
<!--Drag module style-->
<link href="<?php echo UOOT;?>Public/app/css/assist/common.grid.css" rel="stylesheet">
<!--//Drag module style end-->
<link href="<?php echo UOOT;?>Public/app/css/assist/assistheader.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/app/css/assist/assistlogin.css" rel="stylesheet">
<!--[if lt IE 9]>
<script src="/Public/common/js/html5shiv.js"></script>
<script src="/Public/common/js/respond.min.js"></script>
<![endif]-->	
<title>登陆页面</title>
</head>
<body> 
 <div class="header">
    <div class="container">
       <div class="fr navRegBox">
          <a class="regText">开通网校</a>|<a class="navText">首页</a>
       </div>
       <div class="fl logoBox">
          <img src="<?php echo UOOT;?>Public/app/css/assist/logo.png" alt="" class="logoImg">
       </div>
    </div>
</div>
<div class="loginBox">
    <div class="login-container">
       <div class="loginTitle t-a-c">
         <h3>助教登录平台</h3>
         <p>TAS&nbsp;login&nbsp;platform</p>
       </div>
       <div class="clearfix loginCon">
         <div class="loginImg t-a-r col-6 col-md-6 col-sm-12 col-xs-12">
           <img src="<?php echo UOOT;?>Public/app/css/assist/loginimg.png"> 
         </div>
         <div class="loginInput col-6 col-md-6 col-sm-12 col-xs-12">
           <form id="myform" action="" method="post">
              <div><input name="username" type="text" placeholder="请输入用户名" class="textBox nameinput"></div>
              <div><input name="password" type="password" placeholder="请输入密码" class="textBox passwinput"></div>
              <div><input type="button" class="subBtn" value="立即登录" onclick="do_reg();"></div>
           </form> 
         </div>
       </div>
    </div>
</div>
 
 
<script src="<?php echo UOOT;?>Public/common/js/utils.js"></script>
<script>utils.loadJs(['jquery'])</script>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script>
	
	function do_reg(){ 
		var username = $('input[name="username"]').val();
		console.log(username)
		if(username==''){alert('请输入用户名\\手机号');return false;}
		var password = $('input[name="password"]').val();
		console.log(password)
		if(!password){alert('密码不能为空');return false;}
		if(password.length<6||password.length>20){alert('密码6-20字');return false;}
		$.ajax({
			type:"post",
			url:'<?php echo M_URL('Login','presigin'); ?>',
			data:{
			     'username':username,
			     'password':password
			},
			success:function(data){
				
			   if(data.result=='succeed'){
			   		
					$('#myform').attr('action',''+data.url+'<?php echo str_replace(UOOT,RUOOT,M_URL('Login','doAssistant')); ?>')
					$('#myform').submit();
				}else{
					alert("没有该账号，请注册")
				}
			},
		    error:function(){
			
			}
		});
	}
	$(document).keypress(function(e) {  
	    // 回车键事件  
	    if(e.which == 13) {do_reg()}  
	}); 
</script>
</body>
</html>