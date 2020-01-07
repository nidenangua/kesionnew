<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=no"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit">
<link rel="stylesheet" type="text/css" href="/Tp/PC/Skin05/AM/Public/css/ncommon.css">
<link rel="stylesheet" type="text/css" href="/Tp/PC/Skin05/AM/Public/css/style.css"/>
<link rel="stylesheet" type="text/css" href="/Tp/PC/Skin05/AM/Public/css/swiper.min.css"/>
<title>选择身份</title>
</head>
<body>
	<div class="logo">
	</div>
	<div class="index-wrap">
		<div id="loginflase" class="loginflag">
			<div class="index-button index-color" onClick="login()">
				我是老师
			</div>
			<div class="index-button index-color" onClick="login()">
				我是学生
			</div>
		</div>
	</div>
<script src="/Tp/PC/Skin05/AM/Public/js/jquery-3.3.1.min.js" type="text/javascript" charset="utf-8"></script>
<script src="/Public/Zpopup/js/Zpopup.js" type="text/javascript" charset="utf-8"></script>
<script>
$('#loginflase').show()
function Alert(text){
	popup.tips({'text':text,'style':2})
} 
</script>
</body>
</html>
