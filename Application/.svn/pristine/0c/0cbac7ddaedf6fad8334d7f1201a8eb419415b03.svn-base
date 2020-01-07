<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="renderer" content="webkit"> 
    <title>个人资料</title>
    <link href="<?php echo UOOT ?>Public/common/drag/css/reset.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/wechat/css/home.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/wechat/css/userindex.css" rel="stylesheet">
    	<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
    <script>
    	var uoot = '<?php echo UOOT ?>';	
    </script> 	
</head> 

<body>
	
	<div class="user-wrap blue-box_shadow">
		<div class="user-item">
			<div class="user-head"><?php if($this->userinfo['usertype']==1){ echo '老师名称';}else{ echo '机构名称';} ?></div>
			<div class="user-body"><?php echo empty($this->userinfo['name'])?$this->userinfo['username']:$this->userinfo['name']; ?></div>
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
			<div class="user-body"><?php echo '*********'; ?><span style="color: blue;" onclick="userindex.showbox(2)">点击修改</span></div>
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
			<div class="user-head">科汛V名师客服热线</div>
			<div class="user-body">400-101-1760</div>
		</div>
	</div>
	<!--<div class="user-btn border-color-g" onclick="userindex.wechatremove()">
		解除微信绑定
	</div>-->
	<div class="user-btn-box1">
		<div class="user-btn border-color-g" onclick="userindex.showbox(1)">
			修改资料
		</div>
		<div class="user-btn border-color-g" onclick="userindex.loginout()">
			退出登录
		</div>
	</div>
	<div id="maxd" class="masked"></div>
	<div id="changebox" class="changebox">
		<div id="box1" >
			<div id="" class="change-title">
				修改资料
			</div>
			<div class="">
				<div class="user-wrap blue-box_shadow" style="padding-bottom: 0;    margin-bottom: 1rem;">
					<div class="user-item">
						<div class="user-head"><?php if($this->userinfo['usertype']==1){ echo '老师名称';}else{ echo '机构名称';} ?></div>
						<div class="user-body" ><?php echo empty($this->userinfo['name'])?$this->userinfo['username']:$this->userinfo['name']; ?></div>
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
					<!--<div class="user-item">
						<div class="user-head">密码</div>
						<div class="user-body can-write" contenteditable><?php echo '*********'; ?></div>
					</div>-->
					<div class="segment-line"></div>
					<div class="user-item">
						<div class="user-head">邮箱</div>
						<div class="user-body can-write" contenteditable id="email"><?php echo $this->userinfo['email'];; ?></div>
					</div>
					<div class="segment-line"></div>
					
				</div>
				<div class="confirm-btn-wrap" >
						<div class="btn cancel" onclick="userindex.cel()">取消</div>
						<div class="btn sur" onclick="userindex.sure(1)">确定</div>
					</div>
			</div>
		</div>
		<div id="box2" >
			<div id="" class="change-title">
				修改密码
			</div>
			<div class="">
				<div class="user-wrap blue-box_shadow" style="padding-bottom: 0;    margin-bottom: 1rem;">
					<div class="segment-line"></div>
					<div class="user-item">
						<div class="user-head">旧密码</div>
						<input type="password" class="user-body can-write" name="" id="oldpwd" value="" />
					</div>
					<div class="segment-line"></div>
					<div class="segment-line"></div>
					<div class="user-item">
						<div class="user-head">新密码</div>
						<input type="password" class="user-body can-write" name="" id="newpwd" value="" />
					</div>
					<div class="segment-line"></div>
					<div class="segment-line"></div>
					<div class="user-item">
						<div class="user-head">确认新密码</div>
						<input type="password" class="user-body can-write" name="" id="surepwd" value="" />
					</div>
					<div class="segment-line"></div>
				</div>
				<div class="confirm-btn-wrap" >
						<div class="btn cancel" onclick="userindex.cel()">取消</div>
						<div class="btn sur" onclick="userindex.surepwd(2)">确定</div>
					</div>
			</div>
		</div>
	</div>
	<div style="display: none;" id="tishi" class="dialog-tips dialog-center">
          <div></div>
    </div>
<!--<div class="footer-blank"></div>
	<footer class="footer">
		<ul>
			<li class="zui-col-6" id="toDay" onclick="window.location.href='<?php echo M_URL('WeChat','index'); ?>'">
				<i class="icon icon-tools"></i>
				<p>主页</p>
			</li>
			<li class="zui-col-6 active" id="historys" onclick="window.location.href='<?php echo M_URL('WeChat','userindex'); ?>'">
				<i class="icon icon-program"></i>
				<p>个人中心</p>
			</li>
		</ul>
</footer>-->
</body>
<script src="<?php echo UOOT ?>Public/common/js/z.methodLibrary.js" type="text/javascript"></script>
<script type="text/javascript">
'use strict';

var userindex = new Object({
	wechatremove: function wechatremove() {
		var ajax = {
			url: '/Json/index.php?act=WeChat.wechatremove',
			data: {}
		};
		$_post(ajax.url, ajax.data, function (res) {
			alert('解除完成');
		}, 'json');
	},
	loginout: function loginout() {
		if (confirm('确认退出吗')) {
			var ajax = {
				url: '/Json/index.php?act=WeChat.loginout',
				data: {}
			};
			$_post(ajax.url, ajax.data, function (res) {
				window.location.href = 'http://<?php echo APP_DOMAIN;?>/home.html';
			}, 'json');
		} else {
			return;
		}
	},
	showbox: function showbox(type) {
		$('#maxd').show();
		$('#changebox').show();
		if (type == 1) {
			$('#box2').hide();
			$('#box1').show();
		} else {
			$('#box1').hide();
			$('#box2').show();
		}
	},
	cel: function cel() {
		$('#maxd').hide();
		$('#changebox').hide();
	},
	sure: function sure() {
		var ajax = {
			url: '/Json/index.php?act=Microportal.savePersonMsg',
			data: {
				email: $("#email").text(),
				type: 1
			}
		};
		$_post(ajax.url, ajax.data, function (res) {
			if (res.savePersonMsg.errCode == 10000) {
				$('#maxd').hide();
				$('#changebox').hide();
				$("#tishi").show();
				$("#tishi").text('修改成功');
				setTimeout(function () {
					$("#tishi").hide();
					window.location.href = 'http://<?php echo APP_DOMAIN;?>/home.html/default/WeChat/userindex';
				}, 1500);
			} else {
				$("#tishi").show();
				$("#tishi").text(res.savePersonMsg.errMsg);
				setTimeout(function () {
					$("#tishi").hide();
				}, 1500);
			}
		}, 'json');
	},
	surepwd: function surepwd() {
		if ($("#oldpwd").val() == '' || $("#newpwd").val() == '' || $("#surepwd").val() == '') {
			$("#tishi").show();
			$("#tishi").text('不能为空');
			setTimeout(function () {
				$("#tishi").hide();
			}, 1500);
			return;
		}
		if ($("#newpwd").val() != $("#surepwd").val()) {
			$("#tishi").show();
			$("#tishi").text('密码不一致');
			setTimeout(function () {
				$("#tishi").hide();
			}, 1500);
			return;
		}
		var ajax = {
			url: '/Json/index.php?act=Microportal.savePersonMsg',
			data: {
				oldpwd: $("#oldpwd").val(),
				newpwd: $("#newpwd").val(),
				type: 2
			}
		};
		$_post(ajax.url, ajax.data, function (res) {
			if (res.savePersonMsg.errCode == 10000) {
				$('#maxd').hide();
				$('#changebox').hide();
				$("#tishi").show();
				$("#tishi").text('修改成功,需重新登录');
				setTimeout(function () {
					$("#tishi").hide();
					var ajax = {
						url: '/Json/index.php?act=WeChat.loginout',
						data: {}
					};
					$_post(ajax.url, ajax.data, function (res) {
						window.location.href = 'http://<?php echo APP_DOMAIN;?>/home.html';
					}, 'json');
				}, 1500);
			} else {
				$("#tishi").show();
				$("#tishi").text(res.savePersonMsg.errMsg);
				setTimeout(function () {
					$("#tishi").hide();
				}, 1500);
			}
		}, 'json');
	}
});
</script>
</html>