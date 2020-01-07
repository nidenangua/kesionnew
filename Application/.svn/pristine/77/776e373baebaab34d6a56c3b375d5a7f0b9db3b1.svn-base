<template>
  <div>
    <div class="course_header">
      
      <!--点播播放器-->
      <video-player
        class="course-defaultpic"
        ref="videoPlayer"
        @buy="buyCourse"
        v-if="playMediaType === 'video'"
      />
      <audio-player
        :list="audioList"
        :current.sync="currentAudio"
        :isbuy="info.isbuy"
        :slide="info.slide"
        @buy="buyCourse"
        @change="onAudioPlayChange"
        v-else-if="playMediaType === 'audio'"
      />
      <ks-image border-radius="0px" class="course-defaultpic" :src="info.defaultpic" v-else>
        <span class="err-tips" v-if="errTips">{{errTips}}</span>
        <div class="head-bottom-box">
          <div class="course_count">
            <div class="joined-wrap">
              <span class="is-relay" v-if="infoType == 'course'">{{getCourseType(info)}}</span>
              <div class="num-tip">
                <span class="num">{{info.studentcount || info.soldnum}}人学习</span>
              </div>
            </div>
          </div>
        </div>
      </ks-image>
    </div>
    <div class="course_info">
      <div
        class="gift-btn ks-fr"
        @click="share"
        v-if="$store.state.userInfo.usertype > 0 || info.chargetype != 1"
      >
        <i class="ks-icon ks-icon-share-outline"></i>
        <p>分享</p>
      </div>
      <div class="gift-btn ks-fr" @click="gift" v-else>
        <i class="ks-icon ks-icon-gift-outline"></i>
        <p>送好友</p>
      </div>
      <div class="title">{{info.title}}</div>
      <div class="topic-count" v-if="info.courseType==5">
        <span>{{info.studentcount}} 人购买</span>
        <span class="topic-count-tag">仅剩{{info.json.surplus_num}}席</span>
      </div>
      <div
        class="topic-count ks-color-info"
        v-else-if="infoType == 'course' && info.coursehour == 1"
      >
        <span v-if="info.hourcount < info.expecthour">已开课{{info.hourcount}}节</span>
        <span v-else>更新完结</span>
        | 共{{info.expecthour}}节课
      </div>
      <div class="topic-count ks-color-info" v-if="info.courseType != 5">{{info.shortdesc}}</div>
      <div class="topic-count ks-color-info" v-if="beginDate && endDate">{{getSatrtTime()}}</div>
      <div class="course-price-box">
        <div class="price-wrap">
          <div
            class="purchased"
            v-if="info.chargetype == 1 && info.isbuy == 1 && info.gift != 3"
          >{{(info.buytype == 1 && '享全站免费特权') || (info.buytype == 2 && '专栏免费') || '已购买'}}</div>
          <div class="price" v-else-if="info.chargetype == 1">
            <strong>
              <i>￥</i>{{Number(info.price)}}
            </strong>
            <span class="price-market" v-if="info.price_market">￥{{info.price_market}}</span>
          </div>
          <div class="price" v-else-if="info.chargetype == 0">
            <i>免费</i>
          </div>
        </div>
      </div>
      <div class="class-time-address" v-if="info.courseType==5">
        <div class="ks-line"></div>
        <p>开课时间：{{formatTimestamp(info.json.date3*1000)}} - {{formatTimestamp(info.json.date4*1000)}}</p>
        <div class="ks-line"></div>
        <p v-if="info.json.address">上课地点: {{info.json.address}}</p>
      </div>
      <!-- vip -->
      <div class="coursevip" v-if="info.is_vip_open==1 && info.isbuy != 1 &&((info.isvip==1 || info.isvip==2)||(info.isvip==0 && info.is_whole == 1))">
          <div class="coursevip-con">
              <a v-if="info.isvip==1">开通VIP本课程免费学,SVIP享受更多权益</a>
              <a v-if="info.isvip==2">开通SVIP本课程免费学,享受更多权益</a>
              <a v-if="info.isvip==0 && info.is_whole == 1">SVIP享受全站课程免费</a>
          </div>
          <div class="coursevip-btn">
              <button @click="goOpen()">立即开通 <img src="@/m/assets/user/user_right.png" alt="" class="userpng"></button>
          </div>
      </div>
    </div>
    <!-- <div ref="audio" v-if="playMediaType === 'audio'">
    </div> -->
  </div>
</template>
<script>
import AudioPlayer from "@/m/components/audio-player"
import VideoPlayer from "@/plugins/video-player"

export default {
  name: "ItemHeader",
  components: {
    VideoPlayer,
    AudioPlayer
  },
  props: {
    is_join:[Number,String,null],
    audition_time:Array,
    info: {
      type:Object,
      default(){
        return {}
      }
    },
    infoType: String,
    errTips: String,
    /**当前时间 */
    nowTime: {
      type: Number,
      default: 0
    },
    /**开始时间 */
    beginDate: Number,
    /**结束时间 */
    endDate: Number,
    /**请好友看活动id */
    freeid:[String,Number],
    /**请好友看课时id */
    chapterid:[String,Number],

    /** 课时信息 */
    chapterInfo:{
      type:Array,
      default(){
        return []
      }
    }
  },
  data() {
    return {
      /**播放媒体类型 */
      playMediaType: "",
      /**当前播放的音频 */
      currentAudio:0,
      /**课时列表 */
      audioList:[]
    };
  },
  watch:{
    chapterInfo:{
      handler(data){
        if(this.info.courseType == 3){
          var periodList = this.getPeriodList(data)
          var audioList = []
          
          periodList.map(item=>{
            item.json = item.json || {}
            audioList.push({
              audition_time:item.json.audition_time,
              is_try_see:item.is_try_see,
              chapterid:item.chapterid,
              cover:this.info.defaultpic,
              src:item.videoId,
              title:item.title,
            })
          })
          this.audioList = audioList
        }
        
      },
      deep:true,
      immediate:true
    }
  },
  computed: {
    /**格式化时间 */
    formatTimestamp() {
      /**
       * @param {Number} 时间戳
       */
      return function(time) {
        let data = new Date(parseInt(time));
        let y = data.getFullYear();
        let m = data.getMonth() + 1;
        let d = data.getDate();
        let h = data.getHours();
        let mm = data.getMinutes();
        let s = data.getSeconds();
        m = m < 10 ? "0" + m : m;
        d = d < 10 ? "0" + d : d;
        h = h < 10 ? "0" + h : h;
        mm = mm < 10 ? "0" + mm : mm;
        s = s < 10 ? "0" + s : s;
        return m + "月" + d + "日" + " " + h + ":" + mm;
      };
    }
  },
  mounted() {
    console.log(this.info)
    setInterval(() => {
      this.$emit("update:nowTime", this.nowTime + 60);
    }, 60000);
  },
  methods: {
    goOpen() {
      if(this.info.isvip==1) {
        this.$router.push('/user/uservip?type=0')
      }else {
        this.$router.push('/user/uservip?type=1')
      }
    },
    /**
     * 获取课时列表
     */
    getPeriodList(data,list = []){
      if(data && data.length){
        data.map(item=>{
          if(item.depth == 3){
            list.push(item)
          }else if(item.Section){
            this.getPeriodList(item.Section,list)
          }else if(item.keshi){
            this.getPeriodList(item.keshi,list)
          }
        })
        return list
      }else{
        return list
      }
    },
    /**
     * 赠送
     */
    gift() {
      let queryObj = {};
      if(this.freeid && this.chapterid){
        queryObj.free_id = this.freeid;
        queryObj.chapterid = this.chapterid;
      }
      this.$router.push({
        name: "ShowGift",
        params: {
          id: this.$route.params.id
        },
        query:queryObj
      });
      
    },
    /**
     * 购买课程
     */
    buyCourse() {
      this.$showPay({
        payid: this.info[`${this.infoType}id`],
        type: this.infoType,
        msg: "购买课程",
        price: this.info.price
      });
    },
    /**
     * 分享
     */
    share() {
      this.$showShareBg();
    },
    
    /**
     * 获取课程类型
     */
    getCourseType(info) {
      if (info.courseType == 1) {
        return "点播";
      } else if (info.courseType == 2) {
        if (info.livetype == 1) {
          return "一对一";
        } else if (info.livetype == 2) {
          return "小班";
        } else if (info.livetype == 3) {
          return "千人直播";
        } else if (info.livetype == 4) {
          return "语音";
        }
      } else if (info.courseType == 3) {
        return "音频";
      } else if (info.courseType == 4) {
        return "图文";
      } else if (info.courseType == 5) {
        return "面授";
      }
    },
    /**
     * 播放媒体
     */
    playMedia(info) {
      this.playMediaType = info.mediaType;
      this.$nextTick(() => {
        if (info.mediaType === "video") {
          this.$refs.videoPlayer.play(info,this.chapterInfo[0]);
        } else if (info.mediaType === "audio") {
          this.audioList.map((item,i)=>{
            if(item.chapterid == info.chapterid){
              this.currentAudio = i
            }
          })
        }
      });
    },
    /**
     * 获取开始时间
     */
    getSatrtTime() {
      if (this.nowTime > 0) {
        if (this.nowTime > this.endDate) {
          return "直播已结束";
        } else {
          let time = this.beginDate - this.nowTime;
          if (time > 0) {
            let day = Math.floor(time / 86400);
            if (day > 0) {
              if (day < 30) {
                return `开课时间：倒计时 ${day}天后`;
              } else {
                let date = new Date(this.beginDate * 1000);
                let y = date.getFullYear();
                let m = date.getMonth();
                let d = date.getDay();
                let mm = date.getMinutes();
                let ss = date.getSeconds();
                return `${y}年${m}月${d}日 ${mm > 9 ? mm : "0" + mm}:${
                  ss > 9 ? ss : "0" + ss
                }`;
              }
            } else {
              let hour = Math.floor(time / 3600);
              if (hour > 0) {
                return `开课时间：倒计时 ${hour}小时后`;
              } else {
                let minute = Math.floor(time / 60);
                if (minute > 0) {
                  return `开课时间：倒计时 ${minute}分钟后`;
                } else {
                  return `开课时间：倒计时 ${time}秒后`;
                }
              }
            }
          } else {
            return "直播即将开始";
          }
        }
      }
    },
    /**
     * 音频播放变化
     */
    onAudioPlayChange(e){
      this.$emit('audioChange',e)
    }
  }
};
</script>
<style scoped>
.gift-btn {
  width: 50px;
  text-align: center;
}
.gift-btn .ks-icon {
  width: 24px;
  height: 24px;
  font-size: 24px;
  line-height: 24px;
  text-align: center;
  color: var(--ornament-color);
  display: block;
  margin: 0 auto;
}
.gift-btn p {
  color: var(--ornament-color);
  line-height: 20px;
}
.course_header {
  position: relative;
  overflow: hidden;
  width: 100%;
  height: 0;
  height: 11.5rem;
}
.course_header .course-defaultpic {
  position: absolute;
  top: 0;
  left: 0;
  z-index: 1;
  width: 100%;
  height: 100%;
}
.course_header .course-defaultpic .head-icon {
  width: 100%;
  height: 100%;
}
.course_header .course-defaultpic .err-tips {
  width: 90px;
  height: 30px;
  border-radius: 50px;
  background: rgba(0, 0, 0, 0.4);
  color: #fff;
  left: 50%;
  margin-left: -45px;
  top: 50%;
  margin-top: -15px;
  text-align: center;
  position: absolute;
  z-index: 9;
  line-height: 30px;
}

.head-bottom-box {
  width: 100%;
  height: 44px;
  line-height: 44px;
  overflow: hidden;
  position: relative;
  bottom: 0;
  left: 0;
  position: absolute;
}
.head-bottom-box::after {
  content: "";
  height: 44px;
  background: linear-gradient(rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.4));
  position: absolute;
  width: 100%;
  bottom: 0;
  left: 0;
  z-index: 8;
}
.head-bottom-box .course_count {
  position: relative;
  z-index: 9;
  background: url(../../../assets/course/count.png) no-repeat 10px 50%;
  background-size: auto 14px;
  padding-left: 20px;
}
.joined-wrap {
  -webkit-box-flex: 1;
  -webkit-flex: auto;
  -moz-box-flex: 1;
  flex: auto;
  margin-left: 8px;
  display: -webkit-box;
  display: -webkit-flex;
  display: -moz-box;
  display: flex;
  -webkit-box-align: center;
  -webkit-align-items: center;
  -moz-box-align: center;
  align-items: center;
}
.joined-wrap .is-relay {
  font-size: 12px;
  background: rgba(0, 0, 0, 0.3);
  color: #fff;
  height: 20px;
  line-height: 20px;
  padding: 0 8px;
  position: absolute;
  border-radius: 4px;
  right: 10px;
  bottom: 12px;
}
.joined-wrap .pic {
  display: inline-block;
  width: 14px;
  height: 14px;
  -webkit-border-radius: 27px;
  border-radius: 27px;
  border: 2px solid #fff;
  -webkit-background-size: 100% 100%;
  background-size: 100%;
  position: relative;
}
.joined-wrap .num-tip {
  margin-left: 3px;
  display: -webkit-box;
  display: -webkit-flex;
  display: -moz-box;
  display: flex;
  -webkit-box-align: center;
  -webkit-align-items: center;
  -moz-box-align: center;
  align-items: center;
  -webkit-box-pack: center;
  -webkit-justify-content: center;
  -moz-box-pack: center;
  justify-content: center;
  font-weight: 700;
  color: #fff;
  font-size: 12px;
}

.course_info {
  background-color: #fff;
  padding: 15px;
}
.course_info .title {
  display: -webkit-box;
  line-height: 24px;
  -webkit-box-orient: vertical;
  -webkit-line-clamp: 2;
  overflow: hidden;
  font-weight: 700;
  margin-bottom: 5px;
  font-size: 18px;
  text-align: left;
}

.course_info .flex-con {
  display: -webkit-box;
  display: -webkit-flex;
  display: -moz-box;
  display: flex;
  margin-bottom: 0;
}
.course_info .topic-count {
  font-size: 12px;
  margin-bottom: 15px;
  line-height: 20px;
}
.course_info .topic-count-tag {
  margin-left: 5px;
  padding: 2px 5px;
  color: #e64a3b;
  border: 1px solid #e64a3b;
}
.course_info .class-time-address {
  padding-top: 12px;
  color: #666666;
}
.course_info .class-time-address p {
  font-size: 15px;
  padding: 12px 0;
}

.course_info .price-wrap {
  display: -webkit-box;
  display: -webkit-flex;
  display: -moz-box;
  display: flex;
  -webkit-box-align: center;
  -webkit-align-items: center;
  -moz-box-align: center;
  align-items: center;
}
.price-wrap .purchased {
  color: var(--ornament-color);
  background: #fff3f2;
  padding: 3px 10px;
  border-radius: 4px;
  font-weight: bold;
}
.price-wrap .price {
  font-size: 24px;
  margin-right: 10px;
  color: var(--ornament-color);
  font-weight: bold;
}
.price-wrap .price i {
  font-size: 16px;
  font-style: normal;
}
.price-wrap .price-market {
  text-decoration: line-through;
  color: var(--prompt-color);
  font-weight: normal;
  font-size: 13px;
  margin-left: 5px;
}

#audio {
  background: #fff;
  padding: 15px 10px 10px 10px;
  margin-top: 10px;
  margin-bottom: 10px;
}

.coursevip{
  padding: 0 5px;
  height: 44px;
  background-color: #ffe8d3;
  color: #b4732f;
  display: flex;
  align-items: center;
  justify-content: space-between;
  font-size: 13px;
  box-sizing: border-box;
}
.coursevip-btn button{
  height: 30px;
  line-height: 30px;
  padding: 0 5px 0 13px;
  border-radius: 20px;;
  border: none;
  background-image: linear-gradient(to right, #ff9500 , #fd4747);
  list-style: none;
  color: #fff;
}
.userpng{
  vertical-align: text-top;
  width: 14px;
  height: 14px;
}
</style>

