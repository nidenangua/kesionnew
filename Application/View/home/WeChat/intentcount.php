<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="renderer" content="webkit"> 
    <link href="<?php echo UOOT ?>Public/common/drag/css/reset.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/wechat/css/home.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/wechat/css/count.css" rel="stylesheet">
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
		<div class="item" style="cursor: pointer;" onclick="location.href='<?php echo M_URL('WeChat','task');?>'">
			任务
		</div>
		<div class="item active" style="cursor: pointer;" onclick="location.href='<?php echo M_URL('WeChat','intentcount');?>'">
			咨询统计
		</div>
		<div class="item" style="cursor: pointer;" onclick="location.href='<?php echo M_URL('WeChat','intentpound');?>'">
			咨询池
		</div>
		<div class="item" style="cursor: pointer;" onclick="location.href='<?php echo M_URL('WeChat','channel');?>'">
			渠道
		</div>
	</div>
	<div class="height40">
		
	</div>
	<div style="padding: 0.5rem 0.5rem 0;">
		<div class="count-detail">
			<div class="title">我的业绩</div>
			<div class="count-list" id="achievement">
				<div class="item active" onclick="intentCount.slideChange(this)">
					今日
				</div>
				<div class="item" onclick="intentCount.slideChange(this)">
					本周
				</div>
				<div class="item" onclick="intentCount.slideChange(this)"> 
					本月
				</div>
			</div>
			<div class="count-tab" id="tabs">
				<div class="count-tabbox" style="display: block">
					<div style="padding-top: 0.5rem;overflow: hidden;" id="tabsday">
						
					</div>
				</div>
				<div class="count-tabbox">
					<div id="tabsweek" style="padding-top: 0.5rem;overflow: hidden;">
						
					</div>
				</div>
				<div class="count-tabbox">
					<div id="tabsmonth" style="padding-top: 0.5rem;overflow: hidden;">
						
					</div>
				</div>
			</div>
		</div>
		<div class="count-detail">
			<div class="title">我的跟进状态</div>
			<div class="count-list" id="status">
				<div class="item active" onclick="intentCount.slideChangeStatus(this,1)">
					今日
				</div>
				<div class="item" onclick="intentCount.slideChangeStatus(this,2)">
					本周
				</div>
				<div class="item" onclick="intentCount.slideChangeStatus(this,3)">
					本月
				</div>
			</div>
			<div class="count-tab" id="statustabs">
				<div class="count-tabbox" style="display: block">
					<div id="statusday" style="padding-top: 0.5rem;overflow: hidden;height: 200px;">
						
					</div>
					
				</div>
				<div class="count-tabbox">
					<div id="statusweek" style="padding-top: 0.5rem;overflow: hidden; height: 200px;">
						
					</div>
				</div>
				<div class="count-tabbox">
					<div id="statusmonth" style="padding-top: 0.5rem;overflow: hidden; height: 200px;">
						
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
<script src="<?php echo UOOT ?>Public/common/js/z.methodLibrary.js?version=1.0"></script>
<script src="<?php echo UOOT ?>Public/wechat/js/highcharts.js?version=1.0"></script>
<script src="<?php echo UOOT ?>Public/wechat/js/data.js?version=1.0"></script>
<script src="<?php echo UOOT ?>Public/wechat/js/highcharts-more.js?version=1.0"></script>
<script src="<?php echo UOOT ?>Public/wechat/js/funnel.js?version=1.0"></script>
<script src="<?php echo UOOT ?>Public/wechat/js/intention.js?version=1.0"></script> 

<script type="text/javascript">
	intentCount.getAchieve(1);//获取天的业绩
	intentCount.getAchieve(2);//获取周的业绩
	intentCount.getAchieve(3);//获取月的业绩
	intentCount.getStatus(1);
</script>
</html>