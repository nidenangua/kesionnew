<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link href="<?php echo UOOT;?>Public/admin/css/general.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/admin/css/kesion-common.css" rel="stylesheet">
<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
<style>
.pl0{padding-left: 0}
.pr0 {padding-right:0}
.pr5 {padding-right:5px}
.message {
    border: 1px solid #e9eded;
    border-radius: 5px;
    margin-top: 10px;
    padding: 12px 15px;
    text-align: left;
    font-size: 12px;
    word-break: normal;
    overflow: hidden;
    background: #fff;
    color: #333;
    line-height: 22px;
}
.state {
    background: url(images/all_icon.png) no-repeat -406px -184px;
    padding: 2px 0 2px 20px;
}
</style>
</head>
<body>
<form target="hidframe" method="post" id="myform" action="<?php echo M_URL('Temp','TempdoaddFile',$tempid,GP('option-'.$option.',tempdir-'.urlencode($tempdir),true));?>" class="form-horizontal mt20">
    <div class="form-group">
     <div class="col-sm-2 " ></div>
      <label class=" control-label pr5 fl" >
          文件名：<?php echo iconv('gbk','utf-8',$tempdir).'/';?>
      </label>
        <div class="col-sm-4 pl0">
            <input class="form-control" type="text" value="<?php echo $filename;?>" name="filename">
        </div>
    </div>
<div class="footer-page h60">
        <div class="col-sm-4 " ></div>
        <div class="col-sm-6 mt10 pl0">
            <button type="button" class="btn btn-primary btn-s-md" onclick="do_reg();">确定创建</button>
          	<button onclick="top.closePopup('all');"  class="btn bt-gray  btn-s-md" >取消</button>
        </div>
    </div>
</form>
<div class="message">
    <p class="message-title state"><strong>说明</strong>：</p>
    <p class="message-txt">请与扩展名.html,.htm,.shtml,.shtm其中之一为扩展名，如article.html。</p>
</div>
</body>
</html>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script>
function do_reg()
{

	$("#myform").submit();	
}
function cancel()
{
	var index = parent.layer.getFrameIndex(window.name);
    parent.layer.close(index);
}
</script>