<template>
	<ks-card class="comment">
		<div class="comment-title"><i></i>{{title}}</div>
		<el-input type="textarea" :disabled="disabled" :rows="4" :placeholder="placeholder" v-model="interact">
		</el-input>
		<div align="right">
			<el-button :disabled="disabled" type="primary" size="medium" class="comment-left__btn" @click="submitWriteComment()">
				提交
			</el-button>
		</div>
		<div class="comment-item" v-for="(item,i) in interactList" :key="i">
			<div class="comment-item__left">
				<div class="comment-item__avatar">
					<ks-image :src="item.headpic" type="user" />
					<span>{{item.membername}}</span>
				</div>
				<p>{{item.interact}}</p>
			</div>
			<div class="comment-item__right">
				<span>{{item.zannumber}}</span>
				<img src="../../assets/common/dianzan2.png" @click="praiseInteract(item)" v-if="item.isdz==0" />
				<img src="../../assets/common/dianzan1.png" @click="praiseInteract(item)"  v-else-if="item.isdz==1" />
			</div>
		</div>
		<div style="text-align: center;background: #fff;padding-top: 30px;" >
			<el-pagination background layout="prev, pager, next" :current-page="currentPage" :page-count="pageCount" @current-change="getNewsInteract" v-if="pageCount>0" />
			<ks-empty msg="暂时还没有评论" v-else />
		</div>
	</ks-card>
</template>

<script>
	import {newsInteract,writeComment,praiseInteract} from '@/api/news'
	export default({
		name:"Comment",
		props:{
			/**标题 */
			title:{
				type:String,
				default:"评论"
			},
			/**应用id */
			appId:[Number,String],
			/**信息id (课程id | 新闻id ...) */
			infoId:[Number,String],
			/**禁用 */
			disabled:Boolean,
			/**占位文字 */
			placeholder:{
				type:String,
				default:"请输入内容"
			}
		},
		data() {
			return {
				/**评论列表 */
				interactList:[],
				/**评论内容 */
				interact:null,
				/**总页数 */
				pageCount:null,
				/**当前页 */
				currentPage:1
			}
		},
		methods:{
			/*
			* 获取评论
			*/
			getNewsInteract(p = 1){
				newsInteract({
					p:p,
					maxperpage:6,
					data:{
						appid:this.appId,
						infoid:this.infoId,
					}
				}).then(res=>{
					this.pageCount = res.interactList.page.total_pages
					this.interactList = res.interactList.list
				})
			},
			/*
			* 提交评论
			*/
			submitWriteComment(){
				writeComment({
					appid:this.appId,
					courseid:this.infoId,
					interact:this.interact
				}).then(res=>{
					this.currentPage = 1;
					this.interact = "";
					this.getNewsInteract()
				})
				
			},
			/*
			* 新闻点赞
			*/
			praiseInteract(item){
				praiseInteract({
					interactid:item.interactid
				}).then(res=>{
					if(res.errcode == 404){
						this.$showLogin()
					}else{
						if(item.isdz == 1){
							item.isdz = 0
							item.zannumber--
						}else{
							item.isdz = 1
							item.zannumber++
						}
					}
				})
				
			}
			
		},
		mounted() {
			this.getNewsInteract()
		}
	})
	
</script>

<style scoped>
	
	.comment{
		padding: 20px 0 30px 0;
		background: #fff;
		margin-top: 20px;
	}
	.comment-title{
		color: #2D3336;
		font-size: 16px;
		font-weight: 400;
		margin-bottom: 25px;
		text-align: left;
	}
	.comment-title i{
		display: inline-block;
		width:3px;
		height:16px;
		background:rgba(46,132,238,1);
		border-radius:2px;
		margin-bottom: -3px;
		margin-right: 6px;
	}
	.comment-left__btn{
		margin-top: 15px;
	}
	/* 评论 */
	.comment-item{
		width: 100%;
		padding-top: 20px;
		border-bottom: 1px solid #eee;
	}
	.comment-item__left{
		width: 80%;
		display: inline-block;
	}
	.comment-item__left p{
		padding: 14px 0 11px 0;
		font-size: 14px;
		color: #929A9E;
	}
	.comment-item__avatar{
		height: 36px;
	}
	.comment-item__avatar span{
		height: 36px;
		line-height: 36px;
		font-size: 14px;
		color: #2D3336;
		float: left;
		margin-left: 10px;
	}
	.comment-item__avatar .ks-image{
		float: left;
		width: 36px;
		height: 36px;
		border-radius: 50%;
		overflow: hidden;
	}
	.comment-item__right{
		display: inline-block;
		width: 19%;
		text-align: right;
	}
	.comment-item__right img{
		float: right;
		cursor: pointer;
		height: 14px;
		height: 14px;
	}
	.comment-item__right span{
		height: 16px;
		float: right;
		font-size: 14px;
		color: #929A9E;
		
		margin-left: 6px;
	}
</style>
