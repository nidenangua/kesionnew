<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit">
<title>网校介绍</title>
<link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
</head>
<body class="ks-wrap">
	<div class="ks-wbox bRadius10">
	
     	
		<!--header-->
	    <div class="ks-head-box">
	     	
			<h3 class="ks-head-title2">网站设置</h3>
	    </div>
	    <!--header-->
		<!--tab-->
	 	<div class="ks-head-tab">
	 			<ul class="clearfix">
	 				<li><a href="<?php echo M_URL('config/Index','','',GP('appid-1'));?>">基本配置</a></li>
	 				<li><a href="<?php echo M_URL('Website','websitedomain'); ?>">域名设置</a></li>
	 				<li><a href="<?php echo M_URL('login/Index','','',GP('appid-20'));?>">第三方登录</a></li>
	 				<li><a href="<?php echo M_URL('Website','websiteContact'); ?>">联系方式</a></li>
	 				<li class="curr"><a href="<?php echo M_URL('config/Index','wxinfo','',GP('appid-1'));?>">店铺介绍</a></li>
	 			</ul>
	 	</div>
		 <!--/tab-->
		     
			<!--table-->
			<form target="hidframe" id="myform" action="<?php echo M_URL($this->AppName.'/Index','wxinfoAdd','',GP(''));?>" method="post" enctype="multipart/form-data">
            <div class="form-row clearfix" style="padding: 0 10px;">
	            <?php echo $this->Field->getF($tableid,'table','website',$info);?> 
	        </div>
		   
		    <!--/table-->
		    
		    <!--footer-->
			<div class="form-footer">
				<div class="d-inline-block" >
					<input type="submit" id="StartBtn" class="ks-bt bt-pue" value="确认修改" name="confirm">
					
				</div>
			</div>
			<!--/footer-->
		
		
		     	
			</form>
		</div>
		
		
		<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>
		<script>
			
			module.require(['$','backstage','nicescroll'],function(){
			
				
				loadScorllJs()
				
			});
		
		
		</script>
		


</body>
</html>