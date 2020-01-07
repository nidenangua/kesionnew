
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
.myList-t{display:flex;height:2.1rem;line-height:2rem;position:fixed;top:0;left:0;width:100%;background:#fff;}
.myList-t .item{flex:1;text-align:center;font-size:14px;color:#353535;position:relative}
.myList-t .item:after{content:'';position:absolute;height:70%;width:1px;background:#eaeaea;right:0;top:0;bottom:0;margin:auto}
.myList-t .item:last-child:after{display:none}
.item-b button{height:1.5rem;line-height: 1.45rem;} 
.myList-order{background:#fff;width:100%;box-sizing:border-box;padding:15px 15px 5px 15px;box-shadow:0 3px 14px rgba(55,167,237,.25);margin-bottom:10px}
.myList-order .item{display:flex;align-items:center;width:100%;font-size:14px;color:#353535;margin-top:.5rem;line-height:14px}
.myList-order .item:last-child{margin-bottom:.5rem}
<?php if(empty($this->isp)){ ?>
	.myList-t .item.active div{color:#FFE57B;border-bottom: 2px solid #FFE57B;margin: 0rem 1.5rem;line-height:2rem}
<?php }else{ ?>
	.myList-t .item.active div{color:#37A7ED;border-bottom: 2px solid #37A7ED;margin: 0rem 1.5rem;line-height:2rem}
<?php } ?>
.myList-order .item .i-head{flex:1;overflow:hidden}
.myList-order .item .i-body{margin-left:.5rem}
.myList-order .item .teacher{font-size:16px;color:#353535}
.myList-order .item-t{display:flex;border-bottom:1px solid #eaeaea;align-items:center;padding-bottom:.5rem}
.myList-order .item-t .i-head{flex:1;overflow:hidden;color:#353535;font-size:14px;line-height:14px}
.myList-order .item-t .i-body{font-size:15px;line-height:15px}
.myList-order .item-b{border-top:1px solid #eee;text-align:right;padding:.2rem 0 0}
.myList-order .item-b .item-btn{padding:0 .4rem;font-size:14px;line-height:1.5rem;height:1.5rem;display:inline-block;margin-left:.5rem;border-radius:5px;border:1px solid #eee;color:#fff}
.myList-title{font-size: .8rem;line-height: 1.6rem;}
.myList-title>span{font-size: .5rem;float: right;}
.myList-item{font-size:.6rem; color: #353535;line-height: 1rem;margin-bottom: .2rem; }
.myList-time{font-size:.6rem; color: #888;border-bottom: 1px solid #eaeaea;padding-bottom: .3rem;}
.myList-price{float: right;}
.myList-gray{color: #888;} 


</style>
	<body style="background: #F6F5F0;">
		<div class="change-wrap">
			<div class="myList-t blue-box_shadow">
				<div class="item active" onclick = "myList.slideTab(this,'max')" id="all">
					<div>全部</div>
				</div>
				<div class="item" onclick = "myList.slideTab(this,1)">
					<div>已付款</div>
				</div>
				<div class="item" onclick = "myList.slideTab(this,2)">
					<div>未付款</div>
				</div>
					
			</div>
			<div style="height: 50px;"></div>
			<div class="cs-container" id="myList-list">
				
				<!--<div class="myList-order">
					<div class="myList-time">下单时间:&nbsp;2018-05-21 15:17:03</div>
					<div>
						<div class="myList-title">
							精装修班级通
							<span class="red">待付款</span>
						</div>
						<div class="myList-gray">刘娜老师</div>
						<div class="myList-item clearfix">
							<span class="myList-gray">线上+面授班级</span>
							<span class="myList-price">价格:&nbsp;<span class="orange">￥800.00</span></span>
						</div>
					</div>
					<div class="item-b">
						<button class="r-btnGray" onclick="order.chakan(381)">删除订单</button>&nbsp;&nbsp;
						<button class="x-btnYell" onclick="order.chakan(381)">立即支付</button>
					</div>
				</div> -->
				
				<!--<div class="myList-order">
					<div class="myList-time">下单时间:&nbsp;2018-05-21 15:17:03</div>
					<div>
						<div class="myList-title">
							精装修班级通
							<span class="blue">已付款</span>
						</div>
						<div class="myList-gray">刘娜老师</div>
						<div class="myList-item clearfix">
							<span class="myList-gray">线上+面授班级</span>
							<span class="myList-price">价格:&nbsp;<span class="orange">￥800.00</span></span>
						</div>
					</div>
					<div class="item-b">
						<button class="r-btnGray" onclick="order.chakan(381)">查看订单</button>&nbsp;&nbsp;
					</div>
				</div>-->
			
			
			<div class="loadings" id="loadings"></div>
		</div>

		<script src="<?php echo UOOT ?>Public/common/js/z.methodLibrary.js?version=1.0"></script>
		<script type="text/javascript">
			var myList = new Object({
				page:0,
				paystatus:'max',
				isFather:0,
				slideTab:function(target,id){
					target.setClass('active','add').getSiblings().setClass('active','remove');
					$_id('myList-list').innerHTML='';
					myList.paystatus = id;
					myList.page = 0;
					myList.list();
				},
				list:function(){
					myList.page=myList.page+1;
					var myLists = $_id('myList-list');
					var ajax = {
						url:'/Json/index.php?act=Class.courseOrder&paystatus='+myList.paystatus+'&p='+myList.page,
						data:''
					}
					
					$_post(ajax.url,ajax.data,res=>{
						console.log(res);
						
						if(res.courseOrder.values){
							if(res.courseOrder.values.length>0){
								getAll = res.courseOrder.values; 
								getAll.map(function(val){
									var alldata = myList.creatCont(val);
									myLists.addChilds(alldata);
								}) 
							}else{
								if(myList.page==1){
									if(myLists.isFather=='0'){
										myLists.addChilds('<div class="nodata2"></div>');
									}else{
										myLists.addChilds('<div class="nodata1"></div>');
									}
									
								}
							}
						}else{
							if(myLists.isFather=='0'){
								myLists.addChilds('<div class="nodata2"></div>');
							}else{
								myLists.addChilds('<div class="nodata1"></div>');
							}
						}
					},'json');
					
				},
				creatCont:function(data){
					var couserary = ['','点播','直播','面授','混合'];
					var classary  =['','线上线下组合','线上班级','面授班级'];
					var pushdata = '<div class="myList-order"><div class="myList-time">下单时间:&nbsp;'+data.courseOrder['0'].adddate+'</div>';
					pushdata 	+= '<div><div class="myList-title">'+data.courseOrder['0'].title;
					if(data.paystatus ==1){
						pushdata    +='<span class="blue">已付款</span></div>';
					}else{
						pushdata    +='<span class="red">待付款</span></div>';
					}
					console.log(data.type)
					if(data.type == 0){
						pushdata 	+= '<div class="myList-gray">'+data.courseOrder['0'].name+'</div><div class="myList-item clearfix"><span class="myList-gray">'+couserary[data.courseOrder['0'].courseType]+'</span>';
					}else if(data.type == 1){
						pushdata 	+= '<div class="myList-gray">'+data.courseOrder['0'].name+'</div><div class="myList-item clearfix"><span class="myList-gray">'+classary[data.courseOrder['0'].classType]+'</span>';
					}else if(data.type == 2){
						pushdata 	+= '<div class="myList-gray">充值订单</div><div class="myList-item clearfix"><span class="myList-gray"></span>';
					}
					pushdata 	+= '<span class="myList-price">价格:&nbsp;<span class="orange">￥'+data.courseOrder['0'].price+'</span></span></div></div><div class="item-b">';
					if(data.paystatus ==1){
						pushdata 	+= '<button class="r-btnGray" onclick="myList.chakan('+data.ordersn+')">查看订单</button>&nbsp;&nbsp;';
					}else{
						pushdata 	+= '<button class="r-btnGray" onclick="myList.delorder('+data.ordersn+')">删除订单</button>&nbsp;&nbsp;';
						pushdata 	+= '<button class="x-btnYell" onclick="myList.pay('+data.ordersn+')">立即支付</button>';
					}
					pushdata    += '</div></div>';
					return pushdata;
				},
				chakan:function(ordersn){
					window.location.href='<?php echo M_URL('h5market','myOrder'); ?>?ordersn='+ordersn;
				},
				delorder:function(ordersn){
					var ajax = {
						url:'/Json/index.php?act=Users.delorder&ordersn='+ordersn,
					}
					$_post(ajax.url,ajax.data,res=>{
						alert('删除成功');
						window.location.reload();
					},'json');
				},
				pay:function(ordersn){
					var url = "<?php echo M_URL('h5market','inh5game'); ?>?wxid=<?php echo $this->wxid; ?>&ordersn="+ordersn;
					window.location.href=url;
				}
			})
			
			myList.list();
			myList.isFather='<?php echo $this->isp;?>';
			
			$_monitor.scroll.bottom(window,()=>{
				myList.list();
			});
		</script>
	</body>

</html>
