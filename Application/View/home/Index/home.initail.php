<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit">
<title>kesion教育平台</title>
<meta name="Keywords" content="kesion教育平台"/>
<meta name="Description" content="kesion教育平台"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit">
<link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/main.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>
</head>
<style>
	.qr_source {
    width: 243px;
    height: 243px;
    outline: 1px solid #dbdbdb;
}
.qr_logo {
	width: 50px; 
    position: absolute;
    left: 49%;
    top: 41%;
    margin-top: -15px;
    margin-left: -15px;
}
body {
    padding: 0px;
}
</style>
<body>
<div class="modal-body" style="text-align: center;">
    <div>
    	<div style="text-align: center;margin-bottom: 25px;">
	        <span style="display: inline-block; font-size: 24px;">微信扫一扫，绑定您的微门户</span>
	    </div>
        <div class="WxQrCode" style="text-align: center;">
            <?php
        	$id = '6';
			//配置APPID、APPSECRET
			$APPID     =  KS_C('WeChat_AppId');
			$APPSECRET =  KS_C('WeChat_AppSecret');
			//获取access_token
			$access_token = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$APPID&secret=$APPSECRET";
			//缓存access_token
			$json = httpRequest( $access_token );
			$json = json_decode($json,true);
			if (isset($json['access_token'])){
				$ACCESS_TOKEN = $json['access_token'];
			}else{
			    die("error token!");
			}
			//构建请求二维码参数
			//path是扫描二维码跳转的小程序路径，可以带参数?id=xxx
			//width是二维码宽度
			$qcode ="https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token=$ACCESS_TOKEN";
			//$ddd['scene']         = 'wxid-'.$this->wxid.',classid-'.$id;
			$scene['scene']         = array("scene_id"=>$this->wxid);
			$data['expire_seconds'] = 604800;
			$data['action_name']    = "QR_SCENE";
			$data['action_info']    = $scene;
			$param = json_encode($data);
			//POST参数
			$result = httpRequest($qcode,$param,"POST");
			//生成二维码
		    $result = json_decode($result,true);
			$base64_image ='https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket='.$result['ticket'];
            ?>
            <img src="<?php echo $base64_image;?>" class="img_WxQrCode qr_source" alt="二维码加载失败">
            <img src="/Public/app/images/login/ktjlogo.png" class="qr_logo">
        </div>
        <div class="expired_tip" style="display: none;">二维码过期
            <button type="button" class="btn btn-link qrcode-refresh">请点击刷新</button>
        </div>
    </div>
    <div style="text-align: center; margin-top: 15px; margin-bottom: 25px;">
        <span style="display: inline-block; font-size: 16px;">及时获得微门户更新动态和门户管理权限。</span>
    </div>
</div>
<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>
<script>
module.require(['$','backstage'],function(){
	var url = '<?php echo M_URL('Index','checkHasInitial');?>';
	var a = function(){
		$.ajax({
			type:"post",
			url:url,
			data:{"wxid":'<?php echo $this->wxid;?>'},
			success:function(data){if(data.result=='succeed'){
				//Alert('绑定公众号成功!',2); 
				parent.location.href="<?php echo M_URL();?>";
				parent.closePopup('all');
			}},
			error:function(){
				return false;
			}
		});
	}
	var time = setInterval(a,5000);
})
</script>
</body>
</html>