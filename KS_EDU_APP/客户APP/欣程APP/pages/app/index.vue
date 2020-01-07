<template>
		<view class="app-swiper">
			<swiper class="swiper" :indicator-dots="false" :duration="500" :style="'height:'+height+'px'">
				 <!-- APP引导页 -->
				 <swiper-item v-for="(item,i) in list" class="index-swiper-item" :key="i"  :style="'background-image:url('+item.photo+')'">
					
					<button style="width: 480upx;position: fixed;bottom: 110upx;left: 50%;margin-left: -240upx;" type="primary" size="default" v-if="i==list.length-1" @click="openIndex()">
						进入欣程网校
					</button>
				 </swiper-item>
			 </swiper>
		</view>
</template>

<script>
	import {Getstartup} from 'api/index'
	export default {
		data() {
			return {
				list:[],
				height:0,
			}
		},
		onLoad() {
			uni.getSystemInfo({
			    success:  (res)=> {
			        this.height = res.windowHeight  
			    }
			});
			if(uni.getStorageSync('appInitPic')){
				uni.switchTab({
					url:'/pages/index/index'
				})
			}else{
				Getstartup().then(res=>{
					res.homepage.map((item,i)=>{
						if(!item.photo){
							res.homepage.splice(i,1)
						}
					})
					if(!res.homepage.length){
						uni.switchTab({
							url:'/pages/index/index'
						})
					}else{
						this.list = res.homepage
					}
				}).catch(res=>{
					uni.switchTab({
						url:'/pages/index/index'
					})
				})
			}
			
		},
		methods: {
			openIndex(){
				uni.setStorageSync('appInitPic',true)
				uni.switchTab({
					url:'/pages/index/index'
				})
			}
		}
	}
</script>

<style scoped>
	.app-swiper{
		width: 100%;
		height: 100vh;
		background: #f0f4f7;
	}
	.index-swiper-item{
		background-size: contain;
		background-position: 50% 50%;
		background-repeat: no-repeat;
		text-align: center;
	}
</style>
