<template>
	<view style="background: #fff;height: 100vh;">
		<comment-list :proid="courseid"  :flag="2" :channelid="10002"  />
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
				courseid:''
			}
		},
		methods:{
			
		},
		onLoad(query) {

			this.courseid = query.courseid
		}
	}
</script>

<style scoped>
</style>
