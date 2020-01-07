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
	<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/popup/css/kesion.popup.css" rel="stylesheet">
	<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/dragh5/css/frame.css" rel="stylesheet" type="text/css" />
	<script>
		var uoot = '<?php echo UOOT;?>';
		var H5Path = '<?php if(empty($setting)){echo UOOT.$h5['url'].'index.html';}else{ echo UOOT.$setting['h5index'];} ?>';
		var editorUrl = '<?php echo M_URL($this->AppName.'/Index','addeditor','',GP(""));?>';
		var editImageUrl = '<?php echo M_URL($this->AppName.'/Index','editgameImg','',GP(""));?>';
		var selectBgMusicUrl = '<?php echo M_URL($this->AppName.'/Index','addmusic','',GP(""));?>';
		var awardLmitTime = {
			start:'<?php echo date('Y-m-d H:i:s') ?>',
			end:'<?php echo date('Y-m-d H:i:s',strtotime("+7 day"));?>'
		}
		var getCourseOrClassRewardOptionUrl = '<?php echo M_URL('voucher/Index','getinfo','',GP(''));?>';
		var getCampusInfoUrl = '<?php echo M_URL($this->AppName.'/Index','campus','',GP(''));?>';
		var H5Staus = '<?php echo $staus ?>'; //0是添加 1是编辑
	</script>
	<?php if($h5['ismode']==2){ ?>
	<script>
		var prevEditArray = {
			rewards:'<?php echo json_encode($rewards); ?>', //奖励数组
			rewardNumber:'<?php echo json_encode($rewardNumber); ?>', //奖励数量数组
			rewardsetting:'<?php echo json_encode($Rsetting); ?>'//奖励其他设置
		}
	</script>
	<?php }else{ ?>
	<script>
		var prevEditArray = {
			rewards:'<?php echo json_encode($rewards); ?>', //奖励数组
			rewardNumber:'<?php echo json_encode($rewardNumber); ?>' //奖励数量数组
		}
	</script>
	<?php } ?>
	<style type="text/css">
		.col-name{width:200px!important;}
		.col-name input{width:90px;}
		.lanTitle{width:542px;}
		.lanTitle span{float: left;}
		.lanTitle button{border: solid 1px #5E5E5E;color: #5E5E5E;background:#FFFFFF;float: right;padding: 3px 8px;border-radius: 3px;} 
		.del{cursor: pointer;}
	</style>
</head>
<body> 

<div class="ks-wrap">

	
	
	<iframe src="about:blank" name="hidframe" id="hidframe" style="display:none"></iframe>
	<div class="bRadius10 bg-white">
		 <!--header-->
			     <div class="ks-head-nav" style="padding:25px 25px 0px 25px">
					<!--标题-->
					 <a href="javascript:history.go(-1);">活动模板</a><span><em>/</em><?php if(empty($h5info)){ echo '创建活动';}else{echo '编辑活动';}?></span>
			<!--标题-->
			</div>
		 <!--header-->
	
	<div class="h5-frame " style="margin-top: 0;">
		
		
		<div id="iphone">
			<div class="h5-bg-button" id="h5Bg">编辑背景</div>
			<div class="h5-name" id="h5Name"><?php if(!empty($h5info)){ echo $h5info['name'];}else{ echo $h5['h5name']; }?></div>
			<iframe name="h5" id="h5"></iframe>
		</div>
		<?php if(empty($setting)){ ?>
			<form target="hidframe" id="myform" action="<?php echo M_URL($this->AppName.'/Index','AddGame','',GP(""));?>" method="post" enctype="multipart/form-data">
		<?php }else{?>
			<form target="hidframe" id="myform" action="<?php echo M_URL($this->AppName.'/Index','doedittGame',$id,GP(""));?>" method="post" enctype="multipart/form-data">
			<input type="hidden" name="h5index" value="<?php echo $setting['h5index']; ?>" />
			<input type="hidden" name="h5id" value="<?php echo $h5id; ?>" />
		<?php }?>
			<input type="hidden" name="id" value="<?php echo $id;?>" />
			<input type="hidden" name="collectInfo" value="<?php if(!empty($setting)){echo $setting['collectInfo']; } ?>"/>
			<textarea name="h5Content" id="h5Content" style="display: none;"></textarea>
			<div class="h5-tab" id="h5Tab">
				<input type="button" value="<?php if(empty($h5info)){ echo '确认创建';}else{echo '确认修改';}?>" class="ks-bt bt-pue" onclick="confirmCreation()" />
				<ul class="clearfix">
					<li class="active" onclick="setH5TabSlide(this,'#h5TabBox')">基本配置</li>
					<li onclick="setH5TabSlide(this,'#h5TabBox');getFloorList();">页面展示</li>
					<?php if($h5['ismode']==2){ ?>
						<?php if($h5['modetype']==1){ ?>
						<li onclick="setH5TabSlide(this,'#h5TabBox')">拼团配置</li>
						<?php }elseif($h5['modetype']==2){ ?>
						<li  onclick="setH5TabSlide(this,'#h5TabBox')">砍价配置</li> 
						<?php }elseif($h5['modetype']==3){ ?>
						<li  onclick="setH5TabSlide(this,'#h5TabBox')">钓鱼配置</li> 
						<?php }elseif($h5['modetype']==4){ ?>
						<li  onclick="setH5TabSlide(this,'#h5TabBox')">优惠配置</li> 
						<?php } ?>
					<?php }else{ ?>
						<li onclick="setH5TabSlide(this,'#h5TabBox')">奖项设置</li>
					<?php } ?>
					<li onclick="setH5TabSlide(this,'#h5TabBox')">校区配置</li>
					<li onclick="setH5TabSlide(this,'#h5TabBox')">转发设置</li>
				</ul>
			</div>

			<div class="h5-tab-box" id="h5TabBox">
				<div class="tab-box" >
					
					<div class="form-row clearfix" mark="name">
	              		<span class="name"><i class="form-star">*</i>活动名称</span>
	              		<div class="form-limit" limit="50">
		              		<input type="text" value="<?php if(!empty($h5info)){ echo $h5info['name'];}else{ echo $h5['h5name'];}?>" class="form-textbox" name="name" onkeyup="setH5Name(this.value)">
	              		</div>
					</div>
					
					<div mark="countdown">
						<div class="form-row clearfix">
		              		<span class="name"><i class="form-star">*</i>活动开始时间</span>
			              	<input id="startTime" type="text" value="<?php if(!empty($h5info)){ echo date('Y-m-d H:i:s',$h5info['startime']);}else{ echo date('Y-m-d H:i:s');}?>" name="startime" required readonly class="w300 form-textbox">   		
						</div>
						<div class="form-row clearfix">
		              		<span class="name"><i class="form-star">*</i>活动结束时间</span>
			              	<input id="endTime" type="text" value="<?php if(!empty($h5info)){ echo date('Y-m-d H:i:s',$h5info['endtime']);}else{ echo date('Y-m-d H:i:s',strtotime("+7 day"));}?>" name="endtime" required readonly class="w300 form-textbox">
						</div>
					</div>
					<div class="form-row" mark="participantsNumber">
						<span class="name"><i class="form-star">*</i>参与人数</span>
						<div class="clearfix"><label for="participantsNumber0" onclick="setParticipantsNumberDisplay(false)"><input type="radio" value="0" name="addparticipantsNumber" id="participantsNumber0" <?php if(!empty($setting)){if($setting['addparticipantsNumber'] == 0){ echo 'checked';}}?>/>隐藏</label><label for="participantsNumber1" onclick="setParticipantsNumberDisplay(true)"><input type="radio" value="1" <?php if(!empty($setting)){if($setting['addparticipantsNumber'] == 0){ echo 'checked';}}?> name="addparticipantsNumber" id="participantsNumber1" checked />显示</label>
							
						</div>
						<!-- <div <?php if(!empty($setting)){if($setting['addparticipantsNumber'] == 0){ echo 'style="display: none;"';}else{echo 'style="display:block;"';}}?> class="form-info" id="participantsNumberBox">在实际参与人数上再加上 <input type="number" name="participantsNumber" value="<?php if(!empty($setting)){ echo $setting['participantsNumber'];}else{ echo '0';}?>" class="form-textbox w80" /> 人</div> -->
					</div>
					
					<div class="form-row">
						<span class="name"><i class="form-star">*</i>参与人数限制</span>
						<div class="clearfix">
							<label for="numberLimit0" onclick="getId('numberLimitBox').style.display='none'"><input type="radio" value="0" name="numberLimit" id="numberLimit0" <?php if(!empty($setting)){if($setting['numberLimit'] == 0){ echo 'checked';}}else{ echo 'checked';}?> />不限制</label><label for="participantsLimit1" onclick="getId('numberLimitBox').style.display='block'"><input type="radio" value="1" name="numberLimit" id="numberLimit1" <?php if(!empty($setting)){if($setting['numberLimit'] == 1){ echo 'checked';}}?> />限制</label>
							<span id="numberLimitBox" <?php if(!empty($setting)){if($setting['numberLimit'] == 0){ echo 'style="display: none;"';}else{ echo 'style="disply:block;"';}}else{ echo 'style="display:none;"';}?>><input type="number" value="100" name="numberLimitValue" class="form-textbox w80" /> 人</span>
						</div>
					</div>
					<div class="form-row">
	              		<span class="name"><i class="form-star">*</i>活动参与次数</span>
		              	<div class="form-info"><input type="text" class="form-textbox w80" value="<?php if(empty($h5info)){ echo '1';}else{ echo $h5info['number'];} ?>" name="number"> 次</div>
	              		
					</div>
					<div class="form-row" style="display: none;">
						<span class="name"><i class="form-star">*</i>搜集信息</span>
						<div class="clearfix">
							<label for="collectInfoSwitch0" onclick="getId('collectInfoBox').style.display='none'"><input type="radio" value="0" name="collectInfoSwitch" id="collectInfoSwitch0" <?php if(!empty($setting)){ if($setting['collectInfoSwitch'] == 0){ echo "checked";}}else{ echo 'checked';} ?> />关闭</label><label for="collectInfoSwitch1" onclick="getId('collectInfoBox').style.display='block'"><input type="radio" value="1" name="collectInfoSwitch" id="collectInfoSwitch1" <?php if(!empty($setting)){ if($setting['collectInfoSwitch'] == 1){ echo "checked";}} ?> />开启</label>
							
						</div>
					</div>
					<div class="form-row" id="collectInfoBox" <?php if(!empty($setting)){ if($setting['collectInfoSwitch'] == 0){ echo "style='display:none'";}else{ echo "style='display:block'";}}else{ echo "style='display:none'";} ?>>
	              		<span class="name">选择搜集的信息</span> 
		              	<div class="customize-list" id="customizeList">
		              		<ul>
		              			<li class="clearfix list-header">
		              				<div class="col-checkbox">开启</div>
		              				<div class="col-checkbox">必填</div>
		              				<div class="col-name">名称</div>
		              				<div class="col-type">类型</div>
		              				<div class="col-default">默认值</div>
		              			</li>
		              			<li class="clearfix">
		              				<div class="col-checkbox"><input type="checkbox" class="open" checked disabled /></div>
		              				<div class="col-checkbox"><input type="checkbox" class="required" checked disabled /></div>
		              				<div class="col-name"><input type="text" value="姓名" placeholder="姓名" class="form-textbox info-name" /></div>
		              				<div class="col-type">
		              					<select class="new-form info-type" disabled>
		              						<option value="0">单选框</option>
		              						<option value="1">多选框</option>
		              						<option value="2">下拉框</option>
		              						<option value="3" selected>单行文本</option>
		              						<option value="4">多行文本</option>
		              					</select>
		              				</div>
		              			</li>
		              			<li class="clearfix">
		              				<div class="col-checkbox"><input type="checkbox" class="open" checked disabled /></div>
		              				<div class="col-checkbox"><input type="checkbox" class="required" checked disabled /></div>
		              				<div class="col-name"><input type="text" placeholder="手机号码" value="手机号码" class="form-textbox info-name" /></div>
		              				<div class="col-type">
		              					<select class="new-form info-type" disabled>
		              						<option value="0">单选框</option>
		              						<option value="1">多选框</option>
		              						<option value="2">下拉框</option>
		              						<option value="3" selected>单行文本</option>
		              						<option value="4">多行文本</option>
		              					</select>
		              				</div>
		              				
		              			</li>
		              			<li class="clearfix">
		              				<div class="col-checkbox"><input type="checkbox" class="open" /></div>
		              				<div class="col-checkbox"><input type="checkbox" class="required" /></div>
		              				<div class="col-name"><input type="text" placeholder="信息项名称" class="form-textbox info-name" /></div>
		              				<div class="col-type">
		              					<select class="new-form info-type" onchange="infoSelectChange(this)">
		              						<option value="0">单选框</option>
		              						<option value="1">多选框</option>
		              						<option value="2">下拉框</option>
		              						<option value="3" selected>单行文本</option>
		              						<option value="4">多行文本</option>
		              					</select>
		              				</div>
		              				<div class="col-default" style="display: none;"><input type="text" class="form-textbox info-defaults" placeholder="多个选项请用“|”隔开" /></div>
		              			</li>
		              			<li class="clearfix">
		              				<div class="col-checkbox"><input type="checkbox" class="open" /></div>
		              				<div class="col-checkbox"><input type="checkbox" class="required" /></div>
		              				<div class="col-name"><input type="text" placeholder="信息项名称" class="form-textbox info-name" /></div>
		              				<div class="col-type">
		              					<select class="new-form info-type" onchange="infoSelectChange(this)">
		              						<option value="0">单选框</option>
		              						<option value="1">多选框</option>
		              						<option value="2">下拉框</option>
		              						<option value="3" selected>单行文本</option>
		              						<option value="4">多行文本</option>
		              					</select>
		              				</div>
		              				<div class="col-default" style="display: none;">
		              					<input type="text" class="form-textbox info-defaults" placeholder="多个选项请用“|”隔开" />
		              				</div>
		              			</li>
		              			<li class="clearfix">
		              				<div class="col-checkbox"><input type="checkbox" class="open" /></div>
		              				<div class="col-checkbox"><input type="checkbox" class="required" /></div>
		              				<div class="col-name"><input type="text" placeholder="信息项名称" class="form-textbox info-name" /></div>
		              				<div class="col-type">
		              					<select class="new-form info-type" onchange="infoSelectChange(this)">
		              						<option value="0">单选框</option>
		              						<option value="1">多选框</option>
		              						<option value="2">下拉框</option>
		              						<option value="3" selected>单行文本</option>
		              						<option value="4">多行文本</option>
		              					</select>
		              				</div>
		              				<div class="col-default" style="display: none;">
		              					<input type="text" class="form-textbox info-defaults" placeholder="多个选项请用“|”隔开" />
		              				</div>
		              			</li>
		              		</ul>
		              	</div>
	              		
					</div>
					
				</div>
				
				
				<div class="tab-box" id="floorList" style="display: none;">
					
				</div>
				
				
				
				
				<div class="tab-box" style="display: none;">
					
					
					<?php if($h5['ismode']!=2){ ?>

					<!--奖项配置-->
					<div class="h5-awards">
						<div class="title"><label for="consolationAward"><input type="checkbox" id="consolationAward" />设置安慰奖</label>请设置活动需要派发的奖项</div>
						<div class="h5-awards-tab" id="h5AwardsTab">
							<div class="awardsUndulate"><span onclick="removeAwardsCode(getAwardsIndex)">-</span><span onclick="addAwardsCode()">+</span></div>
							<ul>
							</ul>
						</div>
						<div class="h5-awards-tabbox" id="h5AwardsTabbox">
							
						</div>
					</div>
					<?php }else if($h5['ismode']==2){ ?>
					<?php if($h5['modetype']==1){ ?>
					<div style="font-size: 14px;">
						<h4 style="display: inline-block;width: 200px;">拼团配置</h4>
						
						<input type="checkbox" name="team" value="" class="team" />设置拼团发起人奖励
					</div>
					
					
					
					<div class="form-row clearfix" mark="name">
	              		<span class="name"><i class="form-star">*</i>奖品类型</span>
	              		<div class="form-limit" limit="50">
		              		<div class="col-type">
              					<select id="rewardType" name="rewardType" class="new-form info-type" onchange="changeRad(this.value)">
              						<option value="6">优惠课程</option>
              						<option value="7">优惠班级</option>
              					</select>
              				</div>
	              		</div>
					</div> 
					
					 
					<div class="form-row clearfix" id="classSelect" mark="name">
	              		<span class="name"><i class="form-star">*</i><span class="listtype">班级选择</span></span>
	              		<div class="form-limit">
          					<select class="new-form info-type" id="infoid" name="infoid" onchange="changeIn(this.value)"></select>
          					原价： <span class="yuan"></span>元
	              		</div>
					</div>
					
					
					<input type="hidden" name="originalPrice" id="yun" value="" />
					<input type="hidden" name="infoname" id="infoname" value="" />
					
					<div class="form-row clearfix" mark="name">
	              		<span class="name"><i class="form-star">*</i>数量限制</span>
	              		<div class="form-limit" limit="50">
		              		<input type="number" id="rewardNum" name="rewardNum" value="1"  class="form-textbox w100p" onkeyup="reg(this)"> 个 
	              		</div>
					</div>
					 
					<div class="form-row clearfix" id="pintuan" mark="name" style="display: none;">
	              		<span class="name"><i class="form-star">*</i>拼团发起人奖励</span>
	              		<div class="form-limit" limit="50">
		              		<input type="number" value="0" name="teammoney"  class="form-textbox w100p teammoney" onkeyup="checkprice()"> 元
	              		</div>
					</div>
				
					
			
					<div class="form-row" id="collectInfoBox" style="display:block">
		              	<div class="customize-list">
		              		<ul id="level">
		              			<li>
		              				<div class="clearfix lanTitle">
				              			<span class="name">等级配置</span>
				              			<button type="button" id="addLe">增加级别</button>
				              		</div> 
		              			</li>
		              			<li class="clearfix">
		              				<div class="col-checkbox"><span class="level">等级一</span></div>
		              				<div class="col-name"><input type="number" value="3"  class="form-textbox info-name pinnum" name="rewardpeple[]" onkeyup="reg(this)"> 人拼团</div>
		              				<div class="col-name">拼成价 <input type="number" value="10" name="specialPrice[]" class="form-textbox info-name reprice"  onkeyup="reg(this)"> 元</div>
		              			</li>
		              			
		              		</ul>
		              	</div>
	              		
					</div>
					<?php }elseif($h5['modetype']==2){ ?>
					<div style="font-size: 14px;">
						<h4 style="display: inline-block;width: 200px;">砍价配置</h4>
					</div>
					
					
					
					<div class="form-row clearfix" mark="name">
	              		<span class="name"><i class="form-star">*</i>奖品类型</span>
	              		<div class="form-limit" limit="50">
		              		<div class="col-type">
              					<select id="rewardType" name="rewardType" class="new-form info-type" onchange="changeRad(this.value)">
              						<option value="9">优惠图文</option>
              						<option value="10">优惠音频</option>
              						<option value="11">优惠点播</option>
              						<option value="12">优惠直播</option>
              						<option value="13">优惠试卷</option>
              						<option value="7">优惠班级</option>
              					</select>
              				</div>
	              		</div>
					</div> 
					<input type="hidden" id="img1" value="" />
					 
					<div class="form-row clearfix" id="classSelect" mark="name">
	              		<span class="name"><i class="form-star">*</i><span class="listtype">知识点选择</span></span>
	              		<div class="form-limit">
          					<select class="new-form info-type" id="infoid" name="infoid" onchange="changeIn(this.value)"></select>
          					原价： <span class="yuan"></span>元
	              		</div>
					</div>
					
					
					<input type="hidden" name="originalPrice" id="yun" value="" />
					<input type="hidden" name="infoname" id="infoname" value="" />
					
					<div class="form-row clearfix" mark="name">
	              		<span class="name"><i class="form-star">*</i>数量限制</span>
	              		<div class="form-limit" limit="50">
		              		<input type="number" id="rewardNum" name="rewardNum" value="1"  class="form-textbox w100p"> 个 
	              		</div>
					</div>
					
					<div class="form-row clearfix" id="pintuan" mark="name">
	              		<span class="name"><i class="form-star">*</i>优惠价</span>
	              		<div class="form-limit" limit="50">
		              		<input type="number" value="0" name="specialPrice"  class="form-textbox w100p specialPrice" onkeyup="checkprice(this)"> 元
	              		</div>
					</div>
				
				
				
				
				
						
					<?php }elseif($h5['modetype']==3){ ?>
					
					<div class="h5-awards">
						<div class="h5-awards-tab" id="h5AwardsTab">
							<ul>
							</ul>
						</div>
						<div class="h5-awards-tabbox" id="h5AwardsTabbox">
							
						</div>
					</div>
					<?php }elseif($h5['modetype']==4){ ?>
					<div style="font-size: 14px;">
						<h4 style="display: inline-block;width: 200px;">优惠配置</h4>
					</div>
					
					
					
					<div class="form-row clearfix" mark="name">
	              		<span class="name"><i class="form-star">*</i>奖品类型</span>
	              		<div class="form-limit" limit="50">
		              		<div class="col-type">
              					<select id="rewardType" name="rewardType" class="new-form info-type" onchange="changeRad(this.value)">
              						<option value="4">优惠课程</option>
              						<option value="5">优惠班级</option>
              					</select>
              				</div>
	              		</div>
					</div> 
					<input type="hidden" id="img1" value="" />
					 
					<div class="form-row clearfix" id="classSelect" mark="name">
	              		<span class="name"><i class="form-star">*</i><span class="listtype">班级选择</span></span>
	              		<div class="form-limit">
          					<select class="new-form info-type" id="infoid" name="infoid" onchange="changeIn(this.value)"></select>
          					原价： <span class="yuan"></span>元
	              		</div>
					</div>
					
					
					<input type="hidden" name="originalPrice" id="yun" value="" />
					<input type="hidden" name="infoname" id="infoname" value="" />
					
					<div class="form-row clearfix" mark="name">
	              		<span class="name"><i class="form-star">*</i>数量限制</span>
	              		<div class="form-limit" limit="50">
		              		<input type="number" id="rewardNum" name="rewardNum" value="1"  class="form-textbox w100p"> 个 
	              		</div>
					</div>
					
					<div class="form-row clearfix" id="pintuan" mark="name">
	              		<span class="name"><i class="form-star">*</i>优惠价</span>
	              		<div class="form-limit" limit="50">
		              		<input type="number" value="0" name="specialPrice"  class="form-textbox w100p specialPrice" onkeyup="checkprice(this)"> 元
	              		</div>
					</div>
				
				
				
				

					
					<?php } ?>	
						
						
						
				<?php }?>		
						
				</div>
				
				
				
				
				<div class="tab-box" style="display: none;">
					<div class="form-row">
	              		<span class="name"><i class="form-star">*</i>显示校区</span>
		              	<div class="clearfix">
		              		<label for="displayCampus0" onclick="getId('campusSelect').style.display='none';setCampusInfo(true);"><input value="0" name="displayCampus" type="radio" id="displayCampus0" <?php if(!empty($setting)){ if($setting['displayCampus'] == 0){ echo 'checked';}} ?> />关闭</label>
		              		<label for="displayCampus1" onclick="getId('campusSelect').style.display='block';setCampusInfo(true);"><input value="1" name="displayCampus" type="radio" id="displayCampus1" <?php if(!empty($setting)){ if($setting['displayCampus'] == 1){ echo 'checked';}}else{ echo 'checked';} ?> />显示</label>
						</div>
						
					</div>
					<div class="form-row" id="campusSelect">
						<span class="name">选择校区</span>
						<input name="campus" type="hidden" value="<?php if(!empty($setting)){ echo $setting['campus'];} ?>" />
						
					</div>
					
				</div>
				<div class="tab-box" style="display: none;">
					
					<div class="form-row">
	              		<span class="name"><i class="form-star">*</i>转发标题</span>
		              	<div class="form-limit" limit="50">
		              		<input type="text" value="<?php if(!empty($setting)){ echo $setting['title'];}else{ echo $zd->item[0]['value'];} ?>" class="form-textbox" name="forwardingHeader">
	              		</div>
					</div>
					<div class="form-row">
	              		<span class="name"><i class="form-star">*</i>转发说明</span>
		              	<div class="form-limit" limit="120">
		              		<textarea class="form-textarea" name="forwardingInstructions"><?php if(!empty($setting)){ echo $setting['desc'];}else{ echo $zd->item[1]['value'];} ?></textarea>
	              		</div>
					</div>
					<div class="form-row clearfix">
	              		<span class="name"><i class="form-star">*</i>封面图片</span>
	              		<div id="forwardingImgBox" class="fl"><img src="<?php if(!empty($setting)){ echo $setting['img'];}else{ echo $h5['ico'];} ?> " /></div>
		              	<input type="button" value="上传图片" class="ks-bt bt-pur fl" style="margin:25px 10px 0 10px" onclick="selectForwardingImg('<?php echo M_URL('Index','imageslist','',GP('type-other,name-forwardingImg',true));?>');" />
		              	<div class="fl" style="line-height: 80px;">图片宽度大小：300×300以上</div>
		              	<input type="hidden" name="forwardingImg" id="forwardingImg" value="<?php if(!empty($setting)){ echo $setting['img'];}else{ echo $h5['ico'];} ?>" />
		              	
					</div>
				</div>
			</div>

		</form>

	</div>
</div>
</div>
<?php if($h5['ismode']==2){ ?>
	<?php if($h5['modetype']==1){ ?>
	<script src="<?php echo UOOT;?>Public/dragh5/js/config.js" load="jquery,laydate,popup,frame,tourdiy" id="config" charset="UTF-8"></script>
	<?php }elseif($h5['modetype']==2){ ?>
	<script src="<?php echo UOOT;?>Public/dragh5/js/config.js" load="jquery,laydate,popup,frame,cut" id="config" charset="UTF-8"></script>
	<?php }elseif($h5['modetype']==3){ ?>
	<script src="<?php echo UOOT;?>Public/dragh5/js/config.js" load="jquery,laydate,popup,frame,fish" id="config" charset="UTF-8"></script>
	<?php }elseif($h5['modetype']==4){ ?>
	<script src="<?php echo UOOT;?>Public/dragh5/js/config.js" load="jquery,laydate,popup,frame,sale" id="config" charset="UTF-8"></script>
	<?php } ?>
<?php }else{ ?>
	<script src="<?php echo UOOT;?>Public/dragh5/js/config.js" load="jquery,laydate,popup,frame,award" id="config" charset="UTF-8"></script>

	<script>
		function frameLoadCallBack(){
			if(H5Staus == 0){
				//奖励赋值对象
				setPrizeContent();
			}
		}
	</script>
	
<?php } ?>
</body>

</html>
