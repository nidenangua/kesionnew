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
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>
<style>
	.mt50{margin-top: 20px;}
	.ks-borde td{border:0;text-align: left;}
	.ks-bborde {border-bottom: 1px solid #eee;}
    .ks-wrap {
        padding-top: 0px;
    }
</style>
</head>
<body class="ks-wrap">
		<div id="ksBoxHead">
		<!--结束-->
            <table class="ks-table ks-borde">
                <tr>
                    <td width="50%">下单时间：<?php echo $result['info']['adddate'] ?></td>
                    <td width="50%">下单商品：<?php echo $result['info']['title'].'等'.$result['info']['number'].'件'; ?></td>
                </tr>
                <tr>
                    <td width="50%">物流快递：<?php echo $result['info']['logistics'] ?></td>
                    <td width="50%">快递单号：<?php echo $result['info']['expressNumber'] ?></td>
                </tr>
            </table>
		<!--操作范围-->
		</div>
        <div style="border-top:#bbc0c7 solid 1px;padding-bottom: 10px;"></div>
        <div id="ksBoxContent">
           <?php
                if ($result['message']=='ok'){
                    foreach ($result['data'] as $k=>$v){
                        ?>
                        <a style="font-size: 12px;padding-left: 25px;"><?php echo $v['time']?></a><br>
                        <a style="font-size: 12px;padding-left: 25px;"><?php echo $v['context']?></a><br><br>
                        <?php
                    }
                }else{
                    ?><span style="font-size: 15px;padding-left: 39%;">没有物流信息</span><?php
                }
           ?>
        </div>
				<div id="ksBoxFooter">
					<div class="ks-bom clearfix">
						<span class="" style="display: inline-block;">&nbsp;&nbsp;
							<button type="button"  class="ks-bt bt-pue" onclick="close1();" >返回</button>
						</span>
				</div>
<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>
<script>
	module.require(['$','backstage'],function(){
		loadScorllJs();
	})
function submitform(type){
	$('#batch1').val(type);
	$('#myform').submit();
}	
function close1(){
	//parent.closePopup('all');
	top.closePopup('all');
}
</script>

</body>
</html>

