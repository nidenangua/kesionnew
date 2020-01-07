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
	input{
		width: 300px;
		height: 34px;
		line-height: 34px;
		border: 1px solid #d6dadf;
		padding: 0 10px;
		border-radius: 3px 0 0 3px;
		margin-left: 10px;
		color: #5e6062;
	}
	input[type=radio]{
		float:none;
	}
	/*.fn{float: none;}*/
	/*.info-ul{}*/
	/*.info-ul ul{ padding-top: 20px;}*/
	/*.info-ul li{font-size: 16px;margin-bottom: 10px; text-align: center;}*/
	/*.info-ul li input{border: #E5E5E5 1px solid;border-radius: 3px;height:35px; width: 300px;margin-left:10px;padding-left: 10px;box-sizing: border-box;}*/
</style>
<body>
	<div class="info-ul">
		<form target="hidframe" id="myform"  method="post" class="form-horizontal" action="<?php if(!empty($value))
		{echo M_URL('Domain','doEditDomain',$value['id'],GP('p-'.$now_page));}?>">

			<div class="tab-content">
				二级域名：
				<input name="domain" value="<?php echo $value['domain'];?>">
			</div>
			<div class="tab-content">
				独立域名：
				<input name="predomain" value="<?php echo $value['predomain'];?>">
			</div>
			<div class="tab-content">
				是否扶持版：
				是<input name="istry" type="radio" value="1" <?php if ($valuesite['istry']==1) echo " checked";?> />
				否<input name="istry" type="radio" value="0" <?php if ($valuesite['istry']==0) echo " checked";?> />
			</div>
			<div class="tab-content">
				视频转码：
				是<input name="istranscode" type="radio" value="1" <?php if ($value['istranscode']==1) echo " checked";?> />
				否<input name="istranscode" type="radio" value="0" <?php if ($value['istranscode']==0) echo " checked";?> />
			</div>
			<div class="tab-content">
				审核状态：
				待审<input name="status" type="radio" value="0" <?php if ($value['status']==0) echo " checked";?> >
				通过<input name="status" type="radio" value="1" <?php if ($value['status']==1) echo " checked";?> >
				未通过<input name="status" type="radio" value="2" <?php if ($value['status']==2) echo " checked";?> >
			</div>


<!--		<ul>-->
<!--			<li>-->
<!--				二级域名 <input name="domain" value="--><?php //echo $value['domain'];?><!--">  -->
<!--				-->
<!--			</li>-->
<!--			-->
<!--			<li>-->
<!--				独立域名 <input name="predomain" value="--><?php //echo $value['predomain'];?><!--">   -->
<!--				-->
<!--			</li>-->
<!--			<li>-->
<!--				审核状态-->
<!--				<label for="status0">-->
<!--					<input id="status0" name="status" type="radio" value="0" --><?php //if ($value['status']==0) echo " checked";?><!-- />待审-->
<!--				</label>-->
<!--				<label for="status1">-->
<!--						<input id="status1" name="status" type="radio" value="1" --><?php //if ($value['status']==1) echo " checked";?><!-- />通过-->
<!--				</label>-->
<!--				<label for="status2">-->
<!--						<input id="status2" name="status" type="radio" value="2" --><?php //if ($value['status']==2) echo " checked";?><!-- />未通过-->
<!--				</label>-->
<!--			</li>-->
<!--            -->
<!--            <li>-->
<!--                是否扶持版-->
<!--                <label for="status0">-->
<!--                    <input name="istry" type="checkbox" value="1" --><?php //if ($valuesite['istry']==1) echo " checked";?><!-- />-->
<!--                </label>-->
<!--               -->
<!--            </li>-->
<!--			-->
<!--		</ul>-->
		</form>
	</div>
	<div style="width: 100%;height: 40px; position: absolute;text-align: center;bottom: 15px;left: 0px;;">
		<button class="ks-bt bt-pue fn"  onClick="do_reg();" style="padding: 0 45px;background: #DA4F0C;border-color:#DA4F0C ;margin-left: 65px;">&nbsp;&nbsp;确认&nbsp;&nbsp;</button>&nbsp;&nbsp;&nbsp;&nbsp;
		<a href="javascript:;" class="ks-bt bt-gray fn" onclick="close1()" style="padding: 0 45px;">&nbsp;&nbsp;取消&nbsp;&nbsp;</a>
	</div>
	

	


</body>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script type="text/javascript">
	
function close1(){
	top.closePopup('all');
}
	
</script>
<script type="text/javascript">
	function do_reg(){
		$('#myform').submit();
	}
</script>
</html>



