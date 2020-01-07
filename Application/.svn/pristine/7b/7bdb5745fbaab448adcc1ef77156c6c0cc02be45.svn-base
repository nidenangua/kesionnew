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
	<link href="<?php echo UOOT;?>Public/app/css/main.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
</head>
<body class="ks-wrap">
	<div class="ks-wbox bRadius10">
		<!--header-->
	    <div class="ks-head-box">
	    	<div class="fr"></div>
	    	<h3 class="ks-head-title2">风格管理
	    		<div class="fr">	
					<a class="ks-setting-icon fl ml10" target="_blank"  href="<?php echo MY_FULLDOMAIN;?>/home/help#anchor34"><i class="iconfont icon-qm" ></i></a>											
				</div>
	    	</h3>
	    </div>
	    <!--header-->
		<div class="ks-head-tab">
 			<ul class="clearfix">
                <?php if ($module[0]==1){?>
		        <li class="<?php if($type==0){echo "curr";}?>"><a href="<?php echo M_URL('Website','websitetemplate',0); ?>">PC网校模板</a></li>
                  <?php
                      }?>
				<!--<li class="<?php if($type==2){echo "curr";}?>"><a href="<?php echo M_URL('Website','websitetemplate',2); ?>">课堂模板</a></li>-->
				<li class="<?php if($type==1){echo "curr";}?>"><a href="<?php echo M_URL('Website','websitetemplate',1); ?>">微门户模板</a></li>
     		</ul>
 		</div>
 		<div class="ks-head-widget clearfix">
 			<!--<a class="ks-bt bt-pue " style="float: right;"  href="<?php echo M_URL('Shop','index','',GP('option-'.($type+1))); ?>">下载更多风格</a>-->
 		</div>
		<!--table-->
		<ul class="blockBoxl clearfix" style="margin-bottom: 0px;">
		
		<?php 
		if($type==1){  //手机风格
            foreach($values as $v){ ?>
		   <!--  text-->
		   <li>
		   	<div class="iframe-box">
		   	 <div class="iframe-iphone">
				 <div class="blockBox1">
                 <?php if(isset($v['tempid']) && $v['tempid'] == $temp){ ?>
                 <div class="curr_mark">正在使用</div><?php }?>
                
					<div class="imgBox"><img src="<?php echo $v['defaultpic'];?>"></div>	
               
			   </div>
		   	</div>
		   	 <div class="blockbox2">
			   	 <div class="inbox">
				 	<div  class="p20">
						<h2 class="titleBox fsize18 alignCenter hLh30"><?php echo $v['tempname'];?></h2>
						<div class="psBox fsize14 c-92 alignCenter hLh30">应用场景：公众号微门户
                        <?php if(isset($v['isedit']) && $v['isedit'] == 1){ ?>
                          (<span style="color:red">编辑过</span>)<?php }?></div>
						<?php if($type==0&&$v['tempid']!=15){?> 
						<div class="clearfix mt15">
					    <a href="<?php echo M_URL('Website','Drag',$v['tempid'],GP('pathid-1')); ?>" target="_blank" class="btn-blue bRadius20 fl alignCenter fsize14 w47">修改界面</a>
			            <a href="<?php echo M_URL('Website','redown',$v['tempid'],GP('type-'.$type)); ?>" onClick="alert('先不开放!');return false;" class="btnBlueBorder fr alignCenter fsize14 bRadius20 w47">模板恢复</a>
						</div>
						<?php }elseif($type==0&&$v['tempid']==15){?>
						<div class="clearfix mt15">
					    <a href="javascript:void(0);" class="block btn-default alignCenter fsize16 bRadius20 mlr w60b">当前系统默认</a>
						</div>	
						<?php }elseif($type==1){ ?> 
						<div class="clearfix iframe-btn mt15">	
						<?php if(isset($v['tempid']) && $v['tempid'] == $temp){ ?>	
						<a href="javascript:;" onclick="top.KTJ_RouteJump('/drag','_blank')" class="ks-bt bt-pur w47">修改界面</a>
						<?php }else{ ?>
						<a href="javascript:void(0);" onClick="Confirm('是否使用此模板','<?php echo M_URL('Website','useTemp',$v['tempid'],GP("temptype-$type")); ?>')" class="ks-bt bt-def  w47">立即使用</a>		
			            <?php }?>
			            </div>
			            <?php }elseif($type==2||$type==3){ ?>	
			            <div class="clearfix  mt15">	
			            	<a href="javascript:void(0);" target="_blank" class="btn-default bRadius20 fl alignCenter fsize14 w47">当前默认模板</a>
			                <a href="<?php echo M_URL('Website','tempBackground',$v['tempid'],GP('p-1')); ?>" class="btnBlueBorder fr alignCenter fsize14 bRadius20 w47">背景设置</a>
			            </div>	
						<?php }?>	
					</div>
				 </div>
			 </div>
			 </div>
		</li>
	    <?php }
          }else{    //PC风格等
                  foreach($values as $v){ 
                      if(isset($v['tempid']) && $v['tempid'] == $temp){ ?>
	    			<li>
				   <div class="blockBox">
					 <div class="imgBox" autoimg="0.8,1"><img src="<?php echo $v['defaultpic'];?>"></div>
					 <div class="inbox">
			 			<div  class="p20">
							<h2 class="titleBox fsize20 c-32 pt22 alignCenter hLh20"><?php echo $v['tempname'];?></h2>
							<div class="psBox fsize14 c-92 pt18 alignCenter hLh14">模板作者：<font class="c-Orange"><?php echo $v['author'];?></font><?php if(isset($v['isedit']) && $v['isedit'] == 1){ ?>
                          (<span style="color:red">编辑过</span>)<?php }?></div>
					
					
							<?php if($type==0&&$v['tempid']!=15){?> 
							<div class="clearfix mt30">
							<a href="<?php echo M_URL('Website','Drag',$v['tempid'],GP('pathid-1')); ?>" target="_blank" class="btn-blue bRadius20 fl alignCenter fsize14 w47">修改界面</a>
                                <a href="<?php echo M_URL('Website','redown',$v['tempid'],GP('temptype-'.$type.',parenttempid-'.$v['tempid'])); ?>" onclick="return (confirm('此操作不可逆，确认从云端还原模板吗？'));" class="btnBlueBorder fr alignCenter fsize14 bRadius20 w47">模板恢复</a>
							</div>
							<?php }elseif($type==0&&$v['tempid']==15){?>
							<div class="clearfix mt30">
							<a href="javascript:void(0);" class="block btn-default alignCenter fsize16 bRadius20 mlr w60b">当前系统默认</a>
							</div>	
							<?php }elseif($type==1){ ?> 
							<div class="clearfix mt30">	
							<a href="<?php echo M_URL('microportal/Index','',$v['tempid'],GP('appid-36')); ?>"class="btn-blue bRadius20 fl alignCenter fsize14 w47">修改界面</a>	
							</div>
							<?php }elseif($type==2||$type==3){ ?>	
							<!--<div class="clearfix mt30">	
		            			<a href="javascript:void(0);" target="_blank" class="btn-default bRadius20 fl alignCenter fsize14 w47">当前默认模板</a>
								<a href="<?php echo M_URL('Website','tempBackground',$v['tempid'],GP('p-1')); ?>" class="btnBlueBorder fr alignCenter fsize14 bRadius20 w47">背景设置</a>
							</div>-->	
							<?php }?>	
						
						
						
						</div>
					 </div>
				   </div>
				 </li>
	     <?php }
		
		  elseif(!isset($v['wxid']))
		 {
		 ?>
				<li> 
				   <div class="blockBox">
					 <div class="imgBox" autoimg="0.8,1"><img src="<?php echo $v['defaultpic'];?>"></div>
					 <div class="inbox">
			 			<div  class="p20">
							<h2 class="titleBox fsize20 c-32 pt22 alignCenter hLh20"><?php echo $v['tempname'];?></h2>
							<div class="psBox fsize14 c-92 pt18 alignCenter hLh14">模板作者：<font class="c-Orange"><?php echo $v['author'];?></font></div>
							<div class="clearfix mt30">
							  <div class="p20 clearfix">
									<!--<button class="could-btn mr10 ks-bt bt-pue" style="opacity: 0;" onClick="skip('<?php echo M_URL('Shop','tempDetail',$v['tempid']); ?>');">模板详情</button>-->
									<button class="could-btn mr10 ks-bt bt-pue" style="opacity: 0;">模板详情</button>
                                <form target="hidframe" method="post" action="<?php  echo M_URL('Website','useTemp',$v['tempid'],GP("temptype-$type")); ?>">
                                    <button class="could-btn ks-bt " type="submit">下载并使用</button>
                                </form>
								</div>
							</div>
						</div>
					 </div>
				   </div>
				 </li>
		<?php }}}?>
		</ul>
		<?php echo NoC($values);?>
        <!--/table-->
                
 		<!--footer-->
		<div class="ks-bom clearfix">
			<div class="fr"><?php echo $page->show(3); ?></div>
		</div>
		<!--/footer-->
	</div>
	<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>
	<script>
		module.require(['$','backstage','nicescroll'],function(){
			loadScorllJs()
		}); 
	</script>
</body>
</html>