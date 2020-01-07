<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="renderer" content="webkit"> 
	<link href="/Public/common/login/login.css" rel="stylesheet">
	<link href="/Public/common/drag/css/reset.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="<?php echo UOOT;?>Public/app/css/wechat-reg.css"/> 
	<title>请选择你要浏览的店铺</title>
</head>
<style>
.login-content-r {
    width: 100%;
    /* height: 100%; */
    margin-left: 20px;
    display: block;
}
.login-content-r p {
	color:#888;
	font-size: 16px;
	margin-bottom: 10px;
}
.login-content-r .info-title {
	color: #000;
	font-size: 20px;
}
.login-content-r .login-info {
	background: #fff;
	margin-bottom: 10px;
	padding-left: 80px;
	position: relative;
	color: #333;
	font-size:16px ;
	padding:30px 30px 30px 80px;
	box-sizing: border-box;
	
}
.login-content-r .login-info .login-icon {
	position: absolute;
    left: 10px;
    width: 60px;
    top: 14px;
    height: 60px;
    border-radius: 50%;
    overflow: hidden;
}
.login-content-r .login-info .login-icon  img {
	max-width: 100%;
	min-height: 60px;
}
.login-content-r .login-info .login-right{
	width: 20px;
    height: 30px;
    position: absolute;
    right: 10px;
    top: 50%;
    margin-top: -15px;
}
.login-line {
	width: 50px;
	height: 1px;
	background: #000;
	display: inline-block;
}
.login-reg {
	color: #000;
	font-size:18px ;
	text-align: center;
	display: block;
	padding-top: 50px;
}
.l-g {
    overflow: -webkit-paged-y;
    position: relative;
    z-index: 55;
    overflow-y: auto;
}
.login-right  img{
	position: absolute;
	right: 0;
	top: 50%;
	margin-top: -10px;
}
</style>
<body style="background: #f5f5f5;overflow:auto;">
<div class="l-g">
	<div class="col-6 col-md-12">
	<div class="login-wrap fl animated bounceInRight" data-delay="0.1" data-type="bounceInRight" style="animation-delay: 0.1s;"> 
	    <div class="login-content-r">
	       <!-- <p class="info-title"></p>-->
            <?php
            if ($memberinfo){
                foreach($memberinfo as $k=>$v){
                    $domain    = wx_Url($v['wxid']).'?go=student';
                    $website   = $this->cache->GetHCache('website',$v['wxid']);?>
	       		 <a href="<?php echo $domain;?>">
	        		<div class="login-info clr">
	        			<div class="login-icon">
		        			<img src="<?php echo (empty($website['wilogo'])||strstr($website['wilogo'],'/Public/admin/images/login/logo.png'))?'/Public/admin/images/login/wilogo.png':Img($website['wilogo']);?>">
		        		</div>
                        <?php echo CutStr(empty($website['wititle'])?$website['sitename']:$website['wititle'],15);?>
                        <?php // echo $domain; ?>
	        		<div class="login-right">
	        			<img src="<?php echo UOOT;?>Public/app/images/appicon/icon_arrow_right.png" style="width:20px;height: 20px;">
	        		</div>	        			
	        		</div>
	        		</a>
	        <?php }
            } else{?>
            
             没有浏览过任何店铺！！！
            
            <?php }
             ?>
			<div class="login-reg" style="color:#999"></div>
	    </div>
	</div>
	</div>
		</div>
	</body>
</html>
