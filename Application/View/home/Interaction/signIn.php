<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="renderer" content="webkit"> 
    <link href="<?php echo UOOT ?>Public/common/drag/css/reset.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/clients/css/interactive.css" rel="stylesheet">
    <script>
    	var uoot = '<?php echo UOOT ?>';
    	var pageName = 'ask'
    </script> 	
</head>

<body>
	
	<div class="interactive-tips">
		通过发起签到，可以确定学生是否在听课<br />
		确认点名之后，课时数相对应减少一个课时
	</div>
	<div id="signInContainer">
		
	</div>

	
	<div class="selectMessageType" id="selectMessageType"><span>通知方式</span></div>
	<div class="checkInRecord">
		<div class="title">点名记录</div>
		<div class="record-list">
			<ul id="checkInRecordList">
				
			</ul>
		</div>
		<div class="paging">
			<span class="paging-inner" id="checkInRecordListPaging"></span>
		</div>
	</div> 
	
	<script src="<?php echo UOOT ?>Public/common/js/z.methodLibrary.js?version=1.0" charset="utf-8"></script> 
	<script src="<?php echo UOOT ?>Public/clients/js/signIn.js" charset="utf-8"></script> 
 
</body>
</html>