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
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />

</head>
<body class="ks-wrap">
	
	<div class="ks-wbox bRadius10">
		  <!--header-->
		     <div class="ks-head-box">
		     		<h3 class="ks-head-title2">教室管理
		     			<div class="fr">
		     				
		     					<a class="ks-setting-icon fl ml10" onClick="appSetUp({title:'教室设置',type:'app',appid:<?php echo $this->appid; ?>,wxid:<?php echo $this->wxid; ?>})"><i class="iconfont icon-setting"></i></a>						
								<a class="ks-setting-icon fl ml10" target="_blank"  href="<?php echo MY_FULLDOMAIN;?>/home/help#anchor61"><i class="iconfont icon-qm" ></i></a>
												
						</div>
		     		</h3>
		     </div>
		  <!--header-->
		   <!--tab-->
		     	<div class="ks-head-tab">
		     			<ul class="clearfix">
		     				<li class="curr">
								<a href="<?php echo M_URL($this->AppName.'/Index','','',GP('')); ?>" target="main">教室管理</a>
							</li>	
							<li >
								<a   href="<?php echo M_URL($this->AppName.'/Index','schoolManage','',GP('')); ?>" target="main">校区管理</a>
							</li>	
		     			</ul>
		     	</div>
		 <!--/tab-->
		 	<!--widget-->
							<div class="ks-head-widget clearfix">
								<div class="fl">
									<div class="ks-search-box">
									
						                
										<?php if(iscategory($this->wxid,$this->appid)){ ?>		
										
											
										<select class="w150 inputText" onchange="getval(this,'<?php echo GP(''); ?>','<?php echo M_URL($this->AppName.'/Index','index'); ?>','categoryid','<?php echo URL_MODEL;?>')">
										    <?php if(isset($category)){ ?>
												<option value="0">请选择</option>
											    <?php foreach($category as $k=>$v){ ?>
												<option value="<?php echo $v['categoryid']; ?>" <?php if($v['categoryid']==$categoryid){ ?>selected = "selected"<?php } ?>>
												<?php echo KS_INDENT($v['depth']).$v['categoryname'];?>
										        </option>
										    <?php }}else{ ?>
												<option value="0">请选择</option>
											<?php } ?>
										</select>
										
										<?php }?>
										
										<select  id="keytype" class="w180 inputText">
										  <option value="1" <?php if($keytype==1) echo "selected"; ?>>教室名称</option>
								          <option value="2" <?php if($keytype==2) echo "selected"; ?>>所在学校</option>
								          <option value="3" <?php if($keytype==3) echo "selected"; ?>>教室ID</option>
										</select>
									
									    <div class="fr ks-top-search">
									    	 <form target="hidframe">
												<input type="text" class="sc-text sc-mini-pc" id="keyword" value="<?php if(isset($keyword)) echo $keyword; ?>">
												
												<button type="submit" class="ks-head-search" onClick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL($this->AppName.'/Index','index'); ?>','<?php echo URL_MODEL;?>')"><i class="iconfont icon-sousuo"></i></button>
											</form>
										</div>
										
					                
									</div>			
								</div>
								
						
									<div class="fr">
										<ul class="ks-head-choice">
											
								
										
											
											<li>
												<div class="ks-head-el">
													<a class="ks-heade-button ks-head-primary" href="javascript:void(0);" onclick="addTypeChange('<?php echo M_URL($this->AppName.'/Index','addClassroom','',GP('')); ?>','800px','600px',{type:'top',title:'增加教室'});">
													<i class="iconfont icon-jiahao"></i>
													增加教室 
													</a>
												</div>
											</li>
											
										</ul>
									</div>
								
							</div>
						<!--/widget-->

<form target="hidframe" id="myform" action="<?php echo M_URL($this->AppName.'/Index','batch','',GP('p-'.$page->now_page)) ?>" method="post">
	    <table class="ks-table">
	    	<thead>
			   <tr>
			    <th>选择</th>
			      <th>教室图片</th>
			    <th>教室ID</th>
			  
	          	<th>教室名称</th>
	          	<th>所在学校</th>
	          	<th>地址</th>
	          	<th>容纳人数</th>
				<th>操作</th>
			   </tr>
			</thead>
            <?php foreach($values as $k=>$v){?>
		 <tr>
		     <td style="width: 30px;"><input type="checkbox" class="select-checks form-in" name="classid[]" value="<?php echo $v['id'];?>"></td>
		      <td><img width='80px' height='50px' src="<?php echo Field(Img($v['defaultpic']));?>"></td>
			 <td><?php echo $v["id"];?></td>			
			 <td><?php echo Field($v["classroomname"]);?></td>
			 <td><?php echo Field($v["schoolname"]);?></td>
			 <td><?php echo Field($v["address"]);?></td>
			 <td><?php echo Field($v["galleryful"]);?></td>
			
			 
			 <td class="ks-head-el"  >
				<i onclick="choiceClick(this)" class="iconfont icon-more"></i>
				<div class="ks-head-content ks-head-content-pc">
					<ul class="opeart">
							<li>
			 					<a onclick="addTypeChange('<?php echo M_URL($this->AppName.'/Index','editClassroom',$v["id"],GP('')); ?>','800px','600px',{type:'top',title:'编辑教室'});">编辑</a>
							</li>
							<li>
								<a onclick="Confirm('是否删除此新闻？该操作不可逆','<?php echo M_URL($this->AppName.'/Index','delclassroom',$v['id'],GP('p-'.$page->now_page));?>');">删除</a>
							</li>
							
					</ul>
					
				</div>
			</td>
 
			<?php }?>
            
		</tr>
		</table>
        <?php echo NoC($values);?>
        <?php if(!empty($values)){?>	
		<div class="ks-bom clearfix" >
			<span class="fl">
				<label class="mr20 fl"><input type="checkbox" class="select-checks selectAll" >全选</label>
				<button class="fr ks-heade-button" onclick="do_reg(1)"><i class="iconfont icon-shanchu1"></i></button>
			</span>
			<div class="fr"><?php echo $page->show(3); ?></div>
		</div>
		<?php }?>
		
    <input type="hidden" name="batch" id="batch1" />    	
    </form> 
	</div>

<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>
<script>
		module.require(['$','backstage','nicescroll'],function(){
		loadScorllJs();
		
		})
function do_reg(type){
	$('#batch1').val(type);    
	$('#myform').submit();
}

function mbar(sobj) { 
var docurl =sobj.options[sobj.selectedIndex].value; 
if (docurl != "") { 
open(docurl,'_blank'); 
sobj.selectedIndex=0; 
sobj.blur(); 
} 
} 

function attributeSelect(url){    
	window.location.href=''+url;
}
</script>
</body>
</html>