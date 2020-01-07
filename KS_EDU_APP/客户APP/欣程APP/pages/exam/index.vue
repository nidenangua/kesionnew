<template>
  <view class="exam-app" v-if="show">
    <view class="my-exam-tab">
		<view style="display: flex;flex: 1;">
			<view class="my-exam-tab__topn">{{allData.tk_num}}题</view>
			<view class="my-exam-tab__topn">{{allData.paper_num}}套试卷</view>
			<view class="my-exam-tab__topn">{{allData.knowledge_num}}个知识点</view>
		</view>
        <view class="my-exam-tab__topleft" @click="openSelect()">
          <text>{{classes}}</text>
          <image :src="baseUrl+'/static/images/choose-cade/choose-Cades.png'" />
        </view>
    </view>
    <!-- 中部主内容 -->
    <view class="examMain">
      <view class="middlep">
          <view style="width: calc(100% / 3);text-align: center;" v-for="item in moduleOptions" :key="item.module_id">
            <view @click="url(item.module_name)">
              <view align="center" class="middlep-img">
                <image :src="baseUrl+item.src" />
              </view>
              <view align="center" class="middlep_text">{{item.module_name}}</view>
            </view>
          </view>
      </view>
      <!-- 学习图表 -->
      <view class="myexam-chart" v-if="uchart">
		  <view style="font-size: 14px;font-weight: 500;color:#333;height: 36px;line-height: 36px;padding-left: 10px;">考试学习情况</view>
        <ucharts :opts="opts" canvas-id="canvasLineStudy"  chartType="line" :cWidth="cWidth" :cHeight="cHeight" ></ucharts>
      </view>
    </view>
    <!-- 底部内容 -->
    <view class="examBottom">
      <!-- 学习时间记录 -->
      <view class="learn-card">
          <view style="width:calc(100% / 3);" class="learn-card__head">连续学习</view>
          <view style="width:calc(100% / 3);" class="learn-card__head">学习时间</view>
          <view style="width:calc(100% / 3);" class="learn-card__head">正确率</view>
          <view style="width:calc(100% / 3);" class="learn-card__siz">
            <text class="learn-card__span">{{allData.total_continedotkday}}</text>天
          </view>
          <view style="width:calc(100% / 3);" class="learn-card__siz">
            <text class="learn-card__span">{{allData.total_dotktime}}</text>分钟
          </view>
          <view style="width:calc(100% / 3);" class="learn-card__siz">
            <text class="learn-card__span">{{allData.zhunquelv}}</text>%
          </view>
      </view>
      <view class="examBottom-position">
        <!-- 气泡显示 -->
        <view class="qpIcon">
          <view class="qpIcon-box">
            <image :src="baseUrl+'/static/images/exam/qp1.png'" />
            <text>{{allData.user_knowledge_num}}/{{allData.knowledge_num}}知识点</text>
          </view>
          <view class="qpIcon-box">
            <image :src="baseUrl+'/static/images/exam/qp2.png'" />
            <text>{{allData.user_paper_num}}/{{allData.paper_num}}试卷</text>
          </view>
          <view class="qpIcon-box">
            <image :src="baseUrl+'/static/images/exam/qp3.png'" />
            <text>{{allData.do_num}}/{{allData.tk_num}}题</text>
          </view>
        </view>
        <!-- 学习进度显示 -->
        <view class="progress-position">
          <view class="progress-bar1" :style="{width:knowledgePro+'%',zIndex:knowledgeNum}"></view>
          <view class="progress-bar2" :style="{width:examPro+'%',zIndex:examNum}"></view>
          <view class="progress-bar3" :style="{width:bankPro+'%',zIndex:bankNum}"></view>
        </view>
      </view>
    </view>
  </view>
</template>
<script>
	import {ucharts} from '@/components/ks-components/ucharts/ucharts.vue'
	import {GetSubjectStatistics,GetAllPaperCategory} from 'api/exam'
  export default {
	  components:{
	  	ucharts
	  },
    data () {
      return {
		  baseUrl:this.$store.state.SRC+"/config/app",
        knowledgePro: 0, //知识点进度条
        examPro: 0, //套卷进度条
        bankPro: 0, //题库进度条
        knowledgeNum: null, //显示层级
        examNum: null, //显示层级
        bankNum: null, //显示层级
        percentage: 40, //进度条
        showPopup: false, //弹出层开关
        btnText: "英语考试", //
        allClass: [], //所有课程
        id: null, //课程id
        classes: "未选择", //课程名称
        active: null, //当前未选中
        allData: {},
        moduleOptions: [],
        moduleImg: [
          { src: '/static/images/exam/1.png' },
          { src: '/static/images/exam/2.png' },
          { src: '/static/images/exam/3.png' },
          { src: '/static/images/exam/4.png' },
          { src: '/static/images/exam/5.png' },
          { src: '/static/images/exam/6.png' },
          { src: '/static/images/exam/7.png' }
        ],
        categoryid: 0,
        urls: '',
        state:{},
		opts:{
			categories: [],
				series: [{
					name: '学习时长',
					data: [],
					color: '#2987EE'
				}],	
		},
		uchart:false,
		cWidth:0,
		cHeight:0,
		show:false
      };
    },
    methods: {
      newClass (classes, id) {
        this.classes = classes;
        this.categoryid = id;
      },
      url (name) {
        var _name = "";
        if (name == '练习中心') {
          _name = "practice";
        } else if (name == '套卷练习') {
          _name = "exambank";
        } else if (name == '练习记录') {
          _name = "practicerecord";
        } else if (name == '考试记录') {
          _name = "examrecord";
        } else if (name == '错题练习') {
          _name = "errorbank";
        } else if (name == '收藏练习') {
          _name = "collectbank";
        } else if (name == '每日一练') {
          _name = "practicedaily";
        }
        if (_name === 'practicerecord' || _name === 'examrecord' || _name === 'errorbank' || _name === 'collectbank' || _name === 'practicedaily') {
            if (this.state.isLogin == 0) {
				uni.showModal({
				    title: '提示',
				    content: '前往登陆后查看',
				    success: function (res) {
				        if (res.confirm) {
				            uni.navigateTo({
				            	url:'/pages/user/login/index'
				            })
				        } else if (res.cancel) {
				            console.log('用户点击取消');
				        }
				    }
				});
            } else if (this.state.isLogin == 1) {
				uni.navigateTo({
					url:'/pages/exam/'+_name+'?categoryid='+(uni.getStorageSync('id_' + this.state.userInfo.UserID) || 0)
				})  
            }  
        } else {
          uni.navigateTo({
          	url:'/pages/exam/'+_name+'?categoryid='+(uni.getStorageSync('id_' + this.state.userInfo.UserID) || 0)
          })
        }
      },
      openSelect () {
		uni.navigateTo({
			url:'/pages/exam/select'
		})
      },
      getAllPaperCategory () {
        //请求接口获取一级课程列表
        GetAllPaperCategory().then(res=> {
          this.allClass = res.data;
          uni.setStorageSync('allClass',JSON.stringify(res.data))
        });
      },
      getSubjectStatistics () {
        // 获取用户课程记录
       GetSubjectStatistics({
		 
          categoryid: uni.getStorageSync('id_' + this.state.userInfo.UserID)
        }).then(res=> {
          this.urls = res.get_viewurl
          if (res.result) {
            this.allData = res.data;
			if(res.data.day_record.length>0){
				res.data.day_record = res.data.day_record.filter((item,i)=>{
					if(i<7){
						return item
					}
				})
				this.opts.categories = res.data.day_record.map((item,i)=>{
					return item.date
				})
			
				res.data.day_record = res.data.day_record.filter((item,i)=>{
					if(i<7){
						return item
					}
				})
				this.opts.series[0].data = res.data.day_record.map((item,i)=>{

						return item.time
				})
			}else{
				this.opts.categories = ['您还没有学习记录']
				this.opts.series[0].data = [0]
			}
			this.cHeight = 200
			this.uchart = true
	
            res.module.map(item=> {
              item.src = this.moduleImg[item.module_id].src;
            });
            this.moduleOptions = res.module;
            this.knowledgePro =
              (this.allData.user_knowledge_num * 100) /
              this.allData.knowledge_num;
            this.examPro =
              (this.allData.user_paper_num * 100) / this.allData.paper_num;
            this.bankPro = (this.allData.do_num * 100) / this.allData.tk_num;
            // 进度条比较大小，小的层级最大显示
            if (this.knowledgePro >= this.bankPro && this.examPro) {
              this.knowledgeNum = 1;
              if (this.bankPro >= this.examPro) {
                this.bankNum = 2;
                this.examNum = 3;
              } else {
                this.bankNum = 3;
                this.examNum = 2;
              }
            } else if (this.bankPro >= this.knowledgePro && this.examPro) {
              this.bankNum = 1;
              if (this.knowledgePro >= this.examPro) {
                this.knowledgeNum = 2;
                this.examNum = 3;
              } else {
                this.knowledgeNum = 3;
                this.examNum = 2;
              }
            } else if (this.examPro >= this.knowledgePro && this.bankPro) {
              this.examNum = 1;
              if (this.knowledgePro >= this.bankPro) {
                this.knowledgeNum = 2;
                this.bankNum = 3;
              } else {
                this.knowledgeNum = 3;
                this.bankNum = 2;
              }
            }
          } else {
            uni.showToast({
            	title: res.msg,
				icon:'none'
            })
          }
          this.show = true;
        });
      }
    },
	onLoad() {
		var that = this
		
		//更新数据的生命周期函数
		this.$store.ready(state=> {
		  this.state = state 
		    // 获取用户课程记录
		    if (uni.getStorageSync('classes_'+state.userInfo.UserID)) {
		      this.classes = uni.getStorageSync('classes_'+state.userInfo.UserID)||'请选择';
		      this.active = uni.getStorageSync('id_'+state.userInfo.UserID)||''; //显示当前样式
		      
		    } else {
				uni.redirectTo({
					url:'/pages/exam/select'
				})
				
		    }  
			uni.getSystemInfo({
			    success:function (res) {
					that.cWidth = res.screenWidth - 30	
				}
			})
		})
		
	},
    onShow () {
      this.getAllPaperCategory();
      this.getSubjectStatistics();
    }	
  };
</script>
<style>
  .echarts {
    width: 98%;
    height: 98%;
    margin-left: 2%;
    margin-top: 2%;
  }

  .middlep {
    background-color: #fff;
    width: 100%;
    border-radius: 5px;
    padding-bottom: 15px;
	display: flex;
	flex-wrap: wrap;
	align-items: center;
  }

  .my-exam-tab {
    background-color: #fff;
    padding: 0 14px;
    height: 40px;
	display: flex;
	justify-content: space-between;
	line-height: 40px;
  }

  .my-exam-tab__top {
    margin: 0px 14px;
  }

  .my-exam-tab__topn {
    color: #9e9e9e;
	margin-right:10px;
    font-size: 14px;
  }

  .my-exam-tab__topleft {
    color: #777;
	text-align: right;
    font-size: 14px;
    font-weight: 500;
	margin-left: 20px;
	min-width: 100px;
  }

  .my-exam-tab__topleft image {
    width: 10px;
    height: 10px;
    margin-left: 5px;
  }

  .examMain {
    padding: 10px 15px 50px 15px;
    background: #f5f5f5;
  }

  /* 弹出层 */
  .exam-app .van-btns {
    border: 1px solid #ddd;
    color: #777;
    border-radius: 5px;
  }


  /* 学习图表 */
  .myexam-chart {
    width: 100%;
    margin: 10px auto 0 auto;
    background-color: #fff;
    border-radius: 5px;
    overflow: hidden;
  }

  /* 学习时间 */
  .examBottom {
    position: relative;
    padding-bottom: 160px;
    background: #fff;
  }

  .learn-card {
    background-color: #fff;
    width: calc(100% - 30px);
    height: 76px;
    margin-top: 10px;
    border-radius: 5px;
    overflow: hidden;
    position: absolute;
    top: -50px;
    left: 15px;
    border: 1px solid #f1f2f4;
    box-shadow: 0px 3px 10px #f1f2f4;
    padding-top: 15px;
    z-index: 1;
	display: flex;
	flex-wrap: wrap;
  }

  .learn-card__head {
    text-align: center;
    color: #666;
    font-size: 13px;
  }

  .learn-card__siz {
    text-align: center;
    font-size: 13px;
  }

  .examBottom-position {
    width: 100%;
    box-sizing: border-box;
    position: absolute;
    background: #fff;
    padding: 45px 15px 30px 15px;
    left: 0;
  }

  .middlep_icon {
    margin: 30px 65px 10px;
    text-align: center;
  }

  .middlep_text {
    text-align: center;
    font-size: 14px;
    margin-top: 5px;
  }

  .bottom-btn {
    width: 94%;
    margin: 0 auto;
    height: 31px;
    font-size: 15px;
    color: #fff;
    background-color: #ff795c;
    border-radius: 20px;
    display: flex;
    justify-content: center;
    align-items: center;
    margin-bottom: 10px;
    vertical-align: middle;
    touch-action: manipulation;
    cursor: pointer;
    background-image: none;
    white-space: nowrap;
    width: 100%;
    margin-top: 40px;
    font-family: PingFangSC-Semibold;
    font-weight: 600;
  }

  .middlep-img {
    margin-top: 15px;
  }

  .middlep-img image {
    width: 30px;
    height: 30px;
  }

  /* 气泡显示 */
  .qpIcon {
    width: 100%;
    height: 60px;
    display: flex;
    align-items: center;
    padding-top: 15px;
  }

  .qpIcon-box {
    width: 33.3%;
    height: 40px;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 13px;
    color: #666;
  }

  .qpIcon-box image {
    width: 22px;
    height: 22px;
    margin-right: 5px;
  }

  /* 进度条 */
  .progress-position {
    position: relative;
    width: 100%;
    height: 5px;
    border-radius: 3px;
    background: #fddcdc;
    overflow: hidden;
  }

  .progress-bar1 {
    height: 5px;
    background: #f45050;
    border-radius: 3px;
    position: absolute;
    top: 0;
    left: 0;
  }

  .progress-bar2 {
    height: 5px;
    background: #cce198;
    border-radius: 3px;
    position: absolute;
    top: 0;
    left: 0;
  }

  .progress-bar3 {
    height: 5px;
    background: #ff8d2b;
    border-radius: 3px;
    position: absolute;
    top: 0;
    left: 0;
  }

  .learn-card__span {
    font-size: 24px;
    /* font-family: PingFangSC-Medium; */
    font-weight: 500;
    color: #333;
  }
</style>
