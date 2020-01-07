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
	position: relative;
	margin: 12px 13px 0 13px;
    background: #d6e3ec;
    height: 159px;
    border-radius: 7px;
   
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
.show_more{
	font-size: 15px;
    text-align: center;
    color: #c1bbbb;
}
.detail{
	text-indent: 25px;
}
.sdfjs{
	    background-image:url('/Images/now.png');
    /*border-radius: 50px;*/
	    width: 32px;
    height: 32px;
    position: absolute;
    top: 33%;
    right: 3%;
    padding: 5px;	
        background-size: 100%!important;
    background-position: center !important;
}
</style>
</head>
<body>
    <div id="cardlist" v-cloak class="cardlist">
        <div class="common-list line" ref="navlist">
                <div class="list-item">会员卡</div>
        </div> 
        <template v-if="renderFlag">
            <div class="items" v-if="mycard!=''">
            	<div class="item item_img" :style="{backgroundImage: 'url(' + mycard.defaultpic + ')' }" @click="jumpurl(mycard.jumpurl)">
                    <div class="item-text">
                        <p class="title" style="font-size: 22px;">{{mycard.name}}</p>
                        <div v-if='mycard.type==1' class="price_box">
                        	<p>优惠折扣(<span v-if='mycard.other==1'>享受其他优惠</span><span v-else-if='mycard.other==0'>不享受其他优惠</span>)</p>
                        	<p>
                        		<span>￥{{mycard.price}}</span>
                        		<span v-if='mycard.effectivetime==1'>/1个月</span>
                                <span v-else-if='mycard.effectivetime==2'>/3个月</span>
                                <span v-else-if='mycard.effectivetime==3'>/6个月</span>
                                <span v-else-if='mycard.effectivetime==4'>/12个月</span>
                                <p>过期时间：{{mycard.buytime}}</p>
                        	</p>
                        </div>
                        <div v-else-if='mycard.type==2' class="price_box">
                        	<p>全站免费</p>
                        	<p>过期时间：{{mycard.buytime}}</p>
                        </div>
                        <div v-else class="price_box">无优惠</div>
                        <div class="detail">{{mycard.shortdesc}}</div> 
                    </div>
                    <div class="show_more">
                    	点击查看更多
                    </div>
                    <div class="sdfjs">
                    </div>
                </div>
            </div>
            <template v-if="datalist.length>0" >
                <div class="item item_img" v-for="(item, index) in datalist" :style="{backgroundImage: 'url(' + item.defaultpic + ')' }" @click="jumpurl(item.jumpurl)">
                    <div class="item-text">
                        <p class="title" style="font-size: 22px;">{{item.name}}</p>
                        <div v-if='item.type==1' class="price_box">
                        	<p>优惠折扣(<span v-if='item.other==1'>享受其他优惠</span><span v-else-if='item.other==0'>不享受其他优惠</span>)</p>
                        	<p>
                        		<span>￥{{item.price}}</span>
                                <span v-if='item.effectivetime==1'>/1个月</span>
                                <span v-else-if='item.effectivetime==2'>/3个月</span>
                                <span v-else-if='item.effectivetime==3'>/6个月</span>
                                <span v-else-if='item.effectivetime==4'>/12个月</span>
                        	</p>
                        </div>
                        <div v-else-if='item.type==2' class="price_box">
                        	<p>全站免费</p>
                        	<p>
                        		<span>￥{{item.price}}</span>/
                                <span v-if='item.effectivetime==1'>1个月</span>
                                <span v-else-if='item.effectivetime==2'>3个月</span>
                                <span v-else-if='item.effectivetime==3'>6个月</span>
                                <span v-else-if='item.effectivetime==4'>1年</span>
                        	</p>
                        </div>
                        <div v-else class="price_box">无优惠</div>
                        <div class="detail">{{item.shortdesc}}</div> 
                    </div>
                    <div class="show_more">
                    	点击查看更多
                    </div>
                </div>
				
			</template>
			<template v-else-if='datalist.length==0 &&mycard==""'><div class="nodata"></div></template>
			<div class="nomore" v-show="limit">我们是有底线的~</div>
			<div class="loadings" v-show="loadingFlag"></div>			
        </template>
    </div>
    <script src="<?php echo UOOT;?>Public/common/js/myvoucher.js"></script>
    <script src="https://cdn.jsdelivr.net/clipboard.js/1.5.12/clipboard.min.js"></script>
	<script>
		//优惠券列表
	module.add('cardlist',{
		el:'#cardlist',
		data:{
			jsonUrl:uoot + 'Json/index.php',
			loadings:false,
			mode:'ext',
			botLimit:[],
			showthis:false,
			searchContent: [],
			searchFlag: false,
			searchval:'',
			nodata:false,
			/***音频主函数 ***/
			page:0,
			search:'',
			total:0,
			listdata:'',
			/*新增*/
			datalist:[],
			mycard:[],
			p:1,
			loadingFlag:false,
			maxPerPage: 10, 
			limit:false,
			renderFlag:false,
			newurl : uoot+'h5market/distributeList',
            nowurl:uoot+'h5market/myDistribute',
            newbg:false,
            realcommission:0,
			
		},
		created:function(){
		},
		mounted:function(){
			this.getlist()
			var that = this;
			$_monitor.scroll.bottom(window,function(){
				that.getlist()
				
			})	
		},
		methods:{
			//搜索
			searched:function(){
				var _this = this;
				var e = window.event || arguments[0];
				if (e.keyCode === 13) {
					//不能重新声明，这样会导致内层数组找不到必须通过vue.set去重新声明
//					for(var i = 0;i<7;i++){
						 _this.p=1
						 _this.loadmoreFlag=true
						_this.loadingFlag=true
						_this.datalist=[]
						_this.limit=false
//					}
					this.getlist()
				}
			},
			//获取数据函数
			getlist:function(){			
				var dataed = {};
				var _this = this;
				dataed.p= this.p;
				dataed.maxperpage = this.maxPerPage;
					 _this.loadingFlag=true
					$post(_this.jsonUrl + '?act=Microportal.groupmsg',dataed,function(res){
							
							 _this.loadingFlag=false
							 _this.renderFlag = true;
							//如果没有数据的话
							if(res.groupmsg.page.total_pages==0){
								 _this.loadmoreFlag=false
								return false
							}
							_this.mycard = res.groupmsg.mygroup;
							console.log(_this.mycard)
							var datas = res.groupmsg.grouplist;
							var datalength = datas.length;
							
							for(var i=0;i<datalength;i++){
								_this.datalist.push(datas[i])
							}
							
							
							 _this.p=_this.p+1
							
							//如果数据不足的话  当前页数是最后一页的话 或者是已经返回空数组回来了
							if(datalength<_this.maxPerPage &&res.groupmsg.page.total_pages==res.groupmsg.page.now_page && datalength!=0){
								 _this.loadmoreFlag=false
								 _this.limit=true
								return false
							}
					},'json')
		    },
		    //复制链接
	        jumpurl:function(url){
	            window.location.href = url;
	        },
			
		}
	})
	module.import('cardlist')	
	</script>
</body>
</html>