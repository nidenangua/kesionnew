<template>
<view>
	<web-view :webview-styles="webviewStyles" :src="url" v-if="refresh"></web-view>
	
</view>
</template>

<script>
	export default {
		data() {
			return {
				refresh:false,
				url:'',
				title:'',
				photo:'',
				webviewStyles: {
				    progress: false
				}
			}
		},
		onLoad(query) {
			this.query = query
		},
		onShow(){
			if(!this.refresh){
				this.$nextTick(()=>{
					let query = this.query
					let url = decodeURIComponent(query.url)
					let hash = url.split('#')[1]
					url = url.split('#')[0]
					if(query.title){
						uni.setNavigationBarTitle({
							title: query.title
						});
					}
					this.title = query.title || ''
					this.photo = query.photo
					this.$store.ready(state=>{
						if(url.indexOf('//') === -1){
							url = state.SRC+url
						}
						url = this.getParams(url,{
							apptoken: state.appToken || 'fail',
							source:'app'
						},true)
						hash =  this.getParams(hash,{
							isuni:1
						})
						this.url = url + '#' + hash
						console.log(this.url)
						this.refresh = true
					})	
				})
			}
			
			
		},
		onUnload(){
			let pages = getCurrentPages()
			let prevPage = pages[pages.length-2]
			if(this.url.indexOf('/Plus/Course/Apply.aspx') !== -1 && prevPage.route === 'pages/web/web'){
				prevPage.$vm.refresh = false
			}
		},
		onShareAppMessage(){
			let that = this
		　　// 设置菜单中的转发按钮触发转发事件时的转发内容
		　　let shareObj = {
		　　　　title: that.title,
				path: '/pages/web/web?url=' + encodeURIComponent(that.url),
		　　　　imageUrl: that.photo || this.$store.state.SRC+'/static/images/common/default-img.png', 
		　　　　success: function(res){
		　　　　　　// 转发成功之后的回调
		　　　　　　if(res.errMsg == 'shareAppMessage:ok'){
		　　　　　　}
		　　　　},
		　　　　fail: function(){
		　　　　　　// 转发失败之后的回调
		　　　　　　if(res.errMsg == 'shareAppMessage:fail cancel'){
		　　　　　　　　// 用户取消转发
		　　　　　　}else if(res.errMsg == 'shareAppMessage:fail'){
		　　　　　　　　// 转发失败，其中 detail message 为详细失败信息
		　　　　　　}
		　　　　}
		　　};
		　　return shareObj;
		},
		
		methods: {
			
			/**
			 * 获取路由参数
			 */
			getParams(url = '/',otherParams = {},conversion){
				let upt = url.split('?')[1]
				let qpt = []
				if(upt){
					if(conversion){
						upt = upt.replace(/\-/g,'=').replace(/,/g,'&')
					}
					qpt = upt.split('&') || []
				}
				
				let params = {}
				qpt.map(par=>{
					let key = par.split('=')[0]
					params[key] = par.split('=')[1]
				})
				let keys = Object.keys(otherParams)
				keys.map(key=>{
					params[key] = otherParams[key]
				})
				let query = this.setParams(params)
				if(conversion){
					query = query.replace(/\=/g,'-').replace(/&/g,',')
				}
				url = url.split('?')[0] + query
				return url
			
			},
			/**
			 * 构造参数
			 */
			setParams(params = {}){
				let keys = Object.keys(params)
				let urlParams = ''
				keys.map(key=>{
					urlParams += urlParams ? `&${key}=${params[key]}` : `?${key}=${params[key]}`
				})
				return urlParams
			}
		}
	}
</script>

<style scoped>
</style>
