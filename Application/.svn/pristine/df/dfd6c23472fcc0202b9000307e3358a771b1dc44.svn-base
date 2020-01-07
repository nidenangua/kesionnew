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
		 		<h3 class="ks-head-title2">任务中心
				<div class="fr">	
					<a class="ks-setting-icon fl ml10" target=""  href="<?php echo M_URL('Service','upgrade'); ?>" style="width: 97px;">去使用</a>									
				</div>		
				<div class="fr" style="margin-top: 6px;">
						可用的奖励总额：￥<?php echo $allye;?>
				</div>
				</h3>
		 </div>
	    <!--header-->
		<div class="ks-head-tab">
			<ul class="clearfix">
				<li <?php if(ACTION=='index'){echo 'class="curr"';}?>><a href="<?php echo M_URL('Taskhome','index'); ?>">我的任务</a></li>
				<li <?php if(ACTION=='reward'){echo 'class="curr"';}?>><a href="<?php echo M_URL('Taskhome','reward');?>">任务奖励</a></li>
						
			</ul>
		</div>			     
			  
		<!--widget-->
		<!--/widget-->
	     
		<!--table-->
		
			<table width="100%" cellpadding="0" cellspacing="0" border="0" class="ks-table" >
			            <thead>
			                <tr>
			                	<!--<th>选择</th>-->
			                    <!--<th>订单号</th>-->
			                    <th>id</th>
			                    <th style="text-align: left;">来源</th>
			                    <th>奖励金额</th> 
								<th>获得时间</th>
								<th>过期时间</th>
								<th>状态</th>
			                </tr>
			            </thead>
			            <tbody>
			              <?php foreach($taskVoucher as $k=>$v){?> 
			            <tr>
			            	  <td><?php echo Field($v['id']);?></td>
			            	  <td style="text-align: left;">完成任务：<?php echo Field($v['name']);?></td>
							  <td>￥<?php echo Field($v['money']);?>元</td>
			            	  <td><?php echo date('Y/m/d',$v['adddate']);?></td>
							  <td><?php echo date('Y/m/d',$v['effectivetime']);?></td>
							  <td><?php if($v['status']==1){echo '<span style="color:red;">已使用</span>';}elseif($v['status']==2){echo '<span style="color:blue;">已失效</span>';}else{echo '<span style="color:green;">可使用</span>';}?></td>
			            </tr>
						<?php }?>
			            </tbody>
			        </table>
		   		<!--/table-->
		      <?php echo NoC($taskVoucher);?>
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
