<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
</head>
<body>
<style>
	.drag-box-content{
		padding-top:0;
	}
	font[color=red]{
		font-weight:bold;
	}
	.warm-text{
		color:#5e6062;
		font-size:15px;
	}
	.drag-download-str-mod{
		background:#F5F5F5;
		color:white;
	}
	input.ks-bt{
		background:#476DBE;
		border:none;
		color:white;
		transition:all 0.2s linear;		
	}
	.drag-download-str-mod a{
		text-decoration:none;
		color:#476DBE;
	}
	#drag-submit-prev{
		display:none;
	}
	.for-drag-submit-prev{
		display:inline-block;
		background:#476DBE;
		color:white;
		border-radius:4px;
		font-size:13px;
		padding:0 5px;
		transition:all 0.2s linear;
	}
	.drag-add-margin{
		margin-top:6px;
	}
	.drag-model-submit{
		position:relative;
		top:55px;
		left:20px;
		margin-top:10px;
	}
	.drag-head-label{
		color:#5e6062;
		font-size:15px;
	}
	input.ks-bt:hover,.for-drag-submit-prev:hover{
		background:#0043B5;
	}
</style>
<div class="p20 bg-white drag-box-content">
	<div class="fsize16 hLh40 drag-download-str-mod">
		<label class='drag-head-label drag-add-margin'>【下载学员列表模板】</label>
		<label class='drag-head-label drag-add-margin'>点击<a href="<?php echo UOOT; ?>Public/学员导入模板.xls">此处</a>下载模板</label>
	</div>
	<br />
	<div class="fsize16 hLh40 bg-gary">
		<form action="<?php echo M_URL($this->AppName.'/Index','beathaddUsers','',GP(""));  ?>" method="post" enctype="multipart/form-data">
			<div>
				<label class='drag-head-label drag-add-margin'>【上传考试模板】</label>
				<input id='drag-submit-prev' type="file" name="execl">
				<label for="drag-submit-prev" class='for-drag-submit-prev drag-add-margin'>选择文件</label>
			</div>
			<div class='drag-model-submit'>
				<input type="submit" value="提交模板" class="ks-bt" style="line-height: 20px;">
			</div>
		</form>
	</div>
	<br />
	<br />
	<div class="fsize16 hLh40 bg-gary">
		<p><span>&nbsp;&nbsp;[ <font color="red" style='font-weight:bold'>注意</font> ]</span> <span class='warm-text'>上传试卷的格式请严格参照模板，再进行提交，否则试卷会无效！</span></p>
	</div>
</div>

</body>
</html>