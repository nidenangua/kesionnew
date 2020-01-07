<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit">
<title>学员管理</title>
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
	     	<h3 class="ks-head-title2"><?php echo $title;?>-学员管理
	     	<div class="fr">

			</div>	
			</h3>
     		<div class="fr">

			</div>	
	     </div>
	     <!--header-->
					<!--widget-->
					<div class="ks-head-widget clearfix">
						
						
						<div class="ks-search-box fl">
							
							<form target="hidframe">
								<!--搜索框组件-->
								<select class="w150 inputText bRadius5 fl" id="keytype">
									<option value="1" <?php if($keytype==1){echo 'selected="selected"';} ?>>用户账号</option>
									<option value="2" <?php if($keytype==2){echo 'selected="selected"';} ?>>用户昵称</option>
							  	</select>
								<div class="ks-top-search fl">
									
									<input type="text" class="sc-text" name="searchText" id="keyword"  value="<?php if(isset($keyword)) echo $keyword; ?>">
					                
					                <button type="submit" class="ks-head-search" onClick="searchByClass('<?php echo GP('id-'.$id); ?>','<?php echo M_URL($this->AppName.'/Index','showgroupuser'); ?>','<?php echo URL_MODEL;?>')"><i class="iconfont icon-sousuo"></i></button>  
					                
								</div>

								<!--搜索框组件-->
							</form>
						</div>					
					
							
						
						<div class="fr">
							<ul class="ks-head-choice">
							
								<li>
									<div class="ks-head-el">
										<a class="ks-heade-button ks-head-primary" type="button"  onclick="showbox()"><i class="icon-jiahao iconfont "></i>添加会员</a>

									</div>
								</li>
							</ul>
						</div>
					</div>
					<!--/widget-->
				    <form target="hidframe" action="<?php echo M_URL($this->AppName.'/Index','delGroupUser',$id,GP("type-2"));  ?>" method="post" id="myform">	
     				<!--table-->
					<table class="ks-table">
							<tr>
									<thead>
										<tr>
											<td style="width: 30px;">选择</td>
											<td>账号</td>
											<td>昵称</td>
											<td>到期时间</td>
											<td>电话号码</td>
											<td>注册时间</td>
											<td>来源</td>
											<td>操作</td>
										</tr>    											
									</thead>
									<tbody>
										<?php foreach($values as $k=>$v){ ?> 
										<tr>
											<td><input type="checkbox" class="select-checks form-in" name="userid[]" value="<?php echo $v['userid'] ?>"></td>
											<td ><?php echo Field($v['username']); ?></td>
											<td><?php echo Field($v['name']); ?></td>
											<td><?php echo date('Y-m-d',$v['buytime']); ?></td>
											<td><?php echo Field($v['mobile']); ?></td>
											<td><?php echo date('Y-m-d',$v['regdate']); ?></td>
											<td><?php if($v['grouptype']==1){echo '购买';}elseif($v['grouptype']==2){echo '消费升级';}elseif($v['grouptype']==3){echo '后台添加';}else{echo '---';}?></td>
											<td class="ks-head-el">
											 	<a href="javascript:Confirm('是否删除此会员!','<?php echo M_URL($this->AppName.'/Index','delGroupUser',$id,GP("type-1,userid-".$v['userid'])); ?>')"><i class="iconfont icon-shanchu1"></i></a>
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
									<button type="button" class="ks-heade-button mr10" onclick="submitform()"><i class="iconfont icon-shanchu1"></i></button>
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
	
	module.require(['$','backstage','nicescroll','cookie','laydate'],function(){
		
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
	function submitform(){
		inspectionCheckBox('userid[]',function(){
			top.popup.confirm('确认要删除所选项吗？',{
				determine:function(){
					$('#myform').submit();
				}
			})

		})
		
	}
	function showbox(){
		$.cookie('userlist', '', { expires: -1, path: '/' });
		addTypeChange('<?php echo M_URL($this->AppName.'/Index','addGroupUser',$id,GP("appid-$this->appid",true)); ?>','1000px','650px',{title:'添加会员',type:'top'})
	}
</script>
</body>
</html>
