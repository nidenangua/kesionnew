<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit">
<title>教师管理</title>
<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
</head>
<body class="ks-wrap">
<!--new home-->
<div class="ks-wbox bRadius10">
	<!--header-->
	<div class="ks-head-box">
		<h3 class="ks-head-title">
			教师管理
			<div class="fr">	
					<!--<a class="ks-setting-icon fl ml10" onClick="appSetUp({title:'应用设置',type:'app',appid:<?php echo $this->appid; ?>,wxid:<?php echo $this->wxid; ?>})"><i class="iconfont icon-setting"></i></a>	-->
								<a class="ks-setting-icon fl ml10" target="_blank"  href="<?php echo MY_FULLDOMAIN;?>/home/help#anchor63"><i class="iconfont icon-qm" ></i></a>											
			</div>		
		
		</h3>
	</div>
	<!--header-->
	
	<!--widget-->
	<div class="ks-head-widget clearfix">
			<div class="fl">
				<div class="ks-search-box">								
						<!--搜索框组件-->
						<select class="w150 inputText bRadius5 fl" id="keytype">
							<!--<option value="1" <?php if($keytype==1){echo 'selected="selected"';} ?>>用户账号</option>-->
	 						<option value="2" <?php if($keytype==2){echo 'selected="selected"';} ?>>教师名称</option>
					  	</select>
						<div class="ks-top-search fl">
							<form target="hidframe"  class="fr">
								<input type="text" class="sc-text" name="searchText" id="keyword"  value="<?php if(isset($keyword)) echo $keyword; ?>">
				                <button type="submit" class="ks-head-search" onClick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL($this->AppName.'/Index','index'); ?>','<?php echo URL_MODEL;?>')"><i class="iconfont icon-sousuo"></i></button>  
				           </form>
						</div>
					<!--搜索框组件-->
				</div>	
			</div>	
			<div class="fr">
				<ul class="ks-head-choice">
					<li>
					<div class="ks-head-el">
						<button class="ks-heade-button ks-head-primary" type="button" onclick="choiceClick(this)"><i class="icon-filter-2 iconfont "></i></button>
						<div class="ks-head-content ks-head-content-pr w400">
							<ul class="screen">
								<!--<li>
								<span>审核状态：</span>
								<div>
<a href="<?php echo M_URL($this->AppName.'/Index','','',GP("status-3")); ?>" class="<?php if($status == 3){ echo 'choice-active';}?>">不限</a>
<a href="<?php echo M_URL($this->AppName.'/Index','','',GP("status-1")); ?>" class="<?php if($status == 1){ echo 'choice-active';}?>">已审核</a>
<a href="<?php echo M_URL($this->AppName.'/Index','','',GP("status-0")); ?>" class="<?php if($status == 0){ echo 'choice-active';}?>">未审核</a>
								</div>
								</li>-->
								<li>
								<span>管理团队：</span>
								<div>
<a href="<?php echo M_URL($this->AppName.'/Index','','',GP("powertype-3")); ?>" class="<?php if($powertype == 3){ echo 'choice-active';}?>">不限</a>
<a href="<?php echo M_URL($this->AppName.'/Index','','',GP("powertype-1")); ?>" class="<?php if($powertype == 1){ echo 'choice-active';}?>">是</a>
<a href="<?php echo M_URL($this->AppName.'/Index','','',GP("powertype-0")); ?>" class="<?php if($powertype == 0){ echo 'choice-active';}?>">否</a>
								</div>
								</li>
							</ul>
						</div>
					</div>
					</li>
				
					<li>
					<div class="ks-head-el">
						<a class="ks-heade-button ks-head-primary"  onmousedown="return checkpower({'version':'<?php echo checkIsVipModule($this->wxid,11,false,true);?>'})"  href="<?php echo M_URL($this->AppName.'/Index','addUsers','',GP("appid-$this->appid,usertype-$usertype")); ?>" ><i class="icon-jiahao iconfont "></i>添加教师</a>
					</div>
					</li>
				</ul>
			</div>
	</div>
	<!--/widget-->
	<form target="hidframe"  action="<?php echo M_URL($this->AppName.'/Index','bathdeluser','',GP("usertype-$usertype,p-$page->now_page"));  ?>" method="post" id="myform">
	<!--table-->
	<table class="ks-table">
		<thead>
		<tr>
			<td style="width: 30px;">选择</td>
			<td>头像</td>
			<td>姓名</td>
			<td>账号类型</td>
			<td>职称</td>
			<td>电子邮箱</td>
			<td>操作</td>
		</tr>
		</thead>
		<tbody>
		<?php foreach($UsersAll as $k=>$v){ ?>
		<tr>
			<td><input type="checkbox" class="select-checks" name="userid[]" value="<?php echo $v['userid'];?>"></td>
			<td><div style="width:60px;height:60px;background:url(<?php echo !empty($v['head'])?Img($v['head']):nopic(8);?>) no-repeat center;background-size:cover;position: absolute;left: 50px;top: 0;"></div></td>
			<td style="height: 45px;"><?php echo Field($v['name']);?></td>
			<td><?php echo $v['powertype']==0?'仅展示':'管理员' ;?></td>
			<td><?php echo Field($v['position']); ?></td>
			<td><?php echo Field($v['email']); ?></td>

			<td class="ks-head-el">
			 	<i onclick="choiceClick(this)" class="iconfont icon-more"></i>
				<div class="ks-head-content ks-head-content-pc w100">
					<ul class="opeart">
						<li>
						<a href="<?php echo M_URL($this->AppName.'/Index','editUsers',$v['userid'],GP("usertype-$usertype,p-$page->now_page")); ?>">编辑</a>						
						</li>	
						
						<!--<li>
                            <a href="<?php echo M_URL($this->AppName.'/Index','enrolment',$v['userid'],GP("usertype-$usertype,p-$page->now_page")); ?>">排班</a></li>
						-->
						<li><a href="javascript:Confirm('是否删除此学员？该操作不可逆!','<?php echo M_URL($this->AppName.'/Index','deluser',$v['userid'],GP("usertype-$usertype")); ?>')">删除</a>
						</li>
					</ul>
				</div>
			</td>
		</tr>
		<?php }?>
		</tbody>
	</table>
	<!--/table-->
	<?php echo NoC($UsersAll);?>
	<!--footer-->
	<?php if(!empty($UsersAll)){?>
	<input type="hidden" name="batch" id="batch1" />
	<div class="ks-bom clearfix">
		<div class="fl">
			<label class="mr20 fl"><input type="checkbox"  class="select-checks selectAll" >全选</label>
			<button type="button" class="ks-heade-button mr10" onclick="submitform(1)"><i class="iconfont icon-shanchu1"></i></button>	    
	        <!-- <button type="submit" class="ks-heade-button mr10" onclick="submitform(2)" >批量审核</button>
	        <button type="submit" class="ks-heade-button" onclick="submitform(3)" >取消审核</button> -->
		</div>
		<div class="fr"><?php echo $page->show(3);?></div>
	</div>
	<?php }?>
	<!--/footer-->
	</form>
	
</div>
<script src="<?php echo UOOT;?>/Public/common/js/module.js?<?php echo echoHash();?>"></script>
<script>
module.require(['$','backstage','nicescroll'],function(){
	loadScorllJs();
	$('.link-switch').each(function(){
		setLinkSwitch(this)
	})
});
function submitform(type){
	inspectionCheckBox('userid[]',function(){
		$('#batch1').val(type);
		if(type===1){
			top.popup.confirm('确认要删除所选项吗？',{
				determine:function(){$('#myform').submit();}
			})
		}else{$('#myform').submit();}
	})
}

</script>
</body>
</html>