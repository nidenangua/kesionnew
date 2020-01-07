<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="renderer" content="webkit"> 
    <title>我的分销</title>
    <link href="<?php echo UOOT ?>Public/common/drag/css/reset.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/wechat/css/fonts/iconfont.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/wechat/css/microportal/rely.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/wechat/css/microportal/index.css" rel="stylesheet">  
    <script>
    	var uoot = '<?php echo UOOT ?>';	
    </script> 	 
    <style>
		.collage-icon{
			width: 18px;
			height: 18px;
			line-height: 18px;
			text-align:center;
			background:rgba(0,0,0,.3);
			color: #fff;
			text-align: center;
			position: absolute;
			top: 5px;
			right: 5px;
			font-size: 12px;
			border-radius: 50%
		}
		.es span{
			color: #e64a3b;
		}
		.small-box{
			width: 50%;
			float: left;
		}
		.md-cross-btn{
			padding: 0 12px;
		    height: 32pxs;
		    border: 1px solid #37a7ed;
		    font-size: 14px;
		    color: #37a7ed;
		    line-height: 32px;
		    border-radius: 4px;
		    float: right;
            margin-right: 11%;
            background: #fff;
		}
		.dialog-tips {
		    position: fixed;
		    z-index: 100;
		    width: 120px;
		    padding: 20px;
		    white-space: normal;
		    background-color: #fff;
		    box-shadow: 0px 8px 15px 0 rgba(0, 0, 0, 0.1);
		    text-align: center;
		    background: rgba(33,33,33,.3);
		    color: #fff;
		    font-size: 14px;
		    border-radius: 5px;
		}
		.dialog-center {
		    top: 40%;
		    left: 50%;
		    margin-left: -75px;
		}
		.money-box{
			background: #fff;
		    margin-bottom: 10px;
		    height: 109px;
		    padding: 10px;
		    /*text-align: center;*/
		}
		.money-box div{
			float: left;
			margin-left: 34px;
		    font-size: 10px;
		    line-height: 49px;
		    height: 35px;
		}
		.distribute-btn{
			display: inline-block;
    line-height: 1;
    white-space: nowrap;
    cursor: pointer;
    background: #37a7ed;
    border: 1px solid #37a7ed;
    border-color: #37a7ed;
    color: #fff;
    -webkit-appearance: none;
    text-align: center;
    box-sizing: border-box;
    outline: none;
    margin: 0;
    transition: .1s;
    font-weight: 500;
    -moz-user-select: none;
    -webkit-user-select: none;
    -ms-user-select: none;
    padding: 0.5rem 2rem;
    font-size: 0.75rem;
    border-radius: 0.2rem;
		}
		#withdrawal-box{
			position: absolute;
		    height: 166px;
		    background: #fff;
		    padding: 37px 0px 0px 37px;
		    left: 9%;
		    z-index: 999;
		    top: 29%;
		    width: 71%;
		    border-radius: 3%;
		}
		#mark{
			height: 100%;
		    width: 100%;
		    position: absolute;
		    background: #000;
		    top: 0;
		    z-index: 1;
		    opacity: 0.5;
		}
		#realname-box{
			width: 217px;
		    height: 34px;
		    line-height: 34px;
		    border: 1px solid #d6dadf;
		    padding: 0 30px 0 10px;
		    border-radius: 3px;
		    margin-left: 10px;
		    color: #5e6062;
		}
		.tcbtn{float: left;margin-left: 10px;width: 100px;margin-top: 20px;height: 35px;padding: 0!important;}
		
		.toast{
		    position: fixed;
		    z-index: 1000;
		    width: 120px;
		    padding: 20px;
		    white-space: normal;
		    background-color: #fff;
		    box-shadow: 0px 8px 15px 0 rgba(0, 0, 0, 0.1);
		    text-align: center;
		    background: rgba(33,33,33,.3);
		    color: #fff;
		    font-size: 14px;
		    border-radius: 5px;
		}
		.dialog-center {
		    top: 40%;
		    left: 50%;
		    margin-left: -75px;
		    
		}
.myList-t{display:flex;height:2.1rem;line-height:2rem;top:0;left:0;width:100%;background:#fff;border-bottom: solid 1px #8273731a;}
.myList-t a{flex:1;text-align:center;font-size:14px;color:#999;position:relative}
.item {color: red!important;border-right: solid 1px #8273731a;}
    </style>
</head>
<body>
	
	<div id="my-distribute" v-cloak> 
		<div class="money-box">
			<div style="width: 100%;text-align: center;margin: 0px;">
				历史总计：<span style="color: red;font-size: 12px;">{{settled1}}</span>元
			</div>
			
			<div id="" style="margin-left: 57px;">
				未入账：<span style="color: #37a7ed;font-size: 12px;">{{settled3}}</span>元
			</div>
			<div id="" style="margin-left: 57px;">
				待结算：<span style="color: #37a7ed;font-size: 12px;">{{settled2}}</span>元
			</div>
			<div id="">
				<button class="distribute-btn" @click="openBox">点击提现</button>
				<a :href="jumurl" class="distribute-btn" >提现记录</a>
			</div>
		</div>
		<div class="myList-t">
				<a :href='nowurl'><div class="item" >
					我已分销
				</div></a>
				<a :href='newurl'><div   >
					我要分销
					
				</div></a>
			</div>
		<div class="searchbox2">
			<input type="serach" placeholder="请输入要搜索的内容~" id="search"  @keyup="searched"  v-model="search" />
		</div>
		<template v-if="renderFlag">
			<template v-if="datalist.length>0">
				
				<div class="md-info md-info-def" style="padding-top: 10px;margin-top:0px;">
					<div class="md-item-wrap">
						
						<div class="md-item line" v-for="item of datalist" >
							<div class="md-images" :style="{'backgroundImage':'url('+item.defaultpic+')'}">
								<!--<i class="iconfont icon-tuwenzhibo-01" v-if="tab == 0"></i>
								<i class="iconfont icon-yinpin" v-else-if="tab == 1 || (tab == 3 && item.livetype == 1)"></i>
								<i class="iconfont icon-zhibo" v-else-if="tab == 3 && item.livetype == 0"></i>-->
								<!--<div v-if="item.collage==1" class="collage-icon">团</div>-->
							</div>
							<div class="md-name">{{item.title}}</div>
							<div>
								<div class="small-box">
									<div class="md-num">价格：{{ item.price }}</div>
								    <div class="md-price">预计收入：{{ item.commission }}</div>
								</div>
								<div  class="small-box">
									<a :href="item.jumpurl">
										<input type="button" name="" id="" value="查看"  class="md-cross-btn"  />
									</a>
								</div>
							</div>
							
							<!--<div class="md-price" v-else-if="item.chargetype==0">免费</div>
							<div class="md-price" v-else-if="item.chargetype==2">打赏</div>-->
						</div>
						
					</div>
				</div>
	
				
			</template>
			<template v-else><div class="nodata">暂无数据</div></template>
			<div class="nomore" v-show="limit">我们是有底线的~</div>
			<div class="loadings" v-show="loadingFlag"></div>
				<div id="mark" v-show="withdrawal"></div>
				<div id="withdrawal-box" v-show="withdrawal">
					<div id="" style="font-size: 15px;width: 241px;    margin-left: 10px;">
						<span>此次您提现的金额为{{settled2}}</span>
					</div>
					<form action="/Json/index.php?act=Microportal.addWithdrawal" method="post">
					
					<div id="" style="margin-top: 15px;">
						<span id="" style="margin-left: 10px;">
							微信转账需要验证您绑定微信的真实姓名
						</span>
						<input type="text" placeholder="" v-model="realyname" name="realyname" id="realname-box" value="" />
					</div>
					
					<div>
						<button class="distribute-btn tcbtn" @click="close">取消</button>
						<!--<button class="distribute-btn  tcbtn" @click="sure">确认</button>-->
						<input type="submit" name="" id="" class="distribute-btn  tcbtn"  value="确认" />
						
					</div>
					</form>
				</div>	
		</template>
	</div>
	<script src="<?php echo UOOT;?>Public/common/js/MicroPortal.js"></script>
	<script>
       module.import('my-distribute')
		
	</script>

</body>
</html>