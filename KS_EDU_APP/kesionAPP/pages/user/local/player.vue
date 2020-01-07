<template>
	<view >
		<video id="myVideo" ref="myVideo" v-if="platform=='ios' && show"   autoplay :src="src" @error="videoErrorCallback" @fullscreenchange="back">
			
		</video>
		<video id="myVideo" ref="myVideo" v-else-if="platform=='android' && show"    autoplay :src="src" @error="videoErrorCallback" @fullscreenchange="back">
			
		</video>
	</view>
</template>

<script>
	export default{
		data(){
			return {
				src:'',
				videoContext:'',
				show:false,
				//客户端平台，值域为：ios、android
				platform:''
			}
		},
	
		methods:{
			back(e){
				if(!e.detail.fullScreen){
					uni.navigateBack()
				}
			},
			videoErrorCallback() {
				uni.showToast({
					icon:'none',
					title:'视频播放出错'
				})
			}
		},
		onLoad(query) {
			uni.getSystemInfo({
			    success:  (res)=> {
			       this.platform = res.platform
			        
			    }
			});
			this.src = query.src
		},
		mounted(query) {

			 this.videoContext = uni.createVideoContext('myVideo',this)
			
			 this.videoContext.requestFullScreen()
			 this.show=true
			 this.videoContext.showStatusBar()
			
		}
	}
</script>

<style scoped>
</style>
