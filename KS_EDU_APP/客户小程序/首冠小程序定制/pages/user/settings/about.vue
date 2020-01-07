<template>
	<view style="background: #fff;min-height: calc(100vh - 50px);padding: 50px 20px 0 20px;text-align: center;">
		<view style="display: flex;justify-content: center;border-radius:8px;">
			<ks-image radius="8px" style="box-shadow:0px 0px 2px 0px rgba(1,12,23,0.3);" class="ks-image" :src="1" type="logo"></ks-image>
		</view>
		<view class="title">{{data.companyname}}</view>
		<view class="version">当前版本 3.0</view>
		<view style="text-align: left;font-size:12px;color:rgba(77,77,77,1);">
			<view class="companyintro">{{data.companyintro}}</view>
			<view style="margin-top: 25px;">全国免费客服热线：{{data.comapnyphone}}</view>
			<view style="margin-top: 25px;">电子邮箱：{{data.comapnyemail}}</view>
		</view>
		<view style="font-size:12px;padding:40px 0;color:rgba(136,136,136,1)">北京欣瑞宏程教育科技有限公司 版权所有 ©2006-2019</view>
	</view>
</template>

<script>
	import {KsImage} from 'components/ks-components/image/Image'
	import {About} from 'api/other'
	export default {
		components:{
			KsImage,
		},
		data() {
			return {
				data:{}
			}
		},
		onLoad() {
			About({}).then(res=>{
				this.data = res
			})
		},
		methods: {
			
		}
	}
</script>

<style scoped>
	.ks-image{
		width: 60px;
		height: 60px;
		border-radius:8px;
		overflow: hidden;
	}
	.title{
		font-size:20px;
		font-weight:500;
		color:rgba(26,26,26,1);
		margin-top: 15px;
	}
	.version{
		font-size:14px;
		color:rgba(136,136,136,1);
		margin-top: 15px;
	}
	.companyintro{
		line-height:24px;
		margin-top: 25px;
	}
</style>
