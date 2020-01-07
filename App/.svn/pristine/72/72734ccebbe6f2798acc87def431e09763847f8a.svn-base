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
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>
</head>


<body class="ks-wrap">	
	<!--开始-->
	
 
	
	
	<!--结束-->

<div class="bg-white bRadius10 ks-wbox mt20">
	<div class="ks-head-box">
		<h3 class="ks-head-title2">视频列表</h3>
	 </div>
	 
	 <div class="ks-head-tab">
	 			<ul class="clearfix">
			      	<li class="fl">
				        <a href="<?php echo M_URL($this->AppName.'/Index','index','',GP('')); ?>">主页</a>
				    </li>
				    <li class="fl  curr">
				        <a href="<?php echo M_URL($this->AppName.'/Index','listVod','',GP('')); ?>" >视频列表 </a>
				    </li>
				    <li class="fl" style="display: none;">
				        <a href="<?php echo M_URL($this->AppName.'/Index','playSetting','',GP('')); ?>" >播放器设置 </a>
				    </li>
	     		</ul>
     </div>
     		
     		
		<div id="ksBoxContent">
	        <table class="ks-table mt20">
	           <thead>
	            <tr>
	              <td width="50px">序号</td>
	              <td width="220px">视频</td>
	              <td width="200px">视频Id</td>
	              <td width="200px">大小</td>
	              <td width="200px">总流量</td>
	              <td width="200px">已结算流量</td>
	              <td width="200px">状态</td>
	            </tr>
	            </thead>
	            <?php foreach($values as $k=>$v){ ?>
	            <tr>
	               <td><?php echo $k+1; ?></td>
	              
	               <td>
	                
	                <a href="<?php echo M_URL($this->AppName.'/Index','playvdo','',GP('vdoId-'.$v['vdoId'])); ?>">
	               <img style="width:160px;height:90px;" src="<?php echo $v['vdoImg'] ?>">
	               </a>
	               </td>
	               
	               <td><?php echo $v['vdoId'] ?></td>
	               <td><?php echo $v['vdoSize'] ?></td>
	               <td><?php echo $v['flow'] ?></td>
	               <td><?php echo $v['SettledFlow'] ?></td>
	               <td><?php if($v['status'] == 'PUBLISHED'){ echo '已发布';}elseif($v['status'] == 'RUNNING'){ echo '转码中';}else{ echo '出错请联系管理员';} ?></td>
	            </tr>  
	            <?php } ?>
	        </table>
	    </div>

</div>

<div id="ksBoxFooter" style="height: 120px">
	<div class="ks-bom clearfix">
		
		<div class="fr"><?php echo $page->show(3); ?></div>	
	</div>
</div>

<script src="<?php echo UOOT;?>/Public/common/js/module.js?<?php echo echoHash();?>"></script>

</body>

	<script>
		module.require(['$','backstage','nicescroll'],function(){
				loadScorllJs();

		})
	</script>

</html>
