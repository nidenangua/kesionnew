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
    
</head>
<body class="ks-wrap">
	
	
		<form target="hidframe"  method="post" id="myform" action="<?php echo M_URL($this->AppName.'/Index','doedit',$id,GP("")); ?>"  >
			<div id="ksBoxContent" >	
					<div class="tab-pane" style="display:block">
						<div class="form-box " style="padding: 0 10px;">
							<div class="form-row">
								<span class="name"><i class="form-star">*</i>模块名称</span>
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
			<div class="form-footer">
				<div class="ks-bom" style="display: inline-block;">
					<button type="button" onClick="do_reg()" class="ks-bt bt-pue mr30">确认修改</button>
				    <a href="javascript:top.closePopup(window.name);" class="ks-bt bt-def">取消</a>
			    </div>
		    </div>
	    </form>

<script src="<?php echo UOOT;?>/Public/common/js/module.js?<?php echo echoHash();?>"></script>

<script>
module.require(['$','backstage'],function(){

	$(".nav-ul li").click(function(){
		$(".nav-ul li").removeClass("curr");
		$(this).addClass("curr");
		var index= $(this).index();
		$(".tab-pane").hide().eq(index).show()
		
	})
});
function do_reg(){
	
	$("#myform").submit();	
} 


</script>
</body>
</html>