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
	        	管理员编辑
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
                <div class="ibox-title">
                    <h3 class="ml15"><?php if(!isset($admin)){echo '添加管理员';}else{echo '修改管理员';} ?></h3>
                    <div class="ibox-tools">
                        <a href="javascript:void(0)" onclick="history.go(0)" class="collapse-link">
                            <i class="fa fa-refresh"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <form target="hidframe" id="myform" action="<?php echo M_URL('Admin','manageDoSave',isset($admin)?$admin['adminid']:'',$now_page); ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">用户名</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="adminname" <?php if(isset($admin)){echo "value='$admin[username]' readonly";}  ?>>
                            </div>
                            <p class="red" style="font-size: 1rem;padding-top: 7px">*必填</p>
                        </div>

                        <div class="form-group">
                            <?php  if(isset($admin)){
								$html='<label class="col-sm-2 control-label">请输入原密码</label>
                            <div class="col-sm-4">
                                <input type="password" class="form-control" name="oldpassword">
                            </div>
                             <p class="red" style="font-size: 1rem;padding-top: 7px">*必填</p>';
								echo $html;}?>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><?php if(!isset($admin)){echo "密码";}else{echo "新密码";}?></label>
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
                        <div class="form-group">
                            <label class="col-sm-2 control-label">真实姓名</label>

                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="realname" <?php if(isset($admin)){echo "value='$admin[realname]'";} ?>>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">联系方式</label>

                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="mobile" <?php if(isset($admin)){echo "value='$admin[mobile]'";} ?>>
                            </div>
                            <p class="red" style="font-size: 1rem;padding-top: 7px">*必填</p>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">管理员类别</label>

                            <div class="col-sm-4">
                                <select class="form-control" name='admintype'>
                                    <option>请选择管理员类型</option>
                                    <?php foreach($power as $kt =>$vt){ ?>
                                   		<option value='<?php echo $vt['id']; ?>' <?php   if(isset($admin)){if($admin['admintype']==$vt['id']){echo "selected";}} ?>><?php echo $vt['rulename'] ?></option>
                                    <?php } ?>                               	
                              	</select>
                            </div>
                        </div>
                        <div class="form-upload">
                            <div class="js_uploadBox">
                                <div class="js_showBox" style="border-radius:0 ;"><img class="js_logoBox block defaultpic" onerror="this.src='//ks.kesion.com/Public/uploads/common/nopic.gif'" src="<?php if(!empty($admin)){echo $admin['defaultpic'];} ?>"></div>
                                <div class="btn-upload clearfix">
                                    <a href="javascript:addTypeChange('<?php echo M_URL('Index','imageslist','',GP('type-other,name-defaultpic',true));?>','930px','610px',{title:'选择图片',type:'top'});" class="selectImageBtn" >
                                        <span class="js_uploadText">上传图片</span></a>
                                    <p>限制：2MB,支持jpg|png|gif</p>
                                    <input type="hidden" name="defaultpic" src="<?php if(!empty($admin)){echo $admin['defaultpic'];} ?>">
                                </div>
                            </div>
                        </div>
<!--                        <div class="form-upload">-->
<!--			          		<div class="js_uploadBox">-->
<!--			          			<div class="js_showBox" style="height: 160px;display: table-cell;border-radius:0 ;vertical-align: middle;text-align: center;position: relative;left: 90px;"><img class="js_logoBox block logo" src="https://bj.bcebos.com/kesion/school/2/201801/5a55901dc7088.png?authorization=bce-auth-v1%2F134e7d2d4c4e433880ec6b5053439f65%2F2018-01-10T04%3A01%3A34Z%2F-1%2F%2F7354ea53e2bbde4ed44b15af5aa72bcb9392daf3ceae7ffd834210f458a5c127" style="display: inline-block;vertical-align: middle;width:auto!important;min-height: inherit!important;"></div>-->
<!--				                <div class="btn-upload clearfix">-->
<!--				                    <a href="javascript:addTypeChange('//www.zuojy.com/admin.html/default/Index/imageslist?type-other,name-defaultpic','930px','610px',{title:'选择图片',type:'top'});" class="selectImageBtn">-->
<!--				                    	<span class="js_uploadText">上传图片</span></a>-->
<!--				                    <p>限制：2MB,支持jpg|png|gif</p>-->
<!--				                    <input type="hidden" name="logo" value="https://bj.bcebos.com/kesion/school/2/201801/5a55901dc7088.png?authorization=bce-auth-v1%2F134e7d2d4c4e433880ec6b5053439f65%2F2018-01-10T04%3A01%3A34Z%2F-1%2F%2F7354ea53e2bbde4ed44b15af5aa72bcb9392daf3ceae7ffd834210f458a5c127">-->
<!--				               </div>-->
<!--						    </div>-->
<!--		          		</div>-->

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
//        uploadView('100','100');//图片上传
    })
    top.imgUploadBack = function(src,img){
        $('.defaultpic')[0].src = src;
        $('input[name="defaultpic"]')[0].value = src;
    };
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
