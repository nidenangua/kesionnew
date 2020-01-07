<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="renderer" content="webkit"> 
    <title>粉丝列表</title>
    <link href="<?php echo UOOT ?>Public/common/drag/css/reset.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/wechat/css/home.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/wechat/css/verm.css" rel="stylesheet">
   <style>
   		[v-cloak]{
   			display: none;
   		}
   </style>
   <script>
    	var uoot = '<?php echo UOOT ?>';	
    	
    </script> 	
</head>    
	<body>
		<div class="verm-box" id="vermic" v-cloak>
			<div class="campus-list" v-if="campusArr.length>0">
				<div class="verm-list" v-for="(item,index) of campusArr">
					<div class="verm-left">
						<div class="verm-img">
							<img :src="item.headimgurl" >
							
						</div>
						<div class="verm-txt">
							<h5>{{item.nickname}} 
								<img :src="item.seximg">
							</h5>
							<p>{{item.add}}/{{item.subscribe_time}}</p>
							
						</div>					
					</div>
					<div class="verm-right">
						<img src="<?php echo UOOT ?>Public/wechat/images/bankmode/verm3.png">
					</div>
				</div>
		</div>
			<div v-else class="nodata"></div>  
		</div>
	</body>
	
	<script src="<?php echo UOOT ?>Public/common/js/currency/gate.js" type="text/javascript"></script>
	<script>
		




	module.import('vermicelist')
	
		

	</script>
</html>
