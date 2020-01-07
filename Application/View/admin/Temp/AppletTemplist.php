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
<link href="<?php echo UOOT;?>Public/app/css/course.css?<?php echoHash(); ?>" rel="stylesheet" />

</head>
<body class="ks-wrap">  
	
<div class="ks-wbox bRadius10">
	<!--header-->
	<div class="ks-head-box clearfix">
		<h3 class="ks-head-title2">小程序模板管理</h3>			
	</div>
	
	<!--header-->
	<!--tab-->
	<div class="ks-head-tab">
		<ul class="clearfix">
		<li ><a  href="<?php echo M_URL('Temp','AppletTemp','',GP('')) ?>">临时草稿箱</a></li>
		<li class="curr"><a href="<?php echo M_URL('Temp','AppletTemplist','',GP('')) ?>">模版库</a></li>
		</ul>
	</div>         
	
	 <!--/tab-->
	
	
	<!--widget-->
	<div class="ks-head-widget clearfix">
		<div class="fl">
			<ul class="ks-head-choice">
				<li>
					<div class="ks-head-el">
						<a>注意：模版库只能最多可添加50个</a>
					</div>
				</li>
			</ul>			
		</div>
		<div class="fr">
			<ul class="ks-head-choice">
			<li>
				<div class="ks-head-el">
					<a href="<?php echo M_URL('Temp','gettemplatelist','',GP('')); ?>" class="ks-heade-button ks-head-primary" type="button"><i class="icon-jiahao iconfont "></i>同步模版到本地</a>
				</div>
			</li>
			</ul>
		</div>
	
	</div>
	<!--/widget-->
	
	<form target="hidframe"  action="<?php echo M_URL('Temp','AppletTempSet','',GP('')); ?>" method="post" id="myform" >
	<!--table-->
	
	<table class="ks-table">
		<thead>
			<tr>
			<th>选择</th>
			<th style="text-align: left;">描述</th>
			<th>模版名称</th>
			<th>版本号</th>
			<th>TemplateID</th>
			<th>上传的开发者</th>
			<th>开发者上传时间</th>
			<th>操作</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($values as $k=>$v){ ?>
			<tr>
				<td style="width: 30px;"><input type="checkbox" class="select-checks" name="check[]" value="<?php echo $v['template_id']; ?>"></td>
				<td style="text-align: left;"><?php echo $v['user_desc']; ?></td>
				<th><?php echo $v['tempname']; ?></th>
				<td><?php echo $v['user_version']; ?></td>
				<td><?php echo $v['source_miniprogram']; ?></td>
				<td><?php echo $v['developer']; ?></td>
				<td><?php echo date('Y-m-d H:i:s',$v['create_time']); ?></td>
				<td class="ks-head-el">
					<i onclick="choiceClick(this)" class="iconfont icon-more"></i>
					<div class="ks-head-content ks-head-content-pc w100">
						<ul class="opeart">
							<li> <a href="<?php echo M_URL('Temp','AppletTempAdd',$v['template_id'],GP('')); ?>" >编辑前台展示</a> </li>
							<li> <a href="javascript:Confirm('你确定要删除该模版，该过程不可逆','<?php echo M_URL('Temp','deletetemplate',$v['template_id'],GP('')); ?>')"> 删除</a> </li>
						</ul>
					</div>
				</td>
			</tr>
			<?php } ?>
			
		</tbody>
	</table>
	<?php echo Noc($values); ?>
	<!--/table-->
	<input type="hidden" name="batch" id="batch1" />
	<div class="ks-bom clearfix">
		<div class="fl">
			<label class="mr20 fl"><input type="checkbox" class="selectAll select-checks" >全选</label>
			<button type="button" class="ks-heade-button mr10" onclick="submitform(1)"><i class="iconfont icon-shanchu1"></i></button>
			<!--<button type="submit" class="ks-heade-button mr10" onclick="submitform(2)" >批量转化成模版</button>-->
		</div>
		<div class="fr">
			<?php echo $page->show(3); ?>
		</div>
	</div>	
	
	</form>
</div>
		
	




<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>
<script>
module.require(['$','backstage','nicescroll','laydate'],function(){
	
	
});
function submitform(type){
	$('[name=batch]').val(type);
	$('#myform').submit();
}
	
</script>
</body>
</html>


