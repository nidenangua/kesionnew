<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>
<style>
.mt50 {
	margin-top: 20px;
}
.ks-borde td {
	border: 0;
	text-align: left;
}
.ks-bborde {
	border-bottom: 1px solid #eee;
}
</style>
</head>
<body class="ks-wrap">
<div id="ksBoxHead"> 
  <!--结束--> 
  
  <!--操作范围--> 
</div>
<div id="ksBoxContent">
  <table class="ks-table ks-borde">
    <tbody>
      <tr>
        <td>订单号：<?php echo $ordermsg['ordersn'] ?></td>
        <td>支付状态：
          <?php if($ordermsg['paystatus']==0){echo '未支付';}else{echo '已支付';}   ?></td>
        <td>所属网校：<?php echo $wxmsg?></td>
      </tr>
      <tr>
        <td>下单日期：<?php echo date('Y-m-d H:i:s',$ordermsg['adddate']) ?></td>
        <td>支付日期：<?php if($ordermsg['paydate']==0){echo '待支付';}else{echo date('Y-m-d H:i:s',$ordermsg['paydate']);} ?></td>
        <td>支付类型:<?php echo getStoreOrderType($ordermsg['type']); ?></td>
      </tr>
        <tr>
            <td>
                订单总价：<?php echo $ordermsg['original_amount'] ?>
            </td>
            <td>
                <?php
                $yhinfo= $ordermsg['discount']>0?'VIP折扣：'.$ordermsg['discount'].'折':'';
                $vinfo=$ordermsg['vouchermoney']>0?'优惠券抵扣：'.$ordermsg['vouchermoney'].'元':'';
                if (empty($yhinfo) &&empty($vinfo)){
                    echo '优惠信息：无';
                }else{
                    echo $yhinfo.' '. $vinfo;
                }

                ?>

            </td>
            <td>
                实际到账：<?php echo $ordermsg['actual_amount'] ?>
                <?php echo $ordermsg['poundage']>0?'(服务费：'.$ordermsg['poundage'].'元)':'' ?>
                <?php echo $ordermsg['distribute_amount']>0?'(分销推广费：'.$ordermsg['distribute_amount'].'元 推广人：'.User_GetUserName($ordermsg['distribute_userid']).')':'' ?>
            </td>
        </tr>
    </tbody>
  </table>
  <div class="mt20">
    <table class="ks-table ks-bborde">
      <thead>
        <tr>
          <th>物品名称</th>
          <th>物品价格</th>
          <th>购买数量</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($orderdetail as $k=>$v){?>
        <tr>
          <td><?php echo Field($v['title']);?></td>
          <td><?php echo Field($v['price']);?></td>
          <td><?php echo intval(Field($v['numb'])); ?></td>
          <!--<td><?php if($v['numb']==0){echo '0';}else{echo Field($v['numb']);} ?></td>-->
        </tr>
        <?php }?>
      </tbody>
    </table>
  </div>
</div>
<div id="ksBoxFooter">
<div class="ks-bom clearfix"> <span class="" style="display: inline-block;">
  <button type="button" class="ks-bt bt-pue" onclick="close1();">关闭</button>
  </span> </div>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script> 
<script>
function close1(){
	//parent.closePopup('all');
	top.closePopup('all');
}
	
</script>
</body>
</html>