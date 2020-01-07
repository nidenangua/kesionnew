<template>
	<view>
	
		<view style="background: #fff;" v-if="list.length>0">
			<view class="item" v-for="(item,i) in list" :key="i" @click="open(item.courseid,item.coursename)">
				<ks-image class="ks-image" :src="item.imageUrl" radius="4px"></ks-image>
				<view>
					<view class="ks-course__title--2" style="height: 48px;">{{item.coursename}}</view>
					<view style="font-size: 14px;">已下载{{item.taskList.length}}</view>
				</view>	
			</view>
		</view>
		<ks-empty type="list" v-else>暂无缓存记录</ks-empty>
	</view>
	
</template>

<script>
	export default{
		data(){
			return {
				list:[],
				state:{},
				task:{},
				status:'',
				neicun:''
			}
		},
	
		methods:{
			open(courseId,courseName){
				uni.navigateTo({
					url: `/pages/user/local/index?courseid=${courseId}&title=${courseName}`
				})
			},
			getJsonTxt(){
				//获取之前存储的txt数据,
				plus.io.resolveLocalFileSystemURL(`_doc/cache/${this.state.userId}.txt`, (entry)=> {
					let reader = new plus.io.FileReader();
					reader.readAsText(entry);
					reader.onload = (e)=> {
						this.list = JSON.parse(e.target.result)
					}
				}, (e)=> {
					console.log(e.message)
				})	
			},
			ready(){
				//plus加载后在执行plus方法	
				if(typeof plus === 'object'){
					this.getJsonTxt()
				}else{
					setTimeout(() => {
					    this.ready()
					}, 100)
				}
			}
		},
		onShow(){
			this.$store.ready(state=>{
				this.state = state	
				this.ready()
			})
		}
	}
</script>

<style scoped>
	.item{
		padding: 10px 20px;
		display: flex;
	}
	.ks-image{
		width: 120px;
		height: 80px;
		margin-right: 20px;
	}
</style>
