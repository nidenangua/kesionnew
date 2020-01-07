<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="renderer" content="webkit"> 
    <title>公告</title>
    <link href="<?php echo UOOT ?>Public/common/drag/css/reset.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/clients/fonts/iconfont.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/clients/css/interactive.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/clients/jeDate/skin/jedate.css" rel="stylesheet">
    	
    <script>
    	var uoot = '<?php echo UOOT ?>';
    </script> 	
</head>

<body>
	<div id="loading"></div>
	<div id="scrollPage">	
		
		<div class="interactive-tips">
			<p>用户出题作答、互动活动、选择决策、提交后以弹框形式出现在观众屏幕前</p>
		</div>
	
		<div class="button button-adaptive main-button" onclick="vote.initiate()">发起投票</div>
		
		<div><br /></div>
		<div class="interactive-list">
			<div class="interactive-title">投票记录</div>
			<ul id="votingRecord">
				
			</ul>
		</div>
		
		<div class="paging">
			<span class="paging-inner" id="votingRecordPaging"></span>
		</div>
	
	</div>	
	<script src="<?php echo UOOT ?>Public/common/js/z.methodLibrary.js?version=1.0" charset="utf-8"></script> 
	<script src="<?php echo UOOT ?>Public/clients/js/interactive.module.js?version=1.0" charset="utf-8"></script> 
	
 	<script>
 		vote.getList()
 		new $_resetScroll.newStyle($_id('scrollPage'));
 		
 	</script>
</body>
</html>