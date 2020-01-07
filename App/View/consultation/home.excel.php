<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit"> 
<title>kesion教育平台</title>
<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
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

	.hLh40 label,
	.hLh40 span{height: 40px!important ; line-height: 40px!important;overflow: hidden;margin-top: 0;}
</style>
<div class="p20 bg-white drag-box-content">
	<div class="fsize16 hLh40 drag-download-str-mod">
		<label class='drag-head-label drag-add-margin'>【下载咨询人录入列表模板】</label>
		<label class='drag-head-label drag-add-margin'>点击<a href="<?php echo UOOT; ?>Public/咨询人导入模板.xlsx">此处</a>下载模板</label>	
		
	<form action="<?php echo M_URL($this->AppName.'/Index','doExcel','',GP('p-'.$now_page));  ?>" method="post" enctype="multipart/form-data">
		<div >
			<div class="hLh40 clearfix">
				
				<label class='drag-head-label drag-add-margin'><?php if($type == 1){ echo '【导入学员】';}else{echo '【导入题目】' ;} ?></label>
				
				<input size="100" type="file" name="execl" id="file" style="display: none;">
				
				<button class="ks-heade-button mr10" onclick="document.getElementById('file').click()">选择文件</button>
				
				<div class="showFileName1"></div>
				
				
			</div>
		
			<div style=" background-color: #fef0f0; color: #f56c6c; padding: 0px 10px; line-height:34px;margin-top:15px;">
			上传格式请严格参照模板，再进行提交，否则无效！
			</div>
		</div>
		<div class="clearfix ks-popup-footer form-footer">
			<div class="d-inline-block" ><input type="submit" value="提交模板" class="ks-bt  bt-pue"></div>
		
		</div>
	</form>
</div>

<script src="<?php echo UOOT;?>/Public/common/js/module.js?<?php echo echoHash();?>"></script>

<script>
	module.require(['$','backstage','nicescroll'],function(){
		$(".file").on("change","input[type='file']",function(){
		    var filePath=$(this).val();
		  
		    var arr=filePath.split('\\');
		    var fileName=arr[arr.length-1];
		    $(".showFileName1").html(fileName);
		   
		})
		
	})	
	


</script>

</body>
</html>