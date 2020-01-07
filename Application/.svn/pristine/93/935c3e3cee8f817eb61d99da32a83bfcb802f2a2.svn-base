<!DOCTYPE html>
<html>
<head lang="en">
<meta charset="UTF-8">
<title></title>
<link href="<?php echo UOOT;?>Public/admin/css/general.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/admin/fonts/iconfont.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/admin/css/kesion-common.css" rel="stylesheet">
<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
<style>
.pl15{padding-left: 15px}
.field{
    height: 22px;
    line-height: 22px;
    float: left;
    border: 1px solid #FFccCC;
    margin: 5px;

    padding-left: 15px;
    padding-right:15px;
    background: #FFFFEC;
    font-weight: bold;
}
.w200 {width:200px !important}
</style>
</head>
<body class="gray-bg">
<div class="wrapper">
    <div class="row ">
        <div id="manage_top " class="menu_top_fixed ">
            <div class="ibox-title">
               <h3 class="fl">&nbsp;&nbsp;&nbsp;&nbsp;创建智能标签:<?php echo $tempval['tempid'].':';if($tempval['temptype']==0){echo '电脑';}else{echo '手机';}echo $tempval['installdir'].'----'.$tempval['tempname'];?></h3>
               <div class="fr">
               	<div class="fl ks-top-search">
               		<button class="ks-bt bt-def"><i class="iconfont icon-refresh"></i>同步到标签库</button>
               		
               	</div>
               	
               </div>
        		
        		
             
            </div>
        </div>
    </div>
<div class="row bg-white p15">
<form target="hidframe" id="myform" class="form-horizontal" action="<?php echo M_URL('Label','LabeldoEdit2',$labelid,GP('tempid-'.$tempid.',p-'.$now_page));?>" method="post" enctype="multipart/form-data">
        <div class="line line-dashed b-b line-lg pull-in"></div>
        <div class="form-group">
            <label class="col-sm-2 control-label">标签类型：-<?php echo BCT($labeltype);?>-</label>
            <div class="col-sm-2 w200"></div>
            <label class="col-sm-2 control-label">标签名称：<?php if(!empty($value)){echo $value['labelname'];} ?></label>
            <div class="col-sm-2 w200"> </div>
        </div>
        <div class="line line-dashed b-b line-lg pull-in"></div>
        <div class="line line-dashed b-b line-lg pull-in"></div>
        <div class="form-group">
            <label class="col-sm-2 control-label">标签具体内容：</span></label>
            <div class="col-sm-9">
                <textarea class="form-control" name="labelcontent" style="height: 730px"><?php if(!empty($value)){echo $value['labelcontent'];} ?></textarea>
            </div>
            <div class="col-sm-2">
                <a type="button" class="textarea-max" id="click1"></a>
                <a type="button" class="textarea-min" id="click2"></a>
            </div>
        </div>
<div class="footer-page">
    <div class="col-sm-5"></div>
    <div class="col-sm-3 mt3 ">
        <button type="submit" class="btn btn-primary btn-s-md"><?php if(!empty($value)){?>确定修改<?php }?></button>
        <a href="<?php echo M_URL('Label','myLabel',$tempid,GP('p-'.$now_page));?>" class="btn btn-default btn-s-md">取消</a>
    </div>
</div>
</form>
    </div>
</div>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script>
loadScorllJs();
</script>
</body>
</html>