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

</head>
<body>  
	
	<div class="share-box mt20">
		<div class="tab">
			<ul>
				<li class="curr">推广链接</li>
				<li onclick="Alert('开发中',1)">推广海报</li>
			</ul>
		</div>
		<div class="tab-box">
			<div class="link fl">
				<strong>方法一: 通过链接</strong>
				<div>分享此链接到微信群和微信好友</div>
				<div class="link-color"><?php echo shortchain(MY_FULLDOMAIN.'/h5market/ktjshare?wxid='.$this->wxid.'&id='.$paperid.'&shareact=examin');?></div>			
				<div class="ks-bt bt-pue fn mt20" onClick="copyUrl2()">复制链接</div>
			</div>
			<div class="code fl">
				<strong>方法二: 通过二维码</strong>
				<img src="<?php echo UOOT.'Images/QRcode/'.createQRcode(ROOT.'Images/QRcode/',MY_FULLDOMAIN.'/h5market/ktjshare?wxid='.$this->wxid.'&id='.$paperid.'&shareact=examin','L',4,'weimenhu');?>" />		
			</div>
		</div>
	</div>
	<input type="text" style="height:0px;border:0px;" id="url2" value="<?php echo shortchain(MY_FULLDOMAIN.'/h5market/ktjshare?wxid='.$this->wxid.'&id='.$paperid.'&shareact=examin'); ?>"/>
	<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>
	<script>
		module.require(['$','backstage'],function(){
				
		})
		function copyUrl2(){
			 var Url2=document.getElementById("url2");
			 Url2.select(); // 选择对象
			 document.execCommand("Copy"); // 执行浏览器复制命令
			 Alert("复制成功！您可在微信或浏览器打开",2);
		}
	</script>
</body>
</html>