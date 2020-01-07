<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit">
<title>角色管理</title>
<link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />

</head>
<body class="ks-wrap">
	
	<!--new home-->
	<div class="ks-wbox bRadius10">

		<!--header-->
	     <div class="ks-head-box">
	     	<h3 class="ks-head-title2">子帐号管理
				<div class="fr">
					<!--<a class="ks-setting-icon fl ml10" onClick="appSetUp({title:'应用设置',type:'app',appid:<?php echo $this->appid; ?>,wxid:<?php echo $this->wxid; ?>,isopen:1})"><i class="iconfont icon-setting"></i></a>-->
                    <a class="ks-setting-icon fl ml10" target="_blank"  href="<?php echo MY_FULLDOMAIN;?>/home/help#anchor62"><i class="iconfont icon-qm" ></i></a>
				</div>
			</h3>
	     </div>
	     <!--header-->
		<div class="ks-head-tab">
			<ul class="clearfix">
				<li ><a href="<?php echo M_URL('role/Index','teacherList','',GP('appid-6')); ?>">子账号列表</a></li>
				<li class="curr"><a href="<?php echo M_URL('role/Index','index','',GP('appid-6')); ?>">角色列表</a></li>
			</ul>
		</div>

			<!--widget-->
			<div class="ks-head-widget clearfix">
				
				
				<div class="ks-search-box fl">
					
					<form target="hidframe">
						<!--搜索框组件-->
						<select class="w150 inputText bRadius5 fl" id="keytype">
							<option value="1" <?php if($keytype==1){echo 'selected="selected"';} ?>>角色名称</option>
						</select>
						<div class="ks-top-search fl">
							
							<input type="text" class="sc-text" name="searchText" id="keyword"  value="<?php if(isset($keyword)) echo $keyword; ?>">
							
							<button type="submit" class="ks-head-search" onClick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL($this->AppName.'/Index','index'); ?>','<?php echo URL_MODEL;?>')"><i class="iconfont icon-sousuo"></i></button>
							
						</div>

						<!--搜索框组件-->
					</form>
				</div>					
			
					
				
				<div class="fr">
					<ul class="ks-head-choice">
					
						<li>
							<div class="ks-head-el">
								<a class="ks-heade-button ks-head-primary" type="button"  href="<?php echo M_URL($this->AppName.'/Index','roleAdd','',GP("appid-$this->appid")); ?>"  onclick="return checkpower({'version':'<?php echo checkIsVipModule($this->wxid,3,false,true);?>'})"><i class="icon-jiahao iconfont "></i>添加角色</a>

							</div>
						</li>
					</ul>
				</div>
			</div>
			<!--/widget-->
			<form target="hidframe" action="<?php echo M_URL($this->AppName.'/Index','roleDel','',GP(""));  ?>" method="post" id="myform">
			<!--table-->
			<table class="ks-table">
					<tr>
							<thead>
								<tr>
									<td style="width: 30px;">选择</td>
									<td>角色</td>
									<td>描述</td>
									<td>添加时间</td>
									<td>操作</td>
								</tr>    											
							</thead>
							<tbody>
								<?php foreach($values as $k=>$v){ ?> 
								<tr>
									<td><input type="checkbox" class="select-checks form-in" name="id[]" value="<?php echo $v['id'] ?>"></td>

									<td ><?php echo Field($v['title']); ?></td>
									<td><?php echo Field($v['shortdesc']); ?></td>
									<td><?php echo date('Y-m-d',$v['adddate']); ?></td>
									<td class="ks-head-el">
										<i onClick="choiceClick(this)" class="iconfont icon-more"></i>
										<div class="ks-head-content ks-head-content-pc w100">
											<ul class="opeart">
												<li>
													<a href="<?php echo M_URL($this->AppName.'/Index','roleAdd',$v['id'],GP("appid-$this->appid")); ?>">编辑</a>
												</li>
												<li>
													<a href="javascript:Confirm('是否删除此分组？删除后学员默认归为普通!','<?php echo M_URL($this->AppName.'/Index','roleDel',$v['id'],GP("")); ?>')">删除</a>
												</li>
											</ul>
										</div>
									</td>
								</tr>
								<?php }?>
							</tbody>
					</tr>
			</table>
			<?php echo NoC($values);?>
			<!--/table-->
			
			<?php if(!empty($values)){?>
				<input type="hidden" name="batch" id="batch1" />
			<!--footer-->
				<div class="ks-bom clearfix">
						<span class="fl">
							<label class="mr20 fl"><input type="checkbox" class="selectAll select-checks">全选</label>
							<button type="button" class="ks-heade-button mr10" onClick="submitform(1)"><i class="iconfont icon-shanchu1"></i></button>
						</span>
					<div class="fr"><?php echo $page->show(3); ?></div>
				</div>
			<?php }?>
			<!--/footer-->
		</form>
	   		
	</div>
	  


<!--news -->



<script src="<?php echo UOOT;?>/Public/common/js/module.js?<?php echo echoHash();?>"></script>
<script>
	
	module.require(['$','backstage','nicescroll','laydate'],function(){
		
		//time
		laydate.render({
		  elem: '#test6'
		  ,range: true
		});
		
		loadScorllJs();
		$('.link-switch').each(function(){
			setLinkSwitch(this)
		})

		
	});
	function submitform(type){
		inspectionCheckBox('id[]',function(){
			top.popup.confirm('确认要删除所选项吗？',{
				determine:function(){
					$('#myform').submit();
				}
			})

		})
		
	}
</script>
</body>
</html>
