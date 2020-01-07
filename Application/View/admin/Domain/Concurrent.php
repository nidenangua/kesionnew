<!DOCTYPE html>
<html>
<head lang="en">
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit">
<title>云市场</title>
<link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
<style>
	
.pay-box {width: 70%;margin: 0 auto;}	
.pay-wanning {font-size: 18px;line-height: 45px;color: #333;margin-bottom: 5px;position: relative;}
.pay-icon{width: 45px;height: 45px;line-height: 45px;border-radius: 50%;background: greenyellow;display: inline-block;text-align: center;display: inline-block;margin-right: 10px;position: absolute;left: -60px;top: 0;}
.pay-icon i{font-size: 24px;color: #fff;}
.pay-txt {color: #666;font-size: 14px;line-height: 28px;}
.pay-line {height: 1px; background: #ccc;margin: 15px 0;}
.pay-border{border: 1px solid #eee;}
.pay-border-none td {border:0}
.pay-style h3{font-size:16px;line-height: 32px;margin-bottom: 15px;}
.pay-money h3{margin-bottom: 0;font-size: 16px;color: #333;line-height: 32px;text-align: center;}
.pay-money p{font-size: 14px;color: #666; text-align: center;}
.pay-btn {margin-top: 60px;}
.wrap-ts{font-size:20px!important;color:#2DB7F5;font-style: italic;}
.wrap-radio {width: 220px;overflow: hidden; position: relative;border:1px solid #eee;cursor: pointer;float: left;height: 60px;}
.wrap-radio input{position: absolute;width: 100%;height: 100%;z-index: 33;opacity: 0;}	
.wrap-coupon li {float: left;}
.wrap-coupon li a{margin-right: 30px;margin-bottom: 30px;}
.wrap-top {position: absolute;right: 0;top: 0;display: none;}
.wrap-on {border:1px solid #476dbe}
.wrap-on .wrap-top  {display: block;}
</style>
</head>
<body class="ks-wrap" >

<div class="Header-tool clearfix"> 
			<div class="Tool-Title">
			<!--标题-->
			<p>
				<a href="javascript:history.go(-1);">
					<i class="iconfont icon-jiantou-copy"></i>
					应用市场<span>/</span>每月并发
				</a>
			</p>
			<!--标题-->
			
			</div>
		
		
		</div>

<div class="ks-wbox mt20 bRadius10">
		<div id="ksBoxContent">
		   	
			<table class="ks-table pay-border">
   						<tr style="background-color: #f9f9f9;">
   							<th>年</th>
   							<th>月</th>
   							<th>允许最高并发</th>
   							<th>实际最高并发</th>
   						</tr>
   						<?php foreach($values as $k=>$v){ ?>
   						<tr>
   							<td><?php echo $v['year']; ?></td>
   							<td><?php echo $v['month']; ?></td>
   							<td><?php echo $v['amount']; ?></td>	
   							<td>0</td>
   						</tr>
   						<?php } ?>
   					</table>
				</div>
			</div>
<div id="ksBoxFooter" style="height: 210px;">
			<div class="ks-bom clearfix">
				<?php echo $page->show(3); ?>
			</div>
		</div>



</body>
</html>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
