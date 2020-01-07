<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>学员笔记</title>
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
</head>
<style>
	.content_bleft_t1{font-size: 18px;font-weight: 700;line-height: 25px; text-align:center;}
	.content_bix_wrp{padding: 40px 34px 30px;}
	.ke-container-default{ width:600px !important;}
	li { width: 100%; padding: 20px 0px; position: relative;cursor: pointer; }
	.bsoild{border-radius:3px; border:1px solid #C5C5C5; outline: none !important; font-size: 15px;padding:5px 10px; overflow: 	auto !important;}
</style>
<body>
	<form target="hidframe" method="post" action="" id="myform>
		<div style="background-color:white; width: 100%; border-radius: 10px;">
			<div class="content_bix_wrp" >
				<div class="form-tip clearfix">
				    <div class="form-tip-blick"></div>
				    <div class="form-tip-word">查看笔记</div>
				</div>
				<div class="form-row">
              		<span class="name"><i class="required">*</i>创建者</span> 
              		<div class="form-limit" limit="500"> 
              			<?php foreach($values as $k => $v);?>	
              			<input style="padding-right: 50px;" name="describe" rows="3" cols="20" class="form-textarea" 						value="<?php echo $v['notescreator'];?>">
              		</div>
	            </div>
				<div class="form-row">
              		<span class="name"><i class="required">*</i>课程名称</span> 
              		<div class="form-limit" limit="500"> 
              			<?php foreach($values as $k => $v);?>	
              			<input style="padding-right: 50px;" name="describe" rows="3" cols="20" class="form-textarea" 						value="<?php echo $v['notescoursename'];?>">
              		</div>
	            </div>
	            <div class="form-row">
              		<span class="name"><i class="required">*</i>课时名称</span> 
              		<div class="form-limit" limit="500"> 
              			<?php foreach($values as $k => $v);?>	
              			<input style="padding-right: 50px;" name="describe" rows="3" cols="20" class="form-textarea" 						value="<?php echo $v['notesperiodname'];?>">
              		</div>
	            </div>
	            <div class="form-row">
              		<span class="name"><i class="required">*</i>笔记内容</span> 
              		<div class="form-limit" limit="500"> 
              			<?php foreach($values as $k => $v);?>	
              			<input style="padding-right: 50px;" name="describe" rows="3" cols="20" class="form-textarea" 						value="<?php echo $v['notescontent'];?>">
              		</div>
	            </div>
	            <div class="form-row">
              		<span class="name"><i class="required">*</i>填写时间</span> 
              		<div class="form-limit" limit="500"> 
              			<?php foreach($values as $k => $v);?>	
              			<input style="padding-right: 50px;" name="describe" rows="3" cols="20" class="form-textarea" 						value="<?php echo date('Y-m-d H:i:s',$v['notesaddtime']);?>">
              		</div>
	            </div>
			</div>
		</div>
	</form>
</body>
</html>

