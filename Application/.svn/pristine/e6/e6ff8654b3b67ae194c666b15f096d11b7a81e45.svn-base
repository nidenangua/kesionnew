<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="renderer" content="webkit"> 
    <title>学员管理</title>
    <link href="<?php echo UOOT ?>Public/common/drag/css/reset.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/wechat/css/home.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/wechat/css/signin.css" rel="stylesheet">
    <link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="<?php echo UOOT ?>Public/wechat/css/editcampus.css"/>
    <script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>
    <script src="<?php echo UOOT; ?>Public/wechat/js/microportal/current.js"></script>
    <script>
    	var uoot = '<?php echo UOOT ?>';
    	
    </script>
</head>
	<body>
		<form id="form" action="<?php if($id){echo M_URL('WeChat','saveEdit',$id);}else{echo M_URL('WeChat','doAddschool');}?>" method='post'>
			<div class="edit-wrap">
				<div class="title1">校区名称</div>
				<input type="text" name="school" id="school" value="<?php if(isset($school)){echo $school['school'];}?>" class="edit-input"/>
			</div>
			<div class="edit-wrap">
				<div class="title1">联系人</div>
				<input type="text" name="name" id="name" value="<?php if(isset($school)){echo $school['name'];}?>" class="edit-input"/>
			</div>
			<div class="edit-wrap">
				<div class="title1">联系方式</div>
				<input type="number" name="tel" id="tel" value="<?php if(isset($school)){echo $school['tel'];}?>" class="edit-input"/>
			</div>
			<div class="edit-wrap">
				<div class="title1">校区地址</div>
				<input type="text" name="address" id="address" value="<?php if(isset($school)){echo $school['address'];}?>" class="edit-input"/>
			</div>
		


			<footer class="footer">
					<div class="clearfix">
						<div class="zui-col-6">
							<div class="footer-foticon fb-white" onclick="history.go(-1)">
								取消
							</div>
						</div>
						<div class="zui-col-6" onclick="insumbit()">
							<div class="footer-foticon fb-orag">
								确认
							</div>
						</div>
					</div>
			</footer>
		</form>
	<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
	<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>
	<script type="text/javascript">
		module.require(['$','backstage','nicescroll'],function(){
		loadScorllJs();
		$('.upload-img').click(function(){
			$('.js_uploadText').click()
		});
			
		
	});
		function insumbit(){
			if($("#school").val()==''){
				toast2({
					content:'校区名字不能为空',
				})
			}else if($("#name").val()==''){
				toast2({
					content:'联系人不能为空',
				})
			}else if($("#tel").val()==''){
				toast2({
					content:'联系电话不能为空',
				})
			}else if($("#address").val()==''){
				toast2({
					content:'地址不能为空',
				})
			}else{
				document.getElementById('form').submit()
			}
			
		}
	</script>
	</body>
</html>