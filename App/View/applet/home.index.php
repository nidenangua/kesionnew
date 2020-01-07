<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit">
<title>kesion教育平台</title>
<meta name="Keywords" content="kesion教育平台"/>
<meta name="Description" content="kesion教育平台" />
<link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/page.animate.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>
<style type="text/css">
	.titleTab li{width: 33.3%;height:150px;float: left; margin-bottom: 25px;;}
	.titleTab .listbox{text-align: center;height:150px;border: 1px solid #ccc;margin-bottom: 20px;position: relative;cursor: pointer;border-radius: 10px;background: #fff;}
	.titleTab li p{position: absolute;bottom: 22px;margin: 0 auto; right: 0;left: 0;font-size: 17px;}
	.titleTab li span{position: absolute;bottom: 5px;margin: 0 auto; right: 0;left: 0;font-size: 13px;color: #188eee;display: none;}
	.titleTab li img{width: 80px;height: 80px;margin-top: 15px;transition: all 0.3s linear;}
	.titleTab li:hover .listbox{background: #f6f6f6;box-shadow: 0 0 10px #ccc;}
	.titleTab li:hover img{transform: scale(1.1);-webkit-transform: scale(1.1);-moz-transform: scale(1.1)}
	.smll-program {padding:30px 0;}
	.program-box {max-width: 60%;margin: 0 auto;}
</style>
</head>
<body class="ks-wrap">
	
	<div class=" ks-wbox bRadius10">
	
		<!--header-->
	     <div class="ks-head-box">
	     		
	     		<h3 class="ks-head-title">小程序</h3>
	     		
	     </div>
	     <!--header-->
		
		<div class="smll-program">
    		<ul class="clearfix">
    			<li class="col-3 col-md-4">
    				<div class="program-box">
    					<div class="program-img">
    						<img src="<?php echo UOOT;?>Public/app/images/classIcon/program1.jpg">
    					</div>
    					
    				</div>
    			</li>
    			
    		</ul>
    	</div>
	
	</div>

	<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>
	<script>
	
		module.require(['$','backstage','nicescroll'],function(){

			loadScorllJs()
			
		});
	
		function updatesStatus(id){
			  var url = '<?php echo UOOT;?>Plus/Kesion.ajax.php?act=question';      
			  $.ajax({
					type:"get",
					url:url,
					data:{id:id},
					success:function(data,textStatus){
						$("#a"+id).html(data);
					},
					error:function(){
						alert("发生了错误,请检查!");
					}
			   })
		}
	</script>
</body>
</html>








