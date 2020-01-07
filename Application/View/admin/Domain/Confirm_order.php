<!DOCTYPE html>
<html>
<head lang="en">
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit">
<title>云市场</title>
<link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/main.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/mystyle.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="<?php echo UOOT;?>Public/app/css/kesion-common.css">
<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
<style>
/*--------切片---------*/
.tab{height:50px; line-height:50px; background:#f7fbfc;border:1px solid #ebebeb;border-bottom:0px; }
.tab li{float:left; padding:0px 40px; cursor:pointer;color:#929292;background:#fff;font-weight:bold;height:51px;font-size:20px;color:#434343; font-family:"幼圆";}
.tab .active{ background:#fff;border-right:1px solid #ebebeb;height:51px;  }
.tabBox{border:1px solid #ebebeb;}
.tabBox .box{min-height:300px; padding:30px; padding-bottom:100px; display:block;}
.myTab{width:100%;}
.round-bt{ width:150px; height:40px;background-color:#fd5f20; line-height:40px; color:white; text-align:center; font-size:14px; margin-top:30px; border:none;}
.round-img1{width:120px; height:60px; float:left; margin-left:50px;}
.round-img2{width:140px; height:80px; float:left; margin-top:-10px; margin-left:40px;}
.z-list li:last-child{ border:none;}
.zf{ position:absolute; z-index:3;width:120px; height:60px; opacity:0;}
.zf-k{border:1px solid #73d09f;}
</style>
</head>
<body class="bg-gary" style="padding: 30px">
<div class="headNav bg-gary posFi hLh48 clearfix w100">
    <ul class="fr mr20">
        <li class="fl mr20"><em class="fr icon12 arrowIcon"></em><a href="" title="" class="verAlignMiddle">我的云市场</a></li>
        <li class="fl mr20"><em class="fr icon12 arrowIcon"></em><i class="icon15 shopCarIcon mr5"></i><a href="" title=""
         class="verAlignMiddle">购物车<font class="c-red">1</font></a></li>
        <li class="fl mr20"><i class="icon12 favoriteIcon mr5"></i><a href="" title="" class="verAlignMiddle">收藏夹</a></li>
        <li class="fl mr20"><a href="" title="" class="verAlignMiddle">联系客服</a></li>
    </ul>
</div>
<div class="blank20"></div>
<div class="blank12"></div>
    <div class="myTab bg-white">
        <div class="tab">
            <ul><li class="tabName">支付订单</li></ul>
        </div>
        <?php foreach($applist as $k=>$v){$sumMoney = $sumMoney+$v['price']*$numb;}?>
        <div class="tabBox ">
        <form action="<?php echo M_URL('Domain','pay',$this->wxid); ?>" method="post">
            <div class="box ">
                <div class="bd-all">
                <?php if(isset($Pays)){if($Pays==='0'){?><input type="hidden" name="Porderid" value="<?php echo $orderid;?>" /><?php }}?>
                <div class="h-40 bg-hui ta-center fz-14 lh-40 fc-hei ">
                    <div class="w_b20 f-l ">应用ID<!--<input type="checkbox" id="select-all" value="" class="f-l" style="margin-top:12px; margin-left:12px;" >商家订单-->                    </div>
                    <div class="w_b20 f-l">商品名称</div>
                    <div class="w_b10 f-l">市场价</div>
                    <div class="w_b20 f-l">优惠价</div>
                    <div class="w_b10 f-l">期限</div>
                    <div class="w_b20 f-l">小计</div>
                </div>
                <ul class="z-list">
                    <?php foreach($applist as $k=>$v){ ?>
                    <li class="bd-d">
                        <div class="h-40 ta-center fz-14 lh-40">
                            <div class="w_b20 f-l "><?php echo $v['appid']; ?></div>
                            <div class="w_b20 f-l"><?php echo $v['appname']; ?>（<?php echo $v['appename']; ?>）<input type="hidden" name="appid[]" value="<?php echo $v['appid']; ?>" /></div>
                            <div class="w_b10 f-l">￥<?php echo $v['price']; ?>/<?php if($v['appchargetype']==0){echo '月';}elseif($v['appchargetype']==1){echo '季';}elseif($v['appchargetype']==2){echo '年';}; ?></div>
                            <div class="w_b20 f-l">￥<?php echo $v['price']; ?>/<?php if($v['appchargetype']==0){echo '月';}elseif($v['appchargetype']==1){echo '季';}elseif($v['appchargetype']==2){echo '年';}; ?></div>
                            <div class="w_b10 f-l"><input type="hidden" name="numb_<?php echo $v['appid']; ?>" value="<?php echo $numb;?>"><?php echo $numb;if($v['appchargetype']==0){echo '月';}elseif($v['appchargetype']==1){echo '季';}elseif($v['appchargetype']==2){echo '年';}; ?></div>
                            <div class="w_b20 f-l">￥<?php echo number_format($v['price']*$numb,2);?></div>
                        </div>
                    </li>
                    <?php } ?>
                </ul>
                </div>
                <div class="lh-40 fc-hei fz-16 mp_10" style=" font-family: '微软雅黑'">
                	<strong>订单金额:</strong><span class="fz-20 fc-com mr_40">￥<?php echo number_format($sumMoney,2); ?></span>
                    <strong>账户余额:</strong><span  class="fz-20 fc-com mr_40">￥<?php echo number_format($Money,2);?></span>
                    <strong>您需要支付金额：￥</strong><span class="fz-20 fc-cheng mr_40"><?php if(($sumMoney-$Money)>0){echo number_format($sumMoney-$Money,2);}else{echo '0.00';}?></span>
                </div>
                <div class="lh-40 fc-hei fz-16 mp_10" style=" font-family: '微软雅黑'">
                    <span>推广佣金:</span>
                    否 <input type="radio" value="2" name="is_sales" checked>
                    是 <input type="radio" value="1" name="is_sales">
                </div>
                <div class="Created-ing clearfix">
					<ul>
						<li>
							<h4>实收金额:</h4>
							<div class="Created-Content">
								<input class="form-textbox" name="order_amount" id="order_amount" value="<?php if(($sumMoney-$Money)>0){echo $sumMoney-$Money;}else{echo '0.00';}?>" type="text"/>				
							   提示：如果是赠送的话，请输入“0”。
                            </div>
							<script>
							$("#order_amount").keyup(function () {
							    var reg = $(this).val().match(/\d+\.?\d{0,2}/);
							    var txt = '';
							    if (reg != null) {txt = reg[0];}
							    $(this).val(txt);
							}).change(function () {
							    $(this).keyup();
							});
							</script>
						</li>
						<li>
							<h4>备注:</h4>
							<div class="Created-Content">
								<textarea class="form-textarea w300" name="mark" style="min-height: 80px;">线下付款,总后台代开插件</textarea>			
							</div>
						</li>
					</ul>
				</div>
                <div class="mp_10">
                	<button class="round-bt hand">确认支付</button>
                </div>
            </div>
        </form>    
        </div>
   </div>
<div class="footer-page">
</div>
</body>
</html>
<script>
$(function(){
	var flag=true;
	$(document).on("click", "#select-all", function(){
		if(flag==true){
			$("input[type='checkbox']").prop("checked","true");
			flag=false; 
		}else{
			$("input[type='checkbox']").removeAttr("checked"); 
			flag=true;
		}
	})
	$(".ac").click(function(){
		$(this).find("input").prop("checked","true")
		$(".ac").css("border","1px solid #e5e9ed")
		$(this).css("border","1px solid #73d09f")
	
	})
})
</script>