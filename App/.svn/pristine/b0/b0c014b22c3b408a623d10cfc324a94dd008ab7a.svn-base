<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="renderer" content="webkit"> 
    <title>会员卡</title>
    <link href="<?php echo UOOT ?>Public/common/drag/css/reset.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/wechat/css/home.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Tp/M/Skin01/css/coursedetail.css?<?php echoHash(); ?>" rel="stylesheet">
    <script>
    	var uoot = '<?php echo UOOT ?>';	
    </script> 
<style>
        body{
            background:#F7FCFF
        }
.cardlist .common-list .list-item {
    flex: 1;
    position: relative;
    color: #484848;
    text-align: center;
    line-height: 50px;
    font-size: 16px;
    background: #fff;
}
.item{
    background: #d6e3ec;
    height: 159px;
    /*border-radius: 7px;*/
   
}
.item_img {
	background-size:100%!important;
	background-position: center !important;	
	padding: 0 10px 0 10px;
}
.item-text{
	/*text-align: center;*/
    color: white;
    height: 133px;
}
.price_box{
	font-size: 14px;
}
.detailintro{
	background: #fff;
    margin-top: 10px;
    padding: 10px 0 0 10px;
}
.detailintro-title{
    font-size: 16px;
    font-weight: bold;
}
.detailintro-text{
	text-indent: 25px;
}
.bottomBuy {
    position: fixed;
    width: 100%;
    height: 50px;
    max-width: 480px;
    bottom: 0px;
    z-index: 55;
    display: flex;
    align-items: center;
}
.bottomBuy >div, .bottomBuy >a {
    flex: 1;
    border: none;
    background: #2EB249;
    color: #FFFFFF;
    font-size: 14px;
    align-items: center;
    justify-content: center;
    text-align: center;
    height: 50px;
    display: flex;
    align-items: center;
    flex-direction: column;
    width: 100%;
    margin: 0 auto;
}
</style>
</head>
<body style="background-color: #fff">
    <div id="cardlist" v-cloak class="cardlist">
        <div class="items">
        	<div class="item item_img" v-if="mycard!=''" :style="{backgroundImage: 'url(' + mycard.defaultpic + ')' }">
                <div class="item-text">
                    <p class="title" style="font-size: 22px;">{{mycard.name}}</p>
                    <div v-if='mycard.type==1' class="price_box">
                    	<p>优惠折扣</p>
                    	<p>
                    		<template v-if="mycard.buytime!=0 && mycard.type!=0">
                    			<p>过期时间：{{mycard.buytime}}</p>
                    		</template>
                            <template v-else-if="mycard.buytime==0 && mycard.type!=0">
                            	<p >
	                        		<span>￥{{mycard.price}}</span>/
	                                <span v-if='mycard.effectivetime==1'>1个月</span>
	                                <span v-else-if='mycard.effectivetime==2'>3个月</span>
	                                <span v-else-if='mycard.effectivetime==3'>6个月</span>
	                                <span v-else-if='mycard.effectivetime==4'>1年</span>
	                        	</p>
                            </template>
                            
                    	</p>
                    </div>
                    <div v-else-if='mycard.type==2' class="price_box">
                    	<p>全站免费</p>
                    	<template v-if="mycard.buytime!=0 && mycard.type!=0">
                			<p>过期时间：{{mycard.buytime}}</p>
                		</template>
                        <template v-else-if="mycard.buytime==0 && mycard.type!=0">
                        	<p >
                        		<span>￥{{mycard.price}}</span>/
                                <span v-if='mycard.effectivetime==1'>1个月</span>
                                <span v-else-if='mycard.effectivetime==2'>3个月</span>
                                <span v-else-if='mycard.effectivetime==3'>6个月</span>
                                <span v-else-if='mycard.effectivetime==4'>1年</span>
                        	</p>
                        </template>
                    </div>
                    <div v-else class="price_box">无优惠</div>
                    <div class="detail">{{mycard.shortdesc}}</div> 
                </div>
            </div>
        </div>
        <div class="detailintro">
        	<div class="detailintro-title">会员卡介绍</div>
        	<div class="detailintro-text" v-html='mycard.detailintro'>
        		
        	</div>
        </div>
        <div class="confirm-bg" v-show="confirmFlag" style=""></div>
        <div class="confirm" v-show="confirmFlag">
			<div class="confirm-header">提示</div>
			<div class="confirm-content">
				{{message}}
			</div>
			<div class="confirm-btn-wrap">
				<div class="btn cancel" @click="cancel">取消</div>
				<div class="btn sur" @click="sure">确定</div>
			</div>
		</div>
        <template v-if="mycard.buytime==0 && mycard.type!=0">
			<div class="bottomBuy">
				<div @click="goshop" class="goin">
					<p class="price">￥{{mycard.price}}</p>
				</div>
			</div>
			
		</template>
		<template v-else-if="mycard.buytime!=0 && mycard.type!=0">
			<div class="bottomBuy">
				<div class="goin" style="background:#ccc">
					<p class="price">已是会员</p>
				</div>
			</div>
		</template>
		<div class="loadings" v-show="loadingFlag"></div>	
    </div>
    <script src="<?php echo UOOT;?>Public/common/js/myvoucher.js"></script>
	<script>
	function getParam(paramName) { 
		
		paramValue = "", isFound = !1; 
		if (this.location.search.indexOf("?") == 0 && this.location.search.indexOf("=") > 1) { 
			arrSource = unescape(this.location.search).substring(1, this.location.search.length).split("&"), i = 0; 
			while (i < arrSource.length && !isFound) arrSource[i].indexOf("=") > 0 && arrSource[i].split("=")[0].toLowerCase() == paramName.toLowerCase() && (paramValue = arrSource[i].split("=")[1], isFound = !0), i++ 
		} 
		return paramValue == "" && (paramValue = 0), paramValue 
	} 
		//优惠券列表
	module.add('cardlist',{
		el:'#cardlist',
		data:{
			jsonUrl:uoot + 'Json/index.php',
			loadings:false,
			mode:'ext',
			nodata:false,
			mycard:[],
			loadingFlag:false,
			renderFlag:true,
			confirmFlag:false,
			message:'',//弹框的文本信息
			id:0,
			
		},
		created:function(){
		},
		mounted:function(){
			this.id = getParam('id');
			this.showdata();
		}, 
		methods:{
			//获取数据函数
			showdata:function(){			
				var dataed = {};
				var _this = this;
				dataed.id= this.id;
					 _this.loadingFlag=true
					$post(_this.jsonUrl + '?act=Microportal.groupdetail',dataed,function(res){
						 _this.loadingFlag=false;
						if(res.groupdetail.errCode==10001){
							toast2({
								content:res.groupdetail.errmsg,
								callback:function(){
									window.location.href = res.groupdetail.url
								}
							})
							return false;
						}
						_this.mycard = res.groupdetail.result;
						console.log(_this.mycard)
					},'json')
		    },
		    //复制链接
	        jumpurl:function(url){
	            window.location.href = url;
	        },
			goshop:function(types) {
				var b = {};
				var that = this;
				b.type =9;
				b.id = getParam('id');
				$post(this.jsonUrl + '?act=Microportal.orderNow', b, function (res) {
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
					} else if (res.errCode == 1003) {
						that.confirmFlag = true;
						that.message = '已存在未支付的订单，请前去支付';
						that.orderurl = res.url
					} else if (res.errCode == 1005) {
						location.href = 'https:' + res.url + '';
					} else if(res.errCode == 1006){
						toast2({
							content:'购买成功',
							callback:function(){
								location.reload()
							}
						})
					}else if(res.errcode==1010){
						toast2({
							content:res.msg,
						})
					}
				}, 'json');
			},
				//弹框取消
			cancel:function(){
				this.confirmFlag = false
			},
			//弹框确认
			sure:function(){
				var that = this
				location.href = 'https:' + that.orderurl + '';
			},
		}
	})
	module.import('cardlist')	
	</script>
</body>
</html>