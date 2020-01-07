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
<link href="<?php echo UOOT;?>Public/app/css/c.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<style>
	.myform-left{width:60%;margin-top: 70px;}
	.ks-table td{border-bottom: 0;}
</style>
<script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>

</head>

<body class="ks-wrap">
	
	
<form target="hidframe" id="myform" action="<?php  echo  M_URL($this->AppName.'/Index','doaddUser',$courseid,GP('')); ?> " method="post" class="form-horizontal">

	<div class="clearfix" style="min-height: 350px;">
		<div class="myform-left" >
			<table class="ks-table">
	
	   
	        <tr><td>账号:<input type="text" name="username"class="new-form"></td></tr>
	        <tr >
	         	  <td>密码:<input type="password" name="password" class="new-form"></td> 
	        </tr>
	          <tr >
	           	<td>姓名 :<input type="text" name="name" class="new-form"></td>
	         </tr>
	   
	</table>
		</div>
		</div>
		<div class="myform-right">
	 		<div class="form-upload">
	              		<div class="js_uploadBox">
	              			<div class="js_showBox"><img class="js_logoBox block avatar" src="<?php  echo nopic(0); ?>" style="width: 200px; height: 150px;"></div>
			                <div class="btn-upload clearfix">
			                    <a href="javascript:void(0);" onclick="addTypeChange('<?php echo M_URL('Index','imageslist','',GP('type-other,name-avatar',true));?>','930px','610px',{title:'选择图片',type:'top'});" class="selectImageBtn"><span class="js_uploadText">上传图片</span></a>
			                    <p>限制：2MB,支持jpg|png|gif</p> 
			                    <input type="hidden" name="avatar">
			               </div>    
					    </div>
	                </div>	
	    </div>   
	   

	   <div class="clearfix ks-popup-footer form-footer" >
	   	<span class="d-inline-block mt20">
    	  <input type="button" onClick="do_reg()" class="ks-bt bt-pue mr10" value="确定" name="confirm" >    
      	</span>
    </div>   	
     
</form>

<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>
<script>
	module.require(['$','backstage','nicescroll'],function(){
		
	     //优化复选框 0未选 1选中      
	     checkbookM();
	     WebLeftSide();
		loadScorllJs();
	})

function do_reg()
{
	var username = $("input[name='username']").val();
	var password = $("input[name='password']").val();
	
    if(username==''){
		Alert('用户名不能为空');
		return false;	
    }
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
    
	$("#myform").submit();	
}

top.imgUploadBack = function(src,img){
	$('.avatar')[0].src = src;
	$('input[name="avatar"]')[0].value = img;
};
</script>
</body>
</html>
