<template>
	<view style="background: #fff;height: 100vh;">
		<comment-list :proid="roomid"  :flag="1" :channelid="10001"  />
	</view>
	
</template>

<script>
	import CommentList from '@/components/ks-components/comment-list/comment-list'
	export default{
		components:{
			CommentList
		},
		data(){
			return {
				roomid:''
			}
		},
		methods:{
			
		},
		onLoad(query) {

			this.roomid = query.roomid
		}
	}
</script>

<style scoped>
</style>
