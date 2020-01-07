<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="renderer" content="webkit"> 
    	<title>详细订单</title>
    <link href="<?php echo UOOT ?>Public/common/drag/css/reset.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/wechat/css/home.css" rel="stylesheet">
    <link href="//ks.kesion.com/Public/wechat/css/order.css" rel="stylesheet">
    <link href="//ks.kesion.com/Public/wechat/css/signin.css" rel="stylesheet">
    <link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
    <script>
    	var uoot = '<?php echo UOOT ?>';	
    </script> 	
</head> 
<body class="stuorder-wrap" style="background: #F6F5F0;">
	<div class="stuorder-list">
		<div class="change-wrap2" style="display: block;"><div class="detail-wrap">
			<div class="item">
				<div class="inner">
					<div class="inner-head">学生姓名/账号</div>
					<div class="inner-body"><?php echo Field($userinfo['name']).'/'.$userinfo['username']; ?></div> 
				</div>
				<div class="inner">
					<div class="inner-head">联系电话</div>
					<div class="inner-body"><?php echo Field($userinfo['mobile']); ?></div>
				</div>
				<div class="inner">
					<div class="inner-head">紧急联系人</div>
					<div class="inner-body"><?php echo Field($userinfo['emergencyContact']); ?></div>
				</div>
				<div class="inner">
					<div class="inner-head">紧急联系人电话</div>
					<div class="inner-body"><?php echo Field($userinfo['emergencyContactTel']); ?></div>
				</div>
			</div>
			<?php foreach($orderinfo as $k=>$v){ ?>
			<div class="item">
				<div class="inner">
					<div class="inner-head">下单时间</div>
					<div class="inner-body"><?php echo date('Y-m-d H:i:s',$v['adddate']); ?></div>
				</div>
				<div class="inner">
					<div class="inner-head">订单号</div>
					<div class="inner-body"><?php echo $v['ordersn']; ?></div>
				</div>
				<div class="inner">
					<div class="inner-head">订单内容</div>
					<div class="inner-body"><?php echo $v['title']; ?></div>
				</div>
				<div class="inner">
					<div class="inner-head">价格</div>
					<div class="inner-body"><?php echo $v['price']; ?></div>
				</div>
				<div class="inner">
					<div class="inner-head">数量</div>
					<?php if(empty($v['numb'])){ $v['numb']=1; } ?>
					<div class="inner-body"><?php echo $v['numb']; ?></div>
				</div>
			</div>
			<?php } ?>
			<div class="item">
				<div class="inner">
					<div class="inner-head">总价</div>
					<div class="inner-body orange"><?php echo $order['original_amount']; ?></div>
				</div>
				<div class="inner">
					<div class="inner-head">优惠券</div>
					<div class="inner-body orange">-<?php echo $order['vouchermoney']; ?></div>
				</div>
				<div class="inner">
					<div class="inner-head">支付金额</div>
					<div class="inner-body orange"><?php echo $order['order_amount']; ?></div>
				</div>
			</div>
			<div class="item">
				<div class="inner">
					<div class="inner-head">支付状态</div>
					<?php if($order['paystatus'] == 0){ ?>
						<div class="inner-body"><span class="blue">未支付</span></div>
					<?php }else{ ?>
						<div class="inner-body"><span class="red">已支付</span></div>
					<?php } ?>
				</div>
			</div>
		</div>
		<div class="detail-b"><div class="detail-btn x-btnYell" onclick="history.go(-1)">返回</div></div>
	</div>
	</div>
	
	
	<script src="<?php echo UOOT ?>Public/common/js/z.methodLibrary.js" type="text/javascript"></script>
	<script type="text/javascript">
		
		
	</script>
</body> 
</html>