<template>
  <div v-if="loaded">
    <paper-medal
      :value="iscorrect == 1 ? sumscore : ''"
      :unit="iscorrect == 1 ? '' : '未批阅'"
      name="得分"
      v-if="type == 1"
    ></paper-medal>
    <paper-medal :value="accuracy" unit="%" name="正确率" v-else-if="type == 2"></paper-medal>
    <div class="paper-opear clearfix">
      <div class="paper-opear__right">
        <div class="paper-icon-sign paper-icon-sign--color1">
          <i></i>已做
        </div>
        <div class="paper-icon-sign paper-icon-sign--color5">
          <i></i>正确
        </div>
        <div class="paper-icon-sign paper-icon-sign--color2">
          <i></i>错误
        </div>
        <div class="paper-icon-sign paper-icon-sign--color3">
          <i></i>未做
        </div>
      </div>
    </div>
    <div class="paper-contianer">
      <div class="paper-answer" v-if="answerSheet.length">
        <div
          class="paper-answer__item"
          v-for="(item,i) in answerSheet"
          :key="i"
          :class="{doing:item.doing == 1,error:item.right == 0,right:item.right == 1}"
        >{{i+1}}</div>
      </div>
    </div>

    <div class="white-bg" v-if="course_list&&course_list.length" >
        <h2 class="exam-title">试卷关联课程</h2>
        <ul class="bind-course">
            <li v-for="citem in course_list" :key="citem.courseid" class="clearfix position-relative">
                <div class="bind-course-img mr20 position-absolute">
                   <img :src="citem.photourl" @click="openCourse(citem)" :alt="citem.name">
                </div>
                <div class="bind-course-con">
                    <h3 class="weight-normal" @click="openCourse(citem)">{{citem.name}}</h3>
                    <div class="bind-course-intro">{{htmlfilter(citem.intro)}}</div>
                    <!-- <div class="bind-course-intro" v-html="citem.intro"></div> -->
                    <p class="darkgray-font">{{citem.learncount}}人加入学习</p>
                </div>
            </li>
        </ul>
    </div>
    <div style="height:69px;"></div>
    <div class="paper-submit-box">
      <div class="paper-submit paper-submit--default" @click="viewAnalysis()" v-if="iscorrect&&isLogin==1">查看解析</div>
    </div>
  </div>
</template>

<script>
	import {PaperMedal} from 'components/ks-components/paper-medal/paper-medal'
 import {GetPerformance} from 'api/exam'
export default {
	components:{
		PaperMedal	
	},
  /**做题结果页 */
  data() {
    return {
      loaded: false,
      /**正确率 */
      accuracy: 0,
      /**批卷状态 0未批阅 1已批阅 */
      iscorrect: 0,
      /**题数集合 */
      answerSheet: [],
      /**做题返回的id */
      id: 0,
      /**做题类型 1整卷 2随机 */
      type: 0,
      /**试卷总分数 */
      correctscore: 0,
      /**正确总分数 */
      sumscore: 0,
      /**捆绑课程列表 */
      course_list:[],
	  query:{},
	  isLogin:0
    };
  },
  onLoad(query) {
	  console.log(query)
  	this.query = query
	this.id = this.query.id;
	this.type = this.query.type;
	this.$store.ready(state=>{
		this.isLogin =state.isLogin
	})
  },
  onShow() {
    
    this.answerSheet = [];
    
    var answerList = [];
    GetPerformance({
      answerid: this.id,
      type: this.type,
      paperid:this.query.paperid,
      categoryid:this.query.categoryid
    }).then((res)=> {
      if (res.result) {
      
        this.course_list = res.data.course_list
        this.iscorrect = 1;
        if(this.type==2){
          this.accuracy = res.data.zhunquelv;
        }else{
          this.accuracy = res.data.accuracy;
        }
        
        var tmarr = [];
        res.data.answer.map((item, i)=> {
          if (item.tklist) {
            item.tklist.map((tm)=> {
              // if (res.iscorrect == 0) {
              //   if (tm.userscore > 0) {
              //     tm.right = 1;
              //   } else {
              //     tm.right = 0;
              //   }
              // }
              if (tm.userscore > 0) {
                tm.right = 1;
              } else {
                tm.right = 0;
              }
              if (tm.useranswer && tm.useranswer.toString() !== "") {
                tm.doing = 1;
              } else {
                tm.doing = 0;
              }
              tmarr.push(tm);
            });
          }
        });
        this.answerSheet = tmarr;
        this.sumscore = res.data.sumscore;
      }else{
        this.iscorrect = 0;
      }
      this.loaded = true;
    });
  },
  methods: {
    openExam(){
		uni.navigateTo({
			url:`/pages/exam/index?categoryid=${this.query.categoryid}`
		})
    },
    openCourse(item){
      uni.navigateTo({
        url:'/pages/web/web?title='+item.name+'&url='+encodeURIComponent(item.view_url)
      })
    },

    htmlfilter(val){
      if(val){
          //let img = require('@/assets/common/icons.png')
          val = val.replace(/\<img[^>]+>/g,'')
          val = val.replace(/(\<[^>]+>)|&nbsp;/gi,'').trim()
          //val = val.replace(/{{img}}/g,  `<img src="${img}" />`)
          return val
      }else{
          return ''
      }
    },
    /**
     * 查看解析
     */
    viewAnalysis() {
		uni.navigateTo({
			url:`/pages/exam/analysis?name=analysis&categoryid=${this.query.categoryid}&id=${this.id}&type=${this.type}&paperid=${this.query.paperid}&title=${this.query.title}`
		})
     
    },
    /**
     * 继续练习
     */
    practice() {
      thisr.push({
        name:'exam'
      });
      
    }
  }
};
</script> 
<style scoped>
.van-icon-arrow-left{
  color: #4d4c4c !important;
}
.paper-contianer {
  padding: 20px 15px;
  border-bottom: 1px solid #eee;
  margin-bottom: 20px;
  background: #fff;
  width: 100%;
  box-sizing: border-box;
}
.paper-contianer-title {
  font-size: 14px;
  color: #3e4754;
  line-height: 24px;
}
.paper-title {
  font-size: 16px;
  padding: 20px;
  background: #fff;
}

.paper-answer {
  display: flex;
  flex-wrap: wrap;
  padding-bottom: 20px;
}
.paper-answer__item {
  width: 45px;
  height: 45px;
  line-height: 45px;
  border-radius: 50%;
  border: 1px solid #ddd;
  color: #999;
  text-align: center;
  font-size: 15px;
  margin: 10px;
}
.paper-submit-box {
  line-height: 49px;
  width: 100%;
  font-size: 16px;
  position: fixed;
  bottom: 0;
  left: 0;
  z-index: 100;
  display: flex;
}
.paper-submit {
  line-height: 49px;
  display: flex;
  flex: 1;
  background: #fff;
  color: #2987EE;
  align-items: center;
  justify-content: center;
}
.paper-submit--default {
  background: #2987EE;
  color: #fff;
  text-align: center;
}
.paper-icon-sign {
  display: inline-block;
  padding-left: 20px;
  font-size: 13px;
  color: #8f8f8f;
  position: relative;
  margin-left: 5px;
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
  background: #2987EE;
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
.paper-opear {
  width: 100%;
  box-sizing: border-box;
  padding: 15px 0;
  background: #f1f1f1;
}
.paper-icon-sign--color4 {
  padding-right: 20px;
}

.paper-opear__right {
  float: right;
  margin-right: 15px;
}

.doing {
  background: #ffb03b;
  color: #fff;
  border: 1px solid #ffb03b;
}
.error {
  background: #2987EE;
  border: 1px solid #2987EE;
  color: #fff;
}
.right {
  background: #32d432;
  border: 1px solid #32d432;
  color: #fff;
}
.exam-title{
  padding: 0 0.5rem;
  font-size: 0.8rem;
  font-weight: normal;
}
.white-bg{
  background: #fff;
  padding: 0.75rem;
}
.bind-course li{
  position: relative;
  padding-left: 8rem;
  min-height: 4.5rem;
  padding-top: 0.5rem;
  padding-bottom: 0.5rem;
  margin-bottom: 0.75rem;
  border-bottom: 1px solid #eee;
}
.bind-course li:last-child{
  border: none;
  margin-bottom: 0;
}
.bind-course-img{
  width: 7.5rem;
  height: 4.5rem;
  position:absolute;
  left: 0;
  top: 0.5rem;
  overflow: hidden;
  border-radius: 0.1rem;
}
.bind-course-img img{
  width: 100%;
  height: 100%;
  object-fit: cover;
}
.bind-course-con h3{
  font-size: 16px;
  font-weight: normal;
  margin-bottom: 0.5rem;
}
.bind-course-intro{
  font-size: 14px;
  margin-bottom: 0.5rem;
  height: 1.6rem;
  line-height: 1.6rem;
  overflow: hidden;
}
.darkgray-font{
  color: #8f8f8f;
}
</style>
