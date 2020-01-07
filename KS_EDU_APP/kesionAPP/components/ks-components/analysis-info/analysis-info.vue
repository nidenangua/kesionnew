<template>
	<div class="analysis-info">
	        <div v-if="item.tktype != 1">
	          <div class="analysis-info__title">参考答案</div>
	          <div class="analysis-info__content" v-if="item.tkinfo">
	            <div v-if="item.tktype == 5">
	              <p v-for="(ans,a) in item.tkinfo.answer" :key="a">({{a+1}}) &nbsp; {{ans}}</p>
	            </div>
	            <div v-else>{{getReferenceAnswer(item.tktype,item.tkinfo)}}</div>
	          </div>
	          <div class="analysis-info__title">你的答案</div>
	          <div class="analysis-info__content">
	            <div v-if="item.tktype == 5">
	              <p v-for="(ans,a) in item.useranswer" :key="a">({{a+1}}) &nbsp; {{ans ? ans : '未填写答案'}}</p>
	            </div>
	            <div v-else>{{getAnswer(item.useranswer,item.tktype,item.tkinfo)}}</div>
	          </div>
	        </div>
	        <div v-else>
	          <div class="analysis-info__title">参考答案</div>
	          <div class="analysis-info__content" v-if="item.tkinfo">
	            <span v-html="getReferenceAnswer(item.tktype,item.tkinfo)"></span>
	          </div>
	          <div class="analysis-info__title">你的答案</div>
	          <div class="analysis-info__content">
	            {{getAnswer(item.useranswer,item.tktype)}}
	          </div>
	          <div v-if="item.keywords&&item.keywords.length">
	            <div class="analysis-info__title">关键词</div>
	            <div class="analysis-info__content">
	              <p v-for="(keys,k) in item.keywords" :key="k">{{keys}}</p>
	            </div>
	          </div>
	        </div>
	        <div class="analysis-info__title">题目解析</div>
	        <div class="analysis-info__content" v-if="item.tkinfo" v-html="item.tkinfo.analysis || '暂无解析'"></div>
	        <div class="analyze-box f14 mt10" v-if="item.tkinfo.analysis_videofile || item.analysis_videofile">
	            <div class="analysis-info__title">视频解析</div>
				<!-- #ifdef APP-PLUS -->
				<div style="height: 60vw;width:100%;background: #000;margin: 10px 0;display: flex;justify-content: center;align-items: center;">
					<video style="width: 100%;height: 100%;"  @fullscreenchange="fullscreenchange" @play="plays" id="myVideo" ref="myVideo" controls class="analysis-video" :src="src+item.tkinfo.analysis_videofile" v-if="item.tkinfo.analysis_videofile&&show">
					</video>
					<video style="width: 100%;height: 100%;" @fullscreenchange="fullscreenchange" @play="plays" id="myVideo" ref="myVideo" controls class="analysis-video" :src="src+item.analysis_videofile" v-else-if="item.analysis_videofile&&show">
					</video>
					<image style="width: 50px;height: 50px;" v-if="!show" @click="playVideo" :src="baseUrl+'/static/images/common/play.png'"></image>
				</div>
				<!-- #endif -->
				<!-- #ifdef MP-WEIXIN -->
	          
	            <div style="height: 60vw;width:100%;background: #000;margin: 10px 0;display: flex;justify-content: center;align-items: center;">
	            	<video style="width: 100%;height: 100%;"  id="myVideo" ref="myVideo" controls class="analysis-video" :src="src+item.tkinfo.analysis_videofile" v-if="item.tkinfo.analysis_videofile">
	            	</video>
	            	<video style="width: 100%;height: 100%;"  id="myVideo" ref="myVideo" controls class="analysis-video" :src="src+item.analysis_videofile" v-else-if="item.analysis_videofile">
	            	</video>
	            	
	            </div>
				<!-- #endif -->
	        </div>
	        <div class="analyze-box f14 mt10" v-if="item.hearing_text">
	            <div class="analysis-info__title">听力原文</div>
	            <div class="analysis-info__content" v-html="item.hearing_text"></div>
	        </div>
	        <div class="analyze-box f14 mt10" v-if="item.tkinfo.audiofile || item.audiofile">
	            <div class="analysis-info__title">听力音频</div>
				<div style="margin: 10px 0;">
					<uni-audio class="success" :play.sync="playAudio"  :src="src+item.tkinfo.audiofile" v-if="item.tkinfo.audiofile" ></uni-audio>
					<uni-audio class="success" :play.sync="playAudio" :src="src+item.tkinfo.audiofile" v-else-if="item.audiofile" ></uni-audio>
				</div>
	            
				
	        </div>
	        <div class="analyze-box f14 mt10" v-if="item.course_list&&item.course_list.length">
	            <div class="analysis-info__title">关联课程</div>
	            <div class="analysis-info__content">
	              <text @click="open(citem)" class="green-font underline mr20" v-for="citem in item.course_list" :key="citem.courseid">{{citem.name}}</text>
	            </div>
	        </div>
	        <div class="analyze-box f14 mt10" v-if="item.comment">
	            <div class="analysis-info__title">教师评语</div>
	            <div class="analysis-info__content">{{item.comment}}</div>
	        </div>
	        <div v-if="((routers.type == 1||routers.name == 'TestPage') && (item.tktype==1||item.tktype==3||item.tktype==5)) && item.score_rule" class="score_rule">
	            评分规则：
	            <div class="analysis-info__content">
	              {{item.score_rule.ruletype_name}}
	              <span v-if="item.score_rule.rule_type == 1||item.score_rule.rule_type == 4||item.score_rule.rule_type == 7">
	                  <span v-for="(citem,c) in item.score_rule.option_list" :key="c" class="mr10">{{citem.option}}(<font>{{citem.score}}分</font>)</span>
	              </span>
	              <span v-else-if="item.score_rule.rule_type == 2||item.score_rule.rule_type == 5||item.score_rule.rule_type == 6">
	                  <span v-if="item.score_rule.average_score">{{item.score_rule.average_score}}分</span>
	              </span>
	            </div>
	        </div>
	      </div>
</template>

<script>
	import {UniAudio} from 'components/uni/uni-audio/uni-audio'
	import Utils from 'utils/index.js'
	export default {
		components:{
			UniAudio
		},
		props: {
			routers:{
				type:Object,
				default(){
					return {}
				}
			},
		      /**题目对象 */
		      item: {
				  type:Object,
				  default(){
				  	return {}
				  }
			  },
		  
		      /**父级id */
		      parenttkid: 0
		    },
		    data: function() {
		      return {
				  baseUrl:this.$store.state.SRC+"/config/app",
		        isShowOpera: false,
				src:'',
				playAudio:false,
				show:false,
				videoContext:''
		      };
		    },
		    methods: {
				fullscreenchange(e){
				
					if(!e.detail.fullScreen){
						this.show = false
						console.log(this.show)
					}
				},
				playVideo(){
					this.videoContext.requestFullScreen()
					this.videoContext.play()
					this.show = true
					
				},
				plays(){
					
					this.videoContext.requestFullScreen()
					
					
				},
		      showVideo: function() {
		        this.isShowOpera = this.isShowOpera ? false : true;
		      },
		      open:function(item){
				  uni.navigateTo({
				  	url:'/pages/web/web?title='+item.name+'&url='+encodeURIComponent('/course/'+item.courseid)
				  })
		      },
		      /**
		       * 答案内容过滤
		       */
		      getAnswer: function(val, tktype) {
		        var tkinfo = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : {};
		        var _val = val.toString();
		        if (_val === "") {
		          return "无";
		        } else if (tktype == 2 || tktype == 3) {
		          return val.join();
		        } else if (tktype == 4) {
		          return _val === "1" ? "A" : "B";
		        } else {
		          return _val;
		        }
		      },
		  
		      /**
		       * 获取参考答案
		       */
		      getReferenceAnswer: function (tktype, tkinfo) {
		        var _this = this;
		  
		        if (tktype == 2 || tktype == 3) {
		          var answer = [];
		          tkinfo.answer.map(function (letter) {
		            var index;
		  
		            if (!_this.parenttkid) {
		              if (tkinfo.real_answer && tkinfo.real_answer.length) {
		                index = tkinfo.real_answer.indexOf(letter);
		                answer.push(Utils.getLetter(index));
		              }
		            } else {
		              answer = tkinfo.answer;
		            }
		          });
		          return answer.toString();
		        }
		  
		        if (tktype == 4) {
		          return tkinfo.answer.toString() === "1" ? "A" : "B";
		        } else {
		          return tkinfo.answer.toString();
		        }
		      }
		    },
			created() {
				this.$store.ready(state=>{
					this.src = state.SRC
				})
			},
			mounted() {
				this.videoContext = uni.createVideoContext('myVideo', this)
			}
	}
</script>

<style scoped>
	 /*题目解析*/
	 .analysis-info {
	    padding: 15px;
	    border-radius: 4px;
	    margin-top: 15px;
	    background: #f9f9f9;
	  }
	  .analysis-info__title {
	    font-size: 14px;
	  }
	  .analysis-info__content {
	    font-size: 14px;
	    color: #999;
	    padding: 5px 0 10px 0;
	    line-height: 22px;
	    border-radius: 4px;
	  }
	  .analysis-info .score_rule{
	    font-size: 14px;
	  }
	  .audiofile-btn{
	    border: 0.05rem solid #2987EE;
	    color: #2987EE;
	    padding: 0 0.5rem;
	    line-height: 1rem;
	    height: 1rem;
	    border-radius: 1rem;
	    display: inline-block;
	  }
	  .analysis-info .underline{
	    text-decoration: underline;
	  }
	  .analysis-video,.success{
	    margin: 0.5rem 0;
	  }
	  .analysis-info .mr10{
	    margin-right:0.5rem;
	  }
</style>
