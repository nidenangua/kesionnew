<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="renderer" content="webkit"> 
    <link href="<?php echo UOOT ?>Public/common/drag/css/reset.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/clients/css/core.css" rel="stylesheet">
    <script>
    	var uoot = '<?php echo UOOT ?>';
    	var pageName = 'ask'
    </script> 	
</head>

<body>
	
<div id="page" class="transparent">

	<div class="scroll-container">
		
		<div class="ask-list" id="listOfQuestions">
			<ul>
				
			</ul>
		</div>
		<div class="loading-status"><span id="problemLoadingStatus"></span></div>
		
	</div>
	
	<div id="footer">
		<div class="ask-operating clearfix">
			<div class="fl"><span id="issolve" onclick="justLookAtTheIssueThatDidNotReply(this)"><i></i>只看未回复</span></div>
			<div class="fr">
				<span onclick="selectAll(this)" id="selectAll"><i></i>全选</span>
				<button onclick="deleteQuestion()" class="delete">删除</button>
			</div>
			
		</div>
	</div>
	
</div>

<div id="askViewPage" class="ask-view transparent">
	<div id="askViewHeader">
		<div class="ask-view-back"><span onclick="askViewBack()">返回</span></div>
	</div>
	<div class="talk-list" id="askViewScrollContainer">
		
	</div>
	<div id="askViewFooter">
		<div class="talk-send clearfix">
			<textarea type="text" id="questionReplyTextarea"></textarea>
			<input type="file" id="filePhoto" style="display: none;" onchange="sendMessageImg(this,'askview')">
			<span class="file-photo" onclick="getId('filePhoto').click();"></span>
			<button type="button" class="send" onclick="replyToStudentQuestions(0)">回复</button>
		</div>
	</div>
</div>

 <script src="<?php echo UOOT ?>Public/clients/js/core.js" charset="utf-8"></script> 
 
</body>
</html>