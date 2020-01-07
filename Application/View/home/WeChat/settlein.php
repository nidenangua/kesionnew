<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="renderer" content="webkit"> 
    <title>结算中心</title>
    <link href="<?php echo UOOT ?>Public/common/drag/css/reset.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/wechat/css/home.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/wechat/css/intention.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/wechat/css/settle.css" rel="stylesheet">
    <script>
    	var uoot = '<?php echo UOOT ?>';	
    </script> 	
</head>
	<body>
		<div id="settlein">
			
		</div>
		<div class="height40"></div>
		<div class="settlein-bottom">
			<div class="item" onclick="history.go(-1)">取消</div>
			<div class="item active" onclick="settlein.confirm()">确认</div>
		</div>
	</body>
<script src="<?php echo UOOT ?>Public/common/js/z.methodLibrary.js?version=1.0"></script>
<script src="<?php echo UOOT ?>Public/wechat/js/settle.js?version=1.0"></script>
<script type="text/javascript">
	settlein.getData() 
</script>
</html>