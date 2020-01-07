<!DOCTYPE HTML>
<html>
	<head>
	 <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="renderer" content="webkit"> 
    <title>我的服务</title>
    <link href="<?php echo UOOT ?>Public/common/drag/css/reset.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/wechat/css/home.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/wechat/css/pupil.css" rel="stylesheet">
    <link href="//ks.kesion.com/Public/wechat/css/microportal/userindex.css" rel="stylesheet">
    <script>
    	var uoot = '<?php echo UOOT ?>';	
    </script> 
    <style type="text/css">
    	html,body{ background: #F6F5F0; }
		.codectr{display: none;}
		.codewrap{padding-top: 1rem;text-align: center; width: 10rem; height: 10rem; background: #FFF; top: 50%; left: 50%; margin-top: -5rem; margin-left: -5rem; position: absolute; z-index:100; }
  		.codewrap>img{ width: 8rem; height: 8rem; }
  		.p-top{background: url(../../../Public/wechat/images/microportal/parent_bg.png);no-repeat;background-size: cover;}
  		.white{color: white;}
    </style>
	</head>
	<body style="background: #F6F5F0;">
		<div class="p-top">
			<div class="user-img">
				<img src="<?php echo $this->userinfo['emergencyhead']; ?>" alt="" />
			</div>
			<div class="user-info">
				<div class="user-name white"><?php echo Field($this->userinfo['emergencyContact']); ?></div>
				<div class="user-infos white">电话:&nbsp;<?php echo Field($this->userinfo['emergencyContactTel']); ?></div>
				<div class="user-infos white">学生:&nbsp;<?php echo Field($this->userinfo['name']); ?></div>
				<div class="user-infos white">学生电话:&nbsp;<?php echo Field($this->userinfo['mobile']); ?></div>
			</div>
		</div>
		<div style="overflow: hidden;">
		<div class="item-wrap">
			<div class="item">
				<a href="<?php echo M_URL('h5market','myCouse'); ?>">
					<div class="item-inner">
						<img src="<?php echo UOOT ?>Public/wechat/images/microportal/parent_class.png"/>
						<p>课程</p>
					</div>	
				</a>
			</div>
			<div class="item">
				<a href="<?php echo M_URL('h5market','myWork'); ?>"> 
				<div class="item-inner">
					<img src="<?php echo UOOT ?>Public/wechat/images/microportal/parent_work.png"/>
					<p>作业</p>
				</div>
				</a>	
			</div>
			<div class="item">
				<a href="<?php echo M_URL('h5market','myTable'); ?>"> 
				<div class="item-inner">
					<img src="<?php echo UOOT ?>Public/wechat/images/microportal/parent_timetable.png"/>
					<p>课表</p>
				</div>	
				</a>
			</div>
			<div class="item">
				<a href="<?php echo M_URL('h5market','myList'); ?>"> 
				<div class="item-inner">
					<img src="<?php echo UOOT ?>Public/wechat/images/microportal/parent_order.png"/>
					<p>我的订单</p>
				</div>	
				</a>
			</div>
			<div class="item">
				<a href="<?php echo M_URL('h5market','myMsg'); ?>"> 
				<div class="item-inner">
					<img src="<?php echo UOOT ?>Public/wechat/images/microportal/parent_message.png"/>
					<p>消息</p>
				</div>	
				</a>
			</div>
		</div>
		</div>
		<div class="border-color-g exit" onclick="userindex.loginout()">
			退出登录
		</div>
		
		<div class="codectr" id="codectr">
			<div class="mask" id="mask" style="display: block;"></div>
			<div class="codewrap">
				<img src="<?php echo UOOT.'Images/QRcode/'.createQRcode(ROOT.'Images/QRcode/','http://ks.kesion.com/h5market/binding?id='.$this->memberid.'&wxid='.$this->wxid,'L',4,'qrcode');?>">
				<p>家长可扫描二维码绑定学生账号</p>
			</div>
		</div>
		
			<div class="height60"></div>
			<div class="user-bot box-shadow-top">
				<div class="user-item">
					<a href="<?php echo 'https://'.APP_DOMAIN.'/h5market/Miindex' ?>">
					<img src="<?php echo UOOT ?>Public/wechat/images/microportal/icon_home_inter.png" alt="" />
					<p>首页</p></a>
				</div>
				<div class="user-item">
					<a href="<?php echo 'https://'.APP_DOMAIN.'/h5market/Micourse' ?>">
					<img src="<?php echo UOOT ?>Public/wechat/images/microportal/icon_class_inter.png" alt="" />
					<p>课程</p></a>
				</div>
				<div class="user-item">
					<a href="<?php echo 'https://'.APP_DOMAIN.'/h5market/Minewslist' ?>">
					<img src="<?php echo UOOT ?>Public/wechat/images/microportal/icon_news_inter" alt="" />
					<p>资讯</p></a>
				</div>
				<div class="user-item active">
					<a href="<?php echo 'https://'.APP_DOMAIN.'/home.html/default/WeChat/login' ?>">
					<img src="<?php echo UOOT ?>Public/wechat/images/microportal/icon_me" alt="" />
					<p>我的</p></a>
				</div>
			</div>
			

	<script src="<?php echo UOOT ?>Public/common/js/z.methodLibrary.js?version=1.0"></script>
	<script type="text/javascript">
		$_id('code').onclick = function(){
			$_id('codectr').style.display = 'block';
		}
		$_id('mask').onclick = function(){
			$_id('codectr').style.display = 'none';
		}
	</script>
	<script src="<?php echo UOOT ?>Public/common/js/z.methodLibrary.js" type="text/javascript"></script>
	<script type="text/javascript">
	
	var userindex = new Object({
		wechatremove:function(){
			var ajax={
				url:'/Json/index.php?act=WeChat.wechatremove',
				data:{
				},
			}
			$_post(ajax.url,ajax.data,res=>{
				alert('解除完成');
			},'json');
		},
		loginout:function(){
			var ajax={
				url:'/Json/index.php?act=Users.loginout&id=1',
				data:{
					userid:"<?php echo $this->memberid ?>"
				},
			}
			$_post(ajax.url,ajax.data,res=>{
				alert('退出完成'); 
				setTimeout(function(){
			        window.location.href="https://<?php echo APP_DOMAIN; ?>"+'/home.html/default/WeChat/login';	
			    },2000);
			},'json');
		}
	})
	
	</script>
	</body>
</html>