<!DOCTYPE html>
<html>
<head lang="en">
<meta charset="UTF-8">
<title></title>
<link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/html5.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />

<style>
	.tb-vip {position: absolute;top: 0;left: 0;}
	.tb-hot {position: absolute;top: 0;right: 0;}
</style>
</head>
<body class="ks-wrap">
	

		
	
		<div class="ks-wbox bRadius10">
			<!--header-->
			<div class="ks-head-box clearfix">
				<h3 class="ks-head-title2 ">营销工具</h3>			
			</div>		
			<!--header-->
			
			<!--tab-->
			<div class="ks-head-tab">
	 			<ul class="clearfix">
			       <li ><a href="<?php echo M_URL('h5market/Index','scheme','',GP('appid-26'));?>">营销方案</a></li>
					<li class="curr"><a href="<?php echo M_URL('h5market/Index','doAddyouxi','',GP('appid-26'));?>">营销工具</a> </li>
					<li><a href="<?php echo M_URL('h5market/Index','','',GP('appid-26'));?>">我的活动</a></li>
					<li><a href="<?php echo M_URL('h5market/Index','marketinglist','',GP('appid-26'));?>">营销订单</a></li>
	     		</ul>
     		</div>	
			<!--/tab-->
			
			
			<!--widget-->
				<div class="ks-head-widget clearfix">
					
					<div class="fl">
						<div class="ks-search-box">
							
							<!--搜索框组件-->
							<select class="w150 inputText bRadius5 fl" id="keytype" name="type">
								<option value="1" selected="selected">游戏名称</option>
							</select>
							<div class="ks-top-search fl">
								<form target="hidframe" class="fr">
								<input type="text" class="sc-text" name="searchText" id="keyword"  value="<?php if(isset($keyword))echo $keyword;?>">
				                
				                <button type="submit" class="ks-head-search" onClick="searchByClass('<?php echo GP('p-'.$p); ?>','<?php echo M_URL($this->AppName.'/Index','doAddyouxi'); ?>','<?php echo URL_MODEL;?>')"><i class="iconfont icon-sousuo"></i></button>  
				                
				             </form>   
							</div>
							



							<!--搜索框组件-->
	
						</div>					
					</div>
				
					
					
				</div>
				<!--/widget-->
					
			
			
		
		<div class="H5-gameListConts " >
		
			
			<ul class="H5-gameList">
			<li>
				<!--选项卡-->
				<div class="h5-tab">
					<ul class="clearfix">
						<li <?php if($tab==1){ echo 'class="active"';}?> onClick="window.location='<?php echo M_URL($this->AppName.'/Index','doAddyouxi','',GP('p-'.$page->now_page.',appid-'.$this->appid.',tab-1,option-0,ispad-'.$ispad,true)); ?>'">全部</li>
						<li <?php if($tab==2){ echo 'class="active"';}?>>节日 <i class="iconfont icon-jiantou1"></i></li>
						<li <?php if($tab==3){ echo 'class="active"';}?> onClick="window.location='<?php echo M_URL($this->AppName.'/Index','doAddyouxi','',GP('p-'.$page->now_page.',appid-'.$this->appid.',tab-3,option-300,ismode-1,ispad-'.$ispad,true)); ?>'">抽奖活动</li>
						<li <?php if($tab==4){ echo 'class="active"';}?> onClick="window.location='<?php echo M_URL($this->AppName.'/Index','doAddyouxi','',GP('p-'.$page->now_page.',appid-'.$this->appid.',tab-4,option-301,ismode-2,ispad-'.$ispad,true)); ?>'">助力活动</li>
						<li <?php if($tab==5){ echo 'class="active"';}?> onClick="window.location='<?php echo M_URL($this->AppName.'/Index','doAddyouxi','',GP('p-'.$page->now_page.',appid-'.$this->appid.',tab-5,option-302,ismode-3,ispad-'.$ispad,true)); ?>'">排行活动</li>
						
					</ul>
					<?php if($ispad ==0){ $pad =1;}else{ $pad =0;} ?>
					<div class="h5-active fr" onclick="window.location.href='<?php echo M_URL($this->AppName.'/Index','doAddyouxi','',GP('p-'.$page->now_page.',appid-'.$this->appid.',tab-'.$tab.',option-'.$option.',ismode-'.$ismode.',ispad-'.$pad,true));?>'"> 
						<label class="mr20 fl"><input type="checkbox" <?php if($ispad==1){ echo 'checked';} ?> class="select-checks selectAll">Pad招生宝活动</label>
					</div>
				</div>
				<div class="h5-tabox">
					<div class="h5-tablist"  <?php if($tab==2){ echo 'style="display: block;"';}?>>
						<ul>
							<li <?php if($option==0){ echo 'class="active"';}?>><a href="<?php echo M_URL($this->AppName.'/Index','doAddyouxi','',GP('p-'.$page->now_page.',appid-'.$this->appid.',tab-2,option-0',true)); ?>">不限</a></li>
							<?php foreach($festivals as $k =>$v){ ?>
								<li <?php if($option==(200+$v['id'])){ echo 'class="active"';}?>><a href="<?php echo M_URL($this->AppName.'/Index','doAddyouxi','',GP('p-'.$page->now_page.',appid-'.$this->appid.',tab-2,option-'.(200+$v['id']).',istime-'.$v['id'].',ispad-'.$ispad,true)); ?>"><?php echo $v['name']; ?></a></li>
							<?php } ?>
						</ul>
					</div>
					
				
					
				</div>
				<!--选项卡end-->
				<div class="H5-gameMedia clearfix">
					<ul>
						
						
						<?php foreach($h5s as $k=>$v){?>	
							
							<li class="col-2 col-md-3">
								<div class="tbMargin">
									<div class="tbCont">
										<?php if($v['marketing'] == 2){ ?>
										<div class="tb-vip"><img src="<?php echo UOOT;?>Public/app/images/classIcon/VIP.png"></div>
										<?php }?>
										<?php if($v['ishot']){?>
										<div class="tb-hot"><img src="<?php echo UOOT;?>Public/app/images/classIcon/hot.png"></div>
										<?php }?>
										<img  autoimg="1.7777,1" src="<?php echo Img($v['ico']);?>" alt="">
											
										<p class="mark"><?php echo $v['h5name']; ?></p>
										
										<div class="maskCont">
											<div class="mask"></div>
											<div class="maskAll">
												<!--<div class="content-top clearfix">
													<?php if($v['ishot']){?><span>新</span><?php }?>
													<?php if($v['isnew']){?><span>热</span><?php }?>
												</div>-->
												<div class="tip">使用次数：<span><?php if($v['marketing'] == 0 ){echo '免费使用';}elseif($v['marketing'] == 1){ echo $v['number'].'次';}elseif($v['marketing'] == 2){ echo $v['package'].'以上用户免费使用';} ?></span></div>
												<img src="<?php echo UOOT.'Images/QRcode/'.createQRcode(ROOT.'Images/QRcode/','http://ks.kesion.com/h5market/inh5game?h5id='.$v['h5id'].'&wxid=2','L',4,'qrcode');?>?>" alt="">
												<button onclick="addTypeChange('<?php echo M_URL($this->AppName.'/Index','markinfo',$v['id'],GP(''));?>','800px','700px',{title:'<?php echo $v['h5name']; ?>',type:'top'});">预览</button>
												<button onclick="javascript:window.location.href='<?php echo M_URL($this->AppName.'/Index','cjgame',$v['id'],GP(''));?>'">制作(<?php if($v['marketing'] == 0 ){echo '免费使用';}elseif($v['marketing'] == 1){ echo $v['usernumber'].'次';}elseif($v['marketing'] == 2){ echo $v['package'].'以上用户免费使用';} ?>)</button>
											</div>
										</div>
									</div>
								</div>
	
							</li>					
						
						
						<?php } ?>
					</ul>
					
					<?php echo NoC($h5s);?>
				</div>
			</li>
		</ul>
	</div>
	<div class="ks-bom clearfix">
		<div class="fr"><?php echo $page->show(3); ?></div>
	</div>
	</div>
		
</div>		
	

	

<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>
<script>
			
	module.require(['$','backstage'],function(){
		
		$('.h5-tab li').click(function(){
			var index = $(this).index();
		
			$(this).addClass('active').siblings().removeClass('active');
			if(index==1){
				$('.h5-tablist').slideDown();
			}
		
			
			
		})

	})
</script>
</body>
</html>