<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="renderer" content="webkit"> 
    <title>结算中心</title>
    <link href="<?php echo UOOT ?>Public/common/drag/css/reset.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/wechat/css/home.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/wechat/css/intention.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/wechat/css/settle.css" rel="stylesheet">
    <script>
    	var uoot = '<?php echo UOOT ?>';	
    </script> 	
</head>
	<body>
		<div class="searchbox">
			 <input type="search" name="" id="myconsult" value="" placeholder="请输入搜索内容" onkeyup="settle.myIntentSearch(this)" style="height: 2rem;"/>
		</div>
		<div class="cs-container" id="settle">
		
		</div>
		<div class="height40">
			
		</div>
		<div class="all-wrap">
			<div class="all-wrap-l">
				 <div onclick="settle.allCheck(this)" style="display: flex;align-items: center;">
				 	<input type="radio" value="${item.id}" class="radio-inner" >
				 	<span style="font-size: 14px;line-height: 14px;margin-left: 0.25rem;">全选</span>
				 </div>
			</div>
			<div class="all-wrap-r">
				<div class="item-btn" onclick="settle.jiesuan(1)">
					批量结算
				</div>
			</div>
		</div>
		<div class="loadings" id="loadings"></div>
	</body>
<script src="<?php echo UOOT ?>Public/common/js/z.methodLibrary.js?version=1.0"></script>
<script src="<?php echo UOOT ?>Public/wechat/js/settle.js?version=1.0"></script>
<script type="text/javascript">
settle.getData();
$_monitor.scroll.bottom(window, function () {
	settle.getData();
});
</script>
</html>