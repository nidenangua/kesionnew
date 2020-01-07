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
<script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>
</head>
<body>
<form target="hidframe" id="myform" action="<?php  echo  M_URL($this->AppName.'/index','doaddUserTeacher',$courseid,GP('')); ?> " method="post" class="form-horizontal">
<table >
    <tr>
        <td>账号</td>
        <td><input type="text" name="username" ></td>
    </tr>
    <tr>
        <td >密码</td>
        <td >
            <input type="password" name="title">
        </td>
    </tr>
    <tr>
        <td >姓名</td>
        <td >
            <input type="text" name="name">
        </td>
    </tr>
    <div class="form-upload">
              		<div class="js_uploadBox">
              			<div class="js_showBox"><img class="js_logoBox block avatar" src="<?php  echo nopic(1); ?>" style="width: 200px; height: 150px;"></div>
		                <div class="btn-upload clearfix">
		                    <a href="javascript:void(0);" onclick="addTypeChange('<?php echo M_URL('Index','imageslist','',GP('type-other,name-avatar',true));?>','930px','610px',{title:'选择图片',type:'top'});" class="selectImageBtn"><span class="js_uploadText">上传图片</span></a>
		                    <p>限制：2MB,支持jpg|png|gif</p> 
		                    <input type="hidden" name="avatar">
		               </div>    
				    </div>
                </div>	
    
    
    <tr>
        <td class="leftTd alignRight w150"></td>
        <td class="rightTd alignLife">
        <input type="button" onClick="do_reg()" class="generalBtn c-fff fsize16 bRadius5" value="确定" name="confirm">
        </td>
    </tr>
</table>
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
	var title = $("input[name='title']").val();
	var num =/^[0-9]*$/;
    if(title==''){
		Alert('老师姓名');
		return false;	
    }
	$("#myform").submit();	
}

top.imgUploadBack = function(src){
	$('.avatar')[0].src = src;
	$('input[name="avatar"]')[0].value = src;
};
</script>
</body>
</html>
