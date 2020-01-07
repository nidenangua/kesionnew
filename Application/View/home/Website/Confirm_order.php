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
.pay-wanning {font-size: 18px;line-height: 45px;color: #333;margin-bottom: 5px;position: relative;padding-left:0}
.pay-icon{width: 45px;height: 45px;line-height: 45px;border-radius: 50%;background: greenyellow;display: inline-block;text-align: center;display: inline-block;margin-right: 10px;position: absolute;left: 0;top: 0;}
.pay-icon i{font-size: 24px;color: #fff;}
.pay-txt {color: #666;font-size: 14px;line-height: 28px;}
.pay-line {height: 1px; background: #ccc;margin: 15px 0;}
.pay-border{border: 1px solid #eee;}
.pay-border-none td {border:0}
.pay-style h3{font-size:16px;line-height: 32px;margin-bottom: 15px;}
.pay-money h3{margin-bottom: 0;font-size: 16px;color: #333;line-height: 32px;text-align: center;}
.pay-money p{font-size: 14px;color: #666; text-align: center;}
.pay-btn {margin-top: 60px;text-align: center;}
.wrap-ts{font-size:20px!important;color:#2DB7F5;font-style: italic;}
.wrap-radio {width: 180px;overflow: hidden; position: relative;border:1px solid #eee;cursor: pointer;float: left;height: 70px;}
.wrap-radio input{position: absolute;width: 100%;height: 100%;z-index: 33;opacity: 0;}	
.wrap-coupon li {float: left;}
.wrap-coupon li a{margin-right: 30px;margin-bottom: 30px;}
.wrap-top {position: absolute;right: 0;top: 0;display: none;}
.wrap-on {border:1px solid #476dbe}
.wrap-on .wrap-top  {display: block;}
</style>
</head>
<body class="ks-wrap" >
	<div class="ks-wbox bRadius10">
		<!--header-->
	    <div class="ks-head-box">
	     	
		<h3 class="ks-head-title">
     		<div class="ks-head-nav" style="height: 16px;">
			<!--标题-->
			<a href="<?php echo M_URL('Website'); ?>">支付订单</a>
			<!--标题-->
			</div>
		</h3>
	    </div>
	    <!--header-->
					     
			  
		<!--widget-->
		<div class="ks-head-widget clearfix">
			<div class="ks-search-box fl">
				<a class="ks-bt bt-pur mr10" href="<?php echo M_URL('Service','orderList'); ?>">我的订单</a>
				<a class="ks-bt bt-pur" href="<?php echo $Data006['url1']; ?>">返回</a>

			</div>					
					
			<div class="fr">
						
			</div>
					
		</div>
		<!--/widget-->
	     
		<!--table-->
		<form action="<?php echo $Data006['url2']; ?>" method="post" <?php if($Data006['type']=='Website'){if(($summoney-$Money)>0){ ?>target="_top"<?php }} ?>>
		<?php if($orderid !=0){ ?>	
			<div class="pay-wanning"><span class="pay-icon"><i class="icon-zhengque iconfont"></i></span>您提交的服务订单已经生成，订单24小时内支付有效，请尽快支付</div>
		
		<div class="pay-code clearfix">
			<span class="col-3 pay-txt">订单编号:<?php echo $orderinfo['ordersn'];?></span>
			<span class="col-3 pay-txt">订单时间:<?php echo date("Y-m-d H:i:s",$orderinfo['adddate']);?></span>
		</div>
		<?php } ?>
		<div class="pay-line"></div>
		<div class="pay-detail">
			<table class="ks-table pay-border">
				<tr style="background-color: #f9f9f9;">
					<th>类型</th><th>订单内容</th><th>数量</th><th>单价</th>
					<th>购买时长</th>
					<th>小计</th>
				</tr>
				<tr>
					<td>套餐</td><td><?php echo $versionname;?></td><td><?php echo ($versionename=='v2')?'---':$pack_time;?></td><td><?php echo $packagemoney;?>元/年</td>
					<td><?php echo ($versionename=='v2')?'---':$pack_time.'年';?></td>
					<td class="c-Orange">￥<i class="subtotal"><?php echo ($packagemoney*$pack_time);?></i>元/年</td>	
				</tr>
			</table>
			<div class="pay-line"></div>
			<table class="ks-table pay-border-none">
				<tr><td style="text-align: left;">订单总额</td><td class="c-Orange"  style="text-align: right;">￥<?php echo number_format($summoney,2); ?></td></tr>
				<tr><td style="text-align: left;">账户余额</td><td class="c-Orange"  style="text-align: right;">￥<?php echo number_format($Money,2);?></td></tr>
				<tr>
					<td style="text-align: left;">支付金额</td>
					<td class="c-Orange"  id="endmoney" style="text-align: right;">￥<?php if(($summoney-$Money)>0){echo number_format($summoney-$Money,2);}else{echo '0.00';}?></td>
				</tr>
			</table>
			<div class="pay-line"></div>
			<?php if(($summoney-$Money)>0){if($Data006['type']=='Website'){?>
			<div class="pay-style"  id ='playstatus'>
				<h3>选择支付方式</h3>
				<div class="pay-style-box">
					<div class="wrap-tab clearfix">
						 <?php $i=0;foreach($payconfig as $k=>$v){if($v['status']==1){?>	
						 <div class="wrap-radio  mr30 label-on <?php if($i==0)echo 'wrap-on';?>" >
			                    <input class="zf" type="radio" name="payid" <?php if($i==0)echo 'checked="checked"';?> value="<?php echo $v['id'];?>">
			                      <img class="wrap-top" src="<?php echo UOOT;?>Public/app/images/classIcon/pay-cirle.png">		
			                    <img class="round-img1" style="width: 100%;height:100%;display: block;" src="<?php echo $v['defaultpic']; ?>">
			             </div>
			             <?php $i++;}} ?> 
			         </div>
				</div>
			</div>
			<?php }else{?>
			<div class="Created-ing clearfix">
				<ul>
					<li>
						<h4>实收金额:</h4>
						<div class="Created-Content">
							<input class="form-textbox" name="order_amount" id="order_amount" value="0.00" type="text"/>		<!--<?php if(($summoney-$Money)>0){echo $summoney-$Money;}else{echo '0.00';}?>-->		
						</div>
						<script>
						$("#order_amount").keyup(function () {
						    var reg = $(this).val().match(/\d+\.?\d{0,2}/);
						    var txt = '';
						    if (reg != null) {txt = reg[0];}
						    $(this).val(txt);
						}).change(function () {
						    $(this).keyup();
						});
						</script>
					</li>
					<li>
						<h4>备注:</h4>
						<div class="Created-Content">
							<textarea class="form-textarea w300" name="mark" style="min-height: 80px;">网校升级套餐,线下付款,人工代为升级</textarea>			
						</div>
					</li>
				</ul>
			</div>	
			<?php }}?>	
			<div class="pay-btn"><button class=" ks-bt bt-pue fn">确认支付</button></div>
		</div>
   		<?php if(!empty($orderid)){ ?><!--有传入订单id的情况，直接按订单来支付就好了-->
        <input type="hidden" name="orderid" value="<?php echo $orderid;?>" />
        <?php }else{?><!--没有传入订单id的情况，支付时要生成订单-->
        <input type="hidden" name="versionid"    value="<?php echo $versionid;?>" />	
        <input type="hidden" name="pack_time"    value="<?php echo $pack_time;?>" />
        <input type="hidden" name="pad_numb"     value="<?php echo $pad_numb;?>" />
        <input type="hidden" name="printer_numb" value="<?php echo $printer_numb;?>" />
        <?php }?>	
		</form> 
	    <!--/table-->
	</div>
	<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>
	<script>
		module.require(['$','backstage','nicescroll'],function(){
			loadScorllJs();
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
			
		});
		
		function getvoucher(obj){
			var moneys = <?php echo round($summoney,2); ?>;
			var index  =  $(obj).find('option:selected').attr('data-money');
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
