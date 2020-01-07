<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="renderer" content="webkit"> 
    <link href="<?php echo UOOT ?>Public/common/drag/css/reset.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/wechat/css/home.css" rel="stylesheet">
    <script>
    	var uoot = '<?php echo UOOT ?>';	
    </script> 	
</head> 
<body>
	
	<section class="fn-list"> 
		<ul class="clearfix"> 
			<li>
				<a href="<?php echo M_URL('WeChat','classminindex'); ?>">
				<div class="fn-item">
					<div class="icon"><img src="<?php echo UOOT ?>Public/wechat/images/new/teachingaffairs_icon_class.png"/></div>
					<div class="name">班级管理</div>
				</div>
				</a>
			</li>
			<li>
				<a href="<?php echo M_URL('WeChat','stuadmin'); ?>">
				<div class="fn-item">
					<div class="icon"><img src="<?php echo UOOT ?>Public/wechat/images/new/teachingaffairs_icon_student.png"/></div>
					<div class="name">学生管理</div>
				</div>
				</a>
			</li>
			<li>
				<a href="<?php echo M_URL('WeChat','settle'); ?>">
				<div class="fn-item">
					<div class="icon"><img src="<?php echo UOOT ?>Public/wechat/images/new/teachingaffairs_icon_lesson.png"/></div>
					<div class="name">课时结算</div>
				</div>
				</a>
			</li>

			<li>
				<a href="<?php echo M_URL('WeChat','myCourse'); ?>">
				<div class="fn-item">
					<div class="icon"><img src="<?php echo UOOT ?>Public/wechat/images/new/teachingaffairs_icon_time.png"/></div>
					<div class="name">我的课表</div>
				</div>
				</a>
			</li>
			<li>
				<a href="<?php echo M_URL('WeChat','order'); ?>">
				<div class="fn-item">
					<div class="icon"><img src="<?php echo UOOT ?>Public/wechat/images/new/teachingaffairs_icon_order.png"/></div>
					<div class="name">订单管理</div>
				</div>
				</a>
			</li>
			<li>
				<a href="<?php echo M_URL('WeChat','remcourse'); ?>">
				<div class="fn-item">
					<div class="icon"><img src="<?php echo UOOT ?>Public/wechat/images/new/teachingaffairs_icon_marklesson.png"/></div>
					<div class="name">记上课</div>
				</div>
				</a>
			</li>
			<li>
				<a href="<?php echo M_URL('WeChat','signin'); ?>">
				<div class="fn-item">
					<div class="icon"><img src="<?php echo UOOT ?>Public/wechat/images/new/teachingaffairs_icon_sign.png"/></div>
					<div class="name">上课签到</div>
				</div>
				</a>
			</li>
			
		
		</ul>
	</section>
	
	
	<div class="footer-blank"></div>
	<!--<footer class="footer">
		<ul>
			<li class="zui-col-6 active" id="toDay" onclick="window.location.href='<?php echo M_URL('WeChat','index'); ?>'">
				<i class="icon icon-tools"></i>
				<p>主页</p>
			</li>
			<li class="zui-col-6" id="historys" onclick="window.location.href='<?php echo M_URL('WeChat','userindex'); ?>'">
				<i class="icon icon-program"></i>
				<p>个人中心</p>
			</li>
		</ul>
	</footer>-->
	
	<script src="<?php echo UOOT ?>Public/common/js/z.methodLibrary.js" type="text/javascript"></script>
</body>
</html>