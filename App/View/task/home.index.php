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
      <!--开始-->


    	<div class="ks-wbox">
			<div class="ks-head-box clearfix">
				<h3 class="ks-head-title">作业列表
					<div class="fr">
						<a class="ks-setting-icon fl ml10"onClick="appSetUp({title:'应用设置',type:'app',appid:<?php echo $this->appid; ?>,wxid:<?php echo $this->wxid; ?>,isopen:'1'})"><i class="iconfont icon-setting" ></i></a>
						<a class="ks-setting-icon fl ml10" target="_blank"  href="<?php echo MY_FULLDOMAIN;?>/home/help#anchor110"><i class="iconfont icon-qm" ></i></a>
					</div>
				</h3>
			</div>
    		
    		<!--widget-->
				<div class="ks-head-widget clearfix">
					
						<div class="fl">
							<div class="ks-search-box">
								<select class="w150 inputText bRadius5 fl" id="keytype">
								<option value="1">作业名称</option>
							</select>
										<!--搜索框组件-->
									
								<div class="ks-top-search  fl" style="margin-left: 15px;">
									<form target="hidframe" class="fl">
										<input type="text" class="sc-text ml0" name="searchText" id="keyword"  value="<?php if(isset($keyword)) echo $keyword; ?>">
						                
						                <button  type="submit" class="ks-head-search" onClick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL($this->AppName.'/Index','index'); ?>','<?php echo URL_MODEL;?>')"><i class="iconfont icon-sousuo"></i></button>
					        	</form>        
								</div>
							
			
								<!--搜索框组件-->
		
							</div>					
						</div>
						<div class="fr">
							<ul class="ks-head-choice">
									<li>
										<div class="ks-head-el">
											<a  class="ks-heade-button ks-head-primary" onclick="addTypeChange('<?php echo M_URL($this->AppName.'/Index','share',$v['id'],GP(''));?>','440px','400px',{title:'推广'})"><i class="iconfont icon-jiahao"></i>发布作业</a>
										</div>
									</li>
							</ul>
						</div>
			
				</div>
				<!--/widget-->
					  
    <form target="hidframe"  method="post" action="<?php echo M_URL($this->AppName.'/Index','bathdel','',GP(''));?>" id="myform">
				<table class="ks-table">
						<thead>
								<tr>
									<th>选择</th>
									<th>作业题目</th>
									<th>布置时间</th>
									<th>关联课程</th>
									<th>已提交/应提交</th>
									<th>未点评</th>
									<th>分享</th>

									<th>开放状态</th>

									<th>操作</th>
								</tr>
						</thead>
						
						<tbody>
							   <?php foreach($task as $k=>$v){ ?>
							<tr>
								<td style="width: 30px;">
									<input type="checkbox" class="select-checks" name="taskid[]" value="<?php echo $v['id'] ?>" >
								</td>
								<td><?php echo $v['title'] ?></td>
								<td><?php echo date('Y-m-d',$v['adddate']) ?></td>
								<td><?php echo $v['course_title'];?></td>
								<td><?php echo $v['count'];?></td>
								<td style="color: red"><?php echo $v['onevaluate'];?></td>
								<td>
									<a href="javascript:addTypeChange('<?php echo M_URL($this->AppName.'/Index','share',$v['id'],GP(''));?>','700px','400px',{title:'推广'});"><i class="iconfont icon-fenxiang"></i></a>
								</td>
								<td>
									<span class="link-switch<?php if($v["status"]==1){ echo ' open'; }?>" data-off="<?php echo M_URL($this->AppName.'/Index','updatestatus',$v['id'],GP('')); ?>" data-open="<?php echo M_URL($this->AppName.'/Index','updatestatus',$v['id'],GP('')); ?>"><i></i></span>
								</td>
								<td class="ks-head-el">
							<i onclick="choiceClick(this)" class="iconfont icon-more"></i>
							<div class="ks-head-content ks-head-content-pc">
								<ul class="opeart">
									
										<li>
											<a href="<?php echo M_URL($this->AppName.'/Index','editTask',$v['id'],GP('p-'.$page->now_page)); ?>">编辑</a>
										</li>
										
										<li>									
						 				<a href="<?php echo M_URL($this->AppName.'/Index','correct',$v['id'],GP('p-'.$page->now_page)); ?>">批改</a>
										</li>
										
										<li>
										<a href="javascript:void(0);" onclick="Confirm('是否删除此作业？该操作不可逆！','<?php echo M_URL($this->AppName.'/Index','delTask',$v['id'],GP('p-'.$page->now_page));?>')">删除</a>
										</li>
																					  	
										
								</ul>
							</div>
						</td>
							</tr>
							    
        <?php } ?>
						</tbody>
						
				</table>	
    		  <?php echo NoC($task);?>
    		<?php if(!empty($task)){?>	
				<div class="ks-bom clearfix">
					<label class="mr20 fl"><input type="checkbox"  class="select-checks selectAll" >全选</label>
					<span class="fl">
						<button class="ks-bt bt-pue" onclick="submitform(1);">批量删除</button>
					</span>
					<div class="fr"><?php echo $page->show(3); ?></div>
				</div>
				  <?php } ?>	
    </form>
    </div>




<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>
<script>
module.require(['$','backstage','nicescroll'],function(){
	loadScorllJs();
	$('.link-switch').each(function(){
		setLinkSwitch(this)
	})
})
    function submitform(type){
	$('#batch1').val(type);
	$('#myform').submit();
}
</script>
</body>

</html>
