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
<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
</head>
<body class="ks-wrap">
<div id="ksBoxHead">
	<!--结束-->
	<div class="Header-tool clearfix" style="margin-bottom: 20px;">
		<div class="Tool-Title clearfix">
		<!--标题-->
		<p><a href="<?php echo M_URL('Website'); ?>" class="fl"><i class="iconfont icon-jiantou-copy"></i>网站设置<span>/</span>网站介绍 </a></p>
		<!--标题-->
	</div>
	</div>	
</div>
<div class="bRadius10 ks-wbox">
	<!--END HEAD-->
    <div id="ksBoxContent">
        <form target="hidframe" id="myform" action="<?php if($values){echo M_URL('Offweb','questionManageDoSave',$id,GP(''));}else{ echo M_URL('Offweb','questionManageDoSave','',GP(''));}?>" method="post" enctype="multipart/form-data">
             <div class="form-row">
				<span class="name">问题</span>
				<textarea name="title" rows="2" cols="20" class="form-textarea" id="copyrightinfo"><?php if($values){echo $values['title'];} ?></textarea>
			</div>
			<div class="form-row">
				<span class="name">排序(数字越大越前面)</span>
				<input name="orderid" value="<?php if($values){echo $values['orderid'];} ?>"/>
			</div>
			<div class="form-row">
				<span class="name">问题分类</span>
				<select name="classify" style="width: 300px; height: 40px;">
					<?php foreach($classifyary as $k =>$v){ ?>
					<option value="<?php echo $v['categoryid']?>" <?php if($values){if($values['classify']==$v['categoryid']){echo "selected";}}?>><?php echo $v['categoryname'] ?></option>
					<?php } ?>
				</select>
			</div>
	        <div class="form-row">
				<span class="name">问题简介</span>
				<textarea name="answer" rows="2" cols="20" class="form-textarea" id="copyrightinfo"><?php if($values){echo $values['answer'];} ?></textarea>
			</div>	
			 <div class="form-row">
				<span class="name">问题详情</span>
                     <?php  $kindeditor1 = ks_editor('content',$values['content'],'1','','1400px','400px');  echo $kindeditor1;?>
			</div>	
		    
	</div>
</div>	
<div id="ksBoxFooter" style="height: 120px;">
	<div class="ks-bom" style="text-align: center;">
			<input type="submit" id="StartBtn" class="ks-bt bt-w120 bt-pue" value="确认" name="confirm">
	</div>     
</div>
</form>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
</body>
</html>