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
	label{display: block;float: none;}
	.ks-box {width:80%;margin:0 auto}
	.ks-wrap {padding-top:0}
	.inputText {width:100%}
</style>
</head>
<body class="ks-wrap"> 
 	<form target="hidframe" id="myform"  action="<?php echo M_URL($this->AppName.'/Index','dosendmessage',$id,GP(''));?>"  method="post" enctype="multipart/form-data">
		<div class="ks-box">
			<div class="form-row">
				<span class="name" ><i class="form-star">*</i>选择要通知的用户</span>
					<div class="clearfix">
						<label class="radioLabel fl label-on"  >
							<input type="radio" value="0" name="vmsg">未领取的用户 </label>
						<label class="radioLabel fl"  >
							<input type="radio" value="1" name="vmsg"  checked="">选择指定用户
						</label>					
					</div>					
			</div>

			<div id="showMsg" class="clearfix" style="background:#eef2f5;padding:10px;font-size:14px">
					<div>
						<button type="button" class="ks-heade-button mr10"  style="border-color:#e5412c;background:transparent;color:#e5412c">选择用户</button>
						<div style="margin-top:10px">行云流水、行云流水、行云流水、行云流水、</div>
					</div>

			
			</div>

			<div class="form-row">
				<span class="name" ><i class="form-star">*</i>选择通知方式</span>
				<div class="claerfix">
					<span><input type="checkbox" name="msgtype">短信</span>
					<span><input type="checkbox" name="msgtype">邮箱</span>
					<span><input type="checkbox" name="msgtype">站内信息</span>
					<span><input type="checkbox" name="msgtype">微信模板消息</span>
				</div>
			</div>

			<div class="form-row">
				<span class="name" ><i class="form-star">*</i>通知内容</span>
				<div class="clearfix">
					<textarea class="inputText" style="line-height:34px;min-height: 120px;background: #f7f7f7;">亲爱的--------</textarea>
				</div>
			</div>

		</div>
   </form>
   <div  class="form-footer clearfix" >
		<span class="d-inline-block">
			<input type="button" onClick="do_reg()"  class="ks-bt bt-pue mr10" value="确定" name="save">
	       	<input type="button" onClick="closeSend()" class="ks-bt bt-def" value="取消">
		</span>
   </div>

<script src="<?php echo UOOT;?>/Public/common/js/module.js?<?php echo echoHash();?>"></script>


<script>

	
	module.require(['$','backstage','laydate'],function(){		
		$('input[name="vmsg"]').click(function(){
				var number = $(this).val();
				if(number==0) {
					$('#showMsg').hide();

				}else{
					$('#showMsg').show();
				}
		})
	})



function closeSend(){
	 top.closePopup(window.name );//g关闭弹窗
}
function do_reg(){
	var title      = $("input[name='title']").val();
	var content    = $("textarea[name='content']").val();
	var inputer    = $("input[name='inputer']").val();
    if(title==''){Alert('标题不能为空');return false;}	
	if(content==''){Alert('内容不能为空');return false;}	
	if(inputer==''){Alert('发件人不能为空');return false;}
	$('#myform').submit();
}
</script>
</body>
</html>
