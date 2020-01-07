<template>
	<view class="content" v-if="loaded">
		<view class="form-item withe-bg">
			<view class="item-cell-left">
				选择分类
			</view>
			<view class="item-cell-db" :style="'background: url('+baseUrl+'/static/images/index/common_icon_more@2x.png) no-repeat center right;background-size: 15px 15px;'">
				<picker :range="array" @change="bindPickerChange" @cancel="cancelSelect" :value="indexArr" mode="multiSelector" @columnchange="getColValue">
					<view v-if="!isSelect">请选择分类</view>
					<view v-else>
						<text>{{array[0][index]}}</text>
						<text v-if="array[1][index2]">—{{array[1][index2]}}</text>
						<text v-if="array[2][index3]">—{{array[2][index3]}}</text>
					</view>
				</picker>
			</view>
		</view>
		<view class="form-item-textarea withe-bg mt10">
			<view class="item-textarea-label">
				问题内容
			</view>
			<view class="item-textarea-box">
				<textarea placeholder-style="color:#B2B2B2" placeholder="请输入你的问题~最多只能输入255个字" maxlength="255"  v-model="form.title"/>
				<!-- <button type="primary" plain="true" class="add-ask">添加问题补充</button> -->
			</view>
		</view>
		<view class="form-item withe-bg mt10">
			<view class="item-cell-left">
				悬赏分
			</view>
			<view class="item-cell-db" :style="'background: url('+baseUrl+'/static/images/index/common_icon_more@2x.png) no-repeat center right;background-size: 15px 15px;'">
				<picker @change="bindScoreChange" :value="index" :range="scoreArray">
					<view class="uni-input">{{scoreArray[scoreIndex]}}</view>
				</picker>
			</view>
		</view>
		<view class="item-button">
			<button type="primary" class="mt10 submit" @click="submit">提交问题</button>
		</view>
	</view>
</template>

<script>
	import {GetAskClass,PublishAskTopic} from '@/api/class-center'
	export default {
		data(){
			return{
				baseUrl:this.$store.state.SRC+"/config/app",
				loaded:false,
				classList:[],//一级分类
				secondArrData:[],//二级分类
				isSelect:false,
				array: [
					[],
					[],
					[]
				],
				indexArr:[0,0,0],
				index: 0,
				index2: 0,
				index3: 0,
				scoreArray:['无悬赏分','1分','5分','10分','15分','20分','30分','50分','80分','100分'],
				scoreIndex:0,
				askData:{},
				code:'',
				getParameters:{
					topicId:0
				},
				form:{
					title:'',
					classid:'0',
					reward:'',
				},
				pageCount:0,
				moreStatus:'more',
			}
		},
		onLoad: function(option) {
			this.getParameters.topicId = option.topicid
			uni.showLoading({
			    title: '加载中'
			});
			this.loadPage()
		},
		methods: {
			bindPickerChange(e) {
				this.isSelect = true
				if(this.classList[e.detail.value[0]].childList.length){
					if(this.classList[e.detail.value[0]].childList[e.detail.value[1]].childList.length){
						this.form.classid = this.classList[e.detail.value[0]].childList[e.detail.value[1]].childList[e.detail.value[2]].classID
					}else{
						this.form.classid = this.classList[e.detail.value[0]].childList[e.detail.value[1]].classID
					}
				}else{
					this.form.classid = this.classList[e.detail.value[0]].classID
				}
			},
			getColValue(e){
				
				let secondArr = []
				if(e.detail.column==0){
					this.index = e.detail.value
					if(this.classList[e.detail.value].childList.length){
						let secondArrData = []
						this.classList[e.detail.value].childList.map(item=>{
							secondArr.push(item.className)
							secondArrData.push(item)
						})
						this.secondArrData = secondArrData
						this.array[1] = secondArr
						if(secondArrData[0].childList.length){
							let thridArr = []
							secondArrData[0].childList.map(item=>{
								thridArr.push(item.className)
							})
							this.array[2] = thridArr
						}else{
							this.array[2] = []
						}
						
					}
				}else if(e.detail.column==1){
					let secondArrData = []
					this.classList[0].childList.map(item=>{
						secondArrData.push(item)
					})
					this.secondArrData = secondArrData
					this.index2 = e.detail.value
					if(this.secondArrData[e.detail.value].childList.length){
						let thridArr = []
						this.secondArrData[e.detail.value].childList.map(item=>{
							thridArr.push(item.className)
						})
						this.array[2] = thridArr
					}else{
						this.array[2] = []
					}
				}else{
					this.index3 = e.detail.value
				}
				
				
			},
			cancelSelect(){
				this.isSelect=false
				this.form.classid = '0'
				this.index = 0
				this.index2 = 0
				this.index3 = 0
				this.indexArr = [0,0,0]
			},
			bindScoreChange(e){
				this.scoreIndex = e.target.value
				let scoreValue = this.scoreArray[e.target.value]
				if(scoreValue=='无悬赏分'){
					this.form.reward = 0
				}else{
					this.form.reward = Number(scoreValue.split('分')[0])
				}
			},
			moreList(){
				if(this.getParameters.pageindex > this.pageCount){
					this.moreStatus = 'noMore'
				}else{
					this.moreStatus = 'loading'
					this.loadPage('more')
				}
				
			},
			loadPage(){
				GetAskClass({}).then(res=>{
					if(res.result){
						this.classList = res.data
						let firstArr = []
						res.data.map(item=>{
							firstArr.push(item.className)
						})
						this.array[0] = firstArr
						if(this.classList[0].childList.length){
							let secondArr = []
							this.classList[0].childList.map(item=>{
								secondArr.push(item.className)
							})
							this.array[1] = secondArr
							if(this.classList[0].childList[0].childList.length){
								let thridArr = []
								this.classList[0].childList[0].childList.map(item=>{
									thridArr.push(item.className)
								})
								this.array[2] = thridArr
							}
						}
					}else{
						this.classList = []
						this.array[0] = []
					}
					this.loaded = true
					uni.hideLoading();
				})
			},
			submit(){
				if(this.form.title){
					uni.showLoading({
					    title: '正在提交中'
					});
					PublishAskTopic(this.form).then(res=>{
						uni.hideLoading();
						if(res.result){
							this.isReply = false
							uni.showToast({
							    title: '问题提交成功',
							    duration: 1000,
								icon:'none',
							});
							setTimeout(()=>{
								uni.navigateBack()
							}, 1000);
						}else{
							this.isReply = false
							uni.showToast({
							    title: res.msg,
							    duration: 1000,
								icon:'none'
							});
						}
					})
				}else{
					uni.showToast({
					    title: '请输入问题内容',
					    duration: 1000,
						icon:'none'
					});
				}
			}
		}
	}
</script>

<style lang="scss" scoped>
	.form-item{
		position: relative;
		display: -webkit-box;
		display: -webkit-flex;
		display: -ms-flexbox;
		display: flex;
		-webkit-box-orient: horizontal;
		-webkit-box-direction: normal;
		-webkit-flex-direction: row;
		-ms-flex-direction: row;
		flex-direction: row;
		-webkit-box-pack: justify;
		-webkit-justify-content: space-between;
		-ms-flex-pack: justify;
		justify-content: space-between;
		-webkit-box-align: center;
		-webkit-align-items: center;
		-ms-flex-align: center;
		align-items: center;
		padding-right: 13px;
		line-height: 49px;
		.item-cell-left{
			font-size: 15px;
			padding: 0 15px;
			color: #1A1A1A;
		}
		.item-cell-db,.item-cell-code{
		    -webkit-box-flex: 1;
		    -webkit-flex: 1;
		    -ms-flex: 1;
		    flex: 1;
			font-size: 14px;
		}
		.item-cell-db{
			padding-right:30px ;
			
			background-size: 15px 15px;
			text-align: right;
		}
		.item-cell-code{
			text-align: left;
			.uni-input{
				font-size: 14px;
			}
		}
		
	}
	.form-item-textarea{
		padding-top: 10px;
		.item-textarea-label{
			font-size: 15px;
			padding: 0 15px;
			color: #1A1A1A;
		}
		.item-textarea-box{
			padding: 15px;
			uni-textarea,textarea{
				width: 100%;
				border: 1px solid #E1E3E6;
				padding: 10px;
				box-sizing: border-box;
				border-radius: 2px;
				margin-bottom: 15px;
				font-size: 14px;
			}
			.add-ask{
				height: 28px;
				font-size: 13px;
				line-height: 28px;
				display: inline-block;
				border-radius: 2px;
			}
		}
	}
	.item-button{
		padding: 30px 15px;
		.submit{
			background: #2987EE;
		}
	}
	
</style>