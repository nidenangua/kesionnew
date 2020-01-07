<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="renderer" content="webkit"> 
    <title>微门户</title>
    <link href="<?php echo UOOT ?>Public/common/drag/css/reset.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/wechat/css/home.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/wechat/css/microportal/userindex.css" rel="stylesheet">
    <script>
    	var uoot = '<?php echo UOOT ?>';	
    </script> 	
</head>
	<body>
		<div class="gatewaylist">
			<div class="item" onclick="location.href='<?php echo M_URL('WeChat','gateset')?>'">微门户设置</div>
			<div class="item" onclick="location.href='<?php echo M_URL('WeChat','gateCourse')?>'">课程管理</div>
			<div class="item" onclick="location.href='<?php echo M_URL('WeChat','gateClass')?>'">班级管理</div>
			<div class="item" onclick="location.href='<?php echo M_URL('WeChat','gateNews')?>'">资讯管理</div> 
		</div>
	</body>
</html>