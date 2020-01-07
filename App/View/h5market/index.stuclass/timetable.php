<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no"> 
    <meta name="renderer" content="webkit"> 
    <title>科汛V名师网校</title>
    <link href="<?php echo UOOT ?>Public/common/drag/css/reset.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/wechat/css/home.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/wechat/css/microportal/index.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/wechat/css/microportal/swiper.min.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/wechat/css/task.css" rel="stylesheet">
    <script>
    	var uoot = '<?php echo UOOT ?>';	
    </script> 	
</head>
	<body style="background: #F6F5F0;">
		<div class="tabletop">
			<div class="fl" onclick="timeTable.preWeek()">
				&#60;前一周
			</div>
			<div class="table-time" id="time">
				
			</div>
			<div class="fr" onclick="timeTable.nextWeek()">
				后一周&#62;
			</div>
		</div>
		<!--周表-->
		<div class="week-wrap" id="week">
		</div>
		<!--加载状态-->
		<img src="<?php echo UOOT ?>Public/wechat/images/loading.gif"  class="loading"/>
		<!--加载状态-->
		<!--课程表-->
		<div id="tasktable" class="tasktable">
		</div>
	</body>
	<script src="<?php echo UOOT ?>Public/wechat/js/microportal/current.js?version=1.0"></script>
	<script src="<?php echo UOOT ?>Public/wechat/js/microportal/mycourse.js?version=1.0"></script>
</html>