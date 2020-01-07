<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="renderer" content="webkit">
    <title><?php if(!isset($admin)){echo '添加管理员';}else{echo '修改管理员';} ?></title>
    <link rel="shortcut icon" href="favicon.ico">
    <link href="<?php echo UOOT;?>Public/admin/css/general.css" rel="stylesheet">
     <link href="<?php echo UOOT;?>Public/admin/css/kesion-common.css" rel="stylesheet">
	<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/admin/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/app/css/font.css?<?php echoHash(); ?>" rel="stylesheet" />
    <script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
</head>
<body class="gray-bg">
<div class="row">
	<div id="manage_top" class="menu_top_fixed  p15 height73">
	    <div class="ibox-title">
	        <h3 class="fl">海报信息编辑</h3>
	        <div class="fr">
	             <div class="fl ks-top-search">
				<!--搜索-->
					<button type="button" class="ks-bt bt-def" onclick="history.go(-1)"><i class="iconfont icon-fanhui"></i>返回</button>
				<!--搜索-->
				</div>  
	        </div>
	    </div>
	</div>
</div>
<div class="wrapper mt0" style="margin-top: 50px;">
    <div class="row bg-white p15 " style="border-radius: 10px;">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h3 class="ml15"><?php if(!isset($admin)){echo '添加海报信息';}else{echo '修改海报信息';} ?></h3>
                    <div class="ibox-tools">
                        <a href="javascript:void(0)" onclick="history.go(0)" class="collapse-link">
                            <i class="fa fa-refresh"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
<form target="hidframe" id="myform" action="<?php if(!isset($admin)){echo M_URL('Setting','doaddPoster');}else{echo M_URL('Setting','doeditPoster',$admin['posterid'],GP('p-'.$now_page));} ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
    <div class="form-group">
        <label class="col-sm-2 control-label">海报名称</label>
        <div class="col-sm-4">
            <input type="text" class="form-control" name="realname" <?php if(isset($admin)){echo "value='$admin[realname]'";} ?>>
        </div>
    </div>
    <div class="form-upload" style="position: inherit;margin-left: 152px;">
  		<div class="js_uploadBox">
  			<div class="js_showBox" style="height: 360px;display: table-cell;border-radius:0 ;vertical-align: middle;text-align: center;position: relative;left: 90px;"><img class="js_logoBox block defaultpic" src="<?php if(isset($admin)){echo $admin['defaultpic'];}else{echo '/Images/images/201812/5c1071411ac76.jpg';} ?>" style="display: inline-block;vertical-align: middle;width:auto!important;min-height: inherit!important;"></div>
            <div class="btn-upload clearfix">
<a href="javascript:addTypeChange('//store.kesion.com/admin.html/home/Index/imageslist?type-other,name-defaultpic','930px','610px',{title:'选择图片',type:'top'});" class="selectImageBtn">
                <span class="js_uploadText">上传图片</span></a>
                <p>限制：2MB,支持jpg|png|gif</p> 
                <input type="hidden" name="defaultpic" value="<?php if(isset($admin)){echo $admin['defaultpic'];}else{echo '/Images/images/201812/5c1071411ac76.jpg';} ?>">
           </div>
	    </div>
	</div>
    <div class="hr-line-dashed"></div>
    <div class="footer-page mt3">
        <div class="col-sm-5"></div>
        <div class="col-sm-4 ">
            <button class="btn mt10 btn-default"  onclick="do_reg();"  type="button"><?php if(!isset($admin)){echo '确定添加';}else{echo '确定修改';} ?></button>
            <a href="javascript:history.go(-1);" class="btn mt10 bt-gray">取消修改</a>
        </div>
    </div>
</form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script>
$(function(){
    loadScorllJs();//滚轮
    taps();//选项卡
    uploadView('100','100');//图片上传	
})
</script>
<script>
top.imgUploadBack = function(src){
	$('.defaultpic')[0].src = src;
	$('input[name="defaultpic"]')[0].value = src;
};
function do_reg(){
    var password = $("input[name='password']").val();
    var passwordchk=$("input[name='assertpassword']").val();
	var oldpassword=$("input[name='oldpassword']").val();
    if(password!=passwordchk){
        Alert('两次密码不一致');
    }
    else{
        $("#myform").submit();
    }
}
</script>
</body>
</html>
