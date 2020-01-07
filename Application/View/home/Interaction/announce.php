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
			<p>可用于紧急、临时、重要通知</p>
			<p>提交后将直接以滚动广播的形式出现在屏幕上方，所有观众可见</p>
		</div>
			
		<div class="announce-item">
			<div class="title">公告标题</div>
			<input class="interactive-text judgment-item" type="text" id="announceTitle" placeholder="请输入简短标题">
		</div>
		
		<div class="announce-item">
			<div class="title">公告内容</div>
			<textarea class="interactive-textarea judgment-item" id="announceContent"></textarea>
		</div>
		<div class="announce-item">
			<div class="title">结束时间</div>
			<input class="interactive-text judgment-item" type="text" id="endDate" readonly>
			
		</div>
		
		<div class="view-announce">
			
		</div>
		
		<div class="button main-button" onclick="announce.release()">发布公告</div>
		
		
		<div class="interactive-list">
			<div class="interactive-title">公告记录</div>
			<ul id="announceRecord">
				
			</ul>
		</div>
		
		<div class="paging">
			<span class="paging-inner" id="announceRecordPaging"></span>
		</div>
	
	</div>	
	<script src="<?php echo UOOT ?>Public/common/js/z.methodLibrary.js?version=1.0" charset="utf-8"></script> 
	<script src="<?php echo UOOT ?>Public/clients/js/interactive.module.js?version=1.0" charset="utf-8"></script> 
	<script src="<?php echo UOOT ?>Public/clients/jeDate/dist/jedate.min.js"></script>
 	<script>
 		announce.getRecordList(1);
 		new $_resetScroll.newStyle($_id('scrollPage'));
 		$_id('announceContent').placeholder = "请输入通知的内容";
		
		jeDate("#endDate",{
	        format:"YYYY/MM/DD hh:mm",
	        isTime:true,
	        minDate:"2014-09-19 00:00:00",
	        theme:{ bgcolor:"#00a1e9",color:"#fff", pnColor:"#00a1e9"}
	    })
	
 	</script>
</body>
</html>