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
<body class="ks-wrap">
<div class="Header-tool clearfix"> 
	<div class="Tool-Title">
	<!--标题-->
	<p>
		<a href="<?php echo M_URL('home/Domain','wxrecharge',$this->wxid); ?>">
			<i class="iconfont icon-jiantou-copy"></i>
			应用市场</a><span>/</span><?php 
			switch($serviceType){case 1:echo '短信服务';break;
				case 2:echo '邮件服务';break;
				case 3:echo '空间服务';break;
				case 4:echo '流量服务';break;
				case 6:echo '并发服务';break;
				case 5:echo '连麦币';break;
			}?> 
	</p>
	<!--标题-->
	</div>
	<div class="fl ks-view-tab mt10">
			<ul>  
				<li   <?php if(ACTION =='serviceRecord' ){echo 'class="curr"';} ?> ><a href="<?php echo M_URL('home/Domain','serviceRecord',$serviceType); ?>">购买记录</a></li>
				<?php if($serviceType==1 || $serviceType==2 || $serviceType==4 || $serviceType==5){ ?>
					<li   <?php if(ACTION =='consumptionRecord' ){echo 'class="curr"';} ?>>
						<a href="<?php echo M_URL('home/Domain','consumptionRecord',$serviceType); ?>">消费记录</a>
					</li>
				<?php } ?>
			</ul>
	</div>
</div>
<div class="ks-wbox mt20 bRadius10">
		<div id="ksBoxContent">
			<?php if(ACTION =='serviceRecord'){ ?>
				<!--zone1-->
			<div class="tap-ban">
			<table class="ks-table pay-border">
   						<tr style="background-color: #f9f9f9;">
   							<th>订单内容</th>
   							<th>数量</th>
   							<th>单价</th>
   							<th>购买时长</th>
   							<th>购买时间</th>
   							<th>实际支付</th>
   						</tr>
   						<?php foreach($values as $k=>$v){ ?>
   						<tr>
   							<td><?php echo $v['appname']; ?></td>
   							<td>
   								<?php 
   									switch($v['appid']){case 1:echo ($v['numb']*1000).'条';break;
   										case 2:echo ($v['numb']*1000).'封';break;
   										case 3:echo floor($v['numb']).'G';break;
   										case 4:echo floor($v['numb']).'G';break;
   										case 6:echo floor($v['numb']).'人';break;
   										case 5:echo floor($v['numb']).'个';break;
   								}?>
   							</td>
   							<td>
   							<?php 
								switch($v['appid']){case 1:echo $v['market_price'].'/千条';break;
									case 2:echo $v['market_price'].'/千封';break;
									case 3:echo  $v['market_price'].'/G/天'; break;
									case 4:echo $v['market_price'].'/G';break;
									case 6:echo $v['market_price'].'/人/月';break;
									case 5:echo $v['market_price'].'个/元';break;
								}
   							?>
   							</td>	
   							<td>
							<?php 
								switch($v['appid']){case 1:echo '--';break;
									case 2:echo '--';break;
									case 3:echo  date('Y-m',$v['starttime']).'~'. date('Y-m',$v['endtime']); break;
									case 4:echo '--';break;
                                    case 6:echo date('Y-m',$v['starttime']).'~'. date('Y-m',$v['endtime']);break;
								}
							?>
   							</td>
   							<td class="c-Orange"><?php echo date('Y-m-d H:i:s',$v['adddate']);?></td>	
   							<td class="c-Orange"><?php if($v['price']==0){echo '赠送';}else{echo $v['price'];} ?></td>
   						</tr>
   						<?php } ?>
   					</table>
   					</div>
   					<?php  }else{ ?>	
   						<!--zone2-->
   					<div class="tap-ban">
   					      <?php 
		   				       switch($serviceType){ 
		   				       	     case 5:   ?>
						   					<table class="ks-table pay-border">
						   						<tr style="background-color: #f9f9f9;">
						   							<th>序号</th>
						   							<th>类型</th>
						   							<th>课程或班级名</th>
						   							<th>总时长</th>
						   							<th>花费</th>
						   							<th>开始时间</th>
						   							<th>结束时间</th>
						   							<th>查看</th>
						   						</tr>
						   						<?php foreach($values as $k=>$v){?>	
						   						<tr>
						   							<td><?php echo $k+1; ?></td>
						   							<td><?php if($v['classlevel']==1){ echo '小班'; }elseif($v['classlevel']==2){ echo '一对一'; }?></td>
						   							<td><?php echo $v['title']; ?></td>
						   							<td><?php echo $v['time']; ?>s</td>
						   							<td><?php echo $v['cost']; ?>元</td>
						   							<td><?php echo date('Y-m-d H:i:s',$v['starttime']); ?></td>
						   							<td><?php echo date('Y-m-d H:i:s',$v['endtime']); ?></td>
						   							<th><a href="<?php echo M_URL('home/Domain','wheatis',$v['id']); ?>">查看</a></th>
						   						</tr>
						   						<?php } ?>
						   					</table>
						   	     <?php break;
						   				case 4: ?>	
						   				   <table class="ks-table pay-border">
						   						<tr style="background-color: #f9f9f9;">
						   							<th>序号</th>
						   							<th>使用流量</th>
						   							<th>结算日期</th>
						   						</tr>
						   						<?php foreach($values as $k=>$v){?>	
						   						<tr>
						   							<td><?php echo $k+1; ?></td>
						   							<td><?php echo $v['flow']; ?>M</td>
						   							<td><?php echo $v['countdate']; ?></td>
						   						</tr>
						   						<?php } ?>
						   					</table>
				   				  <?php break; 
				   				  	     case 1: ?>
				   				  	     <table class="ks-table pay-border">
						   						<tr style="background-color: #f9f9f9;">
						   							<th>发送时间</th>
						   							<th>用户名</th>
						   							<th>返回信息</th>
						   							<th>接收手机</th>
						   							<th>状态</th>
						   							<th>操作IP</th>
						   						</tr>
						   						<?php foreach($values as $k=>$v){?>	
						   						<tr>
						   							<td><?php echo date('Y-m-d H:i:s',$v['adddate']);; ?></td>
						   							<td><?php echo Field($v['username']); ?></td>
						   							<td><?php echo Field($v['mark']); ?></td>
						   							<td><?php echo Field($v['mobile']); ?></td>
						   							<td><?php if($v['issuccess']==0){?><i style="color: red;">失败</i><?php }else{?><i style="color: lightgreen;">成功</i><?php }?></td>
						   							<td><?php echo Field($v['memberip']);?></td>
						   						</tr>
						   						<?php } ?>
						   					</table>
				   				  	     
				   				  <?php break;
				   				  	      case 2: ?>	
				   				  	        <table class="ks-table pay-border">
						   						<tr style="background-color: #f9f9f9;">
						   							<th>发送时间</th>
						   							<th>接受者用户名</th>
						   							<th>状态</th>
						   						</tr>
						   						<?php foreach($values as $k=>$v){?>	
						   						<tr>
						   							<td><?php echo date('Y-m-d H:i:s',$v['adddate']) ?></td>
						   							<td><?php echo Field($v['username'])?></td>
						   							<td><?php if($v['issuccess'] == 1){echo '成功';}else{echo '失败';} ?></td>
						   						</tr>
						   						<?php } ?>
						   					</table>
						   			<?php break;  ?>		       
				   					
				   			 <?php } ?>			
   					</div>
   					<?php } ?>
   					<?php echo NoC($values);?>	
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