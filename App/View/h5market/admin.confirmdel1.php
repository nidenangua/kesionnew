<!DOCTYPE html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit">
<link rel="shortcut icon" href="favicon.ico">
<link href="<?php echo UOOT;?>Public/admin/css/kesion-common.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/admin/css/html5.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/admin/css/general.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/admin/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/page.animate.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/admin/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
</head>
<style type="text/css">
.gy{background: #F8F8F8;}
.smimg{height: 40px; width: 60px;border-radius: 5px;margin-top: 5px;}
.pnone{padding:0px!important;}
@media (max-width:1600px ) {
	.vod-minpad {width: 300px!important;}
}
</style>
<body class="gray-bg" style="background-color: #fff;">
	<div id="ksBoxContent" style="    padding-top: 20px;">
		<form target="hidframe"  method="post" target="hidframe"  action="<?php echo M_URL('home/Capital','ptrefund','',GP('groupid-'.$groupid,true)) ?>" class="form-horizontal" enctype="multipart/form-data">
			此次操作会给<span style="color: red;"><?php echo $count;?></span>个人退钱，一共<span style="color: red;"><?php echo $money;?></span>元
			<input name="password" type="password" value="" style="    margin-top: 16px;"/>
			<button type="submit"/>确认打款</button>
		</form>
	</div>
</body>
</html>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>