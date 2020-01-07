<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit"> 
<title>kesion教育平台</title>
<meta name="Keywords" content="kesion教育平台"/>
<meta name="Description" content="kesion教育平台" />
<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
<style>
.form-kmode{  height: 80px;  position: relative; border-bottom: 1px solid #e5e5e5;}
.kmode-pdl{position: relative; padding-left:20%;}
.kmode-new{position: absolute; left: 0px; top: 0px; height: 100%;width: 30%;line-height: 80px;}
.kmode-title{font-size: 1.4em; margin-left:20px;}
.kmode-info{line-height: 80px;width: 40%;}
.kmode-stat{line-height: 80px; width: 160px; text-align: left;}
</style> 
</head>
<body class="ks-wrap">

	<div id="ksBoxHead">	

	    <div class="Header-tool clearfix">
			<div class="Tool-Title">
			
			<!--图像-->
			<span class="Tool-icon">
				<i class="iconfont icon-myorder"></i>
			</span>
			<!--图像-->		
			<!--标题-->
			<p>便捷登陆</p>
			<!--标题-->
			</div>
			</div>
	</div>
	<div id="ksBoxContent" class="bg-white mt20" style="border-radius: 10px">
		<div class="form-row">
	<div class="form-kmode">
		<div class="kmode-pdl">	 					
			<div class="kmode-new">							
				<i class="iconfont icon-<?php if($this->userinfo['emailbing']=='1'){?>zhengque c-green<?php }else{?>gantanhao c-red<?php }?> fl  ml20" style="font-size: 2em;"></i>
				<span  class="fl kmode-title">邮箱验证</span>		
			</div>
			<?php if($this->userinfo['emailbing']!='1'){?> 
			<div class="kmode-cont">
				<span class="kmode-info fl fsize14 c-92" style="line-height: 80px;">
					验证后，可用于登录、找回密码、增加安全级别
				</span>
				<span class="kmode-stat ">
					<span class="ks-bt bt-green mt20" onclick="addTypeChange('<?php echo M_URL('Kjlogin','bingemail');?>','600px','410px',{title:'绑定邮箱',type:'top'});">立即绑定</span>
				</span> 
			</div>
			<?php }else{?>
			<div class="kmode-cont">
				<span class="kmode-info fl fsize14 c-92" style="line-height: 80px;">绑定邮箱：<?php echo $this->userinfo['email']; ?></span>
				<span class="kmode-stat ">
					<span onclick="addTypeChange('<?php echo M_URL('Kjlogin','bingemail');?>','600px','410px',{title:'绑定邮箱',type:'top'});" class="ks-bt bt-def mt20">修&nbsp;&nbsp;&nbsp;&nbsp;改</span>
				</span> 
			</div>
			<?php }?>	
			<div class="kmode-email bRadius10" style="position: absolute;display: none; top: 60px; width: 320px; height: 240px; background: #fff; z-index: 200; box-shadow: 0px 0px 15px #cccccc;">
				<div style="width: 80%; margin: 0px auto">
					<input type="text" name="email" class="form-textbox mt20">
				</div>
				<div style="width: 80%; margin: 10px auto">
					<div style="padding-right: 100px; height: 40px; position: relative;">
						<input type="text" name="email" class="form-textbox">
						<button class="ks-bt bt-def" style="position: absolute; right: 0px; top: 12px;">发送验证码</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="form-kmode">
		<div class="kmode-pdl">	 					
			<div class="kmode-new">							
				<i class="iconfont icon-<?php if($this->userinfo['mobilebing']=='1'){?>zhengque c-green<?php }else{?>gantanhao c-red<?php }?> fl  ml20" style="font-size: 2em;"></i>
				<span  class="fl kmode-title">手机验证</span>		
			</div>
			
			<?php if($this->userinfo['mobilebing']!='1'){?>
			<div class="kmode-cont">
				<span class="kmode-info fl fsize14 c-92" style="line-height: 80px;">绑定后，可用于登录，找回密码</span>
				<span class="kmode-stat ">
					<span class="ks-bt bt-green mt20" <?php if($this->userinfo['username']!==$this->userinfo['mobile']){?>onclick="addTypeChange('<?php echo M_URL('Kjlogin','bingmobile');?>','600px','410px',{title:'绑定手机',type:'top'});"<?php }else{ ?>onClick="noedit();"<?php } ?> >立即绑定</span>
				</span> 
			</div>
			<?php }else{?>
			<div class="kmode-cont">
				<span class="kmode-info fl fsize14 c-92" style="line-height: 80px;">您的手机：<?php echo $this->userinfo['mobile']; ?> 可用于登录，找回密码</span>
				<span class="kmode-stat " >
					<span class="ks-bt bt-def mt20" onclick="addTypeChange('<?php echo M_URL('Kjlogin','bingmobile');?>','600px','410px',{title:'绑定手机',type:'top'});">修&nbsp;&nbsp;&nbsp;&nbsp;改</span>
				</span> 
			</div>
			<?php }?>	
		</div>
	</div>
	<div class="form-kmode">
		<div class="kmode-pdl">	 					
			<div class="kmode-new">							
				<i class="iconfont icon-<?php if($this->userinfo['qqbing']=='1'){?>zhengque c-green<?php }else{?>gantanhao c-red<?php }?> fl  ml20" style="font-size: 2em;"></i>
				<span  class="fl kmode-title">绑定QQ</span>		
			</div>
			<?php if($this->userinfo['qqbing']!='1'){?>
			<div class="kmode-cont">
				<span class="kmode-info fl fsize14 c-92" style="line-height: 80px;">绑定后，可用该qq号码快速登录</span>
				<span class="kmode-stat ">
					<a href="<?php echo M_URL('Login','apilogin',1);?>" target="_top" class="ks-bt bt-green mt20">立即绑定</a>
				</span> 
			</div>
			<?php }else{?>
			<div class="kmode-cont">
				<span class="kmode-info fl fsize14 c-92" style="line-height: 80px;"> 您已绑定了qq，可用该qq号码快速登录</span>
				<span class="kmode-stat ">
					<a href="<?php echo M_URL('Login','apilogin',1);?>" target="_top" class="ks-bt bt-def mt20">修&nbsp;&nbsp;&nbsp;&nbsp;改</a>
				</span> 
			</div>
			<?php }?>
		</div>
	</div>
	<div class="form-kmode">
		<div class="kmode-pdl">	 					
			<div class="kmode-new">							
				<i class="iconfont icon-<?php if($this->userinfo['qqbing']=='1'){?>zhengque c-green<?php }else{?>gantanhao c-red<?php }?> fl  ml20" style="font-size: 2em;"></i>
				<span  class="fl kmode-title">绑定微信</span>		
			</div>
			<?php if($this->userinfo['qqbing']!='1'){?>
			<div class="kmode-cont">
				<span class="kmode-info fl fsize14 c-92" style="line-height: 80px;">绑定后，可用该微信号码快速登录</span>
				<span class="kmode-stat ">
					<span class="ks-bt bt-green mt20">立即绑定</span>
				</span> 
			</div>
			<?php }else{?>
			<div class="kmode-cont">
				<span class="kmode-info fl fsize14 c-92" style="line-height: 80px;">绑定后：595124339@qq.com</span>
				<span class="kmode-stat ">
					<span class="ks-bt bt-def mt20">修&nbsp;&nbsp;&nbsp;&nbsp;改</span>
				</span> 
			</div>
			<?php }?>
				
		</div>
		</div>			
			</div>
		</div>

	<div id="ksBoxFooter">
		<div style="height: 80px;"></div>
	</div>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script>
$('#ks-content').height($(window).height()-$('.generalTitle').outerHeight());

$(window).resize(function(){
	$('#ks-content').height($(window).height()-$('.generalTitle').outerHeight());
});
function noedit(){
	alert('用户名和电话不一致时才可绑定');
}
</script>
</body>
</html>