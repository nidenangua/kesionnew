<template>
  <div class="course">
    <div class="addcou">
      <div class="course-name">
        <div class="course-title" v-if="$route.query.courseHours !=0">
          <P>课时标题</P>
          <div class="course-import">
            <input
              type="text"
              placeholder="请输入课时标题"
              class="courseInput"
              v-model="courseTitle"
              maxlength="50"
            >
            <span>{{courseTitle.length}}/50</span>
          </div>
        </div>
        <!-- 视频音频情况 -->
        <div
          class="course-audition"
          v-if="$route.query.courseType == 1 ||$route.query.courseType == 3"
        >
          <div class="course-audition__msg">是否可以试听</div>
          <div class="course-audition__switch">
            <ks-switch v-model="audition"></ks-switch>
          </div>
        </div>
        <!-- 试听时间 -->
        <div
          class="course-audition"
          v-if="audition && ($route.query.courseType == 1 ||$route.query.courseType == 3)"
        >
          <div class="course-audition__msg">试听时间</div>
          <div class="course-audition__switch">
            <input type="text" placeholder="请输入试听时间" class="listentime" v-model="lisentime">秒
          </div>
        </div>
        <!-- 上传课程 -->
        <div
          class="course-audition"
          v-if="$route.query.courseType == 1 ||$route.query.courseType == 3"
        >
          <div class="course-audition__msg">上传课程</div>
          <div class="course-audition__upload" @click="courseUpload">
            {{fileId ? '已上传' : '点击上传'}}
            <img
              src="../../../assets/course-manage/common_icon_moreinfor.png"
              alt=""
              class="course-del-right"
            >
          </div>
        </div>
        <!-- 视频音频结束 -->
        <!-- 图文情况  -->
        <div class="course-audition" v-if="$route.query.courseType == 4">
          <div class="course-audition__msg">是否免费阅读</div>
          <div class="course-audition__switch">
            <ks-switch v-model="isRead"></ks-switch>
          </div>
        </div>
        <div class="course-audition" v-if="!isRead && $route.query.courseType == 4">
          <div class="course-audition__msg">试看字数</div>
          <div class="course-audition__switch">
            <input type="text" placeholder="输入可试看字数" class="listentime" v-model="seenum">
          </div>
        </div>
        <div class="course-audition" v-if="$route.query.courseType == 4 && $route.query.courseHours != 0">
          <div class="course-audition__msg">图文详情</div>
          <div class="course-audition__upload" @click="textimg()">
            <span class="textimgdels">{{textimgdel == "" ? "点击编辑" : textimgdel | getContent}}</span>
            <img
              src="../../../assets/course-manage/common_icon_moreinfor.png"
              alt=""
              class="course-del-right imgtextright"
            >
          </div>
        </div>
        <!-- 图文情况结束 -->
        <!-- 直播情况 -->
        <div class="course-audition" v-if="$route.query.courseType == 2">
          <div class="course-audition__msg">开始时间</div>
          <div class="course-audition__upload" @click="isPopShow = !isPopShow">
            {{time.starttime}}
            <img
              src="../../../assets/course-manage/common_icon_moreinfor.png"
              alt=""
              class="course-del-right"
            >
          </div>
        </div>
        <div class="course-audition" v-if="$route.query.courseType == 2">
          <div class="course-audition__msg">直播时长</div>
          <div class="course-audition__upload" @click="livetime">
            {{time.livehovers}}
            <img
              src="../../../assets/course-manage/common_icon_moreinfor.png"
              alt=""
              class="course-del-right"
            >
          </div>
        </div>
        <!-- 直播情况结束 -->
      </div>
    </div>
    <div class="newcourse">
      <ks-button type="success" width="95%" class="ks-btn" @click="save">保存</ks-button>
    </div>
    <van-popup v-model="isPopShow" position="bottom">
      <van-datetime-picker
        v-model="currentDate"
        type="datetime"
        :min-date="minDate"
        :max-date="maxDate"
        @confirm="confirmPicker"
        @cancel="cancelCon"
      />
    </van-popup>
    <tc-vod-uploader
      :wx-id="$store.state.info.wxid"
      ref="tcVodComponent"
      @change="vodChange"
      @progress="vodProgress"
      @uploaded="vodUploaded"
    />
  </div>
</template>

<script>
import TcVodUploader from "@/plugins/tcvod";
import { editHour, showHour } from "@/api/courseManage";
import { setTimeout } from "timers";
export default {
  components: {
    TcVodUploader
  },
  data() {
    return {
      /**是否可以试听 */
      audition: false,
      /**是否可以试阅读 */
      isRead: false,
      /**上传文件名字 */
      uploadName: "点击上传",
      /**课时标题 */
      courseTitle: "",
      isPopShow: false,
      //
      minHour: 10,
      maxHour: 20,
      minDate: new Date(),
      maxDate: new Date(2020, 1, 1),
      currentDate: new Date(),
      /**上传视频 */
      fileId: "",
      /**直播开始时间 */
      time: { starttime: "请选择", livehovers: "请选择", timenum: "" },
      /**图文详情 */
      textimgdel: "",
      /**试看字数 */
      seenum: "",
      /**试听时间 */
      lisentime: "",
      /**直播时间 */
      timenow: ""
    };
  },
  methods: {
    /**课时保存 */
    save() {
      let isread, audition;
      this.isRead == true ? (isread = 1) : (isread = 0);
      this.audition == true ? (audition = 1) : (audition = 0);
      this.textimgdel = localStorage.getItem("imgtext")
      let params = {
        chapterid: this.$route.query.hoursid,
        title: this.courseTitle,
        courseid: this.$route.query.id,
        number: this.seenum,
        content: this.textimgdel,
        freeplay: isread,
        videoId: this.fileId,
        is_audition: audition,
        audition_time: this.lisentime,
        livehours: this.time.timenum,
        begindate: this.timenow
      };
      let {courseTitle,fileId,time,textimgdel} = this
      let courseType = this.$route.query.courseType
      if(!courseTitle && this.$route.query.courseHours != 0) return this.$toast('请输入标题')
      if(!fileId && (courseType == 3 || courseType == 1)) return this.$toast('请上传课程')
      if(time.starttime == "请选择" && courseType == 2) return this.$toast("请选择开始时间")
      if(!time.timenum && courseType == 2) return this.$toast("请选择直播时长")
      if(!textimgdel && courseType == 4 && this.$route.query.courseHours !=0) return this.$toast("请输入图文详情")
      editHour(params).then(res => {
        if (res.result == "success") {
          this.$toast("操作成功", "success");
          let id = this.$route.query.id
          setTimeout(() => {
            if(this.$route.query.courseHours == 1) {
              this.$router.go(-1)
              // this.$router.push(`/manageCourse?id=${id}`);
            }else {
              this.$router.push(`/courseIndex`)
            }
            // this.$router.go(-1)
          }, 500);
          this.courseTitle = ""
          this.seenum = ""
          this.textimgdel = ""
          this.fileId = ""
          this.lisentime = ""
          this.time.timenum =""
          this.timenow =""
          this.time.livehovers = "请选择"
          this.time.starttime = "请选择"
          localStorage.setItem("imgtext",'')
        }
      });
    },
    /**课程上传 */
    courseUpload() {
      let list
      if(this.$route.query.courseType == 3) {
        list = [{
            name: "音频上传",
            type: "2"
          }]
      }else if (this.$route.query.courseType == 1) {
        list = [{
            name: "视频上传",
            type: "1"
          }]
      }
      this.$actionSheet({
        list: list
      }).then(res => {
        if (res.type == 1) {
          this.$refs.tcVodComponent.start();
        } else {
          this.$store.ready(state => {
            this.$upload({
              wxid: state.info.wxid,
              type: "audio",
              uploaded: res => {
                this.fileId = res.path
              }
            });
          });
        }
      });
    },
    /**直播时长 */
    livetime() {
      this.$actionSheet({
        list: [
          {
            name: "1天",
            type: "24"
          },
          {
            name: "5小时",
            type: "5"
          },
          {
            name: "3小时",
            type: "3"
          },
          {
            name: "2.5小时",
            type: "2.5"
          },
          {
            name: "2小时",
            type: "2"
          },
          {
            name: "1.5小时",
            type: "1.5"
          },
          {
            name: "1小时",
            type: "1"
          }
        ]
      }).then(res => {
        this.time.livehovers = res.name;
        this.time.timenum = res.type;
      });
    },
    confirmPicker(value) {
      let time = value.valueOf();
      this.timenow = time;
      this.isPopShow = false;
      var date = value;
      var m = date.getMonth() + 1;
      var d = date.getDate();
      var h = date.getHours();
      var s = date.getMinutes();
      if (m >= 1 && m <= 9) {
        m = "0" + m;
      }
      if (d >= 0 && d <= 9) {
        d = "0" + d;
      }
      var timer =
        date.getFullYear() + "年" + m + "月" + d + "日" + h + "时" + s + "分";
      this.time.starttime = timer;
    },
    cancelCon() {
      this.isPopShow = false;
    },
    /**图文详情 */
    textimg() {
      localStorage.setItem("imgtext",this.textimgdel)
      this.$router.push(`/compile?type=2`);
    },
    /**视频上传 */
    vodChange(file) {
      this.uploadName = file.name;
    },
    vodProgress() {
      this.$showLoading("正在上传中");
    },
    vodUploaded(res) {
      this.$toast("上传成功", "success");
      this.fileId = res.fileId;
    },
    /**列表查询 */
    getlist() {
      if(this.$route.query.hoursid == 0) {
        return
      }else {
        let params = {
        courseid: this.$route.query.id,
        chapterid: this.$route.query.hoursid
        };
        showHour(params).then(res => {
          this.fileId = res.data.videoId
          this.courseTitle = res.data.title;
          res.data.json.is_audition == 0
            ? (this.audition = false)
            : (this.audition = true);
          this.lisentime = res.data.json.audition_time;
          this.time.starttime = res.data.begindate1;
          this.timenow = parseInt(`${res.data.begindate}000`)
          this.time.timenum = res.data.livehours
          this.time.livehovers = `${res.data.livehours}小时`;
          res.data.freeplay == 0 ? (this.isRead = false) : (this.isRead = true);
          this.seenum = res.data.number;
          this.textimgdel = res.data.content;
          localStorage.setItem("imgtext",this.textimgdel)
      });
      }
    }
  },
  created() {
    if (this.$route.query.hoursid) {
      this.getlist();
    }
  },
  filters:{
    getContent(val){
      let text
      text = val.replace(/\<\/?img[^>]+>/g, "[图片]");
      text = val.replace(/\<\/?[^>]+>/g, "");
      return text
    }
  },
  watch: {
    $route: {
      handler(val,old) {
        if (this.$route.query.hoursid && old.name != "compile" && this.$route.name == "addCourse") {
          this.getlist();
        }
        if (this.$route.name == "addCourse") {
          this.textimgdel = localStorage.getItem("imgtext");
        }
        if(val.name == "courseIndex") {
          this.courseTitle = ""
          this.uploadName = ""
          this.time.starttime = "请选择"
          this.time.livehovers = "请选择"
          this.time.timenum = ""
          this.seenum = ""
          this.lisentime = ""
          this.timenow = ""
          this.textimgdel = ""
        }
      }
    }
  }
};
</script>

<style scoped>
* {
  font-size: 15px;
}
.course {
  height: 100vh;
  background-color: #f0f4f7;
  box-sizing: border-box;
}
.addcou {
  padding: 0 10px;
  background-color: #fff;
}
.newcourse {
  background-color: #fff;
  position: fixed;
  bottom: 0;
  text-align: center;
  width: 100%;
  height: 54px;
  display: flex;
  align-items: center;
  justify-content: center;
}
.course-name p {
  margin-bottom: 10px;
}
.course-import {
  border-bottom: 1px solid #f2f2f2;
  padding-bottom: 10px;
  width: 100%;
  display: inline-flex;
  justify-content: space-between;
}
.course-import input,
.listentime {
  font-size: 16px;
  flex: 1;
  border: none;
  list-style: none;
}
.listentime {
  text-align: right;
  padding-right: 5px;
}
.course-import span {
  font-size: 16px;
  padding-left: 20px;
  color: #aaa;
}
.course-audition {
  display: flex;
  justify-content: space-between;
  padding: 15px 0;
  border-bottom: 1px solid #f2f2f2;
}
.course-del-right {
  width: 9px;
  height: 17px;
  vertical-align: sub;
  margin-left: 8px;
}
.course-audition__upload {
  color: #b2b2b2;
}
.course-title {
  padding-top: 10px;
}
.textimgdels {
  display: inline-block;
  width: 200px;
  overflow: hidden;
  white-space: nowrap;
  text-overflow: ellipsis;
  text-align: right;
}
.imgtextright{
  padding-bottom: 5px;
}
</style>
