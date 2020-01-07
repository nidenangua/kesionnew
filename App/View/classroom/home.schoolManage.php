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
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
</head>
<body class="ks-wrap">

	<div id="ksBoxContent" class="mt20">
		
		<div class="ks-wbox bRadius10">

         	 <!--header-->
		     <div class="ks-head-box">
		     		<h3 class="ks-head-title2">校区管理
						<div class="fr">	
								<a class="ks-setting-icon fl ml10" target="_blank"  href="<?php echo MY_FULLDOMAIN;?>/home/help#anchor61"><i class="iconfont icon-qm" ></i></a>											
						</div>		     		
		     		</h3>
		     </div>
		 	 <!--header-->
		 	  <!--tab-->
		     	<div class="ks-head-tab " style="margin-bottom: 25px;">
		     			<ul class="clearfix">
		     				<li >
								<a href="<?php echo M_URL($this->AppName.'/Index','','',GP('')); ?>" target="main">教室管理</a>
							</li>	
							<li class="curr">
								<a   href="<?php echo M_URL($this->AppName.'/Index','schoolManage','',GP('')); ?>" target="main">校区管理</a>
							</li>	
		     			</ul>
		     	</div>
		 	<!--/tab-->
		 	
		 	<div class="ks-head-widget clearfix">
		 		<div class="ks-head-el fr">
			 		<a class="ks-heade-button ks-head-primary" href="javascript:void(0);" onClick="addTypeChange('<?php echo M_URL($this->AppName.'/Index','addschool','',GP('')); ?>','800px','600px',{type:'top',title:'增加教室'});">
					<i class="iconfont icon-jiahao"></i>
					增加校区
					</a>
				</div>	
		 	</div>
		 		
					<form target="hidframe" id="myform" action="<?php echo M_URL($this->AppName.'/Index','batchSchool','',GP('p-'.$page->now_page)) ?>" method="post">

						<table class="ks-table">
							<thead>
								<tr>
								    <th>选择</th>
								    <th>校区名称</th>
								    <th>校区地址</th>
								  
						          	<th>联系人</th>
						          	<th>联系方式</th>
						          
									<th>操作</th>
							   </tr>
							</thead>
 					<?php foreach($value as $k=>$v){ ?>
 						<tr>
 						   <td style="width: 30px;"><input type="checkbox" class="select-checks form-in" name="aid[]" value="<?php echo $v['schoolid'];?>"></td>
						      <td><?php echo $v['school'];?></td>
							 <td><?php echo $v['address'];?></td>			
							 <td><?php echo $v['name'];?></td>
							 <td><?php echo $v['tel'];?></td>
							
							 <td class="ks-head-el"  >
								<i onClick="choiceClick(this)" class="iconfont icon-more"></i>
								<div class="ks-head-content ks-head-content-pc">
									<ul class="opeart">
											<li>
							 					<a onClick="addTypeChange('<?php echo M_URL($this->AppName.'/Index','editSchool',$v["schoolid"],GP('')); ?>','800px','550px',{type:'top',title:'编辑教室'});">编辑</a>
											</li>
											
											<li>
												<a href="javascript:void(0);" onClick="addTypeChange('<?php echo M_URL($this->AppName.'/Index','addschool','',GP('')); ?>','800px','550px',{type:'top',title:'增加校区'});">
												
													增加校区
												</a>
											<li>
												<a onClick="Confirm('是否删除此校区？该操作不可逆','<?php echo M_URL($this->AppName.'/Index','delSchool',$v['schoolid'],GP('p-'.$page->now_page));?>');">删除</a>
											</li>
											</li>
											
									</ul>
									
								</div>
							</td>

	 					 <?php } ?> 

					</tr>
				</table>
				  <?php echo NoC($value);?>
				  	   <?php if(!empty($values)){?>
	 			 <div class=" ks-bom clearfix">
						<span class="fl ">
							<label class="mr20 fl"><input type="checkbox" class="select-checks selectAll">全选</label>
							<button type="button" class="ks-heade-button ml10" onClick="submitform()" ><i class="iconfont icon-shanchu1"></i></button>
						</span>
						<div class="fr "><?php echo $page->show(3); ?></div>
				</div>
				 <?php } ?> 
			    <input type="hidden" name="batch" id="batch1" />    	
			    </form> 
				</div>
	
	
	
	<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>
	<script>
			module.require(['$','backstage','nicescroll'],function(){
			loadScorllJs();
			
			})
		
	function submitform(type){
		  
		$('#myform').submit();
	}
	
	function attributeSelect(url){    
		window.location.href=''+url;
	}
	</script>
</body>
</html>