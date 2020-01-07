<!DOCTYPE html>
<html>
<head lang="en">
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit">
<title>云市场</title>
<link href="<?php echo UOOT;?>Public/admin/css/general.css" rel="stylesheet">

<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />

<link href="<?php echo UOOT;?>Public/app/css/shop.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/laydate.css" rel="stylesheet">

<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
<style>

	.concurrence {width: 800px;margin: 0 auto;padding: 40px 0;}
	.concurrence .concurrence-title {text-align: center;font-size: 24px;margin-bottom: 30px;}
	.concurrence-op {margin-bottom: 15px;line-height: 32px;}
	.concurrence-op .concurrence-left{font-size: 16px;display: inline-block;vertical-align: top;}
	.concurrence-op .concurrence-right {display: inline-block; vertical-align: middle;position: relative;}
	.concurrence-right li {float: left;  padding: 0 20px;font-size: 14px;cursor: pointer;border: 1px solid #eee;margin: 0 5px;height: 30px;line-height: 30px;}
	.concurrence-right .curr{background: #476dbe; color: #fff;}
	.concurrence-op .concurrence-right {font-size: 16px;}
	.concurrence-sign {font-size: 12px;color: #999;}
	.concurrence-btn{text-align: center;}
	.concurrence-btn .ks-bt{float: none;display: inline-block;}
	.input-number{position: absolute;right: -150px;z-index: 99;color: #333;top: 0;display:none}
	.number-box {float: left;  padding: 0 20px;font-size: 14px;cursor: pointer;border: 1px solid #eee;margin: 0 5px;height: 30px;line-height: 30px;position: relative;}
	.new-form {position: relative;}
	.select-box {position: absolute;padding: 10px; box-shadow: 0  0  10px 1px rgba(0,0,0,.15) ;width: 200px;background: #fff;z-index: 99;top: 45px;left: 0;border-radius: 10px;}
	.select-month li{float: left;height: 50px;line-height: 50px;width: 25%;color: #333;text-align: center;border-radius: 5px;cursor: pointer;}
	.select-year {text-align: center;}
	.select-month .active{background: #476dbe; color: #fff;}
	.form-footer {border-top: 0;}
</style>
</head>
<body class="gray-bg">
	<div id="manage_top" class="menu_top_fixed  p15 height73">
		<!--结束-->
		<div class="Header-tool clearfix"> 
			<div class="ibox-title mt10">
			<!--标题-->
			<h3>
				<a href="javascript:history.go(-1);" class="fl">
					<i class="iconfont icon-jiantou-copy"></i>
					应用市场<span>/</span><?php switch ($serviceType){ 
						case 1: echo '购买短信'; break; 
						case 2: echo '购买邮件';break; 
						case 3:  echo '购买扩容';break;
						 case 4: echo '购买流量';break;
						 case 6: echo '购买并发';break; 
						 case 5: echo '购买连麦币';break; 
					 }?>
				</a>
				<div class="fl">
			<?php  switch ($serviceType){
			   case 6: ?>	
			<p style="margin-left: 30px;">当月可使用并发：<i class="c-86A8F"><?php echo getLianmai($this->wxid); ?></i></p>
		
			<?php break;
					case 1:  ?>
			<p style="margin-left: 30px;">剩余短信：<i class="c-86A8F"><?php echo getLimitService(1,'',$this->wxid);?></i></p>
			<p style="margin-left: 30px;">已使用短信：<i class="c-86A8F"><?php echo getLimitService(1,1,$this->wxid)-getLimitService(1,'',$this->wxid);?></i></p>		
			<?php break;
				case 4: ?>
			<p style="margin-left: 30px;">剩余流量：<i class="c-86A8F"><?php echo getLimitService(3,'',$this->wxid)/1024;?>G</i></p>
			<p style="margin-left: 30px;">已使用流量：<i class="c-86A8F"><?php echo getFlow($this->wxid);?>G</i></p>			
			<?php break;
					case 2: ?>
			<p style="margin-left: 30px;">剩余邮件：<i class="c-86A8F"><?php echo getLimitService(2,'',$this->wxid);?></i></p>
			<p style="margin-left: 30px;">已使用邮件：<i class="c-86A8F"><?php echo getLimitService(2,1,$this->wxid)-getLimitService(2,'',$this->wxid);?></i></p>		
			<?php break;
					case 3: ?>	
		    <p style="margin-left: 30px;">剩余空间：<i class="c-86A8F"><?php echo getLimitService(5,'',$this->wxid)/1024;?>G</i></p>
			<p style="margin-left: 30px;">已使用空间：<i class="c-86A8F"><?php echo getSize($this->wxid);?>G</i></p>
			<?php break;
					case 5: ?>	
		    <p style="margin-left: 30px;">剩余：<i class="c-86A8F"><?php echo getLimitService(6,'',$this->wxid);?>币</i></p>
			<p style="margin-left: 30px;">已使用：<i class="c-86A8F"><?php echo getLimitService(6,1,$this->wxid)-getLimitService(6,'',$this->wxid);?>币</i></p>	
			<?php } ?>
				</div>
			</h3>
			<!--标题-->
			
			</div>
			<!--操作范围-->
		
			<!--按钮组件-->
			<div class="fr">
             <div class="fl ks-top-search">
			<!--搜索-->
				<button class="ks-bt bt-def" onClick="history.go(-1)"><i class="iconfont icon-fanhui"></i>返回</button>
			<!--搜索-->
			</div>  
              
               
        </div>
			<!--按钮组件-->
			
			
			
			<!--操作范围-->
		
		</div>
	</div>
	<div class="bg-white  bRadius10"  style="margin-top: 75px;">
		<div id="ksBoxContent">
			<div class="concurrence" >
				<form action="<?php echo M_URL('home/Domain','buyService',$serviceType,GP('day-'.$day)); ?>" method="post" id="myform" >
				<!--科汛微门户云直播(并发)-->
		<?php  switch ($serviceType){
			   case 6: ?>		
				<div class="concurrence-sub">
					<div class="concurrence-title">科汛微门户云直播(并发)</div>
					<div class="concurrence-op">
						<div class="concurrence-left">购买月份：
							<div class="new-form w150" onClick="selectTime(this)" data-start data-flag="start"><span class="start-input"><?php echo date('Y-m',time()); ?></span><div class="startime" ></div></div>
							<i style="margin: 0 15px;"> 至</i>
						<div class="new-form w150" onClick="selectTime(this)" data-end data-flag="end"><span class="end-input"><?php echo date('Y-m',time()); ?></span><div class="timend"></div></div>
						</div>
						<div class="concurrence-right"></div>
					</div>
					<div class="concurrence-op">
						<div class="concurrence-left">并发数量：</div>
						<div class="concurrence-right">
							<ul>
								<li class="curr">50</li>
								<li>100</li>
								<li>200</li>
								<li>300</li>
								<li>500</li>
								<li>800</li>
								<li>1000</li>
								<li>2000</li>
								<div class="number-box">
									自定义
									<div class="input-number">
										<input class="form-textbox fl mr10"  name="spaceNumber"  type="number"  style="width: 80px;" />
										<button  class="ks-bt bt-pue" type="button" onClick="numberSb(this)">确定</button>
									</div>
								
							</div>
							</ul>
							<div class="concurrence-sign">用户超出并发数将无法进入教室</div>
						</div>
					</div>
					<div class="concurrence-op">
						<div class="concurrence-left">单价：</div>
						<div class="concurrence-right">￥<i class="c-Orange"><?php echo $price ?></i> 元/人/月</div>
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
						<div class="concurrence-right"><i class="price"><?php echo $price ?></i>元/人X<i class="data-number">50</i>并发X<i class="cound-type2">1</i>个月=<i class="c-Orange count-co vodface"></i> 元</div>
					</div>
					<div class="concurrence-btn form-footer">
						<button class="ks-bt bt-pue" id="pay-submit" onClick="de_reg()" type="button">立即支付</button>
						<input type="hidden" name="numb" class="number" value="50" />
						<input type="hidden" name="startime" class="time" value="<?php echo time(); ?>" />
						<input type="hidden" name="endtime" class="time" value="<?php echo time(); ?>" />
						<input type="hidden" name="day" class="time" value="1" />
						<p class="concurrence-sign mt10">注：并发数未网校购买的用于学员在直播间内上课或者看直播回放的最大人数，若网校学员已超预购的并发数，学员将无法进入直播间上课</p>
					</div>
				</div>
				<?php break;
					case 5: ?>
				<!--科汛微门户云直播(并发)end-->
				<!--科汛微门户云短信-->
				<div class="concurrence-sub mt60">
					<div class="concurrence-title">科汛微门户连麦币</div>
				
					<div class="concurrence-op">
						<div class="concurrence-left">购买数量：</div>
						<div class="concurrence-right">
							<ul class="fl">
								<li class="curr">500枚</li>
								<li>1000枚</li>
								<li>2000枚</li>
								<li>5000枚</li>
								<li>10000枚</li>
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
						<div class="concurrence-right">￥<i class="c-Orange"><?php echo  $price; ?></i> 元/枚</div>
					</div>
					<div class="concurrence-op">
						<div class="concurrence-left">数量:</div>
						<div class="concurrence-right"><i class="data-number">500</i>枚</div>
						<input type="hidden" name="numb" class="number" />
					</div>
						<div class="concurrence-op">
						<div class="concurrence-left">费用：</div>
						<div class="concurrence-right"><i class="c-Orange vodface"></i>元</div>
					</div>
				<div class="concurrence-btn form-footer">
						<button class="ks-bt bt-pue">立即支付</button>
						<p class="concurrence-sign mt10">注：并发数未网校购买的用于学员在直播间内上课或者看直播回放的最大人数，若网校学员已超预购的并发数，学员将无法进入直播间上课</p>
					</div>
				</div>
				
				
				
				<?php break;
					case 1:  ?>
				<!--科汛微门户云直播(并发)end-->
				<!--科汛微门户云短信-->
				<div class="concurrence-sub mt60">
					<div class="concurrence-title">科汛微门户云短信</div>
				
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
										<input class="form-textbox fl mr10"  name="spaceNumber"  type="number"  style="width: 80px;" />
										<button  class="ks-bt bt-pue" type="button" onClick="numberSb(this)">确定</button>
									</div>
								
							</div>
							
						</div>
					</div>
					<div class="concurrence-op">
						<div class="concurrence-left">单价：</div>
						<div class="concurrence-right">￥<i class="c-Orange"><?php echo $price ?></i> 元/千条</div>
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
				<div class="concurrence-btn form-footer">
						<button class="ks-bt bt-pue">立即支付</button>
						<p class="concurrence-sign mt10">注：并发数未网校购买的用于学员在直播间内上课或者看直播回放的最大人数，若网校学员已超预购的并发数，学员将无法进入直播间上课</p>
					</div>
				</div>
				<?php break;
					case 4: ?>
				<!--科汛微门户云短信-->
				<!--科汛微门户云点播(流量)-->
				<div class="concurrence-sub mt60">
					<div class="concurrence-title">科汛微门户云点播(流量)</div>
				
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
						<div class="concurrence-right">￥<i class="c-Orange"><?php echo $price ?></i> 元/G</div>
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
				
				<div class="concurrence-btn form-footer">
						<button class="ks-bt bt-pue">立即支付</button>
						<p class="concurrence-sign mt10">注：并发数未网校购买的用于学员在直播间内上课或者看直播回放的最大人数，若网校学员已超预购的并发数，学员将无法进入直播间上课</p>
					</div>
				
				
				
				</div>
				<?php break;
					case 2: ?>
			<!--科汛微门户云点播(流量)-->
				<!--科汛微门户云点播(流量)-->
				<div class="concurrence-sub mt60">
					<div class="concurrence-title">科汛微门户云邮箱</div>
				
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
						<div class="concurrence-right">￥<i class="c-Orange"><?php echo $price ?></i> 元/千封</div>
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
				
				 <div class="concurrence-btn form-footer">
						<button class="ks-bt bt-pue">立即支付</button>
						<p class="concurrence-sign mt10">注：并发数未网校购买的用于学员在直播间内上课或者看直播回放的最大人数，若网校学员已超预购的并发数，学员将无法进入直播间上课</p>
					</div>
				
				</div>
				<?php break;
					case 3: ?>
			<!--科汛微门户云点播(流量)-->
						<!--科汛微门户云点播(流量)-->
				<!--科汛微门户云点播(流量)-->
				<div class="concurrence-sub mt60">
					<div class="concurrence-title">云点播(空间扩容)</div>
				
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
						<div class="concurrence-right">￥<i class="c-Orange"><?php echo $price ?></i> 元/G/天</div>
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
				
				 <div class="concurrence-btn form-footer">
						<button class="ks-bt bt-pue" type="button" onClick="de_reg(type)">立即支付</button>
						<input type="hidden" name="startime" class="time" value="<?php echo time(); ?>" />
						<input type="hidden" name="endtime" class="time" value="<?php echo $Expire; ?>" />
						<p class="concurrence-sign mt10"></p>
					</div>
				
				</div>
				
				<?php break;} ?>
				</form>
			<!--科汛微门户云点播(流量)-->
			</div>
		</div>
	</div>
		<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
		<script src="<?php echo UOOT;?>Public/common/js/layer/laydate.js"></script>
		<script>
		
			var  _startFlag = true;
			var  _endFlag =true;
			var serviceType =<?php echo $serviceType ?>;
			var day = <?php echo $day ?>;
			var price = <?php if($serviceType==1||$serviceType==2){echo $price/1000 ;}else{echo $price;} ?>;
			var dataNumber =parseInt($('.concurrence-right .curr').text());
			var Concurrent = 0;

			
			
			
			
			 $('.number').val(dataNumber);
			    if(serviceType ==1 || serviceType==2 ){
			    	 $('.number').val(parseInt(dataNumber/1000));
			    }
			
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
			function numberSb(target){
				
				var spaceNumber = parseInt($('input[name="spaceNumber"]').val());
				console.log(spaceNumber,serviceType)
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
			
			//阻止向上冒泡
			function cancelBubble(){
			  var e = window.event || arguments[0];
			  if ( e && e.stopPropagation ) {   
			      e.stopPropagation();
			  } else {
			      window.event.cancelBubble = true;
			  }
			
			
			}
			
			//获取某一个年某一月的第一天的时间戳
			function firstDay(new_year,new_month){
				var date = new Date(new_year,new_month,1);
				return date.valueOf();
			}
			
			
			
			//时间框
			function selectTime (target){
				
				
				//判断前者有没有时间选择框 有的话 关闭前者
				$this = $(target);
				var _type = $this.attr('data-flag');
				if(_type=="start"){
					if(_startFlag){
					var sumorder = ['一月','二月','三月','四月','五月','六月','七月','八月','九月','十月','十一月','十二月'];
					var timeContent='';
					var nowTime = new Date();
					var nowMouth =nowTime.getMonth()+1;
					var nowYear =  nowTime.getFullYear();
					
					
					timeContent += '<div class="select-box" >';
					timeContent += '<div class="select-year"><i class="icon-weibiaoti40 fl iconfont prev-click" style="cursor:pointer;display:none" data-click="prev" onclick="changeYear(this)" ></i><span id="year">'+nowYear+'</span><i class="icon-weibiaoti40 fr iconfont" style="cursor:pointer" data-click="next" onclick="changeYear(this)"></i></div>';
					timeContent += '<div class="select-month"><ul>';
					//var len     = ;
					for(var i=0;i<sumorder.length;i++){
						timeContent += '<li onclick="checkedMonth(this)"  data-month="'+(i+1)+'">'+sumorder[i]+'</li>';
					}
					timeContent += '</ul></div>';
					timeContent += '</div>';
				
					$('.startime').html(timeContent);
					_startFlag= false;
					
					
				}
					
					
				} else {
					
					if(_endFlag){
					var sumorder = ['一月','二月','三月','四月','五月','六月','七月','八月','九月','十月','十一月','十二月'];
					var timeContent='';
					var nowTime = new Date();
					var nowYear =  nowTime.getFullYear();
					timeContent += '<div class="select-box">';
					timeContent += '<div class="select-year"><i class="icon-weibiaoti40 fl iconfont prev-click" style="cursor:pointer;display:none" data-click="prev" onclick="changeYear(this)" ></i><span id="year">'+nowYear+'</span><i class="icon-weibiaoti40 fr iconfont" style="cursor:pointer" data-click="next" onclick="changeYear(this)"></i></div>';
					timeContent += '<div class="select-month"><ul>';
					//var len     = ;
					for(var i=0;i<sumorder.length;i++){
						timeContent += '<li onclick="checkedMonth(this)"  data-month="'+(i+1)+'">'+sumorder[i]+'</li>';
					}
					timeContent += '</ul></div>';
					timeContent += '</div>';
				
					$('.timend').html(timeContent);
					_endFlag= false;
					
				}
				}
				
				
				
				
			}
			//左右切换年份
			function changeYear(target){
			
				var $this = $(target);
				var type = $this.attr('data-click');
				var YearNum = Number($this.parent().find('span').html());
				var nowTime = new Date();
				
				var nowYear =  nowTime.getFullYear();
				if(type=="next"){
					YearNum++;
					if($this.parent().find('.prev-click').css("display")=="none"){
						$('.prev-click').show();
					}
				}else if(type=="prev"){
					YearNum--;
					
					if(nowYear==YearNum){
						$('.prev-click').hide();
					}
				}
				$this.parent().find('span').html(YearNum)
				
			}
		
			function checkedMonth(target){
					
				cancelBubble()	
				var $this = $(target);
				$this.addClass('active').siblings().removeClass('active');
				var uploadYear = Number($this.parents('.select-box').find('span').html());
				var nowTime = new Date();
				var nowMouth =nowTime.getMonth()+1;
				var stamp = <?php echo time(); ?>;
				var endTime = <?php echo time(); ?>;
				//如果初始时间一样的话 
				var uploadMonth  = $this.attr('data-month');
				//请求
				
				var yearVal  =  $this.parents('.select-box').find('#year').html();
				var mouthVal =  $this.attr('data-month');	
			    var _type  =$this.parents('.new-form').attr('data-flag');
			  	var uploadMonth  = $this.attr('data-month');
					console.log(uploadMonth)
					if(uploadMonth<nowMouth){
						Alert('请选择正确时间');
							 $("#pay-submit").attr('disabled','false');
							return false;
				    	
					}
			   
			   
				if(_type =='start'){
					
				  	$this.parents('.new-form').find('.start-input').html(yearVal+'-'+mouthVal);
				  	stamp = firstDay(uploadYear,uploadMonth);
					stamp =Number(stamp)/1000;
					_startFlag =true;
					
				}
				else{
					$this.parents('.new-form').find('.end-input').html(yearVal+'-'+mouthVal);
					var endTime = firstDay(uploadYear,uploadMonth);
					endTime =Number(endTime)/1000
					_endFlag =true;
					//差值
					if(stamp!=0&&endTime!=0){
						
							var startNumber =$('.start-input').html().split('-');//开始时间
							var endNumber =$('.end-input').html().split('-');//开始时间
							var startmouth=Number(startNumber[1]);
							var endmouth=Number(endNumber[1]) ;
							var starYear =Number(startNumber[0]);//开始年份
							var endYear =Number(endNumber[0]);//结束年份
						    var misting = (endmouth-startmouth);//差值
						    var misYear = endYear-starYear;//判断年份差值
						    
						    var 
						   	day=misting;
						   	/*
						   	 * 1.如果年份相等 时间不能选择往后的
						   	 * 2.跨年份时间 后面大于前面
						   	 * 3.跨年分时间  后面等于前面
						   	 * 4.跨年分时间 后面小于前面
						   	 * 5.跨n年份的话 后面小于前面
						   	 * 6.跨年份的话  计算跨了几年
						   	 * 7.选择月份不能小于当前月份 
						   	 * 
						   	 */
						    
						    if(starYear==endYear&&misting<0){
						    	$("#pay-submit").attr('disabled',true);
						    	Alert('请选择正确时间');
						    	return false;
						    
						    }else if(starYear==endYear&&misting==0){
						    	
						    	misting = 1;
						    }else if(starYear==endYear&&misting>0){
						    	
						    	
						    }else if(starYear<endYear&&misYear==1){
						    		//后面大于前面 存在跨年情况 且只跨了一年
						    		misting = misting+12
						    }else if(starYear<endYear&&misYear>1){
						    	   //后面大于前面 存在跨年情况 跨了不止一年
						    	    misting = misting+12*misYear
						    }
						    $("#pay-submit").attr('disabled',false);
						    //赋值并发时间
						 	$this.parents('.concurrence-sub').find('.cound-type2').html(misting);
						
						  vodfaceprice2=price*misting*dataNumber; 
						  $('.vodface').html(vodfaceprice2)
						  $('input[name="startime"]').val(stamp);//初始时间
						  $('input[name="endtime"]').val(endTime);///结束时间
						  $('input[name="day"]').val(misting)//时差					
						  }
					
				}
				
					
					$this.parents('.new-form').find('.select-box').hide();
				}
				
				//科汛微门户 云直播
					

				
				//
				
		</script>
</body>
</html>
