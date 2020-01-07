<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit">
<title>学员订单</title>
<link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/form.css?m2k61hsgf2j2sq21i" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />

<style type="text/css">
	.pt{
		color:#e5412c;
		display: inline-block;
		border: #e5412c 1px solid; 
		padding-left: 5px;
		padding-right: 5px;
		border-radius: 5px;
		line-height: 22px;
	}
	.pts {
		line-height: 22px;
		margin-right:5px;
	}
	.ks-table th, .ks-table td {
		max-width: 300px;
	}
</style>
</head>
<body class="ks-wrap"> 
	       <!--end-->
		   <form target="hidframe"  action="<?php echo M_URL($this->AppName.'/Index','batch','',GP(''));  ?>" method="post" id="myform">
		   	
		   	<div class="ks-wbox bRadius10">
		   		 <!--header-->
				 <div class="ks-head-box">
				 		<h3 class="ks-head-title2">订单管理
						<div class="fr">	
						<a class="ks-setting-icon fl ml10" target="_blank"  href="https://www.kesion.com/store_help_guanli/47492"><i class="iconfont icon-qm" ></i></a>											
						</div>		
						<div class="fr" style="margin-top: 6px;"><span class="ml20">网校总销售&nbsp<span class="ks-cf07b40"><?php echo number_format(getWxinfo($this->wxid,'icomemoney'),2);?>元</span></span></div>
						</h3>
				 </div>
				 <!--header-->
				 <!--tab-->
				<div class="ks-head-tab">
					<ul class="clearfix">
						<li class="curr"><a href="<?php echo M_URL($this->AppName.'/Index','','',GP('appid-4')); ?>">学员订单</a></li>
						<!-- <li><a href="<?php echo M_URL($this->AppName.'/Index','orderGroup','',GP('appid-4')); ?>">拼团订单</a></li> -->
						<li ><a href="<?php echo M_URL('Capital','paylog');?>">学员消费记录</a></li>
                       
					</ul>
				</div>

			    <!--/tab-->
		   		<!--widget-->
					<div class="ks-head-widget clearfix">
						<div class="col-8">
							 <form target="hidframe">
							 <div class="ks-search-box">
							 	<select class="w150 inputText bRadius5 fl" id="keytype">
						            <option value="1" <?php if($keytype==1){echo 'selected="selected"';} ?>>订单号</option>
									<option value="2" <?php if($keytype==2){echo 'selected="selected"';} ?>>购买者</option>
								 </select>
							
								<div class="ks-top-search fl" >
								
									<input type="text" class="sc-text" name="searchText" id="keyword"  value="<?php if(isset($keyword)) echo $keyword; ?>">
									<button class="ks-head-search" onClick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL($this->AppName.'/Index','index'); ?>','<?php echo URL_MODEL;?>')"><i class="iconfont icon-sousuo"></i></button>
								</div>  
							
							</div> 
							</form>
						</div>
						
						<div class="col-4" style="float: right;">
							<div class="fr">
								<ul class="ks-head-choice">
									<li>
										<div class="ks-head-el">
											<div class="ks-head-input ks-head-el  ks-head-click w180" onclick="choiceClick(this)"><?php if($option==1){echo '本月';} elseif($option==2){echo '上月';}elseif($option==3){echo '本季度';}elseif($option==4){echo '上季度';}?><span class="ks-head-search"><i class="icon-taitouxiangxiajiantou iconfont"></i></span></div>
											<div class="ks-head-content ks-head-content-pr w100">	
												<ul class="status">															
													<li><a<?php if($option==1)echo ' class="choice-active"';?> href="<?php echo M_URL($this->AppName.'/Index','index','',GP("option-1,appid-$this->appid",true)); ?>">本月</a></li>
									       			<li><a<?php if($option==2)echo ' class="choice-active"';?> href="<?php echo M_URL($this->AppName.'/Index','index','',GP("option-2,appid-$this->appid",true)); ?>">上月</a></li>
									       			<li><a<?php if($option==3)echo ' class="choice-active"';?> href="<?php echo M_URL($this->AppName.'/Index','index','',GP("option-3,appid-$this->appid",true)); ?>">本季度</a></li>
									       			<li><a<?php if($option==4)echo ' class="choice-active"';?> href="<?php echo M_URL($this->AppName.'/Index','index','',GP("option-4,appid-$this->appid",true)); ?>">上季度</a></li>
												</ul>
											</div>
									</li>

									<li>
										<div class="ks-head-el">
											<button class="ks-heade-button ks-head-primary" type="button" onclick="choiceClick(this)"><i class="icon-filter-2 iconfont "></i></button>
											<div class="ks-head-content ks-head-content-pr" style="width: 320px;">
												<ul class="screen">
													<li>
														<span>支付状态：</span>
															<div>
																<!--<a href="//ks.zuojy.com/home.html/class/Index/index?appid-30,status-3" class="choice-active">不限</a>-->
																<a href="<?php echo M_URL($this->AppName.'/Index','index','',GP("paystatus-3,appid-$this->appid")); ?>" <?php if($paystatus==3)echo 'class="choice-active"';?>>不限</a>
																<a href="<?php echo  M_URL($this->AppName.'/Index','index','',GP("paystatus-1,appid-$this->appid")); ?>" <?php if($paystatus==1)echo 'class="choice-active"';?>>已支付</a>
																<a href="<?php echo M_URL($this->AppName.'/Index','index','',GP("paystatus-2,appid-$this->appid")); ?>" <?php if($paystatus==2)echo 'class="choice-active"';?>>待支付</a>
                                                                <a href="<?php echo  M_URL($this->AppName.'/Index','index','',GP("paystatus-4,appid-$this->appid")); ?>" <?php if($paystatus==4)echo 'class="choice-active"';?>>待发货</a>
                                                                <a href="<?php echo M_URL($this->AppName.'/Index','index','',GP("paystatus-5,appid-$this->appid")); ?>" <?php if($paystatus==5)echo 'class="choice-active"';?>>待收货</a>
                                                                <a href="<?php echo  M_URL($this->AppName.'/Index','index','',GP("paystatus-6,appid-$this->appid")); ?>" <?php if($paystatus==6)echo 'class="choice-active"';?>>已收货</a>
															</div>
													</li>
                                                    <li>
                                                        <span>订购类型：</span>
                                                        <div>
                                                            <!--<a href="//ks.zuojy.com/home.html/class/Index/index?appid-30,status-3" class="choice-active">不限</a>-->
                                                            <a href="<?php echo M_URL($this->AppName.'/Index','index','',GP("ordertype-3,appid-$this->appid")); ?>" <?php if($ordertype==3)echo 'class="choice-active"';?>>不限</a>
                                                            <a href="<?php echo  M_URL($this->AppName.'/Index','index','',GP("ordertype-1,appid-$this->appid")); ?>" <?php if($ordertype==1)echo 'class="choice-active"';?>>课程</a>
                                                            <a href="<?php echo M_URL($this->AppName.'/Index','index','',GP("ordertype-2,appid-$this->appid")); ?>" <?php if($ordertype==2)echo 'class="choice-active"';?>>教辅周边</a>
                                                        </div>
                                                    </li>
													<li>
														<span>独立收款：</span>
														<div>
															<a href="<?php echo M_URL($this->AppName.'/Index','index','',GP("ispaytoplat-3,appid-$this->appid")); ?>" <?php if($ispaytoplat==3)echo 'class="choice-active"';?>>不限</a>
															<a href="<?php echo M_URL($this->AppName.'/Index','index','',GP("ispaytoplat-1,appid-$this->appid")); ?>" <?php if($ispaytoplat==1)echo 'class="choice-active"';?>>是</a>
															<a href="<?php echo M_URL($this->AppName.'/Index','index','',GP("ispaytoplat-2,appid-$this->appid")); ?>" <?php if($ispaytoplat==2)echo 'class="choice-active"';?>>否</a>
														</div>
													</li>
												</ul>
											</div>
										</div>
									</li>
						<li><a class="ks-heade-button ks-head-primary" href="javascript:;" onmousedown="return checkpower({'version':'<?php echo checkIsVipModule($this->wxid,4,false,true);?>'})"  onclick="addTypeChange('<?php echo M_URL($this->AppName.'/Index','orderOpen','',GP(''));?>','930px','450px',{title:'开通学习订单',type:'top'});"><i class="iconfont icon-jiahao"></i>开通订单</a>	</li>
								</ul>
							</div>
						</div>
					</div>
				<!--/widget-->
		   		<!--table-->
		   			<table width="100%"  cellpadding="0" cellspacing="0" border="0" class="ks-table" >
			            <thead>
			                <tr>
			                	<th>选择</th>
			                    <th>订单号</th>
			                    <th style="text-align: left;">购买者</th>
			                    <th>订购类型</th>
			                    <th style="text-align: left;">订单内容</th>
			                    <th>订单金额</th> 
			                    <th>支付金额</th> 
								<th>服务费</th>
								<th>实际到账</th>
								<th>支付方式</th>
			                    <th>购买时间</th>
			                    <th>支付状态</th>
			                    <th>操作</th>
			                </tr>
			            </thead>
			            <tbody>
			              <?php foreach($OrderAll as $k=>$v){?> 
			            <tr>
			            	  <td style="width:30px ;">
			            	  	<?php if($v['paystatus']==0){?>
		        					<input type="checkbox" class="select-checks " name="orderid[]" value="<?php echo $v['orderid'];?>">
		        				<?php }else{ ?>
									<input type="checkbox" class="select-checks" disabled>
								<?php }?>
			            	  </td>
			            	  <td><?php echo Field($v['ordersn']);?></td>
			            	  <td style="text-align: left;"><?php echo User_GetUserName($v['userid']);?>

                              <?php if(!empty($v['help'])){ ?> <span class="pt">助</span><?php } ?>
                             <?php if($v['gift']=="2"){ ?> <span class="pt" title="领取人：<?php echo $v['memberid']>0?User_GetUserName($v['memberid']):'未领取'?>">赠</span><?php } ?>
                            </td>
			            	  <td><?php echo getStoreOrderType($v['type']); ?></td>
			            	  <td style="text-align: left;">
                              <?php echo $v['title'];?>
                              <?php if(!empty($v['groupid'])){ ?> <span class="pt">拼</span><?php } ?>
                              </td>
                                <td><?php echo $v['original_amount']; ?></td>
                                <td><?php echo $v['order_amount']; ?></td>
				                <td>￥<?php echo Field($v['poundage']);?>元</td>
				                <td>￥<?php echo Field($v['actual_amount']);?>元</td>
                                <td><?php if ($v['ispaytoplat']==1){echo '微信&nbsp;<span class="pt">独</span>';}else{if($v['paytype']==0){echo '线下支付';}elseif($v['paytype']==1){echo '支付宝';}elseif($v['paytype']==2){echo '微信';}elseif($v['paytype']==3){echo '小程序';}} ?></td>
                                <td><?php echo date('Y-m-d H:i:s',$v['adddate']); ?></td>
				                
				                <td><?php if ($v['type']==14 || $v['type']==15){
                                        if($v['orderstatus']==0&&$v['paystatus']!=0){echo '<span style="color:gold;">待发货</span>';}elseif($v['orderstatus']==1){ echo '<span style="color:dodgerblue;">待收货</span>';}elseif($v['orderstatus']==2){ echo '<span style="color:green;">已收货</span>';}else{echo '<span style="color:red;">未支付</span>';}
                                    }else{
                                        if($v['paystatus']==0){echo '<span style="color:red;">未支付</span>';}else{ echo '<span style="color:green;">已支付</span>';}
                                    } ?></td>
				               
			            	    <td class="ks-head-el">
								 	<i onclick="choiceClick(this)" class="iconfont icon-more"></i>
									<div class="ks-head-content ks-head-content-pc w100">
										<ul class="opeart">
                                            <?php
                                                if (($v['type']==14 || $v['type']==15) &&$v['orderstatus']==0&&$v['paystatus']!=0){
                                                    ?><li>
                                                    <a href="javascript:;" onclick="addTypeChange('<?php echo M_URL($this->AppName.'/Index','showordersend','',GP('orderid-'.$v['orderid']));?>','550px','400px',{title:'发货',type:'top'});">发货</a>
                                                    </li><?php
                                                }elseif (($v['type']==14 || $v['type']==15) &&($v['orderstatus']==1 || $v['orderstatus']==2)){
                                                    ?><li>
                                                    <a href="javascript:;" onclick="addTypeChange('<?php echo M_URL($this->AppName.'/Index','showAddress','',GP('orderid-'.$v['orderid']));?>','600px','400px',{title:'查看物流',type:'top'});">查看物流</a>
                                                    </li><?php
                                                }elseif (($v['type']==14 || $v['type']==15) &&$v['paystatus']==0){
                                                    ?><li>
                                                    <a href="javascript:;" onclick="addTypeChange('<?php echo M_URL($this->AppName.'/Index','orderdetail',$v['orderid'],GP(''));?>','930px','450px',{title:'查看详情',type:'top'});">
                                                        修改价格
                                                    </a>
                                                    </li><?php
                                                }
                                            ?>
											<?php if($v['paystatus']==0){?>
											<li>
												<a href="javascript:;" onclick="addTypeChange('<?php echo M_URL($this->AppName.'/Index','showorderconfirm','',GP('orderid-'.$v['orderid']));?>','410px','280px',{title:'确认支付',type:'top'});">确认支付</a>
											</li>
											<?php } ?>	
											<li>
												<a href="javascript:;" onclick="addTypeChange('<?php echo M_URL($this->AppName.'/Index','orderdetail',$v['orderid'],GP(''));?>','930px','450px',{title:'查看详情',type:'top'});">
												查看详情
											</a>
											</li>
											<?php if($v['paystatus']==0){?>
											<li >
												<a href="javascript:Confirm('是否删除此订单？该操作不可逆!','<?php echo M_URL($this->AppName.'/Index','delorder',$v['orderid'],GP(''));?>');">删除
												</a>
												<?php  }?>
											</li>
											<?php if($v['paystatus']==3 && !empty($v['groupid'])){?>
											<li >
												<a href="javascript:Confirm('是否退款此订单？该操作不可逆!退款请和学员协商好！','<?php echo M_URL($this->AppName.'/Index','tkorder',$v['orderid'],GP(''));?>');">退款
												</a>
												<?php  }?>
											</li>
										</ul>
									</div>
								</td>
			            </tr>
						<?php }?>
			            </tbody>
			        </table>
		   		<!--/table-->
		      <?php echo NoC($OrderAll);?>
		    	<input type="hidden" name="batch" id="batch1" />
            	
		     
			</form>
			
			   <?php if(!empty($OrderAll)){?>
			<div class="ks-bom clearfix">
				<div class="fl">
				<label class="mr20 fl"><input type="checkbox" class="select-checks selectAll">全选</label>
				<button class="ks-heade-button mr10" type="button" onclick="submitform(1);" name="batch" value="1"><i class="iconfont icon-shanchu1"></i></button>
				</div>
				<span style="line-height: 37px;padding-left: 15px;font-size: 10px;"><span class="pt pts">独</span>表示已配置独立收款资金直达机构收款账号，不可再次提现&nbsp;&nbsp;&nbsp;<span class="pt pts">助</span>表示好友助力订单
				<div class="fr"><?php echo $page->show(3); ?></div>
			</div>
			<?php }?>
		</div>

	
	<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>
<script>
	
	module.require(['$','backstage','nicescroll'],function(){
		
		loadScorllJs()
		
	})
	

function updatesStatus(id){
  var url = '<?php echo UOOT;?>Plus/Kesion.ajax.php?act=question';      
  $.ajax({
			type:"get",
			url:url,
			data:{id:id},
			success:function(data,textStatus){
				$("#a"+id).html(data);
			},
			error:function(){
				alert("发生了错误,请检查!");
			}
   })
}
function submitform(type){
	$('#batch1').val(type);
	$('#myform').submit();
}	
   function confirmpop(res) {
		var res = res.split('|');

		var contentHtml ='<div style="text-align:center;padding:20px;font-size:16px">微信号：'+res[0]+'手机号:'+res[1]+'</div>'+
						 '<div class="app-footer clearfix"><div style="text-align:center"><div class="ks-bt bt-pue mr10" onclick=top.closePopup("all") style="float:none;display:inline-block">确定</div>'+
						 '</div></div>'	

			top.popup.open(false,{
			title:'个人信息',
			area:['440px','400px'],
			heightAuto:true,
			content:contentHtml
		});
}

</script>
</body>
</html>