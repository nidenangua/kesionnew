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

</head>
<body class="ks-wrap">


<div class="ks-wbox bRadius10">
	<!--header-->
		<div class="ks-head-box clearfix">
			<h3 class="ks-head-title2">订单管理
			<div class="fr">	
				<a class="ks-setting-icon fl ml10" target="_blank"  href="<?php echo MY_FULLDOMAIN;?>/home/help#anchor69"><i class="iconfont icon-qm" ></i></a>											
			</div>		
			<div class="fr" style="margin-top: 6px;"><span class="ml20">网校总销售&nbsp<span class="ks-cf07b40"><?php echo number_format(getWxinfo($this->wxid,'icomemoney'),2);?>元</span></span></div>
			</h3>
		</div>
		
	<!--header-->
 	<!--tab-->
	<div class="ks-head-tab">
		<ul class="clearfix">
			<li><a href="<?php echo M_URL('order/Index','','',GP('appid-4')); ?>">学员订单</a></li>
			<li class="curr"><a href="<?php echo M_URL('Capital','paylog');?>">学员消费记录</a></li>
			
		</ul>
	</div>

    <!--/tab-->
	
	
	<!--widget-->
	<div class="ks-head-widget clearfix">
		<div class="col-8">
			<div class="ks-search-box">
			 <select class="w150 inputText bRadius5 fl" id="keytype">
		             <option value="1" <?php if($keytype==1){echo 'selected="selected"';} ?>>用户ID</option>
		             <option value="2" <?php if($keytype==2){echo 'selected="selected"';} ?>>用户名</option>
		             <option value="3" <?php if($keytype==3){echo 'selected="selected"';} ?>>手机号</option>
		             <option value="4" <?php if($keytype==4){echo 'selected="selected"';} ?>>操作IP</option>
			 </select>
			<div class="ks-top-search fl" >
                <form target="hidframe"  action="">
			    <input type="text" class="sc-text" name="searchText" id="keyword"  value="<?php if(isset($keyword)) echo $keyword; ?>"> 	
                 <button type="submit" class="ks-head-search" onClick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL('Capital','paylog'); ?>','<?php echo URL_MODEL;?>')"><i class="iconfont icon-sousuo"></i></button>
                </form>
			</div>  
			</div>  
		</div>
		
		<div class="col-4" style="float: right;">
			<div class="fr">
				<ul class="ks-head-choice">
					
					<li>
						<div class="ks-head-el">
							<div class="ks-head-input ks-head-el  ks-head-click w180" onclick="choiceClick(this)"><?php if($option==1){echo '本月';} elseif($option==2){echo '上月';}elseif($option==3){echo '本季度';}elseif($option==4){echo '上季度';}?><span class="ks-head-search"><i class="icon-taitouxiangxiajiantou iconfont"></i></span>
						
						</div>
						<div class="ks-head-content ks-head-content-pr w100">	
							<ul class="status">															
								 <li><a<?php if($option==1)echo ' class="choice-active"';?> href="<?php echo M_URL('Capital','paylog','',GP("option-1",true)); ?>">本月</a></li>
							      <li><a<?php if($option==2)echo ' class="choice-active"';?> href="<?php echo M_URL('Capital','paylog','',GP("option-2",true)); ?>">上月</a></li>
							      <li><a<?php if($option==3)echo ' class="choice-active"';?> href="<?php echo M_URL('Capital','paylog','',GP("option-3",true)); ?>'">本季度</a></li>
							      <li><a<?php if($option==4)echo ' class="choice-active"';?> href="<?php echo M_URL('Capital','paylog','',GP("option-4",true)); ?>">上季度</a></li>
							</ul>
						</div>
				</li>
					
					<li>
						<div class="ks-head-el">
							<button class="ks-heade-button ks-head-primary" type="button" onclick="choiceClick(this)"><i class="icon-filter-2 iconfont "></i></button>
								<div class="ks-head-content ks-head-content-pr w300">
								<ul class="screen">
									<li>
										<span>明细状态：</span>
										<div>
											<a href="<?php echo M_URL('Capital','paylog','',GP("type-0")); ?>" <?php if($type==0)echo 'class="choice-active"';?>>所有记录</a>
											<a href="<?php echo M_URL('Capital','paylog','',GP("type-1")); ?>" <?php if($type==1)echo 'class="choice-active"';?>>学员支出</a>
											<a href="<?php echo M_URL('Capital','paylog','',GP("type-2")); ?>" <?php if($type==2)echo 'class="choice-active"';?>>学员充值</a>
											
										</div>
									</li>
									
								</ul>
							</div>
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
			<th>操作时间</th>
			<th>状态</th>
			<th>金额</th>
			<th>用户ID</th>
			<th>用户昵称</th>
			<th>手机</th>
			<!--<th>学员账户余额</th>-->
			<th>IP</th>
			<th style="text-align: center;">备注</th>
		</tr>
		</thead>
		<tbody>
		<?php foreach($values as $k=>$v){if($v['type'] ==0){$status = '未审核';}else{$status = '已审核';}?>
			<tr>
				<td><?php echo Field(date('Y-m-d H:i:s',$v['adddate']));?></td>
				<td style="color: <?php if($v['type']==0){echo 'red';}else{echo 'green';}; ?>"><?php if($v['type']==0){echo '充值';}else{echo '支出';}; ?></td>
				<td class="c-86A8F"><?php if($v['type']!=0){echo '+';}?><?php echo Field($v['cmoney']);?></td>
				<td><?php echo Field($v['username']);?></td>
				<td><?php echo Field($v['name']);?></td>
				<td><?php echo Field($v['mobile']);?></td>
				<!--<td style="color: black;"><?php echo Field($v['balance']);?></td>-->
				<td><?php echo Field($v['memberip']);?></td>
				<td class="immigration" style="text-align: center;max-width: 300px;"><?php echo Field($v['mark']);?>></td>
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
	
<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>
<script>
	module.require(['$','backstage','nicescroll'],function(){
		loadScorllJs()
	})
</script>

</body>
</html>