<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit"> 
<title>kesion教育平台</title>
<meta name="Keywords" content="kesion教育平台"/>
<meta name="Description" content="kesion教育平台" />
<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />


<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />


</head>
<body class="ks-wrap" style="overflow: hidden;padding-top: 10px;">
 <form target="hidframe"  action="<?php  echo M_URL($this->AppName.'/Index','addresultred',$id,GP('')) ?>" method="post" id="myform" class=" bRadius10 ">


<div style="min-height: 300px;">


 		<div class="myform-box clearfix">	
			<div class="myform-right ">	
			    <div class="form-row fl">
		      		<span class="name name-nowrap">1.上课状态</span>
		      		<select class="w150 inputText " id="type" name="status">
 						<option value="3"  >已上课</option>
 						<option value="2"  >未上课</option>
					</select>
				</div>
	 		</div>
	 	</div>
	 	
    	
 		<div class="myform-box clearfix">	
			<div class="myform-right ">	
			    <div class="form-row fl">
		      		 	<span class="name name-nowrap">2.试听效果</span>
		      		<select class="w150 inputText " id="type" name="satisfaction">
 						<option value="1" >不行</option>
 						<option value="2"  >一般</option>
 						<option value="3"  >还好</option>
 						<option value="4"  >非常好</option>
					</select>
				</div>
	 		</div>
	 	</div>
	 		
 	
 		<div class="myform-box clearfix">
 			
 			<div class="form-row">
 				<span class="name name-nowrap">3.试听内容</span>
		 		<input type="text" class="inputText" name="mark" id="mark" value="" />
 			</div>
 	</div>
 
 	
 	</div>


<div class="clearfix ks-popup-footer form-footer" >
			<div class="d-inline-block mt20">
				
			
			
		
					<input type="button" class="ks-bt bt-pue mr10" onclick="do_reg()" value="保存">
			
					<input type="button" class="ks-bt bt-white mr10" onclick="close1()" value="取消">		
			</div>
			
</div>
</form>
<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>
<script >
	module.require(['$','backstage','nicescroll','cookie'],function(){
		loadScorllJs();
	})
	function close1(){
	//parent.closePopup('all');
	top.closePopup('all');
}
function do_reg(){
	$('#myform').submit();	
}
</script>
</body>
</html>
