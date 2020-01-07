<template>
  <!-- 头部 -->
  <div v-if="loaded">
    <div class="head">
      <div class="head-bgm">
        <img src="@/m/assets/teacher/mBanner.png">
      </div>
      <div class="teach-info">
        <div class="teach-info-icon">
          <ks-create-bg
            :src="detail.head"
            style="width:100px;height:100px;"
            class="teach-info-icon__img"
            type="teacher"
            border-radius="50%"
          />
          <div class="teach-name">{{detail.name}}</div>
          <p class="teach-txt">
            {{detail.position}}
            <br>
          </p>
        </div>
      </div>
    </div>
    <div class="teacher-intro">
      <div class="teacher-intro__item">
        <h2 class="teacher-view-h2">名师介绍</h2>
        <div class="teacher-intro__cons" v-html="detail.teacherIntro"></div>
      </div>
    </div>
    <div class="list">
      <h2 class="teacher-view-h2">相关课程</h2>
      <span class="list-right">
        <span :class="sort == 2 && 'ks-color-primary'" @click="changeSort(2)">最受欢迎</span>/
        <span :class="sort == 1 && 'ks-color-primary'" @click="changeSort(1)">最新课程</span>
      </span>
      <div class="list-card ks-row" v-if="teacherCourseList.length">
        <div
          v-for="(item,i) in teacherCourseList"
          :key="i"
          class="ks-col-12"
          @click="openCourseView(item.courseid)"
        >
          <div class="list-card__item">
            <ks-create-bg class="list-card__item__img" :src="item.defaultpic"/>
            <ks-text class="list-card__txt" font-size="14px">{{item.title}}</ks-text>
            <div class="list-card__info">
              <span>
                <img src="@/m/assets/teacher/renyuan.png">
                {{item.studentcount}}
              </span>
              <span class="list-card__info__money">{{item.price}}元</span>
            </div>
          </div>
        </div>
      </div>
      <ks-empty msg="没有相关课程" v-else/>
    </div>
    <div class="tail">
      <h2 class="teacher-view-h2">相关老师</h2>
      <div class="ks-row">
        <div class="ks-col-8" v-for="item in teacherList" :key="item.userid">
          <div class="tail-item" @click="openTeacherView(item.userid)">
            <ks-create-bg class="tail-item__avatar" border-radius="50%" :src="item.head"/>
            <p>{{item.name}}</p>
          </div>
        </div>
      </div>
      <span class="more">
        <i class="eva-icon arrow-ios-forward-outline"></i>
        <router-link to="/teacher">查看更多</router-link>
      </span>
    </div>
    <store-footer/>
  </div>
</template>
<script>
import { getStoreData } from "@/api/store";
import { getTeacherDetail, getTeacherLinkCourse } from "@/api/teacher";
export default {
  name: "TeacherView",
  data() {
    return {
      loaded: false,
      detail: {},
      teacherList: [],
      sort: 2,
      teacherCourseList: []
    };
  },
  methods: {
    changeSort(sortValue) {
      this.sort = sortValue;
      this.getTeacherCourses();
    },
    /**
     * 获取教师课程列表
     */
    getTeacherCourses() {
      this.$showLoading();
      let teacherId = this.$route.params.id;
      getTeacherLinkCourse({
        userid: teacherId,
        order: this.sort,
        maxperpage: 20
      }).then(res => {
        this.teacherCourseList = res.list;
        this.$hideLoading();
      });
    },
    /**
     * 查看课程
     */
    openCourseView(courseid) {
      this.$router.push("/course/" + courseid);
    },
    /**
     * 查看教师
     */
    openTeacherView(userid) {
      this.$router.push("/teacher/" + userid);
      this.dataInit();
    },
    /**
     * 初始化数据
     */
    dataInit() {
      this.loaded = false;
      document.title = "";
      let teacherId = this.$route.params.id;
      getTeacherDetail({
        userid: teacherId
      }).then(res => {
        res.detail.teacherIntro = res.detail.teacherIntro || "暂无介绍";
        this.detail = res.detail;
        document.title = res.detail.name;
        this.loaded = true;
      });
      this.getTeacherCourses();
      getStoreData([
        {
          act: "appTeacher",
          callKeyName: "getTeacherList",
          p: 1,
          data: {
            //...
          },
          maxperpage: 3
        }
      ]).then(res => {
        this.teacherList = res.getTeacherList.list;
      });
    }
  },
  activated() {
    this.dataInit();
  }
};
</script>
<style scoped>
.head {
  position: relative;
}
.head .head-bgm img {
  width: 100%;
  height: 229px;
}
.teach-info {
  position: absolute;
  top: 20%;
  left: 0;
  right: 0;
  margin: 0 auto;
}
.teach-info-icon__img {
  margin: 0 10px;
  width: 4.5rem;
  height: 4.5rem;
  margin: 0 auto;
}
.teach-name {
  font-size: 18px;
  margin-top: 10px;
  text-align: center;
  color: #fff;
}
.teach-txt {
  font-size: 14px;
  color: #fff;
  margin-top: 10px;
  text-align: center;
}
.teacher-intro {
  margin-top: 10px;
  background-color: #fff;
  padding: 10px 20px 15px;
}
.teacher-view-h2 {
  padding: 5px 0 10px 0;
}
.teacher-intro__item img {
  width: 100%;
}
p {
  margin: 0 0 10px;
}
.teacher-intro__cons {
  width: 100%;
  font-size: 16px;
  line-height: 32px;
}
.teacher-intro__cons p {
  text-indent: 2em;
  font-size: 14px;
  line-height: 26px;
  margin-top: 15px;
  text-align: justify;
  -webkit-line-clamp: 27;
}
.list {
  position: relative;
  margin-top: 10px;
  background-color: #fff;
  padding: 10px 20px 15px;
}
.list-right {
  position: absolute;
  right: 20px;
  top: 20px;
}
.list-card {
  margin-left: -10px;
  padding-bottom: 10px;
}
.list-card__txt {
  padding: 0 8px;
  margin-top: 5px;
}
.list-card__item__img {
  height: 4.5rem;
}
.list-card__item {
  margin: 10px 0 0 10px;
  overflow: hidden;
  border-radius: 10px;
  background: #fff;
  box-shadow: 5px 7px 10px rgba(7, 17, 27, 0.1);
}
.list-top__right {
  float: right;
  font-size: 14px;
}
.list-card__info {
  padding: 8px;
}
.list-card__info img {
  position: relative;
  top: 3px;
  margin-right: 3px;
}
.list-card__info__money {
  float: right;
  color: #fa2f2f;
  font-weight: bold;
}
.tail {
  clear: both;
  padding: 10px 20px 30px;
  background-color: #fff;
  margin-top: 10px;
}
.tail li {
  float: left;
  margin: 20px 23px;
}
.tail ul {
  height: 185px;
  overflow: hidden; /*超出部分隐藏*/
  white-space: nowrap; /*不换行*/
  text-overflow: ellipsis; /*超出部分文字以...显示*/
}
.tail-item {
  text-align: center;
}
.tail-item__avatar {
  width: 80px;
  height: 80px;
  margin: 0 auto;
  border-radius: 50%;
  box-shadow: 5px 7px 10px rgba(7, 17, 27, 0.1);
  margin-top: 10px;
}
.tail-item > p {
  text-align: center;
  font-size: 16px;
  margin-top: 10px;
}
.more {
  margin: 5px;
  float: right;
  font-size: 12px;
  position: relative;
  padding-right: 15px;
}
.more a {
  color: #9999a6;
  margin-left: 15px;
  font-weight: normal;
}
.more .eva-icon {
  width: 16px;
  height: 16px;
  position: absolute;
  right: 0;
  top: 50%;
  margin-top: -8px;
}
.eva-icon {
  background-repeat: no-repeat;
  background-size: 100%;
}
</style>


