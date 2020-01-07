
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
    <link href="<?php echo UOOT;?>Public/app/css/common.css" rel="stylesheet">
    <link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/admin/css/general.css?<?php echoHash(); ?>" rel="stylesheet" />
    <script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>
    <script type="text/javascript" src="<?php echo UOOT;?>Public/common/js/layer/laydate.js"></script>
	<style>
		.ml30{position: relative;top: 5px; margin-left: 20px!important;}
		.span-inline label{display: block;float: none!important;margin-bottom: 10px;}
	</style>
</head>
<body class="ks-wrap"> 
	
	<div class="bRadius10 ">
 	<form target="hidframe" id="myform"  action="<?php echo M_URL('News','edit','',GP('id-'.$infoary['id'].',p-'.$now_page)) ?>"  method="post" enctype="multipart/form-data">
	<div  class="ks-wbox  bRadius10 " style="margin-top: 0;padding-top: 0;">
		<div id="ksBoxContent" class="view-content">
			<!--公告-->
					  	<!--公告结束-->
			<!--消息-->
			<div class="news">
					<div class="form-row span-inline clearfix">
						     <label for="inlineRadio13" >
							     <span class="fl">用户名</span>
							     <input type="text" class="form-textbox w300" name="names" value="<?php echo $infoary['sitename'] ?>" readonly="readonly" style="margin: 0 5px;">
						     </label>
				    </div>     
			         <div class="form-row clearfix">
						<span class="name name-nowrap">消息标题</span>
						<input type="text" class="form-textbox " name="title" value="<?php echo $infoary['title'] ?>">
					</div>
					  <div class="form-row clearfix">
						<span class="name name-nowrap">消息内容</span>
						<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
			<html><head><title></title><meta http-equiv="Content-Type" content="text/html;charset=utf-8"/><script type="text/javascript" charset="utf-8" src="/Public/ueditor/ueditor.config.js"></script>
			    <script type="text/javascript" charset="utf-8" src="/Public/ueditor/ueditor.all.min.js"> </script>
			    <script type="text/javascript" charset="utf-8" src="/Public/ueditor/lang/zh-cn/zh-cn.js"></script></head>
			<body>
			<div><script id="content" name="content" type="text/plain">
				<?php echo $infoary['content'] ?>
			</script></div>
		<script type="text/javascript">
		    var content = UE.getEditor('content',{});content.commands['myinsertimage'] = { execCommand: function() { addTypeChange("<?php echo M_URL('News','change','',GP('')) ?>","930px","610px",{title:"选择图片",type:"top"}); return true; }, queryCommandState: function() { } };
		    content.commands['myinsertvideo'] = { execCommand: function() { addTypeChange("<?php echo M_URL('News','change','',GP('')) ?>","930px","610px",{title:"选择视频",type:"top"}); return true; }, queryCommandState: function() { } };
		    content.commands['mymusic'] = { execCommand: function() { addTypeChange("<?php echo M_URL('News','change','',GP('')) ?>","930px","610px",{title:"选择音频",type:"top"}); return true; }, queryCommandState: function() { } };
		    content.commands['myattachment'] = { execCommand: function() { addTypeChange("<?php echo M_URL('News','change','',GP('')) ?>","930px","610px",{title:"选择文档",type:"top"}); return true; }, queryCommandState: function() { } };</script>
		</body>
		</html>					</div>
		    </div>	
		  <!--消息结束-->
		  	   </div>			    
	</div>
	<div id="ksBoxFooter" class="form-footer clearfix" style="height: 60px;">
		<span class="d-inline-block">
			<input type="submit" onClick="return(do_reg())"  class="btn btn-default mr10" value="确定" name="save">
	       	<input type="button" onClick="close1();" class="btn btn-default" value="取消">
		</span>
	
	</div>	
	</form>

</div>


<script src="<?php echo UOOT;?>Public/common/js/common.js"></script> 
<script>
function do_reg(){
	var title      = $("input[name='title']").val();
	var content    = $("textarea[name='content']").val();
	var inputer    = $("input[name='names']").val();
    if(title==''){Alert('标题不能为空');return false;}	
	if(content==''){Alert('内容不能为空');return false;}	
	if(inputer==''){Alert('网站名不能为空');return false;}	
	$('#myform').submit();
//	top.closePopup('all');
}

function close1(){
	//parent.closePopup('all');
	top.closePopup('all');
}
</script>
</body>
</html>
