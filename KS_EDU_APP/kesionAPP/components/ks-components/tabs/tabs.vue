<template>
	<view class="uni-tab-warper">
		<view :class="{'uni-scroll-tab': scroll,'uni-tab--shadow':shadow,'uni-tab--line':line,'uni-tab--fixed':position === 'fixed' }" class="uni-tab">
			<view
			v-for="(tab,index) in tabList" :key="index" 
			:class="{ 'uni-tab-active': index === value, 'uni-tab-scroll-item': scroll}"
			:style="[{color:index === value ? activeColor : defaultColor,backgroundColor: bgColor}]"
			@tap="itemClick(index,tab)"
			class="uni-tab-item">
				<span v-if="tab.icon != undefined" class="iconfont mr5" :class="tab.icon"></span>
				<text>{{rangeKey == '' ? tab : tab[rangeKey]}}</text>
				<view v-if="border&&index === value" :style="[{borderColor: activeColor }]" class="uni-tab-bar" :class="back ? 'uni-tab-bar-backward' : 'uni-tab-bar-forward'"></view>
			</view>
		</view>
	</view>
</template>
<script>
	export default {
		name: 'KsTabs',
		data() {
			return {
				average: 0,
				back: false
			};
		},
		props: {
			position:{
				type:String,
				default:'relative'
			},
			line:Boolean,
			shadow:{
				type:Boolean,
				default:true
			},
			value: {
				type: Number, //当前选中下标
				default:0
			},
			border: {
				type: Boolean, //是否开启下标线
				default:false
			},
			tabList: {
				type: Array,
				default () {
					return [];
				}
			},
			bgColor: { //背景颜色
				type: String,
				default:'#FFFFFF'
			},
			defaultColor: { //默认未选中文字颜色
				type: String,
				default:'#666666'
			},
			activeColor: { //选中时文字颜色 线条颜色
				type: String,
				default () {
					return '#2987EE';
				}
			},
			rangeKey: { // 当tabList为对象时 显示指定下标值
				type: String,
				default () {
					return '';
				}
			},
			scroll: { //横向滑动
				type: Boolean,
				default:false
			},
		},
		computed:{
			barLeft () {
				return this.value * this.average;
			},
			barRight () {
				let index = this.tabList.length - this.value - 1;
				return index * this.average;
			},
		},
		created() {
			this.average = 100 / this.tabList.length;
		},
		methods: {
			itemClick(index,tab){
				if(this.value == index) return false;
				if(this.value > index){
					this.back = true;
				}else{
					this.back = false;
				}
				// this.value = index;
				this.$emit('update:value', index);
				this.$emit('change',{tab:tab});
			}
		}
	};
</script>
<style lang="scss" scoped>
.uni-tab-warper{
	height: 44px;
}
.uni-tab{
	position: relative;
	display: flex;
	font-size: 14px;
	height: 44px;
	line-height: 44px;
	background-color: #fff;
	.uni-tab-item{
		flex: 1;
		height: 100%;
		text-align: center;
		box-sizing: border-box;
		overflow: hidden;
		position: relative;
		color: #666666;
		font-size: 16px;
	}
	.uni-tab-scroll-item{
		flex: none;
		padding: 0px 15px;
	}
	.uni-tab-active{
		color: #1e9fff;
	}
	.uni-tab-scroll-active{
		border-bottom: 2px solid #1e9fff;
	}
	.uni-tab-bar{
		width:30px;
		display: block;
		height: 2px;
		position: absolute;
		bottom: 0;
		left: 50%;
		margin-left: -15px;
		border-bottom: 2px solid #1e9fff;
	}
	.uni-tab-bar-forward{
		transition: right 0.3s cubic-bezier(0.35, 0, 0.25, 1), left 0.3s cubic-bezier(0.35, 0, 0.25, 1) 0.09s;
	}
	.uni-tab-bar-backward{
		transition: right 0.3s cubic-bezier(0.35, 0, 0.25, 1) 0.09s, left 0.3s cubic-bezier(0.35, 0, 0.25, 1);
	}
}
.uni-tab--fixed{
	position: fixed;
	left: 0;
	top: 0;
	width: 100%;
	z-index: 10;
}
.uni-tab--line::after{
	content: '';
	width: 100%;
	height: 1px;
	background: rgba(0,0,0,0.15);
	position: absolute;
	left: 0;
	bottom: 0;
	transform: scaleY(0.5);
}
.uni-tab--shadow{
	box-shadow: 0px 0px 10px 2px rgba(0, 0, 0, 0.03);
}
.uni-scroll-tab{
	overflow-x: scroll;
}
</style>