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
	<link href="<?php echo UOOT;?>Public/app/css/laydate.css" rel="stylesheet">
    <script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>
    <script type="text/javascript" src="<?php echo UOOT;?>Public/common/js/layer/laydate.js"></script>
	<style>
		.ml30{position: relative;top: 5px; margin-left: 20px!important;}
		.span-inline label{display: block;float: none!important;margin-bottom: 10px;}
	</style>
</head>
<body class="ks-wrap"  id="ksBoxContent"> 
	<div class="bRadius10 ">
		<div id="ksBoxHead"></div>
 	<form target="hidframe" id="myform" action="<?php echo M_URL('Massage','doeditnotice',$ids,GP("option-".$option));?>"  method="post" enctype="multipart/form-data">
		<div  style="padding:0px  10px;">
			<!--公告-->
		  	<!--公告结束-->
			<!--消息-->
			<div class="news">
		        <div class="form-row clearfix">
					<span class="name name-nowrap">消息标题</span>
					<input type="text" class="form-textbox " name="title" value="<?php if(!empty($notice)){echo $notice['title'];}?>">
				</div>
				<div class="form-row clearfix" style="padding-right: 10px;">
					<span class="name name-nowrap">消息内容</span>
					<?php echo ks_editor('content',$notice['content'],2,''); ?>
				</div>
				<div class="form-row  clearfix" style="margin-bottom: 100px;">
					<span class="name name-nowrap">发件人：</span>
					<input type="text" class="form-textbox " name="inputer" value="<?php if(!empty($notice)){echo $notice['inputer'];}?>">
				</div>
		    </div>	
		  <!--消息结束-->
	   </div>		
	</form>
    <div class="clearfix ks-popup-footer form-footer">
		<span class="d-inline-block mt20">
			<input type="button" onClick="do_reg();"  class="ks-bt bt-pue mr10" value="确认修改" name="save">
	       	<input type="button" onClick="close1();" class="ks-bt bt-white" value="取消">
		</span>
	</div>
</div>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script>
top.imgUploadBack = function(editname,data){
	UE.getEditor(editname).execCommand('insertHtml',data);
};	
function close1(){top.closePopup('all');}
function do_reg(){$('#myform').submit();}
</script>
</body>
</html>
