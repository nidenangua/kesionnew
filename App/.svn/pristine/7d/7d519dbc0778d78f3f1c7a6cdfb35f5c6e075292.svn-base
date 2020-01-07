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
<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />


</head>
<body class="ks-wrap">
	


	
        <!--<form target="hidframe"  action="<?php echo M_URL($this->AppName.'/Index','bathDelStudycard','',GP("p-$page->now_page"));?>" method="post" id="myform">-->
        <div class="bRadius10 ks-wbox">  
        	<!--header-->
			<div class="ks-head-box">
				<h3 class="ks-head-title">优惠券
					<div class="fr">	
								<a class="ks-setting-icon fl ml10" target="_blank"  href="<?php echo MY_FULLDOMAIN;?>/home/help#anchor67"><i class="iconfont icon-qm" ></i></a>											
					</div>		
				
				</h3>
			</div>
			<!--header-->
				<!--widget-->
	<div class="ks-head-widget clearfix">
		<div class="fl">
			<div class="ks-search-box">
			
                <form target="hidframe">

                    <div class="ks-top-search fl" style="position: relative;"></div>
                </form>
			</div>  
		
		</div>
		
	
			<div class="fr">
				<ul class="ks-head-choice">
					
					<li>
					<div class="ks-head-el">
						<button class="ks-heade-button ks-head-primary" type="button" onClick="choiceClick(this)"><i class="icon-filter-2 iconfont "></i></button>
						<div class="ks-head-content ks-head-content-pr w300" >
							<ul class="screen">
								<li>
									<span>类型：</span>
									<div>
										<a class="<?php if($stat==3) echo "active" ;?>" href="<?php echo M_URL($this->AppName.'/Index','index','',GP("stat-3,appid-$this->appid",true)); ?>">不限</a>
											<a class="<?php if($stat==0) echo "active" ;?>" href="<?php echo  M_URL($this->AppName.'/Index','index','',GP("stat-0,appid-$this->appid",true)); ?>">领取中</a>
											<a class="<?php if($stat==1) echo "active" ;?>" href="<?php echo M_URL($this->AppName.'/Index','index','',GP("stat-1,appid-$this->appid",true)); ?>">领完了</a>
											<a class="<?php if($stat==2) echo "active" ;?>" href="<?php echo M_URL($this->AppName.'/Index','index','',GP("stat-2,appid-$this->appid",true)); ?>">已过期</a>
										
									</div>
								</li>
								
							</ul>
						</div>
					</div>
					</li>
					<li>
					<div class="ks-head-el">
                        <a class="ks-heade-button ks-head-primary" href="<?php echo M_URL($this->AppName.'/Index','addVoucher','',GP("")); ?>" onClick="return checkpower({'version':'<?php echo checkIsVipModule($this->wxid,31,false,true);?>'})">
                            <i class="icon-jiahao iconfont "></i>发放优惠券
                        </a>
					</div>
					</li>
				</ul>
			</div>
	
	</div>
	<!--/widget-->
        	  
            <table width="100%" cellpadding="0" cellspacing="0" border="0"  class="ks-table">
	            <thead>
		            <tr >
		                <th >时间</th>
		                <th>优惠券种类</th>
		                <th>优惠券金额</th>
		                <th>使用条件</th>
		                <th>有效时间</th>
		                <th>发放方式</th>
		                <th>已领用数量</th>
		                <th>状态</th>
		                <th>推广</th>
		                <th>操作</th>
		            </tr>
	            </thead>
                <tbody>

                	<?php foreach($values as $k=>$v){?>
                	<tr>
	             		<td><?php echo KS_DATE($v['addtime']); ?></td>
	                   	<td><?php if($v['type'] == 0){ echo '网校通用优惠券';}else{ echo '指定商品优惠券';} ?></td>
	                   	<td>￥<?php echo $v['money'];?></td>	
	                   	<td class=""><?php if($v['term']==0){ echo '无限制';}else{ echo '满'.$v['term'].'元可以使用';} ?></td>	
	                   	<td><?php if($v['awarddate'] == 0){ echo '无限制';}else{ echo date('Y.m.d',$v['redemptionstarttime']).'-'.date('Y.m.d',$v['redemptionendtime']);} ?></td>	
	                   	<td><?php if($v['isuser'] == 1){ echo '用户领取';}else{echo '指定用户';} ?></td>
	                 	<td><font style="color:#2a75ed" onclick="window.location.href='<?php echo  M_URL($this->AppName.'/Index','vlist',$v['id'],GP('')); ?>'"><?php echo $v['counts']; ?></font>/<?php echo $v['number']; ?></td>
	                 	<td>
											<?php if($v['isuse'] == 0){
												if($v['counts']>= $v['number']){
													echo '<font style="color:#e5412c">已领完</font>';
												}else{
													echo '<font style="color:#2a75ed">领取中</font>';
												}
											}elseif($v['isuse'] == 2){
												echo '<font style="">已过期</font>';
											}elseif($v['isuse'] == 1){
												echo '<font style="#e5412c">已领完</font>';
											}?>
										</td>
	                 	<td><a href="javascript:addTypeChange('<?php echo M_URL($this->AppName.'/Index','vochershare',$v['id'],GP('')); ?>','700px','400px',{title:'推广'});"><i class="iconfont icon-fenxiang"></i></a></td><!--推广-->
	                    <td class="ks-head-el">
	                    	<i onClick="choiceClick(this)" class="iconfont icon-more"></i>
	                    	<div class="ks-head-content ks-head-content-pc w100">
								<ul class="opeart">
									<?php if($v['isuse'] != 2){ ?>
									<li><a href="<?php echo M_URL($this->AppName.'/Index','eidtVoucher',$v['id'],GP('')); ?>">编辑</a></li>
									<?php }?>
									<li><a href="javascript:Confirm('是否删除此该优惠券？该操作不可逆！','<?php echo M_URL($this->AppName.'/Index','delRedpacket',$v['id'],GP('')); ?>')">删除</a></li>	  
								</ul>
							</div>
	                    	
	                    </td>	 
                    </tr>
                    <?php } ?>
                </tbody>
        </table>
        <?php echo NoC($values);?>
		<input type="hidden" name="batch" id="batch1" />
		<div class="ks-bom clearfix">
			
			<div class ="fr">
				<?php echo $page->show(3); ?>
			</div>
		 </div>
    	</form>
    </div>


<script src="<?php echo UOOT;?>/Public/common/js/module.js?<?php echo echoHash();?>"></script>
<script>
    
 module.require(['$','backstage','nicescroll'],function(){
 	loadScorllJs()	
 })   
    
function submitform(type){
	$('#batch1').val(type);
	$('#myform').submit();
}	
    
</script>
</body>
</html>
