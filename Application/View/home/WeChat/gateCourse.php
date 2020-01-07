<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="renderer" content="webkit"> 
    <title><?php echo $this->websiteInfo['wititle'];?></title>
    <link href="<?php echo UOOT ?>Public/common/drag/css/reset.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/wechat/css/home.css" rel="stylesheet">
    <link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
    <link href="<?php echo UOOT ?>Public/wechat/css/intention.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/wechat/css/graphic.css?<?php echo time();?>" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo UOOT ?>Public/wechat/css/campus.css"/>
    <script>
		var uoot = '<?php echo UOOT ?>';
		var addgraphic ='<?php echo M_URL('WeChat','addgraphic')?>'	;
		var editaudioLive='<?php echo M_URL('WeChat','editaudioLive')?>';
		var audioAdd ='<?php echo M_URL('WeChat','audioAdd')?>';
		var addbounch ='<?php echo M_URL('WeChat','addbounch')?>';
		var addclass='<?php echo M_URL('WeChat','addclass')?>';
		var gateeditclass = '<?php echo M_URL('WeChat','gateeditclass')?>';
		var reword ='<?php echo M_URL('WeChat','reword');?>';
		var moblie  = '<?php echo $moblie;?>';
		
		
    </script> 	
    <style type="text/css">
    	body{
			padding-top:0.5rem;
			
    	}
		.graphic-type {
			font-size:0.65rem;
			color: #bbb
		}
		.img-wrap {
			background-size: 100% 100%;
		}
    </style>
</head>
	<body style="padding-top:0.5rem">
    	<div id="collection" class="wrap" v-cloak>
    		<template v-if="courseArr.length>0">
	    		<div class="graphic-item" v-for="(item,index) of courseArr" :key="item.courseid" >

					
	    			<div class="graphic-item-t" @click="turnon(item.homeurl)">
	    				<div class="img-wrap" :style="{backgroundImage:'url('+item.defaultpic+')'}">
	    					<!--<img :src="item.defaultpic" alt="" />-->
	    				</div>
	    				<div class="info">
							<div class="title" v-if='courseType==6'>{{item.Title}}</div>
							<div class="title" v-else>{{item.title}}</div>
							<div class="graphic-type"  v-if="courseType!=5||courseType!=6">
								<div  v-if="item.coursehour==0">单课程</div>
								<div  v-else-if="item.coursehour==1">连载课程</div>
							</div>
							
	    					<div class="price-wrap">
	    						<div class="price-type active " v-if="backstatus(item)==2">已上架</div>
	    						<div class="price-type" v-if="backstatus(item)==0">已下架</div>
	    						<div class="price" v-if="item.chargetype==0">免费</div>
	    						<div class="price" v-else-if="item.chargetype==1">{{item.price}}</div>
	    						<div class="price" v-else-if="item.chargetype==2">打赏</div>
	    					</div>
						</div>
						
					</div>
					<div class="graphic-item-b">
						<div class="price item">{{item.studentcount}}人购买</div>
						<div class="edit-box item" v-if="courseType==5">
							<button class="edit-btn"   @click="operatebtn(item.classid,index,backstatus(item))">操作</button>
						</div>
						<div class="edit-box item" v-else-if="courseType==6">
							<button class="edit-btn"   @click="operatebtn(item.paperid,index,backstatus(item))">操作</button>
						</div>	
						<div class="edit-box item" v-else>
							<button class="edit-btn"   @click="operatebtn(item.courseid,index,backstatus(item),item.homeurl)">操作</button>
						</div>			
	
					</div>	

				</div>		

    		</template>
			<template v-else> <div class="nodata">暂无数据</div> </template>
		
			
			<!--全局确认框-->
			<div class="masked" v-if="operateFlag" @click="operateFlag=false"></div>
			<div class="masked" v-show="shareFlag" @click="shareFlag=false"></div>

				
			<!--操作层-->
				<div class="operate"  v-if="operateFlag">
					<ul>
						<li  v-if='courseType==2' @click="turnon(homeurl)">去上课</li>
					
						<li v-if="courseType!=6" @click="open()">编辑</li>
					
						<li @click="share()" >分享</li>
					
						<li  @click="shelf(-1)" v-if="operateFlag" >删除</li>
						<li v-if='courseType==2 && livetype==1'  @click="open2()">打赏收益</li>
						<li v-if="status==0" @click="shelf(2)">上架</li>
						<li v-else-if="status==2" @click="shelf(0)">下架</li>

					

					</ul>
				</div>
			<!--操作层-->	
			<div class="confirm cen-" v-show="shareFlag" >
				<div class="confirm-header">分享设置</div>
				<div class="share-content">
					<div class="title2">分享标题</div>
					<input type="text" class="input" v-model="shareInfo.sharetitle"/>
					<div class="title2">分享封面</div>
					<div class="cover-wrap">
						<div class="img-wrap" :style="{backgroundImage:'url('+shareInfo.sharepic+')'}">
						<!--	<img :src="shareInfo.sharepic" alt="" />-->
						</div>
						<div class="info">
							<div class="tips">图片要求300*300以上,方形像素</div> 
							<label class="btn" for="file">修改封面</label>
							<input type="file" id="file" @change="inchangeCover" style="display: none;"/>
						</div>
					</div>
					<div class="title2">分享说明</div>
					<textarea class="explain" v-model="shareInfo.shareintr"></textarea>
				</div>
				<div class="confirm-btn-wrap">
					<div class="btn cancel" @click="shareCancel">取消</div>
					<div class="btn sur" @click="shareSure">确定</div>
				</div>
			</div>
			
			<div class="masked" v-show="confirmFlag" @click="confirmFlag=false"></div>
			<div class="confirm" v-show="confirmFlag">
				<div class="confirm-header">提示</div>
				<div class="confirm-content">
					确定执行此操作
				</div>
				<div class="confirm-btn-wrap">
					<div class="btn cancel" @click="cancel">取消</div>
					<div class="btn sur" @click="sure">确定</div>
				</div>
			</div>
		<!-- 全局提示框 -->
		    <div v-show="visible" class="dialog-tips dialog-center">
		          <div>{{message}}</div>
		    </div>
    	
		   <!--添加知识点-->
			
			<div class="add"  v-if='(courseType==3 && moblie=="iPhone") || courseType==6' @click="openLink(1)" >
					<img src="<?php echo UOOT ?>Public/wechat/images/add.png">
			</div>
		   	  <!--添加知识点-->
				 <div class="add"  v-else  @click="openadd()" >
				<img src="<?php echo UOOT ?>Public/wechat/images/add.png">
		  </div>
		  

		 <!--提示内容-->
		 <div class="mask" v-if="del==1" style="display: block;"></div>

			<div class="confirm" id="confirm" v-if="del==1" style="display: block;" >
				<div class="title">
										
						添加{{msg}}商品需用电脑登录科汛V名师管理后台（store.kesion.com）进行操作。
						<a :href="tzurl">如何创建商品</a>

				</div>										
				<div class="item-b">
					<div class="item-inner" @click="openLink(0)">知道了</div>
					
				</div>
			</div>
		</div>   
		
	</body>
   <script src="https://res.wx.qq.com/open/js/jweixin-1.2.0.js"></script>
    <script src="<?php echo UOOT ?>Public/wechat/js/share.js" type="text/javascript"></script>
	<script src="<?php echo UOOT ?>Public/common/js/currency/gate.js" type="text/javascript"></script>
	<script type="text/javascript">
		module.add('collection',{
	el:'#collection',
 	data:{
 		p:1,
 		maxperpage:5,
 		courseArr:[],
 		jsonUrl:uoot + 'Json/index.php',
 		noData:false,
 		search:'',
 		visible:false,
 		message:'',
 		confirmFlag:false,
 		id:-1,
 		index:-1,
		type:0,
		livetype:-1,// 视频直播&语音直播
		palyer:-1,//dian
 		loadFlag:false,//加载状态
 		loadMoreFlag:true,//加载开关
		 shareFlag:false,
		 operateFlag:false,
 		shareId:-1,
 		shareIndex:-1,
 		shareInfo:{},
 		shelfed:-1,
 		shelfIndex:-1,
 		shelfId:-1,
 		courseType:-1,
 		del:0,
 		msg:'',
		tzurl:'',
		livetype:-1,
		courseid:-1,
		status:-1,
		otherid:-1,
		homeurl:'',
		moblie:moblie
 	},
 	created:function(){
		var that = this; 
		this.courseType = getParam('coursetype');
		this.livetype = getParam('livetype')
		console.log(this.moblie)
   		that.getdata() 
   		$_monitor.scroll.bottom(window,function(){
			that.getdata()
		})
   		
	 },
 	methods:{
		backtitle:function(item){
			if(this.courseType==6){
				return item.Title
			}else{
				return item.title
			}
		},
		backstatus:function(item){
			if(this.courseType==6){
				return item.Status
			}else{
				return item.status
			}
		},
 		open:function(){ //编辑
 			var courseid = this.otherid;
			 var __url = (this.courseType == 4 && addgraphic+'?id='+courseid ) || (this.courseType == 2 && editaudioLive +'?id='+courseid )||(this.courseType == 3 &&  audioAdd+'?id='+courseid+'&courseType='+ this.courseType )|| (this.courseType == 1 && audioAdd+'?id='+courseid+'&courseType='+ this.courseType )|| (this.courseType == 5 && gateeditclass+'?id='+courseid )
			 location.href = __url;
		 },
		 open2:function(){ //打赏
 			var courseid = this.otherid;
			 var __url = ( reword+'?id='+courseid )
			 location.href = __url;
		 },
		 openadd:function(live){ //添加
		 	  
		 
			var __url = (this.courseType == 1 && audioAdd+'?courseType='+ this.courseType) || ( this.courseType == 4 && addgraphic) || (this.courseType == 2 && editaudioLive+'?livetype='+ this.livetype )||(this.courseType == 3 && audioAdd+'?courseType='+ this.courseType )||(this.courseType == 5 && addclass )
			 location.href = __url;
			
			
		 },
		turnon:function(__url){   //内容页链接
			//console.log(__url)
			location.href = __url;
			
		},
		operatebtn:function(id,undex,status,homeurl){
			//homeurl = ''
			this.otherid = id;
			this.index = undex;
			this.status = status;
			this.homeurl = homeurl;
			this.operateFlag= !this.operateFlag
		
		},
 		getdata:function(){
 			if(this.loadMoreFlag){
 				 this.loadFlag = true;
				 var that = this;
				 var number =this.courseType;
	 			 var newData = {};
	 			 newData.p = this.p;
	 			 newData.maxperpage = this.maxperpage;
	 			 newData.name = this.search;
				 newData.type = this.type;
				console.log(newData.type)
				 newData.courseType = this.courseType;				
				var isurl  = 'courselist';			
			    if(number==2){
					newData.livetype = getParam('livetype')	
				}else if(number==5){
					newData.type = 1;
					isurl='allList'	
				}else if(number==6){
					isurl='paperList'	
				}else if(number==4){
					isurl = 'ImagesText'
				}


			
	 			$post(this.jsonUrl+'?act=Microportal.'+isurl,newData,function(res){
					console.log(res)
					var dataed;
					var _number = Number(number)
					switch(_number){
						case 1:
						dataed = res.courselist
						break;
						case 2:
						dataed = res.courselist
						break;
						case 3:						
						dataed = res.courselist
						break;
						case 4:
						dataed = res.ImagesText
						break;
						case 5:
						dataed = res.allList	
						break;
						case 6:
						dataed = res.paperList
						break;
						
						default:

					}

	 				that.loadFlag = false;
	 				//如果没有数据的话
	 				if(dataed.page.total_pages==0){
	 					that.loadMoreFlag = false;
	 					return false
	 				}
	 				var datas = dataed.list;
	 				var datalength = datas.length; 
	 				
	 				for(var i=0;i<datalength;i++){
	 					that.courseArr.push(datas[i])
	 				}
	 				that.p++;
	 				if(datas<that.maxperpage || datas==0){
	 					that.loadMoreFlag = false;
	 					return false
	 				}
	 				
	 				console.log(that.courseArr)
	 			},'json')	
 			}
 		},
 		share:function(id,index){
			this.operateFlag = !this.operateFlag 
 			this.shareFlag = true;
 			this.index = index;
 			this.id = this.otherid;
 			var newData = {};
 			newData.id = this.otherid;
			 var that = this;
			 var shareUrl = '?act=Microportal.imgtxtInfo';
			 if (this.courseType == 4) {
				shareUrl='?act=Microportal.imgtxtInfo'
			 }else if (this.courseType == 5) {
				shareUrl='?act=Microportal.shareClassInfo'
			 }else if (this.courseType == 6){
				shareUrl='?act=Microportal.paperInfo'
			 }
   			$post(this.jsonUrl+shareUrl,newData,function(res){
				 
				var  shareDate = res.imgtxtInfo;
				if(that.courseType == 4) {
					shareDate = res.imgtxtInfo
				}else if(that.courseType == 5) {
					shareDate =res.shareClassInfo
				}else if (that.courseType == 6){
					shareDate =res.paperInfo
				}
   				that.shareInfo = shareDate.msg;
   				
   			},'json')
 		},
 		shareSure:function(){
			 var that = this;
			 var sureUrl ='?act=Microportal.sureImg';
			 if (this.courseType == 5) {
				sureUrl ='?act=Microportal.saveClassShare';
			 }else if (this.courseType == 6){
				sureUrl ='?act=Microportal.paperInfo';
			 }
 			// shareType 1为图文 2为音频 3为点播 4为直播 5班级6试卷
 			this.shareInfo.shareType = this.courseType;
 			this.shareInfo.thisUrl = location.href;
 			$post(this.jsonUrl+sureUrl,this.shareInfo,function(res){
   				
   				if(res.sureImg.errCode==10000){
					
   					that.shareFlag = false;
					var dataed = {};
					var sureDate =res.sureImg;
					if (this.courseType == 5) {
						sureDate =res.saveClassShare;
					}else if (this.courseType == 6){
						sureDate =res.paperInfo;
					}
   					dataed.appId = sureDate.signPackage.appId;
   					dataed.nonceStr = sureDate.signPackage.nonceStr;
   					dataed.signature = sureDate.signPackage.signature;
   					dataed.timestamp = sureDate.signPackage.timestamp;
   					dataed.basicinfo = that.shareInfo;
   					dataed.url =sureDate.link;
   					onshare(dataed)
   					that.visible = true;
						that.message = '设置分享成功,请通过右上角分享';
						setTimeout(function(){
							that.visible = false;
						},1500)
   				}else{
   					alert('修改失败')
   				}
   			},'json')
 		},
 		shareCancel:function(){
 			this.shareFlag = false;
 		},
 		//改变封面主函数
 		inchangeCover:function(e){
 			 var files = e.target.files || e.dataTransfer.files;
			  if (!files.length)
			   return;
			   this.createImage(files[0]);
			console.log(1)
 		},
 		//预览图片
 		createImage:function(file){
 			var image = new Image();
			var reader = new FileReader();
			var that = this
			reader.readAsDataURL(file)
			reader.onloadend = function (e) {
          		that.shareInfo.sharepic = e.target.result;
        	}
			
 		},
 		//触发confirm函数
 		shelf:function(shelfFlag){
			this.operateFlag = !this.operateFlag
 			this.confirmFlag = true;
 			this.shelfIndex = this.index;
 			this.shelfId= this.otherid;
			 this.shelfed = shelfFlag;
			 
 		},
 		//confirm确认事件
 		sure:function(){
			this.onShelf()
 		},
 		//confirm取消事件
 		cancel:function(){
 			this.confirmFlag = false;
 		}, 
 		//添加知识点
		openLink:function(i){
			if(this.courseType==1){
				this.msg = '点播';
				this.tzurl = 'https://store.kesion.com/home/help#anchor106';
			}else if(this.courseType==2){
				this.msg = '直播';
				this.tzurl = 'https://store.kesion.com/home/help#anchor107';
			}else if(this.courseType==3){
				this.msg = '音频';
				this.tzurl = 'https://store.kesion.com/home/help#anchor105';
			}
			else if(this.courseType==6){
				this.msg = '试卷';
				this.tzurl = '';
			}
 			this.del=i;
 		}, 		
 		//上下架事件
 		onShelf:function(){
 			this.confirmFlag = false;
 			var newData = {};
 			newData.id = this.shelfId;
 			var that = this;
 			// if(this.shelfed==2){
 				newData.status=this.shelfed;
				 var onShelfUrl = '?act=Microportal.changeCourse'
				 if (this.courseType == 6) {
					onShelfUrl ='?act=Microportal.changePaper'
				 }else if(this.courseType == 5) {
					onShelfUrl ='?act=Microportal.changeclass'
				 }
 				$post(this.jsonUrl+ onShelfUrl,newData,function(res){
 					console.log(res)
					 var onShelfValue = res.changeCourse;
					 if(that.courseType == 6) {
						onShelfValue = res.changePaper
					 }else if(that.courseType == 5) {
						onShelfValue = res.changeclass
					 }
	 				if(onShelfValue){
	 					that.visible = true;
	 					if(that.shelfed==2){
                           that.message = '上架成功';
						  //更新数组
						   Vue.set(that.courseArr[that.shelfIndex],'status',2)
	 					}else if(that.shelfed==0){
                            that.message = '下架成功';
						    //更新数组
						    Vue.set(that.courseArr[that.shelfIndex],'status',0)
	 					}else if(that.shelfed== -1){
                              that.message = '删除成功';
							  //更新数组
							  that.courseArr.splice(that.shelfIndex,1)
	 					}
						setTimeout(function(){
							that.visible = false;
						},1500)
	 				}else{
	 					that.visible = true;
	 					if(that.shelfed==2){
		 					that.message = '上架失败';
		 				}else if(that.shelfed==0){
                            that.message = '下架失败';
		 				}else if(that.shelfed== -1){
                            that.message = '删除失败';
		 				}
	 					setTimeout(function(){
	 						that.visible = false;
	 					},1500)
	 				}
	 			},'json')	
 			
 		}
 	},
 	
})

		module.import('collection')
	</script>
</html>