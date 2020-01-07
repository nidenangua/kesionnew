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
<link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
</head>
<body>
<div class="ks-wrap">
	     <div id="ksBoxHead">	

			<div class="Header-tool clearfix">
				<div class="Tool-Title">

				<!--图像-->
				<span class="Tool-icon">
					<i class="iconfont icon-myorder"></i>
				</span>
				<!--图像-->		
				<!--标题-->
				<p>财务明细</p>
				<!--标题-->
				</div>
			</div>
			</div>
	  
	  <div class="capital clearfix ml20 mr20">
	     <div class="fl w17b posRe Balance">
		    <div class="prg-cont rad-prg" id="indicatorContainer8">
			    <div class="rad-con">
					<p class="fsize18 c-79">网校余额</p>
					<p class="fsize14 c-Orange"><?php echo $money;?> 元</p>
				</div>
			</div>
		 </div>
		 <div class="fl w17b posRe Balance">
		    <div class="prg-cont rad-prg" id="indicatorContainer8">
			    <div class="rad-con">
					<p class="fsize18 c-79">学员充值</p>
					<p class="fsize14 c-Orange"><?php echo number_format($study_recharge, 2);?>元</p>
				</div>
			</div>
		 </div>
		 <div class="fl w17b posRe Balance">
		    <div class="prg-cont rad-prg" id="indicatorContainer8">
			    <div class="rad-con">
					<p class="fsize18 c-79">可提现资金</p>
					<p class="fsize14 c-Orange"><?php echo number_format($tixian, 2);?> 元</p>
				</div>
			</div>
		 </div>
		 <div class="fl w83b">
		    <div class="capitalTop clearfix pt22 pb20">
			   <div class="capitalRight w60b fl pt20 pb20">
			      <a class="btn-Orange alignCenter fsize16 hLh40 w150 fr">网校充值</a>
			      <span class="c-89 block alignCenter fsize14">已充值总额</span>
				  <span class="c-72 block alignCenter fsize14"><?php echo number_format($wx_recharge, 2);?>元</span>
			   </div>
			</div>
			<div class="capitalBottom clearfix pt22 pb20">
			   <?php if($status!=2){?>
			   <div class="capitalRight w60b fl pt20 pb20">
			      <a class="btn-27 alignCenter fsize16 hLh40 w150 fr">收入提现</a>
			      <span class="c-89 block alignCenter fsize14">已提现总额</span>
				  <span class="c-72 block alignCenter fsize14">4795.05元</span>
			   </div>
			   <?php }?>
			</div>
		 </div>
	  </div>

	<div class="clearfix">
		 <div class="fl w48b bg-white mt30" id="Accdetails">
			<div class="sBoxTitle">
			   <div class="fr">
				 <a href="" class="fl mr20 operaBtn alignCenter w50 bg-white bRadius5">本周</a>
				 <a href="" class="fl operaBtn alignCenter w50 bg-white bRadius5">本月</a>
			   </div>
			   <div class="imgIcon">
				 <img src="<?php echo UOOT;?>Public/app/images/zhmx.png" class="verAlignMiddle">
				 <span class="c-92 fsize18 verAlignMiddle">学员账户明细</span>
			   </div>
			</div>
			<ul class="mt20 pb20">
				<?php foreach($course as $k=>$v){?>
			   <li class="posRe pl60 pr10 hLh48 borderBso">
				 <em class="colorBg <?php if($k%4==0){echo 'blueIcon';}elseif($k%4==1){echo 'greenIcon';}elseif($k%4==2){echo 'redIcon';}elseif($k%4==3){echo 'OrangeIcon';}?> posAb"></em>
				 <span class="time fr c-92 fsize12"><?php echo KS_DATE($v['adddate'],5);?></span>
				 <a href="" class=" fsize14 c-92">用户<?php echo $v['memberid'];?>购买了《<?php echo $v['title'];?>》花费<?php echo $v['price'];?>元</a>
			   </li>
			   <?php }?>
			</ul>
		 </div>
		 <div class="fr w48b bg-white mt30" id="paymethod">
			<div class="sBoxTitle">
			   <div class="imgIcon">
				 <img src="<?php echo UOOT;?>Public/app/images/skfs.png" class="verAlignMiddle">
				 <span class="c-92 fsize18 verAlignMiddle">网校账户明细</span>
				 <a href="">进入更多明细</a>
			   </div>
			</div>
			<ul class="mt20 pb20">
				<?php foreach($wx_pay_log as $k=>$v){?>
				
			   <li class="posRe pl60 pr10 hLh48 borderBso">
				 <a href="" class=" fsize14 c-92"><?php echo $v['mark'].$v['cmoney'];?>---------<?php echo KS_DATE($v['adddate']);?></a>
			   </li>
			   <?php }?>
			</ul>
		 </div>
	</div> 
</div>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script src="<?php echo UOOT;?>Public/common/js/radialIndicator.js"></script>
<script>

$(function(){
	$("#Accdetails li:last").removeClass("borderBso");
	$("#paymethod li:last").removeClass("borderBso");
})

/*进度条*/
var radialObj8 = $('#indicatorContainer8').radialIndicator({
	barColor: {
		0: '#00b2f8',
		33: '#00b2f8',
		66: '#00b2f8',
		100: '#00b2f8'
	},
	percentage: true,
	radius: 65,
	minValue:0,//这个是百分比的为最小为0%
	maxValue:100,//这个是百分比的为最大100%
	barWidth: 7,
	roundCorner:false,
	percentage: true,
	displayNumber: false,

}).data('radialIndicator');
radialObj8.animate(82.7);//这个是百分比的为余额占总金额的百分比数

loadScorllJs();

</script> 
</body>
</html>
