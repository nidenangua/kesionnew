<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit">
<title>kesion教育平台</title>
<meta name="Keywords" content="kesion教育平台"/>
<meta name="Description" content="kesion教育平台" />
<link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/live.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/css.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>
<style type="text/css">
	.tulbox{
		border-radius: 5px;
		width: 200px; 
		text-indent: 3em;
		background: #fff;
		padding: 10px 0px;
	}
	.warpModel{
		position: relative;
		min-height: 400px;
		padding-left: 230px;
	}
	#rightMoBox{
		width: 100%;
		height: 600px;
		overflow: auto;
	}
	.topModel{ margin-bottom: 30px; border-radius: 10px;}
	.leftModel{position: absolute;left: 0px;border-radius: 5px;}
	.rightModel{min-height: 500px;border-radius: 5px; padding: 10px;}
	
	.titleTab li{margin-bottom: 25px;}
	.titleTab li p{font-size: 17px;}
	.titleTab li span{position: absolute;bottom: 5px;margin: 0 auto; right: 0;left: 0;font-size: 13px;color: #188eee;display: none;}
	.titleTab li img{width: 80px;height: 80px;margin-top: 15px;transition: all 0.3s linear;}
	.{opacity: 0;filter:Alpha(opacity=0)}
</style>
</head>
<body class="ks-wrap">
<div class="votebox" style="margin:10px auto 0 auto">
	<dl class="barbox">
		<dd class="barline"><div w="0" style="width:0px;" class="charts"></div></dd>
	</dl>
	<div class="wz" style="color: red; width: 100%;"></div>
</div>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script src="<?php echo UOOT;?>Public/common/js/animate-common.js"></script>
</body>
</html>
<script language="javascript">
function animate(){
	var a=parseInt($('.charts').attr("w"));
	$('.charts').animate({
		width: a+"%"
	},100);
}
</script>
<?php if (is_dir($dir)) {$this->File->read_all_file($dir);}?>
