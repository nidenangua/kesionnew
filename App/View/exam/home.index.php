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
</head>
<body class="ks-wrap">
	<div class="ks-wbox bRadius10">
		<!--header-->
		     <div class="ks-head-box">
		     		<h3 class="ks-head-title2">试卷管理
	     				<div class="fr">
						<a class="ks-setting-icon fl ml10" target="_blank"   onClick="appSetUp({title:'应用设置',type:'app',appid:<?php echo $this->appid; ?>,wxid:<?php echo $this->wxid; ?>})"><i class="iconfont icon-setting" ></i></a>
						<a class="ks-setting-icon fl ml10" target="_blank"  href="<?php echo MY_FULLDOMAIN;?>/home/help#anchor147"><i class="iconfont icon-qm" ></i></a>
					</div>
		     		</h3>
		     </div>
		 <!--/header-->
		 <!--tab-->
		 <div class="ks-head-tab">
 			<ul class="clearfix">
		        <li class="fl <?php   if(ACTION =='Index' || ACTION=='index'){ echo 'curr';} ?>">
      				<a href="<?php echo M_URL($this->AppName.'/Index','Index','',GP('')); ?>" class="alignCenter">试卷</a>
   			    </li>					
			    <li class="fl <?php if(ACTION =='TkIndex'){ echo 'curr';} ?>">
      				<a href="javascript:;" onclick="top.KTJ_RouteJump('/exam/tklist')" class="alignCenter">题库</a>
   			    </li>
     	</div>
		<!--/tab-->
		 <!--widget-->
					<div class="ks-head-widget clearfix">
						<div class="fl">
							<?php  if(ACTION=='Index' || ACTION=='index'){  ?>
							<div class="ks-search-box">
								<!--搜索框组件-->
								<select class="w150 inputText bRadius5 fl" id="keytype">
								<option value="1" <?php if($keytype == 1){echo 'selected="selected"';} ?>>考卷名称</option>
							  	</select>
								<div class="ks-top-search fl">
									<form target="hidframe">
									<input type="text" class="sc-text sc-mini-pc" name="searchText" id="keyword"  value="<?php if(isset($keyword)) echo $keyword; ?>">
					                <button type="submit" class="ks-head-search" onClick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL($this->AppName.'/Index','index'); ?>','<?php echo URL_MODEL;?>')"><i class="iconfont icon-sousuo"></i></button>  
					               </form>
								</div>
								<!--搜索框组件-->
							</div>	
							<?php }elseif(ACTION=='TkIndex'){ ?>
							<div class="ks-search-box">
								<!--搜索框组件-->
								<select class="w150 inputText bRadius5 fl" id="keytype">
								<option value="1" <?php if($keytype == 1){echo 'selected="selected"';} ?>>题目名称</option>
									
							  	</select>
								<div class="ks-top-search fl">
									
									<input type="text" class="sc-text" name="searchText" id="keyword"  value="<?php if(isset($keyword)) echo $keyword; ?>">
					                
					                <span class="ks-head-search" onClick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL($this->AppName.'/Index','TkIndex'); ?>','<?php echo URL_MODEL;?>')"><i class="iconfont icon-sousuo"></i></span>  
					                
								</div>
								<!--搜索框组件-->
								<?php }  ?>	
						</div>
						<div class="fr" >
							<div class="fr">
								<ul class="ks-head-choice">
									<li>	
										<div class="ks-head-el">
											<button class="ks-heade-button ks-head-primary" type="button" onclick="choiceClick(this)"><i class="icon-filter-2 iconfont "></i></button>
										<div class="ks-head-content ks-head-content-pr" style="width: 360px;">
																					
												<ul class="screen">															
<!--													<li>-->
<!--														<span>试卷状态：</span>-->
<!--															<div>-->
<!--															<a href="--><?php //echo M_URL($this->AppName.'/Index','index','',GP('status-3')); ?><!--" --><?php //if($status==3){echo 'class="choice-active"'; } ?><!-- >不限</a>-->
<!--															<a href="--><?php //echo M_URL($this->AppName.'/Index','index','',GP('status-2')); ?><!--" --><?php //if($status==2){echo 'class="choice-active"'; } ?><!-- >已审核</a>-->
<!--															<a href="--><?php //echo M_URL($this->AppName.'/Index','index','',GP('status-0')); ?><!--" --><?php //if($status==0){echo 'class="choice-active"'; } ?><!-- >未审核</a>-->
<!--															</div>-->
<!--														</li>-->
														<li>
														<span>试卷类型：</span>
															<div>
															<a href="<?php echo M_URL($this->AppName.'/Index','index','',GP('exam_type-0')); ?>" <?php if($exam_type==0){echo 'class="choice-active"'; } ?>>不限</a>
															<a href="<?php echo M_URL($this->AppName.'/Index','index','',GP('exam_type-1')); ?>" <?php if($exam_type==1){echo 'class="choice-active"'; } ?>>随机组卷</a>
															<a href="<?php echo M_URL($this->AppName.'/Index','index','',GP('exam_type-2')); ?>" <?php if($exam_type==2){echo 'class="choice-active"'; } ?>>按题组卷</a>
														
															</div>
														</li>
												</ul>
											</div>
										</div>
									</li>
									<li>
										<div class="ks-head-el" style="display: none;">										
										<a class="ks-heade-button ks-head-primary"  href="<?php echo M_URL($this->AppName.'/Index','addTk','',GP('')); ?>"><i class="iconfont icon-jiahao"></i>新建题目</a>
										</div>
									</li>
									<?php if (check_power1($this->userinfo,'exam','1')) {?>
									<li>	
										<div class="ks-head-el">									
									  <a class="ks-heade-button ks-head-primary" href="javascript:;" onmousedown="return checkpower({'version':'<?php echo checkIsVipModule($this->wxid,10,false,true);?>'})" onclick="top.KTJ_RouteJump('/exam/choice')" class="alignCenter"><i class="iconfont icon-jiahao"></i> 添加试卷</a>
										</div>
									</li>
									<?php }?>
									<li>
										<div class="ks-head-el">
									<!--<button class="ks-heade-button ks-head-primary" type="button" onclick="addTypeChange('<?php echo M_URL($this->AppName.'/Index','paperword','',GP(''));  ?>','600px','350px',{title:'word试卷导入',type:'top'});">试卷导入</button>-->
										</div>
								</li>
								<!--	<li>
									<?php if($setting[5] ==1){ ?>	
										<div class="ks-head-el">
											<a title="考试配置" class="ks-heade-button ks-head-primary"  href="<?php echo M_URL($this->AppName.'/Index','scoreRank','',GP('')); ?>"  >       		
											成绩等级设置  
											</a>
										</div>
									<?php } ?>
									</li>
									<li>
										<?php if($setting[4] ==1){ ?>	
										  <div class="ks-head-el">		
											<a title="考试配置" class="ks-heade-button ks-head-primary"  href="<?php echo M_URL($this->AppName.'/Index','paperType','',GP('')); ?>" >       		
												试卷类型配置
											</a>
										  </div>
									    <?php } ?>
									</li> -->
								</ul>
							</div>
						</div>
					</div>
					<!--/widget-->
<!--end-->
<!--结束-->
<form target="hidframe"  action="<?php  echo M_URL($this->AppName.'/Index','batch','',GP('p-'.$page->now_page)) ?>" method="post" id="myform" >
			    <!--table-->
				<table class="ks-table">
					<thead>
						<tr>
							<th>选择</th>
							<th style="text-align:left">试卷名称</th>							
							<!-- <th>专业</th>
							<th style="text-align:left">对应课程</th> -->
<!--							<th>试卷类型</th>-->
							<th>添加者</th>
							<th>考试时间</th>
							<th>推广</th>
							<th>题目类型</th>
							<?php if (check_power1($this->userinfo,'exam','up')) {?>
							<th>是否上架</th>
							<?php }?>
							<th>操作</th>
						</tr>
					</thead>
					<tbody>
<?php foreach($paper as $k=>$v){$level='';if($v['paper_level'] == 1){ $level ='简单';}elseif($v['paper_level'] == 2){$level ='一般';}else{$level ='困难';}?> 
<tr>
	<td style="width:30px"><input type="checkbox" class="select-checks " name="paperid[]" value="<?php echo $v['paperid']; ?>"></td>
	<td style="text-align:left"><?php echo $v['title'] ?></td>
	<!-- <td><?php// echo $v['categoryname'];?></td>
	<td style="text-align: left;" class="pc-md-w"><?php echo $v['coursename'];?></td> -->
<!--	<td>--><?php //echo $v['paperTypename'];?><!--</td>-->
	<td><?php echo $v['inputer'];?></td>
	<td><?php echo $v['exam_time']?>分钟</td>
	<td><a href="javascript:addTypeChange('<?php echo M_URL($this->AppName.'/Index','share',$v['paperid'],GP(''));?>','700px','400px',{title:'推广'});"><i class="iconfont icon-fenxiang"></i></a></td>
	<td><?php if($v['exam_type']==1){echo '随机添加';}elseif($v['exam_type']==2){echo '按题目添加';}?></td>
	<?php if (check_power1($this->userinfo,'exam','up')) {?>
	<td>
		<span class="link-switch<?php if($v["is_open"]==1){ echo ' open'; }?>" data-off="<?php echo M_URL($this->AppName.'/Index','down',$v['paperid'],GP('p-'.$page->now_page)); ?>" data-open="<?php echo M_URL($this->AppName.'/Index','up',$v['paperid'],GP('p-'.$page->now_page)); ?>"><i></i></span>
<!--	<span class="link-switch--><?php //if($v["Status"]==2){ echo ' open' ?><!----><?php //}  ?><!--" data-off="--><?php //echo M_URL($this->AppName.'/Index','down',$v['paperid'],GP('p-'.$page->now_page));?><!--" data-open="--><?php //echo M_URL($this->AppName.'/Index','up',$v['paperid'],GP('p-'.$page->now_page)); ?><!--"><i></i></span>-->
	</td>
	<?php }?>
	<td class="ks-head-el">
	 	<i onclick="choiceClick(this)" class="iconfont icon-more"></i>
		<div class="ks-head-content ks-head-content-pc w100">
			<ul class="opeart">
				<?php if (check_power1($this->userinfo,'exam','2')) {?>
				<li>
					<a onclick="top.KTJ_RouteJump('/exam/addlist?paperId=<?php echo $v['paperid'];?>')" href="<?php echo 'https://'.$info['domain'].''.$v['paperid'];?>">编辑</a>
				</li>
				<?php }?> 
				<li >
					<a href="javascript:void(0);" onclick="Confirm('是否删除此试卷？该操作不可逆!','<?php echo M_URL($this->AppName.'/Index','delPaper',$v['paperid'],GP('')); ?>')">删除</a>
				</li>

				<li >
					<a onclick="top.KTJ_RouteJump('/exam/MarkList?paperId=<?php echo $v['paperid'].'&exam_type='.$v['exam_type'];?>')">成绩</a>
				</li>
				<li >
					<a onclick="top.KTJ_RouteJump('/addcertificate?infoid=<?php echo $v['paperid'].'&type=1';?>')">设置证书</a>
				</li>
			</ul>
		</div>
	</td>
</tr>
<?php }?>
					</tbody>
				</table>
		   <?php echo NoC($paper);?>
			<!-- /table-->
	 </form>
		<input type="hidden" name="batch" id="batch1" />
		<!--footer-->
		<?php if(isset($setting[0])&&$setting[0]==1&&!empty($paper)){?>
			<div class="ks-bom clearfix">
				<div class="fl">
				    <label class="mr20 fl"><input type="checkbox" class="select-checks selectAll" >全选</label>
					<button type="button"  class="ks-heade-button mr10"  onclick="submitform(1)" ><i class="iconfont icon-shanchu1"></i></button>
				</div>
				<div class="fr">
					<?php echo $page->show(3); ?>
				</div>
			</div>
		<!-- /footer-->
		  <?php }?>
	</div>
<!--//ks-wbox-->
<script src="<?php echo UOOT;?>/Public/common/js/module.js?<?php echo echoHash();?>"></script>
<script>
module.require(['$','backstage'],function(){
	$('.add-serch-btn').click(function(){
	var $target = $('#keyword');
	($target.parent().css('display') == 'none') ? $target.parent().css({"display":"block"}) && $(this).css({"borderColor":"#476dbe","color":"#476dbe"}) : $target.parent().css({"display":"none"}) && $(this).css({"borderColor":"#dedede","color":"#5e6062"})
	});
	$('.link-switch').each(function(){
		setLinkSwitch(this)
	})
})
function submitform(type){
	inspectionCheckBox('paperid[]',function(){
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
}
</script>
</body>
</html>