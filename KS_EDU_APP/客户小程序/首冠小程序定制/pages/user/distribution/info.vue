<template>
	<view class="main">
		<view>
			<view class="title">小店LOGO</view>
			<view class="margintop20">
				<view class="addimg" @click="uploadImg()">
					<image mode="aspectFit" :src="logo"></image>
					<text>点击修改</text>
				</view>
			</view>
		</view>
		<view class="item">
			<view class="title">店铺名称</view>
			<input v-model="name" placeholder="输入店铺名称" class="text" />
		</view>
		<view class="item">
			<view class="title">店铺简介</view>
			<input v-model="intro" placeholder="输入店铺简介" class="text" />
		</view>
		<view class="btn">
			<button class="btn-buttons" v-if="name&&intro&&logo" @click="save()">保存设置</button>
			<button class="btn-buttonn" v-else>保存设置</button>
		</view>
	</view>
</template>

<script>
	import {
		ApplyShop,
		ApplyUpdateShop
	} from 'api/user'
	export default {
		data() {
			return {
				name: '',
				intro: '',
				logo: '',
				state: {}
			}
		},
		methods: {
			save(){
				ApplyUpdateShop({
					logo:this.logo,
					title:this.name,
					intro:this.intro
				}).then(res=>{
					if(res.result){
						uni.showToast({
							title:'保存成功'
						})
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
							url: this.state.SRC + '/webapi/School/UploadFile',
							filePath: res.tempFilePaths[0],
							fileType: 'image',
							name: 'file',
							formData: {
								apptoken: this.state.appToken,
								userid: this.state.userId
							},
							success: resdata => {
								let data = JSON.parse(resdata.data)
								if (data.result) {
									this.logo = this.state.SRC + data.fileUrl
								} else {
									this.$msg(data.msg)
								}
							}
						})
					}
				});
			}
		},

		onLoad() {
			this.$store.ready(state => {
				this.state = state
				ApplyShop().then(res => {
					if (res.result) {
						this.name = res.Title
						this.intro = res.Intro
						this.logo = res.Logo
					}
				})
			})

		}
	}
</script>

<style scoped>
	.main {
		background: #fff;
		min-height: 100vh;
		padding: 0 20px;
	}

	.margintop20 {
		margin-top: 20px;
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

	.text {
		margin-top: 20px;
		font-size: 14px;
		color: #1A1A1A;
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

	button::after {
		border: 1px solid rgba(255, 255, 255, 1);
	}

	.btn-buttons {
		background: #ff663d;
		color: #fff;
	}

	.btn-buttonn {
		background: #B2B2B2;
		color: #fff;
	}

	.addimg {
		width: 78px;
		height: 78px;
		background: rgba(250, 250, 250, 1);
		border: 1px solid rgba(217, 217, 217, 1);
		position: relative;
	}

	.addimg text {
		display: block;
		text-align: center;
		position: absolute;
		bottom: 0;
		font-size: 12px;
		color: #fff;
		width: 100%;
		height: 18px;
		background: rgba(0, 0, 0, 0.4);
		line-height: 18px;
	}

	.addimg image {
		width: 100%;
		height: 100%;
	}

	.qrcode {
		width: 200px;
		height: 200px;
		margin-top: 30px;
	}
</style>
