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
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>
</head>
<body class="ks-wrap">
	
	<div class="ks-wbox bRadius10">
		
		<!--header-->
	     <div class="ks-head-box">
	     		<h3 class="ks-head-title2">家校互通
	     		
	     		<div class="fr">
	     		<a class="ks-setting-icon fl ml10" onClick="appSetUp({title:'应用设置',type:'app',appid:<?php echo $this->appid; ?>,wxid:<?php echo $this->wxid; ?>})"><i class="iconfont icon-setting"></i></a>
	     		</div>
	     		</h3>
	     </div>
	     <!--header-->
	     <!--tab-->
	     	<div class="ks-head-tab">
	     			<ul class="clearfix">
	     				<li><a href="<?php echo M_URL('Massage','postlist','',GP('option-2')); ?>">站内消息</a></li>
	     				<li><a href="<?php echo M_URL('Massage','postlist','',GP('option-1')); ?>">公告管理</a></li>
	     				<li><a href="<?php echo M_URL('interact/Index','index','',GP('appid-8')); ?>">聊天数据</a></li>
	     				<li class="curr"><a href="<?php echo M_URL('reviews/Index','index','',GP('appid-13')); ?>">评价管理</a></li>
	     			</ul>
	     	</div>
	     <!--/tab-->
	
	
	  <!--widget-->
				<div class="ks-head-widget clearfix">
					<div class="fl">
						<div class="ks-search-box">
					
							<select class="w150 inputText bRadius5 selectd fl" style="width:120px" onchange="getval(this,'<?php echo GP(''); ?>','<?php echo M_URL($this->AppName.'/Index','index');?>','categoryid','<?php echo URL_MODEL;?>');">
								<?php if(isset($category)){ ?>
								<option value="0">请选择</option>
								<?php foreach($category as $k=>$v){?>
								<option value="<?php echo $v['categoryid']; ?>" <?php if($v['categoryid']==$categoryid){ ?>selected = "selected"<?php }?>><?php echo KS_INDENT($v['depth']).$v['categoryname'];?></option>
								<?php }}else{ ?>
								<option value="0">请选择</option>
								<?php } ?>
							</select>
							
							<form target="hidframe" action="<?php echo  M_URL($this->AppName.'/Index','batcSSSSSh','',GP('')); ?>" method="post" class="fl">
							<div class="fl ks-top-search ">
								<input type="text" class="sc-text sc-mini-pc" name="searchText" id="keyword" value="<?php if(isset($keyword)) echo $keyword; ?>">
								<button type="submit" class="ks-head-search" onClick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL($this->AppName.'/Index','index'); ?>','<?php echo URL_MODEL;?>')"><i class="iconfont icon-sousuo"></i></button>
							</div>
						</form>
						                

					     </div>			
								</div>
								
						
									<div class="fr">
										<ul class="ks-head-choice">
										
											<li>
												<div class="ks-head-el">
													<button class="ks-heade-button ks-head-primary" type="button" onclick="choiceClick(this)"><i class="icon-filter-2 iconfont "></i></button>
													<div class="ks-head-content ks-head-content-pr w400">
																								
														<ul class="screen">															
															<li>
															<span>评价状态：</span>
															<div>
																<a href="<?php echo M_URL($this->AppName.'/Index','index','',GP("status-3,appid-$this->appid",true)); ?>" <?php if($status == 3){ echo 'class="choice-active"';}?>>所有问题</a>
																<a href="<?php echo M_URL($this->AppName.'/Index','index','',GP("status-1,appid-$this->appid",true)); ?>" <?php if($status == 1){ echo 'class="choice-active"';}?>>已审核</a>
																<a href="<?php echo M_URL($this->AppName.'/Index','index','',GP("status-0,appid-$this->appid",true)); ?>" <?php if($status == 0){ echo 'class="choice-active"';}?>>未审核</a>							
														</li>	
														</ul>
													</div>
											
												</div>
									
				     
													</div>
											</li>
											
										</ul>	
								</div>	
	<!--/widget-->
	

		
			<form target="hidframe" action="<?php echo M_URL($this->AppName.'/Index','batch','',GP(''));?>" id="myform" method="post">        
				<table width="100%" cellpadding="0" cellspacing="0" border="0" class="gTable borderTable borderSo ks-table">
					<thead>
						<tr>
							<th style="width: 30px;"><input name="" type="checkbox" value="" class="select-checks selectAll"> </th>
							<th>应用ID</th>
							<th class="ta-left">评价内容</th>
							<th>评价者</th>
							<th>时间</th>
							<th>状态</th>              
							<th>操作</th>
						</tr>
					</thead>
					<tbody>
					<?php foreach($values as $k=>$v){?> 
					<tr>
						<td><input type="checkbox" class="select-checks" name="id[]" value="<?php echo $v['reviewsid'] ?>"></td>
						<td><?php echo $v['appid']?></td>
						<td class="ta-left" width="30%"><a href="<?php echo M_URL($this->AppName.'/Index','view',$v['reviewsid'],GP('')); ?>"><?php echo $v['reviews']?></a>
						</td>
						<td><?php echo $v['membername']?></td>
						<td><?php echo date('Y-m-d H:i:s',$v['adddate']) ?></td>
						<td onClick="updatesStatus('<?php echo M_URL($this->AppName.'/Index','updatestatus',$v['reviewsid'],GP('')); ?>',<?php echo $v['reviewsid']?>)" id="a<?php echo $v['reviewsid']?>">
						<?php if($v['status'] ==0){?>
							<span style="color: red;">未审核</span>
						<?php }elseif($v['status'] ==1){?>
							<span style="color: green;">已审核</span>
						<?php } ?>  
						</td>
						<td>
							<div class="operate">
							<a href="javascript:void(0);"  onclick="Confirm('是否删除此评价？该操作不可逆!','<?php echo M_URL($this->AppName.'/Index','delreviews',$v['reviewsid'],GP('')); ?>')"><em>删除</em><i class="iconfont icon-shanchu1"></i></a>
							</div>
						</td>
					</tr>
					<?php }?>
					</tbody>
				</table>
				<?php echo NoC($values);?>
	
		<input type="hidden" name="batch" id="batch1" />
		<?php if(!empty($values)){?>
			<div class="ks-bom clearfix">
			<span class="fl">
				<label class="mr20 fl"><input name="" type="checkbox" value="" class="select-checks selectAll">全选</label>
				<button type="button" class="ks-heade-button mr10" onclick="submitform(1);">批量删除</button>
				<button type="button" class="ks-heade-button mr10" onclick="submitform(2);">批量审核</button>
		        <button type="button" class="ks-heade-button" onclick="submitform(3);">取消审核</button>
			</span>
			<div class="fr"><?php echo $page->show(3); ?></div>
		
	</div>
		<?php }?>
</form>		


</div>

<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>
<script>
	module.require(['$','backstage','nicescroll','laydate'],function(){
		loadScorllJs();
	})
function updatesStatus(url,reviewsid){ 
	  $.ajax({
			type:"get",
			url:url,
			success:function(data){
				if(data==0){
					$("#a"+reviewsid).html('<span style="color: red;">未审核</span>');
				}else if(data==1){
					$("#a"+reviewsid).html('<span style="color: green;">已审核</span>');
				}
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
</script>
</body>
</html>

