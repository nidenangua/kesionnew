<template>
	<view class="filecach" :style="{minHeight:windowHeight + 'px'}">
		<!-- <view class="filecach__memory">
			已缓存课件30M，可用空间300M
		</view> -->
		<view class="filecach__list" v-if="taskList.length">
			<view class="filecach__task"  @click="select(site.periodid)" v-for="(site,s) in taskList" :key="s">
				<view class="filecach__circle" v-if="deletes">
					<image :src="baseUrl+'/static/images/common/active.png'"
					 v-if="activeList.indexOf(site.periodid)!=-1" />
				</view>
				<view class="filecach__period">
					<view class="filecach__period-title">{{s+1}}. {{site.periodname}}</view>
					<view calss="filecach__period-progress" v-if="site.state != 4">
						<progress border-radius="3" :percent="site.percent" stroke-width="3" active-color="#2987EE" />
						<view class="filecach__period-text">
							<text>{{site.downloadedSize}}M/{{site.totalSize}}M</text>
						</view>
					</view>
				</view>
				<view class="filecach__button" v-if="!deletes">
					<button @click="resume(site.periodid)" v-if="site.state==5">继续</button>
					<button @click="play(site)" v-else-if="site.state==4">播放</button>
					<button @click="pause(site.periodid)" v-else>暂停</button>
				</view>
				
			</view>
		</view>
		<ks-empty v-else>暂无缓存记录</ks-empty>
		<view class="filecach__footer" v-if="deletes">
			<view class="filecach__footer-item" @click="allSelect()">{{all?'取消全选':'全选'}}</view>
			<view class="filecach__footer-item filecach__footer-item--del" @click="deletesTask()">删除</view>
		</view>
		<view class="filecach__footer" v-else-if="status > 0">
			<view class="filecach__footer-item" @click="allStateChange">{{status == 1 ? '全部开始' : '全部暂停'}}</view>
		</view>
	</view>
</template>

<script>
	import Download from '@/utils/download'
	export default {
		data() {
			return {
				baseUrl:'',
				all:false,
				deletes:false,
				windowHeight:0,
				activeList:[],
				courseid:0,
				taskList:[],
				status: 0
			}
		},
		onNavigationBarButtonTap(){
			this.updateRightBtn()
		},
		onLoad(query){
			uni.getSystemInfo({
				success:res=>{
					this.windowHeight = res.windowHeight
				}
			})
			this.$store.ready(state=>{
				this.courseid = query.courseid
				this.baseUrl = state.SRC + '/config/app'
				Download.init({
					baseUrl:state.SRC,
					userid:state.userId,
					courseid: query.courseid,
					periodids: query.periodids,
					onChange:e=>{
						if(!this.navTitleSeted){
							uni.setNavigationBarTitle({
							    title: e.coursename
							})
							this.navTitleSeted = true
						}
						if(e.downLength > 0 || e.pausesLength > 0){
							this.status = e.downLength > 0 ? 2 : 1
						}else{
							this.status = 0
						}
						this.taskList = e.taskList
					}
				})
			})
		},
		methods:{
			/**
			 * 更新头部导航右侧按钮文字
			 */
			updateRightBtn(){
				if(!this.deletes){
					this.deletes = true
					var webView = this.$mp.page.$getAppWebview()
					webView.setTitleNViewButtonStyle(0, {  
					    text: '完成'
					})
				}else{
					this.deletes = false
					var webView = this.$mp.page.$getAppWebview()
					webView.setTitleNViewButtonStyle(0, {  
					    text: '管理'
					})
				}	
			},
			/**
			 * 恢复下载
			 */
			resume(periodid){
				Download.resume(periodid)
			},
			/**
			 * 暂停下载 
			 */
			pause(periodid){
				Download.pause(periodid)
			},
			/**
			 * 播放
			 */
			play(item){
				let path = plus.io.convertLocalFileSystemURL(item.filename)
				path = 'file://'+path
				uni.navigateTo({
					url: `/pages/user/local/player?src=${path}`
				})
			},
			/**
			 * 选择下载任务
			 */
			select(periodid){
				if(!this.deletes){
					return
				}
				if(this.activeList.indexOf(periodid) == -1){
					this.activeList.push(periodid)
				}else{
					this.activeList = this.activeList.filter(id=>{
						if (periodid != id) {
						    return id
						}
					})
				}
				this.all = this.taskList.length == this.activeList.length
			},
			/**
			 * 全选
			 */
			allSelect(){
				this.all = !this.all
				if(this.all){
					let _activeList = []
					this.taskList.filter(item=>{
						_activeList.push(item.periodid)
					})
					this.activeList = _activeList
				}else{
					this.activeList = []
				}
				
			},
			/**
			 * 删除任务
			 */
			deletesTask(){
				if(this.activeList.length>0){
					uni.showModal({
						 title: '删除所选内容',
						    content: '确定删除所选内容吗?',
						    success:  (res)=> {
						        if (res.confirm) {
									Download.removeTask(this.activeList).then(()=>{
										this.taskList = this.taskList.filter(item=>{
											return this.activeList.indexOf(item.periodid) === -1
										})
										this.activeList = []
										this.updateRightBtn()
									})
									
						        }
						    }
					})
				}	
			},
			/**
			 * 状态变化
			 */
			allStateChange(){
				switch(this.status){
					case 1:
						Download.resumeAll()
						break
					case 2:
						Download.pauseAll()
						break
					
				}
			},
			onUnload(){
				Download.destroyed()
			}
		}
	}
</script>

<style lang="scss">
	
	.filecach{
		background: #fff;
	}
	.filecach__memory{
		line-height: 36px;
		height: 36px;
		padding-left: 10px;
		background: #fff;
		font-size:14px;
		color:rgba(136,136,136,1);
		border-top: 1px solid #eee;
	}
	.filecach__task{
		display: flex;
		align-items: center;
		padding: 15px;
	}
	.filecach__task:active{
		background: #f9f9f9;
	}
	.filecach__period{
		flex: 1;
		margin-right: 15px;
	}
	.filecach__period-text{
		margin-top: 10px;
		font-size: 12px;
		color:$uni-color-grey;
	}
	.filecach__circle{
		width: 17px;
		height: 17px;
		border-radius: 50%;
		position: relative;
		margin-right:15px;
		border: 1px solid #aaaaaa;
		image{
			width: 100%;
			height: 100%;
			position: absolute;
			top: 0;
			left: 0;
		}
	}
	.filecach__period-title{
		align-items: center;
		font-size: 14px;
		line-height: 32px;
		white-space: nowrap;
		height: 32px;
		overflow: hidden;
	}
	.filecach__period-progress{
		margin-top: 25px;
	}
	.filecach__button button{
		height: 30px;
		line-height: 30px;
		font-size:14px;
		color:rgba(26,26,26,1);
	}
	
	.filecach__footer{
		text-align:center;
		display:flex;
		position: fixed;
		bottom: 0;
		left: 0;
		width: 100%;
		border-top: 1px solid #eee;
		height: 44px; 
		line-height: 44px;
		font-size: 14px;
		color:#333;
		background: #fff;
		z-index: 1000;
	}
	.filecach__footer-item{
		flex: 1;
	}
	.filecach__footer-item--del{
		color:$uni-color-danger;
	}
</style>
