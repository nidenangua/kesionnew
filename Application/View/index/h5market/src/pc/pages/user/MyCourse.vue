<template>
  <div class="myCourse">
    <!-- 头部分页区 -->
    <div class="myCourse-top">
      <h1>我的课程</h1>
      <div class="myCourse-top__box">
        <div class="myCourse-top__tab">
          <span :class="{active:tab==0}" @click="showTab(0)">全部</span>
          <!-- <span :class="{active:tab==1}" @click="showTab(1)">付费课程</span>
					<span :class="{active:tab==2}" @click="showTab(2)">免费课程</span>
					<i></i>
          <span :class="{active:tab==3}" @click="showTab(3)">过期课程</span>-->
        </div>
        <el-select v-model="value" placeholder="请选择">
          <el-option
            v-for="item in options"
            :key="item.value"
            :label="item.label"
            :value="item.value"
          ></el-option>
        </el-select>
      </div>
    </div>
    <!-- 内容区 -->
    <div class="myCourse-main">
      <el-row :gutter="42">
        <el-col :span="8" v-for="(item,i) in list" :key="i">
          <div class="myCourse-main__box">
            <ks-image :src="item.defaultpic" fit="cover" />
            <div class="myCourse-main__info">
              <h1>{{item.title}}</h1>
              <p>{{item.shortdesc}}</p>
            </div>
            <div class="myCourse-main__button" align="center">
              <el-button @click="open(item)" size="medium" type="primary" plain>进入学习</el-button>
            </div>
            <!-- <div class="myCourse-main__study">
					<span>开始学习</span>
					<p>下次直播时间：<i>2019-06-06 20:00</i></p>
					<div class="myCourse-main__progress">
						<el-progress :percentage="100"></el-progress>
						已学习3/{{item.hourcount}}课时
					</div>
            </div>-->
          </div>
        </el-col>
      </el-row>
    </div>
    <div style="text-align: center;">
      <el-pagination
        background
        layout="prev, pager, next"
        :current-page="p"
        :page-count="pageCount"
        @current-change="getList"
        v-if="pageCount>0"
      />
      <ks-empty msg="您还没有购买课程" v-else />
    </div>
  </div>
</template>

<script>
import userCourseMixin from "@/mixins/user/user.course";
export default {
  name: "MyCourse",
  mixins: [userCourseMixin],
  data() {
    return {
      tab: 0, //默认全部
      options: [
        // {
        //   value: "选项1",
        //   label: "按学习时间排序"
        // },
        {
          value: "选项2",
          label: "按加入时间排序"
        }
      ],
      value: "选项2"
    };
  },
  methods: {
    /*
     * 切换分页
     * */
    showTab(i) {
      this.tab = i;
    },
    /**
     * 打开课程
     */
    open(item) {
      this.$router.push("/course/" + item.courseid);
    }
  },
  activated() {
    this.getList();
  }
};
</script>

<style scoped>
.myCourse {
  width: 100%;
}
.myCourse-top {
  width: 100%;
  border-bottom: 1px solid #eee;
}
.myCourse-top h1 {
  font-size: 20px;
  color: #2d3336;
  font-weight: 400;
  padding: 21px 24px;
}
.myCourse-top__box {
  height: 44px;
  width: 100%;
  position: relative;
}
.myCourse-top__tab {
  height: 44px;
  line-height: 44px;
  position: absolute;
  top: 0;
  left: 0;
}
.myCourse-top__tab span {
  display: inline-block;
  width: 64px;
  height: 100%;
  text-align: center;
  margin-left: 40px;
  font-size: 16px;
  color: #585e61;
  cursor: pointer;
}
.myCourse-top__tab i {
  display: inline-block;
  width: 1px;
  height: 20px;
  background: #ddd;
  margin-left: 40px;
  margin-bottom: -5px;
}
.active {
  border-bottom: 2px solid #2e84ee;
  color: #2e84ee !important;
}
.el-select {
  position: absolute;
  bottom: 12px;
  right: 20px;
}
/* 内容区 */
.myCourse-main {
  padding: 0 30px 40px 30px;
}
.myCourse-main__box {
  box-shadow: 0px 2px 8px 0px rgba(0, 0, 0, 0.06);
  margin-top: 30px;
  padding-bottom: 10px;
  position: relative;
  top: 0px;
  transition: 0.3s;
  cursor: pointer;
}
.myCourse-main__box:hover {
  top: -5px;
}
.myCourse-main__box .ks-image {
  height: 153px;
  width: 100%;
}

.myCourse-main__box h1 {
  font-size: 16px;
  color: #2d3336;
  font-weight: normal;
  line-height: 22px;
  max-height: 44px;
  overflow: hidden;
  margin: 15px 15px 0 15px;
}
.myCourse-main__box p {
  padding: 0 15px;
  height: 24px;
  line-height: 24px;
  overflow: hidden;
  color: #999;
  white-space: nowrap;
  text-overflow: ellipsis;
}
.myCourse-main__info{
  height:87px;
  overflow: hidden;
}
.myCourse-main__button {
  padding: 20px 0 10px 0;
}
.myCourse-main__study {
  position: relative;
  height: 49px;
}
.myCourse-main__study span {
  display: inline-block;
  width: 120px;
  height: 30px;
  border: 1px solid #2e84ee;
  border-radius: 15px;
  text-align: center;
  color: #2e84ee;
  font-size: 14px;
  line-height: 30px;
  position: absolute;
  left: 50%;
  margin-left: -60px;
}
.myCourse-main__study p {
  font-size: 12px;
  color: #929a9e;
  margin: 0 10px;
}
.myCourse-main__study p i {
  color: #2e84ee;
  font-style: normal;
}
.myCourse-main__progress {
  margin-left: 10px;
  color: #929a9e;
  font-size: 12px;
}
.myCourse-main__progress .el-progress {
  margin-bottom: 5px;
}
</style>
