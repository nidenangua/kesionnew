<!DOCTYPE html>
<html>
<head lang="en">
<meta charset="UTF-8">
<title>科汛在线教育</title>
<link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
<style>
    body {padding:0!important; }
    .container {width: 100%;height: 630px;background:#eee url("<?php echo UOOT;?>Public/app/images/weipay.jpg")  no-repeat 35% -100px }
    .wxzfbox {
        width: 221px;
        float: right;
        margin-top: 55px;
        margin-right: 160px;
        background: #fff;
        border: 1px solid #e5e5e5;
        box-shadow: 0 1px 10px #e5e9ed;
        padding: 20px 40px;
        border-radius: 10px;
    }
    .mainbox {margin: 0 auto;width: 1190px}
    .copyright {
        text-align: center;
        line-height: 22px;
        color: #888;
        height: 100%;
        font-family: Arial, Helvetica, sans-serif;
        padding-top: 5px;
    }
</style>
</head>
<body>
<div class="reg_top" style="background:#fff;height:75px;font-size:14px;position:relative; z-index:99;border-bottom:1px solid #d5d5d5;">
    <div class="mainbox">
        <div style="float:right;line-height:75px;"><a href="<?php echo M_URL();?>">返回首页</a></div>
        <div style="float:left;margin-top:16px;"><a href="/" title="进入首页" target="_blank"><img src="<?php echo UOOT;?>Public/app/images/logo%20(1).png"></a></div>
    </div>
</div>
<div class="container">
    <div class="mainbox clearfix">
        <div class="wxzfbox">
            <img src="<?php echo UOOT;?>Public/app/images/wxzf.png" height="45" style="margin-bottom:15px;">
            <img style="width:209px;height:209px; padding:6px;" src="http://paysdk.weixin.qq.com/example/qrcode.php?data=<?php echo urlencode($url2);?>" >
            <div class="wxinfo">
                <ul>
                    <li><span>订单编号：</span>KS<?php echo $Kspay->out_trade_no;?></li>
                    <li><span>订单金额：</span>¥<?php echo $Kspay->total_fee;?>元</li>
                    <li><span>实付金额：</span><strong style="font-size:20px;color:#ea4939">¥<?php echo $Kspay->total_fee;?>元</strong></li>
                    <li><span>&nbsp;</span><div class="tips">(手续费率1%)</div></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="copyright" style="text-align:center;padding-top:10px;border-top:1px solid #e5e5e5;">
    Powered By KesionICMS V4.5 正式版 www.kesion.com inc .<br>厦门科汛软件有限公司版权所有 © 2006-2017 <br>
    统一社会信用代码:91350206MA2XN2XQ4A  闽ICP备06009871号
</div>
</body>
</html>
<script src="<?php echo UOOT;?>Public/common/js/jquery.cookie.js" type="text/javascript"></script>
<script>
(function(){
	var a = function(){
		$.ajax({
			type:"post",
			url:'<?php echo M_URL('course','rechargebackW');?>',
			data:{
			     "ordersn":'<?php echo $Kspay->out_trade_no;?>',
			},
			success:function(data){if(data=='succeed'){
				$.cookie('indoor','<?php echo M_URL('Order');?>',{expires:7,path:'/'});
				window.location.href="<?php echo M_URL();?>"; 
			}},
		    error:function(){
			    return false;
			}
		});
	}
	var time = setInterval(a,5000);
	})()
</script>