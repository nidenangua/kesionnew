<template>
  <view class="ks-amplification-img">
    <ks-image :src="src" class="image-img" aspect="widthFix" @click="isShowImg"></ks-image>
	<view class="ks-amplification-box" v-if="isShow" @touchmove.stop.prevent>
		<view class="title">{{curr+1}}/{{imgArr.length}}</view>
		<view class="close" @click="close" :style="'background: url('+baseUrl+'/static/images/common/common_btn_close.png) no-repeat center;background-size: 25px;'"></view>
		<swiper class="swiper" :indicator-dots="indicatorDots" :current="index" :autoplay="autoplay" :interval="interval" :duration="duration" @change="setIndex">
			<swiper-item v-for="(item,i) in imgArr" :key="i">
				<ks-image :src="item.url" class="image-img" aspect="widthFix"></ks-image>
			</swiper-item>
		</swiper>
	</view>
  </view>
</template>
<script>
	import KsImage from '@/components/ks-components/image/Image.vue'
	export default {
	  name: "KsAmplification",
	  props: {
		/**图片地址 */
		src: String,
		index:0,
		imgArr:Array
	  },
	  data() {
		return {
			baseUrl:this.$store.state.SRC+"/config/app",
		  indicatorDots: false,
		  autoplay: false,
		  interval: 2000,
		  duration: 500,
		  curr:this.index,
		  isShow:false
		};
	  },
	  components:{
	  	KsImage
	  },
	  methods: {
		isShowImg(){
			this.isShow = true
			this.$emit('isShowStatus',this.isShow)
		},
		close(){
			this.isShow=false
			this.curr = this.index
			this.$emit('isShowStatus',this.isShow)
		},
		setIndex(e){
			this.curr = e.detail.current
		}
	  },
	  watch: {
		'index'(){
		  this.curr = this.index
		}
	  }
	};
</script>
<style lang="scss" scoped>
.ks-amplification-box{
	position: fixed;
	width: 100%;
	height: 100%;
	background: #000;
	left: 0;
	top: 0;
	z-index: 10000;
	.title{
		font-size: 14px;
		line-height: 40px;
		color: #fff;
		text-align: center;
	}
	.close{
		position:absolute;
		right: 5px;
		top: 5px;
		
		background-size: 25px;
		width: 30px;
		height: 30px;
	}
	.swiper{
		height: 90%;
		.image-img{
			max-height: 100%;
		}
		.ks-image{
			height: 100%;
			display: flex;
			justify-content: center;
			align-items: center;
		}
		
	}
	
}
.map-main {
    position: relative;
    width: 100vw;
    height: 100vh;
}
</style>
