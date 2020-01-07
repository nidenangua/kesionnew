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
</style>
</head>
<body class="ks-wrap"> 
		
		<form target="hidframe"  action="<?php echo M_URL($this->AppName.'/Index','editorder','',GP('orderid-'.$ordermsg['orderid']));?>" method="post" id="myform">
		   		<div >
            		<table class="ks-table ks-borde">

                        <tr>
                            <td>
                                订单号：<?php echo $ordermsg['ordersn'] ?>
                            </td>
                            <td>
                                支付状态：
                                <?php if($ordermsg['paystatus']==0){echo '未支付';}else{echo '已支付';}   ?>
                            </td>
                            <td>
                                支付类型:<?php echo getStoreOrderType($ordermsg['type']); ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                购 买 人：<?php echo User_GetUserName($ordermsg['userid']);?>
                            </td>
                            <td>
                                下单日期：<?php echo date('Y-m-d H:i:s',$ordermsg['adddate']) ?>
                            </td>
                            <td>
                                支付日期：<?php if($ordermsg['paydate']==0){echo '无';}else{echo date('Y-m-d H:i:s',$ordermsg['paydate']);} ?>
                            </td>
                           
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
                                实际支付：<?php echo $ordermsg['order_amount'] ?> 
                                <?php echo $ordermsg['poundage']>0?'(服务费：'.$ordermsg['poundage'].'元)':'' ?>
                                <?php echo $ordermsg['distribute_amount']>0?'(分销推广费：'.$ordermsg['distribute_amount'].'元 推广人：'.User_GetUserName($ordermsg['distribute_userid']).')':'' ?>
                            </td>
                        </tr>
                        <?php
                        if ($ordermsg['type'] == 14 || $ordermsg['type'] == 15){
                            ?>
                            <tr>
                                <td>
                                    收货人：<?php echo $ordermsg['realname'];?>
                                </td>
                                <td colspan="2">
                                    收货地址：<?php echo $ordermsg['street']; ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    收货手机号：<?php echo $ordermsg['telphone'];?>
                                </td>
                                <td colspan="2">
                                    买家留言：<?php echo $ordermsg['mark']; ?>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3">
                                    物流单号：<?php if ($ordermsg['logistics']==','){
                                        echo '无';
                                    }else{
                                        echo $ordermsg['logistics'];
                                    }
                                        ?>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>


                        <?php if($ordermsg['gift']=="2"){ ?>
                        <tr>
                            <td>
                                订单类型：赠送
                            </td>
                            <td>
                                是否领取：<?php echo $ordermsg['islq']=='1'?'已领取':'未领取' ?>
                            </td>
                            <td>
                               领 取 人：<?php echo $ordermsg['memberid']>0?User_GetUserName($ordermsg['memberid']):'-'?>
                            </td>
                        </tr>
                        
                        <?php } ?>

            		</table>
            		<div class="mt20">

                        <table class="ks-table ks-bborde">
                            <thead>
                                <tr>
                                    <th>物品名称</th>
                                    <?php
                                     if ($ordermsg['type'] == 14 || $ordermsg['type'] == 15){
                                         ?><th>规格</th><?php
                                     }
                                    ?>
                                    <th>物品价格</th>
                                    <th>购买数量</th>
                                    <?php
                                    if ($ordermsg['type'] == 14 || $ordermsg['type'] == 15){
                                        ?>
                                            <th>小计</th>
                                        <?php
                                    }
                                    ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($orderdetail as $k=>$v){?>
                                <tr>
                                    <td>
                                        <?php echo Field($v['title']);?>
                                    </td>
                                    <?php
                                    if ($ordermsg['type'] == 14 || $ordermsg['type'] == 15){
                                        ?><td>
                                        <?php echo $v['attr'];?>
                                        </td><?php
                                    }
                                    ?>
                                    <td>
                                        <?php echo Field($v['price']);?>
                                    </td>
                                    <td>
                                        <?php echo intval(Field($v['numb'])); ?>
                                    </td>
                                    <?php
                                    if ($ordermsg['type'] == 14 || $ordermsg['type'] == 15){
                                        ?>
                                            <input name="id[]" type="hidden" value="<?php echo $v['id'];?>">
                                            <td><?php echo $v['sumprice'];?></td>
                                        <?php
                                    }
                                    ?>
                                    <!--<td><?php if($v['numb']==0){echo '0';}else{echo Field($v['numb']);} ?></td>-->
                                </tr>
                                <?php }?>
                            </tbody>
                        </table>
            		</div>
		    	</div>
            <?php
                if ($ordermsg['type'] == 14 || $ordermsg['type'] == 15){
                    ?>
                        <div id="ksBoxFooter" style="text-align: right;font-size: 13px;line-height: 24px;margin-top: 12px;">
                            <span>订单总价：<?php echo $ordermsg['original_amount'] ?></span><br>
                            <span><?php
                            $yhinfo= $ordermsg['discount']>0?'VIP折扣：'.$ordermsg['discount'].'折':'';
                            $vinfo=$ordermsg['vouchermoney']>0?'优惠券抵扣：'.$ordermsg['vouchermoney'].'元':'';
                            if (empty($yhinfo) &&empty($vinfo)){
                                echo '优惠信息：无';
                            }else{
                                echo $yhinfo.' '. $vinfo;
                            }
                            ?>
                            </span><br>
                            <span>运费：￥<?php echo $ordermsg['freight'];?></span><br>
                            <span>总计：￥<?php echo $ordermsg['order_amount']?>
                                <input <?php if ($ordermsg['paystatus']==1){echo 'disabled =true readonly';}?> style="width: 100px;" name="order_amount" type="type" value="<?php echo $ordermsg['order_amount'];?>">
                            </span>
                        </div>
                    <?php
                }
            ?>
            <div id="ksBoxFooter">
                <div class="ks-bom clearfix">
						<span class="" style="display: inline-block;">
                            <?php if (($ordermsg['type'] == 14 || $ordermsg['type'] == 15) && $ordermsg['paystatus']==0){
                                ?><button type="submit" class="ks-bt bt-pue mr10" >确定</button><?php
                            }?>&nbsp;
							<button type="button"  class="ks-bt bt-pue" onclick="close1();" >关闭</button>
						</span>


                </div>
            </div>
		    	
			</form>
	
		<div >
			<!--<div class="ks-bom clearfix " >
				<span  style="text-align: center;display: block;width: 100%;">
					<button class="ks-bt bt-pue" onclick="close1();" style="text-align: center;float: none;display: inline-block;">关闭</button>
				</span>
				
			
		</div>-->
            <script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>
            <script>
                module.require(['$','backstage'],function(){
                    loadScorllJs();
                })



                function updatesStatus(id){
                    var url = '<?php echo UOOT;?>Plus/Kesion.ajax.php?act=question';
                    $.ajax({
                        type:"get",
                        url:url,
                        data:{id:id},
                        success:function(data,textStatus){
                            $("#a"+id).html(data);
                        },
                        error:function(){
                            alert("发生了错误,请检查!");
                        }
                    })
                }
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

