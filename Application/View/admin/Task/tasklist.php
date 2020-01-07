<!DOCTYPE html>

<html>

<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="renderer" content="webkit">
	<link rel="shortcut icon" href="favicon.ico">
		<link href="<?php echo UOOT;?>Public/admin/css/form.css" rel="stylesheet">	
	<link href="<?php echo UOOT;?>Public/admin/css/html5.css" rel="stylesheet">
	<link href="<?php echo UOOT;?>Public/admin/css/general.css" rel="stylesheet">
	<link href="<?php echo UOOT;?>Public/admin/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/admin/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
	<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
	<style>
	.tempstyle{z-index: 1000;position: fixed;flex-direction: column;align-items: center;justify-content: center;width: 100%;top: 0;height: 100%;}
	</style>
</head>
<body class="gray-bg">
	<div class="wrapper" style="margin-top:35px">
		<div class="row">
			<div id="manage_top" class="menu_top_fixed  p15 height73">
				<div class="ibox-title">
					<div class="clearfix" style="float: left;">
						<h3 class="fl" style="float: left;">&nbsp;&nbsp;任务系统管理</h3>
					</div>
					<div class="clearfix" style="float: left;margin-left: 56px;">
						<a class="btn btn-default btn-rounded " href="<?php echo M_URL('Task','showadd','',GP(''));?>" style="cursor:pointer" o>创建新任务</a>
					</div>
					<!--<div class="clearfix" style="float: left;margin-left: 56px;">
						<span style="cursor:pointer" onclick="addTypeChange('<?php echo M_URL('home/Ico','massage','',GP('p-'.$now_page.',backtype-2,allwx-2'));?>','940px','660px',{title:'群发to网校',type:'top'})">群发to网校</span>
					</div>-->
					<div class="fr">
						<div class="fl ks-top-search">
						</div>
					</div>
				</div>
			</div>
		</div>
		<div id="ksBoxContent">
			<div style="padding: 40px 0px;">
				<div class="H5-gameListScreen">
					<ul class="H5-gameOpt clearfix">
						<li>
							<div class="shaixuan clearfix">
								
							</div>
						</li>
						<li class="fr gameScreen" style="margin-right: 20px;"></li>
					</ul>
				</div>
				<div class="H5-gameListConts school-online">
					<form action="<?php echo M_URL('Task','alldel','',GP('')) ?>"  method="post" id='myform'>
						<div class="Created-push" id="ksBoxContent" style="padding:15px;">
							<table class="ks-table" id="tables">
								<thead>
									<tr style="background: #EEEEEE;">
										<th  class="fl" >
											选择
										</th>
										<th  style="text-align: left;">任务名称</th>
										<th  style="text-align: left;">任务内容</th>
										<th >奖励方式</th>
										<th>固定金额</th>
										<th>最小金额</th>
										<th>最大金额</th>
										<th class="shaixuan">
											<?php if($adddate == 2){?>
												<a class="desc" href="<?php echo M_URL('Task','development','',GP("adddate-1")); ?>"  style="float: none;"><i class="desc-i" style="top: -1px;"></i>发布时间</a>		
											<?php }else{ ?>
												<a class="desc" href="<?php echo M_URL('Task','development','',GP("adddate-2")); ?>" style="float: none;"><i class="asc-i" style="top: -1px;"></i>发布时间</a>		
											<?php }?>
										</th>
										<th>操作</th>	
									</tr>
								</thead>
								<tbody>
									<?php foreach($values as $k=>$v){ ?>
									<tr>
										<td class="fl">
											<input type="checkbox" class="select-checks" name="id[]" value="<?php echo $v['id']; ?>">
										</td>
										<td style="text-align: left;"><?php echo $v['name']; ?></td>
										<td style="text-align: left;"><?php echo $v['content']; ?></td>
										<td ><?php if($v['rewardway']==1){echo '固定金额';}else{echo '随机金额';}?></td>
										<td ><?php if($v['rewardway']==1){echo $v['money'];}else{echo '---';}?></td>
										<td ><?php if($v['rewardway']==2){echo $v['minmoney'];}else{echo '---';}?></td>
										<td ><?php if($v['rewardway']==2){echo $v['maxmoney'];}else{echo '---';}?></td>
										<td><?php echo date('Y-m-d H:i:s',$v['adddate']); ?></td>
										<td>
											<a class="mr20" style="color: #476DBE;" href="<?php echo M_URL('Task','showadd',$v['id'],GP('p-'.$now_page));?>">编辑内容</a>
											<a class="mr10" style="color: #476DBE;" onclick="Confirm('是否删除该条内容','<?php echo M_URL('Task','delsingle',$v['id'],GP('p-'.$page->now_page)); ?>')">删除</a>
										</td>
									</tr>
									<?php }?>
								</tbody>
							</table>
                     <?php echo NoC($values);?>
						</div>
							<div class=" footer-page clearfix">
							<div class="col-sm-5">
									<div class="checkbox fl checkbox-info" style="margin-top:20px;margin-right:10px">
							            <input class="selectAll select-checks" name="check1" type="checkbox">
							            <label for="checkboxAll">全选 </label>
      							</div>
									<!--<button class="btn mt10 btn-default" type="submit" name="batch" value="1" style="margin-top: 15px;">
										<i class="iconfont icon-shanchu1"></i>批量回复</button>-->
										<button class="btn mt10 btn-default" onclick="submitform(2)" style="margin-top: 15px;">
										<i class="iconfont icon-shanchu1"></i>批量删除</button>
								</div>
								<div class="col-sm-7 " style="margin-top:7px"><?php echo $page->show(3); ?></div>
							</div>
					</form>
				</div>
				<div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
<script src="//store.kesion.com/Public/common/js/common.js"></script>
<script>
loadScorllJs();
function addtemp(){
	$("#temp1").css('display','flex')
	$("#temp1").addClass('tempstyle')	
}
$('#off').click(function(){

	$("#temp1").css('display','none');
	$('body').css('display','block');
})

	function submitform(){
		inspectionCheckBox('id[]',function(){
			top.popup.confirm('确认要忽略所选项吗？',{
				determine:function(){
					$('#myform').submit();
				}
			})
		})
	}
</script>