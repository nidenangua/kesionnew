<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no"> 
    <meta name="renderer" content="webkit"> 
    <title>资讯详情-<?php echo $this->websiteInfo['wititle'];?></title>
    <link href="<?php echo UOOT ?>Public/common/drag/css/reset.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/wechat/css/home.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/wechat/css/microportal/index.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/wechat/css/microportal/swiper.min.css" rel="stylesheet">
    <script>
    	var uoot = '<?php echo UOOT ?>';	
    </script> 	
</head>
	<body>
		<div class="newsdetail" id="newsdetail">
			
		</div>
		<div class="loadings"></div>
	</body>
	<script src="<?php echo UOOT ?>Public/wechat/js/microportal/current.js?version=1.0"></script>
	<script type="text/javascript">
		var id = routes.query.id;
		var jsonUrl = uoot + 'Json/index.php';
		var datas = {};
		datas.id = id;
		$_post(jsonUrl + '?act=Microportal.newsDetail', datas, function (res) {
			console.log(res);
			$_id('newsdetail').innerHTML = '<div class="title">' + res.newsDetail.title + '</div><div class="time">' + res.newsDetail.adddate + '</div><div class="content">' + res.newsDetail.content + '</div>';
		}, 'json');
	</script>
</html>