<template>
	<view class="content">
		<view class="topic-textarea withe-bg">
			<textarea placeholder-style="color:#B2B2B2" maxlength="500" placeholder="有什么想和大家分享的~" @input="conInput"/>
			<view class="tips-num">
				{{remainingNum}}
			</view>
		</view>
		<view class="overhide">
			<view class="topic-img withe-bg clearfix">
				<view class="topic-img-list" v-if="imgids&&imgids.length">
					<view class="uped-img" v-for="(item,i) in imgids" :key="i">
						<view @click="deleteImg(i)" class="close-icon" :style="'background: url('+baseUrl+'/static/images/class-center/topic_btn_delete@2x.png) no-repeat center;background-size: 18px;'"></view>
						<ks-image :src="item" class="img"></ks-image>
					</view>
				</view>
				<view class="up-img" @click="uploadImg" v-if="imgids.length<9" :style="'background: url('+baseUrl+'/static/images/class-center/topic_icon_addpic@2x.png) no-repeat center 30px #F0F4F7;background-size: 30px;'">
					添加图片
				</view>
			</view>
		</view>
		<view class="join withe-bg">
			<button type="primary" class="topic-btn" @click="submit">发表</button>
		</view>
	</view>
</template>

<script>
	import {PublishTopic} from '@/api/class-center'
	import KsImage from '@/components/ks-components/image/Image.vue'
	export default {
		data(){
			return{
				baseUrl:this.$store.state.SRC+"/config/app",
				getParameters:{
					boardid:0,
					content:'',
					imgids:''
				},
				imgids:[],
				domain:this.$store.state.SRC,
				fontNum:500,
				remainingNum:500,
			}
		},
		components:{
			KsImage
		},
		onLoad: function(option) {
			this.getParameters.boardid = option.boardid
		},
		
		methods: {
			conInput(e){
				this.getParameters.content = e.detail.value
				this.remainingNum = this.fontNum-this.getParameters.content.length;
			},
			upload(tempFilePaths,index = 0){
				return new Promise(resolve=>{
					let appToken = this.$store.state.appToken
					let userId = this.$store.state.userId
					let filePath = tempFilePaths[index]
					if(filePath){
						uni.showLoading({
							title:'上传第'+(index+1)+'张图'
						})
						uni.uploadFile({
							url : this.domain+'/webapi/School/UploadFile?userid='+userId+'&apptoken='+appToken,
							fileType:'image',
							filePath:filePath,
							name: 'file',
							success: uploadFileRes=> {
								let fileUrl = JSON.parse(uploadFileRes.data).fileUrl
								tempFilePaths[index] = this.domain+fileUrl
								uni.hideLoading()
								this.upload(tempFilePaths,index+1).then(()=>{
									resolve()
								})
							}
						});
					}else{
						resolve()
					}
					
				})
			},
			uploadImg(){
				let _self = this,
					appToken = this.$store.state.appToken,
					userId = this.$store.state.userId;
					if(userId){
						uni.chooseImage({
						 count: 9 - this.imgids.length,
						 sizeType: ['original', 'compressed'], //可以指定是原图还是压缩图，默认二者都有
						 sourceType: ['album'], //从相册选择
						 success: res=> {
							 this.imgids = this.imgids.concat(res.tempFilePaths)
						 },
						 error : function(e){
							console.log(e);
						 }
						});
					}else{
						uni.showToast({
							title: '请先登录',
							icon:'none'
						});
						setTimeout(function () {
							uni.switchTab({
								url:'/pages/user/index'
							})
						}, 1000);
					}
			   
			},
			deleteImg(index){
				this.imgids.splice(index, 1)
			},
			submit(){
				
				if(this.getParameters.content){
					console.log(this.imgids)
					this.upload(this.imgids).then(()=>{
						
						uni.showLoading({
							title: '正在提交中'
						});
						this.getParameters.imgids =  this.imgids.toString()
						PublishTopic(this.getParameters).then(res=>{
							uni.hideLoading();
							if(res.result){
								uni.showToast({
									title:res.msg,
									duration: 2000,
									icon:'none'
								});
								setTimeout(function () {
									uni.navigateBack()
								}, 2000);
								
							}else{
								uni.showToast({
									title: res.msg,
									duration: 2000,
									icon:'none'
								});
							}
						})
					})
					
					
				}else{
					uni.showToast({
					    title: '请输入话题内容',
					    duration: 2000,
						icon:'none'
					});
				}
			}	
		}
	}
</script>

<style lang="scss" scoped>

	.topic-textarea{
		textarea{
			height: 150px;
			width: 100%;
			padding: 12px;
			box-sizing: border-box;
			font-size: 14px;
		}
		.tips-num{
			font-size: 12px;
			color: #CCCCCC;
			text-align: right;
			padding: 10px 12px;
		}
	}
	.overhide{
		overflow: hidden;
		.topic-img{
			padding: 15px 12px 5px;
			border-top:1px solid #eee;
			margin-right: -10px;
			.topic-img-list{
				    
				.uped-img{
					float: left;
					width:109px ;
					height: 109px;
					position:relative;
					margin-right: 10px;
					margin-bottom: 10px;
					.ks-image{
						height: 100%;
						width: 100%;
					}
					.close-icon{
						position: absolute;
						right: 0;
						top:0;
						z-index: 1;
						color: #fff;
						
						background-color: rgba(0, 0, 0, 0.5);
						background-size: 18px;
						width: 20px;
						height: 20px;
					}
				}
			}
			.up-img{
				width: 109px;
				height: 109px;
				float: left;
				text-align: center;
				color: #C7CBD1;
				font-size: 12px;
				padding-top: 67px;
				box-sizing: border-box;
				
				background-size: 30px;
				margin-bottom: 10px;
			}
			
		}
	}
	
	.join{
		position: fixed;
		width: 100%;
		left: 0;
		bottom: 0;
		padding: 5px 10px;
		box-sizing:border-box;
		.topic-btn{
			background: #ff663d;
		}
	}
	.join-bg{
		height: 56px;
	}
</style>
