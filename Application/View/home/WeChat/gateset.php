<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="renderer" content="webkit"> 
    <title>微门户设置</title>
    <link href="<?php echo UOOT ?>Public/common/drag/css/reset.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/wechat/css/home.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/wechat/css/setgate.css?2018996" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/wechat/css/gate/iconfont.css" rel="stylesheet">
    <script>
    	var uoot = '<?php echo UOOT ?>';
    	var wxid = '<?php echo $wxid ;?>';	
    	var indexUrl = '<?php echo 'https://'.APP_DOMAIN.'/home.html/default/WeChat/login' ?>';
    	var __set = 0;
    </script> 	
    <style>
    	.set-wrap {padding: 0.75rem;}	
    	.set-wrap	.edit-logo-wrap {position: relative;padding-left: 4rem;box-sizing: border-box;}
    	.set-wrap .edit-title{position: absolute;left: 0;margin-top: -.85rem;top: 50%;line-height: 1.5rem;}
    	.set-wrap .eding-title {height: auto;padding: 0.75rem 0 0.75rem 0.5rem;margin-bottom: 0;border: 0;text-align: right;}
    	.set-wrap .edit-logo-wrap {margin-bottom: 1rem; border-bottom: 1px solid #eee;padding-bottom: 0.5rem;overflow: hidden;}
    	.set-wrap .eding-title::-webkit-input-placeholder { color: #ddd; font-size: 0.7rem; } 
    	.set-wrap #gatename {color:#999;background: none;}
    	.set-wrap .logobtn {height: 100%;line-height: 1.9rem;width: 100%;text-align: center;margin: 0;color: #fff;font-size: .7rem; background:none;
   		border-radius: .2rem;z-index: 99;top: 0;position: absolute;}
   		.set-wrap .edit-logo-wrap .logo {width: 2.5rem;height: 2.5rem;line-height: 2.5rem;float: right;}	
   			 
    </style>
</head>
<body>
	<div class="loadings" id="loadings"></div>
	
	<script src="<?php echo UOOT ?>Public/wechat/js/microportal/zepto.js"></script>
	<script src="<?php echo UOOT ?>Public/wechat/js/microportal/current.js?a9d817b319b7d9fee23f"></script>
	<script src="<?php echo UOOT ?>Public/wechat/js/setgate.js?a9d817b319b7d9fee23f"></script>
</body>
</html>