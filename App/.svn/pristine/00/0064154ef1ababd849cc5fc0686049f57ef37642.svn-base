<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="renderer" content="webkit">
	<title>营销方案</title>

	<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />

	<style>
		.ks-table tr td ,.ks-table tr th{border: 1px solid #eee;vertical-align: top;}
		.ks-table tr td {text-align: left;}
		.ks-table tr:last-child td {border-bottom: 1px solid #eee;}
		.news-box li {position: relative;margin-bottom: 15px;}
		.news-box li .time {position: absolute;right:0 ;top: 0;}
		.news-box li a {position: relative;cursor: pointer;overflow: hidden;padding-right: 30px;box-sizing: border-box;}
		.news-txt {text-overflow: ellipsis;white-space: nowrap;display: block;max-width: 200px;float: left;overflow: hidden;}
		.news-box li a img{position: absolute;right: 0;width: 30px;top: -10px;}
		.hot {color: red;margin-left: 10px;}
		@media  (max-width:1600px ) {
			.news-txt {max-width: 180px;}
		}
	</style>
</head>
<body class="ks-wrap">
	
		<div class=" ks-wbox bRadius10">
			<!--header-->
			<div class="ks-head-box clearfix">
				<h3 class="ks-head-title2 ">营销方案</h3>			
			</div>
		
			<!--header-->
			
			<!--tab-->
			<div class="ks-head-tab">
	 			<ul class="clearfix">
			       <li class="curr"><a href="<?php echo M_URL('h5market/Index','scheme','',GP('appid-26'));?>">营销方案</a></li>
					<li><a href="<?php echo M_URL('h5market/Index','doAddyouxi','',GP('appid-26'));?>">营销工具</a> </li>
					<li><a href="<?php echo M_URL('h5market/Index','','',GP('appid-26'));?>">我的活动</a></li>
					<li><a href="<?php echo M_URL('h5market/Index','marketinglist','',GP('appid-26'));?>">营销订单</a></li>
	     		</ul>
     		</div>	
			<!--/tab-->
			
			<table class="ks-table ks-head-widget">
				<thead>
					
					<tr>
						<?php foreach($values as $k =>$v){ ?>
							<th><?php echo $v['name'];?></th>
						<?php }?>
					</tr>
					
				</thead>
				<tbody>
					<tr>
						<?php foreach($values as $k =>$v){ ?>
							<td  >
								
								<ul class="news-box">
						
		<?php foreach($list[$k] as $kt=>$vt){ ?>
		<li>
			<a title="<?php echo $vt['name']; ?>"  
		<?php if($vt['marketing']==2&&$package<$vt['package']){?>
		onclick="Alert('对不起,你的套餐等级不足,请先升级套餐');"	
		<?php }else{?>
		onclick="addTypeChange('<?php echo M_URL($this->AppName.'/Index','schemeinfo',$vt['id'],GP(''));?>','930px','610px',{title:'方案详情',type:'top'});"	
		<?php }?>		
			><span class="news-txt"><?php echo $vt['name']; ?></span><?php if($vt['marketing']==0){?> <span class="hot";>体验</span>  <?php }?></a>
			<!--<span class="time"><?php echo date('Y-m-d',$vt['addtime']); ?></span>-->
		</li>
		<?php }?>
									<?php echo Noc($list[$k]); ?>
								</ul>
							</td>
						<?php }?>
					</tr>
				</tbody>
			</table>
		</div>
	
	
	<div id="ksBoxFooter">
		<div class="ks-bom clearfix">
			
		</div>
	</div>
	<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>
	<script>
		module.require(['$','backstage','nicescroll'],function(){
			var index =	 $('.emptycss').length;
		 	if (index >=5) {
		 		$('.emptycss').parents('tr').html('<td colspan="5"><div class="emptycss"></div></td>')
		 	}
		})
	</script>
	

</body>
</html>

