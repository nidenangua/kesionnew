<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit">
<title>科汛在线教育</title>
<link rel="shortcut icon" href="favicon.ico">
<link href="<?php echo UOOT;?>Public/admin/css/kesion-common.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/common/css/laydate.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/admin/css/general.css" rel="stylesheet">
<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
</head>
<body class="gray-bg">
<div class="wrapper mt40" id="scorll">
   <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div id="manage_top" class="menu_top_fixed">
                    <div class="ibox-title">
                    <h3 class="fl pl20">添加新闻</h3>
                    <a  href="javascript:history.back(-1);" class="btn btn-info btn-rounded btn-s-md ml15 mt7">返回</a>
                    <div class="ibox-tools">
                        <a href="javascript:void(0)" onclick="history.go(0)" class="collapse-link mt0">
                            <i class="reflash"></i>
                        </a>
                    </div>
                    </div>
                </div>          
                <div class="ibox-content ">
<form target="hidframe"  method="post" class="form-horizontal" enctype="multipart/form-data">

    <div class="tabs-container">
        <ul class="nav nav-tabs">
       <!----------------- 自定义字段添加后插入选项卡---------------->
        <?php echo $this->Field->getTab($appid,'app','admin');?>
        </ul>
        <div class="tab-content">
        <!----------------- 自定义字段添加后插入---------------->
        <?php echo $this->Field->getF($appid,'app','admin');?>
        </div>
        <div class="hr-line-dashed"></div>
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
	datatime('#test');//时间
	loadScorllJs();//滚轮
	uploadView('100','100');//上传图片
	taps();
})
</script>
</body>
</html>