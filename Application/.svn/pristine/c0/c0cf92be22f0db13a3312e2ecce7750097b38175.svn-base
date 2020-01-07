<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="renderer" content="webkit">
    <title>修改会员</title>
    <link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
    <link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css" rel="stylesheet">
    <script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>
</head>
<body class="ks-wrap">
	<div class="bRadius10 bg-white ">
		<!--START HEAD-->
		<div id="ksBoxHead">
		<!--	<div class="generalTitle clearfix">
			      <div class="fl back-bt">
			    	<a href="javascript:history.go(-1);"><i class="iconfont icon-jiantou-copy"></i>邮箱配置</a><span>/</span><?php if(!empty($userinfo)){echo "修改学生会员";}else{echo "添加学生会员";} ?>
			    </div>
			</div>-->
			
		</div><!--ksBoxHead-->
	<!--END HEAD-->
<form target="hidframe"  method="post" id="myform" action="<?php echo M_URL('Massage','doedit',$id,GP('')); ?>"  >
	<div id="ksBoxContent" >	
			<div class="tab-pane" style="display:block">
				<div class="form-box " style="padding: 0 10px;">
					<div class="form-row">
						<span class="name"><i class="required">*</i>模块名称</span>
						<div class="form-limit" limit="50">
							<input type="text" class="form-textbox" name="model" readonly value="<?php if(!empty($value)) echo $value['model'] ?>" />
						</div>
					</div>
					<div class="form-row" style="display:none">
						<span class="name">模块名称（英文）</span>

						<input type="text"  class="form-textbox " name="modelname" value="<?php if(!empty($value)) echo $value['modelname'] ?>" />
					</div>
					<div class="form-row">
						<span class="name">内容</span>
						<?php echo $content; ?>
					</div>
				</div>
			</div>
		</div>
    <!----------------- 自定义字段添加后插入---------------->	
	<div class="form-footer "id="ksBoxFooter" >
		<div class="ks-bom" style="display: inline-block;">
			<button type="button" onClick="do_reg()" class="ks-bt bt-pue mr30">确认修改</button>
		    <a onclick="closePopupBox();" class="ks-bt bt-def">取消</a>
	    </div>
    </div>
</form>
	</div>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script>
//top.closePopup("all");
function do_reg(){
	
	$("#myform").submit();	
} 
$(".nav-ul li").click(function(){
	$(".nav-ul li").removeClass("curr");
	$(this).addClass("curr");
	var index= $(this).index();
	$(".tab-pane").hide();
	$(".tab-pane").eq(index).show();
	
});
function closePopupBox(){
	top.$(".ks-popup-box").find(".ks-popup-close").click();
}
</script>
</body>
</html>