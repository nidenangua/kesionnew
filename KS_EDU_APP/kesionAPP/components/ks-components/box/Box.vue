<template>
	<view class="ks-box">
		<view class="ks-title">
			<view class="ks-title__name">{{title}}</view>
			<view class="ks-title__more" @click="open(url)">
				<view style="font-size: 14px;" >查看全部</view>
				<image :src="baseUrl+'/static/images/index/common_icon_more@2x.png'"></image>
			</view>
		</view>
		
		<view class="ks-box__body">
			<slot></slot>
		</view>
	</view>
	
</template>

<script>
	export default {
		name:'KsBox',
		props:{
			title:{
				type:String,
				default:''
			},
			url:{
				type:String,
				default:'/'
			}
		},
		data() {
			return {
				baseUrl:this.$store.state.SRC+"/config/app"
			};
		},
		methods:{
			open(url){
				uni.navigateTo({
					url:url
				})
			}
		}
	}
</script>

<style scoped>
	.ks-box{
		padding: 0 10px 10px 10px;
		background: #fff;
		margin-top: 10px;
	}
	.ks-title{
		display: flex;
		justify-content: space-between;
		height: 48px;
		line-height: 48px;	
	}
	.ks-title__name{
		font-size:18px;
		font-family:PingFang SC;
		font-weight:500;
		color:rgba(26,26,26,1);
	}
	.ks-title__more{
		font-size:14px;
		font-weight:400;
		color:rgba(102,102,102,1);
		display: flex;
		align-items: center;
		justify-content: center;
	}
	.ks-title__more image{
		width: 14px;
		height: 14px;
	}
</style>
