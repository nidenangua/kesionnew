<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/laydate.css" rel="stylesheet">
<script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>
<style>
.mt50 {
	margin-top: 20px;
}
.ks-borde td {
	border: 0;
	text-align: left;
}
.ks-bborde {
	border-bottom: 1px solid #eee;
}
</style>
</head>
<body class="ks-wrap">
<div id="ksBoxHead"> 
<div class="fl ks-view-tab mt10" style="overflow: inherit;">
				<ul>  
				
					<li <?php if($type==1)echo 'class="curr"'; ?>><a href="<?php echo M_URL('Vdo','countlive','',GP('type-1')); ?>">今日数据</a> </li>
					<li <?php if($type==2)echo 'class="curr"'; ?>><a href="<?php echo M_URL('Vdo','countlive','',GP('type-2')); ?>">昨日数据</a></li>
					
					
					<li class="time-click <?php if($type==3)echo 'curr'; ?>" ><a>指定时间段</a>
						<form target="hidframe"  action="" method="post" id="myform2">
						<div class="ks-time">
							<input id="start" type="text" value="<?php if($type==3){echo $start;} ?>" name="starttime"  class="w300 laydate-icon"  >
													-
							<input id="end" type="text" value="<?php if($type==3){echo $end;} ?>" name="endtime"  class="w300 laydate-icon" >
						    <input  type="button" value="确定" name="endtime" onclick="selecttime()"  class="ks-bt bt-pue"  style="display: inline-block;float: none;" >	
						</div>
					</form>
					</li>
					
				</ul>
			</div>
</div>
<br />
总连麦时长：<?php echo $time ?>分钟<br />
总消费情况：<?php echo $money ?>币	
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script>
	
		starttime("#start");//开始时间
		endtime("#end");//结束时间


	
function selecttime(){
var starttime = 　Date.parse(new Date($("input[name='starttime']").val()))/1000; 

if(!starttime){
	Alert('请选择开始时间');return false;
}
var endtime =Date.parse(new Date($("input[name='endtime']").val()))/1000;
if(!endtime){
	Alert('请选择结束时间');return false;
}  

window.location.href='<?php echo M_URL('Vdo','countlive','',GP('type-3')); ?>,starttime-'+starttime+',endtime-'+endtime+'';
		 
}
		$('.time-click').click(function(){
		$('.ks-time').slideToggle(300)
	})

</script>

</body>
</html>