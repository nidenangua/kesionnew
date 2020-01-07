<template>
	<view class="ks-cell-group">
		<view class="ks-cell-group__title" v-if="title">
			{{title}}
		</view>
		<view class="ks-cell-group__body">
			<slot />
		</view>
	</view>
</template>

<script>
	export default {
		name:'ks-cell-group',
		props:{
			title:String
		}
	}
</script>

<style lang="scss" scoped>
	.ks-cell-group{
		margin-top: 10px;
	}
	.ks-cell-group__title{
		height: 44px;
		line-height: 44px;
		padding: 0 15px;
		font-size: 16px;
		color:$uni-text-color;
	}
</style>
