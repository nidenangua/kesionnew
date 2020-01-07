<template>
	<view class="ks-zan" :style="iszan?'background: url('+baseUrl+'/static/images/common/zaned.png) no-repeat center top;background-size: 18px;':'background: url('+baseUrl+'/static/images/common/zan.png) no-repeat center left;background-size: 18px;'" :class="iszan?'zaned':''" @click="setCollect" v-if="event==1">
		<slot />
	</view>
	<view  v-else>
		<view class="ks-collect2" :style="isCollect?'background: url('+baseUrl+'/static/images/common/collected.png) no-repeat center top;background-size: 23px;':'background: url('+baseUrl+'/static/images/common/collect2.png) no-repeat center top;background-size: 23px;'"  @click="setCollect" v-if="action==1">
			收藏
		</view>
		<view class="ks-collect" :style="isCollect?'background: url('+baseUrl+'/static/images/common/collected.png) no-repeat center top;background-size: 23px;':'background: url('+baseUrl+'/static/images/common/collect.png) no-repeat center top;background-size: 23px;'"  @click="setCollect" v-else>
			收藏
		</view>
	</view>
</template>

<script>
	import {DoCollect} from '@/api/teacher'
	export default {
		name:'KsCollect',
		props:{
			modelid:0,//模型
			infoid:0,//信息id
			iscollect:false,//是否收藏
			action:0,//1表示问答里面的收藏，0表示小组里面的收藏
			event:0,//1表示点赞，0表示收藏
			iszan:false//是否点赞
		},
		data() {
			return {
				baseUrl:this.$store.state.SRC+"/config/app",
				isCollect:this.iscollect,
				isZan:this.iszan
			};
		},
		methods:{
			setCollect(){
				let data
				if(this.event==1){
					data = {
						modelid:this.modelid,
						infoid:this.infoid,
						type:1,
						flag:0
					}
				}else{
					data = {
						modelid:this.modelid,
						infoid:this.infoid,
						type:0,
						flag:0
					}
				}
				DoCollect(data).then(res=>{
					if(res.result){
						if(this.event==1){
							if(res.returnCode==3){
								this.isZan = true
							}else if(res.returnCode==4){
								this.isZan = false
							}
							this.$emit('result',1)
						}else{
							if(res.returnCode==3){
								this.isCollect = true
							}else if(res.returnCode==4){
								this.isCollect = false
							}
						}
						
						uni.showToast({
						    title: res.message,
						    duration: 2000,
							icon:'none'
						});
						
					}else{
						uni.showToast({
						    title: res.message,
						    duration: 500,
							icon:'none'
						});
						if(res.returnCode==1002){
							setTimeout(function () {
							    uni.navigateTo({
							        url:'/pages/user/login/index'
							    });
							}, 500);
						}
					}
				})
			}
		}
	}
</script>

<style scoped>
	.ks-collect{
		padding-top: 23px;
	
		background-size: 23px;
		font-size: 12px;
	}
	.ks-collect2{
		padding-top: 23px;
		
		background-size: 23px;
		font-size: 12px;
		margin-top: 6px;
	}

	.ks-zan{
		display: inline-block;
		font-size: 14px;
		color: #666666;
		margin-left: 12px;
		padding-left: 23px;
		background-size: 18px;
	}

</style>
