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
<link href="<?php echo UOOT;?>Public/app/css/laydate.css" rel="stylesheet">

</head>
<body class="ks-wrap">  
	
    <form target="hidframe"  action="<?php  echo M_URL($this->AppName.'/Index','batch','',GP('p-'.$page->now_page)) ?>" method="post" id="myform" class=" bRadius10 ">
		
	<div class="ks-wbox bRadius10">
		
		<!--header-->
		<div class="ks-head-box clearfix">
			<h3 class="ks-head-title2 ">意向通</h3>
		</div>
		
		<!--header-->
	
	
		<!--tab-->
     	<div class="ks-head-tab">
 			<ul class="clearfix">
 				<li <?php if(ACTION=='index'){echo 'class="curr"';}?>><a href="<?php echo M_URL($this->AppName.'/Index','index','',GP('appid-33',true));  ?>">我的意向本</a></li>
					<li <?php if(ACTION=='manageindex'){echo 'class="curr"';}?>><a href="<?php echo M_URL($this->AppName.'/Index','manageindex','',GP('appid-33',true)); ?>">意向记录</a> </li>
					<li <?php if(ACTION=='consultingPool'){echo 'class="curr"';}?>><a href="<?php echo M_URL($this->AppName.'/Index','consultingPool','',GP('appid-33',true)); ?>">意向池</a> </li>
					<li <?php if(ACTION=='invalidpool'){echo 'class="curr"';}?>><a href="<?php echo M_URL($this->AppName.'/Index','invalidpool','',GP('appid-33',true)); ?>">无效池</a> </li>
		<!--			<li ><a href="<?php echo M_URL($this->AppName.'/Index','index','',GP('htmltype-2'));  ?>">我的咨询本</a> </li>-->
					<li <?php if(ACTION=='listenmanagement'){echo 'class="curr"';}?>><a href="<?php echo M_URL($this->AppName.'/Index','listenmanagement','',GP('appid-33',true));  ?>">试听管理</a></li>
					<li <?php if(ACTION=='showchannel'){echo 'class="curr"';}?>><a href="<?php echo M_URL($this->AppName.'/Index','showchannel','',GP('appid-33',true));  ?>">渠道管理</a></li>
 			</ul>
     	</div>
    <!--/tab-->
    
    
    <!--widget-->
	<div class="ks-head-widget clearfix">
			<div class="fr">
				<ul class="ks-head-choice">

					<li>
						<div class="ks-head-el">
							<a class="ks-heade-button ks-head-primary" onmousedown="return checkpower({'version':'<?php echo checkIsVipModule($this->wxid,33,false,true);?>'})" type="button" onclick="addTypeChange('<?php echo M_URL($this->AppName.'/Index','showchanneladd','',GP('')) ?>','500px','300px',{title:'新增渠道',type:'top'})" ><i class="icon-jiahao iconfont "></i>新增渠道</a>
						</div>
						
					</li>
					
					
				</ul>
			</div>
		
	</div>
	<!--/widget-->
		
		<table width="100%" cellpadding="0" cellspacing="0" border="0" class="ks-table">
			<thead>
                <tr>
                	<th class="form-in" style="width: 30px;">选择</th>
                    <th>渠道名称</th>
                    <th>添加者</th>
                    <th>添加时间</th>
                    <th>操作</th>

                </tr>
            </thead>
            <tbody>
            	<?php foreach($infoary as $k=>$v){?>
            	<tr>
            		<td class="form-in" style="width: 30px;">
						<input type="checkbox" class="select-checks" name="id[]" value="<?php echo $v['id'] ?>">
					</td>
                    <td><?php echo $v['channel']?></td>
                    <td><?php echo $v['name']?></td>
                    <td><?php echo date('Y-m-d',$v['adddate'])?></td>
                   
                    
                    <td class="ks-head-el">
							<i onclick="choiceClick(this)" class="iconfont icon-more"></i>
							<div class="ks-head-content ks-head-content-pc">
									<ul class="opeart">
										<li>
											<a  onclick="addTypeChange('<?php echo M_URL($this->AppName.'/Index','showchanneladd',$v['id'],GP('')) ?>','500px','300px',{title:'编辑渠道',type:'top'})">编辑</a>
										</li>	
										<li>
											<a onclick="Confirm('是否放弃该记录？该操作不可逆!','<?php echo M_URL($this->AppName.'/Index','deletechannel',$v['id'],GP('p-'.$page->now_page)); ?>')">删除</a>
										</li>
									</ul>
								</div>
							</td>
                   
	            </tr>
            	<?php } ?>
            </tbody>
		</table>
			<?php echo NoC($infoary);?>
				
				
		<?php if(!empty($infoary)){?>
		
		<div class="ks-bom clearfix">
			<div class="fl">
				<label class="mr20 fl"><input type="checkbox" class="select-checks selectAll">全选</label>
		         <button type="submit" class="ks-heade-button mr10" onclick="submitform(1)" >批量删除</button>
			</div>
			<div class="fr">
				<?php echo $page->show(3); ?>
			</div>
		</div>
		<?php } ?>
	</form>
</div>


<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>
<script>
	module.require(['$','backstage','nicescroll'],function(){
			loadScorllJs();
	})

function submitform(type){
	$('#batch1').val(type);
	$('#myform').submit();
}	

	
</script>
</body>
</html>
