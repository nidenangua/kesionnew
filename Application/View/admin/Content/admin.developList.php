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
						<h3 class="fl" style="float: left;">&nbsp;&nbsp;开发动态管理</h3>
					</div>
					<div class="clearfix" style="float: left;margin-left: 56px;">
						<span class="btn btn-default btn-rounded " style="cursor:pointer" onclick="addTypeChange('<?php echo M_URL('Content','developManage','',GP('p-'.$now_page.',backtype-2,allwx-2'));?>','1040px','760px',{title:'发布开发动态',type:'top'})">发布动态</span>
					</div>
					<div class="fr">
						<div class="fl ks-top-search">
                            <select class="inputText bRadius5 fl" id="keytype" style="width: 150px;">
							     <option value="1" <?php if($keytype==1){echo 'selected="selected"';} ?>>用户名称</option>
							     <option value="2" <?php if($keytype==2){echo 'selected="selected"';} ?>>网校名称</option>
							     <option value="3" <?php if($keytype==3){echo 'selected="selected"';} ?>>反馈内容</option>
					  	    </select>
							<form target="hidframe" class="fr">
								<input type="text" class="sc-text" name="searchText" id="keyword" value="<?php if($keyword){echo $keyword;}?>">
				           		<input type="button" class="sc-button fl" onClick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL('Content','developList'); ?>','<?php echo URL_MODEL;?>')"   name="searchBtn" value="搜索">
							</form>
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
					<form action="<?php echo M_URL('Content','deleteDevelop','',GP('')) ?>"  method="post">
						<div class="Created-push" id="ksBoxContent" style="padding:15px;">
							<table class="ks-table" id="tables">
								<thead>
									<tr style="background: #EEEEEE;">
										<th  class="fl" >
											选择
										</th>
										<th >发布用户</th>
										<th >发布标题</th>
										<th class="shaixuan">
											<?php if($adddate == 2){?>
												<a class="desc" href="<?php echo M_URL('Content','developList','',GP("adddate-1")); ?>"  style="float: none;"><i class="desc-i" style="top: -1px;"></i>发布时间</a>		
											<?php }else{ ?>
												<a class="desc" href="<?php echo M_URL('Content','developList','',GP("adddate-2")); ?>" style="float: none;"><i class="asc-i" style="top: -1px;"></i>发布时间</a>		
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
										<td><?php echo $v['username']; ?></td>
										<td style="text-align: left;"><?php echo $v['title']; ?></td>
										<td><?php echo date('Y-m-d H:i:s',$v['adddate']); ?></td>
										<td>
											<a class="mr20" style="color: #476DBE;" onclick="addTypeChange('<?php echo M_URL('Content','developManage',$v['id'],GP('p-'.$now_page.',backtype-2,allwx-2'));?>','1040px','760px',{title:'编辑内容',type:'top'})">编辑内容</a>
											<a class="mr10" style="color: #476DBE;" onclick="Confirm('是否删除该条内容','<?php echo M_URL('Content','deleteDevelop',$v['id'],GP('p-'.$page->now_page)); ?>')">删除</a>
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
										<button class="btn mt10 btn-default" type="submit" name="batch" value="1" style="margin-top: 15px;">
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
</script>