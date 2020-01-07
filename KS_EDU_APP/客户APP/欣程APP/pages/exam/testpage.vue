<template>
<view>
  <view class="paper" :class="(showPaperCorrection||cardVisabled)?'no-scroll':''" :style="{minHeight:windowHeight+'px'}" v-if="loaded">
	
    <view v-if="query.type == 6 && dateInfoList[currentData] && dateInfoList[currentData].is_test">

			<paper-medal :value="dateInfoList[currentData].testdata.zhunquelv" unit="%" name="正确率"></paper-medal>
			<view class="paper-opear2 clearfix">
			  <view class="paper-opear2__right">
			    <view class="paper-icon-sign paper-icon-sign--color5">
			      <i></i>正确{{dateInfoList[currentData].testdata.success_tknum}}道题
			    </view>
			    <view class="paper-icon-sign paper-icon-sign--color2">
			      <i></i>错误{{dateInfoList[currentData].testdata.error_num}}道题
			    </view>
			  </view>
			</view>
			<view class="paper-contianer" >
			    <p>本次共练习<font class="green-font">{{dateInfoList[currentData].testdata.tk_num}}</font>道题</p>
			    <p>做题时间：<font class="red-font">{{dateInfoList[currentData].testdata.adddate}}</font></p>
			    <p>练习用时：<font class="red-font">{{testUseTime}}</font></p> 
			</view>
		
      
    </view>
    <view v-else>
      <view class="paper-header ktj-line">
        <view class="paper-header__second">{{time}} &nbsp; &nbsp; {{pageTuning}}/{{recode.length}}</view>
        <view class="paper-header__card" @click="sheetclick">
          <image :src="baseUrl+'/static/images/exam/exam_card.png'">
        </view>
        <view class="paper-header-sumbit paper-header-save" v-if="is_saveanswer==1" @click="save(2)">保存</view>
        <view class="paper-header-sumbit" @click="save">交卷</view>
      </view>
      <view class="paper-contianer" v-if="paperTkList.length" :class="(is_righttfStatu&&is_righttf==1)&&'dont_copy'">
        <transition name="fade">
          <view class="paper-slide-tips" v-if="showPaperSlideTips">
            <view class="paper-slide-tips__inner">
              <image :src="baseUrl+'/static/images/exam/icon-slide.png'" />
              滑动切换上下题
              <button @click="iKnow">我知道啦</button>
            </view>
          </view>
        </transition>
        <transition name="fade">
          <view class="paper-slide-tips" style="position: fixed;" v-if="showPaperCorrection && showClass">
            <view class="paper-slide-tips__inner correction-con">
                <image :src="baseUrl+'/static/images/exam/close2.png'" class="correction-close" @click="closePaperCorrection()">
                <view class="correction-box">
                  <h3>题目纠错</h3>
                  <p>一直在完善，从未停歇过，但有些题目可能仍然存在瑕疵，对您造成的不便我们深表歉意！</p>
                  <p>您纠错的题目ID:{{correctionid}}</p>
                </view>
                <view class="correction-option">
                  <p>为方便我们排查错误，请您详细描述本题错误，例如：</p>
                  
				  <radio-group @change="radioChange">
				                  <label  style="color:#323233;display: inline-block;margin-right: 20px;font-size: 14px;" v-for="item in radioOption" :key="item.id">
				                      <view>
				                          <radio :value="item.id" style="transform:scale(0.7)"></radio>
										  <text>{{item.name}}</text>
				                      </view>
				                  </label>
				              </radio-group>
                  <view class="correction-textarea">
                    <textarea rows="5" v-model="redresscon" class="redress-textarea"></textarea>
                  </view>
                  <view class="correction-btn">
                      <button type="default" @click="submitError" style="width: 100%;margin-top: 20px;">提交纠错</button>
                  </view>
                </view>
            </view>
          </view>
        </transition>
        <swiper  ref="choice" :current="swiperRealIndex"  :style="{minHeight:windowHeight-99+'px'}" @animationfinish="transitionEnd">
          <swiper-item
            v-for="(item,i) in paperTkList"
            :key="i">
		  <scroll-view style="height: 100%;" :scroll-y="true">
			  <view v-if="item.type == 'dt'">
			    <view class="paper-contianer__bigtitle">{{item.title}}</view>
			    <view
			      class="paper-contianer__desc"
			      v-if="name === 'testpage'"
			    >本大题下有{{item.tklist.length}}小题，共{{item.dtscore}}分</view>
			    <view class="paper-contianer__intro" v-html="item.dtintro"></view> 
			  </view>
			  <view v-else-if="item.type == 'xt'">
			    <question-title  :type-name="item.tktype_name" :title="item.title" :is_hearing="item.is_hearing" :audiofile="item.tkinfo.audiofile"></question-title>
			    <view class="paper-option-box" v-if="item.tktype == 1">
			      <!--简答题-->
			      <short-answer :show-textarea="showTextarea" :item.sync="item" @callback="handleShortAnswer"></short-answer>
			    </view>
			    <view
			      class="paper-option-box"
			      v-else-if="item.tktype == 2 || item.tktype == 3 || item.tktype == 4"
			    >
			      <!--单选、多选、判断-->
			      <multiple-choice :item="item" :user-answer="item.useranswer" @change="handleChoiced"></multiple-choice>
			    </view>
			  
			    <view class="paper-option-box" v-if="item.tktype == 5">
			      <!--填空题-->
			      <fill-blanks :item="item" @callback="handleFillBlankAnswer"></fill-blanks>
			    </view>
			  
			    <view v-if="item.tktype == 6">
			      <!--组合题-->
			      <view
			        class="paper-xt"
			        :class="xtindex < item.tkinfo.childtk.length-1 && 'line'"
			        v-for="(make,xtindex) in item.tkinfo.childtk"
			        :key="xtindex"
			      >
			        <view class="paper-xt__title">{{xtindex+1}})、 <font v-html="make.title"></font></view>
			        <view v-if="make.tktype == 1">
			          <short-answer :show-textarea="showTextarea" :item="make" :index="xtindex" :parenttkid="item.tkid" :is-combination-question="true" @callback="handleShortAnswer"></short-answer>
			        </view>
			        <view v-else-if="make.tktype == 2 || make.tktype == 3 || make.tktype == 4">
			          <multiple-choice
			            :is-combination-question="true"
						:index="xtindex"
			            :item="make"
			            @change="handleChoiced"
			            :user-answer="make.useranswer"
			            :parenttkid="item.tkid"
			          ></multiple-choice>
			        </view>
			  
			        <view v-else-if="make.tktype == 5">
			          <fill-blanks :index="xtindex" :parenttkid="item.tkid" :is-combination-question="true" :item="make" @callback="handleFillBlankAnswer"></fill-blanks>
			        </view>
			        
			        <view
			          class="tk-analysis"
			         v-if="isShow">
			          <view style="text-align: right;">
			            <view
			              class="tk-analysis__button"
			              v-if="!make.analysis_flag && name=='testpage'"
			              @click="viewAnalysis(make,item.tkid,xtindex)"
			            >查看解析</view>
			            <view
			              class="tk-analysis__button"
			              v-else-if="!make.analysis_flag && name!='testpage'"
			              @click="lookAnswer(make)"
			            >查看解析</view>
			          </view>
			          <analysis-info :routers="routers" :item="make" v-if="make.analysis_flag" :parenttkid="item.tkid"></analysis-info>
			        </view>
			        <!--题目解析结束-->
			      </view>
			    </view>
			    <view
			      class="tk-analysis" v-if="isShow"
			      >
			      <!--题目解析-->
			      <view style="text-align: right;">
			        <view
			          class="tk-analysis__button"
			          v-if="!item.analysis_flag && item.tktype!=6 && name=='testpage'"
			          @click="viewAnalysis(item)"
			        >查看解析</view>
					
			        <view
			          class="tk-analysis__button"
			          v-if="!item.analysis_flag && item.tktype!=6 && name!='testpage'"
			          @click="lookAnswer(item)"
			        >查看解析</view>
			      </view>
			      <analysis-info :routers="routers" :item="item" v-if="item.analysis_flag"></analysis-info>
			  
			      <!--题目解析结束-->
			    </view>
			    <view class="paper-opear">
			      <view class="paper-opear__correction" @click="correction(item.tkid)" v-if="item.iscorrection">
			        <image :src="baseUrl+'/static/images/exam/correction.png'" style="width:14px;height: 14px;">纠错此题
			      </view>
			      <view class="paper-opear__sign" style="margin-left:10px;" @click="sign(i)" :class="{signed:item.signed}">
			        <image style="width:12.5px;height: 12.5px;" :src="baseUrl+'/static/images/exam/exam_sign.png'" v-if="item.signed==false"><image style="width:12.5px;height: 12.5px;" :src="baseUrl+'/static/images/exam/exam_active_sign.png'" v-else-if="item.signed==true">标记此题
			      </view>
			      <view
			        class="paper-opear__collect"
			        @click="collect(item)"
			        :class="{collected:item.collect}"
			        v-if="isshow_collect"
			      >
			        <image style="width:10px;height: 9px;" :src="baseUrl+'/static/images/exam/exam_collected.png'" v-if="item.collect==0"><image style="width:10px;height: 9px;" :src="baseUrl+'/static/images/exam/exam_active_collected.png'" v-if="item.collect==1">{{item.is_collection?'已收藏':'收藏此题'}}
			      </view>
			    </view>
			  </view>
		  </scroll-view>
            
          </swiper-item>
        </swiper>
        <answer-sheet :visible.sync="cardVisabled" ref="sheet" @callback="handleCardClick"></answer-sheet>
      </view>
      
    </view>
  </view>
  <uni-popup   ref="popup" :custom="true"  :show="showPopup" type="center" @change="close">
  		  <view style="width: 80vw;
  		background: #fff;
  		position: relative;
  		border-radius: 12px;
  		overflow: hidden;">
  			  <view class="payinfo-tips">{{payInfo}}</view>
  			  <view class="payinfo-btn" style="display: flex;">
  			    <button type="primary" @click="buyExam" style="margin-right:0.5rem;">购买</button>
  			    <button type="default" @click="cancelPay">取消</button>
  			  </view>
  		  </view>
    
  </uni-popup>
</view>
</template>
<script>
	import {QuestionTitle} from 'components/ks-components/question-title/question-title'
	import {PaperMedal} from 'components/ks-components/paper-medal/paper-medal'
	import {ShortAnswer} from 'components/ks-components/short-answer/short-answer'
	import {AnalysisInfo} from 'components/ks-components/analysis-info/analysis-info'
	import {AnswerSheet} from 'components/ks-components/answer-sheet/answer-sheet'
	import {UniPopup} from 'components/uni/uni-popup/uni-popup'
	import {FillBlanks} from 'components/ks-components/fill-blanks/fill-blanks'
	import {MultipleChoice} from 'components/ks-components/multiple-choice/multiple-choice'
	import {GetPaperDetail,
  SetPaperCollect,
  SetPaperAnswer,
  GetTestTk,
  EndTest,
  GetDailyTestDateList,
  GetDailyTestPaper,
  EndDailyTest,
  SubmitPaperAnswer,
  PayPaper,
  GetPaperErrortype,
  SetTkCorrection} from 'api/exam'
	import Utils from 'utils/index.js'
export default {
	components:{
		QuestionTitle,
		PaperMedal,
		ShortAnswer,
		FillBlanks,
		AnalysisInfo,
		AnswerSheet,
		UniPopup,
		MultipleChoice
	},
  name: "testpage",
  data () {
    return {
		baseUrl:this.$store.state.SRC+"/config/app",
	  testUseTime:'',
	  swiperRealIndex:0,
      isSwiperFirsetEnd: false,
      windowHeight: '',

      /**是否显示告知用户滑动切换上下题的提示 */
      showPaperSlideTips: false,

      /**试卷题目列表 */
      paperTkList: [],

      /**判断正规试卷是否单题查看解析的参数 */
      isShow: false,

      /**标题 */
      paper_title: '',

      /**试卷id */
      paperid: 0,

      /**显示答题卡 */
      cardVisabled: false,

      /**记录题目选中数组*/
      recode: [],

      /**试卷翻页记录长度 */
      pageTuning: 0,

      /**考试时间 */
      time: "00:00:00",

      /**当前秒数，用于计时 */
      second: 0,

      /**
       * 阅卷类型
       * 1自动阅卷
       * 2手动阅卷
       */
      scoreout: null,

      /**当前分类id */
      categoryid: 0,

      /**小题数量（递增） */
      xtnum: 0,

      /**自动滑到一下题的状态，当处于滑动状态开关将关闭，滑动结束开启 */
      slideFlag: true,

      /**是否禁止copy 0:不禁止，1禁止 */
      is_righttf: 0,
      is_righttfStatu: false,

      /**每日一练的日期 */
      dateList: [],
      dateInfoList: [],
      currentData: 0,
      //当前时间
      day: '',
      //当天时间
      loaded: false,
      correctionid: 0,
      //纠错题库id
      showPaperCorrection: false,
      //纠错窗口
      redresscon: '',
      redressType: 19,
      radioOption: [],
      showClass: true,
      showPopup: false,
      payInfo: {},
      isshow_collect: 0,
      look_tkanalysis_isfree_tips: '',
      //练习的查看答案权限判断
      set_time: 0,
      //练习规定用时 
      dailyid: 0,
      //每日一练提交时候的id
      is_saveanswer: 0, //是否开启保存功能
		query:{},
		name:'',
		routers:{
			type:'',
			name:''
		},
		showTextarea:true,
		timer:'',
		
    };
  },
	onHide(){
		if(this.timer){
			clearInterval(this.timer)
		}
		this.loaded = false
	},
	//页面卸载返回触发
	onUnload(e){
		if(this.timer){
			clearInterval(this.timer)
		}
		this.loaded = false
	},
  onShow () {
    this.start(); 
   
  },
  onLoad (query) {
		console.log(query)
	  var that = this
	  this.query = query
	  this.routers.type = query.type
	   this.routers.name = query.name
	  this.paper_title = this.query.title
	  this.name = this.query.name
	  uni.getSystemInfo({
	      success: function (res) {
				that.windowHeight = res.windowHeight
	          //获取纠错的类型
	             
	            GetPaperErrortype().then(res=> {
	            if (res.result) {
	              that.radioOption = res.data;
	            } else {
	              that.radioOption = [];
	            }
	            
	          })
	          
	      }
	  });
		this.dataInit();
		if (this.name == 'testpage') {
		  this.loadPage();
		} else {
		  /**练习题需要确认用户登录才可进入 */
		  this.$store.ready(state=> {
		    if (state.userInfo.UserID != 0) {
		      this.loadPage();
		    } else {
		      this.$msg('您还未登录，请登录后做题！').then( ()=> {
				  
		        uni.navigateTo({
		        	url:'/pages/user/login/index'
		        })
		      });
		    }
		  });
		}
  },
  methods: {
	  transitionEnd(e) {
		 
	    this.slideFlag = true;
	    /**是否已滑动最后一条 */
	  
	    var isLast = this.pageTuning == this.recode.length;
	    var _tkids = [];
		
	    this.swiperRealIndex = e.detail.current;
		 
		
	    this.paperTkList.map( (item, index)=> {
	      if (item.type === "xt") {
	        _tkids.push(item.tkid);
	  
	        if (index === this.swiperRealIndex) {
	          this.pageTuning = item.num;
	        }
	      }
	    });
	  
	    if (isLast && this.name === "exercise" && this.query.type != 6 && !this.isSwiperFirsetEnd) {
	      this.isSwiperFirsetEnd = true;
	  
	 
			uni.showLoading({
			  title:'加载更多题目中'
			});
	      var params = {
	        categoryid: this.categoryid,
	        type: this.query.type,
	        isrand: this.query.isrand,
	        tktype: this.query.tktype || 0,
	        tkids: _tkids
	      };
	  
	      switch (Number(this.query.type)) {
	        case 4:
	          params.sectionid = this.query.sectionid;
	          break;
	  
	        case 5:
	          params.knowledgeid = this.query.knowledgeid;
	          break;
	  
	        case 7:
	          params.courseid = this.query.courseid;
	          params.typeid = this.query.typeid;
	          break;
	      }
	  
	      GetTestTk(params).then(res=> {
	        uni.hideLoading();
	  
	        if (res.result) {
	          var tmlist = res.data.tmlist[0];
	  
	          if (tmlist) {
	            var tkindex = this.paperTkList.length;
	            var xtArr = [];
	            tmlist.tklist.map( (item)=> {
	              if (item.look_analysis_free) {
	                this.isShow = true;
	              } else {
	                this.isShow = false;
	              }
	  
	              var xt = this.tkItemInit(item, 0, tkindex + xtArr.length);
	  
	              xtArr.push(xt);
	            });
	            this.paperTkList = this.paperTkList.concat(xtArr);
	          }
	  
	          this.isSwiperFirsetEnd = false;
	        } else {
	          this.$msg(res.msg);
	        }
	      });
	    }
	  },
	  closePaperCorrection(){
		  this.showPaperCorrection=false
		  this.showTextarea = true
	  },
	  close(e){
	  	this.popupShow = e.show
	  },
    /**
     * 数据初始化
     */
    dataInit () {
	
      this.pageTuning = 0;
      this.xtnum = 0;
      this.paper_title = '';
      this.categoryid = this.query.categoryid;
      this.paperid = this.query.paperid;
      this.paperTkList = [];
      this.recode = [];
      this.time = "00:00:00";
      this.second = 0;
      this.$store.ready(state=> {
        var userid = state.userInfo.UserID;
		
        if (uni.getStorageSync("EXAM_SLIDE_TIPS_".concat(userid)) != 1) {
          this.showPaperSlideTips = true;
        }
      });
    },

    /**
     * 每日一练的试卷请求
     */
    getDoPracticeDaily () {
    
      this.paper_title = this.query.title || '';
      var params = {
        categoryid: this.categoryid,
        day: this.query.day
      };
	  uni.showLoading({
	    icon:'loading'
	  });
      GetDailyTestPaper(params).then(res=> {
        if (res.result) {
          this.look_tkanalysis_isfree_tips = res.data.look_analysis_free;

          if (res.data.is_righttf) {
            this.is_righttf = res.data.is_righttf;
            this.is_righttfStatu = true;
          }

          this.dailyid = res.dailyid;
          this.set_time = res.set_time;
			uni.hideLoading()
          var paperTkList = res.data.tmlist;
          if (paperTkList.length) {
            var _tkList = [];
            paperTkList.map( (dt, index)=> {
              dt.type = "dt";
              dt.prentKey = index;

              _tkList.push(dt);

              dt.tklist.map((xt, xtIndex)=> {
                var _xt = this.tkItemInit(xt, dt.prentKey, _tkList.length);

                _tkList.push(_xt);
              });
            });
            this.pageTuning = 1;
            this.paperTkList = _tkList;
          } else {
            this.$msg("未找到任何题目").then(()=> {
				
              uni.navigateBack();
            });
          }

          this.scoreout = res.data.scoreout;
        } else {
          this.$msg(res.msg).then(()=> {
			  
            uni.navigateBack();
          });
        }

        this.loaded = true;
      });
    },

    /**查看解析 */
    lookAnswer (item) {
      if (this.look_tkanalysis_isfree_tips.result) {
        if (!item.analysis_flag) {
          item.analysis_flag = true;
        }
      } else {
        this.$msg(this.look_tkanalysis_isfree_tips.msg);
      }
    },

    /**
     * 加载做题页面
     */
    loadPage () {
		
      var REQUEST_API;
      var params = {};
	  if(this.name == "testpage"){
		  this.paper_title = this.query.title;
		  REQUEST_API = GetPaperDetail;
		  params = {
		    categoryid: this.categoryid,
		    paperid: this.paperid
		  };
	  }else if(this.name == "exercise"){
		  REQUEST_API = GetTestTk;
		  params = {
		    categoryid: this.categoryid,
		    type: this.query.type,
		    isrand: this.query.isrand,
		    tktype: this.query.tktype || 0,
		    tkids: []
		  };
		  	  
		  switch (Number(this.query.type)) {
		    case 1:
		      this.paper_title = '题库练习';
		      break;
		  	  
		    case 2:
		      this.paper_title = '错题练习';
		      break;
		  	  
		    case 3:
		      this.paper_title = '收藏练习';
		      break;
		  	  
		    case 4:
		      this.paper_title = '自定义题库练习';
		      params.sectionid = this.query.sectionid;
		      break;
		  	  
		    case 5:
		      this.paper_title = '知识点练习';
		      params.knowledgeid = this.query.knowledgeid;
		      break;
		  	  
		    case 6:
		      this.paper_title = '每日一练';
		      break;
		  	  
		    case 7:
		      this.paper_title = '课时题库练习';
		      params.courseid = this.query.courseid;
		      params.typeid = this.query.typeid;
		      break;
		  }
	  }
	
      if (REQUEST_API) {
		
        if (this.query.type == 6) {
          /**每日一练单独处理 */
          GetDailyTestDateList({
            categoryid: this.query.categoryid
          }).then(res=> {
			  console.log(res)
            this.dateInfoList = res.data;
            res.data.map( (item, i)=> {
              if (item.day == this.query.day) {
                this.currentData = i;
				if(this.dateInfoList[this.currentData].testdata){
					var s = Math.floor(this.dateInfoList[this.currentData].testdata.exam_time/3600)>=10?Math.floor(this.dateInfoList[this.currentData].testdata.exam_time/60):'0'+Math.floor(this.dateInfoList[this.currentData].testdata.exam_time/60)
					var m = Math.floor(this.dateInfoList[this.currentData].testdata.exam_time/60)>=10?Math.floor(item.time/60):'0'+Math.floor(this.dateInfoList[this.currentData].testdata.exam_time/60)
					var f = this.dateInfoList[this.currentData].testdata.exam_time%60>=10?this.dateInfoList[this.currentData].testdata.exam_time%60:'0'+this.dateInfoList[this.currentData].testdata.exam_time%60
					this.testUseTime = s+':'+m+':'+f
				}
				
				
                this.day = item.day;
				
                if (item.is_test) {
                  this.loaded = true;
                } else {
				
                  this.getDoPracticeDaily();
                }
              }
            });
            
          });
        } else {
    
		  uni.showLoading({
		    icon:'loading'
		  });
		 
          REQUEST_API(params).then(res=> {
			
            if (res.result) {
              if (this.name == "testpage") {
                this.is_saveanswer = res.data.is_saveanswer;
                this.set_time = res.data.exam_time;
                if (res.data.realtest == 0 && res.data.is_tjda == 1) {
                  this.isShow = true;
                } else {
                  this.isShow = false;
                }
              } else {
                this.look_tkanalysis_isfree_tips = res.data.look_analysis_free;
                this.isShow = true;
              }

              this.isshow_collect = res.data.isshow_collect;

              if (res.data.is_righttf) {
                this.is_righttf = res.data.is_righttf;
                this.is_righttfStatu = true;
              }
				
              uni.hideLoading()

              var paperTkList = res.data.tmlist;
              if (paperTkList.length) {
                var _tkList = [];
                paperTkList.map( (dt, index)=> {
                  dt.type = "dt";
                  dt.prentKey = index;

                  _tkList.push(dt);

                  dt.tklist.map( (xt, xtIndex)=> {
                    var _xt = this.tkItemInit(xt, dt.prentKey, _tkList.length);

                    _tkList.push(_xt);
                  });
                });
		
                this.pageTuning = 1;
                this.paperTkList = _tkList;
              } else {
                this.$msg("未找到任何题目").then(()=> {
					
                   uni.navigateBack()
                });
              }
				
              this.scoreout = res.data.scoreout;
              this.loaded = true;
			
            } else {
              uni.hideLoading()
				
              if (res.returncode == 1002 || res.returncode == 1062) {
                this.$msg(res.msg).then( ()=> {
                  uni.navigateBack()
                });
              } else if (res.returncode == 1063 || res.returncode == 1064 || res.returncode == 1065) {
                this.payInfo = res.msg;
                this.showPopup = true;
		
              } else {
                this.$msg(res.msg).then( ()=> {
					
                   uni.navigateBack()
                });
              }

              this.loaded = true;
            }
          });
        }
      }
    },

    /**
     * 初始化题目字段
     * @param {Object} 题目对象
     * @param {Number} 归属大题的索引值
     * @param {Number} 绑定轮播图的索引值，用于快速滑到对应题号
     */
    tkItemInit (tkItem, dtIndex, swiperIndex) {
    

      this.xtnum++;
      /**小题标志 */

      tkItem.type = "xt";
      /**是否已标记 */

      tkItem.signed = false;
      /**储存当前选中的答案 */
	
      if (tkItem.useranswer instanceof Array) {
        tkItem.useranswer = tkItem.useranswer;
      } else {
        tkItem.useranswer = [];
      }
      /**即时显示答题对错状态 */


      tkItem.showAnswerStatus = false;
      /**用于找到答题卡对应的题号，增加标志、已做等样式 */

      tkItem.num = this.xtnum;
      /**当前大题的索引值*/

      tkItem.subKey = dtIndex;
      /**增加解析开关 */

      tkItem.analysis_flag = false;

      if (tkItem.tktype == 5) {
        var topicSplitArr = tkItem.title.split(/_{3,}/);

        if (!tkItem.tkinfo.answer) {
          tkItem.tkinfo.answer = [];
          topicSplitArr.map( (text, i)=> {
            if (i > 0) {
              tkItem.tkinfo.answer.push({
                options: ""
              });
            }
          });
        } else {
          tkItem.tkinfo.answer.map( (arrItems)=> {
            arrItems.options = "";
          });
        }
      } else if (tkItem.tktype == 6) {
        tkItem.tkinfo.childtk.map( (child)=> {
          child.analysis_flag = false;
          child.showAnswerStatus = false;
          child.num = this.xtnum;

          if (child.useranswer instanceof Array) {
            child.useranswer = child.useranswer;
          } else {
            child.useranswer = [];
          } //child.useranswer = [];

        });
      }
      /**
       * 答题卡
       */
       let answered
	
      if(tkItem.useranswer&&tkItem.useranswer.length){
        answered = true
      }else{
        answered = false
      }
      this.recode.push({
        bindSwiperIndex: swiperIndex,
        num: this.xtnum,
        sign: false,
        answered: answered
      });
      
      return tkItem;
	 
    },

    /**
     * 单选、多选、判断选择触发回调
     * @param {Object} 题目对象
     * @param {Array} 选项值数组
     * @param {Boolean} 是不是组合题
     */
    handleChoiced (item, optionArr, isCombinationQuestion, tkid,index) {
	
		
      this.recode[item.num - 1].answered = true;
	  if(isCombinationQuestion){
		  this.paperTkList.map(tk=>{
			if(tk.tkid == tkid){
				tk.tkinfo.childtk.map((make,m)=>{
					if(m == index){
						make.useranswer = optionArr
					}
				})
			}
		 })
	  }else{
		this.paperTkList.map(tk=>{
			if(tk.tkid == item.tkid){
				tk.useranswer = optionArr
			}	 
		})
	 }
      
      if (item.tktype == 2 || item.tktype == 4) {
        if (!isCombinationQuestion) {
          this.goNext();
        }
      }
    },

    /**
     * 切换到下一题
     */
    goNext () {
      if (this.slideFlag) {
		  this.slideFlag = false;
        setTimeout( ()=> {
            this.swiperRealIndex++
          }, 400);
      }
    },

    /**
     * 填空题提交答案
     * @param {Object} 题目对象
     */
    handleFillBlankAnswer (item,isCombinationQuestion, tkid,index) {
      var anserArr = [];
      item.tkinfo.answer.map(res=> {
        anserArr.push(res.options);
      });
      this.recode[item.num - 1].answered = true;
	  if(isCombinationQuestion){
		  this.paperTkList.map(tk=>{
			if(tk.tkid == tkid){
				tk.tkinfo.childtk.map((make,m)=>{
					if(m == index){
						console.log(make)
						make.useranswer = anserArr
					}
				})
			}
		 })
	   }else{
	  		this.paperTkList.map(tk=>{
	  			if(tk.tkid == item.tkid){
	  				tk.useranswer = anserArr
	  			}	 
	  		})
	  }
    },

    /**
     * 简答题提交答案
     * @param {Object} 简答题对象
     **/
    handleShortAnswer (item,isCombinationQuestion, tkid,index) {
		
	
		if(isCombinationQuestion){
				  this.paperTkList.map(tk=>{
					if(tk.tkid == tkid){
						tk.tkinfo.childtk.map((make,m)=>{
							if(m == index){
								make.useranswer = item.useranswer
							}
						})
					}
				 })
		 }else{
				this.paperTkList.map(tk=>{
					if(tk.tkid == item.tkid){
						tk.useranswer = item.useranswer
					}	 
				})
		}
      this.recode[item.num - 1].answered = true;
    },

    /**
     * 答题卡信息传值
     */
    sheetclick () {
      

      if (this.cardVisabled) {
        this.cardVisabled = false;
      } else {
        this.cardVisabled = true;
        this.$nextTick( ()=> {
          this.$refs.sheet.reset({
            answerList: this.recode,
            swiperChoice: this.$refs.choice
          });
        });
      }
    },

    /**
     * 答题卡回调跳转当前选中题
     * @param {Number} 题目索引值
     */
    handleCardClick (index) {
	  this.swiperRealIndex = index
      this.cardVisabled = false;
    },

    /**
     * 标记当前题目
     * @param {Number} 当前题目索引值
     */
    sign (index) {
      var signItem;
      this.recode.map( (item)=> {
        if (item.bindSwiperIndex == index) {
          signItem = item;
        }
      });

      if (!signItem) {
        return;
      }

      if (signItem.sign == false) {
        signItem.sign = true;
        this.paperTkList.map( (item, i)=> {
          if (i == index) {
            item.signed = true;
          }
        });
      } else {
        signItem.sign = false;
        this.paperTkList.map( (item, i)=> {
          if (i == index) {
            item.signed = false;
          }
        });
      }
    },

    /**
     * 收藏题目
     * @param {Object} 题目对象
     */
    collect (item) {
      if (item.collect == 0) {
        item.collect = 1;
      } else {
        item.collect = 0;
      }

      SetPaperCollect({
        type: 2,
        //1试卷 2题目
        categoryid: this.categoryid,
        infoid: item.tkid,
        collect: item.collect
      }).then(res=> {
        if (res.result) {// item.collect = !item.collect;
        }
      });
    },

    /**
     * 纠错题目
     * @param {Number} 题目id
     */
    correction (tkid) {
      this.correctionid = tkid;
      this.showPaperCorrection = true;
	  this.showTextarea = false
    },

    /**
     * 查看解析
     * @param {Object} 题目对象
     */
    viewAnalysis (item, parenttkid, xtindex) {
	
		console.log(item,item.useranswer)
      var tkid = 0;
		
      if (parenttkid) {
        tkid = parenttkid;
      } else {
        tkid = item.tkid;
      }

      if (this.name == 'testpage') {
        /**单题交卷 */
        this.$set(item, 'analysis_flag', false);
        var useranswer = [];
		
        if (item.tktype == 1) {
			console.log(item,item.useranswer)
          if (item.useranswer != '') {
			  
            useranswer = [item.useranswer.toString()];
          } else {
            this.$msg('请输入答案');
            return false; //useranswer = []
          }
        } else if (item.tktype == 2 || item.tktype == 3) {
          /**获取打乱后的真实答案 */
          if (item.useranswer && item.useranswer.length) {
            item.useranswer.map( (letter)=> {
              var index = Utils.getLetterIndex(letter);

              if (parenttkid) {
                useranswer.push(letter);
              } else {
                useranswer.push(item.tkinfo.real_answer[index]);
              } //useranswer.push(item.tkinfo.real_answer[index])  

            });
          } else {
            this.$msg('请选择答案');
            return false;
          }
        } else {
          if (item.useranswer && item.useranswer.length) {
            useranswer = item.useranswer;
          } else {
            this.$msg('请选择答案');
            return false;
          }
        }

        SubmitPaperAnswer({
          paperid: this.paperid,
          tkid: tkid,
          xttkid: xtindex || 0,
          useranswer: useranswer
        }).then(res=> {
          if (res.result) {
            item.analysis_flag = true;
            item.showAnswerStatus = true;
            item.userscore = res.data.userscore;
            item.tkinfo.analysis = res.data.analysis;
            item.tkinfo.answer = res.data.answer;
            item.score_rule = res.data.score_rule;
          } else {
            item.analysis_flag = false;

            this.$msg(res.msg);
          }
        });
      } else {
        item.analysis_flag = true;
        item.showAnswerStatus = true;
      }
    },

    /**
     * 触发滑动提示的我知道按钮
     */
    iKnow () {
      this.$store.ready(state=> {
        var userid = state.userInfo.UserID;
        uni.setStorageSync("EXAM_SLIDE_TIPS_".concat(userid),1);
      });
      this.showPaperSlideTips = false;
    },

 

    /**每日一练设置日期 */
    setDay (name, index, isActive) {
      this.day = name;
      this.currentData = index;

      if (!isActive) {
        this.getDoPracticeDaily();
      }
    },

    /**
     * 交卷type=1代表练习时间已到自动交卷 type=2代表保存 type=0代表提交
     */
    save (type) {


      /**构造大题数组 */
      var answerResult = [];
      this.paperTkList.map( (item, i)=> {
        if (item.type == "dt") {
          answerResult.push({
            title: item.title,
            tklist: []
          });
        }
      });
      /**填充小题 */

      this.paperTkList.map( (item, i)=> {
        if (item.type == "xt") {
          var answerItem = [];

          if (item.tktype == 6) {
            item.tkinfo.childtk.map( (child, i)=> {
              answerItem.push({
                tktype: child.tktype,
                score: child.score,
                useranswer: Utils.isArrayOrObject(child.useranswer) !== "Array" ? [child.useranswer] : child.useranswer
              });
            });
          } else {
            answerItem = Utils.isArrayOrObject(item.useranswer) !== "Array" ? [item.useranswer] : item.useranswer;
          }

          answerResult[item.subKey].tklist.push({
            tkid: item.tkid,
            useranswer: answerItem,
            tktype: item.tktype,
            score: item.score
          });
        }
      });
      var REQUEST_API;
      var params = {};
      var flag = 1; //0是保存 1是交卷

      switch (this.name) {
        case "testpage":
          REQUEST_API = SetPaperAnswer;

          if (type == 2) {
            flag = 0;
          } else {
            flag = 1;
          }

          params = {
            categoryid: this.categoryid,
            paperid: this.paperid,
            flag: flag,
            answer: answerResult,
            time: this.second,
            workid: this.query.workid,
            stu: this.query.stu
          };
          break;

        case "exercise":
          REQUEST_API = EndTest;
          params = {
            categoryid: this.categoryid,
            answer: answerResult,
            examtime: this.second,
            type: this.query.type,
            isrand: this.query.isrand
          };

          switch (Number(this.query.type)) {
            case 4:
              params.sectionid = this.query.sectionid;
              break;

            case 5:
              params.knowledgeid = this.query.knowledgeid;
              break;

            case 6:
              REQUEST_API = EndDailyTest;
              params.dailyid = this.dailyid;
              params.day = this.day;
              break;

            case 7:
              params.courseid = this.query.courseid, params.typeid = this.query.typeid;
              break;
          }

          break;
      }

      if (REQUEST_API) {

		uni.showLoading({
		    title: '正在交卷'
		});
        REQUEST_API(params).then(res=> {
          uni.hideLoading()
          if (res.result) {
            var savetips = '';

            if (type == 1) {
              savetips = '时间已到，自动交卷成功';
            } else if (type == 2) {
				
              savetips = '保存成功';
            } else {
				
              savetips = '交卷成功';
            }
			var iconType = ''
			if(savetips != '时间已到，自动交卷成功'){
				iconType == 'success'
			}
            this.$msg(savetips, iconType).then(()=> {
              switch (this.name) {
                case "testpage":
				console.log(res.subjective_count)
                  if (type != 2) {
                    if (res.subjective_count) {
						
						uni.navigateTo({
							url:`/pages/exam/ownscore?answerid=${res.id}&title=${this.paper_title}&paperid=${this.paperid}&type=1&categoryid=${this.categoryid}`
						})
                      
                    } else {
						
						uni.navigateTo({
							url:`/pages/exam/result?id=${res.id}&title=${this.paper_title}&paperid=${this.paperid}&type=1&categoryid=${this.categoryid}`
						})
                     
                    }
                  }

                  break;

                case "exercise":
				
				uni.navigateTo({
					url:`/pages/exam/result?id=${res.id}&title=查看解析&type=2&categoryid=${this.categoryid}`
				})
                  thisr.push({
                    path: "/exam/result",
                    query: {
                      type: 2,
                      id: res.id,
                      categoryid: this.categoryid,
                      title: '查看解析'
                    }
                  });

                  break;
              }
            });
          }
        });
      }
    },

    /**
     * 获取时间 格式 hh:mm:ss
     * @param {Number} 秒
     */
    getTime(second) {
      var hour, minute;
      hour = Math.floor(second / 3600);
      second = second - hour * 3600;
      minute = Math.floor(second / 60);
      second = second - minute * 60;

      var _hour = hour < 10 ? "0" + hour : hour;

      var _minute = minute < 10 ? "0" + minute : minute;

      var _second = second < 10 ? "0" + second : second;

      this.time = _hour + ":" + _minute + ":" + _second;
    },

    /**
     * 启动计时器
     */
    start () {
       this.timer = setInterval(()=> {
        this.second += 1;

        this.getTime(this.second);

        if (this.name == 'testpage' || this.query.type == 6) {
          if (this.second == this.set_time * 60) {
            this.save(1);
          }
        }
      }, 1000);
    },

    /**提交纠错 */
    submitError() {
     

      SetTkCorrection({
        tkid: this.correctionid,
        categoryid: this.categoryid,
        content: this.redresscon,
        errortype: this.redressType
      }).then(res=> {
        this.showPaperCorrection = false;
		this.showTextarea = true

        if (res.result) {
          this.$msg("提交成功", "success").then(()=> {
            this.redresscon = '';
          });
        } else {
          this.$msg(res.msg, "fail").then(()=> {
			  if(res.returncode == -1){
				  
				  uni.navigateTo({
				  	url:'/pages/user/login/index'
				  })
			  }
            this.redresscon = '';
          });
        }
      });
    },

    /**取消购买试卷 */
    cancelPay () {
		
      uni.navigateBack();
    },

    /**购买试卷*/
    buyExam () {


      this.showPopup = false;
      PayPaper({
        paperid: this.query.paperid
      }).then(res=> {
        this.$store.ready(state=>{
          if(state.isLogin==1){
            if (res.result) {
              this.$msg('支付成功').then(()=> {
				  this.$store.dispatch('getUserInfo')
                this.loadPage();
              })  ;
            } else {
              this.$msg(res.msg).then(()=> {
				  
                uni.navigateBack()
              });
            }
          }else{
			 
            uni.navigateTo({
				url:'/pages/user/login/index'
			})
          }
        })
        
      });
    }
  },
  watch: {
    'redressid' () {

      this.showClass = false;
      this.$nextTick(()=> {
        this.showClass = true;
        this.redresscon = '';
      });
    }
  },
  filters: {
    /**
     * 参考答案内容过滤
     */
    answer (val, tktype) {
      val = val.toString();

      if (val === "") {
        return "无";
      } else {
        if (tktype == 4) {
          return val === "1" ? "正确" : "错误";
        } else {
          return val;
        }
      }
    }
  }
}
</script>
<style>
.paper {
  background: #fff;
  min-height:100%;
  position: relative;
  overflow: hidden;
}
.van-icon-arrow-left{
    color: #4d4c4c !important;
}
.paper-slide-tips {
  width: 100%;
  height: 100%;
  position: absolute;
  left: 0;
  top: 0;
  z-index: 99999;
  background: rgba(0, 0, 0, 0.5);
  color: #fff;
  font-size: 16px;
  line-height: 34px;
  display: flex;
  align-items: center;
}
.paper-slide-tips image {
  height: 160px;
}

.paper-slide-tips .ktj-button {
  background: none;
  color: #fff;
  border: 1px solid #fff;
  margin-top: 80px;
}

.paper-slide-tips__inner {
  display: flex;
  flex-direction: column;
  margin: 0 auto;
  text-align: center;
}

.paper-header {
  display: flex;
  align-items: center;
  padding: 0 15px;
  height: 57px;
  font-size: 13px;
}
.paper-header__second {
  color: #525b67;
  padding-right: 10px;
  flex: 1;
}
.paper-header__card {
  padding-right: 15px;
  line-height: 20px;
}
.paper-header__card image {
	width: 20px;
  height: 20px;
  float: left;
  margin-right: 5px;
}
.paper-header-sumbit {
  padding: 0 20px;
  background: #2987EE;
  color: #fff;
  height: 26px;
  line-height: 26px;
  font-size: 12px;
  border-radius: 2px;
}
.paper-header-save{
  margin-right: 0.5rem;
  background: #fff;
  color: #2987EE;
  border: 1px solid #2987EE;
  box-sizing: border-box;
  line-height: 26px;
}
.paper-contianer {
  padding: 20px 15px;
}

.paper-xt__title {
  font-size: 14px;
  color: #3e4754;
  line-height: 1.6;
}

.paper-contianer__bigtitle {
  font-size: 16px;
  font-weight: bold;
  color:#273035;
}
.paper-contianer__desc {
  line-height: 24px;
  color: #999;
  margin-top: 5px;
  font-size: 12px;
}
.paper-contianer__intro {
  font-size: 14px;
  line-height: 24px;
  padding-top: 10px;
}
.paper-xt,
.paper-option-box {
  padding: 15px 0;
}
.paper-option,
.paper__answer-area {
  padding: 10px 0;
  line-height: 32px;
  color: #3e4754;
  font-size: 14px;
}
.paper-option span {
  width: 32px;
  height: 32px;
  text-align: center;
  font-size: 15px;
  color: #3e4754;
  display: inline-block;
  border-radius: 50%;
  border: 1px solid #e5e7eb;
  margin-right: 15px;
}
.paper-opear {
  text-align: right;
  color:#273035;
  font-size: 12px;
}
.paper-opear__sign,.paper-opear__correction {
  display: inline-block;
}
.paper-opear__sign image,.paper-opear__correction image {
  width: 11px;
  padding-right: 5px;
  position: relative;
  top: 2px;
}
.paper-opear__collect {
  display: inline-block;
  margin-left: 10px;
}

.paper-opear__collect image {
  width: 11px;
  padding-right: 5px;
}
.paper-contianer {
  position: relatives;
}
.actived {
  background: #2987EE;
  color: #fff !important;
}
.signed,
.collected {
  color: #2987EE;
}
.paper-option-textarea {
  display: block;
  resize: vertical;
  padding: 5px 15px;
  line-height: 1.5;
  box-sizing: border-box;
  width: 100%;
  height: 10rem;
  font-size: inherit;
  color: #606266;
  background-color: #fff;
  background-image: none;
  border: 1px solid #dcdfe6;
  border-radius: 4px;
  transition: border-color 0.2s cubic-bezier(0.645, 0.045, 0.355, 1);
  margin: 10px 0;
}
.paper-option-input {
  margin-left: 10px;
  height: 30px;
  line-height: 30px;
  border: 0px;
  border-bottom: 1px solid #eee;
  font-size: 14px;
  width: 75%;
}
/**解析*/
.tk-analysis {
  padding: 15px 0;
}
.tk-analysis__button {
  height: 30px;
  line-height: 30px;
  background: #fff;
  display: inline-block;
  border: 1px solid #2987EE;
  border-radius: 4px;
  color: #2987EE;
  padding: 0 15px;
  font-size: 14px;
}
.dont_copy{
  -webkit-user-select:none;
  -khtml-user-select:none;
  -moz-user-select:none;
  -ms-user-select:none;
}
.paper-opear2 {
  width: 100%;
  box-sizing: border-box;
  padding: 15px 0;
  background: #f1f1f1;
}
.paper-opear2__right {
  float: right;
  margin-right: 15px;
}
.paper-icon-sign {
  display: inline-block;
  padding-left: 20px;
  font-size: 13px;
  color: #8f8f8f;
  position: relative;
  margin-left: 20px;
}
.paper-icon-sign i {
  position: absolute;
  left: 0;
  top: 1px;
  width: 14px;
  height: 14px;
  display: block;
  border-radius: 50%;
}
.paper-icon-sign--color1 i {
  background: #ffb03b;
}
.paper-icon-sign--color2 i {
  background: #ed7c78;
}
.paper-icon-sign--color3 i {
  background: #fff;
  border: 1px solid #dcdcdc;
}
.paper-icon-sign--color4 i {
  background: #dcdcdc;
}
.paper-icon-sign--color5 i {
  background: #32d432;
  border: 1px solid #32d432;
}
.paper-contianer p{
  line-height: 30px;
  font-size: 13px;
  color: #888;
}
.green-font{
  color: #32d432;
}
.red-font{
  color: #2987EE;
}
.van-nav-new{
  z-index:inherit !important;
}
.van-nav-bar__left {
  z-index: 3000;
}
.correction-con{
  background: #fff;
  width: 90%;
  height: 70%;
  position: relative;
  border-radius: 12px;
}

.correction-close{
  width: 30px;
  height: 30px !important;
  position: absolute;
  right: -15px;
  top: -30px;
}
.correction-box h3{
  color: #333;
  line-height: 50px;
}
.correction-option{
  height: 70%;
  overflow-y: auto;
}
.correction-box p{
  padding: 0 15px;
  text-align: left;
  line-height: 25px;
  color: #666;
  margin-bottom: 10px;
  font-size: 14px;
}
.correction-box{
  border-bottom: 1px solid #eee;
}
.correction-option {
  text-align: left;
  padding: 15px;
}
.correction-option .van-radio-group .van-radio{
  display: inline-block;
  margin-right: 20px;
}
.redress-textarea{
  border: 1px solid #eee;
  width: 100%;
  padding: 10px;
  box-sizing: border-box;
  color: #333;
}
.no-scroll{
  overflow: hidden;
  height: 100%;
  position: fixed;
  left: 0;
  width: 100%;
}
.payinfo-popup{
  width: 80%;
  font-size: 14px;
  line-height: 25px;
}
.payinfo-tips{
  padding: 15px;
}
.payinfo-btn{
	margin-top: 20px;
  text-align: center;
  padding: 10px;
  border-top: 1px solid #eee;
}
.payinfo-btn button{
  height: 30px;
	font-size: 14px;
	width: 60px;
  text-align: center;
  line-height: 30px;
}
.paper-contianer__intro p {
  margin-top: 10px;
}
.correction-option .van-radio__label{
  font-size: 14px;
}
.correction-option .van-radio__icon{
  display: inline-block;
  vertical-align: middle;
}
</style>