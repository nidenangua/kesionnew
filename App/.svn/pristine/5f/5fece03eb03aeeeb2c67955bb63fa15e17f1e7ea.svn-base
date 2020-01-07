<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit"> 
<title>开发者信息</title>
<link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<style>
	.form-row p{font-size: 14px;color: #666;}
	.form-row a{cursor: pointer;}
</style>
</head>
<body class="ks-wrap">
	<div class="ks-wbox bRadius10">
	<!--header-->
    <div class="ks-head-box">
     	
		<h3 class="ks-head-title">开发者信息</h3>
	</div> 
	    <!--header-->
					     
			  
		<!--widget-->
		<div class="ks-head-widget clearfix">
			<div class="ks-search-box fl">
	
			</div>					
					
			<div class="fr">
						
			</div>
					
		</div>
		<!--/widget-->
	     
		<!--table-->
		<form target="hidframe" id="myform"  action="<?php echo M_URL($this->AppName.'/Index','websiteAdd','',GP(''));?>" method="post" class="commentForm" enctype="multipart/form-data">
		   <div class="bg-white mt20 bRadius10" style="padding: 0 20px;">
				   <div id="ksBoxContent">
				     <div class="configTab" style="display:block;">
				    
					  <?php if(!$values){ ?>
			           
							<div class="form-row clearfix">
								<span class="name">是否开通</span>
								<div class="form-switch" open-value="1" >
									<label><input type="radio" name="isshuiyin" value="1"  class="radioInput" onclick="kaitong();">启用</label>
				           			<label><input type="radio" name="isshuiyin" value="0" checked="checked" class="radioInput">不启用</label>
			           			</div>
							</div>
						
					<?php }else{ ?>	
						
						<div class="form-row">
								<span class="name">Appid</span>
								<p><?php echo $values['appid']; ?></p>
								<p>appid是开发识别码是唯一标识</p>
						</div>
						<div class="form-row">
								<span class="name">AppSecret</span>
									<p><?php echo $values['appsecret']; ?>
										<a class="c-86A8F" href="<?php echo M_URL($this->AppName.'/Index','resetSecret','',GP('')); ?>">重置</a></p>
								<p>appsecret是开发识别码秘钥</p>
						</div>
						<div class="form-row">
								<span class="name">状态</span>
									<p><?php if($values['isenable'] ==1){echo '已开启'; }else{echo '已禁用';} ?></p>
								
						</div>
					<?php } ?>			
					 </div>
			   </div>
			</div>   
			
			
		   <!-- <div id="ksBoxFooter">
				<div class="form-footer clearfix">
					<span class="d-inline-block">
					<button type="button" id="StartBtn" id="StartBtn" class="ks-bt bt-pue">保存</button>
					
				 	</span>
				
				</div>
			</div> -->
	   </form>
	    <!--/table-->
	 
	
	</div>
	
	
	<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>
	<script>
		
		module.require(['$','backstage','nicescroll'],function(){
		
			
			loadScorllJs()
			
		});
	
		function kaitong(){
			window.location.href='<?php echo M_URL($this->AppName.'/Index','dosecret','',GP('')); ?>';
		}
	</script>
</body>
</html>