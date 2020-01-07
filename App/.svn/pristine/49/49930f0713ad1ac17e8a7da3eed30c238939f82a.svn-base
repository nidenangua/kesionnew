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
<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/admin/css/general.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/app/css/wechat.css" rel="stylesheet"> 
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>
<style type="text/css">
.wexin-header{box-sizing: border-box; }
*{ box-sizing:inherit; }
</style>
</head>
<body class="ks-wrap">
<!--开始-->

	
	<!--结束-->
	
	<div id="ksBoxHead" >
	
		<div class="Header-tool mb20 clearfix">
			<div class="Tool-Title">
		
			<!--图像-->
			
			<!--图像-->

			<!--标题-->
			<p><a href="javascript:history.go(-1);"><i class="iconfont icon-jiantou-copy"></i>小程序</a><span>/</span>微信小程序配置</p>
		</div>	
	</div>	
	</div>	
	<div class="bg-white bRadius10 ks-wbox">	
	<div id="ksBoxContent">
		
				<!--内容-->
				<div class="wrapper ">
					<div class="row p15">
						<div class="wexin-header clearfix p15">
							<div class="col-sm-4 step select">
								<a href="javascript:;">1</a>
							</div>
							<div class="col-sm-4 step">
								<a href="javascript:;">2</a>
							</div>
							<div class="col-sm-4 step">
								<a href="javascript:;">3</a>
							</div>
						</div>
				
						<form class="form-horizontal" method="post"   target="hidframe" action="<?php {echo M_URL($this->AppName.'/Index','doWechatConfig','',GP(""));} ?>" id="myform">
							<!--第一步-->
						<div class="win-item" >
							<div class="wexin-title">
							第一步：填写微信小程序类型与基本信息
							</div>
							<div class="form-group clearfix">
								<label class="fl mt7 col-sm-2 control-label">小程序类型</label>
								<div class="col-sm-2 w200">
									<select class="form-control" name="weixintype">
										<option value="1" <?php if(isset($value['weixintype']) and $value['weixintype']==1){echo "selected";} ?>>--服务号--</option>
										<option value="0" <?php if(isset($value['weixintype']) and $value['weixintype']==0){echo "selected";} ?>>--订阅号--</option>
										<option value="1" <?php if(isset($value['weixintype']) and $value['weixintype']==2){echo "selected";} ?>>--个人号--</option>
									</select>
								</div>
							</div>
							<div class="form-group clearfix">
								<label class="fl mt7 col-sm-2 control-label">认证情况 </label>
								<div class="col-sm-8 ">
									<div class="radio radio-info  radio-inline">
										<input  id="rz1"type="radio" checked="checked" value="1"    name="weixinstatus"><label for="rz1"> 已认证 </label>
									</div>
									<div class="radio radio-info  radio-inline">
										<input  id="rz2"  type="radio" checked="checked" value="0" name="weixinstatus"><label for="rz2"> 未认证 </label>
									</div>
								</div>
								<div class="img-tips ·mb15 p25 clearfix">
									<label class="col-sm-2 taps-left" style="text-align: left;">注 ：请确认您的小程序</label>
									<div class="col-sm-5">
										<div class="w240">
										<img src="<?php echo UOOT;?>Public/uploads/common/Appletrz.png">
									</div>
									</div>
								</div>
								<div class="form-group clearfix">
									<label class="col-sm-2 control-label">小程序名称</label>
									<div class="col-sm-4">
										<input class="form-control" type="text" value="<?php if(!empty($value)){echo $value['weixinname'];} ?>"  name="weixinname"  placeholder="请输入公众号名称">
									</div>
								</div>
								<div class="form-group clearfix">
									<label class="col-sm-2 control-label" >小程序原始ID</label>
									<div class="col-sm-4">
										<input class="form-control" type="text" value="<?php if(!empty($value)){echo $value['weixinid'];} ?>" placeholder="请输入公众号原始ID" name="weixinid">
									</div>
								</div>
							</div>
							<div class="show-box val-0 alignCenter" <?php if(isset($value['status']) and $value['status']==1){?>style="display:none"<?php }?> >
								<button type="button"   num="3"   class="btn btn-primary btn-s-md ">保存</button>
						
							
								<button type="button"  num="1"  class="btn btn-primary btn-s-md ">下一步</button>
							</div>
						</div>

				<!--第二步-->
				<div class="win-item" style="display: none">
					<div class="wexin-title">
						第二步： 配置小程序开发者凭据
					</div>
					<input type="hidden"  name="id" value="<?php if(!empty($value)){echo $value['id'];} ?>">
					<div class="form-group">
						<label class="control-label col-sm-2">AppID(应用ID)</label>
						<div class="col-sm-4">
							<input class="form-control" value="<?php if(!empty($value)){echo $value['appid'];} ?>" type="text" placeholder="请输入AppId" name="appid">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2">AppSecret(应用钥匙)</label>
						<div class="col-sm-4">
							<input class="form-control" value="<?php if(!empty($value)){echo $value['appsecret'];} ?>" type="text" placeholder="请输入AppSecret" name="appsecret">
						</div>
					</div>
					<div class="img-tips mb15 p25 clearfix">
						<label class="col-sm-5 taps-left" >
							注：返回开发者中心，将AppID(应用ID)以及AppSecret(应用密钥)拷贝到上表中
						</label>
						<div class="col-sm-2"></div>
						<div class="col-sm-5">
							<div class="w240">
								<img src="<?php echo UOOT;?>Public/uploads/common/account3.jpg">
							</div>
						</div>
					</div>
					<div class="col-sm-5"></div>
					<div class="col-sm-4">
						<button type="button" num="2" class="btn btn-primary btn-s-md ">下一步</button>
					</div>
				</div>
				<!--第三步-->
				<div class="win-item" style="display:none">
					<div class="wexin-title">
						第三步：进入小程序设置白的名单链接
					</div>
					<div class="steps ">
						<div class="ct-mb first ">
							<div class="number">1</div>
							<div class="ct-m clearfix">
								<div class="ct-m-l">
									<label class="">进小程序<a class="ct-color" href="http://mp.weixin.qq.com" target="_blank">http://mp.weixin.qq.com</a></label>
									<p>小程序，点击进入【开发者中心】</p>
								</div>
								<div class="ct-m-r">
									<img src="<?php echo UOOT;?>Public/uploads/common/account21.jpg">
								</div>
								<img src="<?php echo UOOT;?>Public/uploads/common/bzjt01.png" class="bzjt">
							</div>
						</div>
						<div class="ct-mb second ">
							<div class="number">2</div>
							<div class="ct-m clearfix">
								<div class="ct-m-l">
									<label class="">修改服务器配置</label>
									<p>在服务器配置处，点击【修改配置】</p>
								</div>
								<div class="ct-m-r">
									<img src="<?php echo UOOT;?>Public/uploads/common/account22.jpg">
								</div>
								<img src="<?php echo UOOT;?>Public/uploads/common/bzjt02.png" class="bzjt">
							</div>
						</div>
						<div class="ct-mb third ">
							<div class="number">3</div>
							<div class="ct-m clearfix">
								<div class="ct-m-l">
									<label class="">配置微信接口</label>
									<p>分别将下方的信息复制到【接口配置信息】的输入框</p>
									<div class="ct-mt">
										<p class="url">Url</p>
										<input type="text" name="url" readonly class="form-control" value="https://www.zuojy.com" >
									</div>
								</div>
								<div class="ct-m-r">
									<img src="<?php echo UOOT;?>Public/uploads/common/Appleturl.png">
								</div>
								<img src="<?php echo UOOT;?>Public/uploads/common/bzjt02.png" class="bzjt">
							</div>
						</div>
					</div>
					<div class="col0sm-2">
						<button type="button" onClick="do_reg()" class="btn btn-primary btn-s-md " >确认</button>
						<a href="javascript:history.go(-1);" class="btn btn-s-md btn-default">取消</a>
					</div>
				</div>
				</form>
				<!--第二步-->
				<!--内容-->
 
</div> </div> 
</div>
	</div>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script>

//上方跳页
$('.step').click(function(){
var weixinname = $('[name=weixinname]').val();
var weixinid = $('[name=weixinid]').val();
var appid = $('[name=appid]').val();
var appsecret = $('[name=appsecret]').val();
if($("#mbings1").prop('checked')){
if($(this).index() == 2){
	if(weixinname ==""){
Alert('请填写小程序名称');
}else if(weixinid == ""){
Alert('请填写小程序原始ID');
}else if(appid == ""){
Alert('请填写小程序appid');
}else if(appsecret ==""){
Alert('请填写小程序appsecret');
}else{
	$(this).addClass('select').siblings().removeClass('select');
$('.win-item:eq('+$(this).index()+')').show().siblings().hide();
	}
}else if($(this).index() !=0){
	if(weixinid == ""){
Alert('请填写小程序原始ID');
}else if(weixinname ==""){
Alert('请填写小程序名称');
}else{
	$(this).addClass('select').siblings().removeClass('select');
$('.win-item:eq('+$(this).index()+')').show().siblings().hide();
	}
}else if($(this).index() !=1){
	if(appid == ""){
Alert('请填写小程序appid');
}else if(appsecret ==""){
Alert('请填写小程序appsecret');
}else{
	$(this).addClass('select').siblings().removeClass('select');
$('.win-item:eq('+$(this).index()+')').show().siblings().hide();
	    	}
		}
	}
   
})
//下一步判断
$('.btn').click(function() {
var num = $(this).attr('num');
var weixinname = $('[name=weixinname]').val();
var weixinid = $('[name=weixinid]').val();
var appid = $('[name=appid]').val();
var appsecret = $('[name=appsecret]').val();
if (num==1) {
	if(weixinname ==""){
Alert('请填写小程序名称');
}else if(weixinid == ""){
Alert('请填写小程序原始ID');
}else{
	$('.step:eq('+num+')').addClass('select').siblings().removeClass('select')
$('.win-item:eq('+num+')').show().siblings().hide();
	}
}else if(num==2){
	if(appid == ""){
Alert('请填写小程序appid');
}else if(appsecret ==""){
Alert('请填写小程序appsecret');
}else{
	$('.step:eq('+num+')').addClass('select').siblings().removeClass('select')
$('.win-item:eq('+num+')').show().siblings().hide();
    	}
    }
})

</script>
<script>
function  do_reg(){
    $("#myform").submit();
    }
radiotabs('status','.show-box');
$(function(){
	var index ="<?php if(isset($value) and !empty($value)){echo $value['status'];} ?>";
//    alert(index);
if(index==0) {
	$('.val-0').show();
$('.val-1').hide()
}else if(index==1){
	$('.val-1').show();
$('.val-0').hide()
	}
})
</script>
</body>
</html>