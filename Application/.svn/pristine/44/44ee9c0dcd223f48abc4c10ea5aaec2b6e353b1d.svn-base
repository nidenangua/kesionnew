<template>
	<div class="kd-banner">
		<el-carousel :height="bannerHeight">
		  <el-carousel-item v-for="(item,i) in dataList" :key="i" class="kd-banner__image"  :style="{backgroundImage:'url('+item.img+')'}">
		    <div class="kd-banner__body" @click="open(item)" :class="item.flag !== false && item.url && 'ks-cursor-pointer'"></div>
		  </el-carousel-item>
		</el-carousel>
	</div>
	
</template>

<script>
export default({
	name:"KdBanner",
	props:{
		bannerHeight:String,
		dataList:{
			type:Array,
			default(){
				return []
			}
		}
	},
	methods:{
		open(obj){
			if(obj.flag === false){
				return
			}
			if(obj.url){
				location.href = obj.url
			}
		}
	}
})
</script>

<style scoped>
	.kd-banner{
		background: #dedede;
	}
	.kd-banner .el-carousel{
		width: 100%;
	}
	.kd-banner__body{
		width: 1200px;
		margin: 0 auto;
		height: 100%;
	}
	.kd-banner__image{
		width: 100%;
		height: 100%;
		background-position: 50% 50%;
		background-repeat: no-repeat;
		background-size:cover;
	}
	.el-carousel-item{
		width: 100%;
		height: 100%;
	}
	
	.elimage{
		width: 100%;
		height: 100%;
	}
</style>
