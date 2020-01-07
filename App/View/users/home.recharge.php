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
<link href="<?php echo UOOT;?>Public/app/css/live.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />


<script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>
<style>

 .addtacher-table th span{display: block;font-size:14px;line-height: 34px;height: 34px ;color:#ababab;font-weight: normal;text-align: left;}	
.js_showBox{border-radius: 10px;top: -60px;box-shadow: none;width: 150px;height: 140px;}	
.form-upload{top: -60px;}
.schedule-span{font-size: 30px;color:#476dbe;font-style: italic;padding-right: ;}
.schedule-title{color: #333;font-size: 16px;}
.class-mw{min-width: 80px;}

</style>
</head>

<body class="ks-wrap" style="padding-top: 0;">

<form target="hidframe" id="myform" action="<?php echo M_URL($this->AppName.'/Index','dorecharge',$userid,GP("p-$now_page")); ?>" method="post" class="form-horizontal">
	
	<div class="myform-left" style="padding-left: 15px;">
		<div class="schedule-title">
 			<span class="schedule-span">1.</span>充值基本信息
		</div>
		<div class="addteacher-box">
			<table class="addtacher-table">
				<tr>
					<th><span><i class="form-star">*</i>学员<?php if(!empty($userinfo)){echo empty($userinfo['name'])?'账号':'姓名';};?></span></th>
					<th style="display: none;"><span><i class="form-star">*</i>充值类型</span></th>
				</tr>
				<tr>
					<td><input class="inputText mr10" name="name" value="<?php if(!empty($userinfo)){echo empty($userinfo['name'])?$userinfo['username']:$userinfo['name'];};?>" readonly="readonly"></td>
					<td style="display: none;">
						<select class="w300 inputText mr10" name="teacherzc" value="" >
				      			<option >学员账户充值</option>
				      	</select>
	      	        </td>
				</tr>
				
			</table>
		</div>
		<div class="form-row" style="display: none;">
	      		<span class="name"><i class="form-star">*</i>操作老师</span>
	      		<div>
	      		<input type="text" class="form-textbox  w300" name="username" value="<?php echo $this->userinfo['username']; ?>" readonly="readonly">
	   			 </div>
	     </div>
	     <div class="schedule-title">
     			<span class="schedule-span">2.</span>充值金额
 			</div>
 		<div class="form-row">
	      		<span class="name"><i class="form-star">*</i>充值金额</span>
	      		<input type="text" class="form-textbox  w300" name="money" value="100.00" id="recharge_money">
	     </div>
	     <div class="form-row">
	      		<span class="name"><i class="form-star">*</i>实收金额</span>
	      		<input type="text" class="form-textbox  w300" name="netreceipts" value="100.00">
	     </div>
	      <div class="form-row">
	      		<span class="name"><i class="form-star">*</i>备注</span>
	      		<textarea class="form-textarea w300" style="min-height: 80px;"></textarea>
	     </div>
		</div>
		</div>
    <div class="clear"></div>  
    <div class="myform-box clearfix" id="ksBoxFooter" >   
    	<div style="display: inline-block;">
	      <input type="button" onClick="do_reg()" class="ks-bt class-mw mr40  bt-pue" value="确定" name="confirm" >  
	      <input type="button" onClick="PopupClose()" class="ks-bt class-mw  bt-pue" value="取消" name="confirm" >  	
	     </div> 	  
    </div>   	  
</form>

<script src="<?php echo UOOT;?>Public/common/js/common.js" ></script>
<script>
$(function(){
     //优化复选框 0未选 1选中      
     checkbookM();
     WebLeftSide();
});
function do_reg(){
//	var username = $("input[name='username']").val();
//	var password = $("input[name='password']").val();
//	var email = $("input[name='email']").val();
//	var mobile = $("input[name='mobile']").val();
//	var reg   = /^1[34578]\d{9}$/;
//	var testEmail =/^[a-zA-Z0-9_-]+@[a-zA-Z0-9_-]+(\.[a-zA-Z0-9_-]+)+$/;
//	if(email != ''){
//		if(!testEmail.test(email)){Alert('邮箱格式不正确');return false;}
//	}
//	
//	if(mobile==''){
//		Alert('联系电话不能为空');
//		return false;	
//  }
//	if(!reg.test(mobile)){Alert('请输入正确手机号');return false;}
	var money = $("input[name='money']").val();
    if(money==0){
		Alert('充值金额不能为零');
		return false;	
    }
	$("#myform").submit();	
}

top.imgUploadBack = function(src,img){
	$('.avatar')[0].src = src;
	$('input[name="avatar"]')[0].value = img;
};
function PopupClose(){
	
	top.closePopup(window.name );//g关闭弹窗
}

$("#recharge_money").keyup(function () {
    var reg = $(this).val().match(/\d+\.?\d{0,2}/);
    var txt = '';
    if (reg != null) {txt = reg[0];}
    $(this).val(txt);
}).change(function () {
    $(this).keyup();
});
</script>
</body>
</html>
