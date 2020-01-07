<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="renderer" content="webkit"> 
    <title>签到记录</title>
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
			抢答详情
		</div>
		<div class="list-table">
			<table width="100%" cellpadding="0" cellspacing="0">
				<thead>
					<tr>
						<th width="40%">题目</th>
						<th width="10%">正确答案</th>
						<th width="20%">抢答者</th>
						<th width="20%">抢答时间</th>
						<th width="10%">魅力值</th>
					</tr>
				</thead>
				<tbody class="answer-record" id="answerRecord">
					
				</tbody>
			</table>
		</div>
		<div class="paging paging-big">
			<span class="paging-inner" id="answerRecordPaging"></span>
		</div>
	</div>
	
	<script src="<?php echo UOOT ?>Public/common/js/z.methodLibrary.js?version=1.0" charset="utf-8"></script> 
	<script src="<?php echo UOOT ?>Public/clients/js/interactive.module.js?version=1.0" charset="utf-8"></script> 
 	<script>
 		$_id('answerRecord').child().map(function(obj,i){
 			i%2 === 1 ? obj.className = 'even' : '' 
 		});
 		answer.record.getList(1)
 	</script>
</body>
</html>