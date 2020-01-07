<template>
	<view>
	              <view class="question-title">
	                  <view class="question-title__type">{{typeName.replace('题','')}}</view>
	                  <view class="question-title__cont" v-html="title"></view>
	                  
	              </view>
	              <view v-if="is_hearing" style="margin-top:1rem;">
	                  <uni-audio :play.sync="play" id="myAudio" class="success" :src="src+audiofile" style="width:80%;"></uni-audio>
	              </view>
	          </view>
</template>

<script>
	import {UniAudio} from 'components/uni/uni-audio/uni-audio'
	
	export default{
		components:{
			UniAudio
		},
		props:{
		      /**题目类别 */
		      typeName:String,
		      /**题目标题 */
		      title:String,
		      /**是否是听力题 */
		      is_hearing:null,
		      /**听力的路径 */
		      audiofile:String,
			  
		    },
			
			data(){
				return {
					src:'',
					play:false
				}
			},
		
			created() {
				
				this.$store.ready(state=>{
					this.src = state.SRC
				})
			}
	}
</script>

<style scoped>
	 /*题目标题*/
	  .question-title {
	    font-size: 16px;
	    color: #3e4754;
	    line-height: 1.6;
	    display: flex
	  }
	  .question-title__type{
	      display: inline-block;
	      padding:1px 6px;
	      height: 16px;
	      line-height: 16px;
	      font-size: 10px;
	      overflow: hidden;
	      position: relative;
	      top:4px;
	      margin-right: 10px;
	      background: #80c269;
	      border-radius: 20px 20px 0 20px;
	      color:#fff;
	  
	  }
	  .question-title__cont{
	      display: inline-block;
	      flex: 1
	  }
	  .question-title__cont img{
	      max-width:100% !important; 
	  }
</style>
