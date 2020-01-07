<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="renderer" content="webkit">
	<title>kesion教育平台</title>
	<meta name="Keywords" content="kesion教育平台"/>
	<meta name="Description" content="kesion教育平台" />
	<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />

	<link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
	

</head>
<body class="ks-wrap">
	
	
	
		<div class=" ks-wbox bRadius10">
			 <!--header-->
			     <div class="ks-head-box">
			     		<h3 class="ks-head-title">订单管理</h3>
			     </div>
			 <!--header-->
			     
			<!--tab-->
			<div class="ks-head-tab">
	 			<ul class="clearfix">
			       <li><a href="<?php echo M_URL('h5market/Index','scheme','',GP('appid-26'));?>">营销方案</a></li>
					<li><a href="<?php echo M_URL('h5market/Index','doAddyouxi','',GP('appid-26'));?>">营销工具</a> </li>
					<li><a href="<?php echo M_URL('h5market/Index','','',GP('appid-26'));?>">我的活动</a></li>
					<li class="curr"><a href="<?php echo M_URL('h5market/Index','marketinglist','',GP('appid-26'));?>">营销订单</a></li>
	     		</ul>
     		</div>	
			<!--/tab-->
			
				<!--widget-->
				<div class="ks-head-widget clearfix">
					
					
					<div class="fr">
						<ul class="ks-head-choice">
							
								<li>
										<div class="ks-head-el">
										<button class="ks-heade-button ks-head-primary" type="button" onclick="choiceClick(this)"><i class="icon-filter-2 iconfont "></i></button>
										<div class="ks-head-content ks-head-content-pr" style="width: 360px;">
																							
											<ul class="screen">															
												<li>
							<span>是否付款：</span>
							<div>
								<a href="<?php echo M_URL('h5market/Index','marketinglist','',GP('appid-26,status-3')); ?>" <?php if($status==3){?>class="choice-active"<?php } ?>>不限</a>
								<a href="<?php echo M_URL('h5market/Index','marketinglist','',GP('appid-26,status-1')); ?>" <?php if($status==1){?>class="choice-active"<?php } ?>>已付款</a>
								<a href="<?php echo M_URL('h5market/Index','marketinglist','',GP('appid-26,status-0')); ?>" <?php if($status==0){?>class="choice-active"<?php } ?>>未付款</a>
							</div>
						</li>
						

											</ul>
												
										</div>
									</div>
								</li>
							
						</ul>
					</div>
					
					
				</div>
				<!--/widget-->
			
			
			<table class="ks-table">
				<thead>
					<tr>
						<th>订单号</th>
						<th>下单时间</th>
						<th>商品名称</th>
						<th>商品类型</th>
						<th>金额</th>
						<th>付款状态</th>
						<th>订购人信息</th>
						
					 </tr>
				</thead>
				<tbody>
					<tr>
						<?php foreach($values as $k =>$v){ ?>
						<tr>
							 <td><?php echo $v['ordersn']; ?></td>
							 <td><?php echo date('Y-m-d H:i:s',$v['adddate']); ?></td> 
							 <td class="td_left"><?php  if(empty($v['title'])){ echo $v['title'];}else{ echo $v['title'];} ?></td> 
							 <td>
							 	<?php 
							 		switch ($v['type'])
									{
									case 0:
									  echo '课程';
									  break;  
									case 1:
									  echo '互动';
									  break;
									case 5:
									  echo '试卷';
									  break;
									default:
									  break;
									}
							 	?>
							 </td> 
							 <td>
							 	<?php 
							 		echo $v['price'];
							 	?>
							 </td>
							 <td><?php if($v['paystatus'] == 0){ echo '未付款';}else{ echo '已付款';} ?></td>
							 <td><?php echo $v['username']; ?></td>
						</tr>
						<?php } ?>
						
					</tr>
					
				</tbody>
				
				
			</table>
			<?php echo Noc($values); ?>
				<div class="ks-bom clearfix">
					<div class="fr"><?php echo $page->show(3); ?></div>
				</div>
		</div>
		
	</div>
	
	
		
	
	<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>
	<script>
		module.require(['$','backstage','nicescroll'],function(){
			var index =	 $('.emptycss').length;
		 	if (index >=5) {
		 		$('.emptycss').parents('tr').html('<td colspan="5"><div class="emptycss"></div></td>')
		 	}
		 	loadScorllJs()
		})
 	
	</script>
	

</body>
</html>

