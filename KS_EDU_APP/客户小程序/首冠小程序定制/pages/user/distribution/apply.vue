<template>
	<view class="top">
		<view v-if="progressStatus == 0">
			<view class="progress">
				<view class="progress-box">
					<view class="line"></view>
					<view class="progress-position" ></view>
					<view class="progress-position">
						<image class="progress-image"  :src="baseUrl+'/static/images/user/common_process_icon_on@2x.png?1.0'"></image>
					</view>

				</view>
				<view class="progress-text">
					<text class="progress-color">设置个人信息</text>
					<text>设置微店信息</text>
					<text>完成</text>
				</view>
			</view>
			<view class="main">
				<view class="item">
					<view class="title">小店名称</view>
					<input v-model="title" placeholder="例如：kesion微店" class="text" />
				</view>
				<view class="item">
					<view class="title">真实姓名</view>
					<input v-model="realname" placeholder="请输入真实姓名" class="text" />
				</view>
				<view class="item">
					<view class="title">手机号</view>
					<input v-model="phone" placeholder="请输入手机号" class="text" />
				</view>
			</view>
			<view class="btn">
				<button class="btn-colorn" v-if="phone&&realname&&title" @click="checkName()">下一步</button>
				<button class="btn-colors"  v-else>下一步</button>
			</view>
		</view>
		<view v-else-if="progressStatus==1">
			<view class="progress">
				<view class="progress-box">
					<view class="line">
						<view class="width-50" ></view>
					</view>

					<view class="position50" >
						<image  class="progress-image" :src="baseUrl+'/static/images/user/common_process_icon_on@2x.png?1.0'"></image>
						<image  class="progress-image" :src="baseUrl+'/static/images/user/common_process_icon_on@2x.png?1.0'"></image>
						<image  class="progress-image" src=""></image>
					</view>

				</view>
				<view class="progress-text">
					<text class="progress-color">设置个人信息</text>
					<text class="progress-color">设置微店信息</text>
					<text>完成</text>
				</view>
			</view>
			<view class="main">
				<view class="margintop30">
					<view class="title">小店LOGO</view>
					<view class="logo">
						<view class="addimg" @click="uploadImg()">
							<image class="logo-image" :src="baseUrl+'/static/images/user/add.png?1.0'"></image>
							<text>点击上传</text>
						</view>
						<image class="logo-url" :src="logoUrl" v-if="logoUrl"></image>
					</view>

				</view>
				<view class="item">
					<view class="title">小店简介</view>
					<input v-model="introduction" placeholder="请输入小店简介" class="text" />
				</view>
				<view class="item">
					<view class="title">佣金提现开户银行</view>
					<input v-model="bank" placeholder="开户银行" class="text" />
				</view>
				<view class="item">
					<view class="title">佣金提现银行卡号</view>
					<input v-model="cardId" placeholder="银行卡号" type="number" class="text" />
				</view>
				<view class="item">
					<view class="title">佣金提现支付宝账号</view>
					<input v-model="alipay" placeholder="支付宝账号" class="text" />
				</view>
				<view class="item">
					<view class="title">佣金提现微信支付账号</view>
					<input v-model="wechatpay" placeholder="微信支付账号" class="text" />
				</view>
			</view>
			<view class="btn">
				<button class="btn-colorn" v-if="wechatpay&&alipay&&bank&&introduction&&cardId&&logoUrl"  @click="submit()">下一步</button>
				<button class="btn-colors" v-else>下一步</button>
			</view>
		</view>
		<view v-else-if="progressStatus==2">
			<view class="progress">
				<view class="progress-box">
					<view class="line">
						<view class="position100" ></view>
					</view>
					<view  class="position50">
						<image  class="progress-image" :src="baseUrl+'/static/images/user/common_process_icon_on@2x.png?1.0'"></image>
						<image  class="progress-image" :src="baseUrl+'/static/images/user/common_process_icon_on@2x.png?1.0'"></image>
						<image  class="progress-image" :src="baseUrl+'/static/images/user/common_process_icon_on@2x.png?1.0'"></image>
					</view>
				</view>
				<view class="progress-text">
					<text class="progress-color">设置个人信息</text>
					<text class="progress-color">设置微店信息</text>
					<text>完成</text>
				</view>
			</view>
			<view class="main paddingtop30" >
				<view class="title">您好{{state.userInfo.UserName}},您的申请已成功提交！请记住以下信息：</view>
				<view class="box" >
					<image class="qrcode" :src="qrCode"></image>
					<view class="qrcode-text" >上面为店铺二维码可保存用于后续推广</view>
					<!-- 仅在微信小程序编译 -->
					<!-- #ifdef MP-WEIXIN -->
					<view class="qrcode-word"  @click="save()" v-if="isAuth">点击保存二维码</view>
					<button class="qrcode-btn"
					 open-type="openSetting" v-else>前往设置相册权限</button>
					<!-- #endif -->
					<!-- 仅在app编译 -->
					<!-- #ifdef APP-PLUS -->
					<view class="qrcode-word"  @click="save()">点击保存二维码</view>
					<!-- #endif -->
					<view class="margintop40">微店地址：<text class="color-mainly">{{url}}</text></view>
				</view>

			</view>
			<view class="btn">
				<button class="btn-colorn" @click="open()">返回个人中心</button>
			</view>
		</view>

	</view>
</template>

<script>
	import {ApplyIstitle,ApplyDistributor} from 'api/user'
	export default {
		data() {
			return {
				baseUrl: this.$store.state.SRC + '/config/app',
				phone: "",
				realname: '',
				title: "",
				progressStatus: 0,
				wechatpay: '',
				alipay: '',
				bank: '',
				introduction: '',
				cardId: '',
				logoUrl: '',
				qrCode: '',
				state: {},
				isAuth: false,
				url:''
			}
		},
		methods: {
			open(){
				uni.switchTab({
					url:'/pages/user/index'
				})
			},
			submit(){
				ApplyDistributor({
					title:this.title,
					logo:this.logoUrl,
					realname:this.realname,
					mobile:this.phone,
					intro:this.introduction,
					bankname:this.bank,
					bankcard:this.cardId,
					alipayno:this.alipay,
					weipayno:this.wechatpay
				}).then(res=>{
					if(res.result){
						this.progressStatus = 2
						this.qrCode = this.$store.state.SRC+res.QRcode
						this.url = res.url
					}else{
						uni.showToast({
							title:res.msg,
							icon:'none'
						})
					}
				})
				
			},
			checkName(){
				ApplyIstitle({
					title:this.title
				}).then(res=>{
					if(res.result){
						this.progressStatus=1
					}else{
						uni.showToast({
							title:res.msg,
							icon:'none'
						})
					}
				})
				
			},
			uploadImg() {
				uni.chooseImage({
					count: 1, //默认9
					sizeType: ['original', 'compressed'], //可以指定是原图还是压缩图，默认二者都有
					sourceType: ['album'], //从相册选择
					success: res => {
						uni.uploadFile({
							url:this.state.SRC+'/webapi/School/UploadFile',
							filePath:res.tempFilePaths[0],
							fileType:'image',
							name:'file',
							formData:{
								apptoken:this.state.appToken,
								userid:this.state.userId
							},
							success:resdata=>{
								let data = JSON.parse(resdata.data)
								if(data.result){
									this.logoUrl = this.state.SRC+data.fileUrl
								}else{
									this.$msg(data.msg)
								}
							}
						})
					}
				});
			},
			//#ifdef MP-WEIXIN
			save() {
				var that = this
				if (this.qrCode) {
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
		onLoad() {
			this.$store.ready(state => {
				this.state = state
			})
		}
	}
</script>

<style scoped>
	.color-mainly{
		color:#ff663d;
	}
	.paddingtop30{
		padding-top: 30px;
	}
	.margintop30{
		margin-top: 30px;
	}
	.margintop40{
		margin-top: 40px;
	}
	.top{
		font-size: 14px;background: #fff;min-height: 100vh;
	}
	.progress {
		padding: 10px 20px;
		box-shadow: 0px 2px 2px 0px rgba(26, 26, 26, 0.05);
		border-radius: 0px 0px 5px 5px;
	}
	.progress-image{
		width: 16px;
		height: 16px;
	}
	.progress-box {
		height: 16px;
		position: relative;
	}
	.progress-position{
		position: absolute;
	}
	.line {
		width: calc(100% - 16px);
		height: 3px;
		background: rgba(255, 102, 61, 0.2);

		border-radius: 1.5px;
		position: absolute;
		top: 6.5px;
		left: 8px;
	}

	.progress-text {
		margin-top: 5px;
		display: flex;
		justify-content: space-between;
		color: #888888;
	}
	.progress-color{
		color: #1A1A1A;
	}
	.progress-text text {
		width: 84px;
		text-align: right;
	}
	.width-50{
		width: 50%;height: 100%;background: rgba(255,102,61,1);z-index: 99;
	}
	.position50{
		position: absolute;width:100%;display: flex;justify-content: space-between;
	} 
	.position100{
		width: 100%;height: 100%;background: rgba(255,102,61,1);z-index: 99;
	}
	.main {
		padding: 0 20px 70px 20px;
	}

	.item {
		padding: 30px 0 15px 0;
		line-height: 1;
		border-bottom: 1px solid #D9D9D9;
	}

	.title {
		font-size: 16px;
		font-weight: 500;
		color: rgba(26, 26, 26, 1);
	}
	.box{
		text-align: center;
	}
	.logo{
		display: flex;margin-top: 20px;
	}
	.logo-image{
		width: 20px;height: 20px;margin-top: 20px;
	}
	.logo-url{
		width: 80px;height: 80px;
	}
	.text {
		margin-top: 20px;
		font-size: 14px;
		font-weight: 400;
		color: rgba(178, 178, 178, 1);

	}

	.btn {
		width: calc(100% - 20px);
		position: fixed;
		bottom: 0;
		left: 0;
		padding: 5px 10px;
		background: #fff;
		z-index: 99;
	}
	.btn-colorn{
		background:#ff663d;color:#fff;
	}
	.btn-colors{
		background:#B2B2B2;color:#fff;
	}
	button::after {
		border: 1px solid rgba(255, 255, 255, 1);
	}

	.addimg {
		width: 78px;
		height: 78px;
		background: rgba(250, 250, 250, 1);
		border: 1px solid rgba(217, 217, 217, 1);
		margin-right: 20px;
		display: flex;
		flex-direction: column;
		align-items: center;
	}

	.addimg text {
		font-size: 14px;
		color: rgba(102, 102, 102, 1);
		margin-top: 10px;
	}

	.qrcode {
		width: 200px;
		height: 200px;
		margin-top: 30px;
	}
	.qrcode-text{
		width: 128px;font-size:14px;color:rgba(178,178,178,1);line-height:24px;margin: 15px auto;
	}
	.qrcode-word{
		text-decoration:underline;color:#ff663d;margin-top: 5px;
	}
	.qrcode-btn{
		text-decoration:underline;color:#ff663d;margin-top: 5px;background: #fff;width: 112px;padding: 0;font-size: 14px;
	}
</style>
