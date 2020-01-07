<template>
	<view class="share-box" :style="{background: `url(${src}/Config/APP/static/assets/user/me_friend_bg.png)`,backgroundSize: 'cover'}">
		<image mode="aspectFill" style="width:100%;height: 88px;" :src="`${src}/Config/APP/static/assets/user/me_friend_title.png`"></image>
		<view style="text-align: center;color: rgb(255, 178, 60);font-size: 16px;">
			<view>每邀请一个新用户注册</view>
			<view style="margin: 5px 0 10px 0;">你可得资金{{userInfo.TMoney}}元，积分{{userInfo.TScore}}分，点券{{userInfo.TPoint}}点</view>
		</view>
		<canvas :style="{width: `${canvasWidth}px`, height: '400px',margin: '0 auto'}" canvas-id="myCanvas" ></canvas>
		<!-- 仅在微信小程序编译 -->
		<!-- #ifdef MP-WEIXIN -->
	    <button class="login-btn" @click="save()" v-if="isAuth">保存图片至相册</button>
		<button class="login-btn" open-type="openSetting" v-else>前往设置相册权限</button>
		<!-- #endif -->
		<!-- 仅在app编译 -->
		<!-- #ifdef APP-PLUS -->
		 <button class="login-btn" @click="save()">保存图片至相册</button>
		<!-- #endif -->
	    <view class="login-text">
	      <text>1、</text>
	      保存图片分享给好友
	    </view>
	    <view class="login-text">
	      <text>2、</text>
	      朋友扫码加入注册，即可领取奖励
	    </view>
	</view>
</template>

<script>
	
	export default {
		data() {
			return {
				show:true,
				url:'',
				src:'',
				userInfo:{},
				canvasWidth:0,
				tempFilePath:'',
				isAuth:true,
				first:true
			}
		},
		//#ifdef MP-WEIXIN
		onShow() {
			var that = this
			uni.getSetting({
			   success(res) {
			    that.isAuth = res.authSetting['scope.writePhotosAlbum']?true:false
				 if(!that.isAuth){
					 uni.authorize({
					 	    scope: 'scope.writePhotosAlbum',
					 	    success() {
					 	       
					 	    }
					 })
				 }
			   }
			})
		},
		//#endif
		onLoad(query) {
			var that = this
			this.$store.ready(state=>{
				this.src = state.SRC
				this.userInfo = state.userInfo
				uni.getSystemInfo({
				    success: function (res) {
						that.canvasWidth = res.screenWidth - 40
						that.$nextTick(function(){
							var ctx = uni.createCanvasContext('myCanvas')
									uni.downloadFile({
									  url: state.SRC+'/Config/APP/static/assets/user/me_friend_picbg.png',
									  success: function (res) {
									    ctx.drawImage(res.tempFilePath,0, 0,that.canvasWidth,400)
										ctx.draw(true,function(){
											ctx.setFontSize(18)
											ctx.setFillStyle('#273035')
											ctx.setTextAlign('left');
											ctx.fillText(state.userInfo.UserName, 100, 50)								
											ctx.setFontSize(14)
											ctx.setTextAlign('left');
											ctx.setFillStyle('#273035')
											ctx.fillText("邀请你一起来学习", 100, 70);
											ctx.setTextAlign('center');
											ctx.setFontSize(18)
											ctx.setFillStyle('#273035')
											ctx.fillText(state.userInfo.WebsiteName, that.canvasWidth/2, 120);
											ctx.setFillStyle("#787c72");
											ctx.setTextAlign('center');
											ctx.setFontSize(16)
											ctx.fillText("为你提供最专业的学习提升", that.canvasWidth/2, 150);
											ctx.setFillStyle("#bbbbbb");
											ctx.setTextAlign('center');
											ctx.setFontSize(14)	
											ctx.fillText("扫描图片识别二维码进入学习", that.canvasWidth/2, 370);
											ctx.draw(true,function(){
												uni.downloadFile({
												  url: state.userInfo.QRcode,
												  success: function (res) {			
												    ctx.drawImage(res.tempFilePath,that.canvasWidth/2-48,181, 94, 94)
													ctx.draw(true,function(){
														
														uni.downloadFile({
														  url: state.userInfo.UserFace,
														  success: function (res) {	
															
														    ctx.drawImage(res.tempFilePath,25, 25, 60, 60)
															ctx.draw(true,function(){
																uni.downloadFile({
																  url: state.SRC+'/Config/APP/static/assets/user/userface_bg.png',
																  complete: function (res) {
																	 
																   ctx.drawImage(res.tempFilePath, 25, 25, 60, 60);
																   ctx.draw(true,function(){
																	   uni.canvasToTempFilePath({
																	   	x: 0,
																	   	y: 0,
																	   	width: that.canvasWidth,
																	   	height: 400,
																	     destWidth: that.canvasWidth,
																	     destHeight: 400,
																	     canvasId: 'myCanvas',
																	     success: function(res) {
																			console.log(999)
																	       // 在H5平台下，tempFilePath 为 base64
																			that.tempFilePath = res.tempFilePath
																	     } 
																	   })
																   })
																  }
																});	
															})
														  }
														});
													})
												  }
												});
											})
											
										})
										
									  }
									});
									
						})
				        
				    }
				});
				
				
			})
			
		},
		methods: {
			//#ifdef MP-WEIXIN
			save(){
				var that = this
					if(this.tempFilePath){
						uni.getSetting({
						   success(res) {
						      console.log(res.authSetting)
							  if(res.authSetting['scope.writePhotosAlbum']){
							  	that.isAuth = true
							  	uni.saveImageToPhotosAlbum({
							  	      filePath: that.tempFilePath,
							  	      success: function () {
							  			uni.showToast({
							  				title: '保存成功'
							  			})
							  	      }
							  		 
							  	    });  								
							  								  
							  }else{
							  	that.isAuth = false
							  							  
							  }
						   }
						})	
					}	
			}
			//#endif
			//#ifdef APP-PLUS
			save(){
				var that = this
				console.log(this.tempFilePath)
					if(this.tempFilePath){
							uni.saveImageToPhotosAlbum({
							      filePath: that.tempFilePath,
							      success: function () {
									uni.showToast({
										title: '保存成功'
									})
							      }
							    });	
					}	
			}
			//#endif
		}
	}
</script>

<style scoped>
	.share-box{
		width: 100%;
		min-height: 100vh;
		padding-bottom: 20px;
	}
	.login-btn {
	    margin: 20px 40px;

	    height: 40px;
	    border-radius: 20px;
	    background: rgb(235, 118, 80);
	    line-height: 40px;
	    color: #fff;
	    text-align: center;
	    font-size: 16px;
	}
	.login-text {
	  color: #fff;
	  line-height: 24px;
	  text-align: left;
	  margin-left: 20px;
	  font-size: 12px;
	}

	

</style>
