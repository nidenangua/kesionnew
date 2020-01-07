<template>
  <div class="teacher-detail" v-if="teacherInfo">
    <ks-image :src="bg_image" fit="cover"></ks-image>
    <div class="teacher-detail__avatar">
      <div class="teacher-detail__image">
        <ks-image :src="teacherInfo.head" type="user" />
      </div>
      <h2>{{teacherInfo.name}}</h2>
      <h3>{{teacherInfo.position}}</h3>
    </div>
    <ks-container>
      <el-row :gutter="20">
        <el-col :span="18">
          <div class="teacher-detail__left">
            <div class="teacher-detail__nav">
              <div class="teacher-detail__nav-left">
                <span :class="{active:active==0}" @click="nav(0)">名师介绍</span>
                <span :class="{active:active==1}" @click="nav(1)">课程</span>
              </div>
              <!-- <div class="teacher-detail__nav-right" v-if="active==1&&courseList.length>0">
                  <span :class="{subActive:subActive==0}" @click="subNav(0)">按最受欢迎排序</span>
                  <span :class="{subActive:subActive==1}" @click="subNav(1)">按最新排序</span>
              </div>-->
            </div>
            <div
              class="teacher-detail-content ks-content"
              v-show="active==0"
              v-html="teacherInfo.teacherIntro"
            ></div>
            <div class="teacher-couser" v-show="active==1">
              <div v-if="courseList.length">
                <div v-for="(item,i) in courseList" :key="i">
                  <div class="teacher-couser__item" @click="open('CourseDetail',item.courseid)">
                    <div
                      class="teacher-couser__left"
                    >
                      <ks-image :src="item.defaultpic" />
                      <div class="teacher-couser__box">
                        <h1><el-tag size="mini">{{(item.courseType == 1 && '视频') || (item.courseType == 2 && '直播') || (item.courseType == 3 && '音频') || (item.courseType == 4 && '图文')}}</el-tag><el-tag type="warning" size="mini" v-if="item.chapter_list">连载课</el-tag>{{item.title}}</h1>
                        <div class="teacher-couser__study">
                          <h2 v-if="item.chapter_list">已更新{{item.chapter_list.length}}课时</h2>
                          <span>{{item.studentcount}}人学习</span>
                        </div>
                      </div>
                    </div>
                    
                  </div>
      
                </div>
              </div>
              <ks-empty msg="暂无课程数据" v-else />
            </div>
          </div>
        </el-col>
        <el-col :span="6">
          <ks-card title="相关老师">
            <div
              class="teacher-detail__item"
              v-for="(teacher,m) in teacherList"
              :key="m"
              @click="getHotTeacherDetail('TeacherDetail',teacher.userid)"
            >
              <ks-image :src="teacher.head" type="user" />
              <div class="teacher-detail__teacher">
                <h2>{{teacher.name}}</h2>
                <h3>{{teacher.position}}</h3>
              </div>
            </div>
          </ks-card>
        </el-col>
      </el-row>
    </ks-container>
  </div>
</template>

<script>
import {
  getTeacherDetail,
  getTeacherLinkCourse,
  getTeacher
} from "@/api/teacher";
export default {
  name: "TeacherDetail",
  data() {
    return {
      subActive: 0,
      active: 0, //当前选项
      bg_image: require("@/pc/assets/teacher/teacher_bg_default.jpg"), //默认背景图片
      teacherInfo: null, //教师详情数据
      courseList: [], //教师关联课程
      teacherList: null,
      showCourse: null,
      index: null
    };
  },
  methods: {
    nav(i) {
      this.active = i;
    },
    subNav(i) {
      this.subActive = i;
      this.getTeacherLinkCourse(i + 1);
    },
    /*
     * 打开教师关联课程子菜单
     * */
    openList(i) {
      if (i == this.showCourse) {
        this.showCourse = null;
      } else {
        this.showCourse = i;
      }
    },
    /*
     * 跳转页面
     * */
    open(url, id) {
      this.$router.push({
        name: url,
        params: {
          id: id
        }
      });
    },
    /*
     * 获取教师详情
     * */
    getTeacherDetail() {
      this.$showLoading();
      getTeacherDetail({
        userid: this.$route.params.id
      }).then(res => {
        this.teacherInfo = res.detail;
        this.$hideLoading();
      });
    },
    /*
     * 获取推荐教师详情
     */
    getHotTeacherDetail(url, id) {
      this.open(url, id);
      this.getTeacherDetail();
      this.getTeacherLinkCourse();
    },
    /*
     * 获取教师关联课程
     * */
    getTeacherLinkCourse(order) {
      getTeacherLinkCourse({
        userid: this.$route.params.id,
        order: order || 1
      }).then(res => {
        this.courseList = res.list;
      });
    },
    /*
     * 获取推荐老师列表
     * */
    getTeacherList() {
      getTeacher({
        p: 1,
        maxperpage: 6,
        data: {}
      }).then(res => {
        this.teacherList = res.list;
      });
    }
  },
  activated() {
    this.teacherInfo = null;
    this.getTeacherDetail();
    this.getTeacherLinkCourse();
    this.getTeacherList();
  }
};
</script>

<style scoped>
.teacher-couser__subItem {
  margin-left: 10px;
  height: 48px;
  width: 840px;
  vertical-align: middle;
  margin-left: 20px;
  line-height: 48px;
}
.teacher-couser__subItem:hover {
  background: #fafafa;
}
.teacher-couser__subItem-left {
  width: 70%;
  float: left;
}
.teacher-couser__subItem-left p {
  display: inline-block;
  margin-left: 14px;
  width: 36px;
  height: 20px;
  border: 1px solid #2e84ee;
  border-radius: 2px;
  margin-top: 13px;
  line-height: 20px;
  text-align: center;
  margin-right: 8px;
  color: #2e84ee;
}
.teacher-couser__subItem-left span {
  font-size: 14px;
  color: #585e61;
  display: inline-block;
}
.teacher-couser__subItem img {
  float: right;
  margin-top: 12px;
  margin-right: 24px;
}
.teacher-detail .ks-image {
  width: 100%;
  height: 300px;
}
.teacher-detail__bg {
  width: 100%;
  height: 300px;
}
.teacher-detail__avatar {
  text-align: center;
  margin-top: -70px;
  position: relative;
}
.teacher-detail__image {
  width: 100%;
  height: 140px;
}
.teacher-detail__image .ks-image {
  width: 140px;
  height: 140px;
  border-radius: 50%;
  overflow: hidden;
  position: absolute;
  left: 50%;
  margin-left: -70px;
}
.teacher-detail__avatar h2 {
  color: #2d3336;
  font-size: 20px;
  margin-top: 18px;
}
.teacher-detail__avatar h3 {
  color: #929a9e;
  font-size: 16px;
  margin-top: 15px;
  margin-bottom: 28px;
  font-weight: 400;
}
.teacher-detail__left {
  background: #fff;
}
.teacher-detail__nav {
  height: 55px;
  border-bottom: 1px solid #eee;
  padding: 0 20px 0 24px;
  line-height: 55px;
  font-size: 16px;
  color: #2d3336;
}

.teacher-detail__nav-left span {
  display: inline-block;
  margin-right: 48px;
  min-width: 64px;
  text-align: center;
  cursor: pointer;
}
.teacher-detail__nav-right {
  text-align: right;
}
.teacher-detail__nav-right span {
  display: inline-block;
  margin-left: 20px;
  text-align: center;
  cursor: pointer;
  font-size: 14px;
  color: #585e61;
}

.teacher-detail-content {
  padding: 30px;
  color: #2d3336;
  font-size: 14px;
  line-height: 28px;
  text-indent: 35px;
}

.teacher-couser img {
  float: right;
}
.teacher-couser__left {
  float: left;
}
.teacher-couser__left .ks-image {
  float: left;
}
.teacher-couser__box {
  float: left;
  margin-left: 15px;
}
.teacher-couser__box .el-tag{
  margin-right: 8px;
}
.teacher-couser__box h1 {
  font-size: 16px;
  color: #2d3336;
  font-weight: normal;
  margin-top: 2px;
}
.teacher-couser__study {
  margin-top: 13px;
}
.teacher-couser__study h2 {
  font-size: 12px;
  color: #929a9e;
  font-weight: normal;
  float: left;
  margin-right: 30px;
}
.teacher-couser__study span {
  direction: inline-block;
  font-size: 12px;
  color: #929a9e;
  float: left;
}

.teacher-couser__item {
  padding: 16px 24px 16px 10px;
  height: 90px;
  cursor: pointer;
}
.teacher-couser__item img {
  width: 20px;
  height: 20px;
  float: right;
  margin-top: 18px;
  object-fit: contain;
}
.teacher-couser__item .ks-image {
  width: 160px;
  height: 90px;
}

.teacher-detail__item {
  padding: 16px 0 0 0;
  height:72px;
}
.teacher-detail__item .ks-image {
  width: 72px;
  height: 72px;
  border-radius: 50%;
  overflow: hidden;
  float: left;
  cursor: pointer;
}
.teacher-detail__teacher {
  margin-left: 10px;
  float: left;
  padding: 12px 0;
}
.teacher-detail__teacher h2 {
  color: #2d3336;
  font-size: 14px;
  font-weight: 400;
  cursor: pointer;
}
.teacher-detail__teacher h3 {
  color: #929a9e;
  font-size: 14px;
  font-weight: 400;
  margin-top: 10px;
}
.active {
  border-bottom: 2px solid #2e84ee;
  color: #2e84ee;
}
.subActive {
  color: #2e84ee !important;
}
</style>
