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
<link href="<?php echo UOOT;?>Public/app/css/capital.css?<?php echoHash(); ?>" rel="stylesheet" />
<style>


</style>
</head>
<body class="ks-wrap" >
	<div class="ks-wbox bRadius10">
		<!--header-->
	    <div class="ks-head-box">
	     	
		<h3 class="ks-head-title">
     		支付订单
		</h3>
	    </div>
	    <!--header-->
					     
			  
		<!--widget-->
		<div class="clearfix">
		<div class="Tool-btnGroup" style="display: none;"> 
			 <a class="ks-bt bt-pue mr10" href="<?php echo M_URL('Shop','CapacityService'); ?>" style="margin-left:15px;display:inline-block">
		      我的云市场</a>
			 <a class="ks-bt bt-pue mr10" href="<?php echo M_URL('Service','Cart'); ?>" style="margin-left:15px;display:inline-block">
			购物车</a>
			 <a class="ks-bt bt-pue mr10" href="<?php echo M_URL('Service','orderList'); ?>" style="margin-left:15px;display:inline-block">
			我的订单</a>
		</div>
		</div>
		<!--/widget-->
		<!--table-->
		<form action="<?php echo M_URL('Shop','payService'); ?>" method="post" target="_top" id="myform">
		<div class="ks-wbox bRadius10">
		<div>
			<div class="pay-box">
			<?php if($orderid !=0){ ?>	
				<div class="pay-wanning"><span class="pay-icon"><i class="icon-zhengque iconfont"></i></span>您提交的服务订单已经生成，订单24小时内支付有效，请尽快支付</div>
			
			<div class="pay-code clearfix">
				<span class="col-3 pay-txt">订单编号:<?php echo $orderinfo['ordersn'];?></span>
				<span class="col-3 pay-txt">订单时间:<?php echo date("Y-m-d H:i:s",$orderinfo['adddate']);?></span>
			</div>
				<div class="pay-line" ></div>
			<?php } ?>
		
			<div class="pay-detail">
				<table class="ks-table pay-border">
					<tr style="background-color: #f9f9f9;">
						<th>类型</th>
						<th>订单内容</th>
						<th>数量</th>
						<th>单价</th>
						<th>购买时长</th>
						<th>小计</th>
					</tr>
					<tr>
						<td>服务</td>
						<td><?php echo $serviceinfo['servicename'];?></td>
						<td><?php switch($serviceinfo['seriesid']){
							case 40:echo $numb;break;
							case 12: echo $numb;break;
							case 13 : echo $numb;break; 
							case 14 :echo $numb*1000;break; 
							case 15: echo $numb*1000;break;
							case 11: echo $numb;break;}?></td>
						<td><?php echo number_format(wx_version_itemvalue($serviceinfo['seriesid']),2);?>
							 <?php switch($serviceinfo['seriesid']){case 40:echo '元/G';break;case 12:echo '元/G';break;case 13:echo '币';break;case 14:echo '元/条';break;case 15:echo '元/千封';break;case 11:'元/人/月';break;} ?>
						</td>
						<td>
							 <?php switch($serviceinfo['seriesid']){
							 	case 40:echo $day.'天';break;
							 	case 12:echo '--';break;
							 	case 13:echo '--';break;
							 	case 14:echo '--';break;
							 	case 15:echo '--';break;
							 	case 11:echo date('Y-m',$starttime).'~'.date('Y-m',$endtime);break;} ?>
						</td>
						<td class="c-Orange">￥<?php echo number_format($servicemoney,2); ?></td>	
					</tr>
				</table>
				<div class="pay-line" ></div>
				<table class="ks-table pay-border-none">
					<tr>
						<td style="text-align: left;">订单总额</td>
						<td class="c-Orange"  style="text-align: right;">￥<?php echo number_format($servicemoney,2); ?></td>
					</tr>
					 <?php if(!empty($voucher)){?>
					<tr>
						<td style="text-align: left;">代金券</td>
						<td style="text-align: right;">
							<select class="new-form w150" onChange="getvoucher(this)" name="voucher">
								<option value="0" data-money="0">请选择</option>
								 <?php foreach($voucher as $k=>$v){?>
								 	 <option value="<?php echo $v['id']; ?>" data-money="<?php echo $v['balance']; ?>"><?php echo $v['voucher'];?></option>
								<?php } ?>
										
							</select>
							<span id="vouche"></span>
						</td>
					</tr>
					<?php } ?>
					<tr>
						<td style="text-align: left;">支付金额</td>
						<td class="c-Orange"  id="endmoney" style="text-align: right;">￥<?php echo number_format($servicemoney,2); ?></td>
					</tr>
				</table>
				<div class="pay-line"></div>
				<div class="pay-style"  id ='playstatus'>
					<h3>选择支付方式</h3>
					<div class="pay-style-box">
						<div class="wrap-tab clearfix">
							 
							 <?php $i=0;foreach($payconfig as $k=>$v){if($v['status']==1 && $v['payename'] !='xcxpay'){?>
							 <div class="wrap-radio  mr30 label-on <?php if($i==0)echo 'wrap-on';?>" >
				                    <input class="zf" type="radio" name="payid" <?php if($i==0)echo 'checked="checked"';?> value="<?php echo $v['id'];?>">
				                      <img class="wrap-top" src="<?php echo UOOT;?>Public/app/images/classIcon/pay-cirle.png">		
				                    <img class="round-img1"  src="<?php echo $v['defaultpic']; ?>">
				             </div>
				             <?php $i++;}} ?> 
				            
				          
				         </div>
					</div>
				</div>
				
				<div class="pay-btn"><button class=" ks-bt bt-pue bt-medium ">确认支付</button></div>
		 
		   				</div>
			</div>
		</div>	
		</div>	
		 <?php if(!empty($orderid)){ ?><!--有传入订单id的情况，直接按订单来支付就好了-->
		<input type="hidden" name="orderid" value="<?php echo $orderid;?>" />
		<?php }else{?><!--没有传入订单id的情况，支付时要生成订单-->
		<input type="hidden" name="serviceid" value="<?php echo $serviceid;?>" />
		<input type="hidden" name="numb" value="<?php echo $numb;?>" />	
		<input type="hidden" name="servicemoney" value="<?php echo $servicemoney;?>" />	
		
		<?php if($serviceinfo['seriesid']==11 || $serviceinfo['seriesid']==40 ){ ?>
		<input type="hidden" name="day" value="<?php echo $day;?>" />
		<input type="hidden" name="starttime" value="<?php echo $starttime;?>" />	
		<input type="hidden" name="endtime" value="<?php echo $endtime;?>" />	
		<?php } ?>
		<?php }?>	
		</form> 
	    <!--/table-->
	            
		<!--footer-->
		<div class="ks-bom clearfix">
			<span class="fl">
						
			</span>
					
			<div class="fr">
						
			</div>
		</div>
		<!--/footer-->
	
	</div>
	
	
	<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>
	<script>
		module.require(['$','backstage','nicescroll'],function(){
			loadScorllJs();
			$(function(){
			$(".wrap-radio").click(function(){
				$(this).find("input").prop("checked","true");
				$(".wrap-radio").removeClass("wrap-on");
				$(this).addClass("wrap-on");
				})
				var flag=true;
				$(document).on("click", "#select-all", function(){
				if(flag==true){
					$("input[type='checkbox']").prop("checked","true");
					flag=false; 
				}else{
					$("input[type='checkbox']").removeAttr("checked"); 
							flag=true;
						}
					})
			})
		});
	

function getvoucher(obj){
	var   moneys = <?php echo round($servicemoney,2); ?>	;
	var   index  =  $(obj).find('option:selected').attr('data-money');
	money =moneys-index;
	if(index>0){
		if(money<0 || money==0){
			$('#vouche').text('-'+moneys+'元');
		}else{
			$('#vouche').text('-'+index+'元');
		}
		
	}
	if(money<0 || money==0){
		$('#endmoney').text('￥0');
		$('#playstatus').hide();
		$('#myform').attr('target','');
	}else{
		$('#endmoney').text('￥'+money.toFixed(2));
		$('#playstatus').show();
		$('#myform').attr('target','_top');
	}
}
</script>
  
</body>
</html>
