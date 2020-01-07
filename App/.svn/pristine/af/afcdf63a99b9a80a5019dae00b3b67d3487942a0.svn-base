<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="renderer" content="webkit"> 
    <title>推广列表</title>
    <link href="<?php echo UOOT ?>Public/common/drag/css/reset.css?<?php $site = $this->cache->GetACache('setting');echo $site['jshash'];?>" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/wechat/css/fonts/iconfont.css?<?php $site = $this->cache->GetACache('setting');echo $site['jshash'];?>" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/wechat/css/microportal/rely.css?<?php $site = $this->cache->GetACache('setting');echo $site['jshash'];?>" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/wechat/css/microportal/index.css?<?php $site = $this->cache->GetACache('setting');echo $site['jshash'];?>" rel="stylesheet">  
    <link href="<?php echo UOOT ?>Tp/M/Skin01/css/coursedetail.css?<?php $site = $this->cache->GetACache('setting');echo $site['jshash'];?>" rel="stylesheet">  
    <script>
    	var uoot = '<?php echo UOOT ?>';	
    </script> 	 
    <style>
    	<?php if($this->dir1 == 'Skin02'){ ?>
		.common-list .list-item.active{color:#09bb07}
		.common-list .list-item.active span:after{background: #09bb07;}
    	<?php } elseif($this->dir1 == 'Skin03'){ ?>
		.common-list .list-item.active{color:#ff7300}
		.common-list .list-item.active span:after{background: #ff7300;}
		.md-info .md-price{color:#ff7300}
		<?php } elseif($this->dir1 == 'Skin04'){ ?>
		.common-list .list-item.active{color:#ff8f00}
		.common-list .list-item.active span:after{background: #ff8f00;}
		<?php }?>
		
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
			padding: 0 22px;
		    height: 32px;
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
		.single-box{
			position: relative;
			margin-bottom: 10px;
   			border-bottom: solid 1px #8881812b;
		}
		.small-box-btn{
			position: absolute;
		    top: 45%;
		    right: 0%;
		}
		.myList-t{display:flex;height:2.1rem;line-height:2rem;top:0;left:0;width:100%;background:#fff;border-bottom: solid 1px #8273731a;}
.myList-t a{flex:1;text-align:center;font-size:14px;color:#999;position:relative}
.item {color: red!important;border-right: solid 1px #8273731a;}
    </style>
</head>
<body>
	<div id="distributeList" v-cloak> 
		<div class="myList-t">
			    <a :href='newurl'><div   class="item">
				    我要分销
				</div></a>
				<a :href='nowurl'><div  >
					我已分销
				</div></a>
				
			</div>
		<div class="searchbox2">
			<input type="serach" placeholder="请输入要搜索的内容~" id="search"  @keyup="searched"  v-model="search" />
		</div>
		<!--<div class="common-list line" ref="navlist">
			<div :class="{'active':tab==0 }" class="list-item" @click="options(2,4,0)" v-if="nav[0]==1" id="i0"><span>图文</span></div>
			<div :class="{'active':tab==1 }" class="list-item" @click="options(2,3,1)" v-if="nav[1]==1" id="i1"><span>音频</span></div>
			<div :class="{'active':tab==2 }" class="list-item" @click="options(2,1,2)" v-if="nav[2]==1" id="i2"><span>点播</sapn></div> 
			<div :class="{'active':tab==3 }" class="list-item" @click="options(2,2,3)" v-if="nav[3]==1" id="i3"><span>直播</sapn></div>
			<div :class="{'active':tab==4 }" class="list-item" @click="options(1,0,4)" v-if="nav[4]==1" id="i4"><span>互动</span></div>
			<div :class="{'active':tab==5 }" class="list-item" @click="options(3,0,5)" v-if="nav[5]==1" id="i5"><span>试卷</span></div>
			<div :class="{'active':tab==5 }" class="list-item" @click="options(3,0,6)" v-if="nav[6]==1" id="i5"><span>语音</span></div>
		</div> -->
		<template v-if="renderFlag">
			<template v-if="datalist.length>0">
				<!--我要赚钱-->
			<div class="confirm-bg" v-show="newbg" @click="hideImg"></div>
			<div class="confirm" v-show="newbg" >
				<div class="confirm-img">
					<img src="<?php echo UOOT ?>Tp/M/Skin01/css/make-logo.png">
				</div>
				<div class="confirm-content">
					<h5> 分享赚钱</h5>
					<div class="confirm-del">
						推荐课程给好友,赚{{realcommission}}元学费
					</div>
					<div class="confirm-share">
						点击右上角分享按钮即可以完成分享
					</div>
				</div>
			
			</div>
			
    	<!--我要赚钱-->
				<div class="md-info md-info-def" style="padding-top: 10px;margin-top:0px;">
					<div class="md-item-wrap">
						
						<div class="single-box" v-for="item of datalist" >
							<a :href="item.url">
								<div class="md-item line">
									<div class="md-images" :style="{'backgroundImage':'url('+item.defaultpic+')'}"></div>
									<div class="md-name">{{item.title}}</div>
									<div>
										<div class="small-box">
											<div class="md-num">价格：{{ item.price }}</div>
										    <div class="md-price">佣金：{{ item.commission }}</div>
										</div>
									</div>
								</div>
							</a>
							<div  class="small-box-btn">
								<input type="button" name="" id="" value="推广"  class="md-cross-btn" @click="obtain(item.id,item.courseType,item.commission)" />
							</div>
						</div>
						
					</div>
				</div>
	
				
			</template>
			<template v-else><div class="nodata">暂无数据</div></template>
			<div class="nomore" v-show="limit">我们是有底线的~</div>
			<div class="loadings" v-show="loadingFlag"></div>	
		</template>
	</div>
	
	<?php include $this->dir2.'footer.php';?> 
	<script src="<?php echo UOOT;?>Public/common/js/MicroPortal.js?456465646"></script>
	<script>
		module.import('distributeList');
		
	</script>

</body>
</html>