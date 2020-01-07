
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="renderer" content="webkit"> 
    <title>订单管理</title>
    <link href="<?php echo UOOT ?>Public/common/drag/css/reset.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/wechat/css/home.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/wechat/css/signin.css" rel="stylesheet">
    <script>var uoot = '<?php echo UOOT ?>';</script> 	
</head>
<style type="text/css">
body,html{
	background:#EDF2F5
}
.myList-t{display:flex;height:2.1rem;line-height:2rem;position:fixed;top:0;left:0;width:100%;background:#fff;z-index:10}
.myList-t .item{flex:1;text-align:center;font-size:14px;color:#999;position:relative}
.myList-t .item:after{content:'';position:absolute;height:70%;width:1px;background:#eaeaea;right:0;top:0;bottom:0;margin:auto}
.myList-t .item:last-child:after{display:none}
.item-b button{height:1.5rem;line-height: 1.45rem;} 
.myList-order{margin-top:2.5rem}
.myList-order .item{width:100%;font-size:14px;color:#353535;margin-top:.5rem;line-height:14px;background:#fff;padding:10px;box-sizing:border-box}
.myList-order .item:last-child{margin-bottom:.5rem}
<?php if(empty($this->isp)){ ?>
	.myList-t .item.active div{color:#37A7ED;border-bottom: 1px solid #37A7ED;margin: 0rem 1.5rem;line-height:2rem}
<?php }else{ ?>
	.myList-t .item.active div{color:#37A7ED;border-bottom: 1px solid #37A7ED;margin: 0rem 1.5rem;line-height:2rem}
<?php } ?>
.myList-order .item .i-head{flex:1;overflow:hidden}
.myList-order .item .i-body{margin-left:.5rem}
.myList-order .item .teacher{font-size:16px;color:#353535}
.myList-order .item-t{display:flex;border-bottom:1px solid #eaeaea;align-items:center;padding-bottom:.5rem}
.myList-order .item-t .i-head{flex:1;overflow:hidden;color:#353535;font-size:14px;line-height:14px}
.myList-order .item-t .i-body{font-size:15px;line-height:15px}
.myList-order .item-b{border-top:1px solid #eee;text-align:right;padding:.3rem 0 0}
.myList-order .item-b .item-btn{padding:0 .4rem;font-size:14px;line-height:1.5rem;height:1.5rem;display:inline-block;margin-left:.5rem;border-radius:5px;border:1px solid #eee;color:#fff;}
.myList-title{font-size: .8rem;line-height: 1.6rem;}
.myList-title>span{font-size: .7rem;float: right;}
.myList-item{font-size:.7rem; color: #353535;line-height: 1rem;margin-bottom: .2rem; }
.myList-time{font-size:.6rem; color: #888;border-bottom: 1px solid #eaeaea;padding-bottom: .3rem;display:flex;width:100%;}
.myList-time .order-time{
	flex:1;
	overflow:hidden;
}
.myList-price{float: right;}
.myList-gray{color: #888;font-size:.7rem;}
.r-btnGray {border-color:#e8e8e8;color:#353535;font-size:14px;} 
.x-btnYell {color:#fff;background-color:#ffa42f;border-color:#ffa42f}
.order-body{
	display:flex;
	align-items:flex-start;
	padding:10px 0;
	border-bottom:1px solid #eee;
}
.order-body .defaultpic{
	width:120px;
	height:80px;
	display:block;
	margin-right:10px;
	border-radius:5px;
	position:relative;
}
.order-body .defaultpic img{
	width：120px;
	height:80px;
	display:block;
}
.order-body .defaultpic .status{
	width:40px;
	height:20px;
	line-height:20px;
	font-size:13px;
	color:#fff;
	background:rgba(0,0,0,.3);
	position:absolute;
	top:2px;
	right:2px;
	text-align:center;
	border-radius:4px;
}
.order-body .order-body-info{
	flex:1;
	height:80px;
	position:relative;
	overflow:hidden; 
}
.order-body-info-title{
	font-size:16px;
	line-height:16px;
	margin-bottom:10px;
	white-space: nowrap;
	overflow: hidden;
	text-overflow: ellipsis;
	width:100%;
}
.price{
	position:absolute;
	bottom:0;
	right:0;
}
.discount{
	font-size：14px;
	color:#999;
	text-decoration:line-through;
	display:inline-block;
	margin-right:10px;
}

.inprice{
	display:inline-block;
	font-size:14px;
	color:#da0d0d;
}
.order-bottom{
	padding-top:10px;
	text-align:right;
}
.order-bottom .btn{
	text-align:center;
	width:80px;
	height:30px;
	line-height:30px;
	border:1px solid #eee;
	font-size:13px;
	display:inline-block;
	border-radius:5px;
	margin-left:5px;
}
.order-bottom .btn.red{
	color:#fff;
	background:#E64A3B;
	border:1px solid #E64A3B
}
.order-bottom .btn.blue{
	color:#fff;
	background:#37a7ed;
	border:1px solid #37a7ed
}
.masked{
	position:fixed;
	top:0;
	left:0;
	width:100%;
	height:100%;
	z-index:99;
	background:rgba(0,0,0,.3);

}
.confirm-wrap{
	position:fixed;
	top:25%;
	width:95%;
	background:#fff;
	left:2.5%;
	right:2.5%;
	box-sizing:border-box;
	padding:5px;
	border-radius:5px;
	z-index:100
}
.confirm-wrap .confirm-head{
	font-size:16px;
	padding:10px 0;
	border-bottom:1px solid #eee;
	text-align:center;
}
.confirm-wrap p{
	font-size:13px;
	text-align:center;
	color:#999;
	margin:10px 0;
}
.confirm-wrap input{
	font-size:14px;
	border:1px solid #eee;
	height:40px;
	padding:0 4px;
	width:95%;
	margin:0 auto 15px;
	box-sizing:border-box;
	display:block;
	border-radius:4px;
}
.confirm-wrap .confirm-bottom{
	border-top:1px solid #eee;
	display:flex;
}
.confirm-wrap .confirm-bottom .btn{
	flex:1;
	height:35px;
	line-height:35px;
	text-align:center;
	color:#353535;
	font-size:16px;
	position:relative;
}
.confirm-wrap .confirm-bottom .btn.sure{
	color:#37a7ed;
}
.confirm-wrap .confirm-bottom .btn:first-child:after{
	content:'';
	position:absolute;
	right:0;
	top:0;
	bottom:0;
	margin:auto;
	width:1px;
	height:80%;
	background:#eee;
}
.message{
	font-size:16px;
	padding:25px 5px;
	text-align:center;
	display:block;
}
.fade-enter-active, .fade-leave-active {
  transition: opacity .5s;
}
.fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
  opacity: 0;
}
</style>
	<body>
		<div id="order" v-cloak>
			<div class="myList-t">
				<div class="item" :class="{active:tab==0}" @click="changetab(0,-1)">
					<div>全部</div>
				</div>
				<div class="item"  :class="{active:tab==1}"  @click="changetab(1,1)">
					<div>已付款</div>
				</div>
				<div class="item"  :class="{active:tab==2}" @click="changetab(2,2)">
					<div>未付款</div>
				</div>
					
			</div>
			<template v-if="renderflag">
				<template v-if="datalist.length>0">
					<div class="myList-order">
						<div class="item" v-for="(item,index) of datalist">
						<div  class="myList-time">
							<span class="order-time">下单时间：{{item.courseOrder[0].adddate}}</span>
							<span class="red" v-if="item.paystatus==0">待付款</span>
							<span class="blue" v-if="item.paystatus==1">已付款</span>
							<span class="red" v-if="item.paystatus==3">退款中</span>
							<span class="blue" v-if="item.paystatus==4">已退款</span>
						</div>
						<div class="order-body">
							<div class="defaultpic">
								<img :src="item.courseOrder[0].defaultpic" alt="" class="defaultpic">
								<div class="status" v-if="item.courseOrder[0].groupid">拼团</div>
							</div>
							<div class="order-body-info">
								<div class="order-body-info-title">{{item.courseOrder[0].title}}</div>
								<div class="type" v-text="type(item.courseOrder[0].type,item.courseOrder[0].courseType)"></div>
								<div class="price">
									<span class="discount" v-if="item.courseOrder[0].price_market">￥{{item.courseOrder[0].price_market}}</span>
									<span class="inprice">￥{{item.courseOrder[0].price}}</span>
								</div>
							</div>
						</div>
						<div class="order-bottom">
							<div class="btn"  v-if="item.paystatus==0" @click="delorder(index,item.ordersn)">删除订单</div>
							<div class="btn red" v-if="item.paystatus==0" @click="pay(item.payurl)">立即付款</div>
							<div class="btn" v-if="item.paystatus==1 ||item.paystatus==3" @click="chakandetail(item.ckurl)">查看订单</div>
							<div class="btn" v-if="item.courseOrder[0].groupid  && item.paystatus==1" @click="mycollage(item.lookurl)">我的拼团</div>
							<div class="btn blue" v-if="item.courseOrder[0].groupid && item.paystatus==1 && item.successful==0" @click="tuikuan(index,item.ordersn)">等待退款</div>
							<div class="btn blue" v-else-if="item.courseOrder[0].groupid && item.paystatus==1 && item.successful==2" @click="tuikuan(index,item.ordersn)">拼团中</div>
						</div>
					</div>
				</div>
				</template>
				<template v-else>
					<div class="nodata" v-show="nodata"></div>
				</template>
				<div class="bottomtext" v-show="bottom">到底啦</div>
			</template>
			<!--退款的页面-->
			<div class="masked" v-show="maskedFlag"></div>
			<template v-if="tuikuanflag">
				<div class="confirm-wrap">
					<div class="confirm-head">申请退款</div>
					<div class="confirm-body">
						<p>为保证您的资金安全，请填写以下信息，我们到时候会与您联系确认。</p>
						<input type="number" v-model="tel" placeholder="请输入您的手机号">
						<input type="text" v-model="wechat" placeholder="请输入您的微信号">
					</div>
					<div class="confirm-bottom">
						<div class="btn cancel" @click="confirmcancel">取消</div>
						<div class="btn sure" @click="confirmsure">确认</div>
					</div>
				</div>
			</template>
			<transition name="fade">
			
			</transition>
			<template v-if="confirmflag">
				<div class="confirm-wrap" style="width:80%;top:40%;right:10%;left:10%;">
					<div class="confirm-body">
						<div class="message">是否删除该订单</div>
					</div>
					<div class="confirm-bottom">
						<div class="btn cancel" @click="delcancel">取消</div>
						<div class="btn sure" @click="delsure">确认</div>
					</div>
				</div>
			</template>
		</div>
		<script src="<?php echo UOOT ?>Public/common/js/vue2.5.js"></script>
		<script src="<?php echo UOOT ?>Public/wechat/js/studentorder.js"></script>
		<script src="<?php echo UOOT ?>Public/common/js/z.methodLibrary.js?version=1.0"></script>
		<script type="text/javascript">
		</script>
	</body>

</html>
