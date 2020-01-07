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
	<div class="create-answer">
		<div class="title"><span onclick="answer.info.selectQuestion()">题库选择</span>题目内容：</div>
		<div class="content">
			<textarea name="topic" class="judgment-item"></textarea>
		</div>
		<div class="title"><span onclick="answer.info.add()">增加</span>答案选项：</div>
		<div class="option" id="answerOptionList">
			<div class="item">
				<span class="letter">(A)</span><input type="text" class="judgment-item" name="A" />
			</div>
			<div class="item">
				<span class="letter">(B)</span><input type="text" class="judgment-item" name="B" />
			</div>
			<div class="item">
				<span class="operating"><i onclick="answer.info.remove(this)">×</i></span><span class="letter">(C)</span><input type="text" class="judgment-item" name="C" />
			</div>
			<div class="item">
				<span class="operating"><i onclick="answer.info.remove(this)">×</i></span><span class="letter">(D)</span><input type="text" class="judgment-item" name="D" />
			</div>
		</div>
		<div class="answer">
			<p>正确答案：<select id="answerSelect"><option value="A" selected>A</option><option value="B">B</option><option value="C">C</option><option value="D">D</option></select></p>
			<p>时间限制：<input type="number" class="number" value="60" name="timeLimit" />秒</p>
			<p>答对奖励：加<input type="number" class="number" value="25" name="rewards" />个魅力值</p>
			<p>答错惩罚：扣<input type="number" class="number" value="25" name="punishment" />个魅力值</p>
		</div>
		
	</div>
	<div class="button main-button" onclick="answer.info.release()">发布抢答</div>
	
	
	<div class="interactive-list">
		<div class="interactive-title">抢答记录</div>
		<ul id="answerList">
			
		</ul>
	</div>
	
	<div class="paging">
		<span class="paging-inner" id="answerListPaging"></span>
	</div>

</div>	
<script src="<?php echo UOOT ?>Public/common/js/z.methodLibrary.js?version=1.0" charset="utf-8"></script>
<script src="<?php echo UOOT ?>Public/clients/js/interactive.module.js?version=1.0" charset="utf-8"></script> 
<script>
	answer.info.recording(1);
	new $_resetScroll.newStyle($_id('scrollPage'))
	
</script>
</body>
</html>