<template>
	<view class="main" :style="'background: url('+baseUrl+'/static/images/my/recommend_bg.png);background-size: 100% 100%;'">
		<image class="title-image" mode="aspectFit" :src="baseUrl+'/static/images/my/recommend_title.png'"></image>
		<view class="qrcode">
			<image class="qrcode-image" :src="qrCode"></image>
			<view class="text">点击下方保存按钮保存二维码到本地</view>
			<view class="margintop15">也可以点击复制按钮，复制店铺地址：</view>
			<view class="color-mainly">{{url}}</view>
		</view>
		<view class="btn">
			<!-- 仅在微信小程序编译 -->
			<!-- #ifdef MP-WEIXIN -->
			<view class="item" @click="save()">
				<image class="item-image" :src="baseUrl+'/static/images/my/recommend_btn_save.png'"></image>
				<view v-if="isAuth">点击保存二维码</view>
				<button class="item-btn" open-type="openSetting" v-else>前往设置相册权限</button>
			</view>
			<!-- #endif -->
			<!-- 仅在app编译 -->
			<!-- #ifdef APP-PLUS -->
			<view class="item" @click="save()">
				<image class="item-image" :src="baseUrl+'/static/images/my/recommend_btn_save.png'"></image>
				<view>点击保存二维码</view>
			</view>
			<!-- #endif -->


			<view class="item" @click="copy()">
				<image class="item-image" :src="baseUrl+'/static/images/my/recommend_btn_copy.png'"></image>
				<view>复制店铺地址</view>
			</view>
		</view>
	</view>
</template>

<script>
	import {ApplyQRcode} from 'api/user'
	export default {
		data() {
			return {
				baseUrl: this.$store.state.SRC + "/config/app",
				isAuth: false,
				qrCode: '',
				url:''
			}
		},
		onLoad() {
			ApplyQRcode().then(res=>{
				if(res.result){
					this.qrCode = this.$store.state.SRC+res.QRcode
					this.url = res.url
				}
			})
		},
		methods: {
			
			copy(){
				if(this.url){
					uni.setClipboardData({
					    data: this.url,
					    success: ()=> {
							uni.showToast({
								title:'复制成功',
								icon:"none"
							})
					    }
					});
				}
				
			},
			//#ifdef MP-WEIXIN
			save() {
				var that = this
				if (this.qrCode&&this.isAuth) {
					uni.getSetting({
						success(res) {

							if (res.authSetting['scope.writePhotosAlbum']) {
								that.isAuth = true

								uni.getImageInfo({
									src: that.qrCode,
									success: function(image) {

										uni.saveImageToPhotosAlbum({
											filePath: image.path,
											success: function() {

												uni.showToast({
													title: '保存成功'
												})
											}

										});
									}
								});

							} else {
								that.isAuth = false

							}
						}
					})
				}
			}
			//#endif
			//#ifdef APP-PLUS
			save() {
				var that = this
				if (this.qrCode) {
					uni.getImageInfo({
						src: that.qrCode,
						success: function(image) {

							uni.saveImageToPhotosAlbum({
								filePath: image.path,
								success: function() {

									uni.showToast({
										title: '保存成功'
									})
								}

							});
						}
					});
				}
			}
			//#endif
			

		},
		//#ifdef MP-WEIXIN
		onShow() {
			var that = this
			uni.getSetting({
				success(res) {
					that.isAuth = res.authSetting['scope.writePhotosAlbum'] ? true : false
					if (!that.isAuth) {
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
	}
</script>

<style scoped>
	.margintop15{
		margin-top: 15px;
	}
	.color-mainly{
		color: #ff663d;
	}
	.main {
		width: 100%;
		min-height: 100vh;
		text-align: center;
	}

	.title-image {
		height: 40px;
		width: 235px;
		margin-top: 40px;
	}

	.qrcode {
		margin: 40px 20px 30px 20px;
		padding: 30px 20px;
		background: rgba(255, 255, 255, 1);
		border-radius: 18px;
		line-height: 21px;
		font-size: 14px;
		color: #666;
	}

	.qrcode-image {
		width: 175px;
		height: 175px;
	}

	.text {
		margin-top: 15px;
	}

	.btn {
		display: flex;
		font-size: 14px;
		color: rgba(255, 255, 255, 1);
		justify-content: space-between;
		margin: 0 20px;
		padding-bottom: 30px;
	}
	.item-btn{
		 width: 112px;padding: 0;font-size: 14px;
		 color:#fff;
	}
	.item-image {
		width: 30px;
		height: 30px;
		margin-bottom: 5px;
	}
</style>
