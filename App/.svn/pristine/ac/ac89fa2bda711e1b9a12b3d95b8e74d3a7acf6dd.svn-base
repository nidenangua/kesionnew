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
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/template.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/wechat.css" rel="stylesheet">  
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>
<style type="text/css">
	.wexin-header{box-sizing: border-box; }
	*{ box-sizing:inherit; }

	
</style>
</head>
<body class="ks-wrap">
	<div class="contentBox bRadius10 ks-wbox clearfix">	
				<!--内容-->
				<div id="ksBoxContent">
					<div class="content01">
						<ul class="make_code">  
							<li style="width: 100%;border-bottom: 1px solid #e7e7eb;"><img id='QRimg' src="/Public/uploads/common/timg.jpg" width="248" height="240"></li>
							<li style="padding: 10px;"> 
								<span id="ctl00_KSContent_Label1" style="margin-bottom: 10px;display: block;">请输入有效时间<br/>['默认生成的是30天的二维码']</span>
								<input name="QRtime" type="text" id="ctl00_KSContent_TextBox2" class="textbox" style="margin-bottom: 10px; width:228px;"placeholder="请输入大于0的数，注意时间以秒为单位">
								<input type="submit" name="ctl00$KSContent$btn" value="生成二维码" id="ctl00_KSContent_btn" class="button" style="width: 100%;height: 29px;line-height: 29px; padding: 0px;">
							</li>
						</ul>
					</div>
				</div>
				<!--内容-->
			</div>
		</div> 
	</div>

</body>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script>
$("#ctl00_KSContent_btn").click(function(){
var QRtime = $('#ctl00_KSContent_TextBox2').val();
if(isNaN(QRtime)){
	Alert('请输入数字');
}else if(QRtime<=0 || QRtime >2592000){
	Alert('请输入大于0且小于2592000的数');
}else{
	$.ajax({
        type : "post", 
data :{'QRtime':QRtime},
url : "<?php echo  M_URL($this->AppName.'/Index','getQRcode','',GP(''));?>", 
success : function (data)
{
    $('#QRimg').attr('src',data);
            }
    	});
	}
})
QR();
function QR(){
	$.ajax({
        type : "post", 
data :{'QRtime':'2592000'},
url : "<?php echo  M_URL($this->AppName.'/Index','getQRcode','',GP(''));?>", 
success : function (data)
{
    $('#QRimg').attr('src',data);
        }
	});
}
</script>
</html>