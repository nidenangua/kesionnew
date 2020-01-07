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
	<div class="ks-wbox bRadius10">
			<!--header-->
		<div class="ks-head-box clearfix">
			<h3 class="ks-head-title ">意向通</h3>
		</div>
		
	<!--header-->
	
	
	<!--tab-->
     	<div class="ks-head-tab">
 			<ul class="clearfix">
 				<li <?php if(ACTION=='index'){echo 'class="curr"';}?>><a href="<?php echo M_URL($this->AppName.'/Index','index','',GP(''));  ?>">我的意向本</a></li>
					<li <?php if(ACTION=='manageindex'){echo 'class="curr"';}?>><a href="<?php echo M_URL($this->AppName.'/Index','manageindex','',GP('')); ?>">意向记录</a> </li>
					<li <?php if(ACTION=='consultingPool'){echo 'class="curr"';}?>><a href="<?php echo M_URL($this->AppName.'/Index','consultingPool','',GP('')); ?>">意向池</a> </li>
					<li <?php if(ACTION=='invalidpool'){echo 'class="curr"';}?>><a href="<?php echo M_URL($this->AppName.'/Index','invalidpool','',GP('')); ?>">无效池</a> </li>
		<!--			<li ><a href="<?php echo M_URL($this->AppName.'/Index','index','',GP('htmltype-2'));  ?>">我的咨询本</a> </li>-->
					<li <?php if(ACTION=='listenmanagement'){echo 'class="curr"';}?>><a href="<?php echo M_URL($this->AppName.'/Index','listenmanagement','',GP(''));  ?>">试听管理</a></li>
					<li <?php if(ACTION=='showchannel'){echo 'class="curr"';}?>><a href="<?php echo M_URL($this->AppName.'/Index','showchannel','',GP(''));  ?>">渠道管理</a></li>
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
			<input type="text" class="sc-text" name="searchText" id="keyword"  value="<?php if(isset($keyword)) echo $keyword; ?>"> 		<button type="submit" class="ks-head-search"onClick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL($this->AppName.'/Index','index'); ?>','<?php echo URL_MODEL;?>')"><i class="iconfont icon-sousuo"></i></button>
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
									<span>咨询类别：</span>
									<div>
										<a <?php if($classify==0){echo 'class="choice-active"';}?> href="<?php  echo M_URL($this->AppName.'/Index','index','',GP('classify-0')) ?>" >不限</a>
										<a <?php if($classify==1){echo 'class="choice-active"';}?> href="<?php  echo M_URL($this->AppName.'/Index','index','',GP('classify-1')) ?>" >小班</a>
										<a <?php if($classify==2){echo 'class="choice-active"';}?> href="<?php  echo M_URL($this->AppName.'/Index','index','',GP('classify-2')) ?>">一对一</a>
										<a <?php if($classify==3){echo 'class="choice-active"';}?> href="<?php  echo M_URL($this->AppName.'/Index','index','',GP('classify-3')) ?>">大班</a>
		
									</div>
								</li>	
							
		
								<li>
									<span>咨询校区：</span>
									<div>
									<a href="<?php  echo M_URL($this->AppName.'/Index','index','',GP('address-0')) ?>" <?php if($address==0){echo 'class="choice-active"';}?>>不限</a>
									<?php foreach($schoolary as $k =>$v){?>
									<a href="<?php  echo M_URL($this->AppName.'/Index','index','',GP('address-'.$v['schoolid'])) ?>" <?php if($address==$v['schoolid']){echo 'class="choice-active"';}?> ><?php echo $v['school']?></a>
									<?php }?>
		
										
		
									</div>
								</li>	
		                       
								<li>
									<span>意向度：</span>
									<div>
										<a <?php if($intentionality==5){echo 'class="choice-active"';}?> href="<?php  echo M_URL($this->AppName.'/Index','index','',GP('intentionality-5')) ?>" >不限</a>
										<a <?php if($intentionality==0){echo 'class="choice-active"';}?> href="<?php  echo M_URL($this->AppName.'/Index','index','',GP('intentionality-0')) ?>" >无</a>
										<a <?php if($intentionality==1){echo 'class="choice-active"';}?> href="<?php  echo M_URL($this->AppName.'/Index','index','',GP('intentionality-1')) ?>">高</a>
										<a <?php if($intentionality==2){echo 'class="choice-active"';}?> href="<?php  echo M_URL($this->AppName.'/Index','index','',GP('intentionality-2')) ?>">中</a>
										<a <?php if($intentionality==3){echo 'class="choice-active"';}?> href="<?php  echo M_URL($this->AppName.'/Index','index','',GP('intentionality-3')) ?>">低</a>
										
		
									</div>
								</li>		
								<li>
									<span>渠道：</span>
									<div>
										<a href="<?php  echo M_URL($this->AppName.'/Index','index','',GP('channelid-0')) ?>" <?php if($channelid==0){echo 'class="choice-active"';}?>>不限</a>
										<?php foreach($channelary as $k =>$v){?>
									<a href="<?php  echo M_URL($this->AppName.'/Index','index','',GP('channelid-'.$v['id'])) ?>" <?php if($channelid==$v['id']){echo 'class="choice-active"';}?> ><?php echo $v['channel']?></a>
									<?php }?>
									</div>
								</li>		
								<li>
									<span>跟进状态：</span>
									<div>
										<a <?php if($status==5){echo 'class="choice-active"';}?> href="<?php  echo M_URL($this->AppName.'/Index','index','',GP('status-5')) ?>" >不限</a>
										<a <?php if($status==3){echo 'class="choice-active"';}?> href="<?php  echo M_URL($this->AppName.'/Index','index','',GP('status-3')) ?>">已成单</a>
										<a <?php if($status==1){echo 'class="choice-active"';}?> href="<?php  echo M_URL($this->AppName.'/Index','index','',GP('status-1')) ?>">跟进中</a>
										<a <?php if($status==0){echo 'class="choice-active"';}?> href="<?php  echo M_URL($this->AppName.'/Index','index','',GP('status-0')) ?>">未跟进</a>
										
									</div>
								</li>	
								<li>
									<span>回访结果：</span>
									<div>
										<a <?php if($result==6){echo 'class="choice-active"';}?> href="<?php  echo M_URL($this->AppName.'/Index','index','',GP('result-6')) ?>" >不限</a>
										<a <?php if($result==2){echo 'class="choice-active"';}?> href="<?php  echo M_URL($this->AppName.'/Index','index','',GP('result-2')) ?>">无意向</a>
										<a <?php if($result==0){echo 'class="choice-active"';}?> href="<?php  echo M_URL($this->AppName.'/Index','index','',GP('result-0')) ?>" >考虑中</a>
										<a <?php if($result==1){echo 'class="choice-active"';}?> href="<?php  echo M_URL($this->AppName.'/Index','index','',GP('result-1')) ?>" >已成单</a>
										<a <?php if($result==3){echo 'class="choice-active"';}?> href="<?php  echo M_URL($this->AppName.'/Index','index','',GP('result-3')) ?>" >想试听</a>
										<a <?php if($result==4){echo 'class="choice-active"';}?> href="<?php  echo M_URL($this->AppName.'/Index','index','',GP('result-4')) ?>" >已加入学员档案</a>
										<a <?php if($result==5){echo 'class="choice-active"';}?> href="<?php  echo M_URL($this->AppName.'/Index','index','',GP('result-5')) ?>" >无效</a>
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
                	<th><input type="checkbox" class="selectAll select-checks" style="position: relative;top: 4px;"></th>
                    <th>学生姓名</th>
                    <th>联系电话</th>
                    <th>咨询类别</th>
                    
                    
                    <th>咨询校区</th>
                  
                    
                    <th>添加时间/th>
                
                    <th>渠道</th>
                    <th>无效类型</th>
                    <th>备注</th>
                    <th>操作</th>
                   
                </tr>
            </thead>
            <tbody>
            
            	<tr>
            			<td><input type="checkbox" class="select-checks" style="position: relative;top: 4px;" name="id[]" value=""></td>
            			<td>15969859856</td>
            			<td>一对一</td>
            			<td>2018-04-17 15:23：23</td>
            			<td>广告</td>
            			<td>电话号码为空号</td>
            			<td>回访电话为空号</td>
            			<td>回访电话为空号</td>
            			<td><a class="c-86A8F">还原</a></td>
            			
            			
	            </tr>
            
            </tbody>
		</table>
		
		</div>
		<div class="ks-bom clearfix">
			<div class="fl">
		        <button type="submit" class="ks-bt bt-pue mr10" onclick="submitform()" >批量删除</button>
		         <button type="submit" class="ks-bt bt-pue mr10" onclick="submitform()" >批量导出</button>
			</div>
		</div>

			
			
	
	</form>


<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
<script src="<?php echo UOOT;?>Public/common/js/common.js" ></script>
<script>

</script>
</body>
</html>
