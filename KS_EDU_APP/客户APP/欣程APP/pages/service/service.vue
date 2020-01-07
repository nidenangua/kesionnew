<template>
	<web-view v-if="state.SRC" :webview-styles="webviewStyles" :src="state.SRC+'/Config/APP/service.html'"></web-view>
</template>

<script>
	export default{
		data(){
			return {
				state:{},
				webviewStyles: {
				    progress: false,
					width:'100%',
					height:'100%'
				}
			}
		},
		onLoad() {
			let sysInfo = uni.getSystemInfo({
				success:res=>{
					this.webviewStyles.height = res.windowHeight
				}
			})
			this.$store.ready(state=>{
				this.state = state
			})
		}
	}
</script>

<style>
</style>
