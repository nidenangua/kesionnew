<template>
  <div class="course-play" v-if="info!=null">
    <div class="course-play__bg" :style="{backgroundImage:'url('+info.defaultpic+')'}"></div>
    <ks-container margin-top="0px">
      <div class="course-play__top" :class="{bigScreen:big==true}">
        <div class="course-play__top-bg"></div>
        <div class="course-play__top-box">
          <div
            class="course-play__left"
            :style="{width:(menuShow == false && '100%')||(menuShow == true && '75%')}"
          >
            <div class="course-play__left-top">
              <div class="course-play__prev">
                <div class="course-play__prev-btn1" :class="{disabled:index<=0}" @click="prev">
                  <i class="el-icon-arrow-up"></i>
                </div>
                <div class="course-play__prev-btn2" @click="showMenu">
                  <p>
                    <img v-if="menuShow==true" src="@/pc/assets/play/lesson_btn_pullright.png">
                    <img v-else src="@/pc/assets/play/lesson_btn_pullleft.png">
                  </p>
                </div>
              </div>
              <div class="course-play__title">
                <div class="course-play__title-left">
                  <p
                    v-if="index==-1"
                  >{{(info.courseType==1 && '点播') || (info.courseType==2 && '直播') || (info.courseType==3 && '音频') || (info.courseType==4 && '图文')}}课程</p>
                  <p v-else-if="chapterType==0">{{chapterNum}}.{{sectionNum}} - 课时{{keshiNum}}</p>
                  <p v-else-if="chapterType==1">{{chapterNum}} - 课时{{keshiNum}}</p>
                  <p v-else-if="chapterType==2">课时{{keshiNum}}</p>
                  {{index==-1 ? info.title : keshiName}}
                </div>
                <!-- <span>学过了</span> -->
              </div>
            </div>
            <div
              class="course-play__left-middle"
              :style="{backgroundImage:playMediaType ? '' : 'url('+info.defaultpic+')'}"
            >
              <!--视频播放器-->
              <video-player ref="player" v-if="playMediaType === 'video'" style="width:100%;height:100%;" @buy="openBuy" />
              <div v-else-if="playMediaType === 'audio'">
                <!--音频播放器-->
                <audio-player
                  size="medium"
                  :title="audioInfo.title"
                  :cover="info.defaultpic"
                  :src="audioInfo.src"
                />
              </div>
              <!--图文-->
              <div class="course-tuwen" v-else-if="(playMediaType === 'tuwen')">
                <div v-if="(currentPeriod.freeplay == 1 || Number(info.price) === 0 || info.isbuy == 1)">
                  <div class="ks-content" v-html="currentPeriod.content" v-if="(currentPeriod.freeplay == 1 || Number(info.price) === 0 || info.isbuy == 1) && (is_login || !is_onlogin)">
                   <!--连载图文、免费、已购买显示详细内容-->
                  </div>
                  <div class="nologin_see" v-else>
                      <p>此内容需要登录之后才可以继续观看</p>
                      <el-button type="primary" @click="$showLogin()">立即登录</el-button>
                  </div>
                </div>
                <div v-else>
                  <!--未购买-->
                  <div>
                    <div class="ks-content" v-html="currentPeriod.intro"></div>
                    <div class="buy-article-tips">本内容需要购买之后才能阅读全文</div>
                  </div>
                </div>
              </div>
              <div class="nobuy-view" v-else-if="info.isbuy == 0">
                <div class="nobuy-view__box">
                  <img v-if="info.courseType == 1" src="../../../assets/course/video_btn_video.png">
                  <img
                    v-else-if="info.courseType == 3"
                    src="../../../assets/course/lesson_icon_audio_b.png"
                  >
                  <img
                    v-else-if="info.courseType == 4"
                    src="../../../assets/course/lesson_icon_text.png"
                  >
                  <span @click="openBuy">立即购买(￥{{info.price}})</span>
                </div>
              </div>
            </div>
            <div class="course-play__left-bottom">
              <div
                class="course-play__next"
                :class="{disabled:index>=periodList.length-1}"
                @click="next"
              >
                <i class="el-icon-arrow-down"></i>
              </div>
              <div class="course-play__auto">
                <div class="course-play__auto-right" @click="bigScreen">
                  <img src="@/pc/assets/play/lesson_btn_lagescreen.png">大屏学习
                </div>
                <!-- <div class="course-play__auto-left">
                  <img src="@/pc/assets/play/lesson_btn_autonext_s.png" />
                  自动播放下一课时
                </div>-->
              </div>
            </div>
          </div>
          <div class="course-play__right" v-if="menuShow">
            <div class="course-play__nav">课程目录</div>
            <div class="course-play__chapter">
              <div class="course-play__chapter-line"></div>
              <div class="course-play__chapter-box">
                <div class="course-play__list" v-for="(item,i) in chapterData" :key="i">
                  <div class="course-play__list-title" v-if="chapterType!=2">
                    <i>{{i+1}}</i>
                    第{{i+1}}章 {{item.title}}
                  </div>
                  <!-- 结构为章-节-课时 -->
                  <div v-if="chapterType==0">
                    <div v-for="(section,n) in item.Section" :key="n">
                      <div class="course-play__list-subtitle">
                        <i>{{i+1}}.{{n+1}}</i>
                        第{{n+1}}节 {{section.title}}
                      </div>
                      <div v-for="(keshi,m) in section.keshi" :key="m">
                        <el-tooltip
                          effect="light"
                          class="item"
                          :content="keshi.title"
                          placement="top-start"
                        >
                          <div class="course-play__list-item" @click="plays(keshi)">
                            <div class="course-play__list-bg"></div>
                            <div
                              class="course-play__list-course"
                              :class="{activeKeshi:keshi.index==index}"
                            >
                              <i></i>
                              <span>课时{{m+1}} {{keshi.title}}</span>
                              <!-- <span>06:15<img src="@/pc/assets/play/video_btn_video.png" /></span> -->
                              <p
                                v-if="keshi.freeplay==1 && info.chargetype == 1"
                              >{{info.courseType == 3 ? '免费试听' : '免费试看'}}</p>
                            </div>
                          </div>
                        </el-tooltip>
                      </div>
                    </div>
                  </div>
                  <!-- 结构为章-课时 -->
                  <div v-else-if="chapterType==1">
                    <div v-for="(keshi,m) in item.keshi" :key="m">
                      <el-tooltip
                        class="item"
                        effect="light"
                        :content="keshi.title"
                        placement="top-start"
                      >
                        <div class="course-play__list-item" @click="plays(keshi)">
                          <div class="course-play__list-bg"></div>
                          <div
                            class="course-play__list-course"
                            :class="{activeKeshi:keshi.index==index}"
                          >
                            <i></i>
                            <span>课时{{m+1}} {{keshi.title}}</span>
                            <!-- <span>06:15<img src="@/pc/assets/play/video_btn_video.png" /></span> -->
                            <p
                              v-if="keshi.freeplay == 1 && info.chargetype == 1"
                            >{{info.courseType == 3 ? '免费试听' : '免费试看'}}</p>
                          </div>
                        </div>
                      </el-tooltip>
                    </div>
                  </div>
                  <!-- 结构为课时 -->
                  <div v-else-if="chapterType==2">
                    <el-tooltip
                      class="item"
                      effect="light"
                      :content="item.title"
                      placement="top-start"
                    >
                      <div class="course-play__list-item" @click="plays(item)">
                        <div class="course-play__list-bg"></div>
                        <div
                          class="course-play__list-course"
                          :class="{activeKeshi:item.index==index}"
                        >
                          <i></i>
                          <span>课时{{i+1}} {{item.title}}</span>
                          <!-- <span>06:15<img src="@/pc/assets/play/video_btn_video.png" /></span> -->
                          <p
                            v-if="item.freeplay == 1 && info.chargetype == 1"
                          >{{info.courseType == 3 ? '免费试听' : '免费试看'}}</p>
                        </div>
                      </div>
                    </el-tooltip>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="course-play__bottom">
        <div class="course-play__bottom-left">
          <div class="course-play__bottom-top">
            <p v-if="info.courseType==1">点播</p>
            <p v-else-if="info.courseType==2">直播</p>
            <p v-else-if="info.courseType==3">音频</p>
            <p v-else-if="info.courseType==4">图文</p>
            <h1>{{info.title}}</h1>
            <span v-if="info.chargetype == 1">￥{{info.price}}</span>
            <span v-else>免费</span>
          </div>
          <div class="course-play__bottom-bottom">
            <img src="@/pc/assets/play/lesson_icon_member.png">
            <span>{{info.studentcount}}人学习</span>
            <el-popover placement="top-start" width="200" trigger="hover">
              <img width="200px" :src="info.qrcode">
              <span slot="reference">
                <img src="@/pc/assets/play/lesson_icon_qrcode.png">&nbsp; 手机扫码观看
              </span>
            </el-popover>
          </div>
        </div>
        <div class="course-play__bottom-right">
          <!-- vip购买 -->
          <span class="coursevip" v-if="info.is_vip_open==1 && info.isbuy != 1 &&((info.isvip==1 || info.isvip==2)||(info.isvip==0 && info.is_whole == 1))">
            <a v-if="info.isvip==1">开通VIP本课程免费学,SVIP享受更多权益</a>
              <a v-if="info.isvip==2">开通SVIP本课程免费学,享受更多权益</a>
              <a v-if="info.isvip==0 && info.is_whole == 1">SVIP享受全站课程免费</a>
            <span @click="goOpen(info.isvip)" class="opennow">立即开通>></span></span>
          <el-button
            class="purchased"
            size="medium"
            v-if="info.chargetype == 1 && info.isbuy == 1"
            round
          >{{(info.buytype == 1 && '享全站免费特权') || (info.buytype == 2 && '专栏免费') || '已购买'}}</el-button>
          <el-button
            @click="openBuy"
            type="primary"
            size="medium"
            v-else-if="info.isbuy == 0"
            round
          >立即购买(￥{{info.price}})</el-button>
        </div>
      </div>
    </ks-container>
  </div>
</template>

<script>
import AudioPlayer from "@/pc/components/audio-player";
import VideoPlayer from "@/plugins/video-player";
export default {
  name: "Play",
  components: {
    AudioPlayer,
    VideoPlayer
  },
  props: {
    /**基本信息 */
    info: {
      type: Object,
      default() {
        return {};
      }
    },
    /**目录类型 */
    chapterType: [String, Number],
    /**错误提示 */
    errTips: String,
    /**目录 */
    chapterData: {
      type: Array,
      default() {
        return [];
      }
    }
  },
  data() {
    return {
      is_login:Number,
      is_onlogin:'',
      active: 0,
      /**音频信息 */
      audioInfo: {},
      playMediaType: "",
      big: false,
      menuShow: true,
      keshiName: null,
      chapterNum: 1,
      sectionNum: 1,
      keshiNum: 1,
      /**当前课时信息 */
      currentPeriod: {},
      /**课时列表 */
      periodList: [],
      /**当前课时索引值 */
      index: -1
    };
  },
  watch: {
    chapterData: {
      handler() {
        let newPeriodList = [];
        if (this.chapterType == 0) {
          //章-节-课时结构
          let idx = -1;
          for (let l in this.chapterData) {
            let section = this.chapterData[l].Section;
            for (let ll in section) {
              let keshi = section[ll].keshi;
              for (let lll in keshi) {
                idx++;
                keshi[lll].index = idx;
                keshi[lll].cnum = l;
                keshi[lll].snum = ll;
                newPeriodList.push(keshi[lll]);
              }
            }
          }
        } else if (this.chapterType == 1) {
          let idx = -1;
          //章-课时结构
          for (let l in this.chapterData) {
            let keshi = this.chapterData[l].keshi;
            for (let ll in keshi) {
              idx++;
              keshi[ll].index = idx;
              keshi[ll].cnum = l;
              newPeriodList.push(keshi[ll]);
            }
          }
        } else if (this.chapterType == 2) {
          //课时结构
          for (let l in this.chapterData) {
            this.chapterData[l].index = l;
            newPeriodList.push(this.chapterData[l]);
          }
        }
        this.periodList = newPeriodList;
      },
      deep: true,
      immediate: true
    }
  },
  methods: {
    goOpen(type) {
      if(type==1) {
        this.$router.push('/user/vip?type=0')
      }else {
        this.$router.push('/user/vip?type=1')
      }
    },
    openBuy() {
      this.$showPay({
        price: this.info.price,
        payid: this.info.courseid,
        type: "course"
      });
    },
    /*
     * 播放上一个
     * */
    prev() {
      let _index = this.index - 1;
      if (_index < 0) {
        this.index = 0;
        return false;
      }
      this.setCurrentInfo(this.periodList[_index]);
      this.$emit("change", this.periodList[_index]);
    },
    /*
     * 播放下一个
     * */
    next() {
      let _index = this.index + 1;
      if (_index > this.periodList.length - 1) {
        this.index = this.periodList.length - 1;
        return false;
      }
      this.setCurrentInfo(this.periodList[_index]);
      this.$emit("period-change", this.periodList[_index]);
    },
    /*
     * 切换视频播放
     */
    plays(period) {
      this.playMediaType = "";
      this.setCurrentInfo(period);
      if (this.$refs.videoContainer) {
        this.$refs.videoContainer.innerHTML = "";
      }
      this.$emit("period-change", period);
    },
    /*
     * 菜单栏显示开关
     * */
    showMenu() {
      if (this.menuShow) {
        this.menuShow = false;
      } else {
        this.menuShow = true;
      }
    },
    /*
     * 大屏学习
     */
    bigScreen() {
      this.big ? (this.big = false) : (this.big = true);
    },
    /**
     * 设置当前课时信息
     * @param {Object} 课时对象
     */
    setCurrentInfo(period) {
      this.periodList.map((item, i) => {
        if (`${item.chapterid}` == `${period.chapterid}`) {
          this.keshiName = item.title;
          this.chapterNum = item.cnum ? item.cnum + 1 : 1;
          this.sectionNum = item.snum ? item.snum + 1 : 1;
          this.currentPeriod = item;
          this.keshiNum = i + 1;
          this.index = i;
        }
      });
    },
    playMedia(info) {
      this.setCurrentInfo(info.period);
      this.playMediaType = info.mediaType;
      this.$nextTick(() => {
        if (info.mediaType === "video") {
          this.$refs.player.play(info, info.period);
        } else if (info.mediaType === "audio") {
          this.audioInfo = {
            src: info.videoid,
            title: info.title
          };
        } else if (info.mediaType === "tuwen") {
          this.currentPeriod = info.period;
        }
      });
    }
  },
  created() {
    this.$store.ready(state=>{
      this.is_onlogin = state.is_onloginbrowse
      this.is_login = state.userInfo.userid ? 1 : 0
    })
  },
};
</script>

<style scoped>
.course-play__bottom-left {
  padding: 20px 0 24px 20px;
  float: left;
}
.course-play__bottom-top {
  font-size: 16px;
  color: #fff;
}
.course-play__bottom-top p {
  display: inline-block;
  font-size: 14px;
  width: 36px;
  height: 22px;
  border: 1px solid #fff;
  border-radius: 2px;
  text-align: center;
  line-height: 22px;
}
.course-play__bottom-top h1 {
  display: inline-block;
  font-size: 16px;
  font-weight: normal;
  margin-left: 5px;
}
.course-play__bottom-top span {
  color: #ffb400;
  margin-left: 25px;
  font-weight: bold;
}
.course-play__bottom-bottom {
  font-size: 14px;
  color: #babdbf;
  line-height: 20px;
  height: 20px;
  margin-top: 16px;
}
.course-play__bottom-bottom img {
  float: left;
  margin-top: 3px;
}
.course-play__bottom-bottom span {
  margin-right: 47px;
  margin-left: 3px;
  float: left;
}
.bdsharebuttonbox {
  float: left;
  margin-top: -4px;
}
.bds_more {
  font-size: 14px !important;
  color: #babdbf !important;
}
.course-play__bottom-right {
  float: right;
  padding-top: 31px;
  padding-right: 20px;
}
.course-play__bottom-right .purchased {
  border: 1px solid #fff;
  background: none;
  color: #fff;
  opacity: 0.6;
  cursor: default;
}

/*  */
.course-play {
  width: 100%;
  padding: 50px 0;
  position: relative;
  overflow: hidden;
}
.course-play::after {
  content: "";
  width: 100%;
  height: 100%;
  position: absolute;
  left: 0;
  top: 0;
  z-index: 9;
  background: rgba(0, 0, 0, 0.5);
}
.course-play__bg {
  width: 100%;
  height: 100%;
  filter: blur(50px);
  background-repeat: no-repeat;
  background-size: cover;
  background-position: 50% 50%;
  position: absolute;
  left: 0;
  top: 0;
}
.course-play__bg-opacity {
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.2);
}

.course-play__top {
  height: 680px;
  position: relative;
  background: #5c5e60;
  z-index: 10;
}
.course-play__top-bg {
  position: absolute;
  width: 4px;
  height: 100%;
  background: #2d3336;
  top: 0;
  left: 84px;
  z-index: 1;
}
.course-play__top-box {
  position: absolute;
  width: 100%;
  height: 100%;
  top: 0;
  left: 0;
  z-index: 10;
}
.course-play__left {
  width: 75%;
  height: 100%;
  float: left;
}
.course-play__left-top {
  width: 100%;
  height: 99px;
  color: #babdbf;
  font-size: 14px;
}
.course-play__prev {
  width: 100%;
  height: 24px;
  padding-top: 11px;
}
.course-play__prev-btn1,
.course-play__next {
  width: 48px;
  height: 24px;
  background: rgba(255, 255, 255, 0.3);
  box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
  border-radius: 2px;
  position: relative;
  margin-left: 60px;
  float: left;
  text-align: center;
  line-height: 24px;
  font-size: 18px;
  color: #fff;
}

.course-play__prev-btn2 {
  float: right;
  width: 26px;
  height: 24px;
  position: relative;
  background: #707679;
  box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.05);
  border-radius: 2px 0 0 2px;
  cursor: pointer;
}
.course-play__prev-btn2 p {
  position: absolute;
  left: 50%;
  margin-left: -7px;
  top: 4px;

  width: 14px;
  height: 14px;
}
.course-play__title {
  height: 28px;
  width: 100%;

  margin-top: 12px;
}
.course-play__title-left {
  padding-left: 20px;
  font-size: 14px;
  line-height: 28px;
  color: #babdbf;
  float: left;
}
.course-play__title-left p {
  display: inline-block;
  width: 148px;
  height: 28px;
  background: #2d3336;
  border-radius: 14px;
  color: #929a9e;
  text-align: center;
  z-index: 100;
  margin-right: 8px;
}
.course-play__title span {
  width: 81px;
  height: 24px;
  border: 1px solid #babdbf;
  border-radius: 12px;
  line-height: 24px;
  font-size: 14px;
  color: #babdbf;
  text-align: center;
  float: right;
  margin-right: 20px;
  margin-top: 1px;
}
.course-play__left-middle {
  width: 100%;
  height: calc(100% - 145px);
  background-position: 50% 50%;
  background-size: cover;
  background-repeat: no-repeat;
  position: relative;
}
.course-play__left-middle .audio-player {
  height: 100%;
  position: absolute;
  width: 100%;
  left: 0;
  top: 0;
}
.course-play__left-bottom {
  height: 46.2px;
}
.course-play__next {
  margin-top: 11px;
}
.course-play__auto {
  float: right;
  margin-top: 15px;
}
.course-play__auto-left {
  float: right;
  font-size: 14px;
  color: #babdbf;
  margin-right: 40px;
  height: 16px;
  line-height: 16px;
}

.course-play__auto-left img {
  float: left;
  margin-right: 7px;
}
.course-play__auto-right {
  float: right;
  font-size: 14px;
  color: #babdbf;
  margin-right: 30px;
  height: 16px;
  line-height: 16px;
  cursor: pointer;
}
.course-play__auto-right img {
  float: left;
  margin-right: 7px;
}
.course-play__right {
  width: 25%;
  height: 100%;
  float: right;
}
.course-play__nav {
  width: 100%;
  height: 36px;
  font-size: 14px;
  text-align: center;
  color: #fff;
  line-height: 36px;
  box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.08);
  background: #707679;
}

.course-play__chapter {
  width: 100%;
  position: relative;
  height: calc(100% - 40px);
  background: #666a6c;
  margin-top: 4px;
}
.course-play__chapter-line {
  width: 1px;
  height: 100%;
  position: absolute;
  left: 20px;
  top: 0;
  background: #cccccc;
  z-index: 1;
}
.course-play__chapter-box {
  width: 100%;
  height: 100%;
  position: absolute;
  top: 0;
  left: 0;
  z-index: 10;
  overflow: auto;
}
.course-play__list {
  width: 100%;
}
.course-play__list-title {
  width: 100%;
  height: 22px;
  color: #fff;
  font-size: 14px;
  background: #666a6c;
  margin: 22px 0;
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
}

.course-play__list-title i {
  font-style: normal;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 50%;
  width: 20px;
  height: 20px;
  line-height: 20px;
  text-align: center;
  color: #e6e6e6;
  margin-left: 9px;
}

.course-play__list-subtitle {
  width: 100%;
  height: 22px;
  color: #fff;
  font-size: 14px;
  background: #666a6c;
  margin: 11px 0;
}

.course-play__list-subtitle i {
  font-style: normal;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 11px;
  width: 30px;
  height: 20px;
  line-height: 20px;
  text-align: center;
  color: #e6e6e6;
  margin-left: 4px;
}
.course-play__list-item {
  width: 100%;
  height: 44px;
  position: relative;
}
.course-play__list-bg {
  width: 1px;
  height: 44px;
  position: absolute;
  left: 20px;
  background: #ccc;
}
.course-play__list-course {
  position: absolute;
  left: 0;
  top: 0;
  width: 100%;
  height: 44px;
  line-height: 44px;
  color: #fff;
  font-size: 14px;
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
}
.course-play__list-course span {
  display: inline-block;
  max-width: 65%;
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
}
.course-play__list-course:hover {
  background: #2d3336;
  color: #fff;
}
.course-play__list-course:hover i {
  margin-top: 14px;
  border: 1px solid #fff;
  background: #2d3336;
}

.course-play__list-course i {
  font-style: normal;
  border: 1px solid #ccc;
  border-radius: 50%;
  width: 14px;
  height: 14px;
  line-height: 14px;
  margin-top: 14px;
  margin-left: 12px;
  float: left;
  margin-right: 5px;
  background: #585e61;
}
.activeKeshi {
  background: #2d3336;
  color: #fff;
}
.activeKeshi i {
  background: #285cc6 !important;
  border: 1px solid #ccc;
}
.course-play__list-course p {
  padding: 0 8px;
  height: 22px;
  border: 1px solid #2dc843;
  border-radius: 3px;
  color: #2dc843;
  font-size: 12px;
  line-height: 22px;
  text-align: center;
  float: right;
  margin-right: 5px;
  margin-top: 10px;
}

.course-play__list-course span img {
  float: right;
  margin-top: 12px;
  margin-left: 5px;
  width: 20px;
  height: 20px;
}
.course-play__bottom {
  height: 98px;
  background: #686c6f;
  position: relative;
  z-index: 10;
}
.bigScreen {
  width: 100%;
  height: 100%;
  margin: 0;
  position: fixed;
  top: 0;
  left: 0;
  z-index: 2000;
}
.course-player {
  width: 100%;
  height: 100%;
}
.disabled {
  opacity: 0.6;
  cursor: no-drop;
}

/*图文样式*/
.course-tuwen {
  padding: 20px;
  background: #fff;
  position: relative;
  height: 100%;
  box-sizing: border-box;
  overflow-y: auto;
}
.nobuy-view {
  width: 100%;
  height: 100%;
  position: relative;
}
.nobuy-view::after {
  content: "";
  width: 100%;
  height: 100%;
  position: absolute;
  left: 0;
  top: 0;
  background: rgba(0, 0, 0, 0.5);
}
.nobuy-view__box {
  position: absolute;
  width: 200px;
  height: 200px;
  left: 50%;
  top: 50%;
  margin-left: -100px;
  margin-top: -100px;
  text-align: center;
  line-height: 50px;
  z-index: 2;
}
.nobuy-view__box img {
  margin-top: 50px;
}
.nobuy-view__box span {
  display: inline-block;
  width: 160px;
  height: 36px;
  border: 1px solid #fff;
  border-radius: 18px;
  line-height: 36px;
  color: #fff;
  text-align: center;
  font-size: 14px;
  cursor: pointer;
}

.buy-article-tips {
  border-top: 1px solid #eee;
  text-align: center;
  padding: 75px 0 30px 0;
  font-size: 14px;
  letter-spacing: 1px;
  background: url(../../../assets/course/money.png) no-repeat 50% 30px;
  background-size: auto 34px;
  margin-top: 15px;
}
.coursevip{
  padding: 5px 13px;
  background-color: #ec4a46;
  color: #fff;
  font-size: 14px;
  border-radius: 15px;
  margin-right: 20px;
  cursor: pointer;
}
.opennow{
  text-decoration: underline
}
.nologin_see p {
  margin-bottom: 10px;
}
.nologin_see{
  text-align: center;
  margin-top: 210px
}
</style>

