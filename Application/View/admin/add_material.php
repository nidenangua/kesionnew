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
    <script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
</head>

<body class="gray-bg">
<div class="wrapper mt0">

    <div class="row bg-white p15">
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
                    <form target="hidframe" id="myform" action="<?php if(!isset($admin)){echo M_URL('Wxmp','add_material1');}else{echo M_URL('Wxmp','add_material1',$admin['adminid']);} ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">图片选择</label>
                            <div class="col-sm-8">
                                <div class="control-group js_uploadBox">
                                    <div class="btn-upload clearfix">
                                        <a href="javascript:void(0);" class="selectImageBtn c-89 fsize14 fl mr10 bRadius5"><span class="js_uploadText">上传</span>图片</a>
                                        <span class="fl c-d0 fsize12" style="height:37px; line-height:37px;">限制：2MB,支持jpg|png|gif</span>
                                        <input class="hide js_upFile" type="file" name="file" id="upImg">
                                    </div>
                                    <div class="js_showBox mt10 w180"><img class="js_logoBox block" src="<?php if(!empty($admin["defaultpic"])){echo Img($admin["defaultpic"]);}else{ echo nopic(1);} ?>" width="180" ></div>
                                </div>
                            </div>
                        </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">用户名</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" name="adminname">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">用户名</label>
                    <div class="col-sm-7">
                        <?php  $kindeditor = ks_editor('intro','');  echo $kindeditor;?>
                    </div>
                </div>
                        <div class="hr-line-dashed"></div>
                        <div class="footer-page mt3">
                            <div class="col-sm-5"></div>
                            <div class="col-sm-4 ">
                                <button class="btn btn-primary"  type="submit"><?php if(!isset($admin)){echo '确定添加';}else{echo '确定修改';} ?></button>
                                <a href="javascript:history.go(-1);" class="btn btn-white">取消</a>
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
</script>
</body>
</html>
