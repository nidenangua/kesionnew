<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>问答模块</title>
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
</head>
<style>
	.ks-wbox{padding-top: 15px; padding-bottom: 15px;}
	.upload-img{width: 150px;height: 120px;text-align: center;line-height:120px;float: left;border: 1px solid #eee;cursor: pointer;}
	.upload-img i{color:#666;font-size: 40px;}
	.up-circle{width: 60px;height: 60px;border-radius:50%;background: #999 ;display: inline-block;vertical-align: middle;line-height:60px;margin: 20px 0 10px 0;}
	.up-circle i{color:#fff}
 </style>
<body class="ks-wrap" style="padding: 0;">
	<div class="ks-wbox">
		<form target="hidframe"  method="post" action="<?php if(isset($school)){echo M_URL($this->AppName.'/Index','doeditSchool',$school['schoolid'],GP('')); }else{echo M_URL($this->AppName.'/Index','doaddschool','',GP(''));} ?>"  id="myform">
  		
  		<div >

    		
            <div class="form-row">
              		<span class="name"><i class="form-star">*</i>校区名称</span>
              		<div class="form-limit" limit="50">
              			<input type="text" class="form-textbox" name="school" value="<?php if(isset($school)){echo $school['school'];} ?>" />
              		</div>
            </div>
            <div class="form-row">
          		<span class="name"><i class="form-star">*</i>联系人</span> 
          		<div class="form-limit" limit="50"> 
          				<input type="text" class="form-textbox" name="name" value="<?php if(isset($school)){echo $school['name'];} ?>" />
          		</div>
            </div>
             <div class="form-row">
          		<span class="name"><i class="form-star">*</i>联系方式</span> 
          		<div class="form-limit" limit="50"> 
          				<input type="text" class="form-textbox" name="tel" value="<?php if(isset($school)){echo $school['tel'];} ?>" />
          		</div>
            </div>
   
            
            <div class="form-row">
          		<span class="name"><i class="form-star">*</i>校区地址</span>
          		<div class="form-limit" limit="50"> 
          			<input type="text" class="form-textbox" name="address" value="<?php if(isset($school)){echo $school['address'];} ?>" />
          		</div>
            </div>
          
    		
		</div>
 	</form>   
<div class="clearfix ks-popup-footer form-footer">
		<span class="d-inline-block mt20">
			<button type="button" onClick="do_reg()" class="ks-bt bt-pue mr10"><?php if(!empty($value)){echo "确认修改";}else{echo "确认添加";} ?></button>
		<a href="javascript:top.closePopup('all');" class="ks-bt bt-white"style="min-width: 60px;">取消</a>
		</span>
		  
	</div>

</body>
</html>
<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>

<script>
	module.require(['$','backstage','nicescroll'],function(){
		loadScorllJs();
		$('.upload-img').click(function(){
			$('.js_uploadText').click()
		});
			
		
	});

function do_reg(){
	var school = $("input[name='school']").val();
	var name = $("input[name='name']").val();
	var address = $("input[name='address']").val();
	var phone   =  $("input[name='tel']").val();
    var reg  =/^([1-9]\d*|[0]{1,1})$/;
    
	if(school==''){
		Alert('请输入校区名称');
		return false;	
    }else if(name==''){
    	Alert('请输入联系人姓名');
		return false;	
    }else if(address==''){
    	Alert('请输入联系地址');
		return false;	
    }else if(phone==''){
    	Alert('请输入联系方式');
		return false;	
    }
    
    $("#myform").submit();	
	
 }

</script>
