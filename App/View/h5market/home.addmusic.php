<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="renderer" content="webkit"> 
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="format-detection" content="telephone=no" />
    <title>修改图文信息</title>
    <link rel="stylesheet" type="text/css" href="https://ks.kesion.com/Public/common/drag/css/reset.css"/>
	<style>
		.editor{padding:5px 20px;}
		.modify{width:100px;height:38px; background: #476DBE;color:#fff; line-height: 38px;margin:10px 0 0 20px; text-align: center;border-radius:4px; font-family: 'hiragino sans gb'; font-size:14px; cursor: pointer;}
	</style>
</head>  
<body style="background: #fff;">
	
	<div class="editor">
		<?php echo ks_editor('massage','','1',editorNum3(),'','420px');?>
	</div>
	
	<div class="modify" onclick="modify()">确认修改</div>
	<script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>
	<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
	<script>
		var _content = top.popup.data(window.name).content;
		var _target = top.popup.data(window.name).target;
		massage.ready(function() {
		    //设置编辑器的内容
		    massage.setContent(_content);
		  	
		});
		
		//确定返回值
		function modify(){
			var newContent = massage.getContent();
			_target.innerHTML = newContent;
			top.closePopup(window.name);
		}
		
		
	</script>
</body>
</html>