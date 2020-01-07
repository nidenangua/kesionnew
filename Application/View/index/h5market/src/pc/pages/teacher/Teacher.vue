<template>
  <div class="teacher">
    <!-- 名师列表 -->
    <ks-container title="名师列表" class="teacher-list">
      <el-row :gutter="36">
        <el-col
          :span="8"
          v-for="(item,i) in teacherList"
          :key="i"
        >
          <div class="teacher-list__item" @click="open('TeacherDetail',item.userid)">
            <div class="teacher-list__image">
              <ks-image :src="item.head" type="user" />
            </div>
            <h2>{{item.name}}</h2>
            <h3>{{item.position}}</h3>
            <p>{{item.shortIntro}}</p>
            <div class="teacher-list__course" v-if="item.course_info.length>0">
              <h4>讲师力荐课程</h4>
              <div
                class="teacher-list__box"
                v-for="(course,n) in item.course_info"
                :key="n"
                @click.stop="open('CourseDetail',course.courseid)"
              >
                <div style="float: left;width: 100%;">
                  <ks-image :src="course.defaultpic" fit="cover"></ks-image>
                  <div class="teacher-list__right">
                    <h5>{{course.title}}</h5>
                    <span>{{course.studentcount}}人加入学习</span>
                  </div>
                </div>
              </div>
              <div class="teacher-list__more">查看更多</div>
            </div>
          </div>
        </el-col>
      </el-row>
    </ks-container>
    <div style="text-align: center;">
      <el-pagination
        background
        layout="prev, pager, next"
        :page-count="pageCount"
        @current-change="getTeacherList"
        v-if="pageCount>0"
      />
      <ks-empty msg="暂无教师数据" v-else />
    </div>
  </div>
</template>

<script>
import { getTeacher } from "@/api/teacher";
export default {
  name: "Teacher",
  data() {
    return {
      pageCount: null,
      params: {
        p: 1,
        maxperpage: 9
      },
      teacherList: []
    };
  },
  methods: {
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
    goSearch() {},
    getTeacherList(p = 1) {
      this.params.p = p;
      getTeacher(this.params).then(res => {
        this.pageCount = res.page.total_pages;
        this.teacherList = res.list;
      });
    }
  },
  created() {
    this.getTeacherList();
  },
  activated() {}
};
</script>

<style scoped>
.teacher {
}
.teacher-list {
  width: 1200px;
  margin: 0 auto;
}
.teacher-list h1 {
  color: #2d3336;
  font-size: 18px;
  margin-top: 30px;
  margin-bottom: 20px;
}
.teacher-list__main {
  width: 100%;
}
.teacher-list__item {
  padding: 30px;
  text-align: center;
  background: #fff;
  border-radius: 10px;
  margin-bottom: 30px;
  cursor: pointer;
  position: relative;
  height: 230px;
}

.teacher-list__item:hover {
  box-shadow: 0px 0 10px 0px rgba(0, 0, 0, 0.08);
  border-radius: 10px 10px 0 0;
}

.teacher-list__image {
  height: 96px;
  width: 100%;
  position: relative;
}
.teacher-list__image .ks-image {
  height: 96px;
  width: 96px;
  border-radius: 50%;
  overflow: hidden;
  position: absolute;
  top: 0;
  left: 50%;
  margin-left: -48px;
}
.teacher-list__item h2 {
  font-size: 16px;
  color: #2d3336;
  margin-top: 13px;
}
.teacher-list__item h3 {
  color: #929a9e;
  font-size: 12px;
  margin-top: 8px;
}
.teacher-list__item p {
  color: #585e61;
  font-size: 12px;
  margin-top: 28px;
  line-height: 24px;
  text-align: left;
  text-overflow: -o-ellipsis-lastline;
  overflow: hidden;
  text-overflow: ellipsis;
  display: -webkit-box;
  -webkit-line-clamp: 3;
  line-clamp: 3;
  -webkit-box-orient: vertical;
}
.teacher-list__course {
  margin-top: 30px;
  width: 100%;
  box-sizing: border-box;
  position: absolute;
  padding: 0 30px 30px 30px;
  top: calc(100% - 30px);
  z-index: 999;
  background: #fff;
  left: 0;
  box-shadow: 0px 4px 10px 0px rgba(0, 0, 0, 0.08);
  border-radius: 0 0 10px 10px;
  display: none;
}
.teacher-list__item:hover .teacher-list__course {
  display: block;
}
.teacher-list__course h4 {
  color: #929a9e;
  text-align: center;
  font-size: 12px;
}
.teacher-list__course h4:before,
.teacher-list__course h4:after {
  content: "";
  width: 105px;
  border-top: 1px #929a9e solid;
  display: inline-block;
  vertical-align: middle;
}
.teacher-list__course h4:before {
  margin-right: 12px;
}
.teacher-list__course h4:after {
  margin-left: 12px;
}
.teacher-list__box {
  height: 65px;
  margin-top: 15px;
  overflow: hidden;
}
.teacher-list__box .ks-image {
  width: 112px;
  height: 100%;
  float: left;
}
.teacher-list__right {
  width: 190px;
  height: 100%;
  float: right;
  text-align: left;
}
.teacher-list__right h5 {
  color: #2d3336;
  line-height: 21px;
}
.teacher-list__right span {
  display: inline-block;
  margin-top: 8px;
  color: #929a9e;
}
.teacher-list__more {
  margin: 24px auto 0;
  width: 288px;
  height: 36px;
  text-align: center;
  border: 1px solid #d9dde1;
  border-radius: 18px;
  font-size: 14px;
  color: #93999f;
  line-height: 36px;
}
.teacher-pagination {
  width: 1200px;
  margin: 60px auto 80px auto;
  text-align: center;
}
</style>
