<template>
	<view class="ks-page-scroller">
		<scroll-view scroll-y="true" :style="{height:height}" @touchstart="onTouchStart" @touchmove="onTouchMove" @touchend="onTouchEnd" @scrolltolower="onScrollToLower">
			<view class="ks-page-scroller__body" :style="{transform:'translateY('+y+'px)'}">
				<view class="ks-page-scroller__loading ks-page-scroller__loading--rotate" v-if="refreshStatus">
					<image :src="baseUrl+'/static/images/icon/icon-refresh.png'" />正在刷新
				</view>
				<view class="ks-page-scroller__loading" v-else>
					<image :src="baseUrl+'/static/images/icon/icon-refresh.png'" />松开刷新
				</view>
				<slot />
				<view class="ks-page-scroller__more" v-if="page && page>= pageCount">已全部加载完成</view>
				<view class="ks-page-scroller__more" v-else-if="page">上拉加载更多</view>
			</view>
		</scroll-view>
		
	</view>
</template>

<script>
	export default{
		name:'ks-page-scroller',
		props:{
			page:Number,
			pageCount:Number,
			height:{
				type:String,
				default:'100%'
			},
			refreshStatus:Boolean
		},
		data(){
			return {
				y:-49,
				refreshing:false,
				touchFlag:true,
				baseUrl:this.$store.state.SRC+"/config/app",
			}
		},
		watch:{
			refreshStatus(val){
				if(!val){
					this.y = -49
					this.refreshing = false
				}
			}
		},
		methods:{
			/**
			 * 手指触摸事件开始
			 */
			onTouchStart(e){
				if(this.refreshing){
					this.touchFlag = false
					return
				}
				this.touchFlag = true
				this.startPageY = e.changedTouches[0].pageY
			},
			/**
			 * 拖动中
			 */
			onTouchMove(e){
				if(!this.touchFlag){
					return
				}
				let pageY = e.changedTouches[0].pageY
				let y = -49 + (pageY - this.startPageY)
				y = Math.min(y,0)
				y = Math.max(y,-49)
				this.y = y
			},
			/**
			 * 拖动结束
			 */
			onTouchEnd(e){
				if(!this.touchFlag){
					this.touchFlag = true
					return
				}
				if(this.y === 0){
					this.refreshing = true
					this.$emit('update:refreshStatus',true)
					this.$emit('refresh')
				}else{
					this.y = -49
				}
			},

			onScrollToLower(){
				this.$emit('scrolltolower')
			}
		}
	}
</script>

<style lang="scss" scoped>
	.ks-page-scroller{
		overflow: hidden;
		position: relative;
	}
	.ks-page-scroller__body{
		transition: .1s;
	}
	.ks-page-scroller__loading{
		height: 49px;
		line-height: 49px;
		text-align: center;
		font-size: 14px;
		
	}
	.ks-page-scroller__loading image{
		height: 20px;
		width:20px;
		margin-right: 10px;
		display: inline-block;
		position: relative;
		top:5px;
		
	}
	.ks-page-scroller__loading--rotate image{
		-webkit-animation:rotate .3s linear infinite;
	}
	@-webkit-keyframes rotate{
 
		0%{-webkit-transform:rotate(0deg);}

		100%{-webkit-transform:rotate(360deg);}
 
	}
	.ks-page-scroller__more{
		height: 44px;
		line-height: 44px;
		color:$uni-text-color-grey;
		font-size: 12px;
		text-align: center;
	}
</style>
