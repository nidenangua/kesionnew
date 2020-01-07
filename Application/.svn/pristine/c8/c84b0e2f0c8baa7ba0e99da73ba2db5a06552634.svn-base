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
            </div>
        </div>
    </div>
<div class="row bg-white p15">
<form target="hidframe" id="myform" class="form-horizontal" action="<?php if(empty($value)){echo M_URL('Label','LabeldoAdd','',GP('labeltype-'.$labeltype));}else{echo M_URL('Label','LabeldoEdit',$labelid,GP('p-'.$now_page));} ?>" method="post" enctype="multipart/form-data">
        <div class="line line-dashed b-b line-lg pull-in"></div>
        <div class="form-group">
            <label class="col-sm-2 control-label">标签类型：</label>
            <div class="col-sm-2 w200">
             -<?php echo BCT($labeltype);?>-
            <input type="hidden" value="<?php echo $labeltype;?>" id="basictype">
            </div>
        </div>
        <div class="line line-dashed b-b line-lg pull-in"></div>
        <div class="form-group">
            <label class="col-sm-2 control-label">数据缓存时间：</label>
            <div class="w100 fl pl15">
                <input type="number" class="form-control" value="<?php if(!empty($value)){echo $Label->GetParam($value['labelcontent'],'CacheTime');}else{echo 0;} ?>" id="CacheTime" />
            </div>
            <label class="control-label fl"><strong>分钟</strong>Tips:设置为“0”不启用缓存，设置为“-1”永久缓存。对查询出来的数据没有经常更新的标签，建议设置一个缓存时间，减少数据库查询，整个系统的性能将得到很好的提升。</label>
        </div>
        <div class="line line-dashed b-b line-lg pull-in"></div>
        <div class="form-group">
            <label class="col-sm-2 control-label">静态标签具体内容：</span></label>
            <div class="col-sm-9">
                <textarea class="form-control" onclick="setPos()" onkeyup="setPos()" id="KSContent_LoopBody" style="height: 450px"><?php if(!empty($value)){$labelcontent=$Label->GetLoopBody($value['labelcontent']);if(!empty($labelcontent)){echo EncodeHtml($labelcontent);}} ?></textarea>
            </div>
            <div class="col-sm-2">
                <a type="button" class="textarea-max" id="click1"></a>
                <a type="button" class="textarea-min" id="click2"></a>
            </div>
        </div>
<div class="form-group">
<textarea name="labelcontent" id="KSContent_LabelContent" style="display:none"></textarea>
</div>
<div class="footer-page">
    <div class="col-sm-5"></div>
    <div class="col-sm-3 mt3 ">
        <button type="button" class="btn btn-primary btn-s-md" onClick="do_reg();"><?php if(!empty($value)){?>确定修改<?php }else{ ?>确定添加<?php } ?></button>
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
var pos=null;
function setPos()
{ if (document.all){
		$("#KSContent_LoopBody").focus();
		pos = document.selection.createRange();
	  }else{
		pos = $("#KSContent_LoopBody")[0].selectionStart;
	  }
}
function do_reg()
{
	var str='{KS:Label Type="State"'
		  + ' CacheTime="'+$('#CacheTime').val()+'"'
		  + '}' + $('#KSContent_LoopBody').val() + '{/KS:Label}'; 
		  
	$("#KSContent_LabelContent").val(str);
	if($("#basictype").val()=='')
	{
		Alert('请选择应用的基类型!');return false;
	}
	$("#myform").submit();	
}
function InsertLabel(fieldname,fieldtype){
	var appid=$("#appid").val();
    if(pos==null) {Alert('请先定位插入位置!');return false;}
    var url_model = '<?php echo URL_MODEL; ?>';
	if(url_model == '1')
	{
       addTypeChange('<?php echo M_URL('Label','LoopAdd');?>?fieldname-'+fieldname+',fieldtype-'+fieldtype+',appid-'+appid,'480px','420px');
	}else{
	   addTypeChange('<?php echo M_URL('Label','LoopAdd');?>&fieldname='+fieldname+'&fieldtype='+fieldtype+'&appid='+appid,'480px','420px');
	}
}
//插入到循环体
function InsertValue(Val) {
	if (pos == null) { KesionJS.Alert('请先定位插入位置!', null); return false; }
	if (document.all){
	   pos.text=Val;
	}else{
	   var obj=jQuery("#KSContent_LoopBody");
	   var lstr=obj.val().substring(0,pos);
	   var rstr=obj.val().substring(pos);
	   obj.val(lstr+Val+rstr);
    }
}  
function setstyle(v){
var s1 = "[Loop Times=\"10\"]\n <li><span class=\"date\">{$Field(AddDate,date,YY-MM-DD)}</span><a href=\"{$Field(InfoID,url,2,3)}\">{$Field(Title,text,30,...,2,)}</a></li>\n[/Loop]";
var s2 = "[Loop Times=\"10\"]\n <table border=\"0\" cellspacing=\"1\" cellpadding=\"0\">\n"
	  +"<tr>\n"
	  + " <td align=\"center\"><a href=\"{$Field(InfoID,url,2,3)}\"><img src=\"{$Field(DefaultPic,text,0,...,2,/sysimg/nopic.gif)}\" border=\"0\" width=\"130\" height=\"90\"></a><br />\n"
	  + " <a href=\"{$Field(InfoID,url,2,3)}\">{$Field(Title,text,18,0,2,)}</a>\n"
	  +" </td>\n"
	  +"</tr>\n"
	  +"</table>\n[/Loop]";
var s3 = "[Loop Times=\"10\"]\n <table border=\"0\" cellspacing=\"1\" cellpadding=\"0\">\n"
   +" <tr>\n"
   +"  <td align=\"center\"><a href=\"{$Field(InfoID,url,2,3)}\"><img src=\"{$Field(DefaultPic,text,0,...,2,/sysimg/nopic.gif)}\" border=\"0\" width=\"130\" height=\"90\"></a>\n"
   +"  </td>\n"
   +"  <td><a href=\"{$Field(InfoID,url,2,3)}\">{$Field(Title,text,18,0,2,)}</a><br />\n"
   +"{$Field(Intro,text,80,...,2,)}</td>\n"
   +"  </tr>\n"
   +"</table>\n[/Loop]";
var s4 = "[Loop Times=\"10\"]\n <table align=\"center\" border=\"0\" height=\"160\" cellspacing=\"1\" cellpadding=\"0\">\n"
   +" <tr>\n"
   +"   <td valign=\"top\">\n"
   +"   <div style=\"text-align:center\"><a href=\"{$Field(InfoID,url,2,3)}\"><img src=\"{$Field(DefaultPic,text,0,...,2,/sysimg/nopic.gif)}\" border=\"0\" width=\"130\" height=\"90\"></a></div><br />\n"
   +"   <a href=\"{$Field(InfoID,url,2,3)}\">{$Field(Intro,text,50,...,2,)}</a>\n"
   +"  </td>\n"
   +" </tr>\n"
   +"</table>\n[/Loop]"
$("#KSContent_LoopBody").val(eval("s"+v));
}
$(function(){
	var i =1;
	var h = $('#KSContent_LoopBody').height();
	$('#click1').click(function(){
		if(i<10){
			h = h+50;$('#KSContent_LoopBody').height(h);i++;
	    }
	})
	$('#click2').click(function(){
		if(i>1){
			h = h-50;$('#KSContent_LoopBody').height(h);i--;
		}
	})
})
</script>
</body>
</html>