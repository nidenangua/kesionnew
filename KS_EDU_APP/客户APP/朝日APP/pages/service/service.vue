<template>
	<web-view :webview-styles="webviewStyles" :src="state.SRC+'/Config/APP/Common/service.aspx'"></web-view>
</template>

<script>
	export default{
		data(){
			return {
				state:{},
				webviewStyles: {
				    progress: false,
					width:'100%',
					height:'100vh'
				}
			}
		},
		onLoad() {
			this.$store.ready(state=>{
				this.state = state
			})
		}
	}
</script>

<style>
</style>
