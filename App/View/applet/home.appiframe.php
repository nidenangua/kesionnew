<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit">
<title>kesion教育平台</title>
<meta name="Keywords" content="kesion教育平台"/>
<meta name="Description" content="kesion教育平台" />
<link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<style type="text/css">	
	.program-box img{max-width: 80%;margin: 0 auto;display: block;}
	.program-btn {text-align: center;margin-top: 30px;}
	.program-btn .ks-bt {float: none;min-width: 80px;}
	.program-ifame {
		
		width: 325px;
	    padding: 0 16px;
	    padding-top: 136px;
	    height: 531px;	  	   
	    background: url('//ks.kesion.com/Public/dragh5/images/phone.png') no-repeat;
	 
	   background-position: center;
	}
	.program-ifame iframe {
	    width: 100%;
	    height: 450px;
	    border: 0px;
	}

</style>
</head>
<body>

	
  	
	<div class="program-box">
		
		<!--ifame-->
			<div class="program-ifame">
				<img src="<?php echo $values['pic']; ?>" />
			</div>
		<!--/ifame-->
	</div>
	
	
	<div class="program-btn"><button class="ks-bt bt-pue" onclick="location.href='<?php echo M_URL($this->AppName.'/Index','AppletTempEnter',$id,GP('appletappid-'.$this->appletappid));?>'">确认使用</button><button class="ks-bt ml20" onclick="top.closePopup(window.name)">关闭</button></div>
  
<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>
<script>
		module.require(['$','backstage','nicescroll'],function(){
			loadScorllJs();	
		});
</script>
	
</body>
</html> 








