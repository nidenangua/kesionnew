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
        <td>订单号：<?php echo $info['ordersn'] ?></td>
        <td>支付状态：
          <?php if($info['paystatus']==0){echo '未支付';}else{echo '已支付';}   ?></td>
        <!--<td>购买数量：<?php echo $info['goods_amount'] ?></td>-->
      </tr>
      <tr>
        <td>下单日期：<?php echo date('Y-m-d H:i:s',$info['adddate']) ?></td>
        <td>支付日期：<?php if($info['paydate']==0){echo '待支付';}else{echo date('Y-m-d H:i:s',$info['paydate']);} ?></td>
        <td>支付总额：<?php echo $info['order_amount'] ?></td>
      </tr>
    </tbody>
  </table>
  <div class="mt20">
    <table class="ks-table ks-bborde">
      <thead>
        <tr>
          <th>物品名称</th>
          <th>物品价格</th>
          <th>物品数量</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($detail as $k=>$v){?>
        <tr>
          <td><?php echo Field($v['appname']);?></td>
          <td><?php echo Field($v['price']);?></td>
          <td><?php if($v['type']==2&&($v['appid']==1||$v['appid']==2)){
              if($v['numb']==0){
                  echo '0';
              }else{
              echo Field($v['numb'])*1000;
              }
                    }else{if($v['numb']==0){echo '0';}else{echo number_format(Field($v['numb'],0));}} ?></td>
          
          <!--<td><?php echo  Field($v['numb']);?></td>-->
        </tr>
        <?php }?>
      </tbody>
    </table>
  </div>
</div>
<div id="ksBoxFooter">
<div class="ks-bom clearfix"> <span class="" style="display: inline-block;">
  <button type="button" class="ks-bt bt-orangea" onclick="close1();">关闭</button>
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