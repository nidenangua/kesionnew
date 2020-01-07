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
				<a href="https://store.kesion.com/Images/software/201804/Ketangjie_Setup.exe"><li class="curr">下载PC教师端(推荐点我)</li></a>
			</ul>
		</div>
		<div class="tab-box">
			<div class="link fl">
			    <?php if($live){ ?>       
				<br/>
				<strong style="font-size: 20px;">房间名: <?php echo $live['channlName'] ?></strong><br/>
				<strong style="font-size: 20px;">密码: <?php echo $live['password'] ?></strong>
				<?php }else{ ?>
				<br/><br/>
                <div style="font-size: 20px;">直播课时间已过，请先<a class="ks-bt bt-pue" onclick="loactionClose()" href="<?php echo M_URL($this->AppName.'/Index','basics',$this->courseid,GP(''));?>" style="float:none;display: inline-block;margin-left: 10px;" >编辑</a></div>
                <?php } ?>	 
				<!--<strong>房间名: <?php echo $live['channlName'] ?></strong>
				<strong>房间名: <?php echo $live['channlName'] ?></strong>
				<div>密码:<?php echo $live['password']; ?></div>
				<div class="link-color">
				放电饭锅水电费
				</div>
				<div class="ks-bt bt-pue fn mt20" onClick="copyUrl2()">复制链接</div>-->
			</div>
			<div class="code fl">
				<strong>扫码下载科汛V名师手机教师端</strong>
				<img src="<?php echo UOOT.'Images/QRcode/'.createQRcode(ROOT.'Images/QRcode/','http:'.M_URL('home/Login','download'),'L',4,'weimenhu');?>" />		
			</div>
		</div>
	</div>
	<input type="text" style="height:0px;border:0px;" id="url2" value="<?php echo shortchain('');?>"/>
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
		 function loactionClose(){

	top.closePopup(window.name );
 	top.frames['main'].location.href  = "<?php echo M_URL($this->AppName.'/Index','basics',$this->courseid,GP('')) ?>";
 }

	</script>
</body>
</html>