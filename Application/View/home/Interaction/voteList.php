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

<body class="bg-white">
	
	<div class="table-container">

		<div class="announce-view" id="announceView" style="height: 560px; ">
			
		</div>
		
	</div>
	
	
	<script src="<?php echo UOOT ?>Public/common/js/z.methodLibrary.js?version=1.0" charset="utf-8"></script> 
	<script src="<?php echo UOOT ?>Public/clients/js/interactive.module.js?version=1.0" charset="utf-8"></script> 
 	<script> 
 		announce.getView(location.href.match(/\?id=\d+/)[0].match(/\d+/)[0]);
 	</script>
</body>
</html>