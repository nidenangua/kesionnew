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
<link href="<?php echo UOOT;?>Public/app/css/html5.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/admin/css/general.css" rel="stylesheet">
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
.wrap-radio {width: 180px;overflow: hidden; position: relative;border:1px solid #eee;cursor: pointer;float: left;height: 70px;}
.wrap-radio input{position: absolute;width: 100%;height: 100%;z-index: 33;opacity: 0;}	
.wrap-coupon li {float: left;}
.wrap-coupon li a{margin-right: 30px;margin-bottom: 30px;}
.wrap-top {position: absolute;right: 0;top: 0;display: none;}
.wrap-on {border:1px solid #476dbe}
.wrap-on .wrap-top  {display: block;}
</style>
</head>
<body class="gray-bg" >
<!--<div class="headNav bg-gary posFi hLh48 clearfix w100">
    <ul class="fr mr20">
        <li class="fl mr20"><em class="fr icon12 arrowIcon"></em><a href="<?php echo M_URL('Shop','CapacityService'); ?>" title="我的云市场" class="verAlignMiddle">我的云市场</a></li>
        <li class="fl mr20"><em class="fr icon12 arrowIcon"></em><i class="icon15 shopCarIcon mr5"></i><a href="<?php echo M_URL('Service','cart'); ?>" title="购物车" class="verAlignMiddle">购物车<font class="c-red">1</font></a></li>
        <li class="fl mr20"><em class="fr icon12 arrowIcon"></em><i class="icon15 shopCarIcon mr5"></i><a href="<?php echo M_URL('Service','orderList'); ?>" title="我的订单" class="verAlignMiddle">我的订单</a></li>
    </ul>
</div>-->
	<div id="manage_top" class="menu_top_fixed  p15 height73">
			<div class="Header-tool  clearfix">
						<div class="ibox-title mt10">
						
						
						
						<!--标题-->
						<h3 class="fl">支付订单</h3 >	
						<!--标题-->
						
						
						<!--操作范围-->
			
						<div class="Tool-btnGroup fr">
							 <a class="ks-bt bt-pur mr10" href="<?php echo M_URL('Shop','CapacityService'); ?>" style="margin-left:15px;display:inline-block">
						      我的云市场</a>
							 <a class="ks-bt bt-pur mr10" href="<?php echo M_URL('Service','cart'); ?>" style="margin-left:15px;display:inline-block">
							购物车</a>
							 <a class="ks-bt bt-pur mr10" href="<?php echo M_URL('Service','orderList'); ?>" style="margin-left:15px;display:inline-block">
							我的订单</a>
							<button class="ks-bt bt-def ml15" onClick="history.go(-1)"><i class="iconfont icon-fanhui"></i>返回</button>
						</div>
				
						 
						<!--操作范围-->
					</div>
						
					</div>
	</div>				
<!--<?php if(($servicemoney-$Money)>0){ ?>target="_top"<?php } ?>-->
<form action="<?php echo M_URL('home/Domain','payService','',GP('wxid-'.$this->wxid)); ?>" method="post" id="myform">
   		<div class="ks-wbox bRadius10 " style="margin-top:70px;">
   			<div id="ksBoxContent">
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
   								 <?php switch($serviceinfo['seriesid']){case 40:echo '元/G';break;case 12:echo '元/G';break;case 13:echo '币';break;case 14:echo '元/千条';break;case 15:echo '元/千封';break;case 11:'元/人/月';break;} ?>
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
   					
   					<div class="Created-ing clearfix">
						<ul>
							<li>
								<h4>实收金额:</h4>
								<div class="Created-Content">
									<input class="form-textbox" name="order_amount" id="order_amount" value="<?php echo $servicemoney;?>" type="text"/>		
                                     提示：如果是赠送的话，请输入“0”。
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
   					<!--<div class="pay-style"  id ='playstatus'>
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
   					</div>-->
   					<div class="pay-btn"><button class=" ks-bt bt-pue ">确认支付</button></div>
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
		<div id="ksBoxFooter"><div class="ks-bom clearfix"></div></div>
   <!-- <div class="box ">
        <div class="lh-40 fc-hei fz-16 mp_10" style=" font-family: '微软雅黑'">
        	<strong>订单金额:</strong><span class="fz-20 fc-com mr_40">￥<?php echo number_format($servicemoney,2); ?></span>
            <strong>账户余额:</strong><span  class="fz-20 fc-com mr_40">￥<?php echo number_format($Money,2);?></span>
            <?php if(!empty($voucher)){?>
            <strong>代金券:</strong><span  class="fz-20 fc-com mr_40"><select><option>请选择</option><?php foreach($voucher as $k=>$v){?><option><?php echo $v['voucher'];?></option><?php } ?></select>
			</span>			
			<?php }?>
            <strong>您需要支付金额：￥</strong><span class="fz-20 fc-cheng mr_40"><?php if(($servicemoney-$Money)>0){echo number_format($servicemoney-$Money,2);}else{echo '0.00';}?></span>
        </div>
        <?php if(($servicemoney-$Money)>0){ ?>
        <div class="mp_10">
            <?php $i=0;foreach($payconfig as $k=>$v){if($v['status']==1){?>
        	<div class="bd-all mr_20 f-l ac h-60 hand <?php if($i==0)echo 'zf-k';?>" style="width:220px; overflow:hidden; position:relative;">
            	<input class="zf" type="radio" name="payid" <?php if($i==0)echo 'checked="checked"';?> value="<?php echo $v['id'];?>" >
            	<img class="round-img1" src="<?php echo $v['defaultpic']; ?>" >
            </div>
            <?php $i++;}} ?> 
            <div class="clear"></div>
        </div>
        <?php } ?>
        <div class="mp_10">
        	<button class="round-bt hand">确认支付</button>
        </div>
    </div>-->
</body>
</html>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script>
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