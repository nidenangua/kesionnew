<!DOCTYPE HTML>
<html>
	<head>
	 <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="renderer" content="webkit"> 
    <title>微信支付</title>
    <link href="<?php echo UOOT ?>Public/common/drag/css/reset.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/wechat/css/home.css" rel="stylesheet">
     <link href="<?php echo UOOT ?>Public/wechat/css/wechatpay.css" rel="stylesheet">	
	</head>
	<script>
    	var uoot = '<?php echo UOOT ?>';	
    </script> 
	
	<body>
		<div id="wxpay" v-cloak>
		  <div class="wx-tab" v-show="tab==0">		
			<div class="wp-box">
				<div class="wp-header">
					<h5>存储余额</h5>
					<p data-money="0">{{usermoney}}</p>
					<button class="wp-btn" onclick="window.location.href='<?php echo M_URL('h5market','paylog'); ?>'">消费明细</button>
				</div>
			</div>	
			<div class="wp-choice" >
				<div class="title">充值</div>
				<ul class="clearfix" >
					<li>
						<div class="number" data-money="6" @click="selectMoney">
							6元
						</div>
					</li>
					<li>
						<div class="number" data-money="68" @click="selectMoney">
							68元
						</div>
					</li>
					<li>
						<div class="number" data-money="208" @click="selectMoney">
							208元
						</div>
					</li>
					<li>
						<div class="number" data-money="698" @click="selectMoney">
							698元
						</div>
					</li>
					<li>
						<div class="number"data-money="998" @click="selectMoney">
							998元
						</div>
					</li>
					<li>
						<div class="number"  @click="tab=1">
							其他金额
						</div>
					</li>
				</ul>
				
				
			
			</div>
		  </div>
		  
		  <div class="wx-tab wp-wihte" v-show="tab==1">
		  	<div class="wp-money clearfix">
		  		<span>充值金额</span>
		  		<span style="float:right ;">余额￥0.00元</span>
		  	</div>
		  	<div class="wp-write">
		  		<span>￥</span>
		  		<input class="wp-input" type="text" placeholder="0.00" v-model="money" />
		  	</div>
		  </div>	
		  
		  
		  <div class="wp-confim " @click="goshop()">确认支付</div>
		
		</div>	
	<script src="<?php echo UOOT ?>Public/common/js/currency/gate.js" type="text/javascript"></script>
		<script>
			module.add('wechartpay',{
			el:'#wxpay',
			data:{			
		 		tab:0,
		 		jsonUrl:uoot + 'Json/index.php', 	
		 		usermoney:0,
		 		userlist:[],
		 		money:0.00,//上传的金额		 		
			},
			created:function(){
		 		var that = this;  		
		 		this.balance();
		 	},
			
			methods:{
				selectMoney:function(e){
				
					this.money = e.currentTarget.dataset.money;
					
					this.goshop();
					
				},
				goshop:function() {
					
					var newData = {};
					newData.type = 2;
					newData.price = this.money;
					console.log (newData.price);
				
					if(this.money==0.00){
						toast2({
								content: '金额不能为0'
						});
						return false
					}
				
				
				
					$post(this.jsonUrl + '?act=Microportal.orderNow', newData, function (res) {
						
						var res = res.orderNow;
						if (res.errCode == 1000) {
							toast2({
								content: '请先登录'
							});
				
							return false;
						} else if (res.errCode == 1004) {
							toast2({
								content: '购买失败，请重新购买'
							});
						} else if (res.errCode == 1002) {
							toast2({
								content: '你的账号不需要购买'
							});
						} else if (res.errCode == 1005) {
							location.href = 'https:' + res.url + '';
						} 
					}, 'json');
				},
				balance:function(e){
					var newData={}
					money ='';
					var _this = this;
					console.log(this)
					$post(this.jsonUrl + '?act=Microportal.usergold',newData,function (res) {						
						_this.usermoney = res.usergold.money;
						_this.userlist = res.usergold.list
					},'json')
				}


			}
			
		})
		
		module.import('wechartpay');
		</script>
	
	</body>
</html>