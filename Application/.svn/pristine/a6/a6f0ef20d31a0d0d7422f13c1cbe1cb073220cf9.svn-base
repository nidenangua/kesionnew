<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="renderer" content="webkit"> 
    <title>优惠券发放</title>
    <link href="<?php echo UOOT ?>Public/common/drag/css/reset.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/wechat/css/home.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/wechat/css/signin.css" rel="stylesheet">
    <link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="<?php echo UOOT ?>Public/wechat/css/editcampus.css"/>
    <script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>
    <script>
    	var uoot = '<?php echo UOOT ?>';
    	
    </script>
</head>
	<body>
		<form id="form" action="<?php echo M_URL('WeChat','saveVoucher')?>" method='post'>
			<div class="edit-wrap">
				<div class="title1">选择要发送的学员</div>
				<input type="button" class="btn red" name="redpacket" value="选择学员 ">
			</div>
			<div class="edit-wrap">
				<div class="title1">发送的学员用户名(每个用户名之间用逗号隔开)</div>
				<input type="hidden" name="ids" id="" value="" class="edit-input" readonly=""/>
				<input type="text" name="names" id="" value="" class="edit-input" readonly=""/>
			</div>
			<div class="edit-wrap">
				<div class="title1">现金优惠券金额</div>
				<input type="number" name="money" id="" value="10" class="edit-input" style="width: 120px;"/>&nbsp;&nbsp;元
			</div>
			<div class="edit-wrap">
				<div class="title1">使用结束时间</div>
				<input type="datetime-local" name="address" id="" value="" class="edit-input"/>
			</div>
			<div class="edit-wrap text-center">
				<div class="btn red" style="margin-right: 10px;" onclick="insumbit()">确认</div> 
				<div class="btn">取消</div> 
			</div>
		</form>
	<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
	<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>
	<script type="text/javascript">
		module.require(['$','backstage','nicescroll'],function(){
			loadScorllJs();
			$('.upload-img').click(function(){
				$('.js_uploadText').click()
			});
			
		
		});
		function insumbit(){
			document.getElementById('form').submit()
		}
	</script>
	</body>
</html>