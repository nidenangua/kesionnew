<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit"> 
<title>用户个人资料</title>
<meta name="Keywords" content="用户个人资料"/>
<meta name="Description" content="用户个人资料" />
<style>
.dialog_bd {
    padding: 20px 45px;
}
.tc {
    text-align: center; 
}
</style>
</head>
<body class="ks-wrap">
<div class="dialog_bd "><div style="" class="js_dialog">    
<div class="js_head"></div>    
<div class="tc">          
<p style="" class="js_nb_tip">你的帐号开启了微信保护功能，绑定运营者微信号需进行微信验证</p>      
<div class="qrcode_scan qrcode_scan_light">          
<div class="qrcode_wrp">              
<img class="qrcode js_qrcode" style="height:315px;width:315px;"
src="<?php echo UOOT.'Images/QRcode/'.createQRcode(ROOT.'Images/QRcode/',MY_FULLDOMAIN.'/home.html/default/Capital/getOpenid/'.$this->wxid,'H',4,'weimenhu');?>" 
alt="微信二维码" title="微信二维码">         
</div>          
<div class="js_status">
<div class="status tips">
<p>请用管理员微信扫描以上二维码进行验证</p>
</div>
</div>      
</div>    
</div>      
<p class="js_change tc">若此微信号已无法使用，请点此<a target="_blank" href="https://store.kesion.com/home/help#anchor115">重置绑定微信号</a></p>  
</div>
</div>
<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>
<script>
module.require(['$','backstage'],function(){
	var url = '<?php echo M_URL('Capital','getOpenidstatus');?>';
	var a = function(){
		$.ajax({
			type:"post",
			url:url,
			data:{"wxid":'<?php echo $this->wxid;?>'},
			success:function(data){if(data.result=='succeed'){
				Alert('绑定成功!',2);
				var data = {
					nickname:data.nickname,
					openid:data.openid
				}
				top.dataCallBack(data);
				parent.closePopup('all');
				//window.location.href="<?php echo M_URL();?>";break;
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