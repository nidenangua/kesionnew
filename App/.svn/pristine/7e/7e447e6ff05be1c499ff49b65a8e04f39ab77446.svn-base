<!doctype html>
<html>
<head>
	<meta charset="UTF-8" />
    <meta name="viewport" content="initial-scale=1, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0, width=device-width">
	<meta name="screen-orientation" content="portrait">
	<title>kesion教育平台</title>
	<meta name="Keywords" content="kesion教育平台"/>
	<meta name="Description" content="kesion教育平台" />
	<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/app/css/page.css?<?php echoHash(); ?>" rel="stylesheet" />
	<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
	<script src="<?php echo UOOT;?>Public/popup/js/kesion.popup.js"></script>

</head>
<style type="text/css">
	body{background: #37a7ed0a;}
	.nodata2{
		width: 6rem;
	    height: 6rem;
	    background: url(../Public/wechat/images/nodata3.png)no-repeat;
	    display: block;
	    margin: 14rem  auto 0;
	    background-size: contain;
	}
</style>
<body>
	<div class="page-coupon">
		
		<ul class="quan">
			<?php if($values){ foreach($values as $k =>$v){ ?>
			<li>
				<div class="coupon-bg">
					<div class="coupon-box">
						<div class="box-head">
							优惠券码：<a class="code"><?php echo $v['code']; ?></a>
							
						</div>
						<div class="box-cont">
							<div class="cont-box">
							<h3>现金优惠券<span class="redm">￥<?php echo $v['money'];?></span></h3>
								<p>有效期至：<?php if($v['awarddate']==0){ echo '无期限';}else{ echo date('Y.m.d H:i',$v['redemptionendtime']);} ?></p>
								<p>兑奖方式：<?php if($v['redemptionmethod'] == 0 ){ echo '线上';}else{ echo '线下';} ?>奖励</p>
								<?php $time = ceil(($v['redemptionendtime']-time())/86400); ?>
								<span><?php if($v['awarddate']==1){?>剩<?php echo $time; ?>天<?php } ?></span>
								<a href="https://<?php echo M_URL('h5market','Micourse') ?>">去使用</a>
							</div>
							
							
						</div>
						
					</div>
					
					
				</div>
				
				
			</li>
			<?php }}else{echo '<div class="nodata2"></div>'; }?>
			
		</ul>
		
		<div class="more" id="passd">
			<br />
			<a href="javascript:;">查看历史优惠券</a>
		</div>
		
		
		<ul class="pass">
			<?php if($values1){ foreach($values1 as $k =>$v){ ?>
			<li>
				<div class="coupon-bg">
					<div class="coupon-box">
						<div class="box-head">
							优惠券码：<?php echo $v['code']; ?>
						</div>
						<div class="box-cont">
							<div class="cont-box">
								<h3>现金优惠券<span class="redm">￥<?php echo $v['money'];?></span></h3>
								<p>有效期至：<?php if($v['awarddate']==0){ echo '无期限';}else{ echo date('Y.m.d H:i',$v['redemptionendtime']);} ?></p>
								<p>兑奖方式：<?php if($v['redemptionmethod'] == 0 ){ echo '线上';}else{ echo '线下';} ?>奖励</p>
								<?php if($v['isuse'] == 2){ ?>  
								<img src="<?php echo UOOT;?>Public/app/images/past.png" alt="" />
								<?php }else{ ?>
								<img src="<?php echo UOOT;?>Public/app/images/userd.png" alt="" />
								<?php }?>
								
							</div>
							
							
						</div>
						
					</div>
					
					
				</div>
				
				
			</li>
			<?php }}else{ echo '<div class="nodata2"></div>';} ?>
			
		</ul>
		<div class="more" id="upass"style="display: none;">
			<br />
			<a href="javascript:;">返回我的优惠券</a>
		</div>
	</div>
	
</body>
<script type="text/javascript">
	$("#passd").click(function(){
		$("#passd").hide();
		$(".page-coupon ul").hide();
		$(".page-coupon .pass").show();
		$("#upass").show();
		
	})
	$("#upass").click(function(){
		$("#upass").hide();
		$(".page-coupon ul").show();
		$(".page-coupon .pass").hide();
		$("#passd").show();
	})

</script>

</html>
