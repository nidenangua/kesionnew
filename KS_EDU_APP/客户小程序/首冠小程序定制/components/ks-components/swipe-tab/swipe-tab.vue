<template>
	<view class="ks-swipe-tab">
		<view class="ks-swipe-tab-head">
			<view class="ks-swipe-tab-head__item" :class="current == i && 'active'" v-for="(item,i) in itemList" :key="i" @click="onTabItemClick(i)">
				{{item.label}}
			</view>
		</view>
		<swiper class="ks-swipe-tab-body" :current="current" @change="onSwiperChange">
			
		</swiper>
	</view>
</template>

<script>
	export default{
		name:'ks-swipe-tab',
		props:{
			itemList:{
				type:Array,
				default(){
					return []
				}
			},
			current:{
				type:Number,
				default:0
			}
		},
	
		data(){
			return {
			}
		},
		created(){
			
			
		},
		methods:{
			onSwiperChange(e){
				this.$emit('update:current',e.detail.current)
			},
			onTabItemClick(index){
				this.$emit('update:current',index)
			}
		}
	}
</script>

<style lang="scss" scoped>
	.ks-swipe-tab{
		height: 44px;
		line-height: 44px;
	}
	.ks-swipe-tab-head{
		display: flex;
	}
	.ks-swipe-tab-head__item{
		font-size: 14px;
		flex: 1;
		text-align: center;
	}
	.ks-swipe-tab-head__item.active{
		color:$uni-color-primary
	}
</style>
