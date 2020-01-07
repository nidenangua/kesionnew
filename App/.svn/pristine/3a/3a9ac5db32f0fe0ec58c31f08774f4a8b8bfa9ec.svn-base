<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit">
<title>kesion教育平台</title>
<meta name="Keywords" content="kesion教育平台"/>
<meta name="Description" content="kesion教育平台" />
<link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/live.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/admin/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>
</head>
<style>
.tubiao{width:25%; height:230px; float:left;  cursor:pointer;color:#bfbfbf;}
.tubiao:hover{width:25%; height:230px; float:left;  cursor:pointer;color:#1196db;}
#tubiad{width:25%; height:230px; float:left;  cursor:pointer;color:#1196db;}
.iconf{width:100%; height:180px; overflow:hidden; text-align:center;}
.icowen{width:100%; height:50px; font-size:20px; line-height:50px; text-align:center;}
.radio1{display:none;}
</style>
<body>
<form target="hidframe" id="myform"  action="<?php echo M_URL('course/index','doaddcourse','',GP('')) ?>"  method="post" class="form-horizontal">
<div style="padding-left:50px; padding-right:50px;">
	<div  style="width:100%; height:50px; border-bottom:1px solid #EBEBEB; line-height:50px; font-size:22px;">课程类型</div>
    <div  style="width:100%; overflow:hidden; margin-top:10px;">
		<div class="tubiao" id="tubiad">
		<input type="radio" value="2" class="radio1" id="live0" name="courseType" checked>
		  <label for="live0">
        	<div class="iconf" ><span  class="xiani"><i class="iconfont icon-zhibo" style="font-size:15em;" ></i></span></div>
            <div class="icowen">直播</div>
			</label>
        </div>
        <div class="tubiao">
		<input type="radio"  class="radio1" id="click0" value="1" name="courseType">
		<label for="click0">
        	<div class="iconf" ><span  class="xiani"><i class="iconfont icon-dianbo" style="font-size:15em;" ></i></span></div>
            <div class="icowen">点播</div>
		</label>
        </div>
		<div class="tubiao">
		<input type="radio"  class="radio1" id="mace0" value="3" name="courseType">
		<label for="mace0">
        	<div class="iconf" ><span  class="xiani"><i class="iconfont icon-shangke" style="font-size:15em;"></i></span></div>
            <div class="icowen">面授</div>
		</label>
        </div>
        <div class="tubiao">
		<input type="radio"  class="radio1" id="zhuhe0" value="4" name="courseType">
		<label for="zhuhe0">
        	<div class="iconf" ><span  class="xiani"><i class="iconfont icon-zuhetubiao" style="font-size:15em;" value="4"></i></span></div>
            <div class="icowen">组合</div>
		</label>	
        </div>
    </div>
	
    <div style="width:100%; height:50px;"><input type="text" name="title" style="width:100%; height:40px; border:1px solid #1196db;"></div>
    <div style="width:100%; height:30px; text-align:left; color:#1196db; font-size:16px;">课程名称</div>
	<div style="width:100%; height:50px; text-align:center;"><input  type="button" onClick="do_reg()"  style="width:200px; height:50px; border:1px solid #1196db; border:none; border-radius:5px; font-size:20px; background-color:#1196db; color:white;" value="马上创建"></div>
</div>
</form>
<script>
$(function(){
	$(".tubiao").click(function(){
		$(".tubiao").attr("id","");
		$(this).attr("id","tubiad");
	})
});
</script>
<script src="<?php echo UOOT;?>Public/common/js/common.js" ></script>
<script>
function do_reg()
{
	var title = $("input[name='title']").val();
	var num =/^[0-9]*$/;
    if(title==''){
		Alert('课程题目');
		return false;	
    }
	$("#myform").submit();	
}
</script>
</body>
</html>
