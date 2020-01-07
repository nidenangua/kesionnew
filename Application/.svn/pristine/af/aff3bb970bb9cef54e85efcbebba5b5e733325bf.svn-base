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
                <h3 class="fl">&nbsp;&nbsp;&nbsp;&nbsp;添加分页样式</h3>
            </div>
        </div>
    </div>
<div class="row bg-white p15">
<form target="hidframe" id="myform" class="form-horizontal" action="<?php echo M_URL('Label','PagedoAdd','',GP(''));?>" method="post">
        <div class="line line-dashed b-b line-lg pull-in"></div>
        <div class="form-group">
            <label class="col-sm-2 control-label">样式名称：</label>
            <div class="col-sm-4">
                <div class="w150 fl">
                    <input class="form-control" type="text" name="labelname"/>
                </div>
                <label class="control-label fl">&nbsp;&nbsp; * </label>
            </div>
        </div>
        <div class="line line-dashed b-b line-lg pull-in"></div>
        <div class="form-group">
            <label class="col-sm-2 control-label">样式模板：</span></label>
            <div class="col-sm-9">
                <textarea class="form-control" name="labelcontent" id="KSContent_LoopBody" style="height: 450px"></textarea>
            </div>
            <div class="col-sm-2">
                <a type="button" class="textarea-max" id="click1"></a>
                <a type="button" class="textarea-min" id="click2"></a>
            </div>
        </div>
<div class="form-group">
</div>
<div class="footer-page">
    <div class="col-sm-5"></div>
    <div class="col-sm-3 mt3 ">
        <button type="button" class="btn btn-primary btn-s-md" onClick="do_reg();">确定修改</button>
        <a href="javascript:history.go(-1);" class="btn btn-default btn-s-md">取消</a>
    </div>
</div>
</form>
    </div>
</div>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script>
loadScorllJs();
</script>
<script>
function do_reg()
{
	var labelname = $("input[name='labelname']").val();
	if(!labelname)
	{
		Alert('样式名称不能为空!');return false;
	}
	$("#myform").submit();	
}
$(function(){
	var i =1;
	var h = $('#KSContent_LoopBody').height();
	$('#click1').click(function(){
		if(i<10)
		{
			h = h+50;
			$('#KSContent_LoopBody').height(h);
			i++;
	    }
	})
	$('#click2').click(function(){
		if(i>1)
		{
			h = h-50;
			$('#KSContent_LoopBody').height(h);
			i--;
		}
	})
})
</script>
</body>
</html>