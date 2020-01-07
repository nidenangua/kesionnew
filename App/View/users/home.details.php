<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit">
<title>查看学员详情</title>
<link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />

<style>
	.ks-txtLeft h3{height: 20px;line-height: 20px;margin-bottom: 10px;}
	.ml50{margin-left: 50px!important;}
	.check-crb{padding: 30px;text-align: center;}
	.check-empty{text-align: center;font-size: 16px;color:#333;margin-bottom: 20px;}
	.check-icon {display: inline-block;width: 45px;height: 45px;border-radius: 50%;background: red;vertical-align: middle;text-align: center;line-height: 45px;margin-bottom: 10px;}
	.check-icon i{font-size: 24px;color: #fff;}
	.detail {position: relative;}
	.ks-view-tab {position: absolute;right: 0;top: -10px;}
	.switch i {padding-left: 0!important;}
	.icon-nv {font-size: 18px; color: #e74881;font-weight:bold;}
	.icon-nan {font-size: 18px;color: #1ca8ca;font-weight:bold;}
</style>
</head>
<body class="ks-wrap">



	

	<div class="bRadius10 bg-white ks-wbox">
		<div class="ks-head-nav ks-head-only-nav" style="margin-bottom: 20px;">
		<!--标题-->
		<a href="javascript:history.go(-1);">学员管理</a><span> <em>/</em> 学员详情
		<!--标题-->
	</div>
		<div class="ks-clist">
			<ul class="clearfix">
	    		<li>
	    			<div class="ks-cbox clearfix">
	    				<h3 class="ks-first">基本信息</h3>
	    				<div class="ks-cimg fl clearfix">
	    				
	    			   <img src="<?php echo $this->upload->getHead($userinfo['userid'],6,0);?>">
	    			</div>
	    			  <div class="ks-txtLbox">	
	    				<div class="fl ks-txtLeft">
	        				<p><?php echo Field($userinfo2['name']);?>
	        			<?php if($userinfo2['Sex']==1){?><i class="iconfont icon-nan"></i><?php }else{?><i class="iconfont icon-nv"></i><?php }?></p>
	        				<p>联系电话：<?php echo Field($userinfo['mobile']);?></p>
                            <p class="small-txt">
                                所在地区：<?php echo Field($userinfo2['taddress']);?>
                            </p>
	    				</div>
	    				<div class="ks-ctxt fl">
	    				<p style="height: 24.5px;"></p>
							<p>电子邮件：<?php echo Field($userinfo['email']);?></p>
	    					
	    				</div>
	    				<div class="ks-ctxt fl">
	    					<p style="height: 24.5px;"></p>
	    					<p>出生年月：<?php echo Field(date('Y-m-d',$userinfo2['birthday']));?></p>
	    				</div>
	    				<div class="ks-ctxt fl">
	    					<p style="height: 24.5px;"></p>
	    					<p>性别：<?php if($userinfo2['Sex']==1){?>男<?php }else{?>女<?php }?></p>
	    					<p class="small-txt"></p>
	    				</div>
	    			</div>
	    			</div>
	   		   </li>
			</ul>
		</div>
	</div>
	<div class="bRadius10 bg-white ks-wbox mt20" >
				<div class="ks-clist">
					<ul class="clearfix">
						<li>
		            	<div class="ks-cbox clearfix">
							<h3 class="ks-first">其他信息</h3>
									  <div class="ks-txtLbox">	
			        				<div class="fl ks-txtLeft">
				        				<p>报名状态：<?php if($userinfo2['enrollstatus']==1){?>已报名<?php }else{?>未报名<?php }?></p>
				        				<p>学员账号：<?php echo Field($userinfo['username']);?></p>
				        				<!--<p>最近登录时间：<?php echo date('Y-m-d H:i:s',$userinfo['lastlogintime']);?></p>-->
				        				
			        				</div>
			        				<div class="ks-ctxt fl">
			        					<p style="height: 24.5px;"><?php if($userinfo2['enrollstatus']==1){?>首次报名时间：<?php echo date('Y-m-d H:i:s',$userinfo2['enrolldate']);?><?php }else{?><?php }?></p>
										<!--<p>账户余额：￥<?php echo Field($userinfo['money']);?>&nbsp;&nbsp;<a href="javascript:void(0);" onclick="addTypeChange('<?php echo M_URL($this->AppName.'/Index','recharge',$id,GP('skip-1')); ?>','430px','610px ',{title:'学员充值',type:'top'})" style="color: red;">充值</a></p>-->
			        					<p>登录次数：<?php echo Field($userinfo['logintimes']);?></p>
			        					
			        				</div>
			        				<div class="ks-ctxt fl">
			        					<p style="height: 24.5px;"></p>
			        					<p>最近登录时间：<?php if (!empty($userinfo['lastlogintime'])){echo date('Y-m-d H:i:s',$userinfo['lastlogintime']);}else{echo '---';}?></p>
			        					<p>
								        	<!--<div class="fr">
												<span class="name-nowrap fl fsize14 hLh30 mr10">是否展示前台</span>
												<span class="fl">
												<div class="form-switch" open-value="1">
										<label for="isshow1"><input type="radio" value="0" onclick="Payswitch(0)" <?php  if(isset($userinfo2['isshow'])){if($userinfo2['isshow']==0) echo "checked";}?> >不用展示</label>
										<label for="isshow0"><input type="radio" value="1" onclick="Payswitch(1)"  <?php  if(isset($userinfo2['isshow'])){if($userinfo2['isshow']==1) echo "checked";}else{echo 'checked';}?> >前台展示</label>
												</div>
												</span>
											</div>-->
			        					</p>
			        					<p class="small-txt"></p>
			        				</div>
			        			</div>
						</div>
				        </li>
					</ul>
				</div>
	</div>

	<div class="bRadius10 bg-white ks-wbox mt20" >

		<div class="detail"> 	
              	<h3 class="ks-first mb10" style="margin-left: 0;">购课信息</h3>
              	<div class="fl ks-view-tab mt10" >
				<ul>  
					<li <?php if($type==3){echo 'class="curr"';}?>><a href="<?php echo M_URL($this->AppName.'/Index','details',$id,GP('type-3'));?>">全部</a></li>
					<li <?php if($type==1){echo 'class="curr"';}?>><a href="<?php echo M_URL($this->AppName.'/Index','details',$id,GP('type-1'));?>">直播</a> </li>
					<li <?php if($type==0){echo 'class="curr"';}?>><a href="<?php echo M_URL($this->AppName.'/Index','details',$id,GP('type-0'));?>">课程</a></li>
				
				</ul>
			</div>
            	<table width="100%" cellpadding="0" cellspacing="0" border="0" class="ks-table mt15">
	            <thead>
		            <tr>
		            	<th>报名时间</th>
		            	<th>订单号</th>
		                <th style="text-align: left;">课程名称</th>  
		                <th>学习进度</th>
		                <th>课程金额</th>
		                <th>实付金额</th> 
		                <th>支付方式</th>  
		                <th>订单支付状态</th>
		            </tr>
	            </thead>
	            <tbody>
	              <?php foreach($orders as $k=>$v){?>	
  		          <tr>
  		          	<td><?php echo date('Y-m-d',$v['adddate']);?></td>
  		          	<td><?php echo Field($v['ordersn']);?></td>
  		          	<td style="text-align:left"><?php echo Field($v['title']);?></td>
                    <td><?php echo $v['speed'];?></td>
  		          	<td>￥<?php echo Field($v['market_price']);?></td>
  		          	<td>￥<?php echo Field($v['price']);?></td>
  		          	<td><?php if($v['paytype']==0){echo '线下支付';}elseif($v['paytype']==1){echo '支付宝';}elseif($v['paytype']==2){echo '微信';}?></td>
  		          	<td><?php if($v['paystatus']==0){?>未支付<?php }elseif($v['paystatus']==1){?>已支付<?php }?></td>
  		          </tr>
  		          <?php }?>	
	            </tbody>
		        </table>
		        <?php echo NoC($orders);?>
		        <?php if(!empty($orders)){?>
		        <div class="ks-bom clearfix">
		        	<div class="fr">
			 			<?php echo $page->show(3); ?>
			 		</div>
				</div>
				 <?php }?>	
		 </div>  	
	</div>

	 	

<script src="<?php echo UOOT;?>/Public/common/js/module.js?<?php echo echoHash();?>"></script>

<script>
	module.require(['$','backstage','nicescroll'],function(){
		$('.ks-view-tab li').click(function(){
		    $(this).addClass('curr').siblings().removeClass('curr');
		});
		loadScorllJs()
	})	

	function Payswitch(usersstyle){
		
		var url = "<?php echo M_URL($this->AppName.'/Index','isshowswitch',$id,GP('')); ?>";
		$.ajax({
			type:"post",
			url:url,
			data:{'usersstyle':usersstyle},
			success:function(data){},
		    error:function(){
			    location.reload();
			}
		});
	}
</script>
</body>
</html>

