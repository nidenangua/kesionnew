<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="renderer" content="webkit"> 
    <title>收入明细</title>
    <link href="<?php echo UOOT ?>Public/common/drag/css/reset.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/wechat/css/home.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/wechat/css/intention.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/wechat/css/order.css" rel="stylesheet">
    	
    <script>
    	var uoot = '<?php echo UOOT ?>';	
    </script> 	
</head>
	<body>
		<div class="verm-box" id="incomedetails" v-cloak>
			<div class="change-wrap">
				<div class="change-title">
					网校总收入:<i class="orange">{{income || 0}}</i>元
				</div>
				
				<div class="intent-t intent-t2">
					<div class="item" :class="{active:tab==3}" @click="tabs(3)" >
						全部
					</div>
					<div class="item" :class="{active:tab==1}" @click="tabs(1)">
						支出
					</div>
					<div class="item" :class="{active:tab==2}" @click="tabs(2)">
						充值
					</div>	
				</div>
			
				<div class="searchbox">
					 <input type="search" name="" id="myconsult" value="" placeholder="请输入您想要搜索的内容" v-model="search" @keyup="searchRequest" />
				</div>
				
			</div>
			<div class="change-wrap" v-if="campusArr.length>1">
				<div class="cash-list" v-for="(item,index) of campusArr" >
					<div class="cash-list-sitem">
						<div class="cash-list-txt">
							<p class="cash-list-time">时间：{{item.adddate}}</p>
							
							<h5>用户：{{item.username}} 
							
								<div class="cash-list-price">
							
								<p v-if="item.type == 0" style="color:#37a7ed;">￥{{item.cmoney}}</p>
								<p v-if="item.type == 1" style="color:#e85c50;">-￥{{item.cmoney}}</p>
							</div>
							
							</h5> 
							<p class="cash-account">手机：{{item.mobile}}</p>
							<p class="cash-style">内容：{{item.mark}}</p>
						</div>
					
					</div>
				</div>
		
					
			</div>
			<div v-else class="nodata"></div>
		</div>
	
		
	</body>
<script src="<?php echo UOOT ?>Public/common/js/currency/gate.js" type="text/javascript"></script>
<script>
		module.add('incomedetails',{
			el:'#incomedetails',
			data:{			
		 		campusArr:[],
		 		jsonUrl:uoot + 'Json/index.php', 	
		 		maxPerpage:5,
		 		p:1,
		 		income:0,
		 		tab:3,
		 		search:'',
		 		
			},
			created:function(){
		 		var that = this;
		   		that.getdata() 
		   		$_monitor.scroll.bottom(window,function(){
					that.getdata(3)
				})
		 		
		 	},
			
			methods:{
				getdata:function(type){
					var that = this;
					var newData = {}
					newData.page = that.maxPerpage;
					newData.p = that.p;
					newData.type = type;
					newData.keyword = this.search;
		 			$post(that.jsonUrl+'?act=WeChat.memberbill',newData,function(res){
		 				that.income = res.memberbill.income;
		 				console.log(res)
		 				//如果没有数据的话
		 				if(res.memberbill.page.total_pages==0){
		 					that.loadMoreFlag = false;
		 					return false
		 				}
		 				var datas = res.memberbill.list;
		 				var datalength = datas.length;
		 				
		 				for(var i=0;i<datalength;i++){
		 					that.campusArr.push(datas[i])
		 				}
		 				that.p++;
		 				if(datas<that.maxperpage || datas==0){
		 					that.loadMoreFlag = false;
		 					return false
		 				}
		 				
		 			
		 			},'json')	
	 			},
	 			tabs:function(type){
	 				this.p = 1;
	 				this.tab = type;
	 				this.campusArr =[];
	 				this.getdata(type);
	 				
	 			},
	 			searchRequest:function(){ 
		 			if(event.keyCode==13){
		 				this.p = 1;
		 				this.campusArr = [];
		 				this.loadMoreFlag = true;
		 				this.getdata(this.tab)
		 				
		 			}
		 			
		 		},
	 		},
		})
		




	module.import('incomedetails')
	
		

</script>
</html>
