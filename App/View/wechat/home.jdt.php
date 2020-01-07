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
<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/live.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>
</head>
<style type="text/css">
@-webkit-keyframes animate-stripes{from{background-position:0 0}
to{background-position:44px 0}
}
.ui-progress-bar{position:relative;height:16px;padding-right:2px;background-color:#abb2bc;border-radius:16px;-moz-border-radius:16px;-webkit-border-radius:16px;background:-webkit-gradient(linear,left bottom,left top,color-stop(0,#b6bcc6),color-stop(1,#9da5b0));background:-moz-linear-gradient(#9da5b0 0,#b6bcc6 100%);-webkit-box-shadow:inset 0 1px 2px 0 rgba(0,0,0,.5),0 1px 0 0 #FFF;-moz-box-shadow:inset 0 1px 2px 0 rgba(0,0,0,.5),0 1px 0 0 #FFF;box-shadow:inset 0 1px 2px 0 rgba(0,0,0,.5),0 1px 0 0 #FFF}
.ui-progress{position:relative;display:block;overflow:hidden;height:14px;-moz-border-radius:16px;-webkit-border-radius:16px;border-radius:16px;-webkit-background-size:44px 44px;background-color:#74d04c;background:-webkit-gradient(linear,0 0,44 44,color-stop(0,rgba(255,255,255,.17)),color-stop(.25,rgba(255,255,255,.17)),color-stop(.26,rgba(255,255,255,0)),color-stop(.5,rgba(255,255,255,0)),color-stop(.51,rgba(255,255,255,.17)),color-stop(.75,rgba(255,255,255,.17)),color-stop(.76,rgba(255,255,255,0)),color-stop(1,rgba(255,255,255,0))),-webkit-gradient(linear,left bottom,left top,color-stop(0,#74d04c),color-stop(1,#9bdd62));background:-moz-repeating-linear-gradient(top left -30deg,rgba(255,255,255,.17),rgba(255,255,255,.17) 15px,rgba(255,255,255,0) 15px,rgba(255,255,255,0) 30px),-moz-linear-gradient(#9bdd62 0,#74d04c 100%);-webkit-box-shadow:inset 0 1px 0 0 #dbf383,inset 0 -1px 1px #58c43a;-moz-box-shadow:inset 0 1px 0 0 #dbf383,inset 0 -1px 1px #58c43a;box-shadow:inset 0 1px 0 0 #dbf383,inset 0 -1px 1px #58c43a;border:1px solid #4c8932;-webkit-animation:animate-stripes 2s linear infinite}
.ui-progress span.ui-label{font-size:1.2em;position:absolute;right:0;line-height:14px;padding-right:12px;color:rgba(0,0,0,.6);text-shadow:rgba(255,255,255,.45) 0 1px 0;white-space:nowrap}
.v-l{float: right;}
.v-r{float: left;}
</style>
<body>
<div class="votebox" style="margin:0px auto 0 auto; width: 280px;"> 
	<div id="progress_bar" class="ui-progress-bar ui-container">
		<div class="ui-progress charts" style="width: 0px;"></div>
	</div>
	<div class="wz" style="color: green; width: 100%; line-height: 20px; padding-top: 10px;"></div>
</div>



<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script src="<?php echo UOOT;?>Public/common/js/animate-common.js"></script>
</body>
</html>
<script language="javascript">
function animate(){
	var a=parseInt($('.charts').attr("w"));
	$('.charts').animate({
		width: a+"%"
	},100);
}
</script>
<?php
$users = $this->getUserInfoAction();
//var_dump($users);exit;
$app_weixin_user = M('app_weixin_user');
$app_weixin_user->delete("wxid =". $this->wxid);
$url1= M_URL($this->AppName.'/Index','fansList',"",GP(''));
if($users!=false&&!isset($users[0]['errcode'])){ 
   foreach ($users as $value){
		$Data['openid']         = $value['openid'];
		$Data['wxid']           = $this->wxid;
		$Data['userid']         = $this->userid;
		$Data['subscribe']      = $value['subscribe'];
		$Data['nickname']       =str_replace("'","",$value['nickname']);
		$Data['sex']            = $value['sex'];
		$Data['language']       = $value['language'];
		$Data['city']           = $value['city'];
		$Data['province']       = $value['province'];
		$Data['country']        = $value['country'];
		$Data['headimgurl']     = $value['headimgurl'];
		$Data['subscribe_time'] = $value['subscribe_time']+28800;
		$Data['remark']         = $value['remark'];
		$Data['groupid']        = json_encode($value['tagid_list'],320);;
	    $app_weixin_user->doadd($Data,'id');
	}
    KS_INFO('同步成功',3,$url1);	 	
}else{
	KS_INFO('错误码'.$users[0]['errcode'].',错误信息'.$users[0]['errmsg'],3,$url1);	 
}
?>
