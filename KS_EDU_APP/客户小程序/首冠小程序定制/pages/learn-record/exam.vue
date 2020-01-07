<template>
	<view class="content">
		<web-view :src="url"></web-view>
	</view>
</template>

<script>
	export default{
		data(){
			return {
				
				url:""
			}
		},
		onShow() {
			this.$store.ready(state=>{
				console.log(state)
				this.url = 'http://192.168.1.2:70/config/app/index.aspx/#/exam?isuni=1&source=app&apptoken='+state.appToken
				
				// if(state.isLogin!=1){
				// 	uni.showModal({
				// 		title:'提示', 
				// 		content: '请先登录',
				// 		success: res=> {
				// 		    if (res.confirm) {
				// 		        uni.navigateTo({
				// 		        	url:'/pages/user/login/index'
				// 		        })
				// 		    } else if (res.cancel) {
				// 		        uni.navigateBack({
				// 		        	delta: 1
				// 		        })
				// 		    }
				// 		}
						    
				// 	})
					
				// }
			})
		},
		methods:{
			
		}
	}
	
</script>

<style>
</style>

