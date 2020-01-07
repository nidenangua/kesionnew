<!DOCTYPE html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit">
<link rel="shortcut icon" href="favicon.ico">
<link href="<?php echo UOOT;?>Public/admin/css/kesion-common.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/admin/css/html5.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/admin/css/general.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/admin/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/page.animate.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/admin/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
</head>
<style type="text/css">
	.gy{background: #F8F8F8;}
	.sc-button{position: relative;top: -3px;}
	.timelevel a{
	    padding: 9px;
	    border: 1px solid lightgray;
	    background-color: lightgray;
	    border-radius: 5px;
	}
	#orderdata span{
		margin-left:20px ;
	}
	#act{
		background-color: #FF5507;
		border: 1px solid #FF5507;
		color: white;
	}
</style>
<body class="gray-bg">
<div class="wrapper" style="margin-top:35px">
<form target="hidframe"  method="post" target="hidframe"  action="<?php echo UOOT;?>admin.php/Setting/updateBase" class="form-horizontal" enctype="multipart/form-data">
<div class="row">
<div id="manage_top" class="menu_top_fixed  p15 height73" >
    <div class="ibox-title">
        <h3 class="fl">&nbsp;&nbsp;平台流水
		    <a href="<?php echo M_URL('Paylog'); ?>" class="mr20" >消费明细</a> 
		    <a href="<?php echo M_URL('Order'); ?>" class="mr20 act">订单管理</a>  
		</h3>
        <div id="orderdata" style="    float: left;">
        	<span>订单总数：<i class="c-red"><?php echo $ordercount;?></i></span><span>已支付:<i class="c-red"><?php echo $paycount;?></i></span><span>未支付：<i class="c-red"><?php echo $nopaycount;?></i></span><span>已支付总金额：<i class="c-red"><?php echo $summoney;?></i></span>
        </div>
        <div class="fr">
             <div class="fl ks-top-search">
			<!--搜索-->
			
					
			<select class="inputText bRadius5 fl" id="keytype" style="width: 150px;">
			    <option  value="1" <?php if($keytype==1){echo 'selected="selected"';} ?>>订单号</option>
				<option  value="2" <?php if($keytype==2){echo 'selected="selected"';} ?>>用户名</option>
				<option  value="3" <?php if($keytype==3){echo 'selected="selected"';} ?>>网校id</option>
				<option  value="4" <?php if($keytype==4){echo 'selected="selected"';} ?>>网校名称</option>
	  	    </select>
			   
			<form target="hidframe" class="fr">
				<input type="text" class="sc-text" style="width:150px" name="searchText" id="keyword" value="<?php if(isset($keyword)) echo $keyword; ?>">
            <input type="button" class="sc-button" onClick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL('Order',''); ?>','<?php echo URL_MODEL;?>');" name="searchBtn" value="搜索">
			</form>
						
			<!--搜索-->
			</div> 
              
              
        </div>
    </div>
</div>


</div>

<div id="ksBoxContent">
	<div style="padding: 20px 0px;">
		
	<div class="H5-gameListScreen">
		<ul class="H5-gameOpt clearfix"> 
			<!--<li style="margin-right: 15px;"><input  class="selectAll select-checks" name="check1" type="checkbox"></li>-->
			<!--<li>转换率<i class="iconfont icon-sort-double-down"></i></li>-->
			<li>
				<div class="shaixuan clearfix">
					
				</div> 
			</li>
			<li class="timelevel">
				<a  href="<?php echo M_URL('Order','index','',GP("option-5")); ?>" id="<?php if($option ==5){ echo 'act';}?>">全部</a>
				<a  href="<?php echo M_URL('Order','','',GP("option-1,numb-0")); ?>" id="<?php if($option ==1&&$num==0){ echo 'act';}?>">本周</a>
				<a href="<?php echo M_URL('Order','','',GP("option-1,numb-1")); ?>" id="<?php if($option ==1&&$num==1){ echo 'act';}?>">上周</a>
				<a href="<?php echo M_URL('Order','','',GP("option-2,numb-0")); ?>" id="<?php if($option ==2&&$num==0){ echo 'act';}?>">本月</a>
				<a href="<?php echo M_URL('Order','','',GP("option-2,numb-1")); ?>" id="<?php if($option ==2&&$num==1){ echo 'act';}?>">上月</a>
				<a href="<?php echo M_URL('Order','','',GP("option-3,numb-0")); ?>" id="<?php if($option ==3&&$num==0){ echo 'act';}?>">本季度</a>
				<a href="<?php echo M_URL('Order','','',GP("option-3,numb-1")); ?>" id="<?php if($option ==4&&$num==1){ echo 'act';}?>">上季度</a>
			</li>
			<li class="fr gameScreen"><i class="iconfont icon-filter-2" style="float: none;"></i>&nbsp;&nbsp;筛选

				<ul class="H5-gameScreen">
					<img src="//ks.kesion.com/Public/app/images/regup.png" alt="">
					<li>
						<span>订单状态：</span>
						<div>
							<a href="<?php echo M_URL('Order','','',GP("paystatus-3")); ?>" class="<?php if($status ==3){ echo 'active';}?>">不限</a>
							<a href="<?php echo M_URL('Order','','',GP("paystatus-1")); ?>" class="<?php if($status ==1){ echo 'active';}?>">已购买</a>
							<a href="<?php echo M_URL('Order','','',GP("paystatus-0")); ?>" class="<?php if($status ==0){ echo 'active';}?>">待付款</a>
							<!--<a href="<?php echo M_URL('Order','','',GP("status-0")); ?>" class="<?php if($status ==0){ echo 'active';}?>">待评价</a>-->
						</div>
					</li>
					<li>
						<span>购买类型：</span>
						<div>
							<a href="<?php echo M_URL('Order','','',GP("type-6")); ?>" class="<?php if($stype ==6){ echo 'active';}?>">不限</a>
							<a href="<?php echo M_URL('Order','','',GP("type-0")); ?>" class="<?php if($stype ==0){ echo 'active';}?>">应用</a>
							<a href="<?php echo M_URL('Order','','',GP("type-1")); ?>" class="<?php if($stype ==1){ echo 'active';}?>">套餐</a>
							<a href="<?php echo M_URL('Order','','',GP("type-2")); ?>" class="<?php if($stype ==2){ echo 'active';}?>">服务</a>
							<a href="<?php echo M_URL('Order','','',GP("type-3")); ?>" class="<?php if($stype ==3){ echo 'active';}?>">模板</a>
							<a href="<?php echo M_URL('Order','','',GP("type-4")); ?>" class="<?php if($stype ==4){ echo 'active';}?>">充值</a>
							<a href="<?php echo M_URL('Order','','',GP("type-5")); ?>" class="<?php if($stype ==5){ echo 'active';}?>">H5</a>
						</div>
					</li>
				</ul>

			</li>				
		</ul>	
	</div>
	

	<div class="H5-gameListConts school-online">
		<div class="Created-push" id="ksBoxContent" style="padding:15px;">
		<table class="ks-table" id="tables">
			<tr style="background: #EEEEEE;">
				<!--<th><input type="checkbox" class="select-checks" /></th>-->
				<th>网校ID</th>
				<th>网校名称</th>
				<th>订单ID</th>
				<th>订单号</th>
				<th>用户名</th>
				<th>订单金额</th>
				<th>订单原价</th>
				<th>抵扣</th>
				<th>状态</th>
				<th>订单类型</th> 
				<th class="shaixuan">
					<?php if($byname == 'a.adddate asc'){?>
						<a class="desc" href="<?php echo M_URL('Order','','',GP("byname-a.adddate desc")); ?>" style="float: none;"><i class="desc-i" style="top: -1px;"></i>下单日期</a>		
					<?php }else{ ?>
						<a class="desc" href="<?php echo M_URL('Order','','',GP("byname-a.adddate asc")); ?>" style="float: none;"><i class="asc-i" style="top: -1px;"></i>下单日期</a>
					<?php }?>
				</th> 
				<th>备注</th>
				<th>查看</th>
			</tr>
			<?php foreach($OrderAll as $k=>$v){ ?>		
			<tr <?php if($k%2==0){ echo 'class="gy"';} ?>>
				<!--<td><input type="checkbox" class="select-checks" /></td>-->
				<td><?php echo $v['wxid']; ?></td>
				<td><?php echo $v['sitename']; ?></td>
				<td><?php echo $v['orderid']; ?></td>
				<td><?php echo $v['ordersn']; ?></td>
				<td><?php echo $v['username']; ?></td>
				<td><?php echo $v['order_amount']; ?></td>
				<td><?php echo $v['original_amount']; ?></td>
				<td><?php echo $v['taskreward']; ?></td>
				<td><?php if($v['paystatus']==0){echo '<span style="color:red;">未完成</span>';}else{ echo '<span style="color:green;">已支付</span>';} ?></td>
				<td>
					<?php 
						if($v['type']==0){
							echo '购买应用';
						}elseif($v['type']==1){ 
							echo '购买套餐';
						}elseif($v['type']==2){ 
							echo '购买服务';
						}elseif($v['type']==3){ 
							echo '购买模版';
						}elseif($v['type']==4){ 
							echo '用户充值';
						}elseif($v['type']==5){ 
							echo '购买营销';
						}  
					?>
				</td>
				<td><?php echo date('Y-m-d H:i:s',$v['adddate']); ?></td>
				<td><?php echo Field($v['mark']); ?></td>
				<td><span style="cursor: pointer; color: #476dbe;" onClick="addTypeChange('<?php echo M_URL('Order','Orderdetail','',GP("orderid-".$v['orderid'])) ?>','930px','450px',{title:'查看详情',type:'top'});
">查看详细信息</span></td>			
			</tr>	
			<?php } ?>
		</table>	
		<?php echo Noc($OrderAll); ?>
		</div>
		
	</div>
	
	
	<div>
		
		
		
	</div>
	</div>
	
</div>


<div class="footer-page " style="height:60px;">
    <div class="col-sm-5 mt7 labs">
     <form action="<?php echo  M_URL('Order','flowexcel','',GP('')); ?>" method="post">
		<input type="submit" class="sc-button btn  btn-default fl mt7" style="margin-right:10px;margin-top: 7px;" name="outexcel" value="导出Excel" />
		<label>
			<input type="radio" id="ratiotime" name="outtime" value="1" onClick="$('#timebox').hide()"/>本页</span>
		</label>
		<label>
			<input type="radio" id="ratiotime" name="outtime" value="2" onClick="$('#timebox').hide()"/>本月</span>
		</label>
		<label>
			<input type="radio" id="ratiotime" name="outtime" value="3" onClick="$('#timebox').hide()"/>本年</label>
		<label>
			<input type="radio" id="ratiotime" name="outtime" value="4" onClick="$('#timebox').show()"/>自定义
		</label>
		<span style="display: none;" id="timebox">
			<input id="start" type="text" value="" name="startime" required readonly class="laydate-icon">
				-
			<input id="end" type="text" value=""name="endtime" required readonly class="laydate-icon">
		</span> 
 
	</form>
    </div>
	<div class="col-sm-7 mt7"> <?php echo $page->show(3); ?></div>
</div>
</body>

</html>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>