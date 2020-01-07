<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit">
<link rel="shortcut icon" href="favicon.ico">
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/admin/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
</head>
<style>
	.fn{float: none!important;}
	.tab{display: none;}
	.info-ul{}
	.info-ul ul{ padding: 30px 60px;}
	.info-ul li span:first-child{margin-right:20px;}
	.info-ul li{font-size: 16px;margin-bottom: 10px;}
	.info-ul li input[type=text]{border: #E5E5E5 1px solid;border-radius: 3px;height:35px; width: 200px;margin-left:10px;}
	.info-ul li textarea{height: 120px;width:300px;resize: none;border: solid 1px #E5E5E5;}
	.wlen{width: 300px;text-align: left!important;}
	.wlen a{border-radius: 20px;border: solid 1px #34B5EE;font-size: 12px;height: 20px;padding: 0px 10px;color:#34B5EE;}
	.tab tr:first-child{background: #CCCCCC;}
	.tab tr{border-bottom: 1px dashed #E5E5E5;}
</style>
<body>
	
	<div class="tab" style="display: block;">
		<div class="info-ul">
			<form target="hidframe" id="myform"  method="post" class="form-horizontal" action="<?php echo M_URL('home/Domain','adminrecharge',$wxid,GP(''));?>" enctype="multipart/form-data">
			<ul>
				<li>
					<span>网校名称：</span>
					 一心教育
				</li>
				<li>
					<span>套餐情况：</span>
					普通版
				</li>
				<li>
					<span>退款余额：</span>
					<input type="text" />
				</li>
				
				<li>
					<div style="position: relative;padding-left: 100px;">
						<span style="position: absolute;left: 0px;top: 0px;width: 100px;text-align: right;">备注：&nbsp;&nbsp;&nbsp;&nbsp;</span>
						<textarea name="" rows="" cols=""></textarea>
					</div>
				</li>
				
				
				
			</ul>
			</form>
		</div>
		<div style="width: 100%;height: 40px; position: absolute;text-align: center;bottom: 15px;left: 0px;;">
			<button class="ks-bt bt-pue fn" onclick="do_reg()">&nbsp;&nbsp;确认&nbsp;&nbsp;</button>&nbsp;&nbsp;&nbsp;&nbsp;
			<button class="ks-bt bt-gray fn" onclick="closed()">&nbsp;&nbsp;取消&nbsp;&nbsp;</button>
		</div>
	
	

	</div>
	



</body>
<script type="text/javascript">
	function closed(){
		top.main.$(".ks-popup-close").click();
	}
	function do_reg(){
		$('#myform').submit();
	}
</script>
</html>



