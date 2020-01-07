<!DOCTYPE html>
<html>
<head lang="en">
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit">
<title>云市场</title>
		<link href="<?php echo UOOT;?>Public/app/css/laydate.css" rel="stylesheet">
	<link href="<?php echo UOOT;?>Public/admin/css/kesion-common.css" rel="stylesheet">
	<link href="<?php echo UOOT;?>Public/admin/css/html5.css" rel="stylesheet">
	<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/admin/css/general.css" rel="stylesheet">
	<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/admin/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/app/css/page.animate.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/admin/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
	<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
	<script type="text/javascript" src="<?php echo UOOT;?>Public/common/js/layer/laydate.js"></script>
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
				<a href="<?php echo M_URL($this->AppName.'/Index','index','',GP('appid-7')); ?>">
					<i class="iconfont icon-jiantou-copy"></i>
					点播管理</a><span>/</span>流量购买
				
			</p>
			<!--标题-->
			
			</div>
			<div class="fl ks-view-tab mt10">
						<ul>  
							<li class="curr" ><a href="<?php echo M_URL($this->AppName.'/Index','serviceRecord','',GP('wxid-'.$wxid)); ?>">购买记录</a></li>
							<li><a href="<?php echo M_URL($this->AppName.'/Index','consumptionRecord','',GP('wxid-'.$wxid)); ?>">消费记录</a></li>
						</ul>
			</div>
		   <div class="fr" style="    width: 418px;">
						<form action="<?php echo  M_URL($this->AppName.'/Index','Bflowexcel','',GP('p-'.$page->now_page.',wxid-'.$wxid.',adddate-'.$adddate.',numb-'.$numb)); ?>" method="post">
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
						 <form action="<?php echo  M_URL($this->AppName.'/Index','Bflowexcel','',GP('p-'.$page->now_page.',wxid-'.$wxid.',adddate-'.$adddate.',numb-'.$numb)); ?>" method="post">
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
								<?php if($adddate == 1){?>
									<a class="desc" href="<?php echo M_URL($this->AppName.'/Index','serviceRecord','',GP("adddate-2")); ?>"><i class="desc-i"></i>购买时间</a>		
								<?php }else{ ?>
									<a class="desc" href="<?php echo M_URL($this->AppName.'/Index','serviceRecord','',GP("adddate-1")); ?>"><i class="asc-i"></i>购买时间</a>
								<?php }?>
							</div>
							
						</li>
						<li >
							<div class="shaixuan clearfix">
								
								<?php if($numb == 1){?>
									<a class="desc" href="<?php echo M_URL($this->AppName.'/Index','serviceRecord','',GP("numb-2")); ?>"><i class="desc-i"></i>购买数量</a>		
								<?php }else{ ?>
									<a class="desc" href="<?php echo M_URL($this->AppName.'/Index','serviceRecord','',GP("numb-1")); ?>"><i class="asc-i"></i>购买数量</a>
								<?php }?>
							</div>
						</li>
					</ul>
				</div>
		<div id="ksBoxContent">
				<!--zone1-->
			<div class="tap-ban">
					<table class="ks-table pay-border">
		   						<tr style="background-color: #f9f9f9;">
		   							<th>订单号</th>
		   							<th>订单内容</th>
		   							<th>数量</th>
		   							<th>单价</th>
		   							<th>实际支付</th>
		   							<th>购买时间</th>
		   							<th></th>
		   						</tr>
		   						<?php foreach($values as $k=>$v){ ?>
		   						<tr>
		   							<td><?php echo $v['ordersn']; ?></td>
		   							<td><?php echo $v['appname']; ?></td>
		   							<td><?php echo floor($v['numb']).'G';?></td>
		   							<td><?php echo $v['market_price'].'/G';?></td>	
		   							<td class="c-Orange"><?php echo $v['price']; ?></td>	
		   							<td ><?php echo date('Y-m-d H:i:s',$v['adddate']); ?></td>
		   							<td>
										<!--<div class="operate">
											<a href="javascript:void(0);" onclick="Confirm('是否删除该条记录？该操作不可逆!','<?php echo M_URL($this->AppName.'/Index','singledelete',$v['id'],GP('p-'.$page->now_page.',type-2')); ?>')">
												<i class='delete2017'></i>
											</a>
										</div>-->
									</td>
		   						</tr>
		   						<?php } ?>
		   					</table>
   					</div>
   						
   					<?php echo NoC($values);?>	
   						
				</div>
			</div>
<div id="ksBoxFooter" style="height: 210px;">
			<div class="ks-bom clearfix">
				<?php echo $page->show(3); ?>
			</div>
		</div>


<script>
	var start = {
	  elem: '#start',
	  format: 'YYYY/MM/DD hh:mm:ss',
	  //min: laydate.now(), //设定最小日期为当前日期
	  max: '2099-06-16 23:59:59', //最大日期
	  istime: true,
	  istoday: false,
	  choose: function(datas){
	     end.min = datas; //开始日选好后，重置结束日的最小日期
	     end.start = datas //将结束日的初始值设定为开始日
	  }
	};
	var end = {
	  elem: '#end',
	  format: 'YYYY/MM/DD hh:mm:ss',
	  min: laydate.now(),
	  max: '2099-06-16 23:59:59',
	  istime: true,
	  istoday: false,
	 
	};
	laydate(start);
	laydate(end);	
</script>
</body>
</html>
<script src="//store.kesion.com/Public/common/js/common.js"></script>
