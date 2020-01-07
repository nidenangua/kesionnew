<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="renderer" content="webkit"> 
    <link href="<?php echo UOOT ?>Public/common/drag/css/reset.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/wechat/css/home.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/wechat/css/intention.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/wechat/css/intentDetail.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/wechat/css/lCalendar.css" rel="stylesheet">
    <script>
    	var uoot = '<?php echo UOOT ?>';	
    </script> 	
</head>
<body>
	<!--加载状态-->
	<img src="<?php echo UOOT ?>Public/wechat/images/loading.gif"  class="loading"/>
	<!--加载状态-->
	<div class="detail-wrap" id="detail-wrap">
	</div>
	
	<div class="detail-b-wrap">
		<div class="detail-b-t">
			<div class="item active" onclick="intentDetail.slideChange(this)">咨询记录</div>
			<div class="item" onclick="intentDetail.slideChange(this)">基本信息</div>
		</div>
		<div class="detail-tabs">
			<div class="detail-tabbox" style="display: block;" id="record">
				
			</div>
			<div class="detail-tabbox" id="basicInformation">
				
			</div>
		</div>
		
	</div>
	<div style ="height: 2.4rem;"></div>
	<div class="addrecord" onclick="intentDetail.popup()">
		添加咨询记录
	</div>
	
	<div class="mask">
		
	</div> 
	<div class="add-intent" id="showtoast">
		<div class="add-intent-t">
			<div class="title">
				添加咨询记录
			</div>
			<div class="s-title">
				咨询记录
			</div>
			<textarea class="add-content" id="mark"></textarea>
			<input type="hidden"  id="hideTime" value="" />
			<div class="setnext" id="setnext" onclick="intentDetail.setBackTime()">
				设置回访时间
			</div>
		</div>
		<div class="add-intent-b">
			<div class="item" onclick="intentDetail.cancel(this)">取消</div>
			<div class="item active" onclick="intentDetail.confirm(this)">确认</div>
		</div>
	</div>
	
</body>
<script src="<?php echo UOOT ?>Public/common/js/z.methodLibrary.js?version=1.0"></script>
<script src="<?php echo UOOT ?>Public/wechat/js/lCalendar.js?version=1.0"></script>
<script src="<?php echo UOOT ?>Public/wechat/js/intention.js?version=1.0"></script>
<script type="text/javascript">
	
	const userid = location.href.split('intentDetail')[1].split('/')[1];
	intentDetail.getDetail(userid);
	var calendar = new lCalendar();
		calendar.init({
			'trigger': '#hideTime',
			'type': 'datetime',
			'callBack':function(){
				var a = $_id('hideTime').value;
				$_id('setnext').innerHTML = a;
				$_id('setnext').setAttribute('data-stamp', a)
			}
		})
</script>
</html> 