<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
     <title>渠道</title>
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="renderer" content="webkit"> 
    <link href="<?php echo UOOT ?>Public/common/drag/css/reset.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/wechat/css/home.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/wechat/css/intention.css" rel="stylesheet">
    <script>
    	var uoot = '<?php echo UOOT ?>';	
    </script> 	
    <style type="text/css">
    	#addChannel,#editChannel{
    		height: 8rem;
    	}
    	.add-intent-t input{
    		margin: 1rem 0;
    	}
    </style>
</head>
	<body>
	
		<div class="intent-t">
			<div class="item" style="cursor: pointer;" onclick="location.href='<?php echo M_URL('WeChat','intention');?>'">
				我的咨询
			</div>
			<div class="item" style="cursor: pointer;" onclick="location.href='<?php echo M_URL('WeChat','task');?>'">
				任务
			</div>
			<div class="item" style="cursor: pointer;" onclick="location.href='<?php echo M_URL('WeChat','intentcount');?>'">
				咨询统计
			</div>
			<div class="item " style="cursor: pointer;" onclick="location.href='<?php echo M_URL('WeChat','intentpound');?>'">
				咨询池
			</div>
			<div class="item active" style="cursor: pointer;" onclick="location.href='<?php echo M_URL('WeChat','channel');?>'">
				渠道
			</div>
		</div>
		<div class="height40">
			
		</div>
		<div id="channel" class="inner" style="margin-top: 0.5rem;">
			
		</div>
		<img src="<?php echo UOOT ?>Public/wechat/images/loading.gif"  class="loading"/>
		
		<div class="add" onclick="intentChannel.addPopup()">
			<img src="<?php echo UOOT ?>Public/wechat/images/add.png"/>
		</div>
		<div class="mask">
		
		</div> 
		
		<div class="add-intent" id="addChannel">
			<div class="add-intent-t">
				<div class="title">
					快速新增渠道
				</div>
				<input type="search" name="" id="channeladd" value="" placeholder="请输入渠道名称" />
			</div>
			<div class="add-intent-b">
				<div class="item" onclick="intentChannel.addCancel()">取消</div>
				<div class="item active" onclick="intentChannel.addConfirm(this)">确认</div>
			</div>
		</div>
		<div class="add-intent" id="editChannel">
			<div class="add-intent-t">
				<div class="title">
					快速编辑渠道
				</div>
				<input type="" name="" id="channeledit" value="" placeholder="请输入渠道新名称" />
			</div>
			<div class="add-intent-b">
				<div class="item" onclick="intentChannel.editCancel()">取消</div>
				<div class="item active" onclick="intentChannel.editConfirm(this)">确认</div>
			</div>
		</div>
	</body>
<script src="<?php echo UOOT ?>Public/common/js/z.methodLibrary.js?version=1.0"></script>
<script src="<?php echo UOOT ?>Public/wechat/js/intention.js?version=1.0"></script> 
<script type="text/javascript">
	intentChannel.getData();
</script>
</html>