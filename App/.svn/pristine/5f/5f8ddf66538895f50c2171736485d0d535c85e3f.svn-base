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
    <style type="text/css">
    	body{padding-top: 0.5rem;}
    </style>
</head>
<body>
	
	<div id="newslist" class="newslist">
		
	</div>
	<div class="loadings" id="loadings"></div>
	<div class="height60"></div>
	<div class="user-bot box-shadow-top">
		<div class="user-item">
			<a href="<?php echo M_URL('h5market','Miindex') ?>">
			<img src="<?php echo UOOT ?>Public/wechat/images/microportal/icon_home_inter.png" alt="" />
			<p>首页</p></a>
		</div>
		<div class="user-item">
			<a href="<?php echo M_URL('h5market','Micourse') ?>">
			<img src="<?php echo UOOT ?>Public/wechat/images/microportal/icon_class_inter.png" alt="" />
			<p>课程</p></a>
		</div>
		<div class="user-item active">
			<a href="<?php echo M_URL('h5market','Minewslist') ?>">
			<img src="<?php echo UOOT ?>Public/wechat/images/microportal/icon_news" alt="" />
			<p>资讯</p></a>
		</div>
		<div class="user-item">
			<?php if(!empty($this->userinfo||!empty($this->userinfo1))){?>
			<a href="<?php echo 'http://'.APP_DOMAIN.'/home.html/default/WeChat/login';?>">
			<?php }else{?>
			<a href="<?php echo M_URL('h5market','wechatlogin').'?actindex=3';?>">	
			<?php }?>
			<img src="<?php echo UOOT ?>Public/wechat/images/microportal/icon_me_inter" alt="" />
			<p>我的</p></a>
		</div>
	</div>
</body>
<script src="<?php echo UOOT ?>Public/wechat/js/microportal/zepto.js?version=1.0"></script>
<script src="<?php echo UOOT ?>Public/wechat/js/microportal/current.js?version=1.0"></script>
<script type="text/javascript">
	var jsonUrl = uoot+'Json/index.php';
	var news = {
		p: 1,
		maxPerPage: 10,
		flag: true,
		getData: function getData() {
			var _this = this;

			if (this.flag) {
				var loading = $_id('loadings');
				loading.style.display = "block";
				var datas = {};
				datas.p = this.p;
				datas.maxPerPage = this.maxPerPage;
				$_post(jsonUrl + '?act=Microportal.getNews', datas, function (res) {
					console.log(res);
					_this.p++;
					loading.style.display = "none";
					if (res.getNews.page.total_pages == 0) {
						$_id('newslist').innerHTML = '<div class="nodata"><div>';
						_this.flag = false;
						return false;
					}
					var code = '';
					res.getNews.newsList.map(function (item) {
						code += '<a class=\'newslist-item\' href=\'' + item.url + '\'>\n\t\t\t\t\t\t\t\t\t<div class=\'img-wrap\'>\n\t\t\t\t\t\t\t\t\t\t<img src=\'' + item.defaultpic + '\'/>\n\t\t\t\t\t\t\t\t\t</div>\n\t\t\t\t\t\t\t\t\t<div class=\'info\'>\n\t\t\t\t\t\t\t\t\t    <div class=\'title\'>' + item.title + '</div>\n\t\t\t\t\t\t\t\t\t    <div class=\'infos\'>' + item.abstract + '</div>\n\t\t\t\t\t\t\t\t\t</div>\n\t\t\t\t\t\t\t\t</a>';
					});
					$('#newslist').append(code);
					//当页数为最后一页 且小于既定数量的情况
					if (res.getNews.page.total_pages == res.getNews.page.now_page && res.getNews.newsList.length <= 10) {
						var a = '<div class="nomore">我们是有底线的~</div>';
						$('#newslist').after(a);
						loading.style.display = "none";
						//如果已经没有数据了  就不让他继续往下走
						_this.flag = false;
					}
				}, 'json');
			}
		}
	};
	news.getData();
	$_monitor.scroll.bottom(window, function () {
		news.getData();
	});
</script>
</html>