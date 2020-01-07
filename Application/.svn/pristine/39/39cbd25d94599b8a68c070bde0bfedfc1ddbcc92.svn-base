<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit">
<title>kesion教育平台</title>
<meta name="Keywords" content="kesion教育平台"/>
<meta name="Description" content="kesion教育平台" />
<link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>
</head>
<body class="ks-wrap">
<form target="hidframe"  action="<?php echo M_URL($this->AppName.'/Index','paybatch','',GP("p-$page->now_page"));  ?>" method="post" id="myform">
	<div  class="ks-wbox bRadius10">
		<!--header-->
		<div class="ks-head-box clearfix">
			<h3 class="ks-head-title2 ">结算中心
				<div class="fr">	
				<a class="ks-setting-icon fl ml10" target="_blank"  href="<?php echo MY_FULLDOMAIN;?>/home/help#anchor115"><i class="iconfont icon-qm" ></i></a>											
				</div>
				<div class="fr" style="margin-top: 5px;">
				<span class="ml20">未入账金额&nbsp<span class="ks-cf07b40"><?php echo number_format(getWxPay($this->wxid),2);?>元</span></span>
				<span class="ml20">可提现金额&nbsp<span class="ks-cf07b40"><?php echo number_format(getWxinfo($this->wxid,'withdrawmoney')-getWxPay($this->wxid),2);?>元</span></span>
				<span class="ml20">待打款金额&nbsp<span class="ks-cf07b40"><?php echo number_format($summoney,2);?>元</span></span>
				</div>
			</h3>  
		</div>
	<!--header-->
	<!--tab-->
     	<div class="ks-head-tab">
 			<ul class="clearfix">
 				 <li <?php if($option==1)echo 'class="curr"';?>><a href="<?php echo M_URL('Capital','withdrawbill','',GP("option-1",true)); ?>">本月</a></li>
			      <li <?php if($option==2)echo 'class="curr"';?>><a href="<?php echo M_URL('Capital','withdrawbill','',GP("option-2",true)); ?>">上月</a></li>
			      <li <?php if($option==3)echo 'class="curr"';?>><a href="<?php echo M_URL('Capital','withdrawbill','',GP("option-3",true)); ?>">本季度</a></li>
			      <li <?php if($option==4)echo 'class="curr"';?>><a href="<?php echo M_URL('Capital','withdrawbill','',GP("option-4",true)); ?>">上季度</a></li>
 			</ul>
     	</div>
    <!--/tab-->		
	<!--widget-->
	<div class="ks-head-widget clearfix">
		<div class="col-4" style="float: right;">
			<div class="fr">
				<ul class="ks-head-choice">
					<li>
					<div class="ks-head-el">
						<button class="ks-heade-button ks-head-primary" type="button" onclick="choiceClick(this)"><i class="icon-filter-2 iconfont "></i></button>
							<div class="ks-head-content ks-head-content-pr w300">
							<ul class="screen">
								<li>
									<span>提现状态：</span>
									<div>
										<a href="<?php echo M_URL('Capital','withdrawbill','',GP("status-3")); ?>" <?php if($status==3)echo 'class="choice-active"';?>>不限</a>
										<a href="<?php echo M_URL('Capital','withdrawbill','',GP("status-0")); ?>" <?php if($status==0)echo 'class="choice-active"';?>>已申请</a>
										<a href="<?php echo M_URL('Capital','withdrawbill','',GP("status-1")); ?>" <?php if($status==1)echo 'class="choice-active"';?>>已结算</a>
									</div>
								</li>
							</ul>
						</div>
					</div>
					</li>
					<li>
						<div class="ks-head-el">
                            <a class="ks-heade-button ks-head-primary"
                                <?php $realModel = M('common_realname'); $real = $realModel->getRow(' where wxid =  '.$this->wxid.' limit 1');
                                      if(!empty($real)&&$real['status']==1){?>
                                href="javascript:;" onclick="top.KTJ_FrameRouteJump('<?php echo M_URL('Capital','withdrawapply');?>')"
                                <?php }elseif(!empty($real)&&$real['status']==0){?>
                                onclick="checkpower({msg:'实名认证正在审核，请耐心等待',buttons:'前往查看',url:'<?php echo M_URL('User','realName');?>'});"
                                <?php }else{?>
                                onclick="checkpower({msg:'您还未进行实名认证，立即前往认证',buttons:'前往认证',url:'<?php echo M_URL('User','realName');?>'});"
                                <?php }?>>
                                <i class="icon-jiahao iconfont "></i>提现
                            </a>
						</div>
					</li>
					<li>
						<div class="ks-head-el">
                            <a class="ks-heade-button ks-head-primary" href="javascript:top.KTJ_RouteJump('/receipt')"> 收款设置</a>
						</div>
					</li>
				</ul>
			</div>
		</div>
	</div>
	<!--/widget-->
  	<table width="100%" cellpadding="0" cellspacing="0" border="0" class="ks-table" >
	    <thead>
	            <tr>
	            <th>用户名</th>
	            <th>手机号</th>
	            <th>提现时间</th>
	            <th>操作IP</th>
	            <th>提现金额（元）</th>
	            <th>提现手续费（元）</th>
	            <th>实际到账（元）</th>
	            <!-- <th>剩余提现余额（元）</th>-->
	            <th>摘要</th>
	            <th>提现方式</th>
	            <th>提现账号</th>
	            <th>提现姓名</th>
	            <th>备注</th> 
	            <!-- <th>操作</th>-->
	        </tr>
	    </thead>
	    <tbody>
		<?php foreach($values as $k=>$v){?> 
	    <tr>
	        <td><?php echo Field($v['username']);?></td>
	        <td><?php echo Field($v['mobile']);?></td>
	        <td><?php echo Field(date('Y-m-d H:i:s',$v['adddate']));?></td>
	        <td><?php echo Field($v['userip']);?></td>
	        <td><?php echo Field($v['cmoney']); ?></td>
	        <td><?php echo Field($v['poundage']); ?></td>
	        <td><?php echo Field($v['actualmoney']);?>
	        <!-- <td><?php echo Field($v['balance']);?></td>-->
	        <td style="color: <?php if($v['status']==0){echo 'red';}else{echo 'green';}; ?>">
	        <?php if($v['status']==0){echo '已申请';}else{echo '已结算';}; ?></td>
	        <td><?php  if($v['paytype']==0){ echo '银行卡';}elseif($v['paytype']==1){ echo '支付宝';}elseif($v['paytype']==2){ echo '微信支付';}?></td>
			<td><?php echo Field($v['banknum']);?></td>
			<td><?php echo Field($v['name']);?></td>
	        <td style="text-align: left;"><?php echo Field($v['mark']);?></td>
	    </tr>
<?php }?>
	    </tbody>
</table>

        <?php echo NoC($values);?>
          <?php if(!empty($values)){?>	
        <div class="ks-bom clearfix">
		<div class="fr"><?php echo $page->show(3); ?></div>
		</div>	
		<?php }?>
	</div>
</form>
<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>
<script>
	module.require(['$','backstage','nicescroll'],function(){
		loadScorllJs()
	})
</script>
</body>
</html>