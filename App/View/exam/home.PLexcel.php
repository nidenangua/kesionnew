<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit"> 
<title>kesion教育平台</title>
<link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />

</head>
<body>


<style>
	/*.drag-box-content{
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
	.hLh40 span{height: 40px!important ; line-height: 40px!important;overflow: hidden;margin-top: 0;}*/
</style>
<div class="p20 " style="    height: 236px;">
	<div class="fsize16  drag-download-str-mod" >
		<label>【下载试题导入模板】</label>
		<label>点击<a href="<?php echo UOOT; ?>Public/word题库模板.zip">此处</a>下载模板（仅支持word文档）</label><br />	
	</div>
	<br />	
	<form action="<?php echo M_URL($this->AppName.'/Index','dowordin','',GP('p-'.$now_page));  ?>" method="post" enctype="multipart/form-data">
		<div >
			<div class="clearfix" >
				
				<label class='drag-head-label drag-add-margin'> 【选择导入类型】</label><br />  
				<div style="height:60px;margin-left: 33px;margin-top: 14px;">
			<label>
				<input type="radio" id="ratiotime" name="type" value="1" />单选题</span>
			</label>
			<label>
				<input type="radio" id="ratiotime" name="type" value="2" />填空题</span>
			</label>
			<label>
				<input type="radio" id="ratiotime" name="type" value="3" />判断题</label>
			<label>
				<input type="radio" id="ratiotime" name="type" value="4" />问答题
			</label>
			<label>
				<input type="radio" id="ratiotime" name="type" value="5" />材料题
			</label>
			<label>
				<input type="radio" id="ratiotime" name="type" value="6" />多选题
			</label>
		</div>

				
				<!--<input size="100" type="file" name="word" id="file" >-->
				
				<!-- <button class="ks-heade-button mr10" onclick="document.getElementById('file').click()">选择文件</button> -->
				
				<!--<div class="showFileName1"></div>-->
				
				
			</div>
		    <div class="fsize16 hLh40 bg-gary" style="    padding-top: 10px;">
				
					<label>【上传文件】</label>
					<input type="file" name="word">
					<!--<input type="submit" value="提交模板" class="ks-bt bt-green" style="line-height: 20px;">-->
				
			</div>
			<br />
			<div class="clearfix ks-popup-footer form-footer" style="padding: 0;    border: none;">
					<div class="d-inline-block" ><input type="submit" value="提交模板" class="ks-bt  bt-pue" style="position: relative;left: 38%;"></div>
				
			</div>
		</div>

	</form>
</div>
		<div class="clearfix ks-popup-footer form-footer">
			<!--<div class="d-inline-block" ><input type="submit" value="提交模板" class="ks-bt  bt-pue"></div>-->
		<div style=" background-color: #fef0f0; color: #f56c6c; padding: 0px 10px; line-height:34px;margin-top:15px;">
			上传格式请严格参照模板，再进行提交，否则无效！
			</div>
		</div>
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