<template>
  <div v-if="courseInfo">
    <!-- 播放 -->
    <play
      :info="courseInfo"
      :chapter-data="chapter"
      :chapter-type="chapterType"
      :err-tips="errTips"
      @period-change="play"
      ref="play"
      v-if="courseInfo.coursehour == 1"
    />
    <play-dan
      :info="courseInfo"
      :err-tips="errTips"
      :now-time.sync="nowTime"
      :period-data="chapter[0]"
      ref="play"
      v-else
    />
    <ks-container>
      <el-row :gutter="20" style="margin-top:20px;">
        <el-col :span="17">
          <ks-card title="课程详情">
            <!--图文-->
            <div class="ks-content" v-if="courseInfo.courseType == 4">
              <!--连载图文、免费、已购买显示详细内容-->
              <!--                   <div class="nologin_see" v-else>
                      <p>此内容需要登录之后才可以继续观看</p>
                      <el-button type="primary">立即登录</el-button>
                  </div> -->
              <div v-if="courseInfo.coursehour == 1 || isCanLearn">
                  <div v-if="is_login || !is_onlogin">
                    <div v-html="courseInfo.content"></div>
                  </div>
                  <div class="nologin_see" v-else>
                      <p>此内容需要登录之后才可以继续观看</p>
                      <el-button type="primary" @click="$showLogin()">立即登录</el-button>
                  </div>
              </div>
              <!--未购买-->
              <div v-else>
                <div v-html="courseInfo.announce"></div>
                <div class="buy-article-tips">
                  <div>本内容需要购买之后才能阅读全文</div>
                  <el-button type="primary" @click="openBuy">立即购买 (¥{{courseInfo.price}})</el-button>
                </div>
              </div>
            </div>
            <div class="ks-content" v-html="courseInfo.content" v-else></div>
            <!--打赏-->
            <reward type="courseReward" :info-id="courseid" v-if="courseInfo.chargetype == 2"/>
          </ks-card>
          <!-- 评论 -->
          <comment
            :disabled="!isCanLearn"
            :placeholder="isCanLearn ? '请输入评论内容' : '需要购买课程后才可评论'"
            app-id="6"
            :info-id="courseid"
            title="课程评论"
          />
        </el-col>
        <el-col :span="7">
          <!-- 授课教师 -->
          <ks-card class="course-teacher" title="授课教师" v-if="teachers.length > 0">
            <div class="course-teacher__item" v-for="item in teachers" :key="item.teacherid">
              <ks-image class="course-teacher__image" :src="item.headpic" type="user"/>
              <h2>{{item.name || '老师'}}</h2>
              <span>{{item.teacherzc || '暂无职称'}}</span>
              <p>{{item.shortIntro}}</p>
            </div>
          </ks-card>
          <!-- 最新学员 -->
          <ks-card
            class="course-student"
            title="最新学员"
            :desc="'（'+courseInfo.studentcount+' 人学过）'"
            v-if="studentList.length"
          >
            <el-row :gutter="15">
              <el-col :span="6" v-for="(student,s) in studentList" :key="s">
                <div class="course-student__item">
                  <ks-image class="course-student__image" :src="student.head" type="user"/>
                  <div class="course-student__name">{{student.name}}</div>
                </div>
              </el-col>
            </el-row>
          </ks-card>
          <ks-card class="course-column" title="推荐专栏" v-if="columnList">
            <div
              class="course-column__item"
              v-for="(column,d) in columnList"
              :key="d"
              @click="openColumnDetail(column.columnid)"
            >
              <ks-image class="course-column__image" :src="column.defaultpic"/>
              <h2>{{column.title}}</h2>
              <p>{{column.shortdesc}}</p>
              <p>已更新{{column.qs}}期</p>
            </div>
          </ks-card>
        </el-col>
      </el-row>
      <ks-card class="course-recommend" title="推荐课程">
        <el-row :gutter="24">
          <el-col :span="6" v-for="(course,c) in courseList" :key="c">
            <div class="course-recommend__item">
              <div class="course-recommend__image" @click="openCourseDetail(course.courseid)">
                <ks-image :src="course.defaultpic" fit="cover"/>
              </div>
              <div class="course-recommend__title">{{course.title}}</div>
            </div>
          </el-col>
        </el-row>
      </ks-card>
    </ks-container>
  </div>
</template>

<script>
import Reward from "@/pc/components/reward";
import Play from "./components/Play";
import PlayDan from "./components/PlayDan";
import Comment from "@/pc/components/comment";
import {
  getCourseDetail,
  getCoursePlayVod,
  getColumnList,
  courseStudent
} from "@/api/course";
import { getStoreData } from "@/api/store";
export default {
  name: "CourseDetail",
  components: {
    Play,
    PlayDan,
    Comment,
    Reward
  },
  data() {
    return {
      is_login:Number,
      is_onlogin:'',
      /**是否可以学习，已购买或免费课程 isCanLearn 为true */
      isCanLearn: false,
      /**课程id */
      courseid: this.$route.params.id,
      /**是否免费 */
      isFree: false,
      /**错误提示 */
      errTips: null,
      /**当前时间 */
      nowTime: 0,
      /**课程信息 */
      courseInfo: null,
      /**老师列表 */
      teachers: [],
      /**目录列表 */
      chapter: null,
      /**课程目录结构 0 章节时 1 章节 2 纯课时 */
      chapterType: null,
      /**推荐课程 */
      courseList: [],
      /**推荐专栏 */
      columnList: [],
      /**学员列表 */
      studentList: []
    };
  },
  methods: {
    /**
     * @param {Object} id
     * 打开专栏详情
     */
    openColumnDetail(id) {
      this.$router.push({
        name: "ColumnDetail",
        params: {
          id: id
        }
      });
    },
    /**
     * 打开推荐课程详情
     * @param {Object} id
     */
    openCourseDetail(courseid) {
      this.$router.push({
        name: "CourseDetail",
        params: {
          id: courseid
        }
      });
      this.getDetail();
    },
    /**
     * 课时播放
     */
    play(periodItem) {
      let courseType = this.courseInfo.courseType;
      /**可试听时间 */
      let auditionTime = 0;
      if (periodItem.json && periodItem.json.is_audition == 1) {
        auditionTime = periodItem.json.audition_time;
      }
      this.errTips = "";
      if (this.isCanLearn || auditionTime > 0) {
        if (courseType == 1) {
          /**获取点播课时播放信息 */
          getCoursePlayVod({
            courseid: this.courseid,
            chapterid: periodItem.chapterid
          }).then(res => {
            if (res.errcode === "10002") {
              this.$showLogin();
              return false;
            }
            if (res.code == 10005) {
              this.$toast(res.msg);
              return false;
            }
            if (res.msg == "系统出错") {
              this.errTips = "暂无视频";
              return false;
            }

            let mediaInfo = res;
            mediaInfo.cover = this.courseInfo.defaultpic;
            mediaInfo.courseid = periodItem.courseid;
            mediaInfo.chapterid = periodItem.chapterid;
            mediaInfo.mediaType = "video";
            mediaInfo.period = periodItem;
            if(!this.isCanLearn){
              mediaInfo.price = this.courseInfo.price;
              mediaInfo.auditionTime = auditionTime
            }
            this.$refs.play.playMedia(mediaInfo);
          });
        } else if (courseType == 3) {
          /**音频课时 */
          let mediaInfo = {
            videoid: periodItem.videoId,
            title: periodItem.title,
            mediaType: "audio"
          };
          mediaInfo.period = periodItem;
          this.$refs.play.playMedia(mediaInfo);
        }
      } else {
        if (courseType == 4) {
          /**图文不管什么情况，都可以预览，因为图文课时可能有试看内容 */
          let mediaInfo = {
            period: periodItem,
            mediaType: "tuwen"
          };
          this.$refs.play.playMedia(mediaInfo);
        } else {
          /**提示购买 */
          this.openBuy();
        }
      }
    },

    /**
     * 获取推荐专栏
     */
    getColumnList() {
      getColumnList({
        act: "appColumn",
        callKeyName: "columnList",
        p: 1,
        data: {
          //...
        },
        maxperpage: 3
      }).then(res => {
        this.columnList = res.list;
      });
    },
    /**
     * 获取最新学员
     */
    courseStudent() {
      courseStudent({
        courseid: this.$route.params.id
      }).then(res => {
        this.studentList = res.list;
      });
    },
    /**
     * 获取课程详情
     */
    getCourseDetail() {
      this.$showLoading();
      getCourseDetail({
        id: this.courseid
      }).then(res => {
        if (res.errCode === 10001) {
          this.$toast("该内容已不存在").then(() => {
            this.$router.back();
          });
          return false;
        }
        let courseInfo = res.courseinfo;
        /**
         * 开启防复制
         */
        if (courseInfo.iscopy == 1) {
          this.$antiCopy(true);
        }
        this.getRelatedCourses(courseInfo.courseType);
        this.courseInfo = courseInfo;
        this.teachers = res.teacherinfo;
        this.chapter = res.chapter.chapter;
        this.chapterType = res.chapter.istype;
        this.nowTime = res.now_time;
        if (Number(courseInfo.price) === 0 || courseInfo.chargetype != 1) {
          this.isFree = true;
        }
        if (
          Number(courseInfo.price) === 0 ||
          courseInfo.isbuy == 1 ||
          courseInfo.chargetype != 1
        ) {
          this.isCanLearn = true;
        }

        this.$hideLoading();

        this.$nextTick(() => {
          /**
           * 满足播放权限直接进入播放
           */
          let firstNode = this.chapter[0];
          if (!firstNode) {
            return;
          }

          /**
           * @param coursehour 0 为单课时  1 为连载课时
           */
          if (courseInfo.coursehour == 1) {
            if (this.chapterType == 2) {
              /**纯课时列表的目录结构，直接取第一个课时播放 */
              this.play(this.chapter[0]);
            } else {
              /**获取第一个课时信息 */
              let firstPeriod;
              for (let i = 0; i < this.chapter.length; i++) {
                let c = this.chapter[i];
                if (c.Section) {
                  for (let ii = 0; ii < c.Section.length; ii++) {
                    let s = c.Section[ii];
                    if (s.keshi && !firstPeriod) {
                      firstPeriod = s.keshi[0];
                      break;
                    }
                  }
                } else if (c.keshi) {
                  if (!firstPeriod) {
                    firstPeriod = c.keshi[0];
                    break;
                  }
                }
              }
              if (firstPeriod) {
                this.play(firstPeriod);
              }
            }
          } else {
            this.play(firstNode);
          }
        });
      });
    },
    /**
     * 打开购买窗口
     */
    openBuy() {
      this.$store.ready(state => {
        if (state.isLogin != 1) {
          this.$showLogin();
        } else {
          this.$showPay({
            price: this.courseInfo.price,
            payid: this.courseInfo.courseid,
            type: "course"
          });
        }
      });
    },
    /**
     * 获取推荐课程
     */
    getRelatedCourses(courseType) {
      getStoreData([
        {
          act: "appCourse",
          callKeyName: "courseList",
          p: 1,
          data: {
            courseType: courseType
          },
          maxperpage: 4
        }
      ]).then(res => {
        this.courseList = res.courseList.list;
      });
    },
    getDetail() {
      this.courseInfo = null;
      this.isCanLearn = false;
      this.isFree = false;
      this.courseid = this.$route.params.id;
      this.$nextTick(() => {
        this.getColumnList();
        this.courseStudent();
        this.getCourseDetail();
      });
    }
  },
  activated() {
    this.getDetail();
    this.$store.ready(state=>{
      this.is_onlogin = state.is_onloginbrowse
      this.is_login = state.userInfo.userid ? 1 : 0
    })
  },
  deactivated() {
    this.$antiCopy(false);
  }
};
</script>

<style scoped>
.course-introduce__left {
  display: inline-block;
  width: 820px;
  padding: 30px 30px 25px 30px;
  margin-right: 20px;
  background: #fff;
}

.course-introduce__right {
  width: 300px;
  float: right;
}

.course-introduce__image {
  width: 100%;
  height: 64px;
  position: relative;
}
.course-introduce__image .ks-image {
  width: 64px;
  height: 64px;
  border-radius: 50%;
  overflow: hidden;
  position: absolute;
  left: 50%;
  margin-left: -32px;
}

/*课程教师*/
.course-teacher {
  padding-bottom: 10px;
}
.course-teacher__item {
  text-align: center;
  padding: 20px;
  border: 1px solid #eee;
  border-radius: 4px;
}
.course-teacher__item + .course-teacher__item {
  margin-top: 15px;
}
.course-teacher__item .course-teacher__image {
  width: 80px;
  height: 80px;
  margin: 0 auto;
  border-radius: 50%;
  overflow: hidden;
}
.course-teacher__item h2 {
  font-size: 16px;
  color: #2d3336;
  font-weight: normal;
  margin: 7px 0;
}
.course-teacher__item span {
  display: inline-block;
  font-size: 12px;
  color: #929a9e;
  margin: 3px 0;
}
.course-teacher__item p {
  font-size: 12px;
  margin-top: 10px;
  color: #585e61;
  line-height: 24px;
  text-align: left;
  max-height: 72px;
  overflow: hidden;
  display: -webkit-box;
  -webkit-box-orient: vertical;
  -webkit-line-clamp: 3;
}
/* 最新学员 */
.course-student__item {
  padding: 10px 0;
}
.course-student .course-student__image {
  width: 48px;
  height: 48px;
  border-radius: 50%;
  margin: 0 auto;
  overflow: hidden;
}
.course-student__name {
  height: 22px;
  line-height: 22px;
  overflow: hidden;
  margin-top: 6px;
  white-space: nowrap;
  text-overflow: ellipsis;
  text-align: center;
}
/* 相关专栏 */

.course-column__item {
  min-height: 65px;
  cursor: pointer;
  position: relative;
  padding-left: 115px;
}
.course-column__item + .course-column__item {
  margin-top: 15px;
}
.course-column__item .course-column__image {
  width: 105px;
  height: 65px;
  position: absolute;
  left: 0;
  top: 0;
}
.course-column__item h2 {
  font-size: 15px;
  color: #555;
  line-height: 20px;
  height: 20px;
  white-space: nowrap;
  text-overflow: ellipsis;
  overflow: hidden;
  font-weight: normal;
  margin-bottom: 5px;
}
.course-column__item p {
  font-size: 12px;
  line-height: 20px;
  max-height: 20px;
  white-space: nowrap;
  text-overflow: ellipsis;
  overflow: hidden;
  color: #999;
}

/* 推荐课程 */
.course-recommend {
  margin-top: 20px;
}
.course-recommend__item {
  cursor: pointer;
  padding-bottom: 10px;
}
.course-recommend__image {
  height: 160px;
  width: 100%;
  overflow: hidden;
}
.course-recommend__title {
  font-size: 14px;
  max-height: 44px;
  line-height: 22px;
  overflow: hidden;
  display: -webkit-box;
  -webkit-box-orient: vertical;
  -webkit-line-clamp: 2;
  margin-top: 10px;
}
.course-recommend .ks-image {
  height: 100%;
  width: 100%;
  transition: all 0.6s;
  -webkit-transition: all 0.6s;
  -o-transition: all 0.6s;
  -moz-transition: all 0.6s;
  -ms-transition: all 0.6s;
}
.course-recommend .el-col:hover .ks-image {
  transform: scale(1.1);
  -webkit-transform: scale(1.1);
  -o-transform: scale(1.1);
  -moz-transform: scale(1.1);
  -ms-transform: scale(1.1);
}

.buy-article-tips {
  border-top: 1px solid #eee;
  text-align: center;
  padding: 75px 0 30px 0;
  font-size: 14px;
  letter-spacing: 1px;
  background: url(../../assets/course/money.png) no-repeat 50% 30px;
  background-size: auto 34px;
  margin-top: 15px;
}
.nologin_see p {
  margin-bottom: 10px;
}
.nologin_see{
  text-align: center;
  padding: 100px 0
}
</style>
