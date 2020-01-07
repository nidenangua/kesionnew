<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit"> 
<title>kesion教育平台</title>
<meta name="Keywords" content="kesion教育平台"/>
<meta name="Description" content="kesion教育平台" />
<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/capital.css?<?php echoHash(); ?>" rel="stylesheet" />

</head>
<style type="text/css">

</style>
<body class="ks-wrap">
	<div class="ks-wbox bRadius10">
		<!--header-->
	    <div class="ks-head-box">
	     	
		<h3 class="ks-head-title">
     		<div class="ks-head-nav" style="height: 16px;">
			<!--标题-->
			<a href="<?php echo M_URL('Website'); ?>">我的财富</a>
			<!--标题-->
			</div>
		</h3>
	    </div>
	    <!--header-->
					     
			  
		<!--widget-->
		<div class="ks-head-widget clearfix">
			<div class="ks-search-box fl">
	
			</div>					
					
			<div class="fr">
						
			</div>
					
		</div>
		<!--/widget-->
	     
		<!--table-->
		<div class="Nav-tools" style="padding: 0px;">
			<h5>我的余额：<i class="c-red"><?php echo number_format($wxmoney,2);?>元</i></h5>
			<p class="c-92 ml20"><span class="">已充值：<?php echo number_format(getRecharge($this->wxid),2);?>元</span><span class="ml30">已支出：<?php echo number_format(getExpend($this->wxid),2);?>元</span> <a class="ml30 c-2DB7F5" href="<?php echo M_URL('Capital','capitalbill');?>">查看明细</a></p>
			<form target="_top" action="<?php echo M_URL('Capital','rechargemoney');  ?>" method="post" id="myform">
			<h5 class="mt20">余额充值</h5>
			<p class="c-92 ml20 mb10">
				<span class="wrap-ts">1.</span>选择支付方式
			</p>
			<div class="wrap-tab clearfix">
			<div class="wrap-radio ml20 mr30 wrap-on" >
                    <input class="zf" type="radio" name="payid" checked="checked" value="1" >
                    <img class="round-img1" src="<?php echo UOOT;?>Public/app/images/classIcon/payicon.png">
                     <img class="wrap-top" src="<?php echo UOOT;?>Public/app/images/classIcon/pay-cirle.png">		
             </div>
             <div class=" wrap-radio ">
                    <input class="zf" type="radio" name="payid" value="2">
                    <img class="round-img1" src="<?php echo UOOT;?>Public/app/images/classIcon/wxicon.png">
                     <img class="wrap-top" src="<?php echo UOOT;?>Public/app/images/classIcon/pay-cirle.png">			
             </div>
             </div>
			<p class="c-92 ml20 mt10 mb10">
				<span class="wrap-ts">2.</span>填写充值金额
			</p>
			<div class="form-row ml20 clearfix charge1">
	              	<span class="name name-nowrap mr10 fl">金额</span>
	              	<input type="text" class="form-textbox prices fl w150 mr10" id="recharge_money" name="rechargemoney" value="0.00" style="border:1px solid #e0e0e0 ;">
	              	<span class="name name-nowrap fl">元</span>
	              	<button type="button" onClick="submitform();" class="ml30 ks-bt bt-pue">确认充值</button>
	        </div>
	        <div class="form-row clearfix charge1"></div>
			</form>	
		</div>
		
		<div class="Nav-tools" style="padding: 0px;">
			<h5>我的代金券：<i class="c-red"><?php echo count($voucher)+count($taskVoucher);?></i>个<span class="ml40 c-2DB7F5" onClick="window.location='<?php echo M_URL('Capital','voucherbill');?>'">代金券使用明细</span></i></h5>
			<div class="wrap-coupon mt30">
				<ul class="clearfix">
					<?php foreach($voucher as $k=>$v){?>
					<li>
						<a class="coupon-box">
							<div class="coupon-price">
								<span class="coupon-pp c-dff52d">￥<i><?php echo $v['money'];?></i></span>
								<span>
									元</br>代金券
								</span>
							</div>	
							<div class="coupon-txt">
								<h4>剩余<?php echo $v['balance'];?>可用</h4>
								<!--<h4>订单满99元可用</h4>-->
								<p <?php if($v['adddate']>time()||$v['enddate']<time()){?>class="past-due"<?php }?>>使用期限：<?php echo date('Y/m/d',$v['adddate']);?>--<?php echo date('Y/m/d',$v['enddate']);?></p>
							</div> 
						</a>
					</li>
					<?php }?>
					<?php foreach($taskVoucher as $k1=>$v1){?>
					<li>
						<a class="coupon-box">
							<div class="coupon-price">
								<span class="coupon-pp c-dff52d">￥<i><?php echo $v1['money'];?></i></span>
								<span>
									元</br>代金券
								</span>
							</div>	
							<div class="coupon-txt">
								<h4>剩余<?php echo $v1['money'];?>可用</h4>
								<!--<h4>订单满99元可用</h4>-->
								<p <?php if($v1['adddate']>time()||$v1['effectivetime']<time()){?>class="past-due"<?php }?>>使用期限：<?php echo date('Y/m/d',$v1['adddate']);?>--<?php echo date('Y/m/d',$v1['effectivetime']);?></p>
							</div> 
						</a>
					</li>
					<?php }?>
				</ul>
			</div>
		</div>
		
	    <!--/table-->
	
	</div>
	
	
<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>
<script>
	
	module.require(['$','backstage','nicescroll'],function(){
		loadScorllJs()
		$(".wrap-radio").click(function(){
			$(this).find("input").prop("checked","true");
			$(".wrap-radio").removeClass("wrap-on");
			$(this).addClass("wrap-on");
		})
		
		$("#recharge_money").keyup(function () {
		    var reg = $(this).val().match(/\d+\.?\d{0,2}/);
		    var txt = '';
		    if (reg != null) {txt = reg[0];}
		    $(this).val(txt);
		}).change(function () {
		    $(this).keyup();
		});
	});
	function submitform(){
		var recharge_money = $('#recharge_money').val();
		if(recharge_money<=0){Alert('充值金额不能为零');return false;}
		$('#myform').submit();
	}	
	
	</script>
</body>
</html>
