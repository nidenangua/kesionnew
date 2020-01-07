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
	        <h3 class="fl">
	        	修改密码
	        </h3>
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

                <div class="ibox-content">
                    <form target="hidframe" id="myform" action="<?php echo M_URL('Login','dochangePassword'); ?>" method="post" enctype="multipart/form-data" class="form-horizontal">

                        <div class="form-group">
                            <label class="col-sm-2 control-label">原密码</label>
                            <div class="col-sm-4">
                                <input type="password" class="form-control" name="oldpassword">
                            </div>
                            <p class="red" style="font-size: 1rem;padding-top: 7px">*必填</p>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">新密码</label>
                            <div class="col-sm-4">
                                <input type="password" class="form-control" name="password">
                            </div>
                            <p class="red" style="font-size: 1rem;padding-top: 7px">*必填</p>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">请确认密码</label>

                            <div class="col-sm-4">
                                <input type="password" class="form-control" name="assertpassword">
                            </div>
                            <p class="red" style="font-size: 1rem;padding-top: 7px">*必填</p>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="footer-page mt3">
                            <div class="col-sm-5"></div>
                            <div class="col-sm-4 ">
                                <button class="btn mt10 btn-default"  onclick="do_reg();"  type="button">确定修改</button>
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
