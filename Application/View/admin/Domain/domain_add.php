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
                    <h3 class="fl pl20">修改域名</h3>
                    <div class="ibox-tools">
                        <a href="javascript:void(0)" onclick="history.go(0)" class="collapse-link mt0"><i class="reflash"></i></a>
                    </div>
                    </div>
                </div>          
                <div class="ibox-content ">
<form target="hidframe" id="myform"  method="post" class="form-horizontal" action="<?php if(!empty($value))
{echo M_URL('home/Domain','doEditDomain',$value['id'],GP('p-'.$now_page));}?>" enctype="multipart/form-data">
                <div class="tabs-container pt0">
                    <div class="tab-content">
                    绑定域名：<input name="domain" value="<?php echo $value['domain'];?>">    
                    </div>
                    <br>
                    <div class="tab-content">
                    暂存域名：<input name="predomain" value="<?php echo $value['predomain'];?>">    
                    </div>
                    <div class="footer-page mt3">
                        <div class="col-sm-5"></div>
                        <div class="col-sm-3">
                            <button type="button" onClick="do_reg();" class="btn btn-primary btn-s-md" >确认</button>
                            <a class="btn btn-default btn-s-md" href="javascript:history.go(-1);" >取消</a>
                        </div>
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
</script>
<script>
function do_reg()
{
	$("#myform").submit();	
}
</script>
</body>
</html>


















