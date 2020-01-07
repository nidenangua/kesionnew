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
					应用市场<span>/</span>连麦明细
   									
				</a>
			</p>
			<!--标题-->
			
			</div>
		
			</div>
		  <div class="fr" style="    width: 418px;">
						<form action="<?php echo  M_URL($this->AppName.'/Index','studentexcel','',GP('id-'.$logid.',wxid-'.$wxid.',start-'.$start)); ?>" method="post">
							<label for="ratiotime" class="label-on">
								<input type="radio" id="ratiotime" name="outtime" value="2" onclick="$('#timebox').hide()"/>本月</span>
							</label>
							<label for="ratiotime" class="label-on">
								<input type="radio" id="ratiotime" name="outtime" value="3" onclick="$('#timebox').hide()"/>本年</label>
							<!--<label for="ratiotime" class="label-on">
								<input type="radio" id="ratiotime" name="anytime" value="6" />6个月前</label>
							<label for="ratiotime" class="label-on">
								<input type="radio" id="ratiotime" name="anytime" value="7" />一年前</label>-->
							<label for="ratiotime" class="label-on">
								<input type="radio" id="ratiotime" name="outtime" value="4" onclick="$('#timebox').show()"/>自定义
								<div style="display: none;" id="timebox">
									<input id="start" type="text" value="" name="startime" required readonly class="w300 laydate-icon">
										-
									<input id="end" type="text" value=""name="endtime" required readonly class="w300 laydate-icon">
								</div>
								</label>
								<label for="ratiotime" class="label-on">
								<input type="submit" class="sc-button btn  btn-default" name="outexcel" value="导出Excel" /></label>
						</form>
						 <form action="<?php echo  M_URL($this->AppName.'/Index','studentexcel','',GP('id-'.$logid.',wxid-'.$wxid.',start-'.$start)); ?>" method="post">
						<input type="hidden" name="outtime"  value="1"   />
						<input type="submit" id="ratiotime" class="sc-button btn  btn-default" name="" value="导出本页" /></label>
					</form>  
			</div>
		</div>

<div class="ks-wbox mt20 bRadius10">
	<div class="H5-gameListScreen">
					<ul class="H5-gameOpt clearfix">
						<!--<li style="margin-right: 15px;"><input  class="selectAll select-checks" name="check1" type="checkbox"></li>-->
						<!--<li>转换率<i class="iconfont icon-sort-double-down"></i></li>-->
						<li>
							<div class="shaixuan clearfix">
								<?php if($start == 'asc'){?>
									<a class="desc" href="<?php echo M_URL($this->AppName.'/Index','wheatis',$logid,GP("start-desc")); ?>"><i class="asc-i"></i>使用时间</a>		
								<?php }else{ ?>
									<a class="desc" href="<?php echo M_URL($this->AppName.'/Index','wheatis',$logid,GP("start-asc")); ?>"><i class="desc-i"></i>使用时间</a>
								<?php }?>
							</div>
							
						</li>
					</ul>
				</div>
		<div id="ksBoxContent">
			
			
			<table class="ks-table pay-border">
   						<tr style="background-color: #f9f9f9;">
   							<th>序号</th>
   							<th>学生姓名</th>
   							<th>连麦开始时间</th>
   							<th>连麦结束时间</th>
   							<th>耗时</th>
   						</tr>
   						<?php foreach($values as $k=>$v){ ?>
   						<tr>
   							<td><?php echo $k+1; ?></td>
   							<td><?php echo $v['membername']; ?></td>
   							<td><?php echo date('Y-m-d H:i:s',$v['starttime']); ?></td>	
   							<td><?php echo date('Y-m-d H:i:s',$v['endtime']); ?></td>
   							<td><?php echo $v['endtime']-$v['starttime']; ?>s</td>
						</tr>
   					   <?php } ?>
   					</table>
   				
   					<?php echo NoC($values);?>	
   						
   				
				</div>
			</div>
<div id="ksBoxFooter" style="height: 210px;">
			<div class="ks-bom clearfix">
		
			</div>
		</div>



</body>
</html>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
