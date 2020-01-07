<template>
	<div class="ks-course-exam" style="background: #fff;">
		<div class="ks-alert ks-alert--warning" style="margin-bottom:10px;font-size: 12px;">你需要购买课程才能参与考试！</div>
		<div v-for="(item,i) in list" :key="i" :class="item.AllowExam && HasCoursePower ? '' : 'ks-course-exam__item--disabled'" class="ks-course-exam__item "
		 @click="open(item.AllowExam && HasCoursePower ? item.PaperID : '')">
			<div class="ks-button ks-button--mini" v-if="item.AllowExam && HasCoursePower">做题</div>
			<image class="ks-course-exam__lock" :src="baseUrl+'/static/images/common/lock.png'" v-else></image>
			<div class="ks-course-exam__name">
				{{item.PaperTitle}}
			</div>
		</div>
		<ks-empty type="tips" v-if="list.length==0">没有找到任何试卷！</ks-empty>
	</div>
</template>

<script>
	import {GetPaper} from 'api/course'
	export default {
		props: {
			courseId:Number
		},
		data() {
			return {
				baseUrl:this.$store.state.SRC+"/config/app",
				list:[],
				hasCoursePower:false
			}
		},
		methods: {
			open(id) {
				if (id) {
					uni.navigateTo({
						url:'/pages/exam/paperinfo?paperid='+id
					})
				}

			}
		},
		mounted() {
			this.$store.ready(state=>{
				GetPaper({
					courseid:this.courseId,
					schoolid:state.schoolId,
				}).then(res=>{
					if(res.result){
						this.hasCoursePower = res.HasCoursePower
						this.list = res.Paperlist
					}
				})
			})
			
		}
	}
</script>

<style scoped>
	/*课程考试*/

	.ks-course-exam__item {
		padding: 10px 15px;
		cursor: pointer;
	}

	.ks-course-exam__item+.ks-course-exam__item {
		border-top: 1px solid #eee;
	}

	.ks-course-exam__item .ks-button {
		float: right;
		margin-left: 10px;
	}

	.ks-course-data__item:hover,
	.ks-course-exam__item:hover {
		background: #e6f0fd;
	}

	.ks-course-exam__name {
		line-height: 28px;
		font-size: 14px;
		max-height: 28px;
		overflow: hidden;
		white-space: nowrap;
		text-overflow: ellipsis;
	}

	.ks-course-exam__alert {
		color: #e6a23c;
	}

	.ks-course-exam__lock {
		width: 16px;
		height: 16px;
		
		background-size: contain;
		float: right;
		position: relative;
		top: 6px;
	}

	.ks-course-exam__item--disabled {
		color: #999;
		cursor: default;
	}

	.ks-course-exam__item--disabled:hover {
		background: none;
	}
	
	.ks-button{
		    display: inline-block;
		    line-height: 1;
		    white-space: nowrap;
		    cursor: pointer;
		    background: #fff;
		    border: 1px solid #dcdfe6;
		    color: #606266;
		    -webkit-appearance: none;
		    text-align: center;
		    box-sizing: border-box;
		    outline: none;
		    margin: 0;
		    transition: .1s;
		    font-weight: 500;
		    -moz-user-select: none;
		    -webkit-user-select: none;
		    -ms-user-select: none;
		    padding: 12px 20px;
		    font-size: 14px;
		    border-radius: 4px;
	}
	.ks-button--mini {
	    padding: 7px 15px;
	    font-size: 12px;
	    border-radius: 3px;
		cursor: pointer;
	}
</style>
