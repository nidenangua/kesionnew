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

<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/html5.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>
</head>
<style type="text/css">
	
</style>
<body>
<div class="h5-mark clearfix">
	<div class="h5-left col-6">
		<div class="h5-mark-img" style="width: 340px;height: 568px;">

			<?php if($values['ismode'] != 0){ if(!empty($h5id)){ ?>
				<iframe id="phone" width="100%" height="100%" style="border: none;" src="https://ks.kesion.com/Images/H5/<?php echo $values['enname']; ?>/index.php?h5id=<?php echo $h5id; ?>&wxid=2&act=yulang" alt=""></iframe>
			<?php }else{?>
				<img src="<?php echo $values['ico']; ?>" alt="">
			<?php }}else{?>
				<img src="<?php echo $values['ico']; ?>" alt="">
			<?php } ?>
		</div>
	</div>
				
	<div class="h5-right col-6">
		<div class="h5-mark-code">
		
			<div class="h5-mark-box">
				<img src="<?php echo UOOT.'Images/QRcode/'.createQRcode(ROOT.'Images/QRcode/','http://ks.kesion.com/h5market/inh5game?h5id='.$h5id.'&wxid=2','L',4,'qrcode');?>" alt="">
				<p>微信扫一扫体验活动</p>
			</div>
		</div>
		<button class="ks-bt bt-pue" onclick="do_reg()">创建</button>
	</div>
</div>	
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script src="<?php echo UOOT;?>Public/common/js/select-time.js" type="text/javascript"></script>
<script>

	
	
	
	
	
	function do_reg(){
		 top.frames['main'].location.href = '<?php echo M_URL($this->AppName.'/Index','cjgame',$values['id'],GP(''));?>';
         top.closePopup(window.name);
	
   }


	


</script>
</body>
</html>
