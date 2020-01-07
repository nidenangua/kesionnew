<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="renderer" content="webkit">
	<title>kesion教育平台</title>
	<meta name="Keywords" content="kesion教育平台"/>
	<meta name="Description" content="kesion教育平台" />
	<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/admin/css/html5.css" rel="stylesheet">
	<link href="<?php echo UOOT;?>Public/admin/css/general.css" rel="stylesheet">  
	<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/app/css/html5.css?<?php echoHash(); ?>" rel="stylesheet" />
    <script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>
</head>
<body class="gray-bg">
<div class="ks-module ks-wbox clearfix" style="padding-bottom: 10px;">
	<h3 class="ks-index-title ks-index-title1">
		<button class="ks-heade-button ks-head-bt1">访问微门户
				<div class="module-code">
					<p>微信扫一扫访问</p>
					<img src="<?php echo UOOT.'Images/QRcode/'.createQRcode(ROOT.'Images/QRcode/','https://'.$domain.'/h5market/Miindex/2.0','L',4,'weimenhu');?>">
					<a href="javascript:void(0)" onClick="copyUrl2()"><p>复制页面链接</p></a>	
					<script>
					function copyUrl2(){
						 var Url2=document.getElementById("url2");
						 Url2.select(); // 选择对象
						 document.execCommand("Copy"); // 执行浏览器复制命令
						 Alert("复制成功！您可在微信或浏览器打开",2);
					}
					</script>
				</div> 
		</button>
	</h3>
</div>
<input type="text" style="height:0px;border:0px" id="url2" value="<?php echo shortchain('https://'.$domain.'/h5market/Miindex/2.0');?>" />	
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
</body>
</html>

