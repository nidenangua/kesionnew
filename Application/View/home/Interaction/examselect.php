<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="renderer" content="webkit"> 
    <title>试卷选择</title>
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
			试卷选择
		</div>
		<div class="list-table">
			<table width="100%" cellpadding="0" cellspacing="0">
				<thead>
					<tr>
						<th width="10%">选择</th>
						<th width="70%">试卷名称</th>
						<th width="10%">考试时间</th>
						<th width="10%">出题者</th>
					</tr>
				</thead>
				<tbody class="answer-record" id="examList">
					<tr>
						<td><span class="checkbox"></span></td>
						<td>编译原理真题试卷</td>
						<td>60分钟</td>
						<td>Carrie</td>
					</tr>
					<tr>
						<td><span class="checkbox"></span></td>
						<td>编译原理真题试卷</td>
						<td>60分钟</td>
						<td>Carrie</td>
					</tr>
					<tr>
						<td><span class="checkbox"></span></td>
						<td>编译原理真题试卷</td>
						<td>60分钟</td>
						<td>Carrie</td>
					</tr>
					<tr>
						<td><span class="checkbox"></span></td>
						<td>编译原理真题试卷</td>
						<td>60分钟</td>
						<td>Carrie</td>
					</tr>
					<tr>
						<td><span class="checkbox"></span></td>
						<td>编译原理真题试卷</td>
						<td>60分钟</td>
						<td>Carrie</td>
					</tr>
				</tbody>
			</table>
		</div>
		
	</div>
	
	<div class="footer-button">
		<div class="inline-block">
			<div class="button main-button" onclick="answer.questionBank.determine()">下一步</div>
			<div class="button gray-button">取消</div>
		</div>
		
	</div>
	
	
	<script src="<?php echo UOOT ?>Public/common/js/z.methodLibrary.js?version=1.0" charset="utf-8"></script> 
	<script src="<?php echo UOOT ?>Public/clients/js/interactive.module.js?version=1.0" charset="utf-8"></script> 
 	<script>
 		examination.getExamList(1);
 	</script>
</body>
</html>