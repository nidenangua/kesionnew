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
<style>
	.ivon-down,.ivon-click{position: relative;cursor: pointer;}
	.select-dropdown {position: absolute;box-shadow: rgba(0, 0, 0, 0.2) 0px 1px 6px;background: #fff;padding: 10px 10px;z-index: 99;width: inherit;left: -50px;text-align: center;}
	.ivon-click .state a {height: 20px;width: 60px; text-align: center;margin: auto;line-height: 20px;border-radius: 20px;padding: 2px 10px;margin-bottom: 5px;}
	.ivon-click .state li:nth-of-type(1) a{background-color:#fdf7e4;color:#ffaa15;}
	.ivon-click .state li:nth-of-type(2) a{background-color:#eaf8ff;color:#40b7f6;}
	.ivon-click .state li:nth-of-type(3) a{background-color:#e9f8ec;color:#0bb19a;}
	.ivon-click .state li:nth-of-type(4) a{background-color:#d3d3d3;color:#fff}
	.ivon-click .state li:nth-of-type(5) a{background-color:#f6f1ff;color:#a58ad6}
	.ivon-click .state li:nth-of-type(6) a{background-color:#fff3e9;color:#fc8933;}
	.ivon-click .state li:nth-of-type(7) a{background-color:#d9fbff;color:#65cad7;}
	.ivon-click .select-dropdown {top: 30px; left: 0;}
	.state-span{height: 20px;width: 60px;text-align: center;;margin: auto;line-height: 20px;border-radius: 20px;padding: 2px 10px;margin-bottom: 5px;background-color: #e9f8ec;
    color: #0bb19a;}
    .ks-con-epp {width: 120px;text-align:left!important;overflow: hidden;text-overflow: ellipsis;white-space: nowrap;}
	.ks-con-epp1 {overflow: hidden;text-overflow: ellipsis;white-space: nowrap;}
	.pc-md-w {width:300px}
    @media (max-width:1600px ) {
    	.pc-md-w {width:180px}
    	.ks-top-search .sc-text {width: 150px!important;}
    	.w180 {width: 120px!important;}
    }
     @media (max-width:1366px ) {
     	.ks-head-choice li {margin-left: 5px;}
     	 }
</style>
</head>
<body class="ks-wrap">  
	
	
	
	
	    <form target="hidframe"  action="<?php  echo M_URL($this->AppName.'/Index','forgivesome','',GP('p-'.$page->now_page)) ?>" method="post" id="myform" class=" bRadius10 ">
		
			
	  
	<!--end-->
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
		
			<div class="ks-search-box">
				 	<select class=" inputText bRadius5 mr10 fl" style="width: 100px;" id="keytype">
				     <option value="1">学员姓名</option>
		  	    </select>   
		  	    <form target="hidframe"  class="fr">
				<div class="ks-top-search fl" >
				<input type="text" class="sc-text sc-mini-pc" name="searchText" id="keyword"  value="<?php if(isset($keyword)) echo $keyword; ?>"> 	
				<button type="submit" class="ks-head-search" onClick="searchByClass('<?php echo GP('appid-33',true); ?>','<?php echo M_URL($this->AppName.'/Index',ACTION); ?>','<?php echo URL_MODEL;?>')"><i class="iconfont icon-sousuo"></i></button>
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
										<span>咨询类别：</span>
										<div>
											<a <?php if($classify==0){echo 'class="choice-active"';}?> href="<?php  echo M_URL($this->AppName.'/Index','consultingPool','',GP('classify-0')) ?>" >不限</a>
											<a <?php if($classify==1){echo 'class="choice-active"';}?> href="<?php  echo M_URL($this->AppName.'/Index','consultingPool','',GP('classify-1')) ?>" >小班</a>
											<a <?php if($classify==2){echo 'class="choice-active"';}?> href="<?php  echo M_URL($this->AppName.'/Index','consultingPool','',GP('classify-2')) ?>">一对一</a>
											<a <?php if($classify==3){echo 'class="choice-active"';}?> href="<?php  echo M_URL($this->AppName.'/Index','consultingPool','',GP('classify-3')) ?>">大班</a>
											<a <?php if($classify==4){echo 'class="choice-active"';}?> href="<?php  echo M_URL($this->AppName.'/Index','consultingPool','',GP('classify-4')) ?>">课程</a>
			
										</div>
									</li>	
					

									<li>
										<span>咨询校区：</span>
										<div>
										<a href="<?php  echo M_URL($this->AppName.'/Index','consultingPool','',GP('address-0')) ?>" <?php if($address==0){echo 'class="choice-active"';}?>>不限</a>
										<?php foreach($schoolary as $k =>$v){?>
										<a href="<?php  echo M_URL($this->AppName.'/Index','consultingPool','',GP('address-'.$v['schoolid'])) ?>" <?php if($address==$v['schoolid']){echo 'class="choice-active"';}?> ><?php echo $v['school']?></a>
										<?php }?>
			
											
			
										</div>
									</li>	
                       
									<li>
										<span>意向度：</span>
										<div>
											<a <?php if($intentionality==5){echo 'class="choice-active"';}?> href="<?php  echo M_URL($this->AppName.'/Index','consultingPool','',GP('intentionality-5')) ?>" >不限</a>
											<a <?php if($intentionality==0){echo 'class="choice-active"';}?> href="<?php  echo M_URL($this->AppName.'/Index','consultingPool','',GP('intentionality-0')) ?>" >无</a>
											<a <?php if($intentionality==1){echo 'class="choice-active"';}?> href="<?php  echo M_URL($this->AppName.'/Index','consultingPool','',GP('intentionality-1')) ?>">高</a>
											<a <?php if($intentionality==2){echo 'class="choice-active"';}?> href="<?php  echo M_URL($this->AppName.'/Index','consultingPool','',GP('intentionality-2')) ?>">中</a>
											<a <?php if($intentionality==3){echo 'class="choice-active"';}?> href="<?php  echo M_URL($this->AppName.'/Index','consultingPool','',GP('intentionality-3')) ?>">低</a>
											
			
										</div>
									</li>		
									<li>
										<span>渠道：</span>
										<div>
											<a href="<?php  echo M_URL($this->AppName.'/Index','consultingPool','',GP('channelid-0')) ?>" <?php if($channelid==0){echo 'class="choice-active"';}?>>不限</a>
											<?php foreach($channelary as $k =>$v){?>
										<a href="<?php  echo M_URL($this->AppName.'/Index','consultingPool','',GP('channelid-'.$v['id'])) ?>" <?php if($channelid==$v['id']){echo 'class="choice-active"';}?> ><?php echo $v['channel']?></a>
										<?php }?>
										</div>
									</li>			
							
							
															
								</ul>
								</div>
							</div>
					</li>
				</ul>
			</div>
		
	</div>
	<!--/widget-->
		
		
		
		
		
		
				<table width="100%" cellpadding="0" cellspacing="0" border="0" class="ks-table">
			<thead>
                <tr>
                	<th style="width: 30px;">选择</th>
                    <th  style="">学生姓名</th>
                    <th>联系电话</th>
                    <!--<th>咨询类别</th>-->
                    <th style="">意向课程</th>
                    
                  
                    <th>咨询校区</th>
                    
                    <th style="">意向度</th>
                    <th style="">渠道</th>
                    <th>最新回访时间</th>
                    <!--<th>下次回访时间</th>-->
                    <!-- <th>回访结果</th> -->
                    <th>跟进次数</th>
                    <!-- <th>跟进状态</th> -->
                    
                    <!-- <th style="text-align: left;">回访内容</th> -->
                    <th>操作</th>
                   
                </tr>
            </thead>
            <tbody>
            	<?php foreach($values as $k =>$v){?>
            	<tr>
            		<td><input type="checkbox" class="select-checks" style="position: relative;top: 4px;" name="id[]" value="<?php echo $v['id'] ?>"></td>
	            	<td class="ks-con-epp" ><a href="<?php echo M_URL($this->AppName.'/Index','consultingdetails',$v['id'],GP('p-'.$page->now_page)); ?>"><?php  echo $v['membername']?></a></td>
	            	  <td style="width: 100px;"><?php  echo $v['mobile']?></td>
	            	  <td class='min-width  ks-con-epp1' style='text-align: left;' >
	            	  <?php if($v['coursename']){echo $v['coursename'];}else{echo '';}?>
	            	  </td>
	            	  <td>
	            	  	 <?php if($v['schoolroomid']){echo $v['schoolroomid'];}else{echo '';}?>
	            	  </td>
	            	  <td class="c-red"><?php if($v['intentionality']==0){echo '无';}elseif($v['intentionality']==1){echo '高';}elseif($v['intentionality']==2){echo '中';}elseif($v['intentionality']==3){echo '低';} ?></td>
                 
	            	   <?php echo "<td class='ks-con-epp' ".$v['channel']."</td>" ?>
	            	  <td><?php if($v['lasttime']==0){echo '暂无';}else{  echo date('Y-m-d',$v['lasttime']);} ?></td>
	            	  <td><a href="<?php echo M_URL($this->AppName.'/Index','returnlist',$v['id'],GP('p-'.$now_page)) ?>"><?php  echo $v['number']?></a></td>
	            	  	</td>
<!-- 	            	  	<td style='text-align: left;' class="pc-md-w"> <?php if($v['mark']){echo $v['mark'];}else{ ?>
	            	  		<a style="color: deepskyblue;" onclick="addTypeChange('<?php echo M_URL($this->AppName.'/Index','returnvisit',$v['id'],GP('appid-33',true)) ?>','850px','600px',{title:'添加回访记录',type:'top'})">查看</a>
	            	  		<?php }?>
	            	  	</td> -->
	            	 
	            	  
	            	  <td class="ks-head-el"  >
							<i onclick="choiceClick(this)" class="iconfont icon-more"></i>
							<div class="ks-head-content ks-head-content-pc">
								<ul class="opeart">
									
										<li>
											<a href="<?php echo M_URL($this->AppName.'/Index','receive',$v['id'],GP('p-'.$page->now_page)); ?>">领取</a>
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
			<div  class="ks-bom clearfix">
				<div class="fl">
					<label class="mr20 fl"><input type="checkbox" class="selectAll select-checks">全选</label>
			        <button type="submit" class="ks-heade-button mr10" onclick="submitform()" >批量放弃</button>
				</div>
				<div class="fr">
					<?php echo $page->show(3); ?>
				</div>
			</div>
			<?php }?>
	</form>
</div>
<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
<script src="<?php echo UOOT;?>Public/common/js/common.js" ></script>
<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>
<script src="<?php echo UOOT;?>Public/common/js/backstage.js"></script>
<script>
	function choiceClick(target){
	
	var $siblingTarget = $(target).siblings('.ks-head-content');
	if($siblingTarget.attr('flag') === 'true' || $siblingTarget.attr('flag') === undefined){
		closeKsHeadContent();
		cancelBubble();
		$siblingTarget.attr('flag','false').css({
			display:'block',
			opacity:0
		});

		if($siblingTarget.offset().top > window.innerHeight/2){
			$siblingTarget.addClass('ks-head-content-pb').animate({
				opacity:1,
				bottom:45
			},300)
		}else{
			$siblingTarget.animate({
				opacity:1,
				top:45
			},300)
			
		}
	}
};	
	
</script>
</body>
</html>
