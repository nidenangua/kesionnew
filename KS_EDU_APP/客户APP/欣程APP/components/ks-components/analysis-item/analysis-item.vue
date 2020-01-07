<template>
	<div class="analysis-item">
	                <question-title :title="item.title" :type-name="item.tktype_name" v-if="level === 1" />
	                <div class="analysis-item__title" v-else>{{number}}、<font v-html="item.title"></font></div>
	                <div class="analysis-item__body" v-if="item.tktype != 6">
	                  <!--主观题-->
	                  <div class="analysis-subjective" v-if="item.tktype == 1">{{item.useranswer}}</div>
	                  <!--单选、多选、判断题-->
	                  <multiple-choice
	                    :item="item"
	                    :user-answer="item.useranswer"
	                    v-else-if="item.tktype == 2 || item.tktype == 3 || item.tktype == 4"
	                  />
	                  <!--注：填空题回答内容放于解析内-->
	                  <div class="analysis-score" v-if="$route.query.type != 2 && $route.name != 'OwnScore'">
	                    得分：
	                    <span
	                      class="uncorrected"
	                      v-if="iscorrect === '0' && (item.tktype == 1 || item.tktype == 5)"
	                    >待批阅</span>
	                    <span class="uncorrected" v-else>{{item.userscore}}</span>
	                  </div>
	                  <div class="analysis-score" v-else-if="$route.query.type != 2">
	                    得分：
	                    <span class="uncorrected">{{item.userscore}}</span>
	                  </div>
	                  <analysis-info :routers="routers" :item="item" :parenttkid="parenttkid"/>
	                </div>
	              </div>
</template>

<script>
	
	import {QuestionTitle} from 'components/ks-components/question-title/question-title'
	import {MultipleChoice} from 'components/ks-components/multiple-choice/multiple-choice'
	import {AnalysisInfo} from 'components/ks-components/analysis-info/analysis-info'
	export default{
		components:{
			QuestionTitle,
			MultipleChoice,
			AnalysisInfo
		},
		props: {
				routers:Object,
		      /**解析题目对象 */
		      item: Object,
		  
		      /**序号 */
		      number: String,
		  
		      /**阅卷状态 0未阅卷 1已批卷 */
		      iscorrect: {
		        type: [String, Number],
		        default: "0"
		      },
		  
		      /**题目等级，1大题，2组合题小题 */
		      level: Number,
		  
		      /**大题id */
		      parenttkid: 0,
			
		 }
	}
</script>

<style scoped>
	 /*题目解析项*/
	  .analysis-item {
	    padding:15px 0
	  }
	  .analysis-item__title {
	    font-size: 14px;
	    color: #3e4754;
	    line-height: 24px;
	    
	  }
	  .analysis-item__body {
	    padding-top: 15px;
	  }
	  .analysis-subjective {
	    border: 1px solid #e6e6e6;
	    padding: 12px;
	    border-radius: 4px;
	    font-size: 14px;
	    height: 200px;
	    overflow-x: hidden;
	    overflow-y: auto;
	    -webkit-overflow-scrolling: touch;
	  }
	  .analysis-subjective,
	  .analysis-fill-blank {
	    color: #666;
	  }
	  .analysis-fill-blank {
	    line-height: 24px;
	    font-size: 14px;
	  }
	  .analysis-fill-blank p {
	    padding-top: 5px;
	  }
	  
	  .analysis-score {
	    line-height: 34px;
	    margin-top: 15px;
	    font-size: 14px;
	  }
	  .analysis-item .uncorrected {
	    color: #2987EE;
	  }
</style>
