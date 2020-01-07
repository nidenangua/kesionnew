<template>
  <div class="kd-nav">
    <div class="kd-nav--box">
      <!-- 下拉菜单模块 -->
      <div class="kd-dropdown" @mouseover="showMenu" @mouseleave="closeTab" v-if="categoryList.length && styleid == 1">
        <div class="kd-dropdown__title">
          <img src="./caidan.png" />全部分类
        </div>
        <div class="kd-dropdown__menu" v-show="menuSwitch">
          <ul>
            <li
              @click="$router.push({name:'CourseList',query:{categoryid:item.categoryid}})"
              @mouseover="showTab(i,item.categoryid)"
              v-for="(item,i) in categoryList"
              :key="i"
            >{{item.categoryname}}</li>
          </ul>
        </div>
        <div class="kd-dropdown__tab" v-show="activeTab == i && item.child && item.child.length" v-for="(item,i) in categoryList" :key="i">
          <div v-for="child in item.child" :key="child.categoryid">
            <div class="kd-dropdown__tab-title">{{child.categoryname}}</div>
            <div class="kd-dropdown__tab-subtitle">
              <a
                v-for="subchild in child.child"
                :key="subchild.categoryid"
                @click="openCourse(subchild)"
              >
                {{subchild.categoryname}}
                <i>|</i>
              </a>
            </div>
          </div>
          <div class="kd-dropdown__course" v-if="courseList.length>0">
            <div class="kd-dropdown__course-title">推荐课程</div>
            <div class="kd-dropdown__course-more" @click="$router.push({name:'CourseList',query:{categoryid:params.data.categoryid}})">查看更多></div>
            <div class="kd-dropdown__course-box">
              <el-row :gutter="10">
                <el-col :span="8" v-for="(course,n) in courseList" :key="n">
                  <div class="kd-dropdown__course-item" @click="openCourseDetail(course)">
                    <el-image :src="course.defaultpic" fit="fill"></el-image>
                    <p>{{course.title}}</p>
                  </div>
                </el-col>
              </el-row>
            </div>
          </div>
        </div>
      </div>
      <!-- 菜单栏模块 -->
      <div class="kd-menu">
        <span
          :class="{isactive:'#'+$route.path == item.url}"
          v-for="(item,i) in navList"
          :key="i"
          @click="open(item.url)"
        >{{item.name}}</span>
      </div>
    </div>
  </div>
</template>

<script>
import { courseCategory } from "@/api/course";
import { getStoreData } from "@/api/store";
export default {
  name: "KdNav",
  props: {
    navList: {
      type: Array,
      default() {
        return [];
      }
    },
    styleid:{
      type:Number,
      default:1
    },
    other: {
      type: Object,
      default() {
        return {};
      }
    }
  },
  data() {
    return {
      menuSwitch: false,
      activeTab: null,
      categoryList: [],
      params: {
        act: "appCourse",
        callKeyName: "courseList",
        p: 1,
        data: {
          //...
          categoryid: 1
        },
        maxperpage: 3
      },
      idList: [],
      courseList: [],
      allData: []
    };
  },
  watch: {
    "$route.name": {
      handler(name) {
        if (name === "Index") {
          this.menuSwitch = this.other.menuSwitch;
        } else {
          this.menuSwitch = false;
        }
      },
      immediate: true
    },
    "other.menuSwitch"(){
      if (this.$route.name === "Index") {
        this.menuSwitch = this.other.menuSwitch;
      } else {
        this.menuSwitch = false;
      }
     
    }
  },
  methods: {
    /**
     * 打开课程列表
     */
    openCourse(item) {
      this.$router.push({
        name: "CourseList",
        query: {
          categoryid: item.categoryid
        }
      });
    },
    /**
     * 打开课程详情
     */
    openCourseDetail(item) {
      this.$router.push({
        name: "CourseDetail",
        params: {
          id: item.courseid
        }
      });
    },
    showMenu() {
      this.menuSwitch = true;
    },
    showTab(index, id) {
      this.activeTab = index;
      this.params.data.categoryid = id;
      if (this.idList.indexOf(id) == -1) {
        this.idList.push(id);
        getStoreData([this.params]).then(res => {
          this.allData.push(res.courseList.list);
          this.courseList = res.courseList.list;
        });
      } else {
        this.courseList = this.allData[this.idList.indexOf(id)];
      }
    },
    closeTab() {
      this.activeTab = null;
      if (this.$route.name === "Index") {
        this.menuSwitch = this.other.menuSwitch;
      } else {
        this.menuSwitch = false;
      }
    },
    /**
     * 跳转页面
     * @param {String} 跳转地址
     */
    open(url) {
      location.href = url;
    },
    /**
     * 获取课程分类
     */
    getCourseCategory() {
      courseCategory().then(res => {
        this.categoryList = res;
      });
    }
  },
  mounted() {
    if(this.styleid == 1){
      this.getCourseCategory();
    }
    
  }
};
</script>

<style scoped>
.kd-nav {
  width: 100%;
  height: 44px;
  background: #fff;
}
.kd-nav--box {
  width: 1200px;
  height: 44px;
  margin: 0 auto;
}
/* 下拉菜单模块 */
.kd-dropdown {
  width: 180px;
  height: 100%;
  font-size: 16px;
  float: left;
  position: relative;
  z-index: 100;
  margin-right: 35px;
}
.kd-dropdown__title {
  width: 180px;
  height: 44px;
  background: #2e84ee;
  color: #fff;
  font-size: 16px;
  line-height: 44px;
  cursor: pointer;
}
.kd-dropdown__title img {
  width: 16px;
  height: 16px;
  float: left;
  margin-left: 30px;
  margin-top: 12px;
  margin-right: 10px;
}
.kd-dropdown__menu {
  width: 180px;
  height: 420px;
  background: rgba(255, 255, 255, 0.9);
  overflow-y: auto;
  overflow-x: hidden;
}
.kd-dropdown__menu::-webkit-scrollbar {
    width: 3px;
    height: 5px;
}

::-webkit-scrollbar-thumb {
    border-radius: 10px;
    background: rgba(0, 0, 0, 0.1);
}
.kd-dropdown__menu ul li {
  width: 160px;
  height: 46.6px;
  font-size: 16px;
  cursor: pointer;
  line-height: 46.6px;
  padding-left: 20px;
  color: #2d3336;
}
.kd-dropdown__menu ul li:hover {
  color: #2e84ee;
  background: rgba(255, 255, 255, 1);
}
.kd-dropdown__tab {
  width: 700px;
  height: 420px;
  box-sizing: border-box;
  padding: 0 20px 20px 20px;
  position: absolute;
  top: 44px;
  left: 180px;
  background: #fff;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.06);
}
.kd-dropdown__tab-title {
  font-size: 16px;
  color: #2d3336;
  margin-top: 20px;
}
.kd-dropdown__tab-subtitle {
  font-size: 14px;
  color: #585e61;
  margin-top: 20px;
}
.kd-dropdown__tab-subtitle a:hover {
  color: #2e84ee;
  cursor: pointer;
}
.kd-dropdown__tab-subtitle a {
  display: inline-block;
  color: #585e61;
}
.kd-dropdown__tab-subtitle i {
  margin: 0 10px;
  color: #929a9e;
  font-style: normal;
}
.kd-dropdown__course {
  width: 660px;
  height: 220px;
  position: absolute;
  bottom: 0;
  left: 0;
  margin-left: 20px;
}
.kd-dropdown__course-title {
  position: absolute;
  top: 0;
  left: 0;
  font-size: 16px;
  color: #2d3336;
}
.kd-dropdown__course-more {
  position: absolute;
  top: 2px;
  right: 0;
  font-size: 14px;
  color: #585e61;
  cursor: pointer;
}
.kd-dropdown__course-box {
  width: 100%;
  position: absolute;
  top: 40px;
  left: 0;
}

.kd-dropdown__course-item p {
  color: #2d3336;
  font-size: 14px;
  margin-top: 10px;
  padding-bottom: 20px;
  cursor: pointer;
}
.kd-dropdown__course-item .el-image {
  width: 100%;
  height: 112px;
  cursor: pointer;
}
/* 导航栏模块 */
.kd-menu {
  float: left;
  height: 44px;
  background: #fff;
  color: #2d3336;
  width: calc(100% - 215px);
}
.kd-menu span {
  display: inline-block;
  height: 44px;
  padding: 0 25px;
  line-height: 44px;
  color: #2d3336;
  font-size: 16px;
  cursor: pointer;
}
.isactive {
  color: #2e84ee !important;
}
</style>
