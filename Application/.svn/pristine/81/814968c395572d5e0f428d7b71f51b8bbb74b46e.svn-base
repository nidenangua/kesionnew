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
<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />

</head>
<body class="ks-wrap">
	
	<div class="ks-wbox bRadius10">
		<!--header-->
	    <div class="ks-head-box">
	     	
			<h3 class="ks-head-title2">网站设置
			
				<div class="fr">	
					<a class="ks-setting-icon fl ml10" target="_blank"  href="<?php echo MY_FULLDOMAIN;?>/home/help#anchor33"><i class="iconfont icon-qm" ></i></a>											
					</div>
			</h3>
	    </div>
	    <!--header-->
		<!--tab-->
     	<div class="ks-head-tab">
     			<ul class="clearfix">
     				<li><a href="<?php echo M_URL('config/Index','','',GP('appid-1'));?>">基本配置</a></li>
     				<li class="curr"><a href="<?php echo M_URL('Website','websitedomain'); ?>">域名设置</a></li>
     				<li><a href="<?php echo M_URL('login/Index','','',GP('appid-20'));?>">第三方登录</a></li>
     				<li><a href="<?php echo M_URL('Website','websiteContact'); ?>">联系方式</a></li>
     				<li><a href="<?php echo M_URL('config/Index','wxinfo','',GP('appid-1'));?>">店铺介绍</a></li>
     			</ul>
     	</div>
    	 <!--/tab-->
					     
	
		     
			<!--table-->
			<form target="hidframe" action="<?php if(isset($info)){if(!empty($info['domain'])){echo M_URL('Website','editDomain');}else{echo M_URL('Website','addDomain');}}else{echo M_URL('Website','addDomain');} ?>" method="post">
		     <div width="100%" cellpadding="0" cellspacing="0" border="0" class="form-box">
			   <div class="form-row" >
			     <span class="name">二级域名</span>
				 <div class="clearfix">
				   	<label>
					  	<span class="titleName fsize16 c-92 fl mt10"><?php echo(MY_HTTPS);?><?php $dd=strstr($info['domain'],'.'.PLATDOMAIN,true);echo $dd;?>.<?php echo PLATDOMAIN;?></span>
					  	<a class="ml10 ks-bt bt-pur" href="<?php echo MY_HTTPS.$dd.'.'.PLATDOMAIN.'';?>" target="_blank">访问网站</a>
				   	</label>
				 </div>
			   </div>
		       <?php if(wx_version_itemvalue(3) == 0){?>	
		       <div class="form-row" >
			     <span class="name">独立域名</span>
				 <div class="clearfix" style="line-height: 28px;">
				  <!-- <label class="radioLabel fl" ><input type="radio" value="1" class="radioInput" <?php if(wx_version_itemvalue(3) == 0){echo 'checked="checked"';}else{echo 'disabled ';} ?>><span class="radioName fsize14 c-92">无权限</span></label>
				   <label class="radioLabel fl" ><input type="radio" value="0" class="radioInput" <?php if(wx_version_itemvalue(3) == 1){echo 'checked="checked"';}else{echo 'disabled ';} ?>><span class="radioName fsize14 c-92">有权限</span></label>
				 	-->
                     <div class="text-warning">当前套餐不支持绑定独立域名</div>
				 </div>
			   </div>
			   <div class="form-row mt10">
		           <?php if(wx_version_itemvalue(3) == 0){?>
		           <a href="<?php echo M_URL('Website','Packagelist');?>" class="ks-bt bt-pue bt-medium">马上升级套餐</a>
		           <?php }?>
			   </div>
			   <?php }elseif(wx_version_itemvalue(3) == 1){?>
		       <div class="form-row" >
			    <div class="name">独立域名</div>
				<div class="clearfix">
				      <span class="titleName fsize16 c-92 fl mr10 mt10">http://</span>
					  <span class="sBox fsize14 c-92 mt7 fl mr10">

						   <?php
							if($info['status']==1 && !empty($info['predomain'])){  //审核通过
								 echo '<input type="text" disabled="disabled" name="domain" value="'.$info['predomain'].'"  class="form-textbox"/>';
							 }else {
								 echo '<input type="text" name="predomain" value="'.$info['predomain'].'"  class="form-textbox"/>';
							 }
                           ?>
		            
		              </span>
		              <span class="fl">
					 <?php
					 if (!empty($info['predomain']))
					 {
						 if($info['status']==0){ 
						  echo '<span class="titleName fsize16 fl mt10">审核中...</span>';
						 } elseif($info['status']==2){ 
						  echo '<span class="titleName fsize16 fl mt10" style="color:green;">审核未通过</span>';
						 }else if($info['status']==1){
				    		echo '<a class="mt10 fl ml10 ks-heade-button ks-head-primary" href="http://'.$info['predomain'].'" target="_blank">访问网站</a>';
						 }
			     	 }else{ 
						    echo '<span class="d-inline-block"><input type="submit" class="ks-bt bt-pue" value="提交审核" name="confirm"></span>';
					 } 
					 ?>
				   </span>
				</div>
				<div class="mt20"><a class="c-86A8F" href="<?php echo M_URL('Website','domainRules');?>">查看《科汛V名师独立域名命名规则》</a></div>
				<div class="name">注意事项</div>
				 	<div class="rightTd alignLife c-success" style="width: 600px;">
				  		<div>1、独立域名 一经设置不可更改，请谨慎填写（也可在开通成功后在您的网校后台填写）；</div>
		           		<div>2、平台会收回被恶意使用的知名品牌、竞争对手品牌的域名名称，最终解释权归平台所有；</div>
		           		<div>3、绑定独立域名，请在开通权限后把域名做CNAME解析，记录值为：cname.kesion.com；</span></div>
				 	</div>
			   </div>
		       <?php }?>
			 </div>
		
		  
	        <!--/table-->
	       
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