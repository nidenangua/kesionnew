<template>
	<view class="content withe-bg" v-if="loaded">
		<view class="evaluation-top">
			<view class="title">
				评价{{tname}}
			</view>
			<view class="tips">
				购买过该教师课程的学员才可以评价
			</view>
			<view class="star-box clearfix">
				<view class="score">综合评分</view>
				<sunui-star :defaultStar="starConfig.defaultStar" :maxStar="starConfig.maxStar" :starSize='starConfig.starSize'
				 @changeStar="changeStar" class='sunui-star' />
			</view>
		</view>
		<view class="evaluation-bottom">
			<view class="evaluation__textarea">
				<textarea placeholder-style="color:#B2B2B2" maxlength="500" placeholder="把您的评价或者建议写给老师吧~" @input="conInput"/>
			</view>
			<button type="primary" class="evaluation__btn" @click="submit">发表</button>
		</view>
	</view>
</template>

<script>
	import {SaveTeacherEvaluate} from '@/api/teacher'
	import SunuiStar from '@/components/uni/sunui-star/sunui-star.vue'
	export default {
		data(){
			return{
				loaded:false,
				evaluationData:{},
				starConfig: {
					defaultStar: 0,
					maxStar: 5,
					starSize: '1em',
					isTips: true,
				},
				form:{
					tcid:0,
					content:'',
					star:'',
					type:1
				},
				tname:''
			}
		},
		components:{
			SunuiStar
		},
		onLoad: function(option) {
			console.log(option.tcid)
			this.form.tcid = option.tcid
			this.tname = option.tname
			this.loaded = true
		},
		methods: {
			conInput(e){
				this.form.content = e.detail.value
			},
			changeStar(e){
				this.form.star = e.curStar
			},
			submit(){
				uni.showLoading({
				    title: '正在提交中'
				});
				SaveTeacherEvaluate(this.form).then(res=>{
					uni.hideLoading();
					if(res.result){
						uni.showToast({
						    title: '评价成功',
						    duration: 1500,
							icon:'none'
						});
						setTimeout(function () {
						    uni.navigateBack()
						}, 1500);
					}else{
						uni.showToast({
						    title: res.msg,
						    duration: 1500,
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
	  background-color:#fff !important;
	}
	.evaluation-top{
		padding: 10px;
		.title{
			font-size: 16px;
			color: #1A1A1A;
			margin-bottom: 10px;
		}
		.tips{
			font-size: 14px;
			line-height: 14px;
			color: #ccc;
			padding: 10px 0;
			border-bottom: 1px solid #eee;
			margin-bottom: 10px;
		}
		.star-box{
			.score{
				font-size: 16px;
				color:#1A1A1A;
				float: left;
			}
			.sunui-star{
				float: right;
				width: 50%;
			}
		}
	}
	.evaluation-bottom{
		padding:0 10px 10px;
		.evaluation__textarea{
			border:1px solid #eee;
			padding: 10px;
			border-radius: 5px;
			height: 300px;
			margin-bottom: 30px;
			uni-textarea{
				width: 100%;
			}
			textarea{
				font-size: 14px;
			}
		}
		.evaluation__btn{
			background: #2987EE;
		}
	}
</style>
