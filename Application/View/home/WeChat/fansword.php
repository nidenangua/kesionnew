<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="renderer" content="webkit"> 
    <title>消息</title>
    <link href="<?php echo UOOT ?>Public/common/drag/css/reset.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/wechat/css/home.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/wechat/css/verm.css" rel="stylesheet">
   
    <script>
    	
    	var uoot = '<?php echo UOOT ?>';	
    </script> 	
    <style>
    	.verm-list {
    		display: block;
    		  height: auto;
    		  padding-bottom: 1rem;
    	}
    	.verm-txt p {
    		overflow: hidden;
    	}
    	.verm-left {
    		display: block;
    		position: relative;
    		padding-left: 4rem;
    	}
    	.verm-img {
    		position: absolute;
    		left: 0;
    	}
    	.verm-right {
    		padding-left: 4.5rem;
    	}
    	
    </style>
    <style type="text/css">
    	
    	.mask{
    		display: block;
    	}
    	.confirm {
		    position: fixed;
		    top: 0;
		    bottom: 0;
		    left: 0;
		    right: 0;
		    width: 80%;
		    margin: auto;
		    z-index: 56;
		    border-radius: 10px;
		    background: #fff;
		    overflow: hidden;
		    height: 9rem;
		    
		    box-sizing: border-box;
		    padding: 0 1rem;
		}
		.confirm .item-b {
		    position: absolute;
		    bottom: 0;
		    left: 0;
		    display: flex;
		    height: 2rem;
		    line-height: 2rem;
		    width: 100%;
		    font-size: 14px;
		}
		.confirm .item-b .item-inner {
		    flex: 1;
		    text-align: center;
		    color: #f28550;
		}
		
		.confirm .item-b .item-inner.active {
		    color: #37a7ed;
		}
		.confirm .title {
		    font-size: 0.85rem;
		    text-align: center;
		    padding-top: 10px;
		    color: #454545;
		}
    </style>

</head>    
	<body>
		<div class="verm-box" id="fanword" v-cloak>
			<div v-if="campusArr.length>1">
				<div class="verm-list" v-for="(item,index) of campusArr" :key='item.id'>
					<div class="verm-left">
						<div class="verm-img">
						
							<img :src="item.headimgurl" />
						</div>
						<div class="verm-txt">
							<h5> {{item.nickname}} </h5>
							<p>{{item.content}}</p>
							
						</div>					
					</div>
					<div class="verm-right">
						<button class="verm-btn" @click="open(item.id)">回复</button>
					</div>
				</div>
			</div>
			<div v-else class="nodata"></div>  
			<div class="mask" v-if="del==1" ></div>
			<div class="confirm" id="confirm" v-if="del==1" >
				<div class="title">
					<textarea v-model="content" style="height: 6rem;width: 12rem;"></textarea>
				</div>										
				<div class="item-b">
					<div class="item-inner" @click="dels(2)">取消</div>
					<div class="item-inner active" @click="rely(userid)">确认</div>
				</div>
			</div>
			
		</div>
	</body>
	
	
	<script src="<?php echo UOOT ?>Public/common/js/currency/gate.js" type="text/javascript"></script>
	<script src="<?php echo UOOT ?>Public/common/js/MicroPortal.js" type="text/javascript"></script>
	<script>
		module.add('fanword',{
			el:'#fanword',
			data:{			
		 		campusArr:[],
		 		jsonUrl:uoot + 'Json/index.php', 	
		 		maxPerpage:5,
		 		p:1,
		 		del:0,
		 		content:'',
		 		userid:'',
		 		
			},
			created:function(){
		 		var that = this;
		   		that.getdata() 
		   		$_monitor.scroll.bottom(window,function(){
					that.getdata()
				})
		 		
		 	},
			
			methods:{
				getdata:function(){
					var that = this;
					var newData = {}
					newData.page = that.maxPerpage;
					newData.p = that.p;
			 			$post(that.jsonUrl+'?act=Microportal.fansword',newData,function(res){
			 				
			 				console.log(res)
			 				//如果没有数据的话
			 				if(res.fansword.page.total_pages==0){
			 					that.loadMoreFlag = false;
			 					return false
			 				}
			 				var datas = res.fansword.list;
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
		 			open:function(id){
		 				this.del=1;
		 				this.userid = id;
		 			},
		 			rely:function(id){
		 				var that = this;
						var newData = {}
						newData.id = id;
						newData.content = that.content
						if(newData.content ==''){
							toast2({
				 				'content':'回复消息不能为空'
				 			});
				 			that.del=0;
						}else{
							$post(that.jsonUrl+'?act=WeChat.doReplyNews',newData,function(res){
					 			toast2({
					 				'content':res.doReplyNews.msg
					 			});
					 			that.del=0;
					 			that.content = '';
			 				},'json')	
						}
		 			},
		 			dels:function(i){
		 				this.del=i;
		 			}
		 		},

		
			
		})
		




	module.import('fanword')
	</script>
</html>
