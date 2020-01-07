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
    <link href="<?php echo UOOT ?>/Public/wechat/css/order.css" rel="stylesheet">
    <link href="//ks.kesion.com/Public/wechat/css/signin.css" rel="stylesheet">
    <link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
    <script>
    	var uoot = '<?php echo UOOT ?>';	
	</script> 	
	<style>
		body,html{
			background:#EDF2F5
		}
	</style>
</head> 
<body>
	<div id="myorder" class="myorder" v-cloak>
		<template v-if="renderflag">
		<div class="ordertop" v-for="item in datalist">
			<div class="default-pic">
				<img :src="item.defaultpic" alt="">
				<div class="status" v-if="item.groupid">拼团</div>
			</div>
			<div class="order-info">
				<div class="order-tit">{{item.title}}</div>
				<div class="type" v-text="type(item.type,item.courseType)"></div>
				<div class="price">
					<span class="discount" v-if="item.price_market">￥{{item.price_market}}</span>
					<span class="inprice">￥{{item.price}}</span>
				</div>
			</div>
		</div>
		<div class="order-body">
			<div class="order-body-item">
				<div class="head">商品总价</div>
				<div class="body">￥{{datainfo.price_market}}</div>
			</div>
			<div class="order-body-item" v-if="datainfo.vid!=0">
				<div class="head">使用优惠券</div>
				<div class="body">-￥{{datainfo.voucher}}</div>
			</div>
			<div class="order-body-item" style="border-bottom:1px solid #eee;">
				<div class="head">实付金额</div>
				<div class="body">￥{{datainfo.order_amount}}</div>
			</div>
			<div class="order-body-item" style="padding-top:10px;">
				<div class="head" style="color:#353535">支付状态</div>
				<div class="body red" v-if="datainfo.paystatus==0">待付款</div>
				<div class="body blue" v-if="datainfo.paystatus==1">已付款</div>
				<div class="body red" v-if="datainfo.paystatus==3">退款中</div>
				<div class="body blue" v-if="datainfo.paystatus==4">已退款</div>
			</div>
		</div>
		<div class="order-bottom">
			<div class="order-bottom-item">下单时间：{{datainfo.adddate}}</div>
			<div class="order-bottom-item">订单编号：{{datainfo.ordersn}}</div>
		</div>
		<div class="order-f-bottom" v-if="datainfo.groupid&&datainfo.paystatus==3">
			<a class="btn" href="datainfo.lookurl">我的拼团</a>
		</div>
		</template>
	</div>
	<!-- <div class="stuorder-list">
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
	</div> -->
	<script src="<?php echo UOOT ?>Public/common/js/vue2.5.js"></script>
	<script src="<?php echo UOOT ?>Public/wechat/js/orderdetail.js"></script>
</body> 
</html>