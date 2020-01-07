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
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/page.animate.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>
</head>
<body class="ks-wrap">
	sdfasdf
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script src="<?php echo UOOT;?>Public/common/js/animate-common.js"></script>
<script>
var url = "{=M_URL(course,CourseExamAjax)}";
$.ajax({
	type:"post",
	url:url,
	data:{'courseid':courseid},
	dataType:"json",
	success:function(data){
	   if(data==0){
	   }else if(data==-1){
	 	   Alert('该商品已经在购物车了喔');
	   }
	},
    error:function(){
	location.reload();
	    return false;
		alert("网络延迟,重新操作!");
	}
});
</script>
</body>
</html>








