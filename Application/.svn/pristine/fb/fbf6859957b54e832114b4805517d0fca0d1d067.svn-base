

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit">
<link rel="shortcut icon" href="favicon.ico">
<link href="<?php echo UOOT;?>Public/admin/css/html5.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/admin/css/general.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/admin/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/admin/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
</head>

<body class="gray-bg">
<div class="wrapper" style="margin-top:35px">

	<div class="row">
		<div id="manage_top" class="menu_top_fixed  p15 height73" >
		    <div class="ibox-title">
		        <h3 class="fl">&nbsp;&nbsp;优惠券生成
		        	
		        </h3>
		    </div>
		</div>		
	</div>
	<div id="ksBoxContent">
		<div style="padding: 30px 0px;">			
			<form class="H5-gameListConts school-online"  action="<?php echo  M_URL('Coupon','buildcou','',GP('')); ?>" method="post">
                  	<label for="coupontype" >
					     <input type="text" onkeyup="this.value=this.value.replace(/\D/g,'')" onafterpaste="this.value=this.value.replace(/\D/g,'')" value=""  name="buildnum"><span class="fl">生成数量</span>
				     </label>
				     <button class="ks-bt bt-pue" type="submit" name="couponId" value="<?php echo Field($couId)?>" onclick='do_reg()'>确定生成</button>
				     <button class="ks-bt bt-pue"  ><a href="<?php echo M_URL('Coupon','index','',GP('p-'.Field($now_page))); ?>">取消生成并返回</a></button>
			</form>			        
		</div>	
	</div>

</div>  
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script>
	function do_reg(){
		$('#myform').submit();
	}
</script> 
</body>

</html>
