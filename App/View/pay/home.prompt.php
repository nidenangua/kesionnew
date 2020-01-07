<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit"> 
	<title></title>
</head>
<body>
	<div style="position:absolute;box-sizing: border-box;user-select: none; background-color: lightgrey; width:100%; height:100%">

		<div style="position:absolute; background-color: white; width:500px; height:250px; top: 100px;left:50%;transform:translate(-50%)">
        <?php if(!$type){ ?>
        <img src="<?php echo UOOT;?>Public/wechat/images/bankmode/authorize_failure.png" style="position: absolute; top: 50px; max-width: 100%; max-height: 100px; left: 210px">
        <div style="position:relative;top: 160px;width: 100%;text-align: center;line-height: 20px;">
            <div class="c2" style="font-size: 15px">服务号未认证或认证已过期!</div>
        </div>
        <div style="position:relative;top: 180px;width: 100%;text-align: center;line-height: 20px;">
            <div class="c2" style="font-size: 12px">请到微信公众平台进行认证或续期</div>
        </div>
       	<?php }else{ ?>
       	<img src="<?php echo UOOT;?>Public/wechat/images/bankmode/authorize_right.png" style="position: absolute; top: 50px; max-width: 100%; max-height: 100px; left: 210px">
        <div style="position:relative;top: 160px;width: 100%;text-align: center;line-height: 20px;">
            <div class="c2" style="font-size: 15px">认证成功!</div>
        </div>
        <div style="position:relative;top: 180px;width: 100%;text-align: center;line-height: 20px;">
            <div class="c2" style="font-size: 12px">请回到原页面操作</div>
        </div>
       	<?php } ?>
    </div>
    <div style="position:absolute;bottom: 20px;width: 100%;text-align: center;line-height: 20px;">
        <div class="c2" style="font-size: 12px">---- 科汛V名师官网 知识付费 - 线上1对1----</div>
        <div class="c2" style="font-size: 12px">store.kesion.com</div>
    </div>
</div>
</body>
</html>
