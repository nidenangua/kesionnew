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
    <link href="<?php echo UOOT ?>Public/wechat/css/intention.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/wechat/css/remcourse.css" rel="stylesheet">
    <script>
    	var uoot = '<?php echo UOOT ?>';	
    </script> 	
</head>
<body>
	<div class="intent-t">
			<div class="item active" >
				记上课
			</div>
			<div class="item" onclick="location.href='<?php echo M_URL('WeChat','edcourse');?>'">
				已记上课
			</div>
	</div>
	<div class="height40"></div>
	<div class="searchbox">
			 <input type="search" name="" id="myconsult" value="" placeholder="请输入搜索内容" onkeyup="remcourse.myIntentSearch(this)"/>
			 <div class="screen">
			 	<img src="<?php echo UOOT ?>Public/wechat/images/screen.png"/>
			 	<span onclick = "remcourse.asidePopup()">筛选</span>
			 </div>
	</div>
	<div class="cs-container" id="course">
		
	</div>
	<img src="<?php echo UOOT ?>Public/wechat/images/loading.gif"  class="loading"/>
	<div class="mask"></div> 
	<div class="aside" id="aside">
		<div class="aside-title">
			筛选
		</div>
		<div class="aside-content">
			<div class="side-head" >
				班级类型
			</div>
			<div class="aside-body" id="category">
				<div class="aside-item active" data-value="5">不限</div>
				<div class="aside-item" data-value="1">小班</div>
				<div class="aside-item" data-value="2">一对一</div>
				<div class="aside-item" data-value="3">大班</div>
			</div>
			<div class="side-head" >
				签到类型
			</div>
			<div class="aside-body" id="sign">
			    <div class="aside-item active" data-value="5">不限</div>
				<div class="aside-item" data-value="1">已签到</div>
				<div class="aside-item" data-value="0">未签到</div>
			</div>
		</div>
		
		<div class="aside-btn">
			<div class="item" onclick="remcourse.asideBack()">
				返回
			</div>
			<div class="item active" onclick="remcourse.asideConfirm()">
				确定
			</div>
		</div>
	</div>
	
</body>
<script src="<?php echo UOOT ?>Public/common/js/z.methodLibrary.js?version=1.0"></script>
<script src="<?php echo UOOT ?>Public/wechat/js/remcourse.js?version=1.0"></script>
<script type="text/javascript">
	remcourse.getRemData()
</script>
</html>