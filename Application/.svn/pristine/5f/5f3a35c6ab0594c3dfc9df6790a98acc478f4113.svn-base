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
<title>微门户登录</title>
</head>
<body>
	<div class="logo"><img src="//store.kesion.com/Public/app/images/login/logo.png"/></div>
	<div class="index-wrap">
		<div id="loginflase" class="loginflag">
			<div class="login-info">
				<div class="login-item">
					<span class="login-h">用户名</span>
					<input type="text" name="username" id="LoginPhone" value=""  placeholder="请输入手机号" maxlength="11"/>
				</div>
				<div class="login-item">
					<span class="login-h">密&nbsp;&nbsp;&nbsp;码</span>
					<input type="password" name="password" id="password" value=""  placeholder="请输入密码"/>
					<input type="hidden" name="openid"     id="openid" value="<?php echo $openId; ?>"/>
					<input type="hidden" name="wxopenid"   id="wxopenid" value="<?php echo $wxopenId; ?>"/>
					<input type="hidden" name="unionid"    id="unionid" value="<?php echo $unionid; ?>"/>
					<input type="hidden" name="wxid" id="wxid" value=""/>
					<input type="hidden" name="usertype" id="usertype" value=""/>
				</div>
				<div class="tips-info">
				<?php if(!empty($openId)){ ?>
					<div class="fl login-tips" onclick="location.href='<?php echo M_URL('WeChat','reg') ?>?openid=<?php echo $openId; ?>&unionid=<?php echo $unionid; ?>'">注册门户</div>
					<div class="fr login-tips" onclick="location.href='<?php echo M_URL('WeChat','getPass') ?>?openid=<?php echo $openId;?>&unionid=<?php echo $unionid; ?>&actindex=<?php echo $actindex; ?>'">忘记密码</div>
				<?php }else{ ?>
					<div class="fl login-tips" onclick="location.href='<?php echo M_URL('WeChat','reg') ?>?wxopenid=<?php echo $wxopenId; ?>&unionid=<?php echo $unionid; ?>'">注册门户</div>
					<div class="fr login-tips" onclick="location.href='<?php echo M_URL('WeChat','getPass') ?>?wxopenid=<?php echo $wxopenId;?>&unionid=<?php echo $unionid; ?>&actindex=<?php echo $actindex; ?>'">忘记密码</div>
				<?php } ?>
			    </div>
			</div>
			<div class="index-button index-color" onClick="login()">
				<?php if(empty($openId) && empty($wxopenId)){ ?>立即登录 <?php }else{ ?>立即登录<?php } ?>
			</div>
		</div>
		<div id="login" class="loginflag">
			<div class="userimg"><img src=""/></div>
			<div class="username"></div>
			<div class="index-button index-color" onClick="loginOut()">退出</div>
		</div>
	</div>
<script src="/Tp/PC/Skin05/AM/Public/js/jquery-3.3.1.min.js" type="text/javascript" charset="utf-8"></script>
<script src="/Public/Zpopup/js/Zpopup.js" type="text/javascript" charset="utf-8"></script>
<script>
function login(){
var userName = $('#LoginPhone').val();//用户名
var usertype = $('#usertype').val();//用户名
var password = $('#password').val();//密码
var openid   = $('#openid').val();
var wxid     = $('#wxid').val();
var reg      =/^1[345678]\d{9}$/;        
var isok     = reg.test(userName);
if(userName==''){
	alert('用户名不能为空');
	$('#LoginPhone').focus()
	return false;
}else if(password==''){
	alert('密码不能为空');
	return false;
}else if(password.length<6 || password.length>20){
	alert('密码6-20位');		
	return false
};
var url ='';
//if(usertype == 0){url = '/home/sigin/2';}else{}
url = "<?php echo M_URL('WeChat','sigin'); ?>";
	$.ajax({ 
		type:"post",
		url:url,
		data:{
			username:userName,
			password:password,
			openid:openid,
			wxid:wxid,
			wxopenid:$('input[name="wxopenid"]').val(),
			unionid:$('input[name="unionid"]').val()
		},
		success : function(data) {
			    var jsonData =JSON.parse(data);
			    //console.log(data);
	            if(jsonData.succeed=="10001"){
	         		Alert('登陆成功');
	         		var oldwxid = "<?php echo $GLOBALS['_DoM']['wxid'] ?>";
	         		var newwxid = $('#wxid').val();
	         		if(oldwxid != newwxid){
	         			window.location.href = 'http://'+jsonData.domain+'/home.html/default/WeChat/Miindex?from=teacher&token='+jsonData.token;
	         		}else{
	         			window.location.href = 'http://'+jsonData.domain+'/h5market/Miindex?redirect=teacher';
	         		}
//	         		if(usertype == 0){
//	         			if(oldwxid != newwxid){
//	         				window.location.href = 'http://'+jsonData.domain+'/h5market/wechatlogin?actindex=Miindex&token='+jsonData.token;
//		         		}else{
//		         			window.location.href = 'http://'+jsonData.domain+'/h5market/Miindex';
//		         		}
//	         		}else{}
	            }else if(jsonData.errcode == '10010'){
	            	Alert(jsonData.msg);
	            }else{
	            	Alert('请检查您的用户名或者密码')
	            }
	         },
	});
	
};
//判断登录状态
$.ajax({
	type:"get",
	url:"/home/checklogin",
	success : function(data){$('#loginflase').show();},
});
//退出登录
function loginOut(){
	$.ajax({
		type:"post",
		url:"/home/simplelogout",
		success : function(data) {  
	            if(data.result=="succes"){
	            	$('#login').hide();
	            	$('#loginflase').show()
	            }
	    },
	});
}
function Alert(text){
	popup.tips({'text':text,'style':2})
} 
function checkwxid(){
	var userName = $('#LoginPhone').val();//用户名
 	$.ajax({ 
		type:"post",
		url:"/home/checkwxid/2",
		data:{
			username:userName, 
		},
		success : function(data) {
			if(data !=''){
		 		var data = JSON.parse(data);
		   		$('#wxid').val(data.wxid);
		   		$('#usertype').val(data.usertype);
		   		alert(data.wxid);
		   		alert(data.usertype);
		  	}
     	},
	});
}
//$("#LoginPhone").blur(function(){
// 	checkwxid();
//});
//checkwxid();
</script>
</body>
</html>
