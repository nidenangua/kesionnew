<template>
  <ks-container v-if="info">
    <!-- 播放 -->
    <play-dan
      info-type="column"
      :info="info"
      :data-list="chapter"
    />
    <el-row class="column-introduce" :gutter="20">
      <el-col :span="17">
        <div class="column-introduce__left">
          <div class="column-introduce__tab">
            <span :class="{active:tab == 1}" @click="slideTab(1)">专栏介绍</span>
            <span :class="{active:tab == 2}" @click="slideTab(2)">连载内容</span>
          </div>
          <div class="column-introduce__content">
            <div v-show="tab==1">
              <div class="ks-content" v-html="info.detailintro"></div>
            </div>
            <div v-show="tab==2">
              <div v-if="chapter.length">
                <div class="column-course__item" v-for="(item,i) in chapter" :key="i">
                  <ks-image :src="item.defaultpic" @click="open(item)" />
                  <div class="column-course__box">
                    <h1 @click="open(item)">{{item.title}}</h1>
                    <p>{{item.shortdesc}}</p>
                    <p><el-tag size="small">{{(item.courseType == 1 && '视频') || (item.courseType == 2 && '直播') || (item.courseType == 3 && '音频') || (item.courseType == 4 && '图文')}}</el-tag> &nbsp; {{item.studentnum}}人学习</p>
                  </div>
                </div>
              </div>
              <ks-empty msg="该专栏下暂无课程" v-else />
            </div>
          </div>
        </div>
      </el-col>
      <el-col :span="7">
        <div class="column-introduce__right">
          <!-- 最新学员 -->
          <ks-card title="最新学员" :desc="info.soldnum + '人正在学习'" v-if="studentList.length">
            <div align="center">
              <el-row :gutter="12">
                <el-col :span="6" v-for="(student,s) in studentList" :key="s">
                  <div class="column-introduce__img">
                    <ks-image :src="student.head" type="user" />
                  </div>
                  <div class="column-introduce__name">{{student.name}}</div>
                </el-col>
              </el-row>
            </div>
          </ks-card>
          <!-- 相关专栏 -->
          <ks-card class="column-introduce__column" title="相关专栏">
            <div class="column-introduce__list" v-if="columnList">
              <div
                class="column-introduce__item"
                v-for="(column,d) in columnList"
                :key="d"
                @click="openColumnDetail(column.columnid)"
              >
                <div class="column-column__image">
                  <ks-image :src="column.defaultpic" />
                </div>
                <div class="column-introduce__course">
                  <h2>{{column.title}}</h2>
                  <p>{{column.shortdesc}}</p>
                  <p>已更新{{column.qs}}期</p>
                </div>
              </div>
            </div>
          </ks-card>
        </div>
      </el-col>
    </el-row>
  </ks-container>
</template>

<script>
import PlayDan from "../course/components/PlayDan";
import {
  getColumnDetail,
  getColumnList,
  courseStudent
} from "@/api/course";
export default {
  name: "ColumnDetail",
  components: {
    PlayDan
  },
  data() {
    return {
      isCanLearn: false,
      columnid: this.$route.params.id,
      isFree: false,
      /**专栏详情 */
      info: null,
      /**连载内容 */
      chapter: null,
      /**推荐专栏列表 */
      columnList: [],
      title: "课程评价",
      buyView: false,
      studentList: [], //学员列表
      tab: 1
    };
  },
  activated() {
    this.getDetail();
  },
  deactivated() {
    this.$antiCopy(false);
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
      this.getDetail()
    },
    /**
     * @param {Object} id
     * 打开推荐课程详情
     */
    openCourseDetail(item) {
      if (item.coursetype != 2) {
        this.$router.push({
          name: "CourseDetail",
          params: {
            id: item.courseid
          }
        });
      } else {
        this.$router.push({
          name: "LiveDetail",
          params: {
            id: item.id
          }
        });
      }
    },
    /**
     * 切换选项卡
     */
    slideTab(i) {
      this.tab = i;
    },
    getColumnList() {
      //获取推荐专栏
      getColumnList({
        act: "appColumn",
        callKeyName: "columnList",
        p: 1,
        data: {
          //...
        },
        maxperpage: 4
      }).then(res => {
        this.columnList = res.list;
      });
    },
    courseStudent() {
      //获取最新学员
      courseStudent({
        courseid: this.$route.params.id
      }).then(res => {
        this.studentList = res.list;
      });
    },
    /**
     * 获取详情
     */
    getDetail() {
      this.isCanLearn = false;
      this.isFree = false;
      this.columnid = this.$route.params.id;
      this.$showLoading();
      this.getColumnList();
      this.courseStudent();
      /**
       * 获取课程详情
       */
      getColumnDetail({
        id: this.columnid
      }).then(res => {
        let info = res.info;
        /**
         * 开启防复制
         */
        if (info.iscopy == 1) {
          this.$antiCopy(true);
        }
        this.info = info;
        let chapterData = res.chapter.chapter;
        this.chapter = chapterData;
        if (Number(info.price) === 0 || info.chargetype != 1) {
          this.isFree = true;
        }
        if (
          Number(info.price) === 0 ||
          info.isbuy == 1 ||
          info.chargetype != 1
        ) {
          this.isCanLearn = true;
        }
        this.$hideLoading();
      });
    },
    /**
     * 打开链接
     */
    open(item){
      this.$router.push(`/course/${item.id}`)
    }
  }
};
</script>

<style scoped>
.column-introduce {
  margin-top: 20px;
}
.column-introduce__left {
  padding: 30px 30px 25px 30px;
  background: #fff;
}
.column-introduce__tab {
  height: 44px;
  line-height: 44px;
  font-size: 16px;
  color: #2d3336;
  border-bottom: 1px solid #eee;
}
.column-introduce__tab span {
  display: inline-block;
  height: 100%;
  box-sizing: border-box;
  margin-right: 40px;
  cursor: pointer;
}
.active {
  color: #2e84ee;
  border-bottom: 2px solid #2e84ee;
}
.column-introduce__content {
  margin-top: 20px;
  overflow: hidden;
}
.column-course__item {
  height: 100px;
  padding: 20px 0;
}
.column-course__item + .column-course__item{
  border-top: 1px solid #eee;
}
.column-course__item .ks-image {
  width: 170px;
  height: 100px;
  float: left;
  border-radius: 4px;
  overflow: hidden;
  cursor: pointer;
}
.column-course__box {
  margin-left: 20px;
  float: left;
  width: calc(100% - 210px);
}
.column-course__box h1 {
  font-size: 18px;
  height: 28px;
  line-height: 28px;
  white-space: nowrap;
  text-overflow: ellipsis;
  overflow: hidden;
  cursor: pointer;
}
.column-course__box p {
  font-size: 14px;
  height:26px;
  line-height: 26px;
  white-space: nowrap;
  text-overflow: ellipsis;
  overflow: hidden;
  color: #929a9e;
  margin-top:8px;
}

.column-introduce__teacher {
  padding: 25px 20px 25px 20px;
  background: #fff;
  text-align: center;
}
.column-introduce__image {
  width: 100%;
  height: 64px;
  position: relative;
}
.column-introduce__image .ks-image {
  width: 64px;
  height: 64px;
  border-radius: 50%;
  overflow: hidden;
  position: absolute;
  left: 50%;
  margin-left: -32px;
}
.column-introduce__img {
  padding-top: 10px;
}
.column-introduce__img .ks-image {
  width: 48px;
  height: 48px;
  margin: 0 auto;
  border-radius: 50%;
  overflow: hidden;
}
.column-introduce__name {
  height: 32px;
  line-height: 32px;
  overflow: hidden;
}
.column-introduce__student img {
  width: 48px;
  height: 48px;
  border-radius: 50%;
  overflow: hidden;
}
.column-introduce__student .el-col {
  margin-bottom: 12px;
}
/* 相关专栏 */
.column-introduce__item {
  width: 100%;
  height: 63px;
  padding: 10px 0;
  cursor: pointer;
}
.column-column__image {
  width: 112px;
  height: 63px;
  float: left;
  margin-right: 10px;
  overflow: hidden;
}
.column-column__image .ks-image {
  width: 100%;
  height: 100%;
  transition: all 0.6s;
  -webkit-transition: all 0.6s;
  -o-transition: all 0.6s;
  -moz-transition: all 0.6s;
  -ms-transition: all 0.6s;
}
.column-introduce__item:hover .ks-image {
  transform: scale(1.2);
  -webkit-transform: scale(1.2);
  -o-transform: scale(1.2);
  -moz-transform: scale(1.2);
  -ms-transform: scale(1.2);
}
.column-introduce__course {
  width: calc(100% - 122px);
  float: left;
}
.column-introduce__course h2 {
  font-size: 15px;
  color: #555;
  font-weight: normal;
  height: 24px;
  line-height: 24px;
  overflow: hidden;
  
}
.column-introduce__course p{
  color: #929a9e;
  height: 20px;
  line-height: 20px;
  overflow: hidden;
  white-space: nowrap;
  text-overflow: ellipsis;
}
/* 推荐课程 */
.column-recommend {
  margin-top: 20px;
}
.column-recommend .el-col {
  cursor: pointer;
}
.column-recommend__image {
  height: 153px;
  width: 100%;
  margin-bottom: 13px;
  overflow: hidden;
}
.column-recommend .ks-image {
  height: 100%;
  width: 100%;
  transition: all 0.6s;
  -webkit-transition: all 0.6s;
  -o-transition: all 0.6s;
  -moz-transition: all 0.6s;
  -ms-transition: all 0.6s;
}
.column-recommend .el-col:hover .ks-image {
  transform: scale(1.2);
  -webkit-transform: scale(1.2);
  -o-transform: scale(1.2);
  -moz-transform: scale(1.2);
  -ms-transform: scale(1.2);
}
</style>
