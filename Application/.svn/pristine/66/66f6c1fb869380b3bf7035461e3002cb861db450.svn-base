<template>
  <div v-if="loaded">
    <paper-medal
      :value="iscorrect == 1 ? sumscore : ''"
      :unit="iscorrect == 1 ? '' : '未批阅'"
      name="得分"
      v-if="type == 1"
    />
    <paper-medal :value="accuracy" unit="%" name="正确率" v-else-if="type == 2" />
    <div class="certificate" v-if="certificate && certificate.id">
        <div>
          <span class="certificate-left">
            <img src="../../assets/certificate/certificateImg.png" alt="" class="certificate-left__img">
            获得<span class="certificate-left__name"> {{certificate.title}} </span>证书
          </span>
        </div>
        <div>
          <span class="certificate-see" @click="seeCertificate">查看证书</span>
        </div>
    </div>
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
          :class="{doing:item.doing == 1,error:item.mark == 'wrong',right:item.mark == 'right'}"
        >{{i+1}}
        </div>
      </div>
    </div>
    
    <div class="paper-submit-box">
      <div class="paper-submit paper-submit--default" @click="viewAnalysis()">查看解析</div>
      <div class="paper-submit" @click="practice">返回练习主页</div>
    </div>
    <cavansPopups :info="certificate" ref="certificate"></cavansPopups>
  </div>
</template>

<script>
import cavansPopups from '../user/user-certificate/components/cavansPopups'
import PaperMedal from "./PaperComponent/PaperMedal";
import { getPerformance } from "@/api/exam";
export default {
  /**做题结果页 */
  name: "ExamResult",
  components: {
    PaperMedal,
    cavansPopups
  },
  data() {
    return {
      /**证书数据 */
      certificate:{
        share_title:'',
        title:'',
        json:{
          comment:''
        },
        cover:'',
        qrcode:''
      },
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
      sumscore: 0
    };
  },
  activated() {
    document.title = "";
    this.answerSheet = [];
    this.id = this.$route.query.id;
    this.type = this.$route.query.type;
    let answerList = [];
    getPerformance({
      answerid: this.id,
      type: this.type
    }).then(res => {
      if (res.result == "success") {
        document.title = res.detail.title;
        this.iscorrect = res.detail.iscorrect;
        this.accuracy = res.detail.accuracy;
        if(res.detail.certificate && res.detail.certificate.id) {
          let {certificate} = this 
          certificate.share_title = res.detail.certificate.share_title
          certificate.title = res.detail.certificate.title
          certificate.json.comment = res.detail.certificate.json.comment
          certificate.cover = res.detail.certificate.cover
          certificate.qrcode = res.detail.certificate.qrcode
          certificate.id = res.detail.certificate.id
          certificate.sumscore = res.detail.certificate.sumscore
          certificate.info_title = res.detail.title
        }
        let tmarr = [];
        res.detail.answer.map((item, i) => {
          if (item.tklist) {
            item.tklist.map(tm => {
              if (res.iscorrect == 0) {
                if (tm.userscore > 0) {
                  tm.right = 1;
                } else {
                  tm.right = 0;
                }
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
        this.sumscore = res.detail.sumscore;
      }
      this.loaded = true;
    });
  },
  methods: {
    /**查看证书 */
    seeCertificate() {
      this.$nextTick(()=>{
        this.$refs.certificate.getcanvas()
      })
    },
    /**
     * 查看解析
     */
    viewAnalysis() {
      this.$router.push({
        path: "/exam/analysis",
        query: {
          id: this.id,
          type:this.type
        }
      });
    },
    /**
     * 继续练习
     */
    practice() {
      this.$router.push("/exam");
    }
  }
};
</script> 
<style scoped>
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
  background: #5185f7;
  color: #fff;
  align-items: center;
  justify-content: center;
}
.paper-submit--default {
  background: #fff;
  color: #5185f7;
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
  background: #5185f7;
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
  background: #5185f7;
  color: #fff;
  border: 1px solid #5185f7;
}
.error {
  background: #ed7c78;
  border: 1px solid #ed7c78;
  color: #fff;
}
.right {
  background: #32d432;
  border: 1px solid #32d432;
  color: #fff;
}
.certificate{
  display: flex;
  justify-content: space-between;
  background-color: #cf9c6e;
  height: 60px;
  line-height: 60px;
  padding: 0 8px;
  box-sizing: border-box;
}
.certificate-see{
  padding: 8px 20px;
  border-radius: 20px;
  color: #fff;
  background-color: #ac7f56;
}
.certificate-left{
  color: #fff
}
.certificate-left__name{
  font-size: 16px;
  font-weight: 600
}
.certificate-left__img{
  width: 30px;
  height: 46px;
  vertical-align: middle;
  margin-right: 8px;
}
.doing {
  background: #5185f7;
  color: #fff;
  border: 1px solid #5185f7;
}
.error {
  background: #ed7c78;
  border: 1px solid #ed7c78;
  color: #fff;
}
.right {
  background: #32d432;
  border: 1px solid #32d432;
  color: #fff;
}
</style>
