<!DOCTYPE html>
<html>
<head lang="en">
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit">
<title>云市场</title>
<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/shop.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />

<style>
	.warning{max-width: 100%;background-image: none;padding: 20px 30px 20px 20px;}
	.concurrence {margin: 0 auto;padding: 40px 0;}
	.concurrence .concurrence-title {font-size: 24px;margin-bottom: 30px;}
	.concurrence-op {margin-bottom: 15px;line-height: 32px;}
	.concurrence-op .concurrence-left{font-size: 16px;display: inline-block;vertical-align: top;}
	.concurrence-op .concurrence-right {display: inline-block; vertical-align: middle;position: relative;}
	.concurrence-right li {float: left;  padding: 0 20px;font-size: 14px;cursor: pointer;border: 1px solid #eee;margin-right:10px;height: 30px;line-height: 30px;border-radius: 3px;}
	.concurrence-right .curr{background: #fff; color: #e5412c;border:1px solid #e5412c}
	.concurrence-op .concurrence-right {font-size: 16px;}
	.concurrence-sign {font-size: 14px;color:#a68883; padding: 15px 20px;}
	.concurrence-btn{}
	.concurrence-btn .ks-bt{float: none;display: inline-block;}
	.input-number{position: absolute;right: -166px;z-index: 99;color: #333;top: 0;display:none}
	.number-box {float: left;  padding: 0 20px;font-size: 14px;cursor: pointer;border: 1px solid #eee;margin: 0 5px;height: 30px;line-height: 30px;position: relative;}
	.new-form {position: relative;}
	.select-box {position: absolute;padding: 10px; box-shadow: 0  0  10px 1px rgba(0,0,0,.15) ;width: 200px;background: #fff;z-index: 99;top: 45px;left: 0;border-radius: 10px;}
	.select-month li{float: left;height: 50px;line-height: 50px;width: 25%;color: #333;border-radius: 5px;cursor: pointer;}
	.select-year {}
	.select-month .active{background: #476dbe; color: #fff;}
	.package-list{ border-collapse: collapse;}
		.package-list td{ padding: 15px;border:1px solid #ebebeb; cursor: pointer; font-size:14px; text-align: center;min-width:100px;color:#666;}
		.package-list .td_hover{background: #fbfbfb;}
		.package-list .tr_title{font-weight: bold;}
		.package-list .tr_title td{color:#555;}
		.package-list .tr_title .label-on{border-top:2px solid #e5412c;color:#e5412c;}
		.upgrade-bt{width:140px;height:42px; line-height: 42px; display: block;margin:0 auto; float: inherit;}
		.icon-zhengque{color:#44d58e;}
		.c-6EC7E5 {color: #6EC7E5;}
		.c-86A8F{color: #86A8F1;}
		.c-red{color: red;}
		.package-table {width: 100%;}
		.package-subtable {width: 100%}
		.package-black{background: #000}
		.package-2e74b5{background: #e5412c;}
		.pacage-d3dfef{background: #f9f9f9;}
		.package-subtable td{padding: 15px;  border: 1px solid  #ececec;cursor: pointer;font-size: 14px;text-align: center;min-width: 100px;color: #fff;border-top: 0;}
		.package-sub td{background: #f9f9f9!important;}
		.package-bb td{color: #000;}
		.package-subtable .package-title {font-size: 24px;color: #000;text-align: left;border-right: 0;}
		.icon-zhengque{color: #44b549;font-size: 24px;}
		.package-list .td_active,.package-subtable .td_active{background: #f5f5f5;}
		.package-subtable .td_active{color: #000;}
		.package-bo{border-right: 0!important;border-left: 0!important;}
		.c-black td{color: #000!important;}
		.package-subtable .package-detail {color: #999!important;font-size: 14px;text-align: left;background: #fff!important;}
		.tr_title .label-on {background: #2860d8;color: #fff;}
		.border-r0 {border-right: 0;}
		.border-l0 {border-left: 0;}
		.border-lr0 {border-left: 0;border-right: 0;}
</style>
</head>
<body class=" ks-wrap">
	<div class="ks-wbox bRadius10">
		<!--header-->
	   <div class="ks-head-nav" style="border-bottom: solid 1px #EEEEEE;margin-bottom: 10px;">
			<span class="fr"><?php  switch ($serviceType){
				case 7: ?>
					<p style="font-size:14px">累计充值时长：<i class="c-green"><?php echo Sec2Time(getLimitService(7,1));?></i> &nbsp; &nbsp; &nbsp; 剩余使用时长：<i class="c-red"><?php echo Sec2Time(getLimitService(7));?></i></p>
					<?php break;
			   case 6: ?>	
			<p style="font-size:14px">当月可使用并发：<i class="c-green"><?php echo getLianmai($this->wxid); ?></i></p>
			<?php break;
					case 1:  ?>
			<p style="font-size:14px">剩余短信：<i class="c-green"><?php echo getLimitService(1);?></i> &nbsp; &nbsp; &nbsp; 已使用短信：<i class="c-red"><?php echo getLimitService(1,1)-getLimitService(1);?></i></p>
			<?php break;
				case 4: ?>
			<p style="font-size:14px">累计充值流量：<i class="c-green"><?php echo getLimitService(3)/1024;?>G</i> &nbsp; &nbsp; &nbsp; 已使用流量：<i class="c-red"><?php echo getData($this->wxid);?>G</i></p>			
			<?php break;
					case 2: ?>
			<p style="font-size:14px">剩余邮件：<i class="c-green"><?php echo getLimitService(2);?></i> &nbsp; &nbsp; &nbsp; 已使用邮件：<i class="c-red"><?php echo getLimitService(2,1)-getLimitService(2);?></i></p>		
			<?php break;
					case 3: ?>	
		    <p style="font-size:14px">剩余空间：<i class="c-green"><?php echo getLimitService(5)/1024;?>G</i> &nbsp; &nbsp; &nbsp; 已使用空间：<i class="c-red"><?php echo getSize($this->wxid);?>G</i></p>
			<?php break;
					case 5: ?>	
		    <p style="font-size:14px">剩余：<i class="c-green"><?php echo number_format(getLimitService(6),2);?>币</i> &nbsp; &nbsp; &nbsp; 已使用：<i class="c-red"><?php echo number_format(getLimitService(6,1)-getLimitService(6),2);?>币</i></p>	
			<?php } ?></span>
			<!--标题-->
			<a href="<?php echo M_URL('Shop','CapacityService'); ?>">扩容服务</a><span><em>/</em><?php switch ($serviceType){ case 1: echo '购买短信'; break; case 2: echo '购买邮件';break; case 3:  echo '购买扩容';break; case 4: echo '购买流量';break; case 6: echo '购买并发';break; case 5: echo '购买直播币';break; case 7: echo '购买转码时长';break;}?></span>
			<!--标题-->
		</div> 
	    <!--header--> 
		<!--table-->
		<div class="concurrence" style="padding: 0px;">
				<form action="<?php echo M_URL('Shop','buyService',$serviceType,GP('day-'.$day)); ?>" method="post" id="myform">
				<!--科汛V名师云点播-->
				<?php  switch ($serviceType){
					case 7: ?>
						<!--科汛V名师云点播(转码)-->
						<div class="concurrence-sub">
							<div class="form-box">
								<div class="concurrence-title">科汛V名师云点播(转码)</div>

								<div class="concurrence-op">
									<div class="concurrence-left">购买数量：</div>
									<div class="concurrence-right">
										<ul class="fl">
											<li class="curr">5小时</li>
											<li>10小时</li>
											<li>20小时</li>
											<li>30小时</li>
											<li>50小时</li>
										</ul>
										<div class="number-box">
											自定义
											<div class="input-number">
												<input class="form-textbox fl mr10"  name="spaceNumber"  type="number"  style="width: 80px;" />
												<button  class="ks-bt bt-pue" type="button" onClick="numberSb(this)">确定</button>
											</div>

										</div>

									</div>
								</div>
								<div class="concurrence-op">
									<div class="concurrence-left">单价：</div>
									<div class="concurrence-right"><i class="c-Orange">￥<?php echo $price ?></i> 元/小时</div>
								</div>
								<div class="concurrence-op">
									<div class="concurrence-left">数量:</div>
									<div class="concurrence-right"><i class="data-number">5</i> 小时</div>
									<input type="hidden" name="numb" class="number" value="5" />
								</div>
								<div class="concurrence-op">
									<div class="concurrence-left">费用：</div>
									<div class="concurrence-right"><i class="c-Orange vodface"><?php echo $price*5;?></i>元</div>
								</div>

								<div class="concurrence-btn">
									<button class="ks-bt bt-pue bt-medium">立即支付</button>
									<p class="concurrence-sign mt30 warning">注：用于上传视频产生转码费用，当转码时长不足您的视频仅支持PC端上传MP4格式，且无法得到加密保护。</p>
								</div>
							</div>
						</div>
						<?php break;
			   case 6: ?>		
				<div class="concurrence-sub">
					<div class="form-box">
						<div class="concurrence-title">科汛V名师云直播(并发)</div>
						<div class="concurrence-op">
							
							<div class="concurrence-left">购买月份：</div>
							<div class="concurrence-right">
								<input id="selectTime" class="form-textbox" value="<?php echo date('Y-m',time());?> 至 <?php echo date('Y-m',time());?>" />
							</div>
							<div class="concurrence-right"></div>
						</div>
						<div class="concurrence-op">
							<div class="concurrence-left">并发数量：</div>
							<div class="concurrence-right">
								<div class="clearfix">
									<ul class="fl">
										<li class="curr">50</li>
										<li>100</li>
										<li>200</li>
										<li>300</li>
										<li>500</li>
										<li>800</li>
										<li>1000</li>
										<li>2000</li>
										
									</ul>
									<div class="number-box">
										自定义
										<div class="input-number">
											<input class="form-textbox fl mr10"  name="spaceNumber"  type="number"  style="width: 80px;" />
											<button  class="ks-bt bt-pue" type="button" onClick="numberSb(this)">确定</button>
										</div>
									
									</div>
								</div>
								<div class="concurrence-sign" style="padding-left: 0px;">用户超出并发数将无法进入教室</div>
							</div>
						</div>
						
						<div class="concurrence-op">
							<div class="concurrence-left">单价：</div>
							<div class="concurrence-right"><i class="c-Orange">￥<?php echo $price ?></i> 元/人/月</div>
						</div>
						<div class="concurrence-op">
							<div class="concurrence-left ">新增并发：</div>
							<div class="concurrence-right"><i class="data-number">50</i>人</div>
						</div>
							<div class="concurrence-op">
							<div class="concurrence-left ">并发时长：</div>
							<div class="concurrence-right"><i class="cound-type2">1</i>个月</div>
						</div>
						<div class="concurrence-op">
							<div class="concurrence-left">费用：</div>
							<div class="concurrence-right"><i class="price"><?php echo $price ?></i>元/人 × <i class="data-number">50</i>并发 × <i class="cound-type2" id="selectMonthLength">1</i>个月 = <i class="c-Orange count-co vodface"></i> 元</div>
						</div>
						<div class="concurrence-btn">
							<button class="ks-bt bt-pue bt-medium" id="pay-submit" onClick="de_reg()" type="button">立即支付</button>
							<input type="hidden" name="numb" class="number" value="50" />
							<input type="hidden" name="startime" id="startime" class="time" value="<?php echo time(); ?>" />
							<input type="hidden" name="endtime" id="endtime" class="time" value="<?php echo time(); ?>" />
							<input type="hidden" name="day" class="time" value="1" />
							<div class="concurrence-sign mt30 warning">注：并发数未网校购买的用于学员在直播间内上课或者看直播回放的最大人数，若网校学员已超预购的并发数，学员将无法进入直播间上课</div>
						</div>
					</div>
				</div>
				<?php break;
					case 5: ?>
				<!--科汛V名师云直播(并发)end-->
				<!--科汛V名师云短信-->
				<div class="concurrence-sub mt60">
					<div class="form-box">
						<div class="concurrence-title">科汛V名师直播币</div>
					
						<div class="concurrence-op">
							<div class="concurrence-left">购买数量：</div>
							<div class="concurrence-right">
								<ul class="fl">
								    <li class="curr">20枚(开放体验)</li>
									<li>500枚</li>
									<li>1000枚</li>
									<li>2000枚</li>
									<li>5000枚</li>
								</ul>
								<div class="number-box">
									自定义
									<div class="input-number">
										<input class="form-textbox fl mr10"  name="spaceNumber"  type="number"  style="width: 80px;" />
										<button  class="ks-bt bt-pue" type="button" onClick="numberSb(this)">确定</button>
									</div>
								</div>
							</div>
						</div>
						<div class="concurrence-op">
							<div class="concurrence-left">单价：</div>
							<div class="concurrence-right"><i class="c-Orange">￥<?php echo  $price; ?></i> 元/枚</div>
						</div>
						<div class="concurrence-op">
							<div class="concurrence-left">数量:</div>
							<div class="concurrence-right"><i class="data-number">20</i>枚</div>
							<input type="hidden" name="numb" class="number" />
						</div>
							<div class="concurrence-op">
							<div class="concurrence-left">费用：</div>
							<div class="concurrence-right"><i class="c-Orange vodface"></i>元</div>
						</div>
						<div class="concurrence-btn">
							<button class="ks-bt bt-pue bt-medium">立即支付</button>
							<p class="concurrence-sign mt30 warning">注：并发数未网校购买的用于学员在直播间内上课或者看直播回放的最大人数，若网校学员已超预购的并发数，学员将无法进入直播间上课</p>
						</div>
					</div>
				</div>
				
				
				
				<?php break;
					case 1:  ?>
				<!--科汛V名师云直播(并发)end-->
				<!--科汛V名师云短信-->
				<div class="concurrence-sub">
					<div class="form-box">
						<div class="concurrence-title">科汛V名师云短信</div>
					
						<div class="concurrence-op">
							<div class="concurrence-left">购买数量：</div>
							<div class="concurrence-right">
								<ul class="fl">
									<li class="curr">1000条</li>
									<li>2000条</li>
									<li>3000条</li>
									<li>5000条</li>
									<li>10000条</li>
									<li>20000条</li>
								</ul>
								<div class="number-box">
									自定义
									<div class="input-number">
										<input class="form-textbox fl mr10" name="spaceNumber"  type="number"  style="width: 80px;" />
										<button  class="ks-bt bt-pue" type="button" onClick="numberSb(this)">确定</button>
									</div>
									
								</div>
								
							</div>
						</div>
						<div class="concurrence-op">
							<div class="concurrence-left">单价：</div>
							<div class="concurrence-right"><i class="c-Orange">￥<?php echo $price ?></i> 元/千条</div>
						</div>
						<div class="concurrence-op">
							<div class="concurrence-left">数量:</div>
							<div class="concurrence-right"><i class="data-number">1000</i>条</div>
							<input type="hidden" name="numb" class="number" />
						</div>
							<div class="concurrence-op">
							<div class="concurrence-left">费用：</div>
							<div class="concurrence-right"><i class="c-Orange vodface"></i>元</div>
						</div>
						<div class="concurrence-btn">
								<button class="ks-bt bt-pue bt-medium">立即支付</button>
								<p class="concurrence-sign mt30 warning">注：并发数未网校购买的用于学员在直播间内上课或者看直播回放的最大人数，若网校学员已超预购的并发数，学员将无法进入直播间上课</p>
						</div>
					
					</div>
					
				</div>
				<?php break;
					case 4: ?>
				<!--科汛V名师云短信-->
				<!--科汛V名师云点播(流量)-->
				<div class="concurrence-sub">
					<div class="form-box">
						<div class="concurrence-title">科汛V名师云点播(流量)</div>
					
						<div class="concurrence-op">
							<div class="concurrence-left">购买视频流量：</div>
							<div class="concurrence-right">
								<ul class="fl">
									<li class="curr">50G</li>
									<li>100G</li>
									<li>200G</li>
                                    <li>500G</li>
                                    <li>1024G</li>
									
									
								</ul>
									<div class="number-box">
										自定义
										<div class="input-number">
											<input class="form-textbox fl mr10"  name="spaceNumber"  type="number"  style="width: 80px;" />
											<button  class="ks-bt bt-pue" type="button" onClick="numberSb(this)">确定</button>
										</div>
									
								</div>
							</div>
						</div>
						<div class="concurrence-op">
							<div class="concurrence-left">单价：</div>
							<div class="concurrence-right"><i class="c-Orange">￥<?php echo $price ?></i> 元/G</div>
						</div>
						<div class="concurrence-op">
							<div class="concurrence-left">新增流量：</div>
							<div class="concurrence-right"><i class="data-number">20</i> G</div>
							<input type="hidden" name="numb" class="number" value="20" />
						</div>
							<div class="concurrence-op">
							<div class="concurrence-left">费用：</div>
							<div class="concurrence-right"><i class="c-Orange vodface"></i>元</div>
						</div>
					
						<div class="concurrence-btn">
							<button class="ks-bt bt-pue bt-medium">立即支付</button>
							<p class="concurrence-sign mt30 warning">注：视频流量用于学员观看视频产生的费用，如果流量消耗完毕，学员将无法观看视频。</p>
						</div>
					</div>

				</div>
				<?php break;
					case 2: ?>
			<!--科汛V名师云点播(流量)-->
				<!--科汛V名师云点播(流量)-->
				<div class="concurrence-sub">
					<div class="form-box">
						<div class="concurrence-title">科汛V名师云邮箱</div>
					
						<div class="concurrence-op">
							<div class="concurrence-left">购买数量：</div>
							<div class="concurrence-right">
								<ul class="fl">
									<li class="curr">5000封</li>
									<li>10000封</li>
									<li>20000封</li>
									<li>30000封</li>
									<li>50000封</li>
								</ul>
								<div class="number-box">
										自定义
										<div class="input-number">
											<input class="form-textbox fl mr10"  name="spaceNumber"  type="number"  style="width: 80px;" />
											<button  class="ks-bt bt-pue" type="button" onClick="numberSb(this)">确定</button>
										</div>
									
								</div>
								
							</div>
						</div>
						<div class="concurrence-op">
							<div class="concurrence-left">单价：</div>
							<div class="concurrence-right"><i class="c-Orange">￥<?php echo $price ?></i> 元/千封</div>
						</div>
						<div class="concurrence-op">
							<div class="concurrence-left">数量:</div>
							<div class="concurrence-right"><i class="data-number">5000</i> 封</div>
							<input type="hidden" name="numb" class="number" value="5000" />
						</div>
							<div class="concurrence-op">
							<div class="concurrence-left">费用：</div>
							<div class="concurrence-right"><i class="c-Orange vodface">120</i>元</div>
						</div>
					
					 	<div class="concurrence-btn">
							<button class="ks-bt bt-pue bt-medium">立即支付</button>
							<p class="concurrence-sign mt30 warning">注：并发数未网校购买的用于学员在直播间内上课或者看直播回放的最大人数，若网校学员已超预购的并发数，学员将无法进入直播间上课</p>
						</div>
					</div>
				</div>
				<?php break;
					case 3: ?>
			<!--科汛V名师云点播(流量)-->
						<!--科汛V名师云点播(流量)-->
				<!--科汛V名师云点播(流量)-->
				<div class="concurrence-sub">
					<div class="form-box">
						<div class="concurrence-title">空间扩容服务</div>
					
						<div class="concurrence-op">
							<div class="concurrence-left">购买空间：</div>
							<div class="concurrence-right">
								<ul class="fl">
									<li class="curr">20G</li>
									<li>30G</li>
									<li>50G</li>
									<li>100G</li>
									
									
								</ul>
								<div class="number-box">
										自定义
										<div class="input-number">
											<input class="form-textbox fl mr10"  name="spaceNumber"  type="number"  style="width: 80px;" />
											<button  class="ks-bt bt-pue" type="button" onClick="numberSb(this)">确定</button>
										</div>
									
								</div>
							</div>
						</div>
						<div class="concurrence-op">
							<div class="concurrence-left">单价：</div>
							<div class="concurrence-right"><i class="c-Orange">￥<?php echo $price ?></i> 元/G/天</div>
						</div>
						<div class="concurrence-op">
							<div class="concurrence-left">新增空间：</div>
							<div class="concurrence-right " ><i class="data-number">20</i> G</div>
							<input type="hidden" name="numb" class="number" value="2000" />
						</div>
						<div class="concurrence-op">
							<div class="concurrence-left">套餐到期时间：</div>
							<div class="concurrence-right"><?php echo date('Y-m-d',$Expire) ?></div>
						</div>
							<div class="concurrence-op">
							<div class="concurrence-left">剩余天数: </div>
							<div class="concurrence-right"><?php echo $day ?>天<span class="concurrence-sign">注购买的空间</span></div>
						</div>
						<div class="concurrence-op">
							<div class="concurrence-left">费用：</div>
							<div class="concurrence-right"><i class="c-Orange vodface">10000</i>元</div>
						</div>
					
						 <div class="concurrence-btn">
                             <?php
                             if (checkIsVip($this->wxid)>0){  //VIP高级运营版本才支持扩容
                                 ?>
							  <button class="ks-bt bt-pue bt-medium" type="button" onClick="de_reg(type)">立即支付</button>
                             <?php }else{?>
                              <button class="ks-bt bt-pue bt-medium" type="button" onClick="location.href='/home.html/default/Service/upgrade'">升级高级运营版</button>
                             <?php
                             }?>
							<input type="hidden" name="startime" id="startime" class="time" value="<?php echo time(); ?>" />
							<input type="hidden" name="endtime" id="endtime" class="time" value="<?php echo $Expire; ?>" />
							<p class="concurrence-sign mt30 warning">注：空间用于存放图片、视频等资源，空间占满后，将无法继续上传任何的资料。这时需要及时的扩容（只有高级运营版本支持空间扩容）。</p>
						</div>
					</div>
				</div>
				
				<?php break;} ?>
				</form>
			<!--科汛V名师云点播(流量)-->
						<?php if($serviceType==5){?>
			<div style="padding: 30px; width: 80%;margin: 0 auto;">
				<table class="package-subtable ">

				
				<tr class="pacage-d3dfef package-sub">						
				<td class="package-title " colspan="5">线上课堂计费标准</td>
				
				</tr>	
				
				
				 <tr  class=" c-black  pacage-d3dfef">
				<td> 授课方式</td>
				<td>班型</td>
				<td>计费方式</td>
				<td>备注</td>
				
				</tr>
				
				<tr class="c-black">
				<td >连麦互动</td>
				<td>一对一 </td>
				<td>360P：0.02元/分钟</td>
				<td>举例：如果老师用360P分辨率跟学生互动半小时 （按同时接入人数老师算1人）<br/>收费：0.02*30*(1+1)=<i class="c-red">3.6</i>元</td>
				</tr>
				
				<tr class="c-black  pacage-d3dfef">
				<td>连麦互动</td>
				<td>小班课</td>
				<td>360P：0.02元/分钟/人</td>
				<td>举例：如果老师用360P分辨率跟3个学生同时上课半小时 （按同时接入人数老师算1人）<br/>收费：0.02*30*(3+1)=<i class="c-red">2.4</i>元
				</td>	
				</tr>

				<tr class="c-black">
				<td>直播大课</td>
				<td>公开课</td>
				<td>360P：0.02元/分钟/人</td>
				<td>举例：按观众（学生）人数计费，如果这个直播间有100人同时进入，并开始观看一小时。<br/>收费  0.02*60*100=<i class="c-red">180</i>元
				</td>	
				</tr>
                <!--<tr class="c-black ">
				<td>纯直播 </td>
				<td> 大班课 </td>
				<td>并发收费（元/人/月）</td>
				<td>¥30</td>	
				<td>举例：取当月最高并发数，如当月最高并发数为100人，为30元*100人=<i class="c-red">3000</i>元</td>	
				</tr> -->
				</table>	
	        </div>
			<?php }?>
			</div>
	    <!--/table-->
	            
		
	
	</div>
	
	
	<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>
	<script>
		
		var  _startFlag = true;
		var  _endFlag =true;
		var serviceType = <?php echo $serviceType ?>;
		var day = <?php echo $day ?>;
		var price = <?php if($serviceType==1||$serviceType==2){echo $price/1000 ;}else{echo $price;} ?>;
		
		var Concurrent = 0;
		module.require(['$','backstage','laydate','nicescroll'],function(){
			
			if(serviceType == 6){
				laydate.render({
				  elem: '#selectTime'
				  ,type: 'month'
				  ,min:'<?php echo date('Y-m',time());?>-1'
				  ,range: '至'
				  ,format: 'yyyy-MM'
				  ,done:function(v){
				  	if(!v){
				  		return false
				  	};
				  	var __startime = v.split(' 至 ')[0];
				  	var __endtime = v.split(' 至 ')[1];
				    document.getElementById('startime').value = __startime;
				  	document.getElementById('endtime').value = __endtime;
				  	day = getMonthLength(__endtime) - getMonthLength(__startime) + 1;
				  	$('#selectMonthLength').html(day)
				  }
				});
				
				function getMonthLength(time){
					var year = (time.split('-')[0]-1)*12 + parseInt(time.split('-')[1]);
					return year
				}
			}
			loadScorllJs()
			var dataNumber = parseInt($('.concurrence-right .curr').text());
			$('.number').val(dataNumber);
			    if(serviceType ==1 || serviceType==2 ){
			    	 $('.number').val(parseInt(dataNumber/1000))
			    };
				var vodfaceprice=price*day*dataNumber;
				vodfaceprice =vodfaceprice.toFixed(2)
				$('.vodface').html(vodfaceprice) ;
				$('.concurrence-right li').click(function(){
					var dataNumber = parseInt($(this).text());
					$(this).addClass('curr').siblings().removeClass('curr');
				 	$('.number-box').removeClass('curr');
				    $('.data-number').html(dataNumber) ;
				    
				    vodfaceprice=price*day*dataNumber;
				    //云直播并发
				 
				    
				    $('.vodface').html(vodfaceprice.toFixed(2));
				   // var numb =parseInt(dataNumber/price);
				  
				    $('.number').val(dataNumber);
				    if(serviceType ==1 || serviceType==2 ){
				    	 $('.number').val(parseInt(dataNumber/1000));
				    }

	
				})
				$('.number-box').click(function(){
					$(this).addClass('curr');
					$('.concurrence-right li').removeClass('curr');
					$(this).find('.input-number').show();
					
				})
				
				
				
		});
	


	function numberSb(target){
		
		var spaceNumber = parseInt($('input[name="spaceNumber"]').val());

		if(serviceType == 1 && spaceNumber<1000){
			Alert('请输入大于等于1000条');
			return false;
		}
		if(serviceType == 2 && spaceNumber<1000){
			Alert('请输入大于等于1000封');
			return false;
		}
		if(serviceType == 3 && spaceNumber<10){
			Alert('请输入大于等于10G');
			return false;
		}
		if(serviceType == 4 && spaceNumber<10){
			Alert('请输入大于等于10G');
			return false;
		}
		if(serviceType == 5 && spaceNumber<500){
			Alert('最少充值500');
			return false;
		}
		if(serviceType == 6 && spaceNumber<50){
			Alert('最少购买50');
			return false;
		}
		
	
		$('.data-number').html(spaceNumber);
		  $(this).parents('.input-number').hide();
		   vodfaceprice=price*day*spaceNumber;
	     $('.vodface').html(vodfaceprice.toFixed(2));
	
	     $('.number').val(spaceNumber);
	       if(serviceType ==1 || serviceType==2 ){
	    	 $('.number').val(spaceNumber/1000);
	       }
	   
	 
	}
	
	function de_reg(type){
		
		var money = $('.vodface').text();
		if(money<0){
			Alert('系统出错，请联系管理人员');
			return false;
		}
		
		$('#myform').submit();
		
	}

		
		</script>
</body>
</html>
