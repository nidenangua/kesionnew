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
<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
</head>

<body class="ks-wrap">
	<div class="ks-wbox bRadius10">
		<!--header-->
		     <div class="ks-head-box">  
		     		<h3 class="ks-head-title2">分销管理
	     				<div class="fr">
						    <a class="ks-setting-icon fl ml10" target="_blank"  href="<?php echo MY_FULLDOMAIN;?>/home/help#anchor66"><i class="iconfont icon-qm" ></i></a>
					    </div>
					    
					    <div class="fr" style="margin-top: 6px;"><span class="ml20">佣金&nbsp<span class="ks-cf07b40"><?php echo $othermoney;?>元</span></span></div>
					    <div class="fr" style="margin-top: 6px;"><span class="ml20">总销售额&nbsp<span class="ks-cf07b40"><?php echo $allcmoney;?>元</span></span></div> 
		     		</h3>
		     </div>
		 <!--/header-->
		 <!--tab-->
		 <div class="ks-head-tab">
 			<ul class="clearfix">
 				<li class="fl <?php if(ACTION=='index'){ echo 'curr';} ?>">
      				<a href="<?php echo M_URL('Distribution','index','',GP('',true)); ?>" class="alignCenter">分销管理</a>
   			    </li>
   			    <li class="fl <?php if(ACTION=='distributioner'){ echo 'curr';} ?>">
      				<a href="<?php echo M_URL('Distribution','distributioner',''); ?>" class="alignCenter">分销订单</a>
   			    </li>
   			</ul>
 		</div>
		<!--/tab-->
		 <!--widget-->
					<div class="ks-head-widget clearfix">
						<div class="fl">
							<div class="ks-search-box">
								<select class="w150 inputText bRadius5 fl" id="keytype" >
									<option <?php if($keytype==1){ echo 'selected="selected"';} ?> value="1">分销员</option>
									<option <?php if($keytype==2){ echo 'selected="selected"';} ?> value="2">标题</option>
								</select>
								<div class="ks-top-search fl">
									<form target="hidframe">
									<input type="text" class="sc-text sc-mini-pc" name="searchText" id="keyword"  value="<?php if(isset($keyword)) echo $keyword; ?>">
					                <button type="submit" class="ks-head-search" onClick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL('Distribution','distributioner'); ?>','<?php echo URL_MODEL;?>')"><i class="iconfont icon-sousuo"></i></button>  
					               </form>
								</div>
								<!--搜索框组件-->
							</div>	
						</div>
						<div class="fl ks-head-tbox">
							<input type="text" id="selectTime" autocomplete="off" class="ks-head-input sc-mini-pc ks-head-time w300 ml20" placeholder="<?php if(empty($start)) echo '自定义时间段' ?>"/>
							<span class="ks-head-ticon"><i class="iconfont icon-date"></i></span>
						</div>
						<div class="fr" >
							<ul class="ks-head-choice">
									<li>
										<div class="ks-head-el">
											<div class="ks-head-input ks-head-el  ks-head-click w180" onclick="choiceClick(this)"><?php if($option==1){echo '本月';} elseif($option==2){echo '上月';}elseif($option==3){echo '本季度';}elseif($option==4){echo '上季度';}elseif($option==5){echo '自定义';}?><span class="ks-head-search"><i class="icon-taitouxiangxiajiantou iconfont"></i></span></div>
											<div class="ks-head-content ks-head-content-pr w100">	
												<ul class="status">															
													<li><a<?php if($option==1)echo ' class="choice-active"';?> href="<?php echo M_URL('Distribution','distributioner','',GP("option-1",true)); ?>">本月</a></li>
									       			<li><a<?php if($option==2)echo ' class="choice-active"';?> href="<?php echo M_URL('Distribution','distributioner','',GP("option-2",true)); ?>">上月</a></li>
									       			<li><a<?php if($option==3)echo ' class="choice-active"';?> href="<?php echo M_URL('Distribution','distributioner','',GP("option-3",true)); ?>">本季度</a></li>
									       			<li><a<?php if($option==4)echo ' class="choice-active"';?> href="<?php echo M_URL('Distribution','distributioner','',GP("option-4",true)); ?>">上季度</a></li>
												</ul>
											</div>
									</li>
							</ul>
						</div>
					</div>
					<!--/widget-->	
<!--end-->
<!--结束-->
<form target="hidframe"  action="<?php  echo M_URL('Distribution','','',GP('')) ?>" method="post" id="myform" >
			    <!--table-->
				<table class="ks-table" >
					<thead>
						<tr>
						<!--<th>选择</th>-->
						<th>订单号</th>
						<th >课程名称</th>
						<th>学员名称</th>
						<th>分销员</th>
						<th>购买时间</th>
						<th>实际支付</th>
						<th>佣金</th>
						<th>支付状态</th>

						<!-- <th>操作</th> -->
						</tr>
					</thead>
					<tbody>
						<?php foreach($values as $k=>$v){?> 
						    <tr>
							<!--<td style="width:30px"><input type="checkbox" class="select-checks " name="id[]" value="<?php if($courseType==5){echo $v['classid'];}else{echo $v['courseid'];}?>"></td>-->
							<td><?php echo  $v['ordersn']?></td>
							<td ><?php echo $v['title'] ?></td>
							<td ><?php echo User_GetUserName($v['memberid']) ?></td>
							<td ><?php echo User_GetUser($v['distribute_userid'])['name']; ?></td>
							<td><?php echo date('Y-m-d H:i:s',$v['adddate']);?></td>
							<td><?php echo number_format($v['actual_amount'],2); ?></td>
							<td><?php echo number_format($v['distribute_amount'],2);?></td>
							<td><?php if($v['paystatus']==0){echo '未支付';}else{echo '已支付';} ?></td>
						</tr>
						<?php }?>
					</tbody>
				</table>
		   <?php echo NoC($values);?>
			<input type="hidden" name="batch" id="batch1" />
	 </form>
		
		<!--footer-->
		<?php if(!empty($values)){?>
			<div class="ks-bom clearfix">
				<div class="fl">
				    <!--<label class="mr20 fl"><input type="checkbox" class="select-checks selectAll" >全选</label>-->
					<!--<button type="button"  class="ks-heade-button mr10"  onclick="submitform(1)" ><i class="iconfont icon-shanchu1"></i></button>-->
				</div>
				<div class="fr">
					<?php echo $page->show(3); ?>
				</div>
			</div>
		<!-- /footer-->
		  <?php }?>
	</div>
<!--//ks-wbox-->
<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>
<script>
	module.require(['$','backstage','nicescroll','laydate'],function(){
		var start = '<?php if($option==5){echo $start;} ?>';
		var end   = '<?php if($option==5){echo $end;} ?>';
		if(start && end){
			document.getElementById('selectTime').value = start.match(/[^\s]+/) +' - '+ end.match(/[^\s]+/)
		};
		/*time*/
		laydate.render({
		  elem: '#selectTime',
		  format:'yyyy/MM/dd',
		  range: true,
		  done:function(value){
		  	var href = "<?php echo M_URL('Distribution','distributioner','',GP('1-1'))?>".replace(/,option-\d+,starttime-\d+,endtime-\d+/g,'');
		  	if(value){
		  		value = value.split(' - ');
		  		var starttime = new Date(value[0]).getTime()/1000;
		  		var endtime = new Date(value[1]).getTime()/1000;
		  		location.href = href+',option-5,starttime-'+starttime+',endtime-'+endtime;
		  	}else{location.href = href;}
		  }
		});

	})
</script>
</body>
</html>


<!-- var conf  = {};
					conf.basicinfo = {};
					conf.appId = appId;
					conf.timestamp =timestamp ;
					conf.nonceStr = nonceStr;
					conf.signature =signature;
					conf.basicinfo.sharetitle = _this.goodsinfo.title;
					conf.basicinfo.shareintr = _this.goodsinfo.shareintr ||'点击查看';
					conf.basicinfo.defaultpic = _this.goodsinfo.sharepic;
					conf.url = shareurl+'&sharetype=1';
					onshare(conf);
					_this.renderFlag = true; -->