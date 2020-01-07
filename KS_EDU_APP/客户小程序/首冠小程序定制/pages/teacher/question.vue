<template>
	<view class="content" v-if="loaded">
		<view class="asklist" v-if="asklist.length">
			<view class="ask__item" v-for="(item,i) in asklist" :key="i">
				<ks-image :src="item.userface" type="user" class="img" radius="50px"></ks-image>
				<view class="info">
					<view class="info__con-top clearfix">
						<view class="ask__title">{{item.username}}</view>
						<view class="ask__time">{{item.adddata}}</view>
					</view>
					<view class="info__con-bottom">
						<view class="ask__con">{{item.chatcontent}}</view>
					</view>
				</view>	
			</view>
		</view>
		<ks-empty type="list" v-else>暂无数据</ks-empty>
		<view class="reply-box" :style="'bottom:'+bottomHeight+'px'">
			<input class="uni-input reply-text withe-bg" :adjust-position="false"  @focus="setBottomHeight" @blur="setNoHeight" :focus="false" placeholder="对老师留言..." v-model="content" placeholder-style="color:#B2B2B2;font-size:14px"/>
			<button type="primary" class="reply-button" @click="submit">留言</button>
		</view>
		<view class="bottom-bg"></view>
	</view>
</template>

<script>
	import {GetWordsList,SaveTeacherWords} from '@/api/teacher'
	import UniLoadMore from '@/components/uni/uni-load-more/uni-load-more.vue'
	export default {
		data(){
			return{
				loaded:false,
				asklist:[],
				tcid:0,
				content:'',
				pageindex:1,
				pagesize:10,
				pageCount:0,
				moreStatus:'more',
				isFocus:false,
				bottomHeight:0
			}
		},
		components:{
			UniLoadMore
		},
		onReachBottom(e){
			this.pageindex++
			this.moreList()
		},
		onLoad: function(option) {
			this.tcid = option.tcid
			uni.showLoading({
			    title: '加载中'
			});
			this.loadPage()
		},
		methods: {
			setBottomHeight(e){
				this.isFocus = true
				this.bottomHeight = e.detail.height 
			},
			setNoHeight(){
				this.isFocus = false
				this.bottomHeight = 0
			},
			moreList(){
				if(this.getParameters.pageindex > this.pageCount){
					this.moreStatus = 'noMore'
				}else{
					this.moreStatus = 'loading'
					this.loadPage('more')
				}
			},
			loadPage(status){
				if(status=='more'){
					GetWordsList({
						tcid:this.tcid,
						pageindex:this.pageindex,
						pagesize:this.pagesize
					}).then(res=>{
						this.moreStatus = 'more'
						if(res.result){
							this.asklist = this.asklist.concat(res.data)
						}
						this.loaded = true
					})
				}else{
					this.pageindex = 1
					GetWordsList({
						tcid:this.tcid,
						pageindex:this.pageindex,
						pagesize:this.pagesize
					}).then(res=>{
						if(res.result){
							this.pageCount = res.pageCount
							if(this.pageCount==1){
								this.moreStatus = 'noMore'
							}else{
								this.moreStatus = 'more'
							}
							this.asklist = res.data
						}else{
							this.asklist = []
						}
						this.loaded = true
						uni.hideLoading();
					})
				}
			},
			submit(){
				uni.showLoading({
				    title: '正在提交中'
				});
				SaveTeacherWords({
					tcid:this.tcid,
					content:this.content
				}).then(res=>{
					uni.hideLoading();
					if(res.result){
						uni.showToast({
						    title: '提交成功',
						    duration: 2000,
							icon:'none'
						});
						this.loadPage()
						this.content = ''
					}else{
						uni.showToast({
						    title: res.msg,
						    duration: 2000,
							icon:'none'
						});
					}
				})
			}
		}
	}
</script>

<style lang="scss" scoped>
	page {
	  background-color:#fff;
	}
	.asklist{
		padding:10px;
		.ask__item{
			position: relative;
			padding-left: 60px;
			padding-bottom: 10px;
			border-bottom: 1px solid #eee;
			margin-bottom: 10px;
			.img{
				width: 50px;
				height: 50px;
				border-radius: 50px;
				position:absolute;
				left: 0;
				top:0;
			}
			.info{
				.info__con-top{
					font-size: 14px;
					padding-top: 20px;
					line-height: 14px;
					.ask__title{
						float: left;
					}
					.ask__time{
						float: right;
						color: #999;
					}
				}
				.info__con-bottom{
					margin-top: 10px;
					.ask__con{
						font-size: 14px;
					}
				}
			}
		}
	}
	
	.reply-box{
		background: #F7F7F7;
		position: fixed;
		width: 100%;
		left: 0;
		bottom: 0px;
		padding: 5px 10px;
		height: 46px;
		box-sizing:border-box;
		-webkit-transition: .2s;
		-o-transition: .2s;
		transition: .2s;
		z-index: 101;
		uni-button{
			background: #ff663d;
			font-size: 16px;
		}
		.reply-button{
			display: inline-block;
			width: 20%;
			height: 36px;
			line-height: 36px;
			font-size: 14px;
			background: #ff663d;
			vertical-align:middle;
		}
		.reply-text{
			height: 36px;
			display: inline-block;
			width: 77%;
			margin-right: 3%;
			padding: 5px 10px;
			border: 1px solid #eee;
			box-sizing: border-box;
			border-radius: 3px;
			vertical-align:middle;
			font-size: 14px;
		}
	}
	
</style>
