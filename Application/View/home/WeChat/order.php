<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="renderer" content="webkit"> 
    <title>订单管理</title>
    <link href="<?php echo UOOT ?>Public/common/drag/css/reset.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/wechat/css/home.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/wechat/css/intention.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/wechat/css/order.css" rel="stylesheet">
    <script>
    	var uoot = '<?php echo UOOT ?>';	
    </script> 	
</head>
	<body>
		<div class="change-wrap">
			<div class="intent-t">
				<div class="item active" onclick = "order.getdata(0,'order',this)" id="all">
					全部
				</div>
				<div class="item" onclick = "order.getdata(2,'order',this)">
					未支付
				</div>
				<div class="item" onclick = "order.getdata(1,'order',this)">
					已支付
				</div>	
			</div>
			<div class="height40"></div>
			<div class="searchbox">
					 <input type="search" name="" id="myconsult" value="" placeholder="请输入搜索内容" onkeyup="order.myIntentSearch(this)"/>
			</div>
			<div class="cs-container" id="order">
			</div>
			<div class="loadings" id="loadings"></div>
		</div>
		<div class="change-wrap2">
			
		</div>
		
		<div class="mask"></div>
		<div class="confirm" id="confirm">
			<div class="title">确认支付</div>
			<div class="checkwrap">
				<div class="check-item">
					<span class="radio-inner active" data-type="1" onclick="order.changePay(this)"></span>
					<span class="tips">银行账户支付</span>
				</div>
				<div class="check-item">
					<span class="radio-inner" data-type="2" onclick="order.changePay(this)"></span>
					<span class="tips">现金支付</span>
				</div>
			</div>
			<div class="item">
				<div class="item-head">
					修改支付金额:
				</div>
				<input type="text"  id="money" value="" class="item-input"/>
			</div>
			<div class="item">
				<div class="item-head">
					备注:
				</div>
				<input type="text"  id="marks" value="" class="item-input"/>
			</div>
			<div class="item-b">
				<div class="item-inner" onclick="order.cancel()">取消</div>
				<div class="item-inner active" onclick="order.success()">确认</div>
			</div>
		</div>
		<script src="<?php echo UOOT ?>Public/common/js/z.methodLibrary.js?version=1.0"></script>
<script src="<?php echo UOOT ?>Public/wechat/js/order.js?version=1.0"></script>
<script type="text/javascript">
	document.querySelector('#all').click();

	$_monitor.scroll.bottom(window, function () {
		order.getdata(order.type, 'order');
	});
</script>
	</body>

</html>
