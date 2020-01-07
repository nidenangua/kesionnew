<template>
	<view>
		
	</view>
</template>

<script>
	
	export default {
		data() {
			return {
				
			}
		},
		onLoad(query){
			let pages = getCurrentPages()
			let prevPage = pages[pages.length-2]
			if(prevPage.route === 'pages/web/web'){
				prevPage.$vm.refresh = false
			}
			
			let data = decodeURIComponent(query.result)
			console.log(data)
			data = JSON.parse(data)
			switch(Number(data.type)){
				case 0:
					switch(data.msg){
						case '申请成功':
						case '恭喜，报名成功！':
							if(data.msg === '恭喜，报名成功！'){
								data.msg = '报名成功'
							}
							this.$msg(data.msg,'success').then(()=>{
								uni.navigateBack()
							})
							break
						default:
						this.$msg(data.msg).then(()=>{
							uni.navigateBack()
						})
					}
					
					break
				case 1:
					uni.showModal({
						title:'提示',
						content:data.msg,
						success:res=>{
							if(res.confirm && data.url){
								console.log(data.url)
								uni.redirectTo({
									url:'/pages/web/web?url='+encodeURIComponent(data.url)
								})
							}else{
								uni.navigateBack()
							}
						}
					})
					break
				case 2:
					this.$msg(data.msg).then(()=>{
						if(data.url.indexOf('/login') !== -1){
							uni.redirectTo({
								url:'/pages/user/login/index'
							})
						}else{
							uni.redirectTo({
								url:'/pages/web/web?title='+data.title+'&url='+encodeURIComponent(data.url)
							})
						}
					})
					break
			}
		},
		methods: {
			
		}
	}
</script>

<style>

</style>
