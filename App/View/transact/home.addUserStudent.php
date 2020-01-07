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
<link href="<?php echo UOOT;?>Public/app/css/live.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />

<script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>
<style>

.js_showBox{border-radius: 10px;top: -60px;box-shadow: none;width: 150px;height: 140px;}	
.form-upload{top: 30px;}
.schedule-span{font-size: 30px;color:#476dbe;font-style: italic;padding-right: ;}
.schedule-title{color: #333;font-size: 16px;}
.class-mw{min-width: 80px;}

</style>
</head>

<body class="ks-wrap" style="padding-top:0 ;">
<div id="ksBoxHead"></div>	
<form class="" target="hidframe" id="myform" action="<?php  echo  M_URL($Data002['appname'].'/Index','doaddUser',$courseid,GP('')); ?> " method="post" class="form-horizontal" style="padding:0 20px">
	
	<div class="myform-box clearfix" >
		<div class="schedule-title">
     	<span class="schedule-span">1.</span>基本信息
 	</div>
			<div class="myform-left">
				
                <div class="form-row">
                    <span class="name">
                        <i class="form-star">*</i>登录账号
                    </span>
                    <input type="text" id="username" name="username" class="new-form w400" />
                </div>
                <div class="form-row">
                    <span class="name">
                        <i class="form-star">*</i>登录密码
                    </span>
                    <input type="password" name="password" class="new-form w400" />
                </div>
			    
                <div class="form-row clearfix">
                    <span class="name name-nowrap">性别</span>
                    <label for="inlineRadio8" class="label-on">
                        <input type="radio" id="inlineRadio8" value="1" class="radioInput" name="Sex" checked="checked"> 男
                    </label>
                    <label for="inlineRadio7" class="label-on">
                        <input type="radio" id="inlineRadio7" value="2" class="radioInput" name="Sex"/>女
                    </label>
                </div>
			</div>
			<div class="myform-right">
		 		<div class="form-upload">
		              		<div class="js_uploadBox">
		              			<div class="js_showBox"><img class="js_logoBox block avatar" src="<?php  echo nopic(4); ?>" style="width: 200px; height: 150px;"></div>
				                <div class="btn-upload clearfix">
				                    <a href="javascript:void(0);" onclick="addTypeChange('<?php echo M_URL('Index','imageslist','',GP('type-other,name-avatar',true));?>','930px','610px',{title:'选择图片',type:'top'});" class="selectImageBtn"><span class="js_uploadText">上传图片</span></a>
				                    <p>限制：2MB,支持jpg|png|gif</p> 
				                    <input type="hidden" name="avatar">
				               </div>    
						    </div>
		                </div>	
		    </div> 
    </div>  
    <div class="clear" style="height: 10px;"></div> 
     
  <div class="myform-box clearfix">  
  	<div class="schedule-title">
     	<span class="schedule-span">2.</span>其他
 	</div>
	   <!--<i class="form-star">*</i>-->
	   <!--<div class="myform-left fl">myform-right fr
			  <div class="form-row">
		      		<span class="name">紧急联系人</span>
		      		<input type="text" name="emergencyContact" class="new-form">	
		     </div>
		      <div class="form-row">
		      		<span class="name">紧急联系人电话</span>
		      		<input type="text" name="emergencyContactTel" class="new-form">			
		     </div>
		</div>-->
		 <div class="myform-left fl">
           <div class="form-row">
               <span class="name">学生姓名</span>
               <input type="text" name="name" class="new-form" />
           </div>
		      <div class="form-row">
		      		<span class="name"><!--<i class="form-star">*</i>-->联系电话</span>
		      		<input type="text" name="mobile" class="new-form">			
		     </div>
	
		</div>
    </div>
 <div class="myform-bbox" id="ksBoxFooter">   
 	<div style="display: inline-block;">
      <input type="button" onClick="do_reg()" class="ks-bt class-mw bt-pue mr40" value="确定" name="confirm" >    
      <input type="button" onClick="PopupClose()" class="ks-bt class-mw bt-def" value="取消" name="confirm" > 
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
	var name = $("input[name='name']").val();
	var password = $("input[name='password']").val();
	var emergencyContact = $("input[name='emergencyContact']").val();
	var emergencyContactTel = $("input[name='emergencyContactTel']").val();
	var mobile = $("input[name='mobile']").val();
	var reg   = /^1[34578]\d{9}$/;
	
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
//   if(emergencyContact==''){
//  	Alert('紧急联系人不能为空');
//		return false;	
//  }
//   if(emergencyContactTel==''){
//  	Alert('紧急联系人电话不能为空');
//		return false;	
//  }
    if(mobile==''){Alert('学生联系电话');return false;}	
    if(!reg.test(mobile)){Alert('学生联系电话不正确');return false;}
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
