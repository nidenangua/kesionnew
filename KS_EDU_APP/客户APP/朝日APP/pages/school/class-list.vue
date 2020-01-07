<template>
	<ks-page-scroller :page="getParameters.pageindex" :refresh-status.sync="refreshStatus" @refresh="onRefresh" :height="height+'px'" :page-count="pageCount" v-if="classList.length">
		<!-- 资讯列表 -->
		<view class="classlist">
			<view v-for="item in classList" :key="item.roomid" class="class-item withe-bg" @click="open(item)">
				<view class="classimg"><ks-image :src="item.defaultpic" class="classimg__img"></ks-image></view>
				<view class="class__info">
					<view class="title">{{item.title}}<text class="teacher">班主任：{{item.teacher}}</text></view>
					<view class="intro">
					  <view class="course-num"><ks-image :src="baseUrl+'/static/images/school/cour.png'" class="icon-img"></ks-image>{{item.coursecount||0}}</view>
					  <view class="student-num"><ks-image :src="baseUrl+'/static/images/school/message.png'" class="icon-img"></ks-image>{{item.buycount||0}}</view>
					  <view class="comment-num"><ks-image :src="baseUrl+'/static/images/school/mine.png'" class="icon-img"></ks-image>{{item.commentnum||0}}</view>
					</view>
				</view>
			</view>
		</view>
		<!-- 资讯列表 -->
	</ks-page-scroller>
	<ks-empty type="list" v-else>暂无数据</ks-empty>
</template>

<script>
	import {GetSchoolClassList} from '@/api/school'
	export default {
		props:{
			schoolid:Number
		},
		data(){
			return{
				classList:[],//新闻列表
				getParameters:{
					schoolid:this.schoolid,
					pageindex:1,
					pagesize:10
				},
				pageCount:0,
				refreshStatus:false,
				height:0,
				baseUrl:this.$store.state.SRC+"/config/app"
			}
		},
		mounted(){
			uni.showLoading({
			    title: '加载中'
			});
			uni.getSystemInfo({
				success:res=>{
					this.height = res.windowHeight-226
				}
			})
			this.loadPage()
		},
		methods: {
			onRefresh(){
				this.loadPage()
			},
			open(item){
				var url = encodeURIComponent(item.weburl)
				uni.navigateTo({
					url:'/pages/web/web?title='+item.title+'&photo='+item.defaultpic+'&url='+url
				})
				
			},
			scrolltolower(){
				this.getParameters.pageindex++
				if(this.getParameters.pageindex <= this.pageCount){
					this.loadPage('more')
				}
			},
			//初始数据的请求
			loadPage(status){
				if(this.loading){
					return
				}
				this.loading = true
				if(status=='more'){
					GetSchoolClassList(this.getParameters).then(res=>{
						if(res.result){
							this.classList = this.askList.concat(res.data)
						}
						this.loading = false
					})
				}else{
					this.getParameters.pageindex=1
					GetSchoolClassList(this.getParameters).then(res=>{
						if(res.result){
							this.pageCount = res.pageCount
							this.classList = res.data
						}else{
							this.classList = []
							this.pageCount = 0
						}
						uni.hideLoading();
						this.loading = false
						setTimeout(()=>{
							this.refreshStatus = false
						},1000)
					})
				}
			}
			
		}
	}
</script>

<style lang="scss" scoped>
	
	//资讯列表样式
	.classlist{
		margin-top: 15px;
		.class-item{
			width: 90%;
			margin:0 auto 15px;
			border-radius: 5px;
			overflow: hidden;
			.class__info{
				box-sizing: border-box;
				.title{
					font-size:16px;
					color:#010E16;
					line-height: 24px;
					height: 24px;
					overflow: hidden;
					white-space: nowrap;
					text-overflow: ellipsis;
					margin: 10px;
					.teacher{
						float: right;
						font-size: 14px;
						color: #999;
					}
				}
				.intro{
					display: flex;
					margin-top: 10px;
					margin-bottom: 10px;
					.course-num,.student-num,.comment-num{
						flex-grow:3;
						text-align: center;
						border-right:1px solid #eee;
						font-size: 14px;
						.icon-img{
							width:15px;
							height: 15px;
							display: inline-block;
							vertical-align: middle;
							margin-right:10px;
						}
					}
				}
			}
			.classimg{
				width: 100%;
				height: 180px;
				.classimg__img{
					width: 100%;
					height: 180px;
				}
			}
			
			
		}
	}
</style>
