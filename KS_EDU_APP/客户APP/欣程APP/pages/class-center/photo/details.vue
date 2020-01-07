<template>
	<view class="content" v-if="loaded">
		<view class="photo-details withe-bg">
			<view class="top-info">
				<view class="title">{{photoData.title}}</view>
				<view class="addtime" :style="'background: url('+baseUrl+'/static/images/class-center/addtime.png) no-repeat center left;background-size:16px ;'">{{photoData.adddate}}</view>
				<view class="info clearfix">
					<view class="ks-col-12 browse-num" :style="'background: url('+baseUrl+'/static/images/class-center/hoticon2.png) no-repeat center left;background-size:14px;'">{{photoData.hits}}</view>
					<view class="ks-col-12 source">{{photoData.author||'未知'}}</view>
				</view>
			</view>
			<view class="image-intro">
				<view class="image-item" v-for="(item,i) in photoData.img_list" :key="i">
					<ks-image :src="item.url" class="image-img" aspect="widthFix" @click="previewImage(item.url,i)"></ks-image>
					<!-- <ks-amplification :src="item.url" class="image-img" :index="i" :imgArr="photoData.img_list" @isShowStatus="getStatus"></ks-amplification> -->
					<view class="image-title">{{item.name}}</view>
				</view>
			</view>
		</view>
		<view class="photo-content withe-bg">
			<view class="title">作品介绍</view>
			<view class="intro" v-html="photoData.intro" v-if="photoData.intro"></view>
			<ks-empty type="article" v-else>暂无介绍</ks-empty>
		</view>
	</view>
</template>

<script>
	import {GetWorksView} from '@/api/class-center'
	import KsImage from '@/components/ks-components/image/Image.vue'
	import KsEmpty from '@/components/ks-components/empty/empty.vue'
	import KsAmplification from '@/components/ks-components/amplification-img/amplification-img.vue'
	export default {
		data(){
			return{
				loaded:false,
				infoid:0,
				photoData:{},
				showStatus:false,
				baseUrl:this.$store.state.SRC+"/config/app"
			}
		},
		components:{
			KsImage,
			KsEmpty,
			KsAmplification
		},
		onLoad: function(option) {
			this.infoid = option.infoid
			// uni.getSystemInfo({
			// 	success:res=>{
			// 		this.height = res.windowHeight
			// 	}
			// })
			uni.showLoading({
			    title: '加载中'
			});
			this.loadPage()
		},
		onShareAppMessage(){
			var that = this
		　　// 设置菜单中的转发按钮触发转发事件时的转发内容
		　　var shareObj = {
		　　　　title: that.photoData.title,
				path: '/pages/class-center/photo/details?infoid='+that.infoid,
		　　　　imageUrl: that.photoData.defaultpic||this.baseUrl+'/static/images/common/default-img.png', 
		　　　　success: function(res){
		　　　　　　// 转发成功之后的回调
		　　　　　　if(res.errMsg == 'shareAppMessage:ok'){
		　　　　　　}
		　　　　},
		　　　　fail: function(){
		　　　　　　// 转发失败之后的回调
		　　　　　　if(res.errMsg == 'shareAppMessage:fail cancel'){
		　　　　　　　　// 用户取消转发
		　　　　　　}else if(res.errMsg == 'shareAppMessage:fail'){
		　　　　　　　　// 转发失败，其中 detail message 为详细失败信息
		　　　　　　}
		　　　　}
		　　};
		　　// 返回shareObj
		　　return shareObj;
		},
		methods: {
			setClassIndex(classid){
				this.getParameters.workclassid = classid
				this.loadPage()
			},
			getStatus(e){
				this.showStatus = e
			},
			previewImage(src,index){
				console.log(src)
				if(src){
					let tempFilePaths = []
					this.photoData.img_list.map(item=>{
						tempFilePaths.push(item.url)
					})

					// 预览图片
					uni.previewImage({
						urls: tempFilePaths,
						current:index,
						longPressActions: {
							itemList: ['发送给朋友', '保存图片', '收藏'],
							itemColor:'#fff',
							success: function(data) {
								//console.log('选中了第' + (data.tapIndex + 1) + '个按钮,第' + (data.index + 1) + '张图片');
							},
							fail: function(err) {
								console.log(err.errMsg);
							}
						},
						success:function(data){
							
						},
						fail: function(err) {
							//console.log(err.errMsg);
							uni.showToast({
								title: 'err.errMsg',
								icon:'none'
							});
						}
					});
				}else{
					uni.showToast({
						title: '没有找到图片',
						icon:'none'
					});
				}
				
			},
			loadPage(){
				GetWorksView({
					infoid:this.infoid
				}).then(res=>{
					if(res.result){
						this.photoData = res
					}
					this.loaded = true
					uni.hideLoading();
				})
				
			}
		}
	}
</script>

<style lang="scss" scoped>
	.photo-details{
		.top-info{
			padding: 15px;
			.title{
				font-size: 18px;
				font-weight: 600;
				color: #303030;
				margin-bottom: 10px;
			}
			.addtime{
				font-size: 13px;
				color: #999;
				
				background-size:16px ;
				padding-left: 21px;
			}
			.info{
				line-height: 20px;
				margin-top: 10px;
				.browse-num{
					color: #ff663d;
					
					background-size:14px ;
					padding-left: 16px;
					font-size: 14px;
				}
				.source{
					text-align: right;
					font-size: 13px;
					color: #999;
				}
			}
			
		}
		.image-intro{
			padding-bottom: 15px;
			.image-item{
				margin-bottom: 15px;
				
				.image-title{
					font-size: 13px;
					color: #888;
					margin-top: 10px;
					padding: 0 10px;
				}
			}
		}
	}
	.photo-content{
		padding: 10px;
		margin-top:10px;
		.title{
			font-size: 15px;
			font-weight: 600;
			margin-bottom: 10px;
		}
		.intro{
			font-size: 13px;
			color: #888;
			line-height: 20px;
		}
	}
</style>
