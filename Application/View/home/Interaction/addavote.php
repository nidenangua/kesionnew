<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="renderer" content="webkit"> 
    <title>公告记录</title>
    <link href="<?php echo UOOT ?>Public/common/drag/css/reset.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/clients/fonts/iconfont.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/clients/css/interactive.css" rel="stylesheet">
    <script>
    	var uoot = '<?php echo UOOT ?>';
    </script> 	
</head>

<body>
	<div id="loading"></div>
	<div id="scrollPage">	
		<div class="create-answer">
				
			<div class="title">投票主题：</div>
			<div class="content">
				<textarea id="votingTheme" class="judgment-item"></textarea>
			</div>
			<div class="title">选择模式：</div>
			<input type="hidden" id="votingMode" value="1" />
			<div class="interactive-radio pb10 clearfix">
				<span class="checked" onclick="vote.selectMode(this,1)">单选</span>
				<span onclick="vote.selectMode(this,2)">多选</span>
			</div>
			<div class="title"><span onclick="answer.info.add()">增加</span>投票选项：</div>
			<div class="option" id="votingOptionList">
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
				<p>参与投票：加<input type="number" class="number judgment-item" value="10" id="votingRewards" />个魅力值</p>
	
			</div>
		</div>
		<div class="button main-button" onclick="vote.release()">发布投票</div>
		<div class="button" onclick="history.back()">取消返回</div>
	</div>	
	<script src="<?php echo UOOT ?>Public/common/js/z.methodLibrary.js?version=1.0" charset="utf-8"></script> 
	<script src="<?php echo UOOT ?>Public/clients/js/interactive.module.js?version=1.0" charset="utf-8"></script> 
	 <script>
 		
 		new $_resetScroll.newStyle($_id('scrollPage'));
 		
 	</script>
</body>
</html>