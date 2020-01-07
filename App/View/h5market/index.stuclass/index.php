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
<style type="text/css">
	.emptycss{
		font-size: 16px;
	    text-align: center;
	    height: 143px;
	    background: url(/Public/app/css/empty.png) no-repeat 50% 50%;
	    text-indent: -99999em;
	    overflow: hidden; 
        /*background-color: #fff;*/
	}
</style>
<body>
	<div class="index-swiper">
		<div class="swiper-container" id="swiper1" style="height: 197px;">
		  <div class="swiper-wrapper">
		  	<?php if($imgAry){ foreach($imgAry as $k => $v){?>
		    <div class="swiper-slide">
		    	<img  onclick="window.location.href='<?php echo $v['url']?>'"  src="<?php echo $v['img']?>" />
		    </div>
		    <?php }}else{ echo "<div class='swiper-slide'><img src='//".APP_DOMAIN."/Images/images/201806/5b189d39c63a7.png'/> </div>";}?>
		    <!--<div class="swiper-slide">
		    	<img src="https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1526966182048&di=fae7a412178f44969f5faf0b034c4b78&imgtype=jpg&src=http%3A%2F%2Fimg3.imgtn.bdimg.com%2Fit%2Fu%3D495782148%2C1284739359%26fm%3D214%26gp%3D0.jpg"/>
		    </div>-->
		  </div>
		  <div class="swiper-pagination"></div>
		</div>
	</div>
	
	<div class="cross-bar">
		<img src="<?php echo $websiteInfo['logo'] ?>"/>
		<div class="cross-bar-info">
			<div class="title"><?php echo $websiteInfo['sitename']?></div>
			<div class="tel">联系电话：<span><?php echo $websiteInfo['tel']?></span></div>
		</div>
	</div>
	<div class="cross-info" style="font-size: 10px;">
		<div>资讯：</div>
		<div class="swiper-container" id="swiper2">
		  <div class="swiper-wrapper">
		  	<?php if($newsAry){foreach($newsAry as $k=>$v){?>
		    <div class="swiper-slide" onclick="window.location.href='<?php echo $v['tzurl']?>'"><?php echo $v['title']?></div>
		    <?php }}else{echo '<div class="swiper-slide" >暂无</div>';}?>
		    <!--<div class="swiper-slide">slider2</div>
		    <div class="swiper-slide">slider3</div>-->
		  </div>
		</div>
	</div>
	<?php if($courseAry){?>
	<div class="common-belt">
		<div class="title">精品课程</div>
		<div class="more" onclick="location.href='<?php echo M_URL('h5market','Micourse') ?>'">查看更多>></div>
	</div>
	<div class="indexcourse">
		<?php foreach($courseAry as $k =>$v){?>
		<div class="index-course-list" onclick="location.href='<?php echo $v['url'] ?>'">
			<div class="img-wrap">
				<img src="<?php echo XImg($v['defaultpic'],1)?>"/>
			</div>
			<div class="info">
				<div class="title"><?php echo $v['title']?></div>
				<div class="type"><?php if($v['courseType']==1){echo '点播';}elseif($v['courseType']==2){echo '直播';}elseif($v['courseType']==3){echo '面授';}elseif($v['courseType']==4){echo '混合';} ?></div>
				<div class="money-wrap">
					<div class="money red">￥<?php echo $v['price']?></div>
					<div class="student"><?php echo $v['buycount']?> 购买</div>
				</div>
			</div>
		</div>
		<?php }?>
	</div>
	<?php }?>
	<?php if($classAry){?>
	<div class="common-belt">
		<div class="title">热门班级</div>
		<div class="more" onclick="location.href='<?php echo M_URL('h5market','Micourse').'?type=1' ?>'">查看更多>></div>
	</div>
	<div class="indexcourse">
		<?php foreach($classAry as $k =>$v){?>
		<div class="index-course-list" onclick="location.href='<?php echo M_URL('h5market','Miclassdetail').'?id='.$v['classid'] ?>'">
			<div class="img-wrap">
				<img src="<?php echo XImg($v['defaultpic'],1)?>"/>
			</div>
			<div class="info">
				<div class="title"><?php echo $v['title']?></div>
				<div class="type"><?php if($v['classlevel']==1){echo '小班';}elseif($v['classlevel']==2){echo '一对一';}elseif($v['classlevel']==0){echo '大班';} ?></div>
				<div class="money-wrap">
					<div class="money red">￥<?php echo $v['price']?></div>
					<div class="student"><?php if($v['studentcount'] == 0){ echo  '不限';}else{ echo '剩余名额'. ($v['studentcount']-$v['studentnum']);} ?></div>
				</div>
			</div>
		</div>
		<?php }?>
	</div>
	<?php }?>
	<div class="height60"></div>
	<div class="user-bot box-shadow-top">
		<div class="user-item active">
			<a href="<?php echo M_URL('h5market','Miindex') ?>">
			<img src="<?php echo UOOT ?>Public/wechat/images/microportal/icon_home.png" alt="" />
			<p>首页</p></a>
		</div>
		<div class="user-item">
			<a href="<?php echo M_URL('h5market','Micourse') ?>">
			<img src="<?php echo UOOT ?>Public/wechat/images/microportal/icon_class_inter.png" alt="" />
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
			<a href="<?php echo M_URL('h5market','wechatlogin').'?actindex=1';?>">	
			<?php }?>		
			<img src="<?php echo UOOT ?>Public/wechat/images/microportal/icon_me_inter" alt="" />
			<p>我的</p></a>
		</div>
	</div>
</body>
<script src="<?php echo UOOT ?>Public/wechat/js/microportal/zepto.js?version=1.0"></script>
<script src="<?php echo UOOT ?>Public/wechat/js/microportal/index.js?version=1.0"></script>
<script src="<?php echo UOOT ?>Public/wechat/js/microportal/swiper.min.js?version=1.0"></script>
<script type="text/javascript">
	new Swiper('#swiper1',{
		pagination : '.swiper-pagination',
		autoplay: 3000,//可选选项，自动滑动，
		paginationClickable :true,
		loop:true
	})
	new Swiper('#swiper2',{
		direction : 'vertical',
		autoHeight: true,
		autoplay:3000,
		loop:true
	})
</script>
</html>