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
	


	
        <div class="bRadius10 ks-wbox">  
        	<!--header-->
			<div class="ks-head-box">
				<h3 class="ks-head-title">优惠券详情
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
			
		
			<div class="ks-top-search fl" style="position: relative;">
					<form target="hidframe">
			</div>  
				</form>
			</div>  
		
		</div>
		
	
			<div class="fr">
				<ul class="ks-head-choice">
					
					<li>
					<div class="ks-head-el">
						<button class="ks-heade-button ks-head-primary" type="button" onclick="choiceClick(this)"><i class="icon-filter-2 iconfont "></i></button>
						<div class="ks-head-content ks-head-content-pr w300" >
							<ul class="screen">
								<li>
									<span>类型：</span>
									<div>
										<a class="<?php if($stat==3) echo "active" ;?>" href="<?php echo M_URL($this->AppName.'/Index','vlist','',GP("stat-3,appid-$this->appid",true)); ?>">不限</a>
											<a class="<?php if($stat==0) echo "active" ;?>" href="<?php echo  M_URL($this->AppName.'/Index','vlist','',GP("stat-0,appid-$this->appid",true)); ?>">未使用</a>
											<a class="<?php if($stat==1) echo "active" ;?>" href="<?php echo M_URL($this->AppName.'/Index','vlist','',GP("stat-1,appid-$this->appid",true)); ?>">已使用</a>
											<a class="<?php if($stat==2) echo "active" ;?>" href="<?php echo M_URL($this->AppName.'/Index','vlist','',GP("stat-2,appid-$this->appid",true)); ?>">已过期</a>
										
									</div>
								</li>
								
							</ul>
						</div>
					</div>
					</li>
					<li>
					<div class="ks-head-el">
						
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
		                <th>用户名</th>
		                <th>优惠券金额</th>
		                <th>状态</th>
		                <th>操作</th>
		            </tr>
	            </thead>
                <tbody>
                	<?php foreach($values as $k=>$v){?>
                	<tr>
	             		<td><?php echo KS_DATE($v['addtime']); ?></td>	
									<td><?php echo $v['username'];
                                              echo '('.User_GetUserName($v['memberid']).')';
?></td>	
	                   	<td>￥<?php echo $v['money'];?></td>	
	                 	<td>
											<?php if($v['isuse'] == 0){
													echo '<font style="color:#2a75ed">未使用</font>';
											}elseif($v['isuse'] == 2){
												echo '<font style="">已过期</font>';
											}elseif($v['isuse'] == 1){
												echo '<font style="#e5412c">已使用</font>';
											}?>
										</td>
	                    <td><a>暂无</a></td>	 
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
