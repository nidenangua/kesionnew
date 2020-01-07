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
		<div class="fl">
		 <?php	if(ACTION=='manageindex'||ACTION=='consultingPool'||ACTION=='invalidpool'||ACTION=='listenmanagement'){?>	
			<div class="ks-search-box">
			 	<select class=" inputText bRadius5 mr10 fl" style="width: 100px;" id="keytype">
			     <option value="1">学员姓名</option>
	  	    </select>   
	  	    <form target="hidframe"  class="fr">
			<div class="ks-top-search fl" >
			<input type="text" class="sc-text" name="searchText" id="keyword"  value="<?php if(isset($keyword)) echo $keyword; ?>"> 		<button type="submit" class="ks-head-search"onClick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL($this->AppName.'/Index',ACTION); ?>','<?php echo URL_MODEL;?>')"><i class="iconfont icon-sousuo"></i></button>
			</div> 
			</form> 

			</div>  
			
			<?php }?>
		</div>
		
	
			<div class="fr">
				<ul class="ks-head-choice">
					
					<li>
					<div class="ks-head-el">
						<button class="ks-heade-button ks-head-primary" type="button" onclick="choiceClick(this)"><i class="icon-filter-2 iconfont "></i></button>
							<div class="ks-head-content ks-head-content-pr w400">
							<ul class="screen">
								<li>
									<span>意向类别：</span>
									<div>
										<a <?php if($classify==0){echo 'class="choice-active"';}?> href="<?php  echo M_URL($this->AppName.'/Index','invalidpool','',GP('classify-0')) ?>" >不限</a>
										<a <?php if($classify==1){echo 'class="choice-active"';}?> href="<?php  echo M_URL($this->AppName.'/Index','invalidpool','',GP('classify-1')) ?>" >小班</a>
										<a <?php if($classify==2){echo 'class="choice-active"';}?> href="<?php  echo M_URL($this->AppName.'/Index','invalidpool','',GP('classify-2')) ?>">一对一</a>
										<a <?php if($classify==3){echo 'class="choice-active"';}?> href="<?php  echo M_URL($this->AppName.'/Index','invalidpool','',GP('classify-3')) ?>">大班</a>
		
									</div>
								</li>	
							
		
								<li>
									<span>意向校区：</span>
									<div>
									<a href="<?php  echo M_URL($this->AppName.'/Index','invalidpool','',GP('address-0')) ?>" <?php if($address==0){echo 'class="choice-active"';}?>>不限</a>
									<?php foreach($schoolary as $k =>$v){?>
									<a href="<?php  echo M_URL($this->AppName.'/Index','invalidpool','',GP('address-'.$v['schoolid'])) ?>" <?php if($address==$v['schoolid']){echo 'class="choice-active"';}?> ><?php echo $v['school']?></a>
									<?php }?>
		
										
		
									</div>
								</li>		
								<li>
									<span>渠道：</span>
									<div>
										<a href="<?php  echo M_URL($this->AppName.'/Index','invalidpool','',GP('channelid-0')) ?>" <?php if($channelid==0){echo 'class="choice-active"';}?>>不限</a>
										<?php foreach($channelary as $k =>$v){?>
									<a href="<?php  echo M_URL($this->AppName.'/Index','invalidpool','',GP('channelid-'.$v['id'])) ?>" <?php if($channelid==$v['id']){echo 'class="choice-active"';}?> ><?php echo $v['channel']?></a>
									<?php }?>
									</div>
								</li>		
							</ul>
						</div>
					</div>
					</li>
				<?php 
				if(ACTION=='showchannel'){?>
		
					<li>
						<div class="ks-head-el">
							<a class="ks-heade-button ks-head-primary" type="button" onclick="addTypeChange('<?php echo M_URL($this->AppName.'/Index','showchanneladd','',GP('')) ?>','500px','300px',{title:'新增渠道',type:'top'})" ><i class="icon-jiahao iconfont "></i>新增渠道</a>
						</div>
						
					</li>
					<?php }else{?>
					<?php if(ACTION=='manageindex'){?>
					<li>
						<div class="ks-head-el">
							<a class="ks-heade-button ks-head-primary" type="button" href="<?php echo M_URL($this->AppName.'/Index','outExcel','',GP('')) ?>" ><i class="icon-jiahao iconfont "></i>导出</a>
						</div>
						
					</li>
						<?php }?>	
					<li>
						<div class="ks-head-el">
							<a class="ks-heade-button ks-head-primary" type="button" href="<?php echo M_URL($this->AppName.'/Index','addrecord','',GP(''))?>"><i class="icon-jiahao iconfont "></i>新增意向</a>
						</div>
						
					</li>
						<?php }?>
				</ul>
			</div>
		
	</div>
	<!--/widget-->

		
	    <form target="hidframe"  action="<?php  echo M_URL($this->AppName.'/Index','forgivesome','',GP('p-'.$page->now_page)) ?>" method="post" id="myform" class=" bRadius10 ">
	
		<table width="100%" cellpadding="0" cellspacing="0" border="0" class="ks-table">
			<thead>
                <tr>
                	<th>选择</th>
                    <th>学生姓名</th>
                    <th>联系电话</th>
                    <th>意向类别</th>
                    <th>意向校区</th>
                    <th>添加时间</th>
                
                    <th>渠道</th>
                    <th>无效类型</th>
                    <th>备注</th>
                    <th>操作</th>
                   
                </tr>
            </thead>
            <tbody>
            
            	<?php foreach($values as $k =>$v){?>
            	<tr>
            		<td><input type="checkbox" class="select-checks" style="position: relative;top: 4px;" name="id[]" value="<?php echo $v['id'] ?>"></td>
	            	<td><a href="<?php echo M_URL($this->AppName.'/Index','consultingdetails',$v['id'],GP('p-'.$page->now_page)); ?>"><?php  echo $v['membername']?></a></td>
	            	  <td><?php  echo $v['mobile']?></td>
	            	  <td><?php  if($v['classify']==1){echo '一对一';}elseif($v['classify']==2){echo '小班';}elseif($v['classify']==3){echo '大班';}?></td>
	            	  
	            	  <td><?php  echo $v['schoolroomid']?></td>
	            	  <td><?php  echo date('Y-m-d',$v['invalidatetime'])?></td>
	            	  <td><?php echo $v['channel']?></td>
	            	  <td><?php  if($v['invalidatetype']==1){echo '手机号是空号';}elseif($v['invalidatetype']==2){echo '外地号码';} ?></td>
	            	  <td><?php  echo $v['mark']?></td>
					  <td class="ks-head-el">
							<i onclick="choiceClick(this)" class="iconfont icon-more"></i>
							<div class="ks-head-content ks-head-content-pc">
								<ul class="opeart">
									<li>
										<a  onclick="Confirm('是否还原该记录？!','<?php echo M_URL($this->AppName.'/Index','receive',$v['id'],GP('p-'.$page->now_page.',type-1')); ?>')">还原</a>
	            	  
									</li>	
								</ul>
							</div>
					</td>
	            </tr>
            	<?php }?>
            </tbody>
		</table>
			<?php echo Noc($values)?>
		
		<?php if(!empty($values)){?>
		<div class="ks-bom clearfix">
			<div class="fl">
				<label class="mr20 fl"><input type="checkbox" class="selectAll select-checks">全选</label>
		        <button type="submit" class="ks-heade-button mr10" onclick="submitform()" >批量还原</button>
			</div>
			<div class="fr">
				<?php echo $page->show(3); ?>
			</div>
		</div>
		<?php }?>
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
