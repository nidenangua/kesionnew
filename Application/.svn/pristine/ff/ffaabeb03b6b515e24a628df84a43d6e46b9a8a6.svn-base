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


</head>
<body class="ks-wrap">

<div class="ks-wbox bRadius10">
		<div class="ks-head-nav">
				<!--标题-->
				 <a  href="javascript:history.go(-1);">应用市场</a><span><em>/</em><?php 
					switch($serviceType){case 1:echo '短信服务';break;
						case 2:echo '邮件服务';break;
						case 3:echo '空间服务';break;
						case 4:echo '流量服务';break;
						case 6:echo '并发服务';break;
						case 5:echo '直播币';break;
					}?> </span>
				<!--标题-->
			</div>
			
			<div class="ks-head-tab" style="display: block;">
 			<ul class="clearfix">
 				<li   <?php if(ACTION =='serviceRecord' ){echo 'class="curr"';} ?> ><a href="<?php echo M_URL('Domain','serviceRecord',$serviceType,'wxid-'.$this->wxid); ?>">购买记录</a></li>
				<?php if($serviceType==1 || $serviceType==2 || $serviceType==4 || $serviceType==5){ ?>
					<li   <?php if(ACTION =='consumptionRecord' ){echo 'class="curr"';} ?>>
                        <?php if ($serviceType==4){?>
                        <a href="<?php echo M_URL('Domain','consumptionRecord',$serviceType,'wxid-'.$this->wxid); ?>">播放记录</a>
                         <?php }else { ?>
						<a href="<?php echo M_URL('Domain','consumptionRecord',$serviceType,'wxid-'.$this->wxid); ?>">消费记录</a>
                        <?php }?>
					</li>
				<?php } ?>
 			</ul>
     	</div>
     	
     	
	
		
			<?php if(ACTION =='serviceRecord'){ ?>
				<!--zone1-->
			<div class="tap-ban">
			<table class="ks-table pay-border">
   						<tr style="background-color: #f9f9f9;">
						    <th>订单号</th>
   							<th>订单内容</th>
   							<th>数量</th>
   							<th>单价</th>
							<?php if($serviceType!=5){echo '<th>购买时长</th>';}?>
   							<th>购买时间</th>
   							<th>实际支付</th>
   						</tr>
   						<?php foreach($values as $k=>$v){ ?>
   						<tr>
						    <td><?php echo $v['ordersn']; ?></td>
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
   							<?php switch($v['appid']){case 1:echo $v['market_price'].'/千条';break;
									case 2:echo $v['market_price'].'/千封';break;
									case 3:echo  $v['market_price'].'/G/天'; break;
									case 4:echo $v['market_price'].'/G';break;
									case 6:echo $v['market_price'].'/人/月';break;
									case 5:echo $v['market_price'].'个/元';break;
							}?>
   							</td>	
							<?php switch($v['appid']){case 1:echo '<td>--</td>';break;
									case 2:echo '<td>--</td>';break;
									case 3:echo '<td>'.date('Y-m',$v['starttime']).'~'. date('Y-m',$v['endtime']).'</td>'; break;
									case 4:echo '<td>--</td>';break;
                                    case 6:echo '<td>'.date('Y-m',$v['starttime']).'~'. date('Y-m',$v['endtime']).'</td>';break;
							}?>
   							<td class="c-Orange"><?php echo date('Y-m-d H:i:s',$v['adddate']);?></td>	
   							<td class="c-Orange"><?php if($v['price']==0){echo '赠送';}else{echo $v['price'].'元';} ?></td>
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
						   							<th style="text-align: left;">课程或班级名</th>
						   							<th style="text-align: left;">总时长(包括学生)</th>
						   							<th>花费(直播币)</th>
						   							<th>开始时间</th>
						   							<th>结束时间</th>
													<th>扣费时间</th>
						   							<th>学生连麦详情</th>
						   						</tr>
						   						<?php foreach($values as $k=>$v){?>	
						   						<tr>
						   							<td><?php echo $k+1; ?></td>
						   							<td><?php if($v['classlevel']==1){ echo '小班'; }elseif($v['classlevel']==2){ echo '一对一'; }?></td>
						   							<td style="text-align: left;"><?php echo $v['title']; ?></td>
						   							<td style="text-align: left;"><span style="color:red;"><?php echo number_format($v['time']/60,2);?>分钟</span>(<?php echo $v['time'];?>s)</td>
						   							<td><span style="color:red;"><?php echo $v['cost']; ?>元</span></td>
						   							<td><?php echo date('y/m/d H:i:s',$v['starttime']); ?></td>
						   							<td><?php echo date('y/m/d H:i:s',$v['endtime']); ?></td>
													<td><?php echo date('y/m/d H:i:s',$v['settlement']); ?></td>
						   							<th><a href="<?php echo M_URL('Shop','wheatis',$v['id']); ?>">学生详情</a></th>
						   						</tr>
						   						<?php } ?>
						   					</table>
						   	     <?php break;
						   				case 4: ?>	
						   				   <table class="ks-table pay-border">
						   						<tr style="background-color: #f9f9f9;">
						   							<th>序号</th>
						   							<th>用户ID</th>
						   							<th>用户IP</th>
						   							<th>播放时间</th>
						   							<th>课程</th>
						   							<th>消耗流量</th>
						   						</tr>
						   						<?php foreach($values as $k=>$v){?>	
						   						<tr>
						   							<td><?php echo $k+1; ?></td>
						   							<td><?php echo ($v['memberid']==0?'游客：'.$v['sessionid']:User_GetUserName($v['memberid'])); ?></td>
						   							<td><?php echo $v['memberip']; ?></td>
						   							<td><?php echo KS_DATE($v['adddate']); ?></td>
						   							<td style="text-align:left">
                                                       <?php
                                                             if ($v['coursehour']==1){
                                                                 echo "课程 ：".$v['title'];
                                                                echo ('<br/>课时：'. getCourseChaterName($v['chaptertable'],$v['chapterid'],'title'));
                                                             }else{
                                                                 echo $v['title'];
                                                             }
                                                           ?></td>
						   							<td><?php echo number_format($v['vdoSize'],2); ?>M</td>
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
   						
   					<?php if(!empty($values)){?>	
					<div class="ks-bom form-footer clearfix">
						<?php echo $page->show(3); ?>
					</div>	
					<?php } ?>
				</div>
				
			
			</div>

		
</body>
</html>
<script src="<?php echo UOOT;?>/Public/common/js/module.js?<?php echo echoHash();?>"></script>
<script>
	module.require(['$','backstage','nicescroll'],function(){
		loadScorllJs();
	})	
</script>