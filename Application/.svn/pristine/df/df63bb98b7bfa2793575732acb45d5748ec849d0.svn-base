<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="renderer" content="webkit">
	<link rel="shortcut icon" href="favicon.ico">
		<link href="<?php echo UOOT;?>Public/app/css/form.css" rel="stylesheet">	
	<link href="<?php echo UOOT;?>Public/admin/css/html5.css" rel="stylesheet">
	<link href="<?php echo UOOT;?>Public/admin/css/general.css" rel="stylesheet">
	<link href="<?php echo UOOT;?>Public/admin/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/admin/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
	<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
</head>
<style type="text/css">
	.warps{padding: 15px;}
	.textareacont{margin: 15px;}
	#info{width: 100%;resize: none;border: solid 1px #E5E5E5;border-radius: 3px;height: 150px;padding:5px;}
	/*定义滚动条高宽及背景 高宽分别对应横竖滚动条的尺寸*/  
	::-webkit-scrollbar{width:5px;height:10px;background-color:#CCC}
	/*定义滚动条轨道 内阴影+圆角*/  
	::-webkit-scrollbar-track{-webkit-box-shadow:inset 0 0 6px #fff;border-radius:10px;background-color:#CCC}  
	/*定义滑块 内阴影+圆角*/  
	::-webkit-scrollbar-thumb{border-radius:10px;-webkit-box-shadow:inset 0 0 6px #CCC;background-color:#CCC}
</style>

<body >
	<div class="warps">
		<div class="textareacont">
		     标题：<?php echo $values["title"]?>
			 <br/>
			 内容：
			<?php echo $values['content']?>
		</div>

        <form target="hidframe" action="<?php {echo M_URL('Content','feedBackShowDoSave',$values['id'],GP(""));} ?>" method="post" class="form-horizontal">
            <div class="wrap">
                <div style="position: relative;margin-top: 40px;">
                    <?php echo ks_editor('reply_content',$values['reply_content'],$type='1',$att='',$width='',$height='260px');?>
                </div>
                <div class="Psend-btn">
                    <button class="mr20 ks-bt btn-s-md bt-pue fn" style="border-color: #DA4F0C;background: #DA4F0C;">确认</button>
                    <button class="ks-bt btn-s-md bt-gray fn" type="button" onclick="top.closePopup('all');">取消</button>

                </div>
            </div>

        </form>


	</div>
</body>


</html>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script type="text/javascript">
	$(".btn").click(function(){
		//parent.$(".ks-popup-close").click();
		top.closePopup('all');
	})
</script>
