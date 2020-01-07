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
    </script> 	
</head>

<body>
<div id="loading"></div>
<div id="scrollPage">
	<div class="interactive-tips">
		<p>可用于惩罚表现不好的学员</p>
		<p>提交后将以小窗口的形式出现在屏幕中间，所有观众可见</p>
	</div>
	<div class="rewards-and-criticism">
		<div class="student-list">
			<ul class="clearfix" id="studentList">

			</ul>
		</div>

	</div>
	<div class="create-answer">
		<div class="title">模板选择</div>
		<div class="select-type">
			<input type="hidden" id="templateType" value="0" />
			<ul class="clearfix">
				<li onclick="rewardsAndCriticism.selectType(this,0)"><div class="item"><i class="interactive-checkbox checked"></i><img src="<?php echo UOOT ?>Public/clients/images/2.png" /><span>惩罚</span></div></li>
			</ul>
		</div>
		<div class="content">
			<textarea id="textContent" class="judgment-item"></textarea>
		</div>
		<div class="answer">
			<p>减少<input type="number" class="number" value="25" id="glamour" />个魅力值</p>
		</div>
	</div>
	
	<div class="button main-button" onclick="rewardsAndCriticism.release(2)">确认发布</div>
	
	
	<div class="interactive-list">
		<div class="interactive-title">惩罚记录</div>
		<ul id="recordContainer">
			
		</ul>
	</div>
	
	<div class="paging">
		<span class="paging-inner" id="recordPaging"></span>
	</div>

</div>	
<script src="<?php echo UOOT ?>Public/common/js/z.methodLibrary.js?version=1.0" charset="utf-8"></script>
<script src="<?php echo UOOT ?>Public/clients/js/interactive.module.js?version=1.0" charset="utf-8"></script> 
<script>
	
	//rewardsAndCriticism()
	new $_resetScroll.newStyle($_id('scrollPage'))
	$_id('textContent').placeholder = "请输入批评的话语";
	rewardsAndCriticism.getRecords(1,2)
	sendMessageChannelReceive('Get student information',false,1)
</script>
</body>
</html>