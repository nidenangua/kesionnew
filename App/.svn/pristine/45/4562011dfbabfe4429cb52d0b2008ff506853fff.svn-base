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
</head>
<style type="text/css">
	.ks-ctn i{color: #e5412c;font-size:12px;}
	.classify-left{
		overflow:hidden
	}
	.classify-left .fl .iconfont{
		font-size:14px;
		color:#999;
	}
	.classify-content li{
		overflow:hidden
	}
	.classify-content li .classify-right .iconfont{
		font-size:16px;
	}
</style>
<body class="ks-wrap">
<div class="ks-wbox bRadius10">
    <!--header-->
    <div class="ks-head-box">
     	<h3 class="ks-head-title2">店铺分类
	     	<div class="fr">	
				<a class="ks-setting-icon fl ml10" onClick="appSetUp({title:'应用设置',type:'app',appid:<?php echo $this->appid; ?>,wxid:<?php echo $this->wxid; ?>})"><i class="iconfont icon-setting"></i></a>	
				<a class="ks-setting-icon fl ml10" target="_blank"  href="https://www.kesion.com/store_help_course/47483"><i class="iconfont icon-qm" ></i></a>		
			</div>
     	</h3>
    </div>
    <div class="ks-head-tab">
 			<ul class="clearfix">
		        <li class="fl <?php   if(ACTION =='Index' || ACTION=='index'){ echo 'curr';} ?>">
      				<a href="<?php echo M_URL($this->AppName.'/Index','Index','',GP('')); ?>" class="alignCenter">课程分类</a>
   			    </li>					
			    <li class="fl <?php if(ACTION =='index2'){ echo 'curr';} ?>">
      				<a href="<?php echo M_URL($this->AppName.'/Index','index2','',GP('')); ?>" class="alignCenter">新闻分类</a>
   			    </li>
                <li class="fl <?php if(ACTION =='index3'){ echo 'curr';} ?>">
                    <a href="<?php echo M_URL($this->AppName.'/Index','index3','',GP('')); ?>" class="alignCenter">教辅周边分类</a>
                </li>
    </div>
    <!--header-->
    <!--header-->
		<!--widget-->
		<div class="ks-head-widget clearfix">
			<div class="ks-search-box fl"></div>			
			<div class="fr">
				<div class="ks-head-el">
				<?php if($type==1){
					$index = 'Index';
				}elseif($type==2){
					$index = 'Index2';
                }elseif($type==3){
                    $index = 'index3';
                } ?>
				<span class="ks-heade-button ks-head-primary mr10" onmousedown="return checkpower({'version':'<?php echo checkIsVipModule($this->wxid,2,false,true);?>'})" onclick="appSetUp({title:'增加分类',type:'addClass',wxid:<?php echo $this->wxid; ?>,types:<?php echo $type; ?>,lastPage:'<?php echo M_URL($this->AppName.'/Index',$index,'',GP('p-'.$page->now_page.',type-'.$type));?>',loopNum:'<?php echo $page->maxperpage;?>'})">
			    <i class="iconfont icon-jiahao"></i> 增加分类</span>
			</div>
		  </div>			
		</div>
		<!--/widget-->
		<div class="classify-box">
			<div class="classify-content">
				 	<ul class="clearfix CTable">
				 		<?php foreach($category as $k=>$v){ 
				 		$UpMoveNum   = $GLOBALS['db']->getOne("select count(*) from `$tablename` where wxid=$this->wxid and parentid=$v[parentid] and orderid<$v[orderid]");  
						$DownMoveNum = $GLOBALS['db']->getOne("select count(*) from `$tablename` where wxid=$this->wxid and parentid=$v[parentid] and orderid>$v[orderid]");?>
				 		<li onclick="getChild(<?php echo $v['categoryid'];?>)" attr="<?php echo $v['parentidpath'];?>" ckdata="0" id="sub<?php echo $v['categoryid'];?>">
				 			<div class="classify-subox clearfix" style="margin-left: <?php echo ($v['depth']-1)*50;?>px;">
				 			<div class="classify-left">
				 				<div class="fl"><!--<span class="classify-subtitle"><?php echo '<span style="color:red;">'.$v['depth'].'级</span>)_'.$v['categoryname'];?></span>-->
				 					<span class="classify-subtitle"><?php echo $v['categoryname'];?></span>
				 					<?php if($v['child']>0){?></=0){?><i class="iconfont icon-jiantou1"></i><?php }?>
				 				</div>
					 			<div class="classify-up" style="right: 120px;z-index: 9;">
					 					<?php if($v['depth']==1){if(arrk($rootcategory,'categoryid',$v['categoryid'])>0){?>
					 					<form target="hidframe"  method="post" action="<?php echo M_URL($this->AppName.'/Index','byOneUp',$v['categoryid'],GP('p-'.$page->now_page.',type-'.ACTION));?>" class="form-horizontal">	
					 					<input type="hidden" name="rootid" value="<?php echo $v['rootid'];?>"/>	
					 					<input type="hidden" name="MoveNum" value="1"/>	
					 					<button type="submit" class="ks-bt bt-pue ks-ctn ml5"> <i class="iconfont icon-jiantoushang"></i> </button>
					 					</form>
					 					<?php }}else{if($v['parentid']!=0&&$UpMoveNum>0){?>
					 					<form target="hidframe"  method="post" action="<?php echo M_URL($this->AppName.'/Index','byAllUp',$v['categoryid'],GP('p-'.$page->now_page.',type-'.ACTION));?>" class="form-horizontal">
					 					<input type="hidden" name="MoveNum" value="1"/>		
										<button type="submit" class="ks-bt bt-pue ks-ctn"><i class="iconfont icon-jiantoushang"></i></button>
										</form>
										<?php }}?>	
					 					
					 					
					 					<?php if($v['depth']==1){if(arrk($rootcategory,'categoryid',$v['categoryid'])<$count-1){?>
					 					<form target="hidframe"  method="post" action="<?php echo M_URL($this->AppName.'/Index','byOneDown',$v['categoryid'],GP('p-'.$page->now_page.',type-'.ACTION));?>" class="form-horizontal">
					 						<input type="hidden" name="rootid" value="<?php echo $v['rootid'];?>"/>
					 						<input type="hidden" name="MoveNum" value="1"/>		
					 						<button type="submit" class="ks-bt bt-pue ks-ctn">
					 							<i class="iconfont icon-jiantouxia-copy"></i>
					 						</button>
					 					</form>
					 					<?php }}else{if($v['parentid']!=0&&$DownMoveNum>0){?>
					 					<form target="hidframe"  method="post" action="<?php echo M_URL($this->AppName.'/Index','byAllDown',$v['categoryid'],GP('p-'.$page->now_page.',type-'.ACTION));?>" class="form-horizontal">
					 						<input type="hidden" name="MoveNum" value="1"/>		
										</form>
										<?php }}?>
					 				</div>
				 				<div class="classify-right operate" onclick="cancelBubble();" style="text-align: right;">
				 					<a href="javascript:void(0)" onClick="appSetUp({title:'应用设置',type:'editClass',categoryid:<?php echo $v['categoryid'];?>,categoryname:'<?php echo $v['categoryname'];?>',wxid:<?php echo $v['wxid'];?>,types:'<?php echo $type; ?>'});">
				 						<em>编辑</em>
				 						<i class="iconfont icon-bianji4"></i>
				 					</a>
				 					<a href="javascript:void(0)" onclick="Confirm('该操作不可逆，是否确认删除此分类?','<?php echo M_URL($this->AppName.'/Index','delCategory',$v["categoryid"],GP('p-'.$page->now_page.',type-'.ACTION));?>');">
				 						<em>删除</em>
				 						<i class="iconfont icon-shanchu1"></i>
				 					</a>
				 					<a href="javascript:void(0)" onClick="appSetUp({title:'应用设置',type:'subClass',categoryid:<?php echo $v['categoryid'];?>,types:<?php echo $type; ?>,wxid:<?php echo $v['wxid'];?>});">
				 						<em>子分类</em>
				 						<i class="iconfont icon-jiahao"></i>
				 					</a>
				 				</div>
				 			</div>
				 			</div>
				 		</li>
				 		<?php } ?>
				 	</ul>
				</div>
			</div>	
			<?php echo NoC($category);?>
			<?php if(!empty($category)){ ?>
	 		<!--footer-->
			<div class="ks-bom clearfix">
				<div id="ksBoxFooter">
					<div class="ks-bom"><?php if(iscategory($this->wxid,$this->appid)){ ?><?php echo $page->show(3); ?><?php }?></div>
				</div> 
			</div>
			<!--/footer-->
			<?php } ?>
	 	
</div>
<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>
<script>
	module.require(['$','backstage'],function(){
		$('.firstClass').addClass('show')	
	});
	function getChild(ID){
	   if($('#sub'+ID).attr('ckdata')=="0"){
			 $('#sub'+ID).attr('ckdata','1');
			 $('#sub'+ID).addClass("show");
			 if($(".CTable").find("li[attr*='"+ID+",']").length>0){
				$(".CTable").find("li[attr*='"+ID+",']").attr('ckdata','1');
				//$(".CTable").find("li[attr*='"+ID+",']").addClass("show");
				$(".CTable").find("li[attr*='"+ID+",']").slideUp(300);
			 }
	    }else{
			 $(".CTable").find("li[attr*='"+ID+",']").slideDown(300);
			 console.log($(".CTable").find("li[attr*='"+ID+",']").length);
			 $('#sub'+ID).attr('ckdata','0');
			 //$('#sub'+ID).removeClass('show');
	   }
	}
	//不触发上级
	function cancelBubble(){
	    var e = window.event || arguments[0];
	    if ( e && e.stopPropagation ) {   
	         e.stopPropagation();
	    } else {
	         window.event.cancelBubble = true;
	    }
	}
</script>
</body>
</html>