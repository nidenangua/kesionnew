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
<link href="<?php echo UOOT;?>Public/app/css/course.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<style>
.ivon-down {position: relative;cursor: pointer;}
.select-dropdown {position: absolute;box-shadow: rgba(0, 0, 0, 0.2) 0px 1px 6px;background: #fff;padding: 10px 10px;z-index: 99;width: inherit;left: 0px;text-align: center;}
.ks-position {margin: 15px 0;}
.ks-position li{float:left; position:relative; width:80px;height:90px;color:#344c67;font-size:14px;text-align: center;padding-top: 71px;box-sizing: border-box;background-image: 	url('<?php echo UOOT;?>Public/app/images/classIcon/page-icon-list.png');background-repeat: no-repeat;list-style: none; cursor: pointer;}
.ks-position li + li{ margin-left:56px;}
.icon-sign1 {background-position: 15px 0;}
.icon-sign2 {background-position: -56px 0;}
.icon-sign3 {background-position: -588px 0;}
.icon-sign4 {background-position: -137px 2px;}
.icon-sign5 {background-position: -213px 0;}
.icon-sign6 {background-position: -287px 0;}
.icon-sign7 {background-position: -361px 0;}
.icon-sign8 {background-position: -442px 0;}
.icon-sign9 { background-position: -518px 0;}
</style>
</head>
<body class="ks-wrap">  

	<div class="ks-wbox bRadius10">
	    <!--header-->
	    <div class="ks-head-box">
	     		<h3 class="ks-head-title">办理中心
	     			<div class="fr">	
						<a class="ks-setting-icon fl ml10" target="_blank"  href="<?php echo MY_FULLDOMAIN;?>/home/help#anchor59"><i class="iconfont icon-qm" ></i></a>											
					</div>
	     		</h3>
	     </div>
	     <!--header-->
	     
		
		<!--widget-->
		<div class="ks-head-widget clearfix">
			<div class="fl">
				<div class="ks-search-box">
					<form target="hidframe" class="fr">
				  	    <select class=" inputText bRadius5 mr10 fl" style="width: 100px;" id="keytype">
						     <option value="1" <?php if($keytype==1){echo 'selected';}?>>学员姓名</option>
						     <option value="3" <?php if($keytype==3){echo 'selected';}?>>班级或课程名</option>
						     <option value="2" <?php if($keytype==2){echo 'selected';}?>>订单号</option>
				  	    </select>     
						<div class="fl ks-top-search">

							<input type="text" class="sc-text" name="searchText" id="keyword" value="<?php if(isset($keyword)) echo $keyword; ?>">
			            	<button type="submit" class="ks-head-search"  onclick="searchByClass('<?php echo GP('');?>','<?php echo M_URL($this->AppName.'/Index','index');?>',1)" ><i class="iconfont icon-sousuo"></i></button>
		            	</div>
					</form>
				</div>			
			</div>
								
						
			<div class="fr">
				<ul class="ks-head-choice">
					
					<li>
						<div class="ks-head-el">
							
							<a class="ks-heade-button ks-head-primary" href="<?php echo M_URL($this->AppName.'/Index','addEnrol','',GP('appid-34'));?>"><i class="iconfont icon-jiahao"></i>办理报名</button></a>
		
						</div>
					</li>
				</ul>
		
			</div>
						

		
		</div>
		<!--/widget-->
	
	    <form target="hidframe"  action="<?php  echo M_URL($this->AppName.'/Index','forgivesome','',GP('p-'.$page->now_page)) ?>" method="post" id="myform" class=" bRadius10 ">
		
			
			<div class="ks-count mb20" >
				<span class="gTitle fsize16 ml10">当前结果：总计<i class="c-red"><?php echo $page->totalput;?></i>条记录，应收款项总计：<i class="c-red"><?php echo empty($ordercount['market_price'])?'0.00':$ordercount['market_price'];?></i>元</span>丨
				<span class="gTitle fsize16 ml10">实收总计：<i class="c-red"><?php echo empty($ordercount['price'])?'0.00':$ordercount['price'];?></i>元</span>
				<!--丨<span class="gTitle fsize16 ml10">学员账户变动总计：<i class="c-red">0.00</i>元</span>丨
				<span class="gTitle fsize16 ml10">欠费总计：<i class="c-red">0.00</i>元</span>丨
				<span class="gTitle fsize16 ml10">积分总计：<i class="c-red">0.00</i>分</span>-->
			</div>
			<table class="ks-table">
				<thead>
					<tr>
						<th>报名时间</th>
						<th style="text-align: left;">学员</th>
		            	<th>订单号</th>
		                <th>班级/课程</th>  
		                <th style="text-align: left;">报名班级/课程</th>  
		                <th>课程金额</th>  
		                <th>实付金额</th> 
		                <th>支付方式</th>  
		                <th>订单支付状态</th>
		                <th>到款状态</th>
		                <!--<th>操作</th>-->
					</tr>
				</thead>
				<tbody>
					<?php foreach($values as $k=>$v){?>
					<tr>
						<td><?php echo date('Y-m-d',$v['adddate']);?></td>
						<td style="text-align: left;"><?php echo Field($v['name']);?></td>
	  		          	<td class="ks-head-intro"><?php echo Field($v['ordersn']);?></td>
	  		          	<td><?php if($v['type']==0){?>课程<?php }elseif($v['type']==1){?>班级<?php }elseif($v['type']==2){?>充值<?php }?></td>
	  		          	<td class="ks-head-intro2 " style="text-align: left;"><?php echo Field($v['title']);?></td>
	  		          	<td>￥<?php echo Field($v['market_price']);?></td>
	  		          	<td>￥<?php echo Field($v['price']);?></td>
	  		          	<td><?php if($v['paytype']==0){?>线下支付<?php }elseif($v['paytype']==1){?>支付宝支付<?php }elseif($v['paytype']==2){?>微信支付<?php }?></td>
	  		          	<td><?php if($v['paystatus']==0){?>未支付<?php }elseif($v['paystatus']==1){?>已支付<?php }?></td>
						<td><?php if($v['paystatus']==0){?><img src="<?php echo UOOT;?>Public/app/images/redexclamatmark.png"><?php }elseif($v['paystatus']==1){?><img src="<?php echo UOOT;?>Public/app/images/classIcon/page-icon.png"><?php }?></td>	
						<!--<td>
		            	  	<div class="ivon-down">
		            	  		<span>操作 <i class="icon-jiantou1 iconfont ivon-down"></i></span>
		            	  		<ul class="select-dropdown" style="display: none;"> 
		            	  			<li><a class="c-86A8F mr10" href="">取消确认</a></li>
		            	  			<li><a class="c-86A8F mr10" href="">编辑</a></li>
		            	  			<li><a class="c-86A8F mr10" href="">打印</a></li>
		            	  			<li><a class="c-86A8F mr10" href="">日志</a></li>
			            	   	</ul>
		            	  	</div>
        	            </td>-->
					</tr>
					<?php }?>
				</tbody>
			</table>
			<?php echo NoC($values);?>
			  <?php if(!empty($values)){?>
				<div class="ks-bom clearfix" >
					<div class="fr"><?php echo $page->show(3); ?></div>
				
				</div>
			<?php }?>
	</form>
</div>

	


<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>
<script>
	module.require(['$','backstage','nicescroll'],function(){
		loadScorllJs();
		
		
	});
	
		
	
</script>
</body>
</html>
