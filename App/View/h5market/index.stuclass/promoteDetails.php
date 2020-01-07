<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="renderer" content="webkit"> 
    	<title>详细订单</title>
    <link href="<?php echo UOOT ?>Public/common/drag/css/reset.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/wechat/css/home.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>/Public/wechat/css/order.css" rel="stylesheet">
    <link href="//ks.kesion.com/Public/wechat/css/signin.css" rel="stylesheet">
    <link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
    <script>
    	var uoot = '<?php echo UOOT ?>';	
    	var id = <?php echo $id?>;
    	var type = <?php echo $type ?>;
	</script> 	
	<style>
		body,html{
	background:#EDF2F5
}
.myList-t{display:flex;height:2.1rem;line-height:2rem;position:fixed;top:0;left:0;width:100%;background:#fff;z-index:10}
.myList-t .item{flex:1;text-align:center;font-size:14px;color:#999;position:relative}
.myList-t .item:after{content:'';position:absolute;height:70%;width:1px;background:#eaeaea;right:0;top:0;bottom:0;margin:auto}
.myList-t .item:last-child:after{display:none}
.item-b button{height:1.5rem;line-height: 1.45rem;} 
/*.myList-order{margin-top:2.5rem}*/
.myList-order .item{width:100%;font-size:14px;color:#353535;margin-top:.5rem;line-height:14px;background:#fff;padding:10px;box-sizing:border-box}
.myList-order .item:last-child{margin-bottom:.5rem}
	.myList-t .item.active div{color:#37A7ED;border-bottom: 1px solid #37A7ED;margin: 0rem 1.5rem;line-height:2rem}
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
.order-people{
	padding-left: 10px;
    margin-top: 17px;
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
.head-box{
	    background: #fff;
    padding: 10px;
    font-size: 15px;
    font-weight: bold;
}
	</style>
</head> 
<body>
	<div id="my-distribute-detail" class="myorder" v-cloak>
		<div class="head-box">分销明细</div>
		<template v-if="renderflag">
		     <template v-if="datalist.length>0">
					<div class="myList-order">
						<div class="item" v-for="(item,index) of datalist">
						<div  class="myList-time">
							<span class="order-time">下单时间：{{item.adddate}}</span>
							<span class="red" v-if="item.paystatus==0">待付款</span>
							<span class="blue" v-if="item.paystatus==1">已付款</span>
							<span class="red" v-if="item.paystatus==3">退款中</span>
							<span class="blue" v-if="item.paystatus==4">已退款</span>
						</div>
						<div class="order-body">
							<div class="defaultpic">
								<img :src="item.defaultpic" alt="" class="defaultpic">
							</div>
							<div class="order-body-info">
								<div class="order-body-info-title">{{item.title}}</div>
								<div class="order-people">购买人：<span style="color: royalblue;">{{item.name}}</span></div>
								<div class="price">
									<span class="discount" v-if="item.price_market">￥{{item.price_market}}</span>
									<span class="inprice">￥{{item.price}}</span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</template>
            <template v-else>
				<div class="nodata" ></div>
			</template>

		</template>
	</div>
	<script src="<?php echo UOOT ?>Public/common/js/vue2.5.js"></script>
	    <script src="<?php echo UOOT ?>Public/common/js/MicroPortal.js"></script>

     <script type="text/javascript">
      
  function $post(_url,data,fn,type){
    var xhr = new XMLHttpRequest();
    /**
     * @method open
     * @for xhr
     * @param {String}  [请求类型，get or post]
     * @param {String}  [请求url]
     * @param {Boolean} [是否异步请求] 
     */
    xhr.open("POST", _url, true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");  // 添加http头，发送信息至服务器时内容编码类型
    xhr.onreadystatechange = function() {
      if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 304)) {
        switch (type){
          case "json":
            typeof fn === 'function' && fn.call(this, $json(xhr.responseText,'parse'))
            break;
          default:
            typeof fn === 'function' &&  fn.call(this, xhr.responseText)
            break;
        }
      }
    };
    
    if(typeof data === 'object'){
      data = $json(data,'stringify') 
    };
    xhr.send(data)

  };

  function $json(data,type){
    
    switch (type){
      case "parse":
        return JSON.parse(data)
        break;
      case "stringify":
        return JSON.stringify(data)
        break;
    }
    
  };
 	window.$_monitor = new Object({
		/**	
		 * @module 滚动监听
		 * @name   scroll
		 * @for    $_monitor
		 */
		scroll:{
			top:function(target,fn){
				if(typeof target !== 'object'){
					return false
				};
				target.onscroll = function(e){
					if(typeof fn === 'function'){

						var scrollTop;
						if(target === window){
							scrollTop = document.documentElement.scrollTop || window.pageYOffset || document.body.scrollTop
						}else{
							scrollTop = target.scrollTop
						};
						(scrollTop === 0) ? fn.call(fn) : ''
						
					}
				}
			},
			bottom:function(target,fn){
				if(typeof target !== 'object'){
					return false
				};
				target.onscroll = function(e){
				
					if(typeof fn === 'function'){
						var scrollTop, scrollHeight = target.scrollHeight, containerHeight = target.offsetHeight;
						if(target === window){
							containerHeight = window.innerHeight;
							scrollHeight = document.body.scrollHeight;
							scrollTop = document.documentElement.scrollTop || window.pageYOffset || document.body.scrollTop
						}else{
							scrollTop = target.scrollTop
						};
						
						(scrollTop+containerHeight === scrollHeight) ? fn.call(fn,scrollTop,scrollHeight) : ''
						
					}
				}
				
			}
		}
	});
        module.add('my-distribute-detail',{
            el:'#my-distribute-detail',
            data:{  
                collectlist:[],
                jsonUrl:uoot + 'Json/index.php',    
                maxPerpage:10,
                type:0,
                p:1,
                renderflag:true,
                datalist:[],
            },
            created:function(){
                var that = this;
                that.getlist() 
                $_monitor.scroll.bottom(window,function(){
                    that.p+=1
                    that.getlist()
                })
                
            },
            methods:{
                //获取数据函数
				getlist:function(){			
					var dataed = {};
					var _this = this;
					dataed.p= this.p;
					dataed.id= id;
					dataed.type= type;
					dataed.maxperpage = this.maxPerpage;
						 _this.loadingFlag=true
						$post(_this.jsonUrl + '?act=Microportal.distributeDetail',dataed,function(res){
								
								 _this.loadingFlag=false
								//如果没有数据的话
								if(res.distributeDetail.page.total_pages==0){
									 _this.loadmoreFlag=false
									return false
								}
								var datas = res.distributeDetail.list;
								var datalength = datas.length;
								
								for(var i=0;i<datalength;i++){
									_this.datalist.push(datas[i])
								}
								
								
								 _this.p=_this.p+1
								
								//如果数据不足的话  当前页数是最后一页的话 或者是已经返回空数组回来了
								if(datalength<_this.maxPerPage &&res.distributeDetail.total_pages==res.distributeDetail.now_page || datalength==0){
									 _this.loadmoreFlag=false
									 _this.limit=true
									return false
								}
						},'json')
			    },
       		},

        
            
        })
    module.import('my-distribute-detail')
    
     </script>
</body> 
</html>