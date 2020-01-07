<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="renderer" content="webkit"> 
    <title><?php echo $this->websiteInfo['wititle'];?></title>
    <link href="<?php echo UOOT ?>Public/common/drag/css/reset.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/wechat/css/home.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/wechat/css/microportal/index.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/wechat/css/microportal/swiper.min.css" rel="stylesheet">
    <script>
    	var uoot = '<?php echo UOOT ?>';	
    </script> 	
</head>
<body>
	<div class="common-list">
		<div class="list-item active" onclick="course.getdata(0,'courselist',this)">课程<div class="under"></div></div>
		<div class="list-item" onclick="course.getdata(1,'courselist',this)">班级<div class="under"></div></div>
	</div>
	<div class="searchbox2">
		<input type="serach" placeholder="请输入要搜索的内容~" id="search" onkeyup="course.myIntentSearch(this)"/>
	</div>
	<div id="courselist" class="courselist">
		
	</div>
	<div class="loadings" id="loadings"></div>
	<div class="height60"></div>
	<div class="user-bot box-shadow-top">
		<div class="user-item">
			<a href="<?php echo M_URL('h5market','Miindex') ?>">
			<img src="<?php echo UOOT ?>Public/wechat/images/microportal/icon_home_inter.png" alt="" />
			<p>首页</p></a>
		</div>
		<div class="user-item active">
			<a href="<?php echo M_URL('h5market','Micourse') ?>">
			<img src="<?php echo UOOT ?>Public/wechat/images/microportal/icon_class.png" alt="" />
			<p>课程</p></a>
		</div>
		<div class="user-item">
			<a href="<?php echo M_URL('h5market','Minewslist') ?>">
			<img src="<?php echo UOOT ?>Public/wechat/images/microportal/icon_news_inter" alt="" />
			<p>资讯</p></a>
		</div>
		<div class="user-item">
			<?php if(!empty($this->userinfo)||!empty($this->userinfo1)){?>
			<a href="<?php echo 'http://'.APP_DOMAIN.'/home.html/default/WeChat/login';?>">
			<?php }else{?>
			<a href="<?php echo M_URL('h5market','wechatlogin').'?actindex=2';?>">	
			<?php }?>		
			<img src="<?php echo UOOT ?>Public/wechat/images/microportal/icon_me_inter" alt="" />
			<p>我的</p></a>
		</div>
	</div>
</body>
<script src="<?php echo UOOT ?>Public/wechat/js/microportal/zepto.js?version=1.0"></script>
<script src="<?php echo UOOT ?>Public/wechat/js/microportal/current.js?version=1.0"></script>
<script src="<?php echo UOOT ?>Public/wechat/js/microportal/course.js?version=1.0"></script>
<script type="text/javascript">
	var type = routes.query.type;
	if (type == 1) {
		$('.common-list').find('.list-item').eq(1).click();
	} else {
		$('.common-list').find('.list-item').eq(0).click();
	}
	$_monitor.scroll.bottom(window, function () {
		course.getdata(course.type, 'courselist');
	});
</script>
</html>