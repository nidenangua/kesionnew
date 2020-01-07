<template>
	<view class="content">
		<ks-cell-group>
			<ks-cell show-arrow :label="pickerText.label"  @click="showPicker" style="line-height: 44px !important;height: 44px !important;font-size: 14px !important;"></ks-cell>
		</ks-cell-group>
		<view class="topic-textarea withe-bg" style="margin-top: 10px;">
			<textarea placeholder-style="color:#B2B2B2" maxlength="500" placeholder="请在此留下你的宝贵意见~" @input="conInput"/>
			<view class="tips-num">
				{{remainingNum}}
			</view>
		</view>
		
		<view class="join">
			<button type="primary" class="topic-btn" @click="submit">提交</button>
		</view>
		<mpvue-picker :themeColor="themeColor" ref="mpvuePicker" mode="selector" :deepLength="1" :pickerValueDefault="pickerValueDefault"
		         @onConfirm="onConfirm" :pickerValueArray="pickerValueArray"></mpvue-picker>
	</view>
</template>

<script>
	import {Pasttrial} from '@/api/user'
	import {MpvuePicker} from 'components/uni/mpvue-picker/mpvue-picker'
	export default {
		components:{
			MpvuePicker
		},
		data(){
			return{
				content:'',
				fontNum:500,
				remainingNum:500,
				state:{},
				themeColor: '#007AFF',
				pickerValueDefault:[1],
				pickerValueArray:[
					{
						label: '建议反馈',
				        value: 0,
					},{
						label: '违法违规举报',
				        value: 1,
				}],
				pickerText:{
					label:'建议反馈',
					value:[0]
				},
			}
		},
		onLoad: function() {
			this.$store.ready(state=>{
				this.state = state
			})
		},
		
		methods: {
			onConfirm(e) {
			    this.pickerText = e
			},
			conInput(e){
				this.content = e.detail.value
				this.remainingNum = this.fontNum-this.content.length;
			},

			showPicker(){
				this.$refs.mpvuePicker.show()
			},
			submit(){
			
				if(this.content){
					uni.showLoading({
						title: '正在提交中'
					});
					Pasttrial({
						content:this.content
					}).then(res=>{
						uni.hideLoading();
						if(res.result){
							uni.showToast({
								title:'提交成功',
								duration: 2000,
								icon:'none'
							});	
						}else{
							uni.showToast({
								title: res.msg,
								duration: 2000,
								icon:'none'
							});
						}
					})
					
				}else{
					uni.showToast({
					    title: '请输入内容',
					    duration: 2000,
						icon:'none'
					});
				}
			}	
		}
	}
</script>

<style lang="scss" scoped>
	
	.topic-textarea{
		textarea{
			height: 150px;
			width: 100%;
			padding: 12px;
			box-sizing: border-box;
			font-size: 14px;
		}
		.tips-num{
			font-size: 12px;
			color: #CCCCCC;
			text-align: right;
			padding: 10px 12px;
		}
	}
	.overhide{
		overflow: hidden;
		.topic-img{
			padding: 15px 12px 5px;
			border-top:1px solid #eee;
			margin-right: -10px;
			.topic-img-list{
				    
				.uped-img{
					float: left;
					width:109px ;
					height: 109px;
					position:relative;
					margin-right: 10px;
					margin-bottom: 10px;
					.ks-image{
						height: 100%;
						width: 100%;
					}
					.close-icon{
						position: absolute;
						right: 0;
						top:0;
						z-index: 1;
						color: #fff;
						
						background-color: rgba(0, 0, 0, 0.5);
						background-size: 18px;
						width: 20px;
						height: 20px;
					}
				}
			}
			.up-img{
				width: 109px;
				height: 109px;
				float: left;
				text-align: center;
				color: #C7CBD1;
				font-size: 12px;
				padding-top: 67px;
				box-sizing: border-box;
	
				background-size: 30px;
				margin-bottom: 10px;
			}
			
		}
	}
	
	.join{
		
		width: 100%;
		margin-top: 20px;
		padding: 5px 10px;
		box-sizing:border-box;
		.topic-btn{
			background: #2987EE;
		}
	}
	.join-bg{
		height: 56px;
	}
	.ks-cell{
		line-height: 44px !important;
		height: 44px !important;
	}
</style>
