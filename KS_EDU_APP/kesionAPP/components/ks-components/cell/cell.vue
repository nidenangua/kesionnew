<template>
	<view class="ks-cell" :class="line && 'ks-cell--line'" @click="$emit('click')">
		<image class="ks-cell__previcon" v-if="previcon" :src="previcon" />
		<view class="ks-cell__label">
			{{label}}
		</view>
		<view class="ks-cell__value">
			{{value}}
		</view>
		<image class="ks-cell__arrow" v-if="showArrow" :src="baseUrl+'/static/images/icon/icon_more_g@3x.png'"></image>
		<slot name="append"></slot>
	</view>
</template>

<script>
	export default {
		name:'ks-cell',
		props:{
			label:String,
			value:String,
			previcon:String,
			showArrow:Boolean,
			line:Boolean
		},
		data(){
			return {
				baseUrl:this.$store.state.SRC+"/config/app"
			}
		}
	}
</script>

<style lang="scss" scoped>
	.ks-cell{
		height: 49px;
		line-height: 49px;
		overflow: hidden;
		display: flex;
		background: #fff;
		padding: 0 15px;
		font-size: 16px;
		color:$uni-text-color;
		align-items: center;
	}
	.ks-cell--line{
		position: relative;
	}
	.ks-cell--line::after{
		content: '';
		width: 100%;
		height: 1px;
		background: #e3e3e3;
		position: absolute;
		left: 0;
		bottom: 0;
		transform: scaleY(0.5);
		transform-origin: 0 100%;
		margin-left: 15px;
	}
	.ks-cell__previcon{
		width: 24px;
		height: 24px;
		margin-right: 5px;
	}
	.ks-cell__value{
		flex: 1;
		color:$uni-color-grey;
		text-align: right;
	}
	.ks-cell__arrow{
		width: 14px;
		height: 14px;
		margin-left: 7px;
	}
</style>
