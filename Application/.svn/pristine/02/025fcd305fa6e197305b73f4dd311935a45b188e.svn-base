<!DOCTYPE html>
<html>
	<head lang="en">
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="renderer" content="webkit"> 
	<title>我的订单</title>
	<link href="<?php echo UOOT;?>Public/app/css/reset.css" rel="stylesheet">
	<link href="<?php echo UOOT;?>Public/app/css/form.css" rel="stylesheet">
	
	<link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/app/css/common.css" rel="stylesheet">
	<link href="<?php echo UOOT;?>Public/app/css/mystyle.css" rel="stylesheet">
	<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
	<style>
		.level-title th {width: auto;}
		.order-product {border: 1px solid #eee;}
		.order-count {border-bottom: 1px solid #eee; border-right: 1px solid #eee;padding: 10px;text-align: center;}
	</style>
</head>
<body class="ks-wrap">
	<div class="ks-wbox bRadius10">
	<!--header-->
    <div class="ks-head-box">
		<h3 class="ks-head-title2">我的订单</h3>
	</div>
	
    <!--header-->
	
	<!--tab-->
	
		<div class="ks-head-tab">
 			<ul class="clearfix">
 				<li><a href="<?php echo M_URL('Service','myapp'); ?>">我的应用</a> </li>
 				<li ><a href="<?php echo M_URL('Service','upgrade');?>">升级套餐</a></li>
				<li><a href="<?php echo M_URL('Shop','CapacityService'); ?>">扩容服务</a> </li>
				<li class="curr"><a href="<?php echo M_URL('Service','orderList'); ?>">我的订单</a> </li>
				<li><a href="<?php echo M_URL('Service','Cart'); ?>">我的购物车</a> </li>
 			</ul>
     	</div>
	
	
		<div class="ks-head-widget clearfix" >
			<div class="fr">
				<ul class="ks-head-choice">
					<li>
							<div class="ks-head-el">
								<div class="ks-head-input ks-head-el  ks-head-click w180" onClick="choiceClick(this)">
									<?php if($paystatus == 0){ ?>待付款
									<?php }else if($paystatus == 1){ ?>待评价
									<?php }else if($paystatus == 3){ ?>全部订单									
									<?php }?>
								<span class="ks-head-search"><i class="icon-taitouxiangxiajiantou iconfont"></i></span></div>
								<div class="ks-head-content ks-head-content-pr w100">	
								<ul class="status">															
										<li<?php if($paystatus==3) echo " class='curr'" ;?>><a href="<?php echo M_URL('Service','orderList','',GP('paystatus-3')); ?>">全部订单</a></li>
					     				<li<?php if($paystatus==0) echo " class='curr'" ;?>><a href="<?php echo M_URL('Service','orderList','',GP('paystatus-0')); ?>">待付款</a></li>
					     				<li<?php if($paystatus==1) echo " class='curr'" ;?>><a href="<?php echo M_URL('Service','orderList','',GP('paystatus-1')); ?>">待评价</a></li>
								</ul>
						</div>
					</li>
				
				</ul>
			</div>
		</div>

	
    
     <!--/tab-->

	
	

	<!--/widget-->
	<form action="<?php echo M_URL('Service','orderBatch');?>" method="post" id="myform">
     
	<!--table-->

            <table width="100%" cellpadding="0" cellspacing="0" style="overflow: hidden;margin-top:-12px">
                 <thead>
                     <tr style="height: 39px;font-size: 16px;">
                         <th>产品</th><th>小计</th><th>总金额</th><th>抵扣</th><th>订单状态</th><th style="width: 200px;">操作</th>
                     </tr>
                 </thead>
                 <?php foreach($pageorders as $k=>$v){ ?>
                 <tbody>
                     <tr class="level-content bg-eaf fsize14">
                        <td class="pl20 alignLife p10" nowrap>
                        <?php if($v['paystatus']==0){?><input type="checkbox" class="mr10 fl" value="<?php echo $v['orderid']; ?>" name='orderid[]'><?php }?>
                            <label><?php echo KS_DATE($v['adddate']); ?></label>
                            <span class="ml20 c-92"><label>订单号:<?php echo $v['ordersn']; ?></label></span>
                        </td>
                        <td class="order-count"></td>
                        <td class="order-count"></td>
                        <td class="order-count"></td>
                        <td class="order-count"></td>
                        <td class="alignRight">
                        <?php if($v['paystatus']==0){?>	
                        	<a href="javascript:void(0);" onClick="Confirm('是否删除此订单？该操作不可逆!','<?php echo M_URL('Service','delOrder',$v['orderid'],GP('p-'.$page->now_page));?>')" >
                        		<span class="r-icon posRe mr20 c-999"><em><i class="arrow-down"></i></em><i class="iconfont icon-shanchu1"></i></span>
                        	</a>
                        <?php }?>	
                        </td>
                     </tr>
<?php $order_apps = M('common_order_info');$pageapps = $order_apps->getAll("where orderid=$v[orderid] order by type asc");$applist = $this->cache->GetA('appinfo','appid',$v,'',true);foreach($pageapps as $kt=>$vt){ ?>
<?php if($v['type']==0){?><!--应用-->
<tr class="level-content">
     <td class="order-product w400" nowrap>
         <div class="taps-content ">
             <div class="taps-row">
                 <div class="taps-col-3 ">
                     <div class=""><img onerror="this.src='<?php echo nopic();?>'" src="<?php echo $vt['defaultpic']; ?>" style="vertical-align: middle"width="80" ></div>
                 </div>
                 <div class="taps-col-7 ">
                    <div style="display: inline-block; float:left; margin-left:20px; font-size:15px; color:black; text-align:left; ">
                        <div class="mp_5">应用----<?php echo $vt['appname']; ?></div>
                       <!-- <div class="info-text">网页[交易快照]</div>-->
                        <div class="info-text">规格：<?php echo intval($vt['numb']);if($this->cache->GetA('appinfo','appid',$vt['appid'],'appchargetype')==0){echo '月';}elseif($this->cache->GetA('appinfo','appid',$vt['appid'],'appchargetype')==1){echo '季';}elseif($this->cache->GetA('appinfo','appid',$vt['appid'],'appchargetype')==2){echo '年';} ?></div>
                    </div>
                 </div>
             </div>
             <div class="clear"></div>
         </div>
     </td>
     <td class="order-count fsize14" style="border-left:0;">￥<?php echo number_format($vt['price']*$vt['numb'],2); ?></td>
     <td class="order-count fsize14 <?php if($kt!=0){echo 'border-top';} ?>"><?php if($kt==0){echo number_format($v['order_amount'],2);} ?></td>
     <td class="order-count fsize14 <?php if($kt!=0){echo 'border-top';} ?>"><?php if($kt==0){echo number_format($v['taskreward'],2);} ?></td>
     <td class="order-count fsize14 <?php if($kt!=0){echo 'border-top';} ?>"><?php if($kt==0){if($v['paystatus']==0){echo '待付款';}else{if($v['paystatus']==1){echo '已付款';}} } ?></td>
     <td class="order-count <?php if($kt!=0){echo 'border-top';} ?>">
         <?php if($kt==0){if($v['paystatus']==0){?>
         <a href="<?php echo M_URL('Service','buyNow',$v['orderid'],GP("Pays-0")); ?>" class="ks-bt bt-pue fn">立即购买</a>
         <?php }elseif($v['paystatus']==1){?>
         <button type="button" class="ks-bt bt-def fn" onClick="skip('<?php echo M_URL('Service','buyNow',$v['orderid']); ?>')">再次购买</button>
         <?php }} ?>
     </td>
</tr>
<?php }elseif($v['type']==1){ ?><!--套餐-->
	
<tr class="level-content">
     <td class="order-product w400"  style="padding:0;">
         <div class="taps-col-7 " style="width: 100%;">
            <div style="display: inline-block; float:left; margin-left:20px; font-size:15px; color:black;text-align: center; ">
                <div class="mp_5 fl" ><?php echo $vt['appname']; ?></div>
                <!--<div class="info-text fl" style="margin-left: 10px;margin-top: 5px;">[交易快照]</div>-->
                <div class="info-text fl" style="margin-left: 10px;margin-top: 5px;">规格：<?php echo intval($vt['numb']);?></div>
            </div>
         </div>
     </td>
     <td class="order-count  order-product fsize14" style="border-left:0;">￥<?php echo number_format($vt['price'],2); ?></td>
     <td class="order-count fsize14 <?php if($kt!=0){echo 'border-top';} ?>"><?php if($kt==0){echo number_format($v['order_amount'],2);} ?></td>
     <td class="order-count fsize14 <?php if($kt!=0){echo 'border-top';} ?>"><?php if($kt==0){echo number_format($v['taskreward'],2);} ?></td>

     <td class="order-count fsize14 <?php if($kt!=0){echo 'border-top';} ?>"><?php if($kt==0){if($v['paystatus']==0){echo '<span style="color:red;">待付款<span>';}else{if($v['paystatus']==1){echo '<span style="color:green;">已付款<span>';}} } ?></td>
     <td class="order-count <?php if($kt!=0){echo 'border-top';} ?>">
         <?php if($kt==0){if($v['paystatus']==0){?>
         <a href="<?php echo M_URL('Website','buyNow','',GP('pays-0,orderid-'.$v['orderid'])); ?>" class="ks-bt bt-pue fn">立即付款</a>
         <?php }elseif($v['paystatus']==1){?>
         <!--<button type="button" class="ks-bt bt-def" onclick="skip('<?php echo M_URL('Website','buyNow','',GP('pays-1,orderid-'.$v['orderid'])); ?>')">再次购买</button>	-->
         <?php }} ?>
     </td> 
</tr>



<?php }elseif($v['type']==2){ ?><!--服务-->
<tr class="level-content">
     <td class="order-product w400" nowrap>
         <div class="taps-content ">
             <div class="taps-row">
                 <div class="taps-col-3 ">
                     <div class=""><img onerror="this.src='<?php echo nopic();?>'" src="<?php echo $vt['defaultpic']; ?>" style="vertical-align: middle"width="80" ></div>
                 </div>
                 <div class="taps-col-7 ">
                    <div style="display: inline-block; float:left; margin-left:20px; font-size:15px; color:black; text-align:left; ">
                        <div class="mp_5">服务----<?php echo $vt['appname']; ?></div>
                        <!--<div class="info-text">[交易快照]</div>-->
                        <div class="info-text">数量：
                        <?php
                        	$serviceinfo  = $this->cache->GetA('service','serviceid',$vt['appid'],'',true);
                        	switch($serviceinfo['seriesid']){
                        		case 14:echo ($vt['numb']*1000).'条';break;
							    case 15:echo ($vt['numb']*1000).'封';break;
							    case 40:echo $vt['numb'].'G';break;
							    case 12:echo $vt['numb'].'G';break;
							    case 11:echo $vt['numb'].'人';break;
							}
                        ?>
                        </div>
                        <?php switch($serviceinfo['seriesid']){
							    case 11:echo '<div class="info-text">购买时长：'.date('Y/m/d',$vt['starttime']).'~'.date('Y/m/d',$vt['endtime']).'</div>';break;
						} ?>
                    </div>
                 </div>
             </div>
             <div class="clear"></div>
         </div>
     </td>
     <td class="order-count fsize14" style="border-left:0;">￥<?php echo number_format($v['order_amount'],2); ?></td>
     <td class="order-count fsize14" style="border-left:0;">￥<?php echo number_format($v['order_amount'],2); ?></td>
     <td class="order-count fsize14 <?php if($kt!=0){echo 'border-top';} ?>"><?php if($kt==0){echo number_format($v['taskreward'],2);} ?></td>

     <td class="order-count fsize14 <?php if($kt!=0){echo 'border-top';} ?>"><?php if($kt==0){if($v['paystatus']==0){echo '<span style="color:red;">待付款<span>';}else{if($v['paystatus']==1){echo '<span style="color:green;">已付款<span>';}} } ?></td>
     <td class="order-count <?php if($kt!=0){echo 'border-top';} ?>">
         <?php if($kt==0){if($v['paystatus']==0){?>
         <a href="<?php echo M_URL('Shop','buyService','',GP('pays-0,orderid-'.$v['orderid'])); ?>" class="ks-bt bt-pue fn">立即购买</a>
         <?php }elseif($v['paystatus']==1){?>
         <button type="button" class="ks-bt bt-def fn" onClick="skip('<?php echo M_URL('Shop','coludmanage',$v['orderinfo']['appid'],GP('')); ?>')">再次购买</button>
         <?php }} ?>
     </td>
</tr>
<?php }elseif($v['type']==4){ ?><!--充值-->
<tr class="level-content">
     <td class="order-product w400" nowrap>
         <div class="taps-content ">
             <div class="taps-row">
                 <div class="taps-col-3 ">
                     <div class=""><img onerror="this.src='<?php echo nopic();?>'" src="<?php echo $vt['defaultpic']; ?>" style="vertical-align: middle"width="80" ></div>
                 </div>
                 <div class="taps-col-7 ">
                    <div style="display: inline-block; float:left; margin-left:20px; font-size:15px; color:black; text-align:left; ">
                        <div class="mp_5">充值----<?php echo $vt['appname']; ?></div>
                        <!--<div class="info-text">[交易快照]</div>-->
                    </div>
                 </div>
             </div>
             <div class="clear"></div>
         </div>
     </td>
     <td class="order-count fsize14" style="border-left:0;">￥<?php echo number_format($v['order_amount'],2); ?></td>
     <td class="order-count fsize14" style="border-left:0;">￥<?php echo number_format($v['order_amount'],2); ?></td>
     <td class="order-count fsize14 <?php if($kt!=0){echo 'border-top';} ?>"><?php if($kt==0){echo number_format($v['taskreward'],2);} ?></td>

     <td class="order-count fsize14 <?php if($kt!=0){echo 'border-top';} ?>"><?php if($kt==0){if($v['paystatus']==0){echo '<span style="color:red;">充值失败</span>';}else{if($v['paystatus']==1){echo '<span style="color:green;">充值成功</span>';}} } ?></td>
     <td class="order-count <?php if($kt!=0){echo 'border-top';} ?>">
         <?php if($kt==0){if($v['paystatus']==0){?>
         <a href="<?php echo M_URL('Capital','rechargemoney',$v['orderid'],GP("Pays-0")); ?>" target="_top" class="ks-bt fn bt-pue">立即充值</a>
         <?php }elseif($v['paystatus']==1){?>
         <button type="button" class="generalBtn0 bg-white c-666 fsize14 hLh35 w120" onClick="skip('<?php echo M_URL('Capital'); ?>')">再次充值</button>
         <?php }} ?>
     </td>
</tr>
<?php }?>

<?php } ?>
                     </tbody>
                 <?php } ?>
             </table>
             <?php echo NoC($pageorders);?>
	
		
      
    <!--/table-->
    
    <?php if(!empty($pageorders)){ ?>
	<!--footer-->
	<div class="ks-bom clearfix">
		<input type="hidden" name="batch" id="batch1" />

        <div class="fl">
		   <label class="mr20 fl"><input type="checkbox" class="selectAll select-checks">全选</label>
		   <button type="button" class="ks-heade-button mr10" onClick="submitform(1)"><i class="iconfont icon-shanchu1"></i></button>

            
        </div>
        <div class="fr"><?php echo $page->show(3); ?></div>
	</div>
	<!--/footer-->
	<?php } ?>
  </form>    
</div>


<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>
<script>
	
	module.require(['$','backstage','nicescroll'],function(){
		loadScorllJs()
		$('.r-icon').find('.iconfont').hover(function(){
			$(this).siblings('em').fadeIn(300)
		},function(){
			$(this).siblings('em').stop().fadeOut(300);
		});
		/*全选*/	
		$(".selectAll").click(function(){ 
		    if(this.checked){ 
		        $("input[name='orderid[]']").prop('checked', true)
		    }else{ 
		        $("input[name='orderid[]']").removeAttr("checked"); 
		    } 
		});
	});

	function submitform(type){
				
		inspectionCheckBox('orderid[]',function(){
			$('#batch1').val(type);
			if(type===1){
				top.popup.confirm('确认要删除所选项吗？',{
					determine:function(){
						$('#myform').submit();
					}
				})
			}else{
				$('#myform').submit();
			}
		})
		
	}


</script>
		

	


</body>
</html>