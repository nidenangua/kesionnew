<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="renderer" content="webkit"> 
    <title>图文</title>
    <link href="<?php echo UOOT ?>Public/common/drag/css/reset.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/wechat/css/home.css" rel="stylesheet">
    <link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
    <link href="<?php echo UOOT ?>Public/wechat/css/poster.css" rel="stylesheet">
    <script>
    	var uoot = '<?php echo UOOT ?>';
    </script>
    <style type="text/css">
		*{margin: 0px;padding: 0px;}
		.can-box .can{width: 100%;} 
	</style>
</head>
	<body>
		<p class="title1">长按保存图片到手机</p>

			<canvas class="container" id="post" width="320px" height="600px" style="display: block;"></canvas>
			<div id="image" style="display: none;" class="container"></div>
		<!--</div>-->
		<div><a id="down1" class="down" href="" download="downImg"><span id="downfile"></span></a></div>
		<div class="template-list">
			<?php foreach($values as $k =>$v){?>
			<div class="item <?php if($k==0){echo "active";}?>" >
				
				<div class="inner">
					<div class="img-wrap">
						<img src="<?php echo UOOT.$v['img']?>" alt="" />
					</div>
					<div class="mask">
						<img src="<?php echo UOOT;?>Public/wechat/images/icon/red-swoosh2.png" class="swoosh"/>
					</div>
				</div>
				
			</div>
			<?php }?>
		</div>
		
	<script src="<?php echo UOOT;?>Public/common/js/jquery.min.js"></script>
	<script type="text/javascript">
	</script>
	<script src="<?php echo UOOT;?>Public/wechat/js/poster.js"></script>
	<script type="text/javascript">
		var postered = new poster({
			newInnerImg:'<?php echo $info['defaultpic'] ?>',//封面
			newbg:'<?php echo UOOT.$values[0]['img']?>',//背景图
			basictitle:'<?php echo $info['title']?>',//标题
			basicintr:'<?php echo $info['intr']?>',//简介
			basicprice:'<?php echo $info['price']?>',//价格
			basicteacher:'<?php if($info['name']){echo '主讲老师：'.$info['name'];}else{echo '';}?>',//老师
			basictime:'<?php if($info['time']){echo '直播时间：'.$info['time'];}else{echo '';}?>',//时间
			wxBasicInfo:"<?php echo Img($logo);?>",//网校基本信息
			codeImg:"<?php echo UOOT.'Images/QRcode/'.createQRcode(ROOT.'Images/QRcode/','http://'.APP_DOMAIN.'/h5market/Miindex','L',4,'qrcode')?>",
			background:'#Fff'
		})
		
		
		$('.template-list').find('.item').click(function(){
		   $(this).addClass('active').siblings().removeClass('active');
		   var thisUrl = $(this).find('.img-wrap img').attr('src');
		   newbg = thisUrl;
		   postered.callback(newbg)  
		})
	</script>
	</body>
	
</html>