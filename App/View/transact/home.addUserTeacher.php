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
 .addtacher-table th span{display: block;font-size:14px;line-height: 34px;height: 34px ;color:#ababab;font-weight: normal;text-align: left;position: relative;}	
.js_showBox{border-radius: 10px;top: -60px;box-shadow: none;width: 150px;height: 140px;}	
.form-upload{top: -60px;}
.schedule-span{font-size: 30px;color:#476dbe;font-style: italic;padding-right: ;}
.schedule-title{color: #333;font-size: 16px;}
.class-mw{min-width: 80px;}
</style>
</head>
<body class="ks-wrap" style="padding-top: 0;">
<div id="ksBoxHead">
	</div>	
<form target="hidframe" id="myform" action="<?php echo empty($userinfo)?M_URL($Data002['appname'].'/Index','doaddUser',$courseid,GP('')):M_URL($Data002['appname'].'/Index','doEditUser',$courseid,GP('userid-'.$userid)); ?> " method="post" class="form-horizontal">
	<div class="myform-left">
			<div class="schedule-title">
     	<span class="schedule-span">1.</span>基本信息
 	</div>
		<div class="addteacher-box">
			<table class="addtacher-table">
				<tr>
					<th><span class="name"><i class="form-star">*</i>老师姓名</span></th>
					<th><span class="name">教师职称</span></th>
				</tr>
				<tr>
					<td><input class="w150 inputText mr10" name="name" value="<?php echo empty($userinfo)?'':$userinfo['name'];?>"></td>
					<td><input class="w150 inputText mr10" name="teacherzc" value="<?php echo empty($userinfo)?'':$userinfo['teacherzc'];?>"></td>
				</tr>
				
			</table>
		</div>
		<div class="form-row">
	      		<span class="name"><i class="form-star">*</i>联系电话</span>
	      		<div  >
	      		<input type="text" class="form-textbox  w300" name="mobile" value="<?php echo empty($userinfo)?'':$userinfo['mobile'];?>">
	    </div>
		<div class="form-row">
	      		<span class="name">电子邮箱</span>
	      		<div  >
	      		<input type="text" class="form-textbox w300" name="email" value="<?php echo empty($userinfo)?'':$userinfo['email'];?>">
	    </div>
	     </div>
	     
	     	<div class="schedule-title">
     	<span class="schedule-span">2.</span>账户密码
 	</div>
	  
		<div class="form-row">
	      		<span class="name"><i class="form-star">*</i>账号</span>
	      		<div  >
	      		<input type="text" class="form-textbox w300" name="username" value="<?php echo empty($userinfo)?'':$userinfo['username'];?>">
	    </div>
		<div class="form-row">
	      			<span class="name"><i class="form-star">*</i>密码</span>
	      		<div  >
	      		<input type="password" class="form-textbox w300" name="password" value="">
	    </div>
	     </div>
	</div>
	<div class="myform-right">
 		<div class="form-upload">
              		<div class="js_uploadBox">
              			<div class="js_showBox"><img class="js_logoBox block avatar" src="<?php  echo empty($userinfo)?nopic(1):Img($this->upload->getHead($userid,5)); ?>" style="width: 200px; height: 150px;"></div>
		                <div class="btn-upload clearfix">
		                    <a href="javascript:void(0);" onclick="addTypeChange('<?php echo M_URL('Index','imageslist','',GP('type-other,name-avatar',true));?>','930px','610px',{title:'选择图片',type:'top'});" class="selectImageBtn"><span class="js_uploadText">上传图片</span></a>
		                    <p>限制：2MB,支持jpg|png|gif</p> 
		                    <input type="hidden" name="avatar">
		               </div>    
				    </div>
                </div>	
    </div>   
    <div class="clear"></div>  
    <div class="myform-box clearfix" id="ksBoxFooter">   
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
function do_reg()
{
	var username = $("input[name='username']").val();
	var password = $("input[name='password']").val();
	var teachername= $("input[name='teachername']").val();
	var email = $("input[name='email']").val();
	var mobile = $("input[name='mobile']").val();
	var reg   = /^1[34578]\d{9}$/;
	var testEmail =/^[a-zA-Z0-9_-]+@[a-zA-Z0-9_-]+(\.[a-zA-Z0-9_-]+)+$/;
	 if(teachername==''){
    	Alert('教师名称不能为空');
		return false;	
    }
	if(email != ''){
		if(!testEmail.test(email)){Alert('邮箱格式不正确');return false;}
	}
	
	if(mobile==''){
		Alert('联系电话不能为空');
		return false;	
    }
   
	if(!reg.test(mobile)){Alert('请输入正确手机号');return false;}
	
    if(username==''){
		Alert('用户名不能为空');
		return false;	
    }
    <?php if(empty($userinfo)){?>
    if(password==''){
		Alert('密码不能为空');
		return false;	
    }
    if(username.length<6){
    	Alert('用户名不能少于6位');
		return false;	
    }
     if(password.length<6){
    	Alert('密码不能少于6位');
		return false;	
    }
    <?php }?>
	$("#myform").submit();	
}

top.imgUploadBack = function(src,img){
	$('.avatar')[0].src = src;
	$('input[name="avatar"]')[0].value = img;
};
function PopupClose(){
	
	top.closePopup(window.name );//g关闭弹窗
}

</script>
</body>
</html>
