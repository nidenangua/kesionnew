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
				<h3 class="ks-head-title">社群管理
				<div class="fr">
				
					<a class="ks-setting-icon fl ml10" target="_blank"  href="<?php echo MY_FULLDOMAIN;?>/home/help#anchor110"><i class="iconfont icon-qm" ></i></a>
				</div>
				</h3>
			</div>
            <!--header-->
				<!--widget-->
			<div class="ks-head-widget clearfix">
				<div class="fl">
					<form target="hidframe">
					<div class="ks-search-box">
						
						 <select class="w150 inputText bRadius5 fl" id="keytype">
					             <option value="1" <?php if($keytype==1) echo "selected"; ?>>标题</option>
								 <option value="2" <?php if($keytype==2) echo "selected"; ?>>建立者</option>
						 </select>
						<div class="ks-top-search fl" >
							<input type="text" class="sc-text" name="searchText" id="keyword"  value="<?php if(isset($keyword)) echo $keyword; ?>"> 		<button type="submit" class="ks-head-search" onClick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL($this->AppName.'/Index','index'); ?>','<?php echo URL_MODEL;?>')"><i class="iconfont icon-sousuo"></i></button>
						</div>
						
					</div>  
					
					</form>
				</div>				
					<div class="fr">
						<ul class="ks-head-choice">
						<li>
							<div class="ks-head-el">
								<button class="ks-heade-button ks-head-primary" type="button" onClick="choiceClick(this)"><i class="icon-filter-2 iconfont "></i></button>
									<div class="ks-head-content ks-head-content-pr w300">
									<ul class="screen">
										<li>
											<span>社群状态：</span>
											<div>
												<a href="<?php echo M_URL($this->AppName.'/Index','index','',GP("status-3,appid-$this->appid",true)); ?>" <?php if($status==3)echo 'class="choice-active"';?>>不限</a>
												<a href="<?php echo M_URL($this->AppName.'/Index','index','',GP("status-1,appid-$this->appid",true)); ?>" <?php if($status==1)echo 'class="choice-active"';?>>开放</a>
												<a href="<?php echo M_URL($this->AppName.'/Index','index','',GP("status-0,appid-$this->appid",true)); ?>" <?php if($status==2)echo 'class="choice-active"';?>>关闭</a>
											</div>
										</li>
									</ul>
								</div>
							</div>
						</li>
						
						<li>
							<div class="ks-head-el">
								<a class="ks-heade-button ks-head-primary" href="<?php echo M_URL($this->AppName.'/Index','addTeam','',GP('')) ?>"  onclick="return checkpower({'version':'<?php echo checkIsVipModule($this->wxid,35,false,true);?>'})">	<i class="iconfont icon-jiahao"></i>添加社群</a>
		
							</div>
						</li>
						<?php if(iscategory($this->wxid,$this->appid)){?>
						<li>
							<div class="ks-head-el">
<a class="ks-heade-button ks-head-primary" href="<?php echo M_URL('category/Index','index2','',GP('appid-2'));?>">分类管理</a>
							</div>
						</li>
						<?php }?>	
						</ul>
					</div>
				</div>
			
			<!--/widget-->
				
			<form target="hidframe" id="myform" action="<?php echo M_URL($this->AppName.'/Index','batch','',GP('db-1,p-'.$page->now_page)) ?>" method="post">
	<!--table-->
		
		<table width="100%" cellpadding="0" cellspacing="0" border="0" class="ks-table" >
            <thead>
                <tr>
                	<th>选择</th>
                    <th style="text-align: left;">社群名称</th>
                    <th>入群条件</th>
                    <th>成员数</th>
					<th>动态数</th>
					<th>销量</th>
                    <th>添加时间</th>
                    <th>分享</th>
					<?php if (check_power1($this->userinfo,'team','updatestatus')) {?>
					<th>开放状态</th>
					<?php }?>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($values as $k=>$v){?>
            <tr>
            <td style="width: 30px;"> <input type="checkbox" class="select-checks" name="check[]" value="<?php echo $v['id'];?>"></td>
            	 <td style="text-align: left;"><a class="ks-box" href="<?php echo wx_Url($this->wxid).'/?f=m#/group/'.$v['id'];?>" target="_blank"><div style="width:60px;float: left;height:60px;background:url(<?php echo !empty($v['defaultpic'])?Img($v['defaultpic']):nopic(8);?>) no-repeat center;background-size:cover;position: absolute;left: 0;top: 0;"></div> <p style="position:relative;top:10px;margin-bottom:10px"><?php echo Field($v['title']);?></p><?php echo $v['is_vip']==1?'<p style="color:#e5412c">会员卡折扣</p>':'';?>  </a></td>
            	 <td><?php echo $v['typeName'];?></td>
            	 <td><?php echo $v['member_num'];?></td>
				 <td><?php echo $v['topic_num'];?></td>
				 <td><?php echo $v['soldnum'];?></td>
                 <td><?php echo date('Y-m-d H:i:s',$v['create_time']);?></td>
            	 <td>
					<a href="javascript:addTypeChange('<?php echo M_URL($this->AppName.'/Index','share',$v['id'],GP(''));?>','700px','400px',{title:'推广'});"><i class="iconfont icon-fenxiang"></i></a>
				 </td>
				<?php if (check_power1($this->userinfo,'team','updatestatus')) {?>
            	 <td>
            	 	<span class="link-switch<?php if($v["status"]==1){ echo ' open'; }?>" data-off="<?php echo M_URL($this->AppName.'/Ajax','updatestatus',$v['id'],GP('db-1')); ?>" data-open="<?php echo M_URL($this->AppName.'/Ajax','updatestatus',$v['id'],GP('db-1')); ?>"><i></i></span>
            	 </td>
				<?php }?>
            	 <td class="ks-head-el">
				 	<i onClick="choiceClick(this)" class="iconfont icon-more"></i>
					<div class="ks-head-content ks-head-content-pc w100">
						<ul class="opeart">
							<?php if (check_power1($this->userinfo,'team','1')) {?>
							<li><a href="javascript:;" onClick="top.KTJ_RouteJump('/group/<?php echo $v['id'];?>')">管理</a></li>
							<?php }?>
							<li>
								<a href="<?php echo M_URL($this->AppName.'/Index','editTeam',$v['id'],GP('p-'.$page->now_page));?>">编辑</a>
							</li>
							<li >
								<a href="<?php echo wx_Url($this->wxid).'/?f=m#/group/'.$v['id'];?>" class="user-listh" target="_blank">预览</a>
<!--								--><?php //if($GLOBALS['_DoM']['tempPid']==15){?>
<!--								<a href="--><?php //echo '/h5market/Minewsdetail?id='.$v['id'];?><!--" target="_blank" class="user-listh">-->
<!--								--><?php //}else{?>
<!--								<a href="http://--><?php //echo $info['domain'].'/news/view/'.$v['id'];?><!--" class="user-listh" target="_blank">	-->
<!--								--><?php //}?><!--预览-->
<!--								</a>-->
							</li>
							<li>
								<a href="javascript:void(0);" onclick='Confirm("是否删除该组？该操作不可逆","<?php echo M_URL($this->AppName.'/Index','delete',$v['id'],GP('db-1'));?>")'>删除</a>
							</li>
						</ul>
					</div>
				</td>
            </tr>
			<?php }?>
            </tbody>
        </table>
          </form> 
		
	<!--/table-->			
      <?php echo NoC($values);?>
      <?php if(!empty($values)){?>
      	<input type="hidden" name="batch" id="batch1" />
		<div class="ks-bom clearfix">
			<span class="fl">
				<label class="mr20 fl"><input type="checkbox" class="select-checks selectAll">全选</label>
				<button class="ks-heade-button mr10" onClick="submitform(1)"><i class="iconfont icon-shanchu1"></i></button>
<!--				<button class="ks-heade-button mr10" onClick="submitform(2)">批量审核</button>-->
<!--				<button class="ks-heade-button " onClick="submitform(3)">取消审核</button>-->
			</span>
			<div class="fr"><?php echo $page->show(3); ?></div>
			
		</div>
	<?php }?>
<!--	--><?php //}else{?>
        <!--
		<div class="unopened">
	 	您还没有启用新闻功能！
	 	<a class="ks-bt bt-pue" href="javascript:void(0);" onClick="appSetUp({title:'应用设置',type:'app',appid:<?php echo $this->appid;?>,wxid:<?php echo $this->wxid;?>})">立即开启</a>
	</div>-->
<!--	--><?php //}?>
</div>
<script src="<?php echo UOOT;?>/Public/common/js/module.js?<?php echo echoHash();?>"></script>
<script>
module.require(['$','backstage','nicescroll'],function(){
	loadScorllJs();
	$('.link-switch').each(function(){
		setLinkSwitch(this)
	})
})	
function submitform(type){
	inspectionCheckBox('check[]',function(){
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
function attributeSelect(url){    
	window.location.href=''+url;
}
</script>
</body>
</html>