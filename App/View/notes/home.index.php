<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit">
<title>kesion教育平台</title>
<meta name="Keywords" content="kesion教育平台"/>
<meta name="Description" content="kesion教育平台" />
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>
<style>
	.titleTab li{margin-bottom: 0;}
	.ks-view-tab li a{display: block;}
</style>
</head>
<body class="ks-wrap">

	<div id="ksBoxHead"> 

	<div class="Header-tool clearfix">
		<div class="Tool-Title">

		<!--标题-->
		<p><a href="javascript:history.go(-1);"><i class="iconfont icon-jiantou-copy"></i>我的应用</a><span>/</span>学员笔记</p>
		<!--标题-->

		</div>
		<!--操作范围-->

		<!--按钮组件-->

		<!--按钮组件-->

		<!--搜索框组件-->
		<div class="clearfix mt10">
			<div class="fl">
				<ul class="ks-view-tab  clearfix fl">
					<li class="fl <?php if($notestype==3){echo 'curr';}?>"><a href="<?php echo M_URL($this->AppName.'/Index','index','',GP("status-3,appid-$this->appid",true)); ?>">所有笔记</a></li>
					<li class="fl <?php if($notestype==0){echo 'curr';}?>"><a href="<?php echo M_URL($this->AppName.'/Index','index','',GP("status-0,appid-$this->appid",true)); ?>">网络授课笔记</a></li>
					<li class="fl <?php if($notestype==1){echo 'curr';}?>"><a href="<?php echo M_URL($this->AppName.'/Index','index','',GP("status-1,appid-$this->appid",true)); ?>">直播课程笔记</a></li>
				</ul>
			</div>
			<div class="fr ks-top-search">
				<label class="mr10">
				<select class="w150 inputText bRadius5" id="keytype">
					<option value="1" <?php if($keytype==1){echo 'selected="selected"';} ?>>创建者</option>
					<option value="2" <?php if($keytype==2){echo 'selected="selected"';} ?>>课程名称</option>
					<option value="3" <?php if($keytype==3){echo 'selected="selected"';} ?>>课时名称</option>
					<option value="4" <?php if($keytype==4){echo 'selected="selected"';} ?>>笔记内容</option>
				</select>
				</label>
				<div class="ks-top-search fr">
				<input type="text" class="sc-text" name="searchText" id="keyword"  value="<?php if(isset($keyword)) echo $keyword; ?>">
				<input type="submit" class="sc-button" onClick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL($this->AppName.'/Index','index'); ?>','<?php echo URL_MODEL;?>')" name="searchBtn" value="搜索" >
				</div>
			</div>
		</div>	
	  </div>	

	<!--结束-->



		<!--搜索框组件-->

		<!--操作范围-->
</div>
	
 	<div class="ks-wbox mt20">		
	   <div id="ksBoxContent">
	<form target="hidframe" action="<?php echo M_URL($this->AppName.'/Index','batchNotes','',GP(''));  ?>" method="post" id="myform">        
		<table width="100%" cellpadding="0" cellspacing="0" border="0" class="ks-table">
			<thead>
				<tr>
					<th>
						<input name="" type="checkbox" value="" class="verAlignMiddle checkall check-all" id="selectAll">
					</th>
					<th>创建者</th>
					<th>课程名称</th>
					<th>课时名称</th>
					<th>笔记内容</th>
					<th>添加时间</th>						
					<th>状态</th>
					<th>操作</th>
				</tr>
			</thead>
			<tbody>
			<?php foreach($values as $k=>$v){if($v['notesstatus'] ==0){$status = '待分享';}else{$status = '已分享';}?>
				<tr>					
					<th style="width: 30px;">
						<input type="checkbox" class="select-check" name="notesid[]" value="<?php echo Field($v['notesid']);?>">
					</th>
					<th><?php echo Field($v['notescreator']);?></th>
					<th><?php echo Field($v['notescoursename']);?></th>
					<th><?php echo Field($v['notesperiodname']);?></th>
					<th><?php echo Field($v['notescontent']);?></th>
					<th><?php echo Field(date('Y-m-d H:i:s',$v['notesaddtime']))?></th>
					<td><?php echo $status;?></td>
					<th nowrap="nowrap">
						<div class="operate">
							<a href="javascript:void(0);" onclick="addTypeChange('<?php echo M_URL($this->AppName.'/Index','showNotes',$v['notesid'],GP('')); ?>','700px','520px',{type:'top'});"><em>查看</em><i class="iconfont">&#xe64b;</i></a>
							<a href="javascript:Confirm('是否删除此问题？该操作不可逆!','<?php echo M_URL($this->AppName.'/Index','delNotes',$v['notesid'],GP('')); ?>')"><em>删除</em><i class="iconfont icon-shanchu1"></i></a>
						</div>
					</th>
				</tr>
				<?php } ?>
			</tbody>
		</table>

	</form>

	</div>   
    </div>
	
	<div id="ksBoxFooter" style="height: 120px">
<div class="ks-bom clearfix">
	<span class="fl">
		<label class="mr20 fl"><input name="" type="checkbox" value="" class="verAlignMiddle checkall check-all" id="selectAll">全选</label>
		<button class="fr ks-bt bt-pue" onclick="do_reg()"><i class="iconfont icon-lajitong"></i>批量删除</button>
	</span>
	<div class="fr"><?php echo $page->show(3); ?></div>
</div>
</div>


<script>

function do_reg(){
	$('#myform').submit();
}
</script>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>


</body>
</html>

