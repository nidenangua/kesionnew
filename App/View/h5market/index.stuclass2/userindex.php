<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="renderer" content="webkit"> 
    <link href="<?php echo UOOT ?>Public/common/drag/css/reset.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/wechat/css/home.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/wechat/css/userindex.css" rel="stylesheet">
    <script>
    	var uoot = '<?php echo UOOT ?>';	
    </script> 	
</head> 

<body style="background: #F6F5F0;">
	
	<div class="user-wrap blue-box_shadow">
		<div class="user-item">
			<div class="user-head">学生名称</div>
			<div class="user-body"><?php echo $this->userinfo['name']; ?></div>
		</div>
		<div class="segment-line"></div>
		<div class="user-item">
			<div class="user-head">手机号</div>
			<div class="user-body"><?php echo $this->userinfo['mobile']; ?></div>
		</div>
		<div class="segment-line"></div>
		<div class="user-item">
			<div class="user-head">账号</div>
			<div class="user-body"><?php echo $this->userinfo['username']; ?></div>
		</div>
		<div class="segment-line"></div>
		<div class="user-item">
			<div class="user-head">密码</div>
			<div class="user-body"><?php echo '*********'; ?></div>
		</div>
		<div class="segment-line"></div>
		<div class="user-item">
			<div class="user-head">邮箱</div>
			<div class="user-body"><?php echo $this->userinfo['email'];; ?></div>
		</div>
		<div class="segment-line"></div>
	</div>
	<div class="user-wrap blue-box_shadow">
		<div class="user-item"> 
			<div class="user-head">客服热线</div>
			<div class="user-body">400-101-1760</div>
		</div>
	</div>
	<!--<div class="user-btn border-color-g" onclick="userindex.wechatremove()">
		解除微信绑定
	</div>-->
	<div class="user-btn border-color-g" onclick="userindex.loginout()">
		退出登录
	</div>

</body>
<script src="<?php echo UOOT ?>Public/common/js/z.methodLibrary.js" type="text/javascript"></script>
	<script type="text/javascript">
	
	var userindex = new Object({
		wechatremove:function(){
			var ajax={
				url:'/Json/index.php?act=WeChat.wechatremove',
				data:{
					userid:'<?php echo $this->userinfo["userid"] ?>',
				},
			}
			$_post(ajax.url,ajax.data,res=>{
				alert('解除完成');
			},'json');
		},
		loginout:function(){ 
			if(confirm('确认退出？')){
				var ajax={
					url:'/Json/index.php?act=Users.loginout',
					data:{
						userid:'<?php echo $this->userinfo["userid"] ?>',
					},
				}
				
				$_post(ajax.url,ajax.data,res=>{
					window.location.href="/h5market/Miindex";
					//https://store.kesion.com/home.html/default/WeChat/login&action=index
				},'json');
			}else{
				return;
			}
			
		}
	})
	
	</script>

</html>