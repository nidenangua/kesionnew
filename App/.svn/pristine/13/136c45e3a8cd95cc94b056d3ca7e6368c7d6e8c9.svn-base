<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="renderer" content="webkit"> 
    <title>查看课表</title>
    <link href="<?php echo UOOT ?>Public/common/drag/css/reset.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/wechat/css/home.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/wechat/css/signin.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/wechat/css/task.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/wechat/css/intention.css" rel="stylesheet">
    <script>
    	var uoot = '<?php echo UOOT ?>';	
    	
    </script> 	
</head>
<style type="text/css">
	.weekItem.active {
	    background: #37a7ee;
	    color: #fff;
	}
	.mask{
		position: fixed;
	    width: 100%;
	    height: 100vh;
	    background: rgba(0,0,0,.3);
	    top: 0;
	    left: 0;
	    z-index: 55;
	    display: none;
	    opacity: 1;
	}
</style>
	<div class="tabletop" style="margin-top: 0;">
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
	<body>
		
		
	</body>
	<script type="text/javascript">
		var classId = "<?php echo $classid; ?>"; 
		var memberid = <?php echo $memberid ?>
	</script>
	<script src="<?php echo UOOT ?>Public/common/js/z.methodLibrary.js?version=1.0"></script>
	<script src="<?php echo UOOT ?>Public/wechat/js/myCourse.js"></script> 
	<script type="text/javascript">var timeTable = new timeTable('time','week','tasktable',"<?php echo date('W');?>");</script>
</html>