<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="renderer" content="webkit"> 
    <link href="<?php echo UOOT ?>Public/common/drag/css/reset.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/wechat/css/home.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/wechat/css/task.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/wechat/css/intention.css" rel="stylesheet">
    <script>
    	var uoot = '<?php echo UOOT ?>';	
    </script> 	
</head>
	<body>
		<div class="intent-t">
			<div class="item" style="cursor: pointer;" onclick="location.href='<?php echo M_URL('WeChat','intention');?>'">
				我的咨询
			</div>
			<div class="item active" style="cursor: pointer;" onclick="location.href='<?php echo M_URL('WeChat','task');?>'">
				任务
			</div>
			<div class="item" style="cursor: pointer;" onclick="location.href='<?php echo M_URL('WeChat','intentcount');?>'">
				咨询统计
			</div>
			<div class="item" style="cursor: pointer;" onclick="location.href='<?php echo M_URL('WeChat','intentpound');?>'">
				咨询池
			</div>
			<div class="item" style="cursor: pointer;" onclick="location.href='<?php echo M_URL('WeChat','channel');?>'">
				渠道
			</div>
		</div>
		<div class="height40"></div>
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
	<script src="<?php echo UOOT ?>Public/common/js/z.methodLibrary.js?version=1.0"></script>
	<script src="<?php echo UOOT ?>Public/wechat/js/main.js?version=1.0"></script>
	<script src="<?php echo UOOT ?>Public/wechat/js/task.js?version=1.0"></script>
	<script type="text/javascript">
		var timeTable = new timeTable('time','week','tasktable');
	</script>
</html>