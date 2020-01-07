<template>
  <div class="myColumn">
    <!-- 头部分页区 -->
    <div class="myColumn-top">
      <h1>我的专栏</h1>
      <div class="myColumn-top__box">
        <div class="myColumn-top__tab">
          <span :class="{active:tab==0}" @click="showTab(0)">全部</span>
          <!-- <span :class="{active:tab==1}" @click="showTab(1)">付费专栏</span>
					<span :class="{active:tab==2}" @click="showTab(2)">免费专栏</span>
					<i></i>
          <span :class="{active:tab==3}" @click="showTab(3)">过期专栏</span>-->
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
    <div class="myColumn-main">
      <div class="myColumn-main__item" v-for="(item,i) in list" :key="i" @click="open(item)">
        <ks-image :src="item.defaultpic" fit="cover" />
        <div class="myColumn-main__right">
          <h1>{{item.title}}</h1>
          <p>{{item.intro}}</p>
           <!--
					<el-progress :percentage="100"></el-progress>
					<span class="ks-ft-12px">已学习3/{{item.hourcount}}课时</span>
					<div class="myColumn-main__box">
						<div class="myColumn-main__study">上次学习到：<i>L1 导入照片</i></div>
						<p>继续学习</p>
          </div>-->
        </div>
      </div>
    </div>
    <div style="text-align: center;">
      <el-pagination
        background
        layout="prev, pager, next"
        :total="pageCount"
        @current-change="getList"
        v-if="pageCount>0"
      />
      <ks-empty msg="您还没有购买专栏" v-else />
    </div>
  </div>
</template>

<script>
import userColumnMixin from "@/mixins/user/user.column";
export default {
  name: "MyColumn",
  mixins: [userColumnMixin],
  data() {
    return {
      tab: 0, //默认全部
      options: [
        // {
        // 	value: '选项1',
        // 	label: '按学习时间排序'
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
     * 打开专栏
     */
    open(item) {
      this.$router.push("/column/" + item.columnid);
    }
  },
  mounted() {
    this.getList();
  }
};
</script>

<style scoped>
.myColumn {
  width: 100%;
}
.myColumn-top {
  width: 100%;
  border-bottom: 1px solid #eee;
}
.myColumn-top h1 {
  font-size: 20px;
  color: #2d3336;
  font-weight: 400;
  padding: 21px 24px;
}
.myColumn-top__box {
  height: 44px;
  width: 100%;
  position: relative;
}
.myColumn-top__tab {
  height: 44px;
  line-height: 44px;
  position: absolute;
  top: 0;
  left: 0;
}
.myColumn-top__tab span {
  display: inline-block;
  width: 64px;
  height: 100%;
  text-align: center;
  margin-left: 40px;
  font-size: 16px;
  color: #585e61;
  cursor: pointer;
}
.myColumn-top__tab i {
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
.myColumn-main {
  padding: 0 30px 40px 30px;
}
.myColumn-main__item {
  padding: 20px;
  height: 152px;
  background: rgba(255, 255, 255, 1);
  box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.1);
  border-radius: 6px;
  margin-top: 20px;
}
.myColumn-main__item .ks-image {
  width: 272px;
  height: 100%;
  margin-right: 20px;
  float: left;
}
.myColumn-main__right {
  width: calc(100% - 292px);
  float: right;
}
.myColumn-main__right p{
  height: 66px;
  line-height: 22px;
  overflow: hidden;
  color:#999;
}
.myColumn-main__right h1 {
  font-weight: 400;
  font-size: 16px;
  color: #2d3336;
  margin-top: 5px;
  margin-bottom: 15px;
}
.myColumn-main__right .el-progress {
  margin: 10px 0 6px 0;
}
.myColumn-main__right span {
  font-size: 14px;
  color: #929a9e;
  margin-top: 10px;
}
.ks-ft-12px {
  font-size: 12px !important;
}
.myColumn-main__box {
  height: 32px;
  margin-top: 8px;
}
.myColumn-main__box p {
  width: 120px;
  height: 30px;
  border: 1px solid #2e84ee;
  border-radius: 15px;
  float: right;
  line-height: 30px;
  font-size: 14px;
  color: #2e84ee;
  text-align: center;
}
.myColumn-main__study {
  color: #585e61;
  font-size: 14px;
  float: left;
  line-height: 32px;
}
.myColumn-main__study i {
  font-style: normal;
  color: #2e84ee;
}
</style>
