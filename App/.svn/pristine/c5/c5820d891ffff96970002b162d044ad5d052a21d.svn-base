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
<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
<body class="ks-wrap">
	
	<div class="ks-wbox bRadius10">
		<!--header-->
	     <div class="ks-head-box">
	     		<h3 class="ks-head-title2">试卷管理</h3>
	     </div>
		 <!--/header-->
		 <?php if(isset($setting[0])&&$setting[0]==1){?>		 
		 <!--tab-->
		 <div class="ks-head-tab">
 			<ul class="clearfix">
		       <li class="fl <?php   if(ACTION =='Index' || ACTION=='index'){ echo 'curr';} ?>">
      				<a href="<?php echo M_URL($this->AppName.'/Index','Index','',GP('')); ?>" class="alignCenter">试卷</a>
   			</li>					
			 <li class="fl <?php if(ACTION =='TkIndex'){ echo 'curr';} ?>">
      				<a href="<?php echo M_URL($this->AppName.'/Index','TkIndex','',GP('')); ?>" class="alignCenter">题库</a>
   			</li>
     	</div>
		<!--/tab-->
		 <!--widget-->
					<div class="ks-head-widget clearfix">
						
						<div class="fl">
							
							 
							<div class="ks-search-box">
								<form target="hidframe">
									<!--搜索框组件-->
									<select class="w150 inputText bRadius5 fl" id="keytype">
									<option value="1" <?php if($keytype == 1){echo 'selected="selected"';} ?>>题目名称</option>
										
								  	</select>
									<div class="ks-top-search fl">
										
										<input type="text" class="sc-text" name="searchText" id="keyword"  value="<?php if(isset($keyword)) echo $keyword; ?>">
						                
						                <button type="submit" class="ks-head-search" onClick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL($this->AppName.'/Index','TkIndex'); ?>','<?php echo URL_MODEL;?>')"><i class="iconfont icon-sousuo"></i></button>  
						                
									</div>
	
								<!--搜索框组件-->
								</form>
								
						
											
							</div>
							
						</div>	
						
							<div class="fr">
								<ul class="ks-head-choice">
								
									<li>	
										<div class="ks-head-el">
											<button class="ks-heade-button ks-head-primary" type="button" onclick="choiceClick(this)"><i class="icon-filter-2 iconfont "></i></button>
										<div class="ks-head-content ks-head-content-pr" style="width: 360px;">
																					
												<ul class="screen">		
													<li>													
													<span>题目类型：</span>
													<div>
														<a href="<?php echo M_URL($this->AppName.'/Index','TkIndex','',GP('tktype-0')); ?>" class="choice-active">不限</a>
														<a href="<?php echo M_URL($this->AppName.'/Index','TkIndex','',GP('tktype-1')); ?>">选择题</a>
														<a href="<?php echo M_URL($this->AppName.'/Index','TkIndex','',GP('tktype-2')); ?>">填空题</a>
														<a href="<?php echo M_URL($this->AppName.'/Index','TkIndex','',GP('tktype-3')); ?>">判断题</a>
														<a href="<?php echo M_URL($this->AppName.'/Index','TkIndex','',GP('tktype-4')); ?>">问答题</a>
														<a href="<?php echo M_URL($this->AppName.'/Index','TkIndex','',GP('tktype-5')); ?>">材料题</a>
														<a href="<?php echo M_URL($this->AppName.'/Index','TkIndex','',GP('tktype-6')); ?>">多选题</a>
													</div>
													</li>	
												</ul>
									
											</div>
										</div>
									</li>
									<li>
										<a title="考试配置" class="ks-heade-button ks-head-primary"  onClick="appSetUp({title:'应用设置',type:'app',appid:<?php echo $this->appid; ?>,wxid:<?php echo $this->wxid; ?>})">       		
						<i class="iconfont icon-setting"></i>
				</a>		
									</li>
									
									<li>
										<div class="ks-head-el">				
										<a class="ks-heade-button ks-head-primary"  href="<?php echo M_URL($this->AppName.'/Index','addTk','',GP('')); ?>"><i class="iconfont icon-jiahao"></i>新建题目</a>
										</div>

									</li>
		
								</ul>
							</div>
					
					</div>
					<!--/widget-->
					 <form target="hidframe"  action="<?php  echo M_URL($this->AppName.'/Index','batchTk','',GP('p-'.$page->now_page)) ?>" method="post" id="myform">
					<!--table-->
				<table class="ks-table">
					<thead>
						<tr>
							<th>选择</th>
							<th>题目类型</th>
							<th>题目分类</th>							
							<th style="text-align: left;">题干</th>
							<th>参考答案</th>
							
							<th>操作</th>
							
						</tr>
					</thead>
					
					<tbody>
						  <?php foreach($tk as $k=>$v){
					   if($v['tktype'] == 1){
						  $tktype = '选择题';
						  $option=explode("$$$",$v['options']);
						  $v['options']=$option[0];
						}elseif($v['tktype'] == 2){
							$tktype = '填空题';
						}elseif($v['tktype'] == 3){
							$tktype = '判断题';
						}elseif($v['tktype'] == 4){
						     $tktype = '问答题';
							 $anser = explode("$$$",$v['anser']);
							  $v['anser']=$anser[0];
						}elseif($v['tktype'] == 5){
						      $tktype = '材料题';
							  $option=explode("$$$",$v['options']);
							  $v['options']=$option[0];
							  $anser = explode("|$|",$v['anser']);
							  $v['anser']=$anser[0];
						}elseif($v['tktype'] == 6){
							$tktype = '多选题';
						    $option=explode("$$$",$v['options']);
						    $v['options']=$option[0];
						}
		             		
					
				 ?>
						<tr>
							
							<td style="width: 30px;"><input type="checkbox" class="select-checks " name="tkid[]" value="<?php echo $v['tkid'] ?>"></td>
							<td><?php echo $tktype; ?></td>
							<td><?php echo Field($v['categoryname']) ?></td>
							<td style="text-align: left;"><?php echo Field(trim($v['options']))?></td>
							<td ><?php echo Field($v['anser']) ?></td>
						
							
							<td class="ks-head-el">
							 	<i onclick="choiceClick(this)" class="iconfont icon-more"></i>
								<div class="ks-head-content ks-head-content-pc">
									<ul class="opeart">
												
										<li >
											 <a href="<?php echo M_URL($this->AppName.'/Index','editTk',$v['tkid'],GP('p-'.$page->now_page)); ?>" >
											编辑
											</a>
										
										</li>
										<li >
											 <a href="javascript:void(0);" onclick="Confirm('是否删除此试题？该操作不可逆!','<?php echo M_URL($this->AppName.'/Index','delTk',$v['tkid'],GP('p-'.$page->now_page)); ?>')">删除
											 </a>
										
										</li>
										
										
									</ul>
								</div>
							</td>
						</tr>
						  <?php }?>
					</tbody>
				</table>
				  <?php echo NoC($tk);?>
  			 <input type="hidden" name="batch" id="batch1" />
	    </form>
	    <!--footer-->
	    <?php if(!empty($tk)){?>
	    <div class="ks-bom clearfix">
			<span class="fl">
				<label for="selectAll" class="fl"><input name="" type="checkbox" value="" class="select-checks selectAll" id="selectAll">全选</label>
				<button type="button"  class="ks-heade-button mr10"  onclick="submitform(1)" ><i class="iconfont icon-shanchu1"></i></button>
			</span>
			<div class="fr"><?php echo $page->show(3); ?></div>
		</div>
		<!--/footer-->
	  	<?php }?>
	  	
	  	<?php }else{?>
		<div class="unopened">
		 	您还没有启用考试功能！
		 	<a class="ks-bt bt-pue" href="javascript:void(0);" onclick="appSetUp({title:'应用设置',type:'app',appid:<?php echo $this->appid;?>,wxid:<?php echo $this->wxid;?>})">立即开启</a>
		</div>	
				
		<?php }?>
	  		
	  	
</div>

	



<script src="<?php echo UOOT;?>/Public/common/js/module.js?<?php echo echoHash();?>"></script>
<script>
module.require(['$','backstage','nicescroll'],function(){
	loadScorllJs()

});
function submitform(type){
	inspectionCheckBox('tkid[]',function(){
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
	
};
    
</script>
</body>
</html>
