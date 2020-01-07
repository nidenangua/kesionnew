<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="renderer" content="webkit"> 
    <title>题库选择</title>
    <link href="<?php echo UOOT ?>Public/common/drag/css/reset.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/clients/fonts/iconfont.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/clients/css/interactive.css" rel="stylesheet">
    <script>
    	var uoot = '<?php echo UOOT ?>';
    </script> 	
</head>

<body class="bg-white">
	
	<div class="table-container">
		<div class="title">
			题库选择
		</div>
		<div class="list-table">
			<table width="100%" cellpadding="0" cellspacing="0">
				<thead>
					<tr>
						<th width="10%">选择</th>
						<th width="10%">序号</th>
						<th width="70%">题目</th>
						<th width="10%">正确答案</th>
					</tr>
				</thead>
			</table>
			<div id="zScroll" style="height: 400px;">
				<table width="100%" cellpadding="0" cellspacing="0">
					<tbody class="answer-record" id="questionBank">
						
					</tbody>
				</table>
			</div>
		</div>
		
	</div>
	
	<div class="footer-button">
		<div class="inline-block">
			<div class="button main-button" onclick="answer.questionBank.determine()">确定</div>
			<div class="button gray-button" onclick="answer.questionBank.cancel()">取消</div>
		</div>
		
	</div>
	
	
	<script src="<?php echo UOOT ?>Public/common/js/z.methodLibrary.js?version=1.0" charset="utf-8"></script> 
	<script src="<?php echo UOOT ?>Public/clients/js/interactive.module.js?version=1.0" charset="utf-8"></script> 
 	<script>
 		answer.questionBank.getList(1);
 		new $_resetScroll.newStyle($_id('zScroll'))
 	</script>
</body>
</html>