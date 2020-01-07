<!DOCTYPE html>
<html>
<head lang="en">
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit">
<title>云市场</title>
<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/shop.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />

</head>

<body class=" ks-wrap">
	<div class="ks-wbox bRadius10">
	<!--header-->
     <div class="ks-head-box">
     	<h3 class="ks-head-title2">应用中心</h3>
     </div>
     <!--header-->

			
		 <div class="ks-head-tab">
 			<ul class="clearfix">
                 <li <?php if($option==0){?> class="curr" <?php }?>>
                     <a href="<?php echo M_URL('Service','myapp'); ?>">挑选应用</a>
                 </li>
 				<li><a href="<?php echo M_URL('Service','upgrade');?>">升级套餐</a></li>
				<li><a href="<?php echo M_URL('Shop','CapacityService'); ?>">扩容服务</a> </li>
				<li><a href="<?php echo M_URL('Service','orderList'); ?>">我的订单</a> </li>
				<li><a href="<?php echo M_URL('Service','Cart'); ?>">我的购物车</a> </li>
 			</ul>
     	</div>
		

		<!--widget-->
		<div class="ks-head-widget clearfix">
			<div class="ks-search-box fl">
				<ul class="class-tab clearfix job-mtb">
                    <button class="ks-heade-button ks-head-primary" onclick="window.location.href='<?php echo M_URL('Service','myapp'); ?>'">返回我的应用</button>

			    </ul>
			</div>					
					
			<div class="fr">
				<?php if($option==0){?>
					<div class="ks-head-el">
						<button class="ks-heade-button ks-head-primary" type="button" onClick="choiceClick(this)"><i class="icon-filter-2 iconfont "></i></button>
					
					
						<div class="ks-head-content ks-head-content-pr w300" >
						<ul class="screen">		
							<li>
								<span>状态：</span>
								<div class="clearfix" >
									<a style="float: left;" href="<?php echo M_URL('Shop','index','',GP('option-0,isopen-0')); ?>" <?php if($isopen==0){?>class="active"<?php }?>>所有</a>
									<a style="float: left;" href="<?php echo M_URL('Shop','index','',GP('option-0,isopen-1')); ?>" <?php if($isopen==1){?>class="active"<?php }?>>已开通</a>
									<a style="float: left;" href="<?php echo M_URL('Shop','index','',GP('option-0,isopen-2')); ?>" <?php if($isopen==2){?>class="active"<?php }?>>未开通</a>
								    <!--<a href="//ks.kesion.com/home.html/h5market/Index/index/1?appid-26,stype-2" class="">未发布</a>-->
								</div>
							</li>
						</ul>
						</div>
            		</div>
            	<?php }?>			
			</div>	
		</div>
		<!--/widget-->
	     
		<!--table-->
		<div class="bRadius10">	
	
		<!--选项卡end-->

	<div class="cloud-container clearfix">

	<?php if($option==5){?>	
	
	<!--网校科汛V名师模板-->
	<?php }elseif($option==3||$option==4){?>
	<div class="ks-head-widget clearfix">
 			<a class="ks-bt bt-pue " style="float: right;"  href="<?php echo M_URL('Website','websitetemplate',($option-1)); ?>">进入我的风格</a>
 	</div>	
	<?php foreach($values as $k=>$v){ ?>
	<div class="cloud-td">
	<div class="cloud-inner clearfix">
		<div class="could-tbox">
			<div class="could-imgs" autoimg="1,1.7"><img onerror="this.src='<?php echo nopic(3);?>'" src="<?php echo $v['defaultpic']; ?>" style="vertical-align: middle"></div>
			<div class="could-tities">
				<div class="mt10"><?php echo $v['tempname'].'（'.$v['installdir'].'）';?></div>
				<div  class="could-intron"><?php echo $v['intro']?></div>
				<div class="mt10"> <span class="fl">
					<i class="fsize18 c-red"><?php if(!empty($v['package'])){if($v['package']=='v1'){echo wx_version_itemvalue('','',2);}elseif($v['package']=='v2'){echo wx_version_itemvalue('','',3);}elseif($v['package']=='v3'){echo wx_version_itemvalue('','',4);}} ?></i>以上可用
				<!--<?php if($v['price']==0){ ?><i class="fsize18">免费</i><?php }else{?>
			   ￥<i class="fsize18"><?php echo $v['price']; ?></i><i class="fsize14 " style="color:#d82005">/<?php if($v['chargetype']==0){echo '月';}elseif($v['chargetype']==1){echo '季';}elseif($v['chargetype']==2){echo '年';}; ?></i>
			   <?php }?>-->
			   </span></div>
			</div>
		</div>
		<div class="could-marks">
			<div class="p20 clearfix" >
				<button class="could-btn mr10 ks-bt bt-def" style="display: none;">模板详情</button>
				<!--<button class="could-btn mr10 ks-bt bt-def" onClick="skip('<?php echo M_URL('Shop','tempDetail',$v['tempid']); ?>');">模板详情</button>  -->
				<form target="hidframe" method="post" action="<?php echo M_URL('Shop','classdown',$v['tempid'],GP('type-'.($option-1))); ?>">
				<button class="could-btn ks-bt fn" type="submit">下载并导入</button>
				</form>
			</div>
		</div>
	</div>
	</div>	
	<?php }}elseif($option==2){?>
	<div class="ks-head-widget clearfix">
 			<a class="ks-bt bt-pue " style="float: right;"  href="<?php echo M_URL('Website','websitetemplate',($option-1)); ?>">进入我的风格</a>
 	</div>	
	<?php foreach($values as $k=>$v){ ?>
	<div class="cloud-td">
	<div class="cloud-inner clearfix">
		<div class="could-tbox">
			<div class="could-imgs could-img2" autoimg="1,0.8"><img onerror="this.src='<?php echo nopic(3);?>'" src="<?php echo $v['defaultpic']; ?>" style="vertical-align: middle"></div>
			<div class="could-tities">
				<div class="mt10"><?php echo $v['tempname'].'（'.$v['installdir'].'）';?></div>
				<div  class="could-intron"><?php echo $v['intro']?></div>
				<div class="mt10"> <span class="fl">
					<i class="fsize18 c-red"><?php if(!empty($v['package'])){if($v['package']=='v1'){echo wx_version_itemvalue('','',2);}elseif($v['package']=='v2'){echo wx_version_itemvalue('','',3);}elseif($v['package']=='v3'){echo wx_version_itemvalue('','',4);}} ?></i>以上可用
				<!--<?php if($v['price']==0){ ?><i class="fsize18">免费</i><?php }else{?>
			   ￥<i class="fsize18"><?php echo $v['price']; ?></i><i class="fsize14 " style="color:#d82005">/<?php if($v['chargetype']==0){echo '月';}elseif($v['chargetype']==1){echo '季';}elseif($v['chargetype']==2){echo '年';}; ?></i>
			   <?php }?>-->
			   </span></div>
			</div>
		</div>
		<div class="could-marks">
			<div class="p20 clearfix" >
				<button class="could-btn mr10 ks-bt bt-def" style="display: none;">模板详情</button>
				<!--<button class="could-btn mr10 ks-bt bt-def" onClick="skip('<?php echo M_URL('Shop','tempDetail',$v['tempid']); ?>');">模板详情</button>  -->
				<form target="hidframe" method="post" action="<?php echo M_URL('Shop','classdown',$v['tempid'],GP('type-'.($option-1))); ?>">
				<button class="could-btn ks-bt fn" type="submit">下载并导入</button>
				</form>
			</div>
		</div>
	</div>
	</div>	
	<!--网校app应用-->
	<?php }}elseif($option==0){?>
	<table class="ks-table">	
		<thead>
			<tr>
				<td>应用图标</td>
				<td  style="text-align: left;">应用名称</td>
				<td  style="text-align: left;">应用分类</td>
				<td>应用介绍</td>
				<td>使用权限</td>
				<td>开通数量</td>
				<td>是否开通</td>
			</tr>
		</thead>
	<?php foreach($values as $k=>$v){
    if($v['appid']==6){continue;}?>
			<tr>
				<td style="cursor:pointer" onClick="location.href='<?php echo M_URL('Shop','appDetail',$v['appid']);?>'">
					<img onerror="this.src='<?php echo nopic(3);?>'" src="<?php echo $v['defaultpic']; ?>" style="vertical-align: middle;width: 70px;height: 75px;">
				</td>
				<td style="text-align: left;cursor:pointer" onClick="location.href='<?php echo M_URL('Shop','appDetail',$v['appid']);?>'">
					<?php echo $v['appname'].'（'.$v['appename'].'）';?>
					<?php if($v['isrec']==1){?>
					<span class="ks-commit-red">热</span><span class="ks-commit-yellow">荐</span>
					<?php }?>

                  
				</td>
				<td style="text-align: left;">
				<?php $catename = $this->cache->GetA('appcategory','categoryid',$v['categoryid'],'categoryname'); if(!is_array($catename)){echo $catename;}else{$catename='';echo '---';}?>
				</td>
	
				<td style="width:680px;text-align: left;color:#888;cursor:pointer"  onClick="location.href='<?php echo M_URL('Shop','appDetail',$v['appid']);?>'"><?php echo $v['shortdesc']; ?></td>	
				<td style="cursor:pointer">
                    <!-- <?php if($v['price']<=0){ ?>
                     <i class="fsize18">免费</i><?php }else{?>
			          ￥
                    <i class="fsize18">
                        <?php echo $v['price']; ?>
                    </i>
                    <i class="fsize14 " style="color:#d82005">
                        /<?php if($v['appchargetype']==0){echo '月';}elseif($v['appchargetype']==1){echo '季';}elseif($v['appchargetype']==2){echo '年';}; ?>
                    </i>
                    <?php }?>-->
                    <?php
                          $showtips=wx_showappfree($v['allowversion']);
                          if (!empty($showtips)){
                              echo '<div style="color:green;">'.$showtips.'</div>';
                          }
                     
                    ?>
                </td>		
				<td style="cursor:pointer" onClick="location.href='<?php echo M_URL('Shop','appDetail',$v['appid']);?>'"><?php echo $v['installs']; ?></td>
				<td>
				<?php if(appisopen($this->wxid,$v['appid'])==1){ ?>
                    <button  class="could-save ks-bt bt-def" style="float: none;">您已开通</button>
				<?php }elseif(appisopen($this->wxid,$v['appid'])==2){?>
				<button onClick="empower1('<?php echo($catename);?>');doNone(event);" class="could-saved ks-bt bt-pue" style="float: none;">未开通</button>
                    <?php }elseif(appisopen($this->wxid,$v['appid'])==0){
                            if (wx_checkappisallow($v['appid'],$this->wxid)){  //免费应用，或是收费应用，对应套餐免费的情况可以立即开通
                            ?>
				          <button onClick="oppenFast(this,'<?php echo $v['appname'];?>','<?php echo M_URL('Index','open',$v["appid"]); ?>','<?php echo M_URL(GC($v['basictype']).'/Index','','',GP('appid-'.$v['appid'])); ?>');doNone(event);" cate="<?php echo $v['categoryid']; ?>"  class="could-saved ks-bt bt-pue" style="float: none;">立刻开通</button>	
                        <?php }else{?>
                            <button class="could-saved ks-bt" style="float: none;">没有权限</button>
                          <!--<button onclick="location.href='<?php echo M_URL('Service','confirmService','',GP('numb-1,appids-'.$v["appid"])); ?>'" class="could-saved ks-bt bt-pue" style="float: none;">立刻订购</button>-->
                      <?php }?>
				<?php }?>
				</td>
				</tr>
	<?php }?>	
	</table>	
	<!--网校门户模板-->
	<?php  }elseif($option==1){?>
	<div class="ks-head-widget clearfix">
 		<a class="ks-bt bt-pue " style="float: right;"  href="<?php echo M_URL('Website','websitetemplate',($option-1)); ?>">进入我的风格</a>
 	</div>		
	<?php foreach($values as $k=>$v){ ?>	
	<div class="cloud-td">
	<div class="cloud-inner clearfix">
		<div class="could-tbox">
			<div class="could-imgs"><img onerror="this.src='<?php echo nopic(3);?>'" src="<?php echo $v['defaultpic']; ?>" style="vertical-align: middle"></div>
			<div class="could-tities">
				<div class="mt10"><?php echo $v['tempname'].'（'.$v['installdir'].'）';?></div>
				<div  class="could-intron"><?php echo $v['intro']?></div>
				<div class="mt10"> <span class="clearfix">
					<i class="fsize18 c-red"><?php if(!empty($v['package'])){if($v['package']=='v1'){echo wx_version_itemvalue('','',2);}elseif($v['package']=='v2'){echo wx_version_itemvalue('','',3);}elseif($v['package']=='v3'){echo wx_version_itemvalue('','',4);}} ?></i>以上可用
				<!--<?php if($v['price']==0){ ?><i class="fsize18">免费</i><?php }else{?>
			   ￥<i class="fsize18 c-red"><?php echo $v['price']; ?></i><i class="fsize14 " >/<?php if($v['chargetype']==0){echo '月';}elseif($v['chargetype']==1){echo '季';}elseif($v['chargetype']==2){echo '年';}; ?></i>
			   <?php }?>-->
			   </span></div>
			</div>
		</div>
		<div class="could-marks">
			<div class="p20 clearfix">
				<!--<button class="could-btn mr10 ks-bt bt-pue" style="opacity: 0;" onClick="skip('<?php echo M_URL('Shop','tempDetail',$v['tempid']); ?>');">模板详情</button>-->
				<form target="hidframe" method="post" action="<?php echo M_URL('Shop','yunDown',$v['tempid'],GP('type-'.($option-1))); ?>">
				<button class="could-btn ks-bt fn" type="submit">下载并导入</button>
				</form>
			</div>
		</div>
	</div>
	</div>
	<!--网校门户小程序模板  end-->
	<?php }} ?>	
	</div>
	<?php echo NoC($values);?>	
	</div>
	    <!--/table-->
	 	<?php if(count($values)!=0){ ?>	           
		<!--footer-->
		<div class="ks-bom mt20 clearfix">
			
			<div class="fr">
				<?php echo $page->show(3); ?>	
			</div>
		</div>
		<!--/footer-->
		<?php } ?>	
	</div>
	<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>
	<script>
		module.require(['$','backstage','nicescroll','cookie'],function(){
			loadScorllJs()
			$('#ks-content').height(window.innerHeight - $('.title-head').outerHeight()-$('#cloud-taps').outerHeight()-$('.footer-page').outerHeight());
			window.onresize = function(){
				$('#ks-content').height(window.innerHeight - $('.title-head').outerHeight()-$('#cloud-taps').outerHeight()-$('.footer-page').outerHeight());
			};loadScorllJs('#ks-content');
			$('.h5-tab li').click(function(){
				var index = $(this).index();
				$(this).addClass('active').siblings().removeClass('active');
			})
		});
	    /*授权认证*/
		function empower1(modulename){
		   
			top.KTJ_TipsDialog('请在新窗口中完成主模块【'+modulename+'】的开通！<a href="https://store.kesion.com/home/questionDetail/37" style="color:#2a75ed">查看开通教程</a>',{
				buttons:[
					{
					name:'确认',
					type:'primary'
				}
				]
			})		
			
		}
		function addCart(appid){
			var url = "<?php echo M_URL('Ajax','addCart');?>";
			$.ajax({
				type:"post",
				url:url,
				data:{'appid':appid},
				dataType:"json",
				success:function(data){
					if(data==0){
						var cartNum = $("#cartNum").html();
						$("#cartNum").html(parseInt(cartNum)+1);
						Alert('添加购物车成功');
					}else if(data==-1){Alert('该商品已经在购物车了喔');}
				}
			});
		}
		function oppenFast(t,title,url,myurl){
		    var cate  = $(t).attr('cate');
	        $.ajax({
	            type:"get",
	            url:url,
	            success:function(data,textStatus){
	            	if(data.result=='succeed'){
	            		 //$.cookie('indoor','/home.html/default/Shop/index?<?php echo GP('option-0');?>',{expires:7,path:'/'});
				         location.reload();
	            	}else if(data.result=='error'){
                         Alert(data.msg);
                    }else{
	            		$('body').append(data);
	            	}
	           },
	           error:function(){
				   //location.reload();
	               //Alert("网络延迟,重新操作!");
	           }
	        })
		};
		
	</script>

</body>
</html>





