<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="renderer" content="webkit"> 
    	<title>我的订购</title>
    <link href="<?php echo UOOT ?>Public/common/drag/css/reset.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/wechat/css/home.css" rel="stylesheet">
   	<link href="<?php echo UOOT ?>Public/wechat/css/signin.css" rel="stylesheet">
	<link href="<?php echo UOOT ?>Public/wechat/css/mycourse.css?<?php echoHash(); ?>" rel="stylesheet" />
    <link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
	
    <script>var uoot = '<?php echo UOOT ?>'; </script> 	
</head> 


<body class="myCouse-wrap"style="background: #37a7ed0a;">
	
<div id="myCouse-page"  v-cloak>
		<div class="myCouse-page" >
			<!-- <div class="sign-screen " @click="toggele()">
				全部
			</div> -->
			<!-- <div class="sign-top">
				<div class="search-seaBox2 ">
					<form action="" onsubmit="signin.toDay.search()">
					<input type="search" value="" id="todayinput" placeholder="请输入您要搜索的内容"> 
					<i class="ion-search" onclick="signin.toDay.search()"></i> 
					</form>
				</div> -->
			
		</div>
		<div class="mychoice" v-show='isShow'>
			<ul>
				<li v-for="(item, index) in cate" :key="index" @click="options(index)">
					{{item.name}}
				</li>
			</ul>
		</div>

		<div class="reserve-box">
			<template v-if="campusArr.length>0">
				<div class="reserve-list" v-for="(item, index) in campusArr" :key="index" @click="urlClick(item.url)">
				
					<div class="reserve-img">
					
					<img :src="item.defaultpic"/>
						<span v-if='item.type==0 && item.ctype==4'>
							图文
						</span>
						<span v-if='item.type==0 && item.ctype==3'>
							音频
						</span>
						<span v-if='item.type==0 && item.ctype==2'>
							直播
						</span>
						<span v-if='item.type==0 && item.ctype==1'>
							点播
						</span>
						<span v-if='item.type==1'>互动</span>
						<span v-if='item.type==5'>考试</span>

					</div>
					<div class="reserve-txt">
						<div class="reserve-title">{{item.title}}</div>
						<div class="reserve-link" style="height: 2.3rem;text-overflow:ellipsis;overflow: hidden;">简介：{{item.shortdesc}}</div>
					</div>
						
				</div>
			</template>

			<template v-else>
				<div class="nodata"></div>
			</template>
			
		</div>
		</div>	 
	</div>
	<script src="<?php echo UOOT ?>Public/common/js/currency/gate.js" type="text/javascript"></script>
	<script src="<?php echo UOOT ?>Public/common/js/MicroPortal.js" type="text/javascript"></script>
	<script type="text/javascript">
			module.add('myCouse-page',{
			el:'#myCouse-page',
			data:{			
				cate:[
					{name:"全部",type:"全部"},
					{name:"图文",type:"图文"},
					{name:"音频",type:"音频"},
					{name:"直播",type:"直播"},
					{name:"互动",type:"互动"},
					{name:"试卷",type:"试卷"}
				],
				campusArr:[],
		 		jsonUrl:uoot + 'Json/index.php', 	
		 		maxPerpage:10,
				type:0,
		 		p:1,
		 		del:0,
		 		content:'',
				userid:'',
				isShow:false,
		 		
			},
			created:function(){
		 		var that = this;
		   		that.getdata() 
		   		$_monitor.scroll.bottom(window,function(){
					that.getdata()
				})
		 		
		 	},
			methods:{
				options:function(index){
					this.type = index;
					this.getdata()
				},
				getdata:function(){
					var that = this;
					var newData = {}
					newData.maxPerpage = that.maxPerpage;
					newData.p = that.p;
					newData.type = this.type;
			 			$post(that.jsonUrl+'?act=Microportal.getclass&wxcode=1',newData,function(res){
							console.log(res)
			 				that.campusArr = res.getclass.values;
			 			
			 			},'json')	
					 },
					toggele:function(){
						this.isShow = !this.isShow;
					},
					urlClick:function(url){
						window.location.href = url
					}
 		},

		
			
		})
		




	module.import('myCouse-page')
	</script>
</body>
</html>