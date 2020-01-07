<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link href="<?php echo UOOT;?>Public/admin/css/general.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/admin/css/kesion-common.css" rel="stylesheet">
<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
</head>
<body class="gray-bg" >

<div class="wrapper mt55">
<div class="row">
    <div id="manage_top" class="menu_top_fixed p15 height73">
        <!--<h3 class="fl ml15">模板文件管理</h3>-->
        <ul style=" float:left;">
            <li><a href="javascript:void(0);" onclick="addTypeChange('<?php echo M_URL('Temp','TempaddFile',$tempid,GP('temptype-'.$temptype.',tempdir-'.$tempdirS,true));?>','650px','400px');"><i class="one2017"></i>新建模板</a></li>
            <li><a href="<?php echo M_URL('Temp','tempDirlist',$tempid,GP('temptype-'.$temptype.',tempdir-'.$tempdirS,true));?>"><i class="one2017"></i>回上一级</a></li>
            <li><a href="/admin.php?c=Temp&a=index&p=1&amp;arr=temptype-0"><i class="one2017"></i>模板风格列表</a></li>
            <li><a href=""><i class="one2017"></i>上传模板</a></li>
            <li><a href=""><i class="one2017"></i>标签参数说明</a></li>
        </ul>
        <div class="ibox-tools">
            <a href="javascript:void(0)" onclick="history.go(0)" class="collapse-link mt0">
                <i class="reflash"></i>
            </a>
        </div>
    </div>
</div>
<div class="row p15 bg-white">
<form target="hidframe" method="post" id="myform" action="<?php echo M_URL('Temp','tempDirdoAdd',$tempid,GP('temptype-'.$temptype.',tempdir-'.$tempdirS.',nowdir-'.urlencode($nowdir),true));?>" class="form-horizontal">
    <div class="form-group">
        <label class="col-sm-2 control-label">文件名：</label>
        <div class="col-sm-4">
            <input type="text" class="form-control" value="<?php echo iconv('gbk','utf-8',$tempdir);?>" readonly />
        </div>
    </div>
    <div class="line line-dashed b-b line-lg pull-in"></div>
    <div class="form-group">
        <label class="col-sm-2  control-label" style="padding-top: 5px">标签列表：</label>
        <div class="col-sm-4 taps-li">
          <ul>
              <li><a>公用标签</a></li>
              <li><a>入门级标签</a></li>
              <li><a>中级标签</a></li>
              <li><a>高级标签</a></li>
              <li><a>内容页标签</a></li>
              <li><a>专题系统标签</a></li>
          </ul>
        </div>
    </div>
    <div class="line line-dashed b-b line-lg pull-in"></div>
    <div class="form-group">
        <div class="col-sm-1" style="padding-right: 5px">
            <textarea id="number" style="width:66px;height:400px;overflow-y:hidden;float: right;text-align: right;line-height:32px"></textarea>
        </div>
        <div class="col-sm-10" style="padding-left: 0">
           <textarea  class="teateare-txt" name="content" id="content"><?php echo $string_str;?></textarea>
        </div>
    </div>
    <div class="footer-page mt3">
      <div class="col-sm-5"></div>
      <div class="col-sm-3">
          <button type="button" onclick="do_reg();" class="btn btn-primary btn-s-md">确认</button>
          <a class="btn btn-default btn-s-md" href="<?php echo M_URL('Temp','tempDirlist',$tempid,GP('temptype-'.$temptype.',tempdir-'.$tempdirS,true));?>">取消</a>
      </div>
    </div>
</form>
</div>

</div>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script>
    loadScorllJs();
    var $content =  $('#content');
    var scrollHeight =   $content[0].scrollHeight;
    var cLheight = Number($content.css('line-height').replace('px',''));

    var maxI = scrollHeight/cLheight

    for(var i=0;i<maxI;i++){
       $('#number').append(i+'\n');
    }

    $content.scroll(function(){

        var scrollTop = $(this).scrollTop();
		$('#number').animate({scrollTop:scrollTop},0)
	  })

</script>
<script>
function do_reg()
{

	$("#myform").submit();	
}
</script>
</body>
</html>